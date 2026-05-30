<?php 
require_once('../../../include/all_include.php');
$id_kategori_member=isset($_POST["id_kategori_member"]) ? $_POST["id_kategori_member"]:"";
$sql = "DELETE FROM data_kategori_member WHERE id_kategori_member=?";
$stmt = $dbh->prepare($sql);
$stmt->execute([$id_kategori_member]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>


