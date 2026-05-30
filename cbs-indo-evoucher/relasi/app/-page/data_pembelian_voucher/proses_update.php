<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_penjualan'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_penjualan = xss($_POST['id_penjualan']);
$id_relasi = xss($_POST['id_relasi']);
$tanggal_penjualan = xss($_POST['tanggal_penjualan']);
$jumlah_voucher = xss($_POST['jumlah_voucher']);
$nominal = xss($_POST['nominal']);
$password_voucher = xss($_POST['password_voucher']);
$tanggal_dibuka = xss($_POST['tanggal_dibuka']);
$sub_total = xss($_POST['sub_total']);
$persentase_ppn = xss($_POST['persentase_ppn']);
$ppn = xss($_POST['ppn']);
$total_bayar = xss($_POST['total_bayar']);


$query = mysql_query("update data_penjualan_voucher set 
id_relasi='$id_relasi',
tanggal_penjualan='$tanggal_penjualan',
jumlah_voucher='$jumlah_voucher',
nominal='$nominal',
password_voucher='$password_voucher',
tanggal_dibuka='$tanggal_dibuka',
sub_total='$sub_total',
persentase_ppn='$persentase_ppn',
ppn='$ppn',
total_bayar='$total_bayar'

where id_penjualan='$id_penjualan' ") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
