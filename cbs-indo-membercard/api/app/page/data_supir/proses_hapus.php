<?php 
require_once('../../../include/all_include.php');
$id_supir=isset($_POST["id_supir"]) ? $_POST["id_supir"]:"";
$sql = "DELETE FROM data_supir WHERE id_supir=?";
$stmt = $dbh->prepare($sql);
$stmt->execute([$id_supir]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>
