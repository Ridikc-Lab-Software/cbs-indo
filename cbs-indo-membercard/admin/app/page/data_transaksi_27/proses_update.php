<?php include '../../../include/all_include.php';

if (!isset($_POST['id_transaksi']))
{
	    ?>
	<script>
	alert("AKSES DITOLAK");
	location.href = "index.php";
	</script>
	<?php
	die();
} 

$id_transaksi=xss($_POST['id_transaksi']);
$tanggal=xss($_POST['tanggal']);
$jam=xss($_POST['jam']);
$id_member=xss($_POST['id_member']);
$id_petugas=xss($_POST['id_petugas']);
$id_kategori_member=xss($_POST['id_kategori_member']);
$id_jenis_transaksi=xss($_POST['id_jenis_transaksi']);
$point=xss($_POST['point']);
$kategori_jumlah=xss($_POST['kategori_jumlah']);

$jumlah=$_POST['jumlah'];

$query=mysql_query("update data_transaksi set 
tanggal='$tanggal',
jam='$jam',
id_member='$id_member',
id_petugas='$id_petugas',
id_kategori_member='$id_kategori_member',
id_jenis_transaksi='$id_jenis_transaksi',
point='$point',
kategori_jumlah='$kategori_jumlah',

jumlah='$jumlah'
where id_transaksi='$id_transaksi' ") or die (mysql_error());

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