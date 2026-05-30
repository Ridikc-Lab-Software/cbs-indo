<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_harga_transaksi'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_harga_transaksi=xss($_POST['id_harga_transaksi']);
$id_transaksi=xss($_POST['id_transaksi']);
$id_jenis_transaksi=xss($_POST['id_jenis_transaksi']);
$jenis_transaksi=xss($_POST['jenis_transaksi']);
$point=xss($_POST['point']);
$harga=xss($_POST['harga']);


$query = mysql_query("UPDATE data_harga_transaksi SET
id_transaksi = '$id_transaksi'
, id_jenis_transaksi = '$id_jenis_transaksi'
, jenis_transaksi = '$jenis_transaksi'
, point = '$point'
, harga = '$harga'
WHERE id_harga_transaksi = '$id_harga_transaksi'") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
