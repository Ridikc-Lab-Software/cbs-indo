<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_bank'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}


$id_bank = id_otomatis("data_bank", "id_bank", "10");
              $nama_bank=xss($_POST['nama_bank']);
              $nomor_rekening=xss($_POST['nomor_rekening']);
              $atas_nama=xss($_POST['atas_nama']);
              $gambar=upload('gambar');


$query = mysql_query("insert into data_bank values (
'$id_bank'
 ,'$nama_bank'
 ,'$nomor_rekening'
 ,'$atas_nama'
 ,'$gambar'

)");

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_tambah";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
