<?php 
require_once('../../../include/all_include.php');

$id_transaksi_voucher=isset($_POST["id_transaksi_voucher"]) ? $_POST["id_transaksi_voucher"]:"";
$id_voucher=isset($_POST["id_voucher"]) ? $_POST["id_voucher"]:"";
$id_member=isset($_POST["id_member"]) ? $_POST["id_member"]:"";
$nama_member=isset($_POST["nama_member"]) ? $_POST["nama_member"]:"";
$tanggal_transaksi=isset($_POST["tanggal_transaksi"]) ? $_POST["tanggal_transaksi"]:"";
$jenis_bbm=isset($_POST["jenis_bbm"]) ? $_POST["jenis_bbm"]:"";
$nominal=isset($_POST["nominal"]) ? $_POST["nominal"]:"";


$sql = "UPDATE data_transaksi_voucher SET 
id_voucher=?,
id_member=?,
nama_member=?,
tanggal_transaksi=?,
jenis_bbm=?,
nominal=?,

WHERE id_transaksi_voucher=?";

$stmt = $dbh->prepare($sql);
$stmt->execute([
$id_voucher,
$id_member,
$nama_member,
$tanggal_transaksi,
$jenis_bbm,
$nominal,

$id_transaksi_voucher]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>
