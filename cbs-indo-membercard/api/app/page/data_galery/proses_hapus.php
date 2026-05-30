<?php 
require_once('../../../include/all_include.php');
$id_galery=isset($_POST["id_galery"]) ? $_POST["id_galery"]:"";
$sql = "DELETE FROM data_galery WHERE id_galery=?";
$stmt = $dbh->prepare($sql);
$stmt->execute([$id_galery]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>


