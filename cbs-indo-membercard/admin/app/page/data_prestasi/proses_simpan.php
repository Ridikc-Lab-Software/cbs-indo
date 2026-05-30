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


$id_prestasi=id_otomatis("data_prestasi","id_prestasi","10");
$tanggal=xss($_POST['tanggal']);
$judul=xss($_POST['judul']);
$keterangan=xss($_POST['keterangan']);
$foto= upload('foto');



$query=mysql_query("insert into data_prestasi values (
'$id_prestasi'
 ,'$tanggal'
 ,'$judul'
 ,'$keterangan'
 ,'$foto'

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