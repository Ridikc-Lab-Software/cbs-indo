<?php 
require_once('../../../include/all_include.php');
$id_member=isset($_POST["id_member"]) ? $_POST["id_member"]:"";
$sql = "DELETE FROM data_member WHERE id_member=?";
$stmt = $dbh->prepare($sql);
$stmt->execute([$id_member]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>


