<?php 
require_once('../../../include/all_include.php');

$id_admin=isset($_POST["id_admin"]) ? $_POST["id_admin"]:"";
$password=isset($_POST["password"]) ? $_POST["password"]:"";


$query=mysql_query("insert into data_admin values (
'$id_admin'
,'$password'

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




