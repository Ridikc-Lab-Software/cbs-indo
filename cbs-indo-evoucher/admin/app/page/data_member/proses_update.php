<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_member'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_member = xss($_POST['id_member']);
$nik = xss($_POST['nik']);
$nama = xss($_POST['nama']);
$alamat = xss($_POST['alamat']);
$no_telepon = xss($_POST['no_telepon']);
$jenis_kelamin = xss($_POST['jenis_kelamin']);
$tanggal_terdaftar = xss($_POST['tanggal_terdaftar']);
$id_kategori_member = xss($_POST['id_kategori_member']);
$kode_rfid = xss($_POST['kode_rfid']);
$point = xss($_POST['point']);
$username = xss($_POST['username']);
$password = md5($_POST['password']);
$tanggal_lahir = xss($_POST['tanggal_lahir']);
$agama = xss($_POST['agama']);
$status_perkawinan = xss($_POST['status_perkawinan']);
$pekerjaan = xss($_POST['pekerjaan']);
$id_admin = xss($_POST['id_admin']);


$query = mysql_query("update data_member set 
nik='$nik',
nama='$nama',
alamat='$alamat',
no_telepon='$no_telepon',
jenis_kelamin='$jenis_kelamin',
tanggal_terdaftar='$tanggal_terdaftar',
id_kategori_member='$id_kategori_member',
kode_rfid='$kode_rfid',
point='$point',
username='$username',
password='$password',
tanggal_lahir='$tanggal_lahir',
agama='$agama',
status_perkawinan='$status_perkawinan',
pekerjaan='$pekerjaan',
id_admin='$id_admin'

where id_member='$id_member' ") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
