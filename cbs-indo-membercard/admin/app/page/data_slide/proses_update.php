<?php include '../../../include/all_include.php';

if (!isset($_POST['id_slide']))
{
	    ?>
	<script>
	alert("AKSES DITOLAK");
	location.href = "index.php";
	</script>
	<?php
	die();
} 

$id_slide=($_POST['id_slide']);
$foto=xss($_FILES['foto']['name']); if (empty($foto)){$foto = $_POST['foto1'];} else { $foto = upload('foto');};
$header=($_POST['header']);
$judul1=($_POST['judul1']);
$caption1=($_POST['caption1']);
$judul2=($_POST['judul2']);
$caption2=($_POST['caption2']);
$judul3=($_POST['judul3']);
$caption3=($_POST['caption3']);
$nama=$_POST['nama'];
$jabatan=$_POST['jabatan'];

$query=mysql_query("update data_slide set 
foto='$foto',
header='$header',
judul1='$judul1',
caption1='$caption1',
judul2='$judul2',
caption2='$caption2',
judul3='$judul3',
caption3='$caption3',
nama='$nama',
jabatan='$jabatan'
where id_slide='$id_slide' ") or die (mysql_error());

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