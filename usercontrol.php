<?php
    require_once "header.php";
    require_once "includes/refreshUserinfo.inc.php";
    if($_SESSION['uLoggedIn'] == 0)
    {
        header("Location: index.php?error=notloggedin");
        exit();
    }
    else if($_SESSION['uLevel'] != 2)
    {
        header("Location: index.php?error=permission");
        exit();
    }
?>

<html>

    <!-- CONTENT -->
    <div class="container">
        <!-- Delete all declined Accounts -->
        <!--<div style="float:left">
            <form action="includes/delDeclined.inc.php">
                <button type="submit" class="btn btn-danger" onclick="return confirm('Do you really want to delete all declined Accounts?');">Delete all declined Accounts</button>
            </form>
        </div>-->
        <div>
            <!-- USER LIST -->
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nickname</th>
                            <th scope="col">Status</th>
                            <th scope="col">Last Login</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <form name="frmCreateUser" id="frmCreateUser" action="includes/createUser.inc.php" method="post">
                            <td>New User:</td>
                            <td><input type="text" name="tbxCreateUsername" id="tbxCreateUsername" minlength="4" required></td>
                            <td>User</td>
                            <td></td>
                            <td><input type="submit" name="btnSubmit" id="btnSubmit" class="btn btn-primary" value="Create"/></td>
                        </form>
                    </tr>
                    <form name="frmUserList" id="frmUserList">
                    <?php
                        require_once "includes/dbh.inc.php";
                        $sql = "SELECT uID, uName, uLevel, uLastLogin FROM tbluser";
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
                                  <td>%s</td>
                                  <td>
                                  <!-- ToDo: Hide certain buttons for certain users case depending -->
                                    <button type='button' name='pro-%s' onclick='return setUserlistAction(this)' class='btn btn-success'>Promote</button>
                                    <button type='button' name='dem-%s' onclick='return setUserlistAction(this)' class='btn btn-warning'>Demote</button>
                                    <button type='button' name='spw-%s' onclick='return setUserlistAction(this)' class='btn btn-primary'>Set new Password</button>
                                    <button type='button' name='del-%s' onclick='return setUserlistAction(this)' class='btn btn-danger'>Delete</button>
                                    </td>
                                </tr>", $row[0], $row[1], $level, $row[3], $row[1] ,$row[1], $row[1], $row[1]);
                                echo $out;
                        }
                    ?>
                    </tbody>
                </table>
                <input type="hidden" name="tbxPromote" id="tbxPromote" />
                <input type="hidden" name="newpw" id="newpw" />
            </form>
        </div>
    </div>
    <script>
        function createUser()
        {
            document.getElementById("frmCreateUser").submit();
        }
        function setUserlistAction(element)
        {
            let uName = element.name.substring(4, element.name.length);
            let mode = element.name.substring(0,3);
            document.getElementById("tbxPromote").value = uName;
            if(mode === "pro")
            {
                // promote
                document.getElementById("frmUserList").action = "includes/promote.inc.php?username=" + uName;
                document.getElementById("frmUserList").submit();
            }
            else if(mode === "dem")
            {
                // demote
                document.getElementById("frmUserList").action = "includes/demote.inc.php?username=" + uName;
                document.getElementById("frmUserList").submit();
            }
            else if(mode === "spw")
            {
                // reset password
                let newpw = prompt("Please enter a new Password for " + uName, "zeus");
                if(newpw == null || newpw == ""){}
                else
                {
                    document.getElementById("newpw").value = newpw;
                    document.getElementById("frmUserList").action = "includes/setNewPW.inc.php?username=" + uName + "&newpw=" + newpw;
                    document.getElementById("frmUserList").submit();
                }
            }
            else if(mode === "del")
            {
                // delete
                if(confirm("Do you really want to delete " + uName + "?"))
                {
                    document.getElementById("frmUserList").action = "includes/deleteUser.inc.php?username=" + uName;
                    document.getElementById("frmUserList").submit();
                }
            }
            else alert("ERROR");
        }
    </script>

</html>

<?php
    require_once "footer.php";
?>
