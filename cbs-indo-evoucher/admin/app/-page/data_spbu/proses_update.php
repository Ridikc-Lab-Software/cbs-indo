<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_spbu'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_spbu = xss($_POST['id_spbu']);
$nama_spbu = xss($_POST['nama_spbu']);
$alamat1 = xss($_POST['alamat1']);
$alamat2 = xss($_POST['alamat2']);
$telepon = xss($_POST['telepon']);
$penutup = xss($_POST['penutup']);


$query = mysql_query("update data_spbu set 
nama_spbu='$nama_spbu',
alamat1='$alamat1',
alamat2='$alamat2',
telepon='$telepon',
penutup='$penutup'

where id_spbu='$id_spbu' ") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
