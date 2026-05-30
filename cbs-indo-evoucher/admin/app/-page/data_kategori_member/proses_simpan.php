<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_kategori_member'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}


$id_kategori_member = id_otomatis("data_kategori_member", "id_kategori_member", "10");
              $kategori_member=xss($_POST['kategori_member']);
              $gambar_logo=upload('gambar_logo');
              $maksimal_transaksi=xss($_POST['maksimal_transaksi']);


$query = mysql_query("insert into data_kategori_member values (
'$id_kategori_member'
 ,'$kategori_member'
 ,'$gambar_logo'
 ,'$maksimal_transaksi'

)");

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_tambah";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
