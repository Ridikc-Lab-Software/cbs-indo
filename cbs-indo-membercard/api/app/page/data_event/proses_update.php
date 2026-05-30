<?php 
require_once('../../../include/all_include.php');

$id_event=isset($_POST["id_event"]) ? $_POST["id_event"]:"";
$tanggal=isset($_POST["tanggal"]) ? $_POST["tanggal"]:"";
$judul=isset($_POST["judul"]) ? $_POST["judul"]:"";
$foto=isset($_POST["foto"]) ? $_POST["foto"]:"";
$isi=isset($_POST["isi"]) ? $_POST["isi"]:"";


$sql = "UPDATE data_event SET 
tanggal=?, 
judul=?, 
foto=?, 
isi=? 

WHERE id_event=?";

$stmt = $dbh->prepare($sql);
$stmt->execute([
$tanggal, 
$judul, 
$foto, 
$isi, 

$id_event]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>






