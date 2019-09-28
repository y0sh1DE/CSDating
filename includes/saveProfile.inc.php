<?php
    require_once "JFuncs.inc.php";
    session_start();

    $tsID = $_GET['tbxTeamspeakIdentity'];
    if($tsID != "")
    {
      require_once "dbh.inc.php";
      $sql = sprintf("UPDATE tbluser SET uTSID = '%s' WHERE uID = '%s'", $tsID, $_SESSION['uID']);
      $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
    }

    $fileName = $_FILES['imgAvatarUpload']['name'];
    $fileSize = $_FILES['imgAvatarUpload']['size'];
    $fileTmpName  = $_FILES['imgAvatarUpload']['tmp_name'];

    if($fileSize <= 200000)
    {
        $newFileName = sprintf("..\avatars\%s.png", $_SESSION['uID']);
        rename($fileTmpName, $newFileName);
    }
    else
    {
        redirect("../index.php?error=toobigavatar");
        exit();
    }


    redirect("../profile.php?success=profilesaved&uid=" . $_SESSION['uID']);
    exit();
