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


$id_group_jenis_transaksi=id_otomatis("data_group_jenis_transaksi","id_group_jenis_transaksi","10");
$nama_group=xss($_POST['nama_group']);
$id_jenis_transaksi=xss($_POST['id_jenis_transaksi']);
$gambar_logo= upload('gambar_logo');



$query=mysql_query("insert into data_group_jenis_transaksi values (
'$id_group_jenis_transaksi'
 ,'$nama_group'
 ,'$id_jenis_transaksi'
 ,'$gambar_logo'

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