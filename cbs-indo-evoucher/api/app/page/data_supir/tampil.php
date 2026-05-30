<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set('display_errors', 0);

require_once('../../../include/all_include.php');

$resp = [];
$resp["status"] = "success";
$resp["result"] = array();  

if (isset($_POST['berdasarkan']) && !empty($_POST['berdasarkan']) && isset($_POST['isi']) && !empty($_POST['isi'])) {
    $berdasarkan =  mysql_real_escape_string($_POST['berdasarkan']);
    $isi =  mysql_real_escape_string($_POST['isi']);
    $limit =  mysql_real_escape_string($_POST['limit']);
    $hal =  mysql_real_escape_string($_POST['hal']);
    if (isset($_POST['dari']) && !empty($_POST['dari']) && isset($_POST['sampai']) && !empty($_POST['sampai'])) {
        $dari =  mysql_real_escape_string($_POST['dari']);
        $sampai =  mysql_real_escape_string($_POST['sampai']);
        $query = "SELECT * FROM data_supir WHERE $berdasarkan like '%$isi%'";
    } else {
        $query = "SELECT * FROM data_supir WHERE $berdasarkan like '%$isi%'";
    }
} else {
    $query = "SELECT * FROM data_supir";
}

$proses = mysql_query($query);
while ($data = mysql_fetch_array($proses)) {
    $hasil['id_supir'] = $data["id_supir"];
    $hasil['nama_supir'] = $data["nama_supir"];
    $hasil['id_relasi'] = $data["id_relasi"];
    array_push($resp["result"], $hasil);
}

if ($proses)
{
    $resp["status"] = "success";
}
else
{
    $resp["status"] = "gagal";
}

json_print($resp);