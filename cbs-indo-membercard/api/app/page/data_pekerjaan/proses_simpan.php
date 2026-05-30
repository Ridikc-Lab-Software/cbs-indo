<?php 
require_once('../../../include/all_include.php');

$id_pekerjaan=isset($_POST["id_pekerjaan"]) ? $_POST["id_pekerjaan"]:"";
$nama=isset($_POST["nama"]) ? $_POST["nama"]:"";


$query=mysql_query("insert into data_pekerjaan values (
'$id_pekerjaan'
,'$nama'

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
