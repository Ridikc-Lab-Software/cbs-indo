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


$id_voucher = id_otomatis("data_voucher", "id_voucher", "10");
              $qrcode=xss($_POST['qrcode']);
              $id_relasi=xss($_POST['id_relasi']);
              $nominal=xss($_POST['nominal']);
              $tanggal_kadaluarsa=xss($_POST['tanggal_kadaluarsa']);
              $id_spbu=xss($_POST['id_spbu']);
              $id_penjualan=xss($_POST['id_penjualan']);
              $status=xss($_POST['status']);
              $file_voucher=upload('file_voucher');
              $tanggal_dibuka=xss($_POST['tanggal_dibuka']);


$query = mysql_query("insert into data_voucher values (
'$id_voucher'
 ,'$qrcode'
 ,'$id_relasi'
 ,'$nominal'
 ,'$tanggal_kadaluarsa'
 ,'$id_spbu'
 ,'$id_penjualan'
 ,'$status'
 ,'$file_voucher'
 ,'$tanggal_dibuka'

)");

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_tambah";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
