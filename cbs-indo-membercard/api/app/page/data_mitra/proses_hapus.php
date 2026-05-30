<?php 
require_once('../../../include/all_include.php');
$id_mitra=isset($_POST["id_mitra"]) ? $_POST["id_mitra"]:"";
$sql = "DELETE FROM data_mitra WHERE id_mitra=?";
$stmt = $dbh->prepare($sql);
$stmt->execute([$id_mitra]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>


