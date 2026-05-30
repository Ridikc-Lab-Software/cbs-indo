<?php 
require_once('../../../include/all_include.php');

$id_kategori_member=isset($_POST["id_kategori_member"]) ? $_POST["id_kategori_member"]:"";
$kategori_member=isset($_POST["kategori_member"]) ? $_POST["kategori_member"]:"";
$gambar_logo=isset($_POST["gambar_logo"]) ? $_POST["gambar_logo"]:"";
$maksimal_transaksi=isset($_POST["maksimal_transaksi"]) ? $_POST["maksimal_transaksi"]:"";


$query=mysql_query("insert into data_kategori_member values (
'$id_kategori_member'
,'$kategori_member'
,'$gambar_logo'
,'$maksimal_transaksi'

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
