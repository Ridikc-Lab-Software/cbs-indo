<?php include '../../../include/all_include.php';

if (!isset($_POST['id_slide']))
{
	    ?>
	<script>
	alert("AKSES DITOLAK");
	location.href = "index.php";
	</script>
	<?php
	die();
} 


$id_slide=id_otomatis("data_slide","id_slide","10");
$foto= upload('foto');
$header=xss($_POST['header']);
$judul1=xss($_POST['judul1']);
$caption1=xss($_POST['caption1']);
$judul2=xss($_POST['judul2']);
$caption2=xss($_POST['caption2']);
$judul3=xss($_POST['judul3']);
$caption3=xss($_POST['caption3']);
$judul4=xss($_POST['judul4']);
$caption4=xss($_POST['caption4']);
$judul5=xss($_POST['judul5']);
$caption5=xss($_POST['caption5']);
$nama=xss($_POST['nama']);
$jabatan=xss($_POST['jabatan']);

$query=mysql_query("insert into data_slide values (
'$id_slide'
 ,'$foto'
 ,'$header'
 ,'$judul1'
 ,'$caption1'
 ,'$judul2'
 ,'$caption2'
 ,'$judul3'
 ,'$caption3'
 ,'$judul4'
 ,'$caption4'
 ,'$judul5'
 ,'$caption5'
 ,'$nama'
 ,'$jabatan'

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