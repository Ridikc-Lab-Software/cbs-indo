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


$id_galery=id_otomatis("data_galery","id_galery","10");
$tanggal=xss($_POST['tanggal']);
$judul=xss($_POST['judul']);
$foto= upload('foto');
$isi=xss($_POST['isi']);



$query=mysql_query("insert into data_galery values (
'$id_galery'
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