<?php 
require_once('../../../include/all_include.php');

$id_supir=isset($_POST["id_supir"]) ? $_POST["id_supir"]:"";
$nama_supir=isset($_POST["nama_supir"]) ? $_POST["nama_supir"]:"";
$id_relasi=isset($_POST["id_relasi"]) ? $_POST["id_relasi"]:"";

$sql = "UPDATE data_supir SET 
id_supir=?,
nama_supir=?,
id_relasi=?
WHERE id_supir=?";

$stmt = $dbh->prepare($sql);
$stmt->execute([
$id_supir,
$nama_supir,
$id_relasi,
$id_supir]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>
