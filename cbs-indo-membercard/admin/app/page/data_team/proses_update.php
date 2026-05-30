<?php include '../../../include/all_include.php';

if (!isset($_POST['id_team']))
{
	    ?>
	<script>
	alert("AKSES DITOLAK");
	location.href = "index.php";
	</script>
	<?php
	die();
} 

$id_team=xss($_POST['id_team']);
$nama_team=xss($_POST['nama_team']);
$foto=xss($_FILES['foto']['name']); if (empty($foto)){$foto = $_POST['foto1'];} else { $foto = upload('foto');};
$email=xss($_POST['email']);
$alamat=xss($_POST['alamat']);
$telepon=xss($_POST['telepon']);

$bagian=$_POST['bagian'];

$query=mysql_query("update data_team set 
nama_team='$nama_team',
foto='$foto',
email='$email',
alamat='$alamat',
telepon='$telepon',

bagian='$bagian'
where id_team='$id_team' ") or die (mysql_error());

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