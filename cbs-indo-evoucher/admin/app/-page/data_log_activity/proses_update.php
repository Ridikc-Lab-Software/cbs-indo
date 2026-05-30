<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_log_activity'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_log_activity = xss($_POST['id_log_activity']);
$waktu = xss($_POST['waktu']);
$kategori = xss($_POST['kategori']);
$deskripsi = xss($_POST['deskripsi']);


$query = mysql_query("update data_log_activity set 
waktu='$waktu',
kategori='$kategori',
deskripsi='$deskripsi'

where id_log_activity='$id_log_activity' ") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
