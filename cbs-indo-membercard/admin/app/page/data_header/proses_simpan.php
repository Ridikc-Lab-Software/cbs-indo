<?php include '../../../include/all_include.php';

if (!isset($_POST['id_header']))
{
	    ?>
	<script>
	alert("AKSES DITOLAK");
	location.href = "index.php";
	</script>
	<?php
	die();
} 


$id_header=$_POST['id_header'];
$foto= upload_company('foto');
$judul=$_POST['judul'];
$keterangan=$_POST['keterangan'];



$query=mysql_query("insert into data_header values (
'$id_header'
 ,'$foto'
 ,'$judul'
 ,'$keterangan'

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