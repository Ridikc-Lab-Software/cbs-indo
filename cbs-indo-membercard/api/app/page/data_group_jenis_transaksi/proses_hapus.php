<?php 
require_once('../../../include/all_include.php');
$id_group_jenis_transaksi=isset($_POST["id_group_jenis_transaksi"]) ? $_POST["id_group_jenis_transaksi"]:"";
$sql = "DELETE FROM data_group_jenis_transaksi WHERE id_group_jenis_transaksi=?";
$stmt = $dbh->prepare($sql);
$stmt->execute([$id_group_jenis_transaksi]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>


