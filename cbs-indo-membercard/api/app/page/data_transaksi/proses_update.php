<?php 
require_once('../../../include/all_include.php');

$id_transaksi=isset($_POST["id_transaksi"]) ? $_POST["id_transaksi"]:"";
$tanggal=isset($_POST["tanggal"]) ? $_POST["tanggal"]:"";
$jam=isset($_POST["jam"]) ? $_POST["jam"]:"";
$id_member=isset($_POST["id_member"]) ? $_POST["id_member"]:"";
$id_petugas=isset($_POST["id_petugas"]) ? $_POST["id_petugas"]:"";
$id_kategori_member=isset($_POST["id_kategori_member"]) ? $_POST["id_kategori_member"]:"";
$id_jenis_transaksi=isset($_POST["id_jenis_transaksi"]) ? $_POST["id_jenis_transaksi"]:"";
$point=isset($_POST["point"]) ? $_POST["point"]:"";
$jumlah=isset($_POST["jumlah"]) ? $_POST["jumlah"]:"";


$sql = "UPDATE data_transaksi SET 
tanggal=?, 
jam=?, 
id_member=?, 
id_petugas=?, 
id_kategori_member=?, 
id_jenis_transaksi=?, 
point=?, 
jumlah=? 

WHERE id_transaksi=?";

$stmt = $dbh->prepare($sql);
$stmt->execute([
$tanggal, 
$jam, 
$id_member, 
$id_petugas, 
$id_kategori_member, 
$id_jenis_transaksi, 
$point, 
$jumlah, 

$id_transaksi]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>











