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


$id_transaksi = id_otomatis("data_transaksi_voucher", "id_transaksi", "10");
$id_voucher = xss($_POST['id_voucher']);
$id_member = xss($_POST['id_member']);
$nama_member = xss($_POST['nama_member']);
$tanggal_transaksi = xss($_POST['tanggal_transaksi']);
$jenis_bbm = xss($_POST['jenis_bbm']);
$nominal = xss($_POST['nominal']);


$query = mysql_query("insert into data_transaksi_voucher values (
'$id_transaksi'
 ,'$id_voucher'
 ,'$id_member'
 ,'$nama_member'
 ,'$tanggal_transaksi'
 ,'$jenis_bbm'
 ,'$nominal'

)");

if ($query) {
?>
    <script>
        location.href = "<?php index(); ?>?input=popup_tambah";
    </script>
<?php
} else {
    echo "GAGAL DIPROSES";
}
?>