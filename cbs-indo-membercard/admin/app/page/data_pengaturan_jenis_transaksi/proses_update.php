<?php include '../../../include/all_include.php';

if (!isset($_POST['id_pengaturan_jenis_transaksi']))
{
	    ?>
	<script>
	alert("AKSES DITOLAK");
	location.href = "index.php";
	</script>
	<?php
	die();
} 

$id_pengaturan_jenis_transaksi=xss($_POST['id_pengaturan_jenis_transaksi']);
$id_kategori_member=xss($_POST['id_kategori_member']);
$id_jenis_transaksi=xss($_POST['id_jenis_transaksi']);

$status=$_POST['status'];

$query=mysql_query("update data_pengaturan_jenis_transaksi set 
id_kategori_member='$id_kategori_member',
id_jenis_transaksi='$id_jenis_transaksi',

status='$status'
where id_pengaturan_jenis_transaksi='$id_pengaturan_jenis_transaksi' ") or die (mysql_error());

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