<?php

if(isset($_POST['btnLogin']))
{
    require_once "dbh.inc.php";
    require_once "JFuncs.inc.php";
    require_once "config.inc.php";
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
            if($row['uChangePassword'] == 1)
            {
                // user has to change password
                session_set_cookie_params($GLOBALS['SESSION_LIFETIME']);
                session_start();
                $_SESSION['uChangePassword'] = 1;
                $_SESSION['uLoggedIn'] = 1;
                $_SESSION['uID'] = $row['uID'];

                $_SESSION['uName'] = $username;
                $_SESSION['uLevel'] = $row['uLevel'];

                redirect("../changePassword.php?username=".$username);
            }
            else
            {
                // Account accepted
                session_set_cookie_params($GLOBALS['SESSION_LIFETIME']);
                session_start();
                $_SESSION['uName'] = $username;
                $_SESSION['uLevel'] = $row['uLevel'];
                $_SESSION['uLoggedIn'] = 1;
                $_SESSION['uID'] = $row['uID'];
                header("Location: ../index.php?success=login");
            }
            $sql = sprintf("UPDATE tbluser SET uLoggedIn = 1 WHERE uName = '%s'", $username);
            $result = mysqli_query($conn, $sql);
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