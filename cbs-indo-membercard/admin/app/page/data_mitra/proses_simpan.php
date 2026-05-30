<?php include '../../../include/all_include.php';

if (!isset($_POST['id_mitra']))
{
	    ?>
	<script>
	alert("AKSES DITOLAK");
	location.href = "index.php";
	</script>
	<?php
	die();
} 


$id_mitra=id_otomatis("data_mitra","id_mitra","10");
$nama_mitra=xss($_POST['nama_mitra']);
$alamat=xss($_POST['alamat']);
$no_telepon=xss($_POST['no_telepon']);
$nama_pemilik=xss($_POST['nama_pemilik']);
$no_telepon_pemilik=xss($_POST['no_telepon_pemilik']);
$tanggal_daftar=xss($_POST['tanggal_daftar']);
$username=xss($_POST['username']);
$password= md5($_POST['password']);
$status=xss($_POST['status']);
$gambar_logo= upload('gambar_logo');

$id_admin = decrypt($_COOKIE['kodene']);
$spbu=xss($_POST['spbu']);

$query=mysql_query("insert into data_mitra values (
'$id_mitra'
 ,'$nama_mitra'
 ,'$alamat'
 ,'$no_telepon'
 ,'$nama_pemilik'
 ,'$no_telepon_pemilik'
 ,'$tanggal_daftar'
 ,'$username'
 ,'$password'
 ,'$status'
 ,'$gambar_logo'
,'$spbu'
,'$id_admin'
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