<?php 
require_once('../../../include/all_include.php');

$id_galery=isset($_POST["id_galery"]) ? $_POST["id_galery"]:"";
$tanggal=isset($_POST["tanggal"]) ? $_POST["tanggal"]:"";
$judul=isset($_POST["judul"]) ? $_POST["judul"]:"";
$foto=isset($_POST["foto"]) ? $_POST["foto"]:"";
$isi=isset($_POST["isi"]) ? $_POST["isi"]:"";


$sql = "UPDATE data_galery SET 
tanggal=?, 
judul=?, 
foto=?, 
isi=? 

WHERE id_galery=?";

$stmt = $dbh->prepare($sql);
$stmt->execute([
$tanggal, 
$judul, 
$foto, 
$isi, 

$id_galery]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>






