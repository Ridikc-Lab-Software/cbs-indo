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
$foto=$_FILES['foto']['name']; if (empty($foto)){$foto = $_POST['foto1'];} else { $foto = upload_company('foto');};
$judul=$_POST['judul'];
$keterangan=$_POST['keterangan'];

$query=mysql_query("update data_header set 
foto='$foto',
judul='$judul',
keterangan='$keterangan'

where id_header='$id_header' ") or die (mysql_error());

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