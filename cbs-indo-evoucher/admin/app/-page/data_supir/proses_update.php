<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_supir'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_supir=xss($_POST['id_supir']);
$nama_supir=xss($_POST['nama_supir']);
$id_relasi=xss($_POST['id_relasi']);


$query = mysql_query("UPDATE data_supir SET
nama_supir = '$nama_supir'
, id_relasi = '$id_relasi'
WHERE id_supir = '$id_supir'") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
