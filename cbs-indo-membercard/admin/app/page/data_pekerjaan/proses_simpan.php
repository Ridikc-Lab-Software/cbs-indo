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


$id_pekerjaan=id_otomatis("data_pekerjaan","id_pekerjaan","10");
$nama=xss($_POST['nama']);




$query=mysql_query("insert into data_pekerjaan values (
'$id_pekerjaan'
 ,'$nama'
 
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