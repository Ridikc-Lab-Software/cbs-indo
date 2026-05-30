<?php 
require_once('../../../include/all_include.php');
$id_petugas=isset($_POST["id_petugas"]) ? $_POST["id_petugas"]:"";
$sql = "DELETE FROM data_petugas WHERE id_petugas=?";
$stmt = $dbh->prepare($sql);
$stmt->execute([$id_petugas]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>


