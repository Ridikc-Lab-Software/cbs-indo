<?php 
require_once('../../../include/all_include.php');

$id_member=isset($_POST["id_member"]) ? $_POST["id_member"]:"";
$nama=isset($_POST["nama"]) ? $_POST["nama"]:"";
$alamat=isset($_POST["alamat"]) ? $_POST["alamat"]:"";
$no_telepon=isset($_POST["no_telepon"]) ? $_POST["no_telepon"]:"";
$jenis_kelamin=isset($_POST["jenis_kelamin"]) ? $_POST["jenis_kelamin"]:"";
$tanggal_terdaftar=isset($_POST["tanggal_terdaftar"]) ? $_POST["tanggal_terdaftar"]:"";
$id_kategori_member=isset($_POST["id_kategori_member"]) ? $_POST["id_kategori_member"]:"";
$kode_rfid=isset($_POST["kode_rfid"]) ? $_POST["kode_rfid"]:"";
$point=isset($_POST["point"]) ? $_POST["point"]:"";
$username=isset($_POST["username"]) ? $_POST["username"]:"";
$password=isset($_POST["password"]) ? $_POST["password"]:"";


$sql = "UPDATE data_member SET 
nama=?, 
alamat=?, 
no_telepon=?, 
jenis_kelamin=?, 
tanggal_terdaftar=?, 
id_kategori_member=?, 
kode_rfid=?, 
point=?, 
username=?, 
password=? 

WHERE id_member=?";

$stmt = $dbh->prepare($sql);
$stmt->execute([
$nama, 
$alamat, 
$no_telepon, 
$jenis_kelamin, 
$tanggal_terdaftar, 
$id_kategori_member, 
$kode_rfid, 
$point, 
$username, 
$password, 

$id_member]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>






