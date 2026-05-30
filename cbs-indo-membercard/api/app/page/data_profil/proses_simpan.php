<?php 
require_once('../../../include/all_include.php');

$id_profil=isset($_POST["id_profil"]) ? $_POST["id_profil"]:"";
$nama=isset($_POST["nama"]) ? $_POST["nama"]:"";
$alamat=isset($_POST["alamat"]) ? $_POST["alamat"]:"";
$no_telepon=isset($_POST["no_telepon"]) ? $_POST["no_telepon"]:"";
$sejarah=isset($_POST["sejarah"]) ? $_POST["sejarah"]:"";
$visi=isset($_POST["visi"]) ? $_POST["visi"]:"";
$misi=isset($_POST["misi"]) ? $_POST["misi"]:"";
$deskripsi=isset($_POST["deskripsi"]) ? $_POST["deskripsi"]:"";
$foto=isset($_POST["foto"]) ? $_POST["foto"]:"";


$query=mysql_query("insert into data_profil values (
'$id_profil'
,'$nama'
,'$alamat'
,'$no_telepon'
,'$sejarah'
,'$visi'
,'$misi'
,'$deskripsi'
,'$foto'

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




