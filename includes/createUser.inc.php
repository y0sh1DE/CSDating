<?php
    if(isset($_POST['tbxCreateUsername']))
    {
        require_once "dbh.inc.php";
        require_once "JFuncs.inc.php";
        $uName = $_POST['tbxCreateUsername'];
        $uPassword = generateRandomString(10);
        $uPasswordHash = password_hash($uPassword, PASSWORD_DEFAULT);
        $sql = sprintf("INSERT INTO tbluser (uName, uPassword, uLevel) VALUES('%s', '%s', 1)", $uName, $uPasswordHash);
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        $url = sprintf("../usercontrol.php?success=usercreated&username=%s&password=%s", $uName, $uPassword);
        redirect($url);
        exit();
    }
    else
    {
        header("Location: ../index.php");
        exit();
    }

    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!.-$';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
