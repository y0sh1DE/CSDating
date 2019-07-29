<?php
    require_once "header.php";
    if($_SESSION['uLevel'] != 2)
    {
        header("Location: index.php?error=permission");
        exit();
    }
    ?>

<html>

    <!-- CONTENT -->
    <div class="container">
        <div style="float:left">
            <form action="includes/delDeclined.inc.php">
                <button type="submit" class="btn btn-danger" onclick="return confirm('Do you really want to delete all declined Accounts?');">Delete all declined Accounts</button>
            </form>
            <form action="includes/makeadmin.inc.php?username=" id="frmMakeAdmin">
                <input type="text" id="tbxMakeAdminUsername" name="tbxUsername" placeholder="Username" required>
                <button type="button"  onclick="return setAction()" class="btn btn-primary" name="btnMakeAdmin">Make Admin</button>
            </form>
        </div>
        <div>
            <!-- USER LIST -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nickname</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    require_once "includes/dbh.inc.php";
                    $sql = "SELECT uID, uName, uLevel FROM tbluser";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_row($result))
                    {
                        $level = "";
                        if($row[2] == 0) $level = "Waiting for Acceptance";
                        else if($row[2] == 1) $level = "User";
                        else if($row[2] == 2) $level = "Administrator";
                        else if($row[2] == -1) $level = "Declined";
                            $out = sprintf("<tr>
                              <td>%s</td>
                              <td>%s</td>
                              <td>%s</td>
                            </tr>", $row[0], $row[1], $level);
                            echo $out;
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function setAction() {

            let uName = document.getElementById("tbxMakeAdminUsername").value;
            if(uName !== "")
            {
                document.getElementById("frmMakeAdmin").action = "includes/makeadmin.inc.php?username=" + uName;
                document.getElementById("frmMakeAdmin").submit();
            }
        }
    </script>

</html>

<?php
    require_once "footer.php";
?>
