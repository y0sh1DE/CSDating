<?php
if(isset($_GET['tbxPromote']))
{
    $uName = $_GET['tbxPromote'];
    if($uName === "Yoshi")
    {
        header("Location: logout.inc.php");
        exit();
    }
    require_once "dbh.inc.php";
    $sql = sprintf("DELETE FROM tbluser WHERE uName = '%s'", $uName);
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    header("Location: ../usercontrol.php?success=deletedUser&username=".$_GET['tbxPromote']);
    exit();
}
else
{
    header("Location: ../index.php?error=nousernameforpromo");
    exit();
}
