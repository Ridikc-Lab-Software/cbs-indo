<?php 
require_once('../../../include/all_include.php');

$id_voucher=isset($_POST["id_voucher"]) ? $_POST["id_voucher"]:"";
$qrcode=isset($_POST["qrcode"]) ? $_POST["qrcode"]:"";
$id_relasi=isset($_POST["id_relasi"]) ? $_POST["id_relasi"]:"";
$nominal=isset($_POST["nominal"]) ? $_POST["nominal"]:"";
$tanggal_kadaluarsa=isset($_POST["tanggal_kadaluarsa"]) ? $_POST["tanggal_kadaluarsa"]:"";
$id_spbu=isset($_POST["id_spbu"]) ? $_POST["id_spbu"]:"";
$id_penjualan_voucher=isset($_POST["id_penjualan_voucher"]) ? $_POST["id_penjualan_voucher"]:"";
$status=isset($_POST["status"]) ? $_POST["status"]:"";
$file_voucher=isset($_POST["file_voucher"]) ? $_POST["file_voucher"]:"";
$tanggal_dibuka=isset($_POST["tanggal_dibuka"]) ? $_POST["tanggal_dibuka"]:"";


$query=mysql_query("insert into data_voucher values (
'$id_voucher'
,'$qrcode'
,'$id_relasi'
,'$nominal'
,'$tanggal_kadaluarsa'
,'$id_spbu'
,'$id_penjualan_voucher'
,'$status'
,'$file_voucher'
,'$tanggal_dibuka'

)");

$resp = [];
if($query){
	$resp["status"]="success";
}
else
{
	$resp["status"]="gagal";
}

echo (json_encode($resp)) 
?>
