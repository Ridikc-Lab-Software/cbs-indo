<?php 
require_once('../../../include/all_include.php');

$id_kategori_member=isset($_POST["id_kategori_member"]) ? $_POST["id_kategori_member"]:"";
$kategori_member=isset($_POST["kategori_member"]) ? $_POST["kategori_member"]:"";
$gambar_logo=isset($_POST["gambar_logo"]) ? $_POST["gambar_logo"]:"";


$query=mysql_query("insert into data_kategori_member values (
'$id_kategori_member'
,'$kategori_member'
,'$gambar_logo'

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




