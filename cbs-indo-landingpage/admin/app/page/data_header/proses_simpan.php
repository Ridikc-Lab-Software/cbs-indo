<?php include '../../../include/all_include.php';

if (!isset($_POST['id_header']))
{
	    ?>
	<script>
	alert("AKSES DITOLAK");
	location.href = "index.php";
	</script>
	<?php
	die();
} 


$id_header=id_otomatis("data_header","id_header","10");
$foto= upload('foto');
$judul=xss($_POST['judul']);
$keterangan=xss($_POST['keterangan']);



$query=mysql_query("insert into data_header values (
'$id_header'
 ,'$foto'
 ,'$judul'
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