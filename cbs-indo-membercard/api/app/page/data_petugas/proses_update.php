<?php 
require_once('../../../include/all_include.php');

$id_petugas=isset($_POST["id_petugas"]) ? $_POST["id_petugas"]:"";
$nama=isset($_POST["nama"]) ? $_POST["nama"]:"";
$alamat=isset($_POST["alamat"]) ? $_POST["alamat"]:"";
$no_telepon=isset($_POST["no_telepon"]) ? $_POST["no_telepon"]:"";
$jenis_kelamin=isset($_POST["jenis_kelamin"]) ? $_POST["jenis_kelamin"]:"";
$username=isset($_POST["username"]) ? $_POST["username"]:"";
$password=isset($_POST["password"]) ? $_POST["password"]:"";


$sql = "UPDATE data_petugas SET 
nama=?, 
alamat=?, 
no_telepon=?, 
jenis_kelamin=?, 
username=?, 
password=? 

WHERE id_petugas=?";

$stmt = $dbh->prepare($sql);
$stmt->execute([
$nama, 
$alamat, 
$no_telepon, 
$jenis_kelamin, 
$username, 
$password, 

$id_petugas]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>






