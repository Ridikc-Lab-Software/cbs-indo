<?php include '../../../include/all_include.php';

if (!isset($_POST['id_portofolio']))
{
	    ?>
	<script>
	alert("AKSES DITOLAK");
	location.href = "index.php";
	</script>
	<?php
	die();
} 


$id_portofolio=id_otomatis("data_portofolio","id_portofolio","10");
$logo=upload('logo');
$keterangan=$_POST['keterangan'];



$query=mysql_query("insert into data_portofolio values (
'$id_portofolio'
 ,'$logo'
 ,'$keterangan'

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