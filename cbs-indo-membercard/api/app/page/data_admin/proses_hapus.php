<?php 
require_once('../../../include/all_include.php');
$id_admin=isset($_POST["id_admin"]) ? $_POST["id_admin"]:"";
$sql = "DELETE FROM data_admin WHERE id_admin=?";
$stmt = $dbh->prepare($sql);
$stmt->execute([$id_admin]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>


