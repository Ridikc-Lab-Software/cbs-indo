<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_plat_kendaraan_transaksi_voucher'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_plat_kendaraan_transaksi_voucher = id_otomatis("data_plat_kendaraan_transaksi_voucher", "id_plat_kendaraan_transaksi_voucher", "10");
$id_transaksi_voucher=xss($_POST['id_transaksi_voucher']);
$no_plat_kendaraan=xss($_POST['no_plat_kendaraan']);
$id_supir=xss($_POST['id_supir']);
$id_relasi=xss($_POST['id_relasi']);
$foto=upload('foto');

$query = mysql_query("insert into data_plat_kendaraan_transaksi_voucher values (
'$id_plat_kendaraan_transaksi_voucher'
 ,'$id_transaksi_voucher'
 ,'$no_plat_kendaraan'
 ,'$id_supir'
 ,'$id_relasi'
 ,'$foto'
)");

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_tambah";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
