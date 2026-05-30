<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_jenis_transaksi'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_jenis_transaksi = xss($_POST['id_jenis_transaksi']);
$jenis_transaksi = xss($_POST['jenis_transaksi']);
$gambar_logo=($_FILES['gambar_logo']['name']); if (empty($gambar_logo)){$gambar_logo = $_POST['gambar_logo1'];} else { $gambar_logo = upload('gambar_logo');};
$point = xss($_POST['point']);
$harga = xss($_POST['harga']);


$query = mysql_query("update data_jenis_transaksi set 
jenis_transaksi='$jenis_transaksi',
gambar_logo='$gambar_logo',
point='$point',
harga='$harga'

where id_jenis_transaksi='$id_jenis_transaksi' ") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
