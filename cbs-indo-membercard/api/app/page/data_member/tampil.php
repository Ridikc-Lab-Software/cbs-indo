<?php
require_once('../../../include/all_include.php');

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set('display_errors', 0);

$resp = [];
$resp["status"] = "success";
$resp["result"] = array();
//$limit =  isset($_POST['limit']) ? mysql_real_escape_string($_POST['limit']) : 10;
$limit =  200;

if (isset($_POST['berdasarkan']) && !empty($_POST['berdasarkan']) && isset($_POST['isi']) && !empty($_POST['isi'])) {
    $berdasarkan =  mysql_real_escape_string($_POST['berdasarkan']);
    $isi =  mysql_real_escape_string($_POST['isi']);
    $hal =  mysql_real_escape_string($_POST['hal']);
    $dicari = "code=";
    
    // untuk pencarian di membercard (scan qrcode dan nomor telepon)
    if ($berdasarkan == "nomor_hp_dan_nama") {
        $query = "SELECT * FROM data_member WHERE nama LIKE '%$isi%' OR no_telepon LIKE '%$isi%' limit $limit";
    } else {
        if (preg_match("/$dicari/i", $isi)) {
            $berdasarkan = 'id_member';
            $isi = str_replace($dicari, "", $isi);
            $isi = decrypt($isi);
        }
       else {
            $berdasarkan = 'id_member';
            $isi = $isi;
        }

        if (isset($_POST['dari']) && !empty($_POST['dari']) && isset($_POST['sampai']) && !empty($_POST['sampai'])) {
            $dari =  mysql_real_escape_string($_POST['dari']);
            $sampai =  mysql_real_escape_string($_POST['sampai']);
            $query = "SELECT * FROM data_member where $berdasarkan like '%$isi%' limit $limit";
        } else {
            $query = "SELECT * FROM data_member where $berdasarkan like '%$isi%' limit $limit";
        }
    }
} else {
    $query = "SELECT * FROM data_member limit $limit";
}

$proses = mysql_query($query);
while ($data = mysql_fetch_array($proses)) {

    $id_member = $data["id_member"];
    $hasil['id_member'] = $id_member;
    $hasil['nama'] = $data["nama"];
    $hasil['alamat'] = $data["alamat"];
    $hasil['no_telepon'] = $data["no_telepon"];
    $hasil['jenis_kelamin'] = $data["jenis_kelamin"];
    $id_kategori_member = $data["id_kategori_member"];
    $hasil['tanggal_terdaftar'] = "Jenis Kendaraan <b>" . baca_database("", "kategori_member", "select * from data_kategori_member where id_kategori_member='$id_kategori_member'") . "</b>";

    $hasil['id_kategori_member'] = baca_database("", "kategori_member", "select * from data_kategori_member where id_kategori_member='$id_kategori_member'");
    $hasil['kode_rfid'] = $data["kode_rfid"];
    $hasil['point'] = $data["point"];
    $hasil['username'] = $data["username"];
    $hasil['password'] = "<br><br> <b><center><font color='#2196F3'>Click Untuk Melanjutkan</font></b></center><br>";

    array_push($resp["result"], $hasil);
}

flush();
ob_clean();

json_print($resp);
