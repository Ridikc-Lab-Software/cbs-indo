<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_voucher'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_voucher = xss($_POST['id_voucher']);
$qrcode = xss($_POST['qrcode']);
$id_relasi = xss($_POST['id_relasi']);
$nominal = xss($_POST['nominal']);
$tanggal_kadaluarsa = xss($_POST['tanggal_kadaluarsa']);
$id_spbu = xss($_POST['id_spbu']);
$id_penjualan = xss($_POST['id_penjualan']);
$status = xss($_POST['status']);
$file_voucher=($_FILES['file_voucher']['name']); if (empty($file_voucher)){$file_voucher = $_POST['file_voucher1'];} else { $file_voucher = upload('file_voucher');};
$tanggal_dibuka = xss($_POST['tanggal_dibuka']);


$query = mysql_query("update data_voucher set 
qrcode='$qrcode',
id_relasi='$id_relasi',
nominal='$nominal',
tanggal_kadaluarsa='$tanggal_kadaluarsa',
id_spbu='$id_spbu',
id_penjualan='$id_penjualan',
status='$status',
file_voucher='$file_voucher',
tanggal_dibuka='$tanggal_dibuka'

where id_voucher='$id_voucher' ") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
