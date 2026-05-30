<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_jenis_transaksi'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}


$id_jenis_transaksi = id_otomatis("data_jenis_transaksi", "id_jenis_transaksi", "10");
              $jenis_transaksi=xss($_POST['jenis_transaksi']);
              $gambar_logo=upload('gambar_logo');
              $point=xss($_POST['point']);
              $harga=xss($_POST['harga']);


$query = mysql_query("insert into data_jenis_transaksi values (
'$id_jenis_transaksi'
 ,'$jenis_transaksi'
 ,'$gambar_logo'
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
