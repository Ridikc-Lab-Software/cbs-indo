<?php
require_once('../../../include/all_include.php');

if (isset($_POST['isi']) && !empty($_POST['isi'])) {
	$resp = [];
	$resp["status"] = "success";
	$resp["result"] = array();

	$kategori_member = $_POST['isi'];

	$maksimal_transaksi = baca_database("", "maksimal_transaksi", "select * from data_kategori_member where kategori_member='$kategori_member'");

	$id_kategori_member = baca_database("", "id_kategori_member", "select * from data_kategori_member where kategori_member='$kategori_member'");


	$query = "select * from data_jenis_transaksi,data_pengaturan_jenis_transaksi where data_jenis_transaksi.id_jenis_transaksi = data_pengaturan_jenis_transaksi.id_jenis_transaksi 
and data_pengaturan_jenis_transaksi.id_kategori_member = '$id_kategori_member'";
	$proses = mysql_query($query);
	while ($data = mysql_fetch_array($proses)) {


		$id_jenis_transaksi = $data["jenis_transaksi"];

		$judul = "|        MEMBERCARD PT.CBS";
		$nospbu = "|SPBU 24.37327";
		$alamat1 = "|Jl. Lintas Sumatera, Bernai, ";
		$alamat2 = "|Sarolangun, Jambi 37481 ";
		$telepon = "|Telp. 085347234874";
		$waktu = "|08 February 2021";
		$website1 = "|Informasi Point ";
		$website2 = "|www.membercard.cbs-indo.com ";
		$footer = "|TERIMAKASIH DAN SELAMAT JALAN.";


		$hasil['id_jenis_transaksi'] = $id_jenis_transaksi . "|" . $data["point"] . "|" . $data["harga"] . "|" . $maksimal_transaksi;
		$hasil['jenis_transaksi'] = "<h3>" . $data["jenis_transaksi"] . "</h3>Penambahan " . ($data["point"]) . " point /Liter";
		$hasil['gambar_logo'] = $data["gambar_logo"];

		array_push($resp["result"], $hasil);
	}

	json_print($resp);
} else {
	$resp = [];
	$resp["status"] = "success";
	$resp["result"] = array();

	$query = "SELECT * FROM data_jenis_transaksi";
	$proses = mysql_query($query);

	$maksimal_transaksi = 100000000;

	while ($data = mysql_fetch_array($proses)) {

		$id_jenis_transaksi = $data["jenis_transaksi"];

		$hasil['id_jenis_transaksi'] = $id_jenis_transaksi . "|" . $data["point"] . "|" . $data["harga"] . "|" . $maksimal_transaksi;
		$hasil['jenis_transaksi'] = "<h3>" . $data["jenis_transaksi"] . "</h3> Harga Rp" . number_format($data["harga"], 0, ",", ".") . " /liter";
		$hasil['gambar_logo'] = $data["gambar_logo"];

		array_push($resp["result"], $hasil);
	}

	json_print($resp);

}

?>