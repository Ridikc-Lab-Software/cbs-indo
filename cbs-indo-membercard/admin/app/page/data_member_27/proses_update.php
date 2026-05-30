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

$id_member=xss($_POST['id_member']);
$nik=xss($_POST['nik']);
$nama=xss($_POST['nama']);
$alamat=xss($_POST['alamat']);
$no_telepon=xss($_POST['no_telepon']);
$jenis_kelamin=xss($_POST['jenis_kelamin']);
$tanggal_terdaftar=xss($_POST['tanggal_terdaftar']);
$id_kategori_member=xss($_POST['id_kategori_member']);
$kode_rfid=xss($_POST['kode_rfid']);
$password_validasi=decrypt($_POST['password_validasi']); 
$password_lama=MD5($_POST['password_lama']);
$password=($_POST['password']);
if ($password_lama=="" or $password=="")
{
		$password=decrypt($_POST['password_validasi']);
}
else
{
		if ($password_lama==$password_validasi)
		{
			$password=MD5($_POST['password']);
		}
		else
		{
			?>
				<script>
				alert("password Lama tidak sesuai, Gagal Mengganti password.");
				window.history.back(); </script>
			<?php
			die();
		}
}
$tanggal_lahir=xss($_POST['tanggal_lahir']);
$agama=xss($_POST['agama']);
$status_perkawinan=xss($_POST['status_perkawinan']);
$id_pekerjaan=xss($_POST['id_pekerjaan']);
$username=xss($_POST['username']);


 $point1 = baca_database('','point',"select * from data_member where id_member='$id_member'");
$point=xss($_POST['point']);

$id_persetujuan_point=id_otomatis("data_persetujuan_point","id_persetujuan_point","10");
date_default_timezone_set('Asia/Jakarta');
 $usernameadm = decrypt($_COOKIE['jenenge']);
 $tanggal_permintaan = date('Y-m-d H:i:s');
$hak_akses = baca_database('','hak_akses',"select * from data_admin where username='$usernameadm'");
$id_admin = baca_database('','id_admin',"select * from data_admin where username='$usernameadm'");


$query=mysql_query("update data_member set 
nik='$nik',
nama='$nama',
alamat='$alamat',
no_telepon='$no_telepon',
jenis_kelamin='$jenis_kelamin',
tanggal_terdaftar='$tanggal_terdaftar',
id_kategori_member='$id_kategori_member',
kode_rfid='$kode_rfid',
password='$password',
tanggal_lahir='$tanggal_lahir',
agama='$agama',
status_perkawinan='$status_perkawinan',
id_pekerjaan='$id_pekerjaan',
username='$username',
point='$point1',
id_admin='$id_admin'
where id_member='$id_member' ") or die (mysql_error());



if ($point==$point1) {
	
} else 
	
	{
		

$query=mysql_query("insert into data_persetujuan_point values (
'$id_persetujuan_point'
 ,'$id_member'
  ,'$id_admin'
 ,''
 ,'$tanggal_permintaan'
 ,''
 ,'$point1'
 ,'$point'
 ,'menunggu_persetujuan'
 ,'edit poin'

)");

	}


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