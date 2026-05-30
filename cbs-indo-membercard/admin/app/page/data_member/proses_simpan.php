<?php include '../../../include/all_include.php';

if (!isset($_POST['id_member'])) {
	     ?>
	<script>
		alert("AKSES DITOLAK");
		location.href = "index.php";
	</script>
	<?php
	die();
}


$id_member = id_otomatis("data_member", "id_member", "10");

$nama = xss($_POST['nama']);
$alamat = xss($_POST['alamat']);
$no_telepon = xss($_POST['no_telepon']);
$tanggal_terdaftar = xss($_POST['tanggal_terdaftar']);
$id_kategori_member = xss($_POST['id_kategori_member']);
$kode_rfid = xss($_POST['kode_rfid']);
$password = md5($_POST['password']);
$pekerjaan = xss($_POST['pekerjaan']);
$username = xss($_POST['username']);
$point = xss($_POST['point']);
// $kewarganegawaan = xss($_POST['kewarganegawaan']);
$id_admin = xss($_POST['id_admin']);
$spbu = xss($_POST['spbu']);



$nik = xss($_POST['nik']);
if (empty($nik))
	$nik = '0';
$jenis_kelamin = xss($_POST['jenis_kelamin']);
if ($jenis_kelamin != 'laki-laki' && $jenis_kelamin != 'perempuan')
	$jenis_kelamin = 'laki-laki';

$agama = xss($_POST['agama']);
if (!in_array($agama, ['Islam', 'Kristen Katolik', 'Kristen Protestan', 'Hindu', 'Budha']))
	$agama = 'Islam';

$status_perkawinan = isset($_POST['status_perkawinan']) ? xss($_POST['status_perkawinan']) : 'Belum Menikah';
if (!in_array($status_perkawinan, ['Menikah', 'Belum Menikah'])) {
	$status_perkawinan = 'Belum Menikah';
}

$tanggal_lahir = $_POST['tanggal_lahir'];
if ($tanggal_lahir == "") {
	$tanggal_lahir = "NULL";
}


$cek_hp = mysql_query("SELECT no_telepon FROM data_member WHERE no_telepon='$no_telepon' LIMIT 1");
if (mysql_num_rows($cek_hp) > 0) {
	?>
	<script>
		alert("Nomor telepon ini sudah terdaftar! Silakan gunakan nomor lain.");
		history.back();
	</script>
	<?php
	exit;
}



$query = mysql_query("insert into data_member values (
'$id_member'
 ,'$nik'
 ,'$nama'
 ,'$alamat'
 ,'$no_telepon'
 ,'$jenis_kelamin'
 ,'$tanggal_terdaftar'
 ,'$id_kategori_member'
 ,'$kode_rfid'
 ,'$point'
 ,'$username'
 ,'$password'
 ,'$tanggal_lahir'
 ,'$agama'
 ,'$status_perkawinan'
 ,'$pekerjaan'
 ,'$id_admin'
  ,'$spbu'

)");

if ($query) {
	?>
	<script>
		alert("Pendaftaran Member Berhasil.");
		location.href = "<?php index(); ?>?input=popup_tambah";
	</script>
	<?php
} else {
	echo "GAGAL DIPROSES";
}
?>