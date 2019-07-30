<?php

    require_once "JFuncs.inc.php";
    if(isset($_GET['tbxNewPassword']))
    {
        session_start();
        require_once "dbh.inc.php";
        $uName = $_GET['username'];
        $oldpassword = $_GET['tbxOldPassword'];
        $sql = sprintf("SELECT uPassword FROM tbluser WHERE uName = '%s'", $uName);
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if($row)
        {
            $pwdcheck = password_verify($oldpassword, $row['uPassword']);
            if($pwdcheck)
            {
                // correct password
                $newpassword = $_GET['tbxNewPassword'];
                $hashedPwd = password_hash($newpassword, PASSWORD_DEFAULT);
                $sql = sprintf("UPDATE tbluser SET uPassword = '%s',uChangePassword = 0 WHERE uName = '%s'", $hashedPwd, $uName);
                $result = mysqli_query($conn, $sql);
                session_start();
                $_SESSION['uName'] = $uName;
                $_SESSION['uChangePassword'] = 0;
                $_SESSION['uLevel'] = $row['uLevel'];
                $_SESSION['uLoggedIn'] = 1;
                header("Location: ../index.php?success=login");
                exit();
            }
            else
            {
                // wrong password
                redirect("../changePassword.php?error=wrongpwd&username=".$uName);
            }
        }
    }
    else
    {
        redirect("../changePassword.php?error=nonewpassword");
        exit();
    }

