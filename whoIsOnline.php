<html>
    <body>

        <div class="float-sm-left">
            <h3>Who is online?</h3>
            <table class="table" id="tblUserList">
                <thead>
                    <tr>
                        <th scope="col">Nickname</th>
                        <th scope="col">Level</th>
                        <?php
                            if($_SESSION['uLevel'] == 2) echo "<th scope='col'>Address</th>";
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        require_once "includes/dbh.inc.php";
                        $sql = "SELECT uName, uLevel, uLastAddress FROM tbluser WHERE uLoggedIn = 1 AND uLevel >= 1";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                            $level = "User";
                            if($row['uLevel'] == 2) $level = "Administrator";
                            $out = sprintf("
                            <tr>
                                <td>
                                    %s
                                </td>
                                <td>
                                    %s
                                </td>
                            ", $row['uName'], $level);

                            if($_SESSION['uLevel'] == 2) $out .= sprintf("<td>%s</td>", $row['uLastAddress']);

                            $out .= "</tr>";
                            echo $out;
                        }
                    ?>
                </tbody>
            </table>
        </div>

    </body>
</html>


