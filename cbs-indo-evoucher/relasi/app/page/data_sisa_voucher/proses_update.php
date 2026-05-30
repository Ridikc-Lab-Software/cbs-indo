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

$id_sisa_voucher=xss($_POST['id_sisa_voucher']);
$id_voucher=xss($_POST['id_voucher']);
$id_relasi=xss($_POST['id_relasi']);
$nominal_voucher=xss($_POST['nominal_voucher']);
$nominal_transaksi=xss($_POST['nominal_transaksi']);
$nominal_sisa=xss($_POST['nominal_sisa']);
$tanggal_transaksi=xss($_POST['tanggal_transaksi']);
$status=xss($_POST['status']);


$query = mysql_query("UPDATE data_sisa_voucher SET
id_voucher = '$id_voucher'
, id_relasi = '$id_relasi'
, nominal_voucher = '$nominal_voucher'
, nominal_transaksi = '$nominal_transaksi'
, nominal_sisa = '$nominal_sisa'
, tanggal_transaksi = '$tanggal_transaksi'
, status = '$status'
WHERE id_sisa_voucher = '$id_sisa_voucher'") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
