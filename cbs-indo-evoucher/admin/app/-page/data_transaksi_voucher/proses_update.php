<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_transaksi'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_transaksi = xss($_POST['id_transaksi']);
$id_voucher = xss($_POST['id_voucher']);
$id_member = xss($_POST['id_member']);
$nama_member = xss($_POST['nama_member']);
$tanggal_transaksi = xss($_POST['tanggal_transaksi']);
$jenis_bbm = xss($_POST['jenis_bbm']);
$nominal = xss($_POST['nominal']);


$query = mysql_query("update data_transaksi_voucher set 
id_voucher='$id_voucher',
id_member='$id_member',
nama_member='$nama_member',
tanggal_transaksi='$tanggal_transaksi',
jenis_bbm='$jenis_bbm',
nominal='$nominal'

where id_transaksi='$id_transaksi' ") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
