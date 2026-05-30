<?php include '../../../include/all_include.php';

if (!isset($_POST['id_faq']))
{
	    ?>
	<script>
	alert("AKSES DITOLAK");
	location.href = "index.php";
	</script>
	<?php
	die();
} 

$id_faq=xss($_POST['id_faq']);
$tanya=xss($_POST['tanya']);

$jawab=$_POST['jawab'];

$query=mysql_query("update data_faq set 
tanya='$tanya',

jawab='$jawab'
where id_faq='$id_faq' ") or die (mysql_error());

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