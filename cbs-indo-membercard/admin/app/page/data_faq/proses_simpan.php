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


$id_faq=id_otomatis("data_faq","id_faq","10");
$tanya=xss($_POST['tanya']);
$jawab=xss($_POST['jawab']);



$query=mysql_query("insert into data_faq values (
'$id_faq'
 ,'$tanya'
 ,'$jawab'

)");

if($query){
?>
<script>location.href = "<?php index(); ?>?input=popup_tambah"; </script>
<?php
}
else
{
	echo "GAGAL DIPROSES";
}
?>