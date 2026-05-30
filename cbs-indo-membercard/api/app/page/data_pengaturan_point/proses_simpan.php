<?php 
require_once('../../../include/all_include.php');

$id_pengaturan_point=isset($_POST["id_pengaturan_point"]) ? $_POST["id_pengaturan_point"]:"";
$nama_pengaturan=isset($_POST["nama_pengaturan"]) ? $_POST["nama_pengaturan"]:"";
$id_kategori_member=isset($_POST["id_kategori_member"]) ? $_POST["id_kategori_member"]:"";
$id_jenis_transaksi=isset($_POST["id_jenis_transaksi"]) ? $_POST["id_jenis_transaksi"]:"";
$point=isset($_POST["point"]) ? $_POST["point"]:"";


$query=mysql_query("insert into data_pengaturan_point values (
'$id_pengaturan_point'
,'$nama_pengaturan'
,'$id_kategori_member'
,'$id_jenis_transaksi'
,'$point'

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




