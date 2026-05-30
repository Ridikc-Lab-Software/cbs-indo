<?php include '../../../include/all_include.php';

if (!isset($_GET['proses']))
{
	    ?>
	<script>
	alert("AKSES DITOLAK");
	location.href = "index.php";
	</script>
	<?php
	die();
} 


$id_persetujuan_point=id_otomatis("data_persetujuan_point","id_persetujuan_point","10");
date_default_timezone_set('Asia/Jakarta');
 $usernameadm = decrypt($_COOKIE['jenenge']);
 $tanggal_permintaan = date('Y-m-d H:i:s');
$hak_akses = baca_database('','hak_akses',"select * from data_admin where username='$usernameadm'");
$id_admin = baca_database('','id_admin',"select * from data_admin where username='$usernameadm'");


if ($hak_akses == "manager")
{
	$proses =  (mysql_real_escape_string($_GET['proses']));
	$query=mysql_query("delete from data_member where id_member='$proses'");
}
else
{

	$id_member =  (mysql_real_escape_string($_GET['proses']));
$query=mysql_query("insert into data_persetujuan_point values (
	'$id_persetujuan_point'
	 ,'$id_member'
	  ,'$id_admin'
	 ,''
	 ,'$tanggal_permintaan'
	 ,''
	 ,''
	 ,''
	 ,'menunggu_persetujuan'
	 ,'hapus member'
	
	)");

?>
<Script>
	alert("Menunggu Persetujuan..");
</Script>
<?php
}
if($query){
?>
<script>location.href = "<?php index(); ?>?input=popup_hapus"; </script>
<?php
}
else
{
	echo "GAGAL DIPROSES";
}
?>