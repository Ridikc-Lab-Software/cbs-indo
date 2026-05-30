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

$id_harga_transaksi = id_otomatis("data_harga_transaksi", "id_harga_transaksi", "10");
$id_transaksi=xss($_POST['id_transaksi']);
$id_jenis_transaksi=xss($_POST['id_jenis_transaksi']);
$jenis_transaksi=xss($_POST['jenis_transaksi']);
$point=xss($_POST['point']);
$harga=xss($_POST['harga']);

$query = mysql_query("insert into data_harga_transaksi values (
'$id_harga_transaksi'
 ,'$id_transaksi'
 ,'$id_jenis_transaksi'
 ,'$jenis_transaksi'
 ,'$point'
 ,'$harga'
)");

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_tambah";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
