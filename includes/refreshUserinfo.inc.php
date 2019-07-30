<?php
    require_once "dbh.inc.php";
    $sql = sprintf("SELECT * FROM tbluser WHERE uName = '%s'", $_SESSION['uName']);
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

$_SESSION['uLevel'] = $row['uLevel'];