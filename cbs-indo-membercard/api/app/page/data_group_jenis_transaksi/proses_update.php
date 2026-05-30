<?php 
require_once('../../../include/all_include.php');

$id_group_jenis_transaksi=isset($_POST["id_group_jenis_transaksi"]) ? $_POST["id_group_jenis_transaksi"]:"";
$nama_group=isset($_POST["nama_group"]) ? $_POST["nama_group"]:"";
$id_jenis_transaksi=isset($_POST["id_jenis_transaksi"]) ? $_POST["id_jenis_transaksi"]:"";
$gambar_logo=isset($_POST["gambar_logo"]) ? $_POST["gambar_logo"]:"";


$sql = "UPDATE data_group_jenis_transaksi SET 
nama_group=?, 
id_jenis_transaksi=?, 
gambar_logo=? 

WHERE id_group_jenis_transaksi=?";

$stmt = $dbh->prepare($sql);
$stmt->execute([
$nama_group, 
$id_jenis_transaksi, 
$gambar_logo, 

$id_group_jenis_transaksi]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>






