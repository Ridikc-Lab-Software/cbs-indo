<?php 
require_once('../../../include/all_include.php');

$id_penjualan_voucher=isset($_POST["id_penjualan_voucher"]) ? $_POST["id_penjualan_voucher"]:"";
$tanggal_penjualan=isset($_POST["tanggal_penjualan"]) ? $_POST["tanggal_penjualan"]:"";
$id_relasi=isset($_POST["id_relasi"]) ? $_POST["id_relasi"]:"";
$jumlah_voucher=isset($_POST["jumlah_voucher"]) ? $_POST["jumlah_voucher"]:"";
$nominal=isset($_POST["nominal"]) ? $_POST["nominal"]:"";
$password_voucher=isset($_POST["password_voucher"]) ? $_POST["password_voucher"]:"";
$tanggal_dibuka=isset($_POST["tanggal_dibuka"]) ? $_POST["tanggal_dibuka"]:"";


$sql = "UPDATE data_penjualan_voucher SET 
tanggal_penjualan=?,
id_relasi=?,
jumlah_voucher=?,
nominal=?,
password_voucher=?,
tanggal_dibuka=?,

WHERE id_penjualan_voucher=?";

$stmt = $dbh->prepare($sql);
$stmt->execute([
$tanggal_penjualan,
$id_relasi,
$jumlah_voucher,
$nominal,
$password_voucher,
$tanggal_dibuka,

$id_penjualan_voucher]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>
