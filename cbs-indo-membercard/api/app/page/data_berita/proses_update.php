<?php 
require_once('../../../include/all_include.php');

$id_berita=isset($_POST["id_berita"]) ? $_POST["id_berita"]:"";
$tanggal=isset($_POST["tanggal"]) ? $_POST["tanggal"]:"";
$judul=isset($_POST["judul"]) ? $_POST["judul"]:"";
$foto=isset($_POST["foto"]) ? $_POST["foto"]:"";
$isi=isset($_POST["isi"]) ? $_POST["isi"]:"";


$sql = "UPDATE data_berita SET 
tanggal=?, 
judul=?, 
foto=?, 
isi=? 

WHERE id_berita=?";

$stmt = $dbh->prepare($sql);
$stmt->execute([
$tanggal, 
$judul, 
$foto, 
$isi, 

$id_berita]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>






