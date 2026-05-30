<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set('display_errors', 0);
function location() { return "api"; };
include '../../../../admin/include/function/enc.php';
include '../../../../admin/include/koneksi/koneksi.php';
include '../../../../admin/include/settings/settings.php';   
include '../../../../admin/include/function/all.php';        
include '../../../include/function/auth.php';
include '../../../include/function/all.php';
?>