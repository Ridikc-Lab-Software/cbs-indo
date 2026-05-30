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


$id_profil=id_otomatis("data_profil","id_profil","10");
$nama=xss($_POST['nama']);
$foto= upload('foto');
$no_telepon=xss($_POST['no_telepon']);
$email=xss($_POST['email']);
$alamat=xss($_POST['alamat']);
$deskripsi=xss($_POST['deskripsi']);
$visi=xss($_POST['visi']);
$misi=xss($_POST['misi']);



$query=mysql_query("insert into data_profil values (
'$id_profil'
 ,'$nama'
 ,'$foto'
 ,'$no_telepon'
 ,'$email'
 ,'$alamat'
 ,'$deskripsi'
 ,'$visi'
 ,'$misi'

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