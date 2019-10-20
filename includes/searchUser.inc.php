<?php
  $input = $_POST["tbxSearchUser"];
  if(is_numeric($input))
  {
    header("Location: ../profile.php?uid=" . $input);
  }
  else
  {
    require_once "dbh.inc.php";
    $sql = sprintf("SELECT uID FROM tbluser WHERE uName = '%s'", $input);
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $row = mysqli_fetch_row($result);
    if($row[0] != "")
    {
      $url = sprintf("profile.php?uid=%s", $row[0]);
      header("Location: ../" . $url);
    }
    else header("Location: ../profile.php?error=invaliduid");
  }
  exit();
