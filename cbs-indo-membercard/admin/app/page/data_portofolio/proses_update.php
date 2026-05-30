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

$id_portofolio=xss($_POST['id_portofolio']);
$logo=xss($_FILES['logo']['name']); if (empty($logo)){$logo = $_POST['logo1'];} else { $logo = upload('logo');};
$keterangan=$_POST['keterangan'];

$query=mysql_query("update data_portofolio set 
logo='$logo',

keterangan='$keterangan'
where id_portofolio='$id_portofolio' ") or die (mysql_error());

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