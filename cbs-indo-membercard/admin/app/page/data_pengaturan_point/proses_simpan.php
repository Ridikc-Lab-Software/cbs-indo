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


$id_pengaturan_point=id_otomatis("data_pengaturan_point","id_pengaturan_point","10");
$nama_pengaturan=xss($_POST['nama_pengaturan']);
$id_kategori_member=xss($_POST['id_kategori_member']);
$id_jenis_transaksi=xss($_POST['id_jenis_transaksi']);
$point=xss($_POST['point']);



$query=mysql_query("insert into data_pengaturan_point values (
'$id_pengaturan_point'
 ,'$nama_pengaturan'
 ,'$id_kategori_member'
 ,'$id_jenis_transaksi'
 ,'$point'

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