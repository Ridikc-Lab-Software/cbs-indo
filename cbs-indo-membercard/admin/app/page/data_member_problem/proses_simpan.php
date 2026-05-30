<?php include '../../../include/all_include.php';

if (!isset($_POST['id_member']))
{
	    ?>
	<script>
	alert("AKSES DITOLAK");
	location.href = "index.php";
	</script>
	<?php
	die();
} 


$id_member=id_otomatis("data_member","id_member","10");
$nik=xss($_POST['nik']);
$nama=xss($_POST['nama']);
$alamat=xss($_POST['alamat']);
$no_telepon=xss($_POST['no_telepon']);
$jenis_kelamin=xss($_POST['jenis_kelamin']);
$tanggal_terdaftar=xss($_POST['tanggal_terdaftar']);
$id_kategori_member=xss($_POST['id_kategori_member']);
$kode_rfid=xss($_POST['kode_rfid']);
$password= md5($_POST['password']);
$tanggal_lahir=xss($_POST['tanggal_lahir']);
$agama=xss($_POST['agama']);
$status_perkawinan=xss($_POST['status_perkawinan']);
$pekerjaan=xss($_POST['pekerjaan']);
$username=xss($_POST['username']);

if ($username == "")
{
	$username = $no_telepon;
}
$point=xss($_POST['point']);
$kewarganegawaan=xss($_POST['kewarganegawaan']);
$id_admin=xss($_POST['id_admin']);
$spbu=xss($_POST['spbu']);



$query=mysql_query("insert into data_member values (
'$id_member'
 ,'$nik'
 ,'$nama'
 ,'$alamat'
 ,'$no_telepon'
 ,'$jenis_kelamin'
 ,'$tanggal_terdaftar'
 ,'$id_kategori_member'
 ,'$kode_rfid'
 ,'$point'
 ,'$username'
 ,'$password'
 ,'$tanggal_lahir'
 ,'$agama'
 ,'$status_perkawinan'
 ,'$pekerjaan'
 ,'$id_admin'
  ,'$spbu'

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