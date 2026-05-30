<?php 
require_once('../../../include/all_include.php');
$id_pengaturan_point=isset($_POST["id_pengaturan_point"]) ? $_POST["id_pengaturan_point"]:"";
$sql = "DELETE FROM data_pengaturan_point WHERE id_pengaturan_point=?";
$stmt = $dbh->prepare($sql);
$stmt->execute([$id_pengaturan_point]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>


