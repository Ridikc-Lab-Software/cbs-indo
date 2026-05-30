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

$id_petugas=xss($_POST['id_petugas']);
$nama=xss($_POST['nama']);
$alamat=xss($_POST['alamat']);
$no_telepon=xss($_POST['no_telepon']);
$jenis_kelamin=xss($_POST['jenis_kelamin']);
$username=xss($_POST['username']);

$password_validasi=decrypt($_POST['password_validasi']); 
$password_lama=MD5($_POST['password_lama']);
$password=($_POST['password']);
$nama_spbu=($_POST['nama_spbu']);
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

$query=mysql_query("update data_petugas set 
nama='$nama',
alamat='$alamat',
no_telepon='$no_telepon',
jenis_kelamin='$jenis_kelamin',
username='$username',
nama_spbu='$nama_spbu',

password='$password'
where id_petugas='$id_petugas' ") or die (mysql_error());

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