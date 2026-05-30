<?php 
require_once('../../../include/all_include.php');
$id_redeem=isset($_POST["id_redeem"]) ? $_POST["id_redeem"]:"";
$sql = "DELETE FROM data_redeem WHERE id_redeem=?";
$stmt = $dbh->prepare($sql);
$stmt->execute([$id_redeem]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>


