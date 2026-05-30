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


$id_pengaturan_jenis_transaksi=id_otomatis("data_pengaturan_jenis_transaksi","id_pengaturan_jenis_transaksi","10");
$id_kategori_member=xss($_POST['id_kategori_member']);
$id_jenis_transaksi=xss($_POST['id_jenis_transaksi']);
$status=xss($_POST['status']);



$query=mysql_query("insert into data_pengaturan_jenis_transaksi values (
'$id_pengaturan_jenis_transaksi'
 ,'$id_kategori_member'
 ,'$id_jenis_transaksi'
 ,'$status'

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