<?php
    require_once "dbh.inc.php";
    $sql = "DELETE FROM tbluser WHERE uLevel = -1";
    if (mysqli_query($conn, $sql))
    {
        $count = mysqli_affected_rows($conn);
        header("Location: ../usercontrol.php?success=delDeclined");
        exit();
    }
    else
    {
        die(mysqli_error($conn));
    }