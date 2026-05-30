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

$id_relasi = xss($_POST['id_relasi']);
$nama = xss($_POST['nama']);
$nomor_telepon = xss($_POST['nomor_telepon']);
$email = xss($_POST['email']);
$alamat = xss($_POST['alamat']);
$id_spbu = xss($_POST['id_spbu']);
$nama_spbu = baca_database("data_spbu", "nama_spbu", "SELECT nama_spbu FROM data_spbu WHERE id_spbu = '$id_spbu'");
$password = ($_POST['password']);


$query = mysql_query("update data_relasi set
nama='$nama',
nomor_telepon='$nomor_telepon',
email='$email',
alamat='$alamat',
id_spbu='$id_spbu',
nama_spbu='$nama_spbu',
password='$password'

where id_relasi='$id_relasi' ") or die(mysql_error());

if ($query) {
?>
    <script>
        location.href = "<?php index(); ?>?input=popup_edit";
    </script>
<?php
} else {
    echo "GAGAL DIPROSES";
}
?>