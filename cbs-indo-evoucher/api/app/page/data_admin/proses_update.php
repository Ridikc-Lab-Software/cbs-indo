<?php 
require_once('../../../include/all_include.php');

$id_admin=isset($_POST["id_admin"]) ? $_POST["id_admin"]:"";
$hak_akses=isset($_POST["hak_akses"]) ? $_POST["hak_akses"]:"";
$username=isset($_POST["username"]) ? $_POST["username"]:"";
$password=isset($_POST["password"]) ? $_POST["password"]:"";
$nama_spbu=isset($_POST["nama_spbu"]) ? $_POST["nama_spbu"]:"";


$sql = "UPDATE data_admin SET 
hak_akses=?,
username=?,
password=?,
nama_spbu=?,

WHERE id_admin=?";

$stmt = $dbh->prepare($sql);
$stmt->execute([
$hak_akses,
$username,
$password,
$nama_spbu,

$id_admin]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>
