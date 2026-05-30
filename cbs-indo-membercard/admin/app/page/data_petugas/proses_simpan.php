<?php include '../../../include/all_include.php';

if (!isset($_POST['id_petugas']))
{
	    ?>
	<script>
	alert("AKSES DITOLAK");
	location.href = "index.php";
	</script>
	<?php
	die();
} 


$id_petugas=id_otomatis("data_petugas","id_petugas","10");
$nama=xss($_POST['nama']);
$alamat=xss($_POST['alamat']);
$no_telepon=xss($_POST['no_telepon']);
$jenis_kelamin=xss($_POST['jenis_kelamin']);
$username=xss($_POST['username']);
$password= md5($_POST['password']);
$nama_spbu= xss($_POST['nama_spbu']);



$query=mysql_query("insert into data_petugas values (
'$id_petugas'
 ,'$nama'
 ,'$alamat'
 ,'$no_telepon'
 ,'$jenis_kelamin'
 ,'$username'
 ,'$password'
 ,'$nama_spbu'

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