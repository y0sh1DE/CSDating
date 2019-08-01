<?php
    require_once "header.php";
    if($_SESSION['uLoggedIn'] == 0)
    {
        header("Location: index.php?error=notloggedin");
        exit();
    }
?>

<html>
    <div class="container">
        <div class="form-group">
            <form action="includes/changepassword.inc.php" name="frmChangePassword" id="frmChangePassword">
                <div class="form-group"><input type="password" name="tbxOldPassword" id="tbxOldPassword" placeholder="Old Password" required/></div>
                <div class="form-group"><input type="password" name="tbxNewPassword" id="tbxNewPassword" placeholder="New Password" required/></div>
                <div class="form-group"><input type="password" name="tbxNewPasswordRepeat" id="tbxNewPasswordRepeat" placeholder="Repeat new Password" required/></div>
                <div class="form-group"><button type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-primary">Change Password</button>
                <input type="hidden" name="username" value="<?php echo $_GET['username']; ?>"/>
                <button type="reset" id="btnReset" name="btnReset" class="btn btn-secondary">Reset</button></div>
            </form>
        </div>
    </div>
</html>

<?php
require_once "footer.php";
?>
