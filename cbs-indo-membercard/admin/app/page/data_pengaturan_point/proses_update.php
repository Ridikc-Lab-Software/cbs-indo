<?php include '../../../include/all_include.php';

if (!isset($_POST['id_pengaturan_point']))
{
	    ?>
	<script>
	alert("AKSES DITOLAK");
	location.href = "index.php";
	</script>
	<?php
	die();
} 

$id_pengaturan_point=xss($_POST['id_pengaturan_point']);
$nama_pengaturan=xss($_POST['nama_pengaturan']);
$id_kategori_member=xss($_POST['id_kategori_member']);
$id_jenis_transaksi=xss($_POST['id_jenis_transaksi']);

$point=$_POST['point'];

$query=mysql_query("update data_pengaturan_point set 
nama_pengaturan='$nama_pengaturan',
id_kategori_member='$id_kategori_member',
id_jenis_transaksi='$id_jenis_transaksi',

point='$point'
where id_pengaturan_point='$id_pengaturan_point' ") or die (mysql_error());

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