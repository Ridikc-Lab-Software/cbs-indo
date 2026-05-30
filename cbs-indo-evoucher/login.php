<?php
ob_start();
if (empty($p)) {
    header("Location: index.php?=home");
    die();
}
if (!isset($_GET['action'])) {
    login();
} else {
    $action = $_GET['action'];
    if ($action == "daftar") {
        daftar();
    } elseif ($action == "simpan_daftar") {
        simpan_daftar();
    } elseif ($action == "akun") {
        akun();
    } else {
        login();
    }
}
