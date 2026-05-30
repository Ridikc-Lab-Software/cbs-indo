<?php include '../../../include/all_include.php';

if (!isset($_POST['id_group_jenis_transaksi']))
{
	    ?>
	<script>
	alert("AKSES DITOLAK");
	location.href = "index.php";
	</script>
	<?php
	die();
} 

$id_group_jenis_transaksi=xss($_POST['id_group_jenis_transaksi']);
$nama_group=xss($_POST['nama_group']);
$id_jenis_transaksi=xss($_POST['id_jenis_transaksi']);

$gambar_logo=$_POST['gambar_logo'];

$query=mysql_query("update data_group_jenis_transaksi set 
nama_group='$nama_group',
id_jenis_transaksi='$id_jenis_transaksi',

gambar_logo='$gambar_logo'
where id_group_jenis_transaksi='$id_group_jenis_transaksi' ") or die (mysql_error());

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