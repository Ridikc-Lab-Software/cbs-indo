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

$id_kategori_member = xss($_POST['id_kategori_member']);
$kategori_member = xss($_POST['kategori_member']);
$gambar_logo=($_FILES['gambar_logo']['name']); if (empty($gambar_logo)){$gambar_logo = $_POST['gambar_logo1'];} else { $gambar_logo = upload('gambar_logo');};
$maksimal_transaksi = xss($_POST['maksimal_transaksi']);


$query = mysql_query("update data_kategori_member set 
kategori_member='$kategori_member',
gambar_logo='$gambar_logo',
maksimal_transaksi='$maksimal_transaksi'

where id_kategori_member='$id_kategori_member' ") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
