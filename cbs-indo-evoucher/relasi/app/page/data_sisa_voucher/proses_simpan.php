<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_sisa_voucher'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_sisa_voucher = id_otomatis("data_sisa_voucher", "id_sisa_voucher", "10");
$id_voucher=xss($_POST['id_voucher']);
$id_relasi=xss($_POST['id_relasi']);
$nominal_voucher=xss($_POST['nominal_voucher']);
$nominal_transaksi=xss($_POST['nominal_transaksi']);
$nominal_sisa=xss($_POST['nominal_sisa']);
$tanggal_transaksi=xss($_POST['tanggal_transaksi']);
$status=xss($_POST['status']);

$query = mysql_query("insert into data_sisa_voucher values (
'$id_sisa_voucher'
 ,'$id_voucher'
 ,'$id_relasi'
 ,'$nominal_voucher'
 ,'$nominal_transaksi'
 ,'$nominal_sisa'
 ,'$tanggal_transaksi'
 ,'$status'
)");

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_tambah";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
