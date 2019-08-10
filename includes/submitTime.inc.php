<?php
    require_once "JFuncs.inc.php";
    session_start();
    if($_SESSION['uLoggedIn'] == 0 || !isset($_SESSION['uLoggedIn']))
    {
        redirect("../index.php?error=notloggedin");
        exit();
    }
    require_once "dbh.inc.php";
    $uName = $_SESSION['uName'];
    $uID = $_SESSION['uID'];
    $dDate = $_GET['selDate'];
    $dTime = $_GET['selTime'];
    $uComment = $_GET['tbxComment'];

    // 1. Check if the date is already set by someone
    $sql = sprintf("SELECT * FROM tbldate2user WHERE dDate = '%s' AND uID = '%s'", $dDate, $uID);
    echo $sql;
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if(!$row)
    {
        // If user has no appointment on this day
        $sql = sprintf("INSERT INTO tbldate2user (dDate, dTime, uID, uComment) VALUES ('%s', '%s', '%s', '%s')", $dDate, $dTime, $uID, $uComment);
        $result = mysqli_query($conn, $sql);

        redirect("../dating.php?success=setdate");
        exit();
    }
    else
    {
        // If user has an appointment on this day already
        $sql = sprintf("UPDATE tbldate2user SET dTime = '%s', uComment = '%s' WHERE uID = '%s' AND dDate = '%s'", $dTime, $uComment , $uID, $dDate);
        $result = mysqli_query($conn, $sql);

        redirect("../dating.php?success=updatedate");
        exit();
    }
