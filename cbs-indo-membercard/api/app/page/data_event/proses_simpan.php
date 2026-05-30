<?php 
require_once('../../../include/all_include.php');

$id_event=isset($_POST["id_event"]) ? $_POST["id_event"]:"";
$tanggal=isset($_POST["tanggal"]) ? $_POST["tanggal"]:"";
$judul=isset($_POST["judul"]) ? $_POST["judul"]:"";
$foto=isset($_POST["foto"]) ? $_POST["foto"]:"";
$isi=isset($_POST["isi"]) ? $_POST["isi"]:"";


$query=mysql_query("insert into data_event values (
'$id_event'
,'$tanggal'
,'$judul'
,'$foto'
,'$isi'

)");

$resp = [];
if($query){
	$resp["status"]="success";
}
else
{
	$resp["status"]="gagal";
}

echo (json_encode($resp)) 
?>




