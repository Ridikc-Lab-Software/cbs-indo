<?php 
require_once('../../../include/all_include.php');
$id_profil=isset($_POST["id_profil"]) ? $_POST["id_profil"]:"";
$sql = "DELETE FROM data_profil WHERE id_profil=?";
$stmt = $dbh->prepare($sql);
$stmt->execute([$id_profil]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>


