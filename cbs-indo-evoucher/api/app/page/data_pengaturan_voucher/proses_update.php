<?php 
require_once('../../../include/all_include.php');

$id_pengaturan_voucher=isset($_POST["id_pengaturan_voucher"]) ? $_POST["id_pengaturan_voucher"]:"";
$nama=isset($_POST["nama"]) ? $_POST["nama"]:"";
$isi=isset($_POST["isi"]) ? $_POST["isi"]:"";
$status=isset($_POST["status"]) ? $_POST["status"]:"";


$sql = "UPDATE data_pengaturan_voucher SET 
nama=?,
isi=?,
status=?,

WHERE id_pengaturan_voucher=?";

$stmt = $dbh->prepare($sql);
$stmt->execute([
$nama,
$isi,
$status,

$id_pengaturan_voucher]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>
