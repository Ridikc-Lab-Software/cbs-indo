<?php 
require_once('../../../include/all_include.php');

$id_plat = isset($_POST["id_plat"]) ? $_POST["id_plat"]:"";
$plat=isset($_POST["plat"]) ? $_POST["plat"]:"";
$id_relasi=isset($_POST["id_relasi"]) ? $_POST["id_relasi"]:"";


$sql = "UPDATE data_plat SET 
plat=?,
id_relasi=?
WHERE id_plat=?";

$stmt = $dbh->prepare($sql);
$stmt->execute([
$plat,
$id_relasi,
$id_plat]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>
