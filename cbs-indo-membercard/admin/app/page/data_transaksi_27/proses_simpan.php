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


$id_transaksi=id_otomatis("data_transaksi","id_transaksi","10");
$tanggal=xss($_POST['tanggal']);
$jam=xss($_POST['jam']);
$id_member=xss($_POST['id_member']);
$id_petugas=xss($_POST['id_petugas']);
$id_kategori_member=xss($_POST['id_kategori_member']);
$id_jenis_transaksi=xss($_POST['id_jenis_transaksi']);
$point=xss($_POST['point']);
$kategori_jumlah=xss($_POST['kategori_jumlah']);
$jumlah=xss($_POST['jumlah']);



$query=mysql_query("insert into data_transaksi values (
'$id_transaksi'
 ,'$tanggal'
 ,'$jam'
 ,'$id_member'
 ,'$id_petugas'
 ,'$id_kategori_member'
 ,'$id_jenis_transaksi'
 ,'$point'
 ,'$kategori_jumlah'
 ,'$jumlah'

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