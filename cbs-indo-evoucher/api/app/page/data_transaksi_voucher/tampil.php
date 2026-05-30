<?php


require_once('../../../include/all_include.php');
$resp = [];
$resp["status"] = "success";
$resp["result"] = array();

$sort = "ORDER BY tanggal_transaksi DESC";

if (isset($_POST['berdasarkan']) && !empty($_POST['berdasarkan']) && isset($_POST['isi']) && !empty($_POST['isi'])) {
    $berdasarkan = mysql_real_escape_string($_POST['berdasarkan']);
    $isi         = mysql_real_escape_string($_POST['isi']);
    $limit       = mysql_real_escape_string($_POST['limit']);
    $hal         = mysql_real_escape_string($_POST['hal']);
    if (isset($_POST['dari']) && !empty($_POST['dari']) && isset($_POST['sampai']) && !empty($_POST['sampai'])) {
        $dari   = mysql_real_escape_string($_POST['dari']);
        $sampai = mysql_real_escape_string($_POST['sampai']);
        $query  = "SELECT * FROM data_transaksi_voucher where $berdasarkan like '%$isi%' $sort";
    } else {
        $query = "SELECT * FROM data_transaksi_voucher where $berdasarkan like '%$isi%' $sort";
    }
} else {
    $query = "SELECT * FROM data_transaksi_voucher $sort";
}

$proses = mysql_query($query);
while ($data = mysql_fetch_array($proses)) {

    $id_petugas   = baca_database("", "id_petugas", "SELECT * FROM data_transaksi WHERE id_transaksi='$data[id_transaksi]'");
    $nama_petugas = baca_database("", "nama", "SELECT * FROM data_petugas WHERE id_petugas='$id_petugas'");
    if ($nama_petugas == "")
    {
        $nama_petugas = "-";
    }

    $hasil['petugas']              = $nama_petugas;
    $hasil['id_petugas']           = $id_petugas;
    $hasil['id_transaksi']         = $data["id_transaksi"];
    $hasil['id_voucher']           = $data["id_voucher"];
    $hasil['id_member']            = $data["id_member"];
    $hasil['nama_member']          = $data["nama_member"];
    $hasil['tanggal_transaksi']    = $data["tanggal_transaksi"];
    $hasil['jenis_bbm']            = $data["jenis_bbm"];
    $hasil['nominal']              = $data["nominal"];

    array_push($resp["result"], $hasil);
}

json_print($resp);
