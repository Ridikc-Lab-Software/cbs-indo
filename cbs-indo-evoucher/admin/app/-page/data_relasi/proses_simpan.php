<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_relasi'])) {
        
?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
<?php
    die();
}


$id_relasi = id_otomatis("data_relasi", "id_relasi", "10");
$nama = xss($_POST['nama']);
$nomor_telepon = xss($_POST['nomor_telepon']);
$email = xss($_POST['email']);
$alamat = xss($_POST['alamat']);
$id_spbu = xss($_POST['id_spbu']);
$nama_spbu = baca_database("data_spbu", "nama_spbu", "SELECT nama_spbu FROM data_spbu WHERE id_spbu = '$id_spbu'");
$password = ($_POST['password']);
$tanggal_daftar = date('Y-m-d H:i:s');


$query = mysql_query("insert into data_relasi values (
'$id_relasi'
 ,'$nama'
 ,'$nomor_telepon'
 ,'$email'
 ,'$alamat'
 ,'$id_spbu'
 ,'$nama_spbu'
 ,'$password'
 ,'$tanggal_daftar'

)");

if ($query) {
?>
    <script>
        location.href = "<?php index(); ?>?input=popup_tambah";
    </script>
<?php
} else {
    echo "GAGAL DIPROSES";
}
?>