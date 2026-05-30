<?php 



require_once('../../../include/all_include.php');

$id_supir=isset($_POST["id_supir"]) ? $_POST["id_supir"]:"";
$nama_supir=isset($_POST["nama_supir"]) ? $_POST["nama_supir"]:"";
$id_relasi=isset($_POST["id_relasi"]) ? $_POST["id_relasi"]:"";


$query=mysql_query("insert into data_supir values (
'$id_supir'
,'$nama_supir'
,'$id_relasi'

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
,'$jenis_bbm'
,'$nominal'

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
