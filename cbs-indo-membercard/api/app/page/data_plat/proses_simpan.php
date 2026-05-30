<?php 
require_once('../../../include/all_include.php');

$id_plat = isset($_POST["id_plat"]) ? $_POST["id_plat"]:"";
$plat=isset($_POST["plat"]) ? $_POST["plat"]:"";
$id_relasi=isset($_POST["id_relasi"]) ? $_POST["id_relasi"]:"";



$query=mysql_query("insert into data_plat values (
'$id_plat'
,'$plat'
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
