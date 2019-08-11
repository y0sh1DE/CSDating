<?php
if(isset($_GET['tbxPromote']))
{
    if(isset($_GET['newpw']))
    {
        // all variables are correctly set
        require_once "config.inc.php";
        $uName = $_GET['tbxPromote'];
        if($uName == $GLOBALS['ADMIN_UNAME'])
        {
            header("Location: logout.inc.php");
            exit();
        }
        require_once "dbh.inc.php";
        $newpw = password_hash($_GET['newpw'], PASSWORD_DEFAULT);
        $sql = sprintf("UPDATE tbluser SET uPassword = '%s' WHERE uName = '%s'", $newpw, $uName);
        $result = mysqli_query($conn, $sql);

        header("Location: ../usercontrol.php?success=resetpw&username=".$uName);
        exit();
    }
    else
    {
        header("Location: ../index.php?error=nopasswordset");
        exit();
    }
}
else
{
    header("Location: ../index.php?error=nousernameforpromo");
    exit();
}