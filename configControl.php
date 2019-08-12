<?php
    require_once "header.php";
    require_once "includes/JFuncs.inc.php";
    if(!isUserSuperAdmin())
    {
        redirect("index.php?error=permission");
        exit();
    }
?>
<html>
    <head>
        <script>
            function validate()
            {
                let lifetime = document.getElementById("tbxSessionLifetime").value;
                let maxdays = document.getElementById("tbxMaxDaysAhead").value;
                if(!isNaN(lifetime) && !isNaN(maxdays))
                {
                    document.getElementById("frmConfiguration").submit();
                }
            }
        </script>
    </head>
    <body>
        <div class="container">
            <table class="table">
                <thead>
                    <th scope="col">Function</th>
                    <th scope="col">Value</th>
                </thead>
                <tbody>
                <form action="includes/saveConfig.inc.php" method="post" id="frmConfiguration">
                    <input type="button" name="btnSubmit" id="btnSubmit" class="btn btn-primary" value="Save Configuration File" onclick="validate()">
                    <tr>
                        <div class="form-group">
                            <td>
                                Lifetime of the users Session-Cookies (in seconds):
                            </td>
                            <td>
                                <input type="text" name="tbxSessionLifetime" id="tbxSessionLifetime" value="<?php require_once "includes/config.inc.php"; echo $GLOBALS['SESSION_LIFETIME']; ?>" required>
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td>
                                Username of the Super-Admin:
                            </td>
                            <td>
                                <input type="text" name="tbxSuperAdmin" id="tbxSuperAdmin" required="required" value="<?php require_once "includes/config.inc.php"; echo $GLOBALS['ADMIN_UNAME']; ?>">
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td>
                                Maximum amount of days the user can plan ahead:
                            </td>
                            <td>
                                <input type="text" name="tbxMaxDaysAhead" id="tbxMaxDaysAhead" required="required" value="<?php require_once "includes/config.inc.php"; echo $GLOBALS['MAX_DAYS_AHEAD']; ?>">
                            </td>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group">
                            <td>
                                New Accounts are created by:
                            </td>
                            <td>
                                <select class="form-control" id="selRegisterMethod" name="selRegisterMethod" value="User (Acceptation by Administrator)">
                                    <option value="0" <?php if($GLOBALS['SIGNUP_MODE'] == "0") echo "selected"; ?>>Administrator</option>
                                    <option value="1" <?php if($GLOBALS['SIGNUP_MODE'] == "1") echo "selected"; ?>>User (Acceptation by Administrator)</option>
                                    <option value="2" <?php if($GLOBALS['SIGNUP_MODE'] == "2") echo "selected"; ?>>User (Instant Access)</option>
                                </select>
                            </td>
                        </div>
                    </tr>
                </form>
                </tbody>
            </table>
        </div>
    </body>
</html>
<?php
    require_once "footer.php";
?>
