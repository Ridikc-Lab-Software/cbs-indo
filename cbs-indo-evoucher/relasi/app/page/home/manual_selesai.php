<?php
include '../../../include/all_include.php';



$id_transaksi = id_otomatis("data_transaksi_voucher", "id_transaksi", "10");
$id_voucher = ($_POST['id_voucher']);
$id_member = ($_POST['id_member']);
$nama_member = baca_database("", "nama", "select nama from data_member where id_member='$id_member'");
$tanggal_transaksi = date('Y-m-d H:i:s');
$jenis_bbm = $_POST['jenis_bbm'];
$nominal = $_POST['nominal'];


$point_awal = baca_database("", "point", "select point from data_member where id_member='$id_member'");
$point_bbm = baca_database("", "point", "select * from data_jenis_transaksi where jenis_transaksi='$jenis_bbm'");
$point_harga = baca_database("", "harga", "select * from data_jenis_transaksi where jenis_transaksi='$jenis_bbm'");
$jumlah_point = floor($nominal / $point_harga);
$point_tambahan = $jumlah_point * $point_bbm;
$point_akhir = $point_awal + $point_tambahan;

$query = mysql_query("insert into data_transaksi_voucher values (
'$id_transaksi'
 ,'$id_voucher'
 ,'$id_member'
 ,'$nama_member'
 ,'$tanggal_transaksi'
 ,'$jenis_bbm'
 ,'$nominal'

)");



$ip = $_SERVER['REMOTE_ADDR'];
$useragent = $_SERVER['HTTP_USER_AGENT'];
$token = sha1($ip . $useragent . $key);
$token = crypt($token, $key);
setcookie('token', $token, time() + (6000 * 6000), '/');
$id_admin = $data["id_admin"];

$jenenge = decrypt($_COOKIE['jenenge']);

$id_log_activity = "LOG" . date('YmdHis');
$waktu = date('Y-m-d H:i:s');
$kategori = $jenenge." Transaksi Manual KODE : " . $id_transaksi." ($nama_member | $jenis_bbm |  $nominal  )";
$ip = $_SERVER['REMOTE_ADDR'];
$useragent = $_SERVER['HTTP_USER_AGENT'];
$url = $_SERVER['REQUEST_URI'];
$deskripsi = "IP: " . $ip . " USER AGENT: " . $useragent . " URL: " . $url;
$query = mysql_query("insert into data_log_activity values (
					'$id_log_activity'
					,'$waktu'
					,'$id_admin'
					,'$kategori'
					,'$deskripsi'
					)");


$query = mysql_query("update data_voucher set 
status='used'
where id_voucher='$id_voucher' ") or die(mysql_error());



$query = mysql_query("update data_member set 
point='$point_akhir'
where id_member='$id_member' ") or die(mysql_error());
?>



<script>
	alert("Transaksi Berhasil Diproses");
	window.location.href = "../home/index.php";
</script>