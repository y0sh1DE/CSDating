<?php
    require_once "dbh.inc.php";
    require_once "config.inc.php";

    $sql = sprintf("SELECT * FROM tbluser WHERE uName = '%s'", $_SESSION['uName']);
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $_SESSION['uLevel'] = $row['uLevel'];
    $_SESSION['uLoggedIn'] = $row['uLoggedIn'];
