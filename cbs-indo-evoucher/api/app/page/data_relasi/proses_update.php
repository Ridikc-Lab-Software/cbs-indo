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


$sql = "UPDATE data_relasi SET 
nama=?,
nomor_telepon=?,
email=?,
alamat=?,
id_spbu=?,
nama_spbu=?,
password=?,

WHERE id_relasi=?";

$stmt = $dbh->prepare($sql);
$stmt->execute([
$nama,
$nomor_telepon,
$email,
$alamat,
$id_spbu,
$nama_spbu,
$password,

$id_relasi]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>
