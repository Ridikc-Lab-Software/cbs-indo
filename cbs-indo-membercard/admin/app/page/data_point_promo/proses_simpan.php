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


$id_point_promo=id_otomatis("data_point_promo","id_point_promo","10");
$id_promo=xss($_POST['id_promo']);
$id_kategori_member=xss($_POST['id_kategori_member']);
$point=xss($_POST['point']);



$query=mysql_query("insert into data_point_promo values (
'$id_point_promo'
 ,'$id_promo'
 ,'$id_kategori_member'
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