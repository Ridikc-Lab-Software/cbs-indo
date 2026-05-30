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

$id_pengaturan=xss($_POST['id_pengaturan']);
$nama=xss($_POST['nama']);
$value=xss($_POST['value']);


$query = mysql_query("UPDATE data_pengaturan SET
nama = '$nama'
, value = '$value'
WHERE id_pengaturan = '$id_pengaturan'") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
