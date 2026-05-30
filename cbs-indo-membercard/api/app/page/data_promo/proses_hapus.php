<?php 
require_once('../../../include/all_include.php');
$id_promo=isset($_POST["id_promo"]) ? $_POST["id_promo"]:"";
$sql = "DELETE FROM data_promo WHERE id_promo=?";
$stmt = $dbh->prepare($sql);
$stmt->execute([$id_promo]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>


