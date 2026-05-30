<?php 
require_once('../../../include/all_include.php');

$id_petugas=isset($_POST["id_petugas"]) ? $_POST["id_petugas"]:"";
$nama=isset($_POST["nama"]) ? $_POST["nama"]:"";
$alamat=isset($_POST["alamat"]) ? $_POST["alamat"]:"";
$no_telepon=isset($_POST["no_telepon"]) ? $_POST["no_telepon"]:"";
$jenis_kelamin=isset($_POST["jenis_kelamin"]) ? $_POST["jenis_kelamin"]:"";
$username=isset($_POST["username"]) ? $_POST["username"]:"";
$password=isset($_POST["password"]) ? $_POST["password"]:"";


$query=mysql_query("insert into data_petugas values (
'$id_petugas'
,'$nama'
,'$alamat'
,'$no_telepon'
,'$jenis_kelamin'
,'$username'
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




