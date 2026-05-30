<?php include '../../../include/all_include.php';

if (!isset($_POST['id_point_promo']))
{
	    ?>
	<script>
	alert("AKSES DITOLAK");
	location.href = "index.php";
	</script>
	<?php
	die();
} 

$id_point_promo=xss($_POST['id_point_promo']);
$id_promo=xss($_POST['id_promo']);
$id_kategori_member=xss($_POST['id_kategori_member']);

$point=$_POST['point'];

$query=mysql_query("update data_point_promo set 
id_promo='$id_promo',
id_kategori_member='$id_kategori_member',

point='$point'
where id_point_promo='$id_point_promo' ") or die (mysql_error());

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