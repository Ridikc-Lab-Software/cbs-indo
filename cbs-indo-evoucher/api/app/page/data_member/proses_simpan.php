<?php 
require_once('../../../include/all_include.php');

$id_member=isset($_POST["id_member"]) ? $_POST["id_member"]:"";
$nik=isset($_POST["nik"]) ? $_POST["nik"]:"";
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
$tanggal_lahir=isset($_POST["tanggal_lahir"]) ? $_POST["tanggal_lahir"]:"";
$agama=isset($_POST["agama"]) ? $_POST["agama"]:"";
$status_perkawinan=isset($_POST["status_perkawinan"]) ? $_POST["status_perkawinan"]:"";
$id_pekerjaan=isset($_POST["id_pekerjaan"]) ? $_POST["id_pekerjaan"]:"";
$id_admin=isset($_POST["id_admin"]) ? $_POST["id_admin"]:"";
$spbu=isset($_POST["spbu"]) ? $_POST["spbu"]:"";


$query=mysql_query("insert into data_member values (
'$id_member'
,'$nik'
,'$nama'
,'$alamat'
,'$no_telepon'
,'$jenis_kelamin'
,'$tanggal_terdaftar'
,'$id_kategori_member'
,'$kode_rfid'
,'$point'
,'$username'
,'$password'
,'$tanggal_lahir'
,'$agama'
,'$status_perkawinan'
,'$id_pekerjaan'
,'$id_admin'
,'$spbu'

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
