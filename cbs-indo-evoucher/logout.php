<?php

include 'home/include/setting_home.php';

error_reporting(0);
session_start();

$token = $_COOKIE[ConfigHome::$LOGIN_KEY_NAME];

session_destroy();
setcookie(ConfigHome::$LOGIN_KEY_NAME, '', 0, '/');
setcookie(ConfigHome::$LOGIN_KEY_USER, '', 0, '/');
unlink($_SERVER['DOCUMENT_ROOT'] . "/../tmp/sess_login");

header("location: index.php?p=login&code=" . $token . "&from=logout");
