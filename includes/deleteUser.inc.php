<?php
if(isset($_GET['tbxPromote']))
{
    require_once "config.inc.php";
    $uName = $_GET['tbxPromote'];
    if($uName == $GLOBALS['ADMIN_UNAME'])
    {
        header("Location: logout.inc.php");
        exit();
    }
    require_once "dbh.inc.php";
    $sql = sprintf("SELECT uID FROM tbluser WHERE uName = '%s'", $uName);
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $row = mysqli_fetch_row($result);

    $sql = sprintf("DELETE FROM tbldate2user WHERE uID = '%s'", $row[0]);
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    $sql = sprintf("DELETE FROM tbluser WHERE uName = '%s'", $uName);
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));


	$newFileName = sprintf("..\avatars\%s.png", $_SESSION['uID']);
    if(file_exists($newFileName)) unlink($newFileName);

    header("Location: ../usercontrol.php?success=deletedUser&username=".$_GET['tbxPromote']);
    exit();
}
else
{
    header("Location: ../index.php?error=nousernameforpromo");
    exit();
}
