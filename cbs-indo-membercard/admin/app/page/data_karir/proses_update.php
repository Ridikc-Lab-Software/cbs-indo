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

$id_karir=xss($_POST['id_karir']);
$foto=xss($_FILES['foto']['name']); if (empty($foto)){$foto = $_POST['foto1'];} else { $foto = upload('foto');};
$nama_karir=($_POST['nama_karir']);
$deskripsi_karir=$_POST['deskripsi_karir'];
$kualifikasi_karir=$_POST['kualifikasi_karir'];
$batas_lamar=$_POST['batas_lamar'];
$cara_lamar=$_POST['cara_lamar'];


$status=$_POST['status'];

$query=mysql_query("update data_karir set 
foto='$foto',
nama_karir='$nama_karir',
deskripsi_karir='$deskripsi_karir',
kualifikasi_karir='$kualifikasi_karir',
batas_lamar='$batas_lamar',
cara_lamar='$cara_lamar',
status='$status'

where id_karir='$id_karir' ") or die (mysql_error());

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