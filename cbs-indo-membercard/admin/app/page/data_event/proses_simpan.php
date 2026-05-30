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


$id_event=id_otomatis("data_event","id_event","10");
$tanggal=xss($_POST['tanggal']);
$judul=xss($_POST['judul']);
$foto= upload('foto');
$isi=xss($_POST['isi']);



$query=mysql_query("insert into data_event values (
'$id_event'
 ,'$tanggal'
 ,'$judul'
 ,'$foto'
 ,'$isi'

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