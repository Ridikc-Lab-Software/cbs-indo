<?php include '../../../include/all_include.php';

if (!isset($_GET['proses']))
{
	    ?>
	<script>
	alert("AKSES DITOLAK");
	location.href = "index.php";
	</script>
	<?php
	die();
} 
$proses =  (mysql_real_escape_string($_GET['proses']));
$query=mysql_query("delete from data_log_activity where id_log_activity='$proses'");

if($query){
?>
<script>location.href = "<?php index(); ?>?input=popup_hapus"; </script>
<?php
}
else
{
	echo "GAGAL DIPROSES";
}
?>
