<?php 
require_once('../../../include/all_include.php');
$id_plat=isset($_POST["id_plat"]) ? $_POST["id_plat"]:"";
$sql = "DELETE FROM data_plat WHERE id_plat=?";
$stmt = $dbh->prepare($sql);
$stmt->execute([$id_plat]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>