<?php 
require_once('../../../include/all_include.php');

$id_spbu=isset($_POST["id_spbu"]) ? $_POST["id_spbu"]:"";
$nama_spbu=isset($_POST["nama_spbu"]) ? $_POST["nama_spbu"]:"";
$alamat1=isset($_POST["alamat1"]) ? $_POST["alamat1"]:"";
$alamat2=isset($_POST["alamat2"]) ? $_POST["alamat2"]:"";
$telepon=isset($_POST["telepon"]) ? $_POST["telepon"]:"";
$penutup=isset($_POST["penutup"]) ? $_POST["penutup"]:"";


$sql = "UPDATE data_spbu SET 
nama_spbu=?,
alamat1=?,
alamat2=?,
telepon=?,
penutup=?,

WHERE id_spbu=?";

$stmt = $dbh->prepare($sql);
$stmt->execute([
$nama_spbu,
$alamat1,
$alamat2,
$telepon,
$penutup,

$id_spbu]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>
