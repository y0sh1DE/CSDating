<?php

if(isset($_POST['btnLogin']))
{
    require_once "dbh.inc.php";
    $username = $_POST['tbxUsername'];
    $password = $_POST['tbxPassword'];
    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

    $sql = sprintf("SELECT * FROM tbluser WHERE uName = '%s'", $username);
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if($row)
    {
        $pwdCheck = password_verify($password, $row['uPassword']);
        if($pwdCheck == true)
        {
            // Correct Password
            session_start();
            $_SESSION['uName'] = $username;
            $_SESSION['uLoggedIn'] = 1;
            header("Location: ../index.php?success=login");
            exit();
        }
        else
        {
            // wrong password & error case
            header("Location: ../login.php?error=wrongpwd");
            exit();
        }
    }
    else
    {
        // username doesnt exist
        header("Location: ../login.php?error=wrongpwd");
        exit();
    }
}
else
{
    header("Location: ../login.php");
    exit();
}