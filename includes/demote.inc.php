<?php
if(isset($_GET['tbxPromote']))
{
    $uName = $_GET['tbxPromote'];
    if($uName === $GLOBALS['ADMIN_UNAME'])
    {
        header("Location: logout.inc.php");
        exit();
    }
    require_once "dbh.inc.php";
    $sql = sprintf("SELECT uLevel FROM tbluser WHERE uName = '%s'", $uName);
    $result = mysqli_query($conn, $sql);

    if($row = mysqli_fetch_assoc($result))
    {
        $oldlevel = $row['uLevel'];
        if($oldlevel == -1)
        {
            // If user is admin already
            header("Location: ../usercontrol.php?error=userlowestlevel");
            exit();
        }
        $newlevel = $oldlevel - 1;
        $sql = sprintf("UPDATE tbluser SET uLevel=%s,uLoggedIn = 0 WHERE uName = '%s'", $newlevel, $uName);
        $result = mysqli_query($conn, $sql);
    }
    else die(mysqli_error($conn));




    header("Location: ../usercontrol.php?success=demoted&username=".$_GET['tbxPromote']);
    exit();
}
else
{
    header("Location: ../index.php?error=nousernameforpromo");
    exit();
}
