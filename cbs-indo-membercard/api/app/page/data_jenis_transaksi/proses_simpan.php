<?php 
require_once('../../../include/all_include.php');

$id_jenis_transaksi=isset($_POST["id_jenis_transaksi"]) ? $_POST["id_jenis_transaksi"]:"";
$jenis_transaksi=isset($_POST["jenis_transaksi"]) ? $_POST["jenis_transaksi"]:"";
$gambar_logo=isset($_POST["gambar_logo"]) ? $_POST["gambar_logo"]:"";


$query=mysql_query("insert into data_jenis_transaksi values (
'$id_jenis_transaksi'
,'$jenis_transaksi'
,'$gambar_logo'

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




