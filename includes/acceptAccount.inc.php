<?php
if(isset($_GET['username']))
{
    require_once "dbh.inc.php";

    $sql = sprintf("UPDATE tbluser SET uLevel = 1 WHERE uName = '%s'", $_GET['username']);
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    if($result === true)
    {
        header("Location: ../usercontrol.php?success=accepted");
        exit();
    }
    else
    {
        header("Location: ../index.php?error=acception");
        exit();
    }
}
else die("ERROR");