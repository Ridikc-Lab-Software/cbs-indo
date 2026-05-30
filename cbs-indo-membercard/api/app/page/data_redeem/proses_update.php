<?php 
require_once('../../../include/all_include.php');

$id_redeem=isset($_POST["id_redeem"]) ? $_POST["id_redeem"]:"";
$tanggal=isset($_POST["tanggal"]) ? $_POST["tanggal"]:"";
$jam=isset($_POST["jam"]) ? $_POST["jam"]:"";
$id_member=isset($_POST["id_member"]) ? $_POST["id_member"]:"";
$id_mitra=isset($_POST["id_mitra"]) ? $_POST["id_mitra"]:"";
$id_promo=isset($_POST["id_promo"]) ? $_POST["id_promo"]:"";
$point=isset($_POST["point"]) ? $_POST["point"]:"";
$status=isset($_POST["status"]) ? $_POST["status"]:"";


$sql = "UPDATE data_redeem SET 
tanggal=?, 
jam=?, 
id_member=?, 
id_mitra=?, 
id_promo=?, 
point=?, 
status=? 

WHERE id_redeem=?";

$stmt = $dbh->prepare($sql);
$stmt->execute([
$tanggal, 
$jam, 
$id_member, 
$id_mitra, 
$id_promo, 
$point, 
$status, 

$id_redeem]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>






