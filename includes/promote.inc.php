<?php
if(isset($_GET['tbxPromote']))
{
    require_once "dbh.inc.php";
    $uName = $_GET['tbxPromote'];
    $sql = sprintf("SELECT uLevel FROM tbluser WHERE uName = '%s'", $uName);
    $result = mysqli_query($conn, $sql);

    if($row = mysqli_fetch_assoc($result))
    {
        $oldlevel = $row['uLevel'];
        if($oldlevel == 2)
        {
            // If user is admin already
            header("Location: ../usercontrol.php?error=usermaxlevel");
            exit();
        }
        if($oldlevel == -1) $newlevel = $oldlevel + 2;
        else $newlevel = $oldlevel + 1; 
        $sql = sprintf("UPDATE tbluser SET uLevel=%s WHERE uName = '%s'", $newlevel, $uName);
        $result = mysqli_query($conn, $sql);
    }
    else die(mysqli_error($conn));




    header("Location: ../usercontrol.php?success=promoted&username=".$_GET['tbxPromote']);
    exit();
}
else
{
    header("Location: ../index.php?error=nousernameforpromo");
    exit();
}
