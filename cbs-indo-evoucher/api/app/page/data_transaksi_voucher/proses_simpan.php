<?php 



require_once('../../../include/all_include.php');

$id_transaksi_voucher=isset($_POST["id_transaksi_voucher"]) ? $_POST["id_transaksi_voucher"]:"";
$id_voucher=isset($_POST["id_voucher"]) ? $_POST["id_voucher"]:"";
$id_member=isset($_POST["id_member"]) ? $_POST["id_member"]:"";
$nama_member=isset($_POST["nama_member"]) ? $_POST["nama_member"]:"";
$tanggal_transaksi=isset($_POST["tanggal_transaksi"]) ? $_POST["tanggal_transaksi"]:"";
$jenis_bbm=isset($_POST["jenis_bbm"]) ? $_POST["jenis_bbm"]:"";
$nominal= isset($_POST["nominal"]) ? (float) $_POST["nominal"]:"";


$query=mysql_query("INSERT INTO data_transaksi_voucher (id_transaksi, id_voucher, id_member, nama_member, tanggal_transaksi, jenis_bbm, nominal) 
    VALUES (
        '$id_transaksi_voucher',
        '$id_voucher',
        '$id_member',
        '$nama_member',
        '$tanggal_transaksi',
        '$jenis_bbm',
        '$nominal'
    )");

$id_sisa_voucher=isset($_POST["id_sisa_voucher"]) ? $_POST["id_sisa_voucher"]:"";

$nominal_asli_voucher = (float) baca_database("","nominal","SELECT * FROM data_voucher WHERE id_voucher='$id_voucher'");

$nominal_sisa_voucher =  $nominal_asli_voucher - $nominal;

$query_sisa_voucher=mysql_query("INSERT INTO data_sisa_voucher (id_sisa_voucher, sisa_voucher, id_voucher, status) 
    VALUES (
        '$id_sisa_voucher',
        '$nominal_sisa_voucher',
        '$id_voucher',
        'unused'
	)");

$resp = [];
if($query == true && $query_sisa_voucher == true){
	$resp["status"]="success";
}
else
{
	$resp["status"]="gagal";
}

echo (json_encode($resp)) 
?>
