<?php 
require_once('../../../include/all_include.php');

$id_jenis_transaksi=isset($_POST["id_jenis_transaksi"]) ? $_POST["id_jenis_transaksi"]:"";
$jenis_transaksi=isset($_POST["jenis_transaksi"]) ? $_POST["jenis_transaksi"]:"";
$gambar_logo=isset($_POST["gambar_logo"]) ? $_POST["gambar_logo"]:"";


$sql = "UPDATE data_jenis_transaksi SET 
jenis_transaksi=?, 
gambar_logo=? 

WHERE id_jenis_transaksi=?";

$stmt = $dbh->prepare($sql);
$stmt->execute([
$jenis_transaksi, 
$gambar_logo, 

$id_jenis_transaksi]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>






