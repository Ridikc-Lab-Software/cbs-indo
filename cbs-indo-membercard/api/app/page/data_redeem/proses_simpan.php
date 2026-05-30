<?php 
require_once('../../../include/all_include.php');

$jumlah=isset($_POST["id_redeem"]) ? $_POST["id_redeem"]:"";
$redeem_value=isset($_POST["tanggal"]) ? $_POST["tanggal"]:"";
$jam=isset($_POST["jam"]) ? $_POST["jam"]:"";
$id_member=isset($_POST["id_member"]) ? $_POST["id_member"]:"";
$id_mitra=isset($_POST["id_mitra"]) ? $_POST["id_mitra"]:"";
$id_promo=isset($_POST["id_promo"]) ? $_POST["id_promo"]:"";
$point=isset($_POST["point"]) ? $_POST["point"]:"";
$id_petugas=isset($_POST["status"]) ? $_POST["status"]:"";

$id_redeem = id_otomatis("data_redeem","id_redeem","10");
$tanggal = date('Y-m-d');

$query=mysql_query("insert into data_redeem values (
'$id_redeem'
,'$tanggal'
,'$jam'
,'$id_member'
,'$id_mitra'
,'$id_promo'
,'$point'
,'$jumlah'
,$redeem_value
,'$id_petugas'

)");


$point_awal = baca_database("","point","select * from data_member where id_member='$id_member'");
$sisa_point = $point_awal - ($point * $jumlah) ;

if ($sisa_point<0)
{
$gagal = "ya";
}
else
{
	$gagal = "tidak";
	$sql = "UPDATE data_member SET 
	point=?
	WHERE id_member=?";
	
	$stmt = $dbh->prepare($sql);
	$stmt->execute([
	$sisa_point,
	$id_member]);
}





$resp = [];
if ($gagal == "ya")
{
	$resp["status"]="gagal";
}
else
{
if($query){
	$resp["status"]="success";
	
}
else
{
	$resp["status"]="gagal";
	
}
}


echo (json_encode($resp));


?>




