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

$id_bank = xss($_POST['id_bank']);
$nama_bank = xss($_POST['nama_bank']);
$nomor_rekening = xss($_POST['nomor_rekening']);
$atas_nama = xss($_POST['atas_nama']);
$gambar=($_FILES['gambar']['name']); if (empty($gambar)){$gambar = $_POST['gambar1'];} else { $gambar = upload('gambar');};


$query = mysql_query("update data_bank set 
nama_bank='$nama_bank',
nomor_rekening='$nomor_rekening',
atas_nama='$atas_nama',
gambar='$gambar'

where id_bank='$id_bank' ") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
