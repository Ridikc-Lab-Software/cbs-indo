<?php include '../../../include/all_include.php';

if (!isset($_POST['id_karir']))
{
	    ?>
	<script>
	alert("AKSES DITOLAK");
	location.href = "index.php";
	</script>
	<?php
	die();
} 


$id_karir=id_otomatis("data_karir","id_karir","10");
$foto= upload('foto');
$nama_karir=($_POST['nama_karir']);
$deskripsi_karir=($_POST['deskripsi_karir']);
$kualifikasi_karir=($_POST['kualifikasi_karir']);
$batas_lamar=($_POST['batas_lamar']);
$cara_lamar = ($_POST['cara_lamar']);
$status= $_POST['status'];



$query=mysql_query("insert into data_karir values (
'$id_karir'
,'$foto'
 ,'$nama_karir'
 ,'$deskripsi_karir'
 ,'$kualifikasi_karir'
 ,'$batas_lamar'
 ,'$cara_lamar'
 ,'$status'

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