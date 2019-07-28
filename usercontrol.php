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
        <form action="includes/delDeclined.inc.php">
            <button type="submit" class="btn btn-danger" onclick="return confirm('Do you really want to delete all declined Accounts?');">Delete all declined Accounts</button>
        </form>
        <form action="includes/makeadmin.inc.php?username=" id="frmMakeAdmin">
            <input type="text" id="tbxMakeAdminUsername" name="tbxUsername" placeholder="Username" required>
            <button type="button"  onclick="return setAction()" class="btn btn-primary" name="btnMakeAdmin">Make Admin</button>
        </form>
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
