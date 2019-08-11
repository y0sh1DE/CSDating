<?php
require_once "config.inc.php";
session_set_cookie_params(0);
session_start();
require_once "dbh.inc.php";
$sql = sprintf("UPDATE tbluser SET uLoggedIn = 0 WHERE uName = '%s'", $_SESSION['uName']);
$result = mysqli_query($conn, $sql);
session_unset();
session_destroy();


header("Location: ../index.php?success=logout");
exit();