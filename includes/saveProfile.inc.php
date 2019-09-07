<?php
    require_once "JFuncs.inc.php";
    session_start();


    $fileName = $_FILES['imgAvatarUpload']['name'];
    $fileSize = $_FILES['imgAvatarUpload']['size'];
    $fileTmpName  = $_FILES['imgAvatarUpload']['tmp_name'];

    if($fileSize <= 200000)
    {
        $newFileName = sprintf("..\avatars\%s.png", $_SESSION['uID']);
        rename($fileTmpName, $newFileName);
        redirect("../profile.php?success=profilesaved&uid=" . $_SESSION['uID']);
        exit();
    }
    else
    {
        redirect("../index.php?error=toobigavatar");
        exit();
    }






