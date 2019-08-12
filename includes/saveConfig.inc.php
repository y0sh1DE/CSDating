<?php
    require_once "JFuncs.inc.php";
    if(!isUserSuperAdmin())
    {
        redirect("../index.php?error=permission");
        exit();
    }
    if($_POST['tbxSessionLifetime'] == "" || $_POST['tbxSuperAdmin'] == "" || $_POST['tbxMaxDaysAhead'] == "")
    {
        redirect("../configControl.php?error=missingdata");
        exit();
    }
    $sessionLifetime = $_POST['tbxSessionLifetime'];
    $adminUName = $_POST['tbxSuperAdmin'];
    $maxdaysahead = $_POST['tbxMaxDaysAhead'];
    $signUpMode = $_POST['selRegisterMethod'];
    $entryDelete = $_POST['tbxEntryDelete'];

    $output = sprintf("
    <?php
    // Lifetime of the Cookies
    \$GLOBALS[\"SESSION_LIFETIME\"] = %s;

    // Username of the Super-Admin
    \$GLOBALS[\"ADMIN_UNAME\"] = \"%s\";

    // Maximum days the user can
    \$GLOBALS[\"MAX_DAYS_AHEAD\"] = %s;
    
    // How the new accounts can get created
    \$GLOBALS[\"SIGNUP_MODE\"] = %s;
    
    // Stepwidth of delete old entries button
    \$GLOBALS['ENTRYDELETE_STEP'] = %s;
    ", $sessionLifetime, $adminUName, $maxdaysahead, $signUpMode, $entryDelete);

    file_put_contents("config.inc.php", $output);

    redirect("../configControl.php?success=savedconfig");
    exit();

