<?php

require_once('../../../include/all_include.php');

$resp     = [];
$resp["status"] = "success";
$resp["result"] = array();

$query = "SELECT * FROM data_jenis_transaksi";
$proses = mysql_query($query);

$maksimal_transaksi = 100000000;

while ($data = mysql_fetch_array($proses)) {

    $id_jenis_transaksi = $data["jenis_transaksi"];

    $hasil['id_jenis_transaksi'] = $id_jenis_transaksi . "|" . $data["point"] . "|" . $data["harga"] . "|" . $maksimal_transaksi;
    $hasil['jenis_transaksi'] = "<h3>" . $data["jenis_transaksi"] . "</h3>Penambahan 0 point /Liter";
    $hasil['gambar_logo']     = $data["gambar_logo"];

    array_push($resp["result"], $hasil);
}

json_print($resp);
