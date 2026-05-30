<?php include '../../../include/all_include.php';

if (!isset($_POST['id_galery']))
{
	    ?>
	<script>
	alert("AKSES DITOLAK");
	location.href = "index.php";
	</script>
	<?php
	die();
} 

$id_galery=xss($_POST['id_galery']);
$judul=xss($_POST['judul']);
$foto=xss($_FILES['foto']['name']); if (empty($foto)){$foto = $_POST['foto1'];} else { $foto = upload('foto');};

$keterangan=$_POST['keterangan'];

$query=mysql_query("update data_galery set 
judul='$judul',
foto='$foto',

keterangan='$keterangan'
where id_galery='$id_galery' ") or die (mysql_error());

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