<?php include '../../../include/all_include.php';

if (!isset($_POST['id_profil']))
{
	    ?>
	<script>
	alert("AKSES DITOLAK");
	location.href = "index.php";
	</script>
	<?php
	die();
} 

$id_profil=xss($_POST['id_profil']);
$nama=xss($_POST['nama']);
$foto=xss($_FILES['foto']['name']); if (empty($foto)){$foto = $_POST['foto1'];} else { $foto = upload('foto');};
$no_telepon=xss($_POST['no_telepon']);
$email=xss($_POST['email']);
$alamat=xss($_POST['alamat']);
$deskripsi=xss($_POST['deskripsi']);
$visi=xss($_POST['visi']);

$misi=$_POST['misi'];

$query=mysql_query("update data_profil set 
nama='$nama',
foto='$foto',
no_telepon='$no_telepon',
email='$email',
alamat='$alamat',
deskripsi='$deskripsi',
visi='$visi',

misi='$misi'
where id_profil='$id_profil' ") or die (mysql_error());

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