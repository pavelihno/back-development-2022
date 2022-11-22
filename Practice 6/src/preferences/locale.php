<?php
    if (isset($_COOKIE['lang'])) {
        $lang = $_COOKIE['lang'];
    } else {
        $lang = 'en';
    }
    if (!isset($_COOKIE['username'])) {
        $_COOKIE['username'] = $_SERVER['PHP_AUTH_USER'];
    }

    include(dirname(__DIR__, 1) . '/locale/' . $lang . '.php');
?>