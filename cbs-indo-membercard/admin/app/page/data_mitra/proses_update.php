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

$id_mitra=xss($_POST['id_mitra']);
$nama_mitra=xss($_POST['nama_mitra']);
$alamat=xss($_POST['alamat']);
$no_telepon=xss($_POST['no_telepon']);
$nama_pemilik=xss($_POST['nama_pemilik']);
$no_telepon_pemilik=xss($_POST['no_telepon_pemilik']);
$tanggal_daftar=xss($_POST['tanggal_daftar']);
$username=xss($_POST['username']);
$password_validasi=decrypt($_POST['password_validasi']); 
$password_lama=MD5($_POST['password_lama']);
$password=($_POST['password']);
$spbu=($_POST['spbu']);
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
}$status=xss($_POST['status']);

$gambar_logo=upload('gambar_logo');

$query=mysql_query("update data_mitra set 
nama_mitra='$nama_mitra',
alamat='$alamat',
no_telepon='$no_telepon',
nama_pemilik='$nama_pemilik',
no_telepon_pemilik='$no_telepon_pemilik',
tanggal_daftar='$tanggal_daftar',
username='$username',
password='$password',
status='$status',
spbu='$spbu'
where id_mitra='$id_mitra' ") or die (mysql_error());

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