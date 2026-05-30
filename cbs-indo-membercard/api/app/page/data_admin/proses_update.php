<?php 
require_once('../../../include/all_include.php');

$id_admin=isset($_POST["id_admin"]) ? $_POST["id_admin"]:"";
$password=isset($_POST["password"]) ? $_POST["password"]:"";


$sql = "UPDATE data_admin SET 
password=? 

WHERE id_admin=?";

$stmt = $dbh->prepare($sql);
$stmt->execute([
$password, 

$id_admin]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>






