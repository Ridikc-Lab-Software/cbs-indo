<?php 
require_once('../../../include/all_include.php');

$id_promo=isset($_POST["id_promo"]) ? $_POST["id_promo"]:"";
$tanggal_mulai_berlaku=isset($_POST["tanggal_mulai_berlaku"]) ? $_POST["tanggal_mulai_berlaku"]:"";
$tanggal_batas_berlaku=isset($_POST["tanggal_batas_berlaku"]) ? $_POST["tanggal_batas_berlaku"]:"";
$nama_promo=isset($_POST["nama_promo"]) ? $_POST["nama_promo"]:"";
$keterangan=isset($_POST["keterangan"]) ? $_POST["keterangan"]:"";
$syarat_dan_ketentuan=isset($_POST["syarat_dan_ketentuan"]) ? $_POST["syarat_dan_ketentuan"]:"";
$foto_promo=isset($_POST["foto_promo"]) ? $_POST["foto_promo"]:"";
$jumlah_point=isset($_POST["jumlah_point"]) ? $_POST["jumlah_point"]:"";
$status=isset($_POST["status"]) ? $_POST["status"]:"";


$query=mysql_query("insert into data_promo values (
'$id_promo'
,'$tanggal_mulai_berlaku'
,'$tanggal_batas_berlaku'
,'$nama_promo'
,'$keterangan'
,'$syarat_dan_ketentuan'
,'$foto_promo'
,'$jumlah_point'
,'$status'

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




