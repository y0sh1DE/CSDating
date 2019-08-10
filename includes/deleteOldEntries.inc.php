<?php
    require_once "JFuncs.inc.php";
    require_once "dbh.inc.php";
    session_start();
    if(!isUserAdmin())
    {
        redirect("../index.php?error=permission");
        exit();
    }

    $sql = sprintf("DELETE FROM tbldate2user WHERE STRCMP(SUBSTRING(CONVERT(d2uCreated, CHAR),0,10),'%s') = 0 
    AND STRCMP(SUBSTRING(CONVERT(d2uSet, CHAR),0,10),'%s') = 0", date('Y-m-d'));

    $result = mysqli_query($conn, $sql);
    $rows = mysqli_affected_rows($conn);

    redirect("../dating.php?success=deleteoldentries&amount=" . $rows);
    exit();