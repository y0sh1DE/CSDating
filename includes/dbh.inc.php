<?php
$dbservername = "localhost";
$dbname = "conieshomies_users";
$dbusername = "root";
$dbpassword = "";

$conn = mysqli_connect($dbservername, $dbusername, $dbpassword, $dbname);
if(!$conn)
{
    die("Connection failed: " . mysqli_connect_error());
    exit();
}
