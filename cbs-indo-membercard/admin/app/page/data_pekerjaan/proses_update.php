<?php include '../../../include/all_include.php';

if (!isset($_POST['id_pekerjaan']))
{
	    ?>
	<script>
	alert("AKSES DITOLAK");
	location.href = "index.php";
	</script>
	<?php
	die();
} 

$id_pekerjaan=xss($_POST['id_pekerjaan']);
$nama=xss($_POST['nama']);


$query=mysql_query("update data_pekerjaan set 
nama='$nama'
where id_pekerjaan='$id_pekerjaan' ") or die (mysql_error());

if($query){
?>
<script>location.href = "<?php index(); ?>?input=popup_edit"; </script>
<?php
}
else
{
	echo "GAGAL DIPROSES";
}
?>