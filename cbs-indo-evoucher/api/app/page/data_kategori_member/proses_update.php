<?php 
require_once('../../../include/all_include.php');

$id_kategori_member=isset($_POST["id_kategori_member"]) ? $_POST["id_kategori_member"]:"";
$kategori_member=isset($_POST["kategori_member"]) ? $_POST["kategori_member"]:"";
$gambar_logo=isset($_POST["gambar_logo"]) ? $_POST["gambar_logo"]:"";
$maksimal_transaksi=isset($_POST["maksimal_transaksi"]) ? $_POST["maksimal_transaksi"]:"";


$sql = "UPDATE data_kategori_member SET 
kategori_member=?,
gambar_logo=?,
maksimal_transaksi=?,

WHERE id_kategori_member=?";

$stmt = $dbh->prepare($sql);
$stmt->execute([
$kategori_member,
$gambar_logo,
$maksimal_transaksi,

$id_kategori_member]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>
