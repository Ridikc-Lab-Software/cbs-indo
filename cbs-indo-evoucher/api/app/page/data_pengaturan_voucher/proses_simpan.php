<?php 
require_once('../../../include/all_include.php');

$id_pengaturan_voucher=isset($_POST["id_pengaturan_voucher"]) ? $_POST["id_pengaturan_voucher"]:"";
$nama=isset($_POST["nama"]) ? $_POST["nama"]:"";
$isi=isset($_POST["isi"]) ? $_POST["isi"]:"";
$status=isset($_POST["status"]) ? $_POST["status"]:"";


$query=mysql_query("insert into data_pengaturan_voucher values (
'$id_pengaturan_voucher'
,'$nama'
,'$isi'
,'$status'

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
