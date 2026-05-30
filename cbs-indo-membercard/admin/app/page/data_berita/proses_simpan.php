<?php include '../../../include/all_include.php';

if (!isset($_POST['id_berita']))
{
	    ?>
	<script>
	alert("AKSES DITOLAK");
	location.href = "index.php";
	</script>
	<?php
	die();
} 


$id_berita=id_otomatis("data_berita","id_berita","10");
$tanggal=xss($_POST['tanggal']);
$judul=xss($_POST['judul']);
$foto= upload('foto');
$isi=xss($_POST['isi']);
$kategori_berita=xss($_POST['kategori_berita']);



$query=mysql_query("insert into data_berita values (
'$id_berita'
 ,'$tanggal'
 ,'$judul'
 ,'$foto'
 ,'$isi'
 ,'$kategori_berita'

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