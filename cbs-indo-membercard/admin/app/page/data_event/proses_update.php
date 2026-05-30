<?php include '../../../include/all_include.php';

if (!isset($_POST['id_event']))
{
	    ?>
	<script>
	alert("AKSES DITOLAK");
	location.href = "index.php";
	</script>
	<?php
	die();
} 

$id_event=xss($_POST['id_event']);
$tanggal=xss($_POST['tanggal']);
$judul=xss($_POST['judul']);
$foto=xss($_FILES['foto']['name']); if (empty($foto)){$foto = $_POST['foto1'];} else { $foto = upload('foto');};

$isi=$_POST['isi'];

$query=mysql_query("update data_event set 
tanggal='$tanggal',
judul='$judul',
foto='$foto',

isi='$isi'
where id_event='$id_event' ") or die (mysql_error());

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