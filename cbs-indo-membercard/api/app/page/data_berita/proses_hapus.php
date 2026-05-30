<?php 
require_once('../../../include/all_include.php');
$id_berita=isset($_POST["id_berita"]) ? $_POST["id_berita"]:"";
$sql = "DELETE FROM data_berita WHERE id_berita=?";
$stmt = $dbh->prepare($sql);
$stmt->execute([$id_berita]);
$resp = [];
$resp["status"]="success";
echo (json_encode($resp)) 
?>


