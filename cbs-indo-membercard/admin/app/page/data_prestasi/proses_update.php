<?php include '../../../include/all_include.php';

if (!isset($_POST['id_prestasi']))
{
	    ?>
	<script>
	alert("AKSES DITOLAK");
	location.href = "index.php";
	</script>
	<?php
	die();
} 

$id_prestasi=xss($_POST['id_prestasi']);
$tanggal=xss($_POST['tanggal']);
$judul=xss($_POST['judul']);
$keterangan=xss($_POST['keterangan']);

$foto=upload('foto');

$query=mysql_query("update data_prestasi set 
tanggal='$tanggal',
judul='$judul',
keterangan='$keterangan',

foto='$foto'
where id_prestasi='$id_prestasi' ") or die (mysql_error());

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