<?php 
require_once('../../../include/all_include.php');

$id_group_jenis_transaksi=isset($_POST["id_group_jenis_transaksi"]) ? $_POST["id_group_jenis_transaksi"]:"";
$nama_group=isset($_POST["nama_group"]) ? $_POST["nama_group"]:"";
$id_jenis_transaksi=isset($_POST["id_jenis_transaksi"]) ? $_POST["id_jenis_transaksi"]:"";
$gambar_logo=isset($_POST["gambar_logo"]) ? $_POST["gambar_logo"]:"";


$query=mysql_query("insert into data_group_jenis_transaksi values (
'$id_group_jenis_transaksi'
,'$nama_group'
,'$id_jenis_transaksi'
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




