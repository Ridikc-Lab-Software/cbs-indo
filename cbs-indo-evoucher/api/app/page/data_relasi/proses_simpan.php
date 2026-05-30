<?php 
require_once('../../../include/all_include.php');

$id_relasi=isset($_POST["id_relasi"]) ? $_POST["id_relasi"]:"";
$nama=isset($_POST["nama"]) ? $_POST["nama"]:"";
$nomor_telepon=isset($_POST["nomor_telepon"]) ? $_POST["nomor_telepon"]:"";
$email=isset($_POST["email"]) ? $_POST["email"]:"";
$alamat=isset($_POST["alamat"]) ? $_POST["alamat"]:"";
$id_spbu=isset($_POST["id_spbu"]) ? $_POST["id_spbu"]:"";
$nama_spbu=isset($_POST["nama_spbu"]) ? $_POST["nama_spbu"]:"";
$password=isset($_POST["password"]) ? $_POST["password"]:"";


$query=mysql_query("insert into data_relasi values (
'$id_relasi'
,'$nama'
,'$nomor_telepon'
,'$email'
,'$alamat'
,'$id_spbu'
,'$nama_spbu'
,'$password'

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
