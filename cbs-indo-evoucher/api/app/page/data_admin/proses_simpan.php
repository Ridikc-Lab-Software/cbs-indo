<?php 
require_once('../../../include/all_include.php');

$id_admin=isset($_POST["id_admin"]) ? $_POST["id_admin"]:"";
$hak_akses=isset($_POST["hak_akses"]) ? $_POST["hak_akses"]:"";
$username=isset($_POST["username"]) ? $_POST["username"]:"";
$password=isset($_POST["password"]) ? $_POST["password"]:"";
$nama_spbu=isset($_POST["nama_spbu"]) ? $_POST["nama_spbu"]:"";


$query=mysql_query("insert into data_admin values (
'$id_admin'
,'$hak_akses'
,'$username'
,'$password'
,'$nama_spbu'

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
