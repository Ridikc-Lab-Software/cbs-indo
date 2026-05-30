<?php 
require_once('../../../include/all_include.php');

$id_galery=isset($_POST["id_galery"]) ? $_POST["id_galery"]:"";
$tanggal=isset($_POST["tanggal"]) ? $_POST["tanggal"]:"";
$judul=isset($_POST["judul"]) ? $_POST["judul"]:"";
$foto=isset($_POST["foto"]) ? $_POST["foto"]:"";
$isi=isset($_POST["isi"]) ? $_POST["isi"]:"";


$query=mysql_query("insert into data_galery values (
'$id_galery'
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




