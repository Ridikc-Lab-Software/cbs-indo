<?php 
require_once('../../../include/all_include.php');

$id_pekerjaan=isset($_POST["id_pekerjaan"]) ? $_POST["id_pekerjaan"]:"";
$nama=isset($_POST["nama"]) ? $_POST["nama"]:"";


$sql = "UPDATE data_pekerjaan SET 
nama=?,

WHERE id_pekerjaan=?";

$stmt = $dbh->prepare($sql);
$stmt->execute([
$nama,

$id_pekerjaan]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>
