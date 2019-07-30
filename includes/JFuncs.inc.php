<?php
    function redirect($url)
    {
        $str = sprintf("Location: %s", $url);
        header($str);
    }