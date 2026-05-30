<?php include '../../../include/all_include.php';

if (!isset($_POST['id_redeem']))
{
	    ?>
	<script>
	alert("AKSES DITOLAK");
	location.href = "index.php";
	</script>
	<?php
	die();
} 


$id_redeem=id_otomatis("data_redeem","id_redeem","10");
$tanggal=xss($_POST['tanggal']);
$jam=xss($_POST['jam']);
$id_member=xss($_POST['id_member']);
$id_mitra=xss($_POST['id_mitra']);
$id_promo=xss($_POST['id_promo']);
$point=xss($_POST['point']);
$jumlah=xss($_POST['jumlah']);
$value_redeem=xss($_POST['value_redeem']);
$id_petugas=xss($_POST['id_petugas']);



$query=mysql_query("insert into data_redeem values (
'$id_redeem'
 ,'$tanggal'
 ,'$jam'
 ,'$id_member'
 ,'$id_mitra'
 ,'$id_promo'
 ,'$point'
 ,'$jumlah'
 ,'$value_redeem'
 ,'$id_petugas'

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