<?php

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
        $query = "SELECT * FROM data_member where $berdasarkan like '%$isi%'";
    } else {
        $query = "SELECT * FROM data_member where $berdasarkan like '%$isi%'";
    }
} else {
    $query = "select * from data_member";
}

$proses = mysql_query($query);
while ($data = mysql_fetch_array($proses)) {

    $id_member                   = $data["id_member"];
    $hasil['id_member']          = $id_member;
    $hasil['nik']                = $data["nik"];
    $hasil['nama']               = $data["nama"];
    $hasil['alamat']             = $data["alamat"];
    $hasil['no_telepon']         = $data["no_telepon"];
    $hasil['jenis_kelamin']      = $data["jenis_kelamin"];
    // $hasil['tanggal_terdaftar'] = $data["tanggal_terdaftar"];
    $hasil['tanggal_terdaftar']  = "Jenis Kendaraan <b>" . baca_database("", "kategori_member", "select * from data_kategori_member where id_kategori_member='$id_kategori_member'") . "</b>";
    $hasil['id_kategori_member'] = $data["id_kategori_member"];
    $hasil['kode_rfid']          = $data["kode_rfid"];
    $hasil['point']              = $data["point"];
    $hasil['username']           = $data["username"];
    $hasil['password']           = $data["password"];
    $hasil['tanggal_lahir']      = $data["tanggal_lahir"];
    $hasil['agama']              = $data["agama"];
    $hasil['status_perkawinan']  = $data["status_perkawinan"];
    $hasil['id_pekerjaan']       = $data["id_pekerjaan"];
    $hasil['id_admin']           = $data["id_admin"];
    $hasil['spbu']               = $data["spbu"];

    array_push($resp["result"], $hasil);
}

json_print($resp);
