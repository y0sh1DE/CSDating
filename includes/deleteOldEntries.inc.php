<?php
    require_once "JFuncs.inc.php";
    require_once "dbh.inc.php";
    session_start();
    if(!isUserAdmin())
    {
        redirect("../index.php?error=permission");
        exit();
    }

    require_once "config.inc.php";
    $sql = sprintf("DELETE FROM tbldate2user WHERE dID BETWEEN (SELECT MIN(dID) FROM tbldate2user) AND ((SELECT MIN(dID) FROM tbldate2user) + (%s - 1))", $GLOBALS['ENTRYDELETE_STEP']);

    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $rows = mysqli_affected_rows($conn);

    if($rows <= 0)
    {
        redirect("../dating.php?error=noentries");
        exit();
    }
    else
    {
        redirect("../dating.php?success=deleteoldentries&amount=" . $rows);
        exit();
    }
