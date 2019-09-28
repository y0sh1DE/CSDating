<?php
    require_once "header.php";
    require_once "includes/dbh.inc.php";

    if(!isset($_SESSION['uLoggedIn']) || $_SESSION['uLoggedIn'] != 1)
    {
      // If the user is not logged in
      header("Location: index.php?error=permission");
      exit();
    }

    if(!isset($_GET['uid']))
    {
        // if no profile uID is given
        $url = sprintf("profile.php?uid=%s&error=invaliduid", $_SESSION['uID']);
        header(sprintf("Location: %s", $url));
        exit();
    }

    $sql = sprintf("SELECT uID FROM tbluser WHERE uID = %s", $_GET['uid']);
    $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
    $row = mysqli_fetch_row($result);
    if($row[0] == '')
    {
        // if an invalid profile uID is given
        $url = sprintf("profile.php?uid=%s&error=invaliduid", $_SESSION['uID']);
        header(sprintf("Location: %s", $url));
        exit();
    }
?>

<html>
    <head>
    </head>
    <div class="container">
        <table class="table">
            <tbody>
                <tr>

                        <?php
                            require_once "includes/dbh.inc.php";
                            $sql = sprintf("SELECT COUNT(*) FROM tbldate2user WHERE uID = %s", $_GET['uid']);
                            $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                            $row = mysqli_fetch_row($result);

                            $datingEntries = $row[0];
                            $sql = sprintf("
                            SELECT U.uName, U.uLastLogin, U.uTSID
                            FROM tbluser U
                            WHERE uID = %d
                            ", $_GET['uid']);

                            $imageID = $_GET['uid'];
                            $filename = sprintf("avatars/%s.png", $imageID);
                            if(!file_exists($filename))  $filename = "avatars/-1.png";
                            $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                            $row = mysqli_fetch_row($result);
                            $tsImage = "https://userb.tsviewer.com/1_t-i_cn-424242_ct1-848484_ct2-585858_cson-60b404_csof-e00101_cgs-F2F2F2_cge-E4E4E4_cl-585858/";
                            $tsImage .= $row[2] . ".png";
                            $output = sprintf("
                                <td>
                                    <img src=\"%s\" alt=\"avatar\" height=\"400\" width=\"400\"/>
                                </td>
                                <td>
                                <label for=\"tbxUsername\">Username</label>
                                <input type=\"text\" value=\"%s\" id=\"tbxUsername\" name=\"tbxUsername\" class=\"form-control\" disabled>
                                <hr>
                                <label for=\"tbxUsername\">Last Seen at</label>
                                <input type=\"text\" value=\"%s\" name=\"tbxLastSeen\" id=\"tbxLastSeen\" class=\"form-control\" disabled>
                                <hr>
                                <label for=\"tbxUsername\">Dating Entries</label>
                                <input type=\"text\" value=\"%s\" name=\"tbxDatingEntries\" id=\"tbxDatingEntries\" class=\"form-control\" disabled>
                                <hr>
                                <label for=\"tbxUsername\">Teamspeak Status</label><br><br>
                                <img width='500' src=\"%s\" alt=\"tsStatus\" onerror=\"this.onerror=null; this.src='img/blank.png'\">",
                                $filename ,$row[0], $row[1], $datingEntries, $tsImage);
                            echo $output;
                            ?>

                    </td>
                </tr>
                <?php
                $uID = $_GET['uid'];
                if($uID == $_SESSION['uID'])
                {
                    echo "
                    <tr>
                        <td>
                            <form method=\"post\" action=\"includes/saveProfile.inc.php\" name=\"frmAvatarUpload\" id=\"frmSaveProfile\" enctype=\"multipart/form-data\">
                            <label for=\"imgAvatarUpload\">Avatar</label><br>
                            <input name=\"imgAvatarUpload\" id=\"imgAvatarUpload\" type=\"file\" accept=\"image/png\">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input class=\"btn btn-primary\" value=\"Save Avatar\" name=\"btnSaveProfile\" id=\"btnSaveProfile\" type=\"button\" onclick=\"confirmForm()\">
                            <input class=\"btn btn-secondary\" value=\"Reset\" name=\"btnResetAvatar\" id=\"btnResetAvatar\" type=\"reset\">

                        </td>
                    </tr>
                    <tr>
                      <td>
                        <label for=\"tbxTeamspeakIdentity\">Teamspeak Identity</label><br>
                        <input name=\"tbxTeamspeakIdentity\" id=\"tbxTeamspeakIdentity\" type=\"text\">
                      </td>
                    </tr>
                    </form>";
                    echo "<tr>";
                        echo "<td>";
                            include_once "changePassword.php";
                        echo "</td>";
                    echo "</tr>";
                    }
                ?>

            </tbody>
        </table>
    </div>
</html>


<?php
    require_once "footer.php";
?>
