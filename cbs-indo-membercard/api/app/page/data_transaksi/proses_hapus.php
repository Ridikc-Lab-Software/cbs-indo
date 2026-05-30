<?php 
require_once('../../../include/all_include.php');
$id_transaksi=isset($_POST["id_transaksi"]) ? $_POST["id_transaksi"]:"";
$sql = "DELETE FROM data_transaksi WHERE id_transaksi=?";
$stmt = $dbh->prepare($sql);
$stmt->execute([$id_transaksi]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>



