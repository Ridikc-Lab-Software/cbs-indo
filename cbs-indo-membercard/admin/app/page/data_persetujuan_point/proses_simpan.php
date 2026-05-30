<?php include '../../../include/all_include.php';

if (!isset($_POST['id_persetujuan_point']))
{
	    ?>
	<script>
	alert("AKSES DITOLAK");
	location.href = "index.php";
	</script>
	<?php
	die();
} 


$id_persetujuan_point=$_POST['id_persetujuan_point'];
$id_member=$_POST['id_member'];
$judul=$_POST['judul'];
$keterangan=$_POST['keterangan'];



$query=mysql_query("insert into data_persetujuan_point values (
'$id_persetujuan_point'
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