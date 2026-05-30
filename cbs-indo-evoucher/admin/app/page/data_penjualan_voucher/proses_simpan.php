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


$id_penjualan = id_otomatis("data_penjualan_voucher", "id_penjualan", "10");
              $id_relasi=xss($_POST['id_relasi']);
              $tanggal_penjualan=xss($_POST['tanggal_penjualan']);
              $jumlah_voucher=xss($_POST['jumlah_voucher']);
              $nominal=xss($_POST['nominal']);
              $password_voucher=xss($_POST['password_voucher']);
              $tanggal_dibuka=xss($_POST['tanggal_dibuka']);
              $sub_total=xss($_POST['sub_total']);
              $persentase_ppn=xss($_POST['persentase_ppn']);
              $ppn=xss($_POST['ppn']);
              $total_bayar=xss($_POST['total_bayar']);


$query = mysql_query("insert into data_penjualan_voucher values (
'$id_penjualan'
 ,'$id_relasi'
 ,'$tanggal_penjualan'
 ,'$jumlah_voucher'
 ,'$nominal'
 ,'$password_voucher'
 ,'$tanggal_dibuka'
 ,'$sub_total'
 ,'$persentase_ppn'
 ,'$ppn'
 ,'$total_bayar'

)");

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_tambah";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
