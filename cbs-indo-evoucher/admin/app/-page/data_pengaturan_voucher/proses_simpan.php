<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_pengaturan'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}


$id_pengaturan = id_otomatis("data_pengaturan_voucher", "id_pengaturan", "10");
              $nama=xss($_POST['nama']);
              $isi=xss($_POST['isi']);
              $status=xss($_POST['status']);


$query = mysql_query("insert into data_pengaturan_voucher values (
'$id_pengaturan'
 ,'$nama'
 ,'$isi'
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
