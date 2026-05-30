<?php 
require_once('../../../include/all_include.php');

$id_mitra=isset($_POST["id_mitra"]) ? $_POST["id_mitra"]:"";
$nama_mitra=isset($_POST["nama_mitra"]) ? $_POST["nama_mitra"]:"";
$alamat=isset($_POST["alamat"]) ? $_POST["alamat"]:"";
$no_telepon=isset($_POST["no_telepon"]) ? $_POST["no_telepon"]:"";
$nama_pemilik=isset($_POST["nama_pemilik"]) ? $_POST["nama_pemilik"]:"";
$no_telepon_pemilik=isset($_POST["no_telepon_pemilik"]) ? $_POST["no_telepon_pemilik"]:"";
$tanggal_daftar=isset($_POST["tanggal_daftar"]) ? $_POST["tanggal_daftar"]:"";
$username=isset($_POST["username"]) ? $_POST["username"]:"";
$password=isset($_POST["password"]) ? $_POST["password"]:"";
$status=isset($_POST["status"]) ? $_POST["status"]:"";
$gambar_logo=isset($_POST["gambar_logo"]) ? $_POST["gambar_logo"]:"";


$sql = "UPDATE data_mitra SET 
nama_mitra=?, 
alamat=?, 
no_telepon=?, 
nama_pemilik=?, 
no_telepon_pemilik=?, 
tanggal_daftar=?, 
username=?, 
password=?, 
status=?, 
gambar_logo=? 

WHERE id_mitra=?";

$stmt = $dbh->prepare($sql);
$stmt->execute([
$nama_mitra, 
$alamat, 
$no_telepon, 
$nama_pemilik, 
$no_telepon_pemilik, 
$tanggal_daftar, 
$username, 
$password, 
$status, 
$gambar_logo, 

$id_mitra]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>






