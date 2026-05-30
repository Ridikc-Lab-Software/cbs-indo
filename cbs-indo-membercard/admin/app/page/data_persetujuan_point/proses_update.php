<?php include '../../../include/all_include.php';



$id_persetujuan_point=$_GET['proses'];
$id_member= baca_database('','id_member',"select * from data_persetujuan_point where id_persetujuan_point='$id_persetujuan_point'");
$id_admin= baca_database('','id_admin',"select * from data_persetujuan_point where id_persetujuan_point='$id_persetujuan_point'");

date_default_timezone_set('Asia/Jakarta');
 $username = decrypt($_COOKIE['jenenge']);
 $tanggal_persetujuan = date('Y-m-d H:i:s');
 
$id_penyetuju = baca_database('','id_admin',"select * from data_admin where username='$username'");
$point_awal= baca_database('','point_awal',"select * from data_persetujuan_point where id_persetujuan_point='$id_persetujuan_point'");
$update_point= baca_database('','update_point',"select * from data_persetujuan_point where id_persetujuan_point='$id_persetujuan_point'");
$jenis= baca_database('','jenis',"select * from data_persetujuan_point where id_persetujuan_point='$id_persetujuan_point'");
 $status=$_GET['tipe'];

$query=mysql_query("update data_persetujuan_point set 
id_penyetuju='$id_penyetuju',
tanggal_persetujuan='$tanggal_persetujuan',
status='$status'

where id_persetujuan_point='$id_persetujuan_point' ") or die (mysql_error());

if ($status=="disetujui")
{

	if ($jenis == "edit poin")
	{
		$query1=mysql_query("update data_member set  point='$update_point' where id_member='$id_member' ") or die (mysql_error());
	}
	

}


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