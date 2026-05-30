<?php 
require_once('../../../include/all_include.php');
$id_event=isset($_POST["id_event"]) ? $_POST["id_event"]:"";
$sql = "DELETE FROM data_event WHERE id_event=?";
$stmt = $dbh->prepare($sql);
$stmt->execute([$id_event]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>


