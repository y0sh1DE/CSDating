<?php
    function redirect($url)
    {
        $str = sprintf("Location: %s", $url);
        header($str);
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

    function isUserAdmin()
    {
        return ($_SESSION['uLevel'] == 2);
    }

    function isUserSuperAdmin()
    {
        return ($_SESSION['uName'] == $GLOBALS['ADMIN_UNAME']);
    }
