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
$alamat=xss($_POST['alamat']);
$no_telepon1=xss($_POST['no_telepon1']);
$no_telepon2=xss($_POST['no_telepon2']);
$sejarah=xss($_POST['sejarah']);
$visi=xss($_POST['visi']);
$misi=xss($_POST['misi']);
$deskripsi=xss($_POST['deskripsi']);
$foto= upload('foto');



$query=mysql_query("insert into data_profil values (
'$id_profil'
 ,'$nama'
 ,'$alamat'
 ,'$no_telepon1'
 ,'$no_telepon2'
 ,'$sejarah'
 ,'$visi'
 ,'$misi'
 ,'$deskripsi'
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