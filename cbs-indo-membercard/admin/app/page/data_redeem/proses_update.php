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

$id_redeem=xss($_POST['id_redeem']);
$tanggal=xss($_POST['tanggal']);
$jam=xss($_POST['jam']);
$id_member=xss($_POST['id_member']);
$id_mitra=xss($_POST['id_mitra']);
$id_promo=xss($_POST['id_promo']);
$point=xss($_POST['point']);

//$status=$_POST['status'];

$query=mysql_query("update data_redeem set 
tanggal='$tanggal',
jam='$jam',
id_member='$id_member',
id_mitra='$id_mitra',
id_promo='$id_promo',
point='$point'

where id_redeem='$id_redeem' ") or die (mysql_error());

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