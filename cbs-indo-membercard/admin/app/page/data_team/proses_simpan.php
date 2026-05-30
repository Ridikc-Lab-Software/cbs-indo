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


$id_team=id_otomatis("data_team","id_team","10");
$nama_team=xss($_POST['nama_team']);
$foto= upload('foto');
$email=xss($_POST['email']);
$alamat=xss($_POST['alamat']);
$telepon=xss($_POST['telepon']);
$bagian=xss($_POST['bagian']);



$query=mysql_query("insert into data_team values (
'$id_team'
 ,'$nama_team'
 ,'$foto'
 ,'$email'
 ,'$alamat'
 ,'$telepon'
 ,'$bagian'

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