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
$alamat=xss($_POST['alamat']);
$no_telepon1=xss($_POST['no_telepon1']);
$no_telepon2=xss($_POST['no_telepon2']);
$email=xss($_POST['email']);
$sejarah=xss($_POST['sejarah']);
$visi=xss($_POST['visi']);
$misi=xss($_POST['misi']);
$deskripsi=xss($_POST['deskripsi']);

$foto=upload('foto');

$query=mysql_query("update data_profil set 
nama='$nama',
alamat='$alamat',
no_telepon1='$no_telepon1',
no_telepon2='$no_telepon2',
email='$email',
sejarah='$sejarah',
visi='$visi',
misi='$misi',
deskripsi='$deskripsi',

foto='$foto'
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