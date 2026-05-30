<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_plat'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_plat=xss($_POST['id_plat']);
$plat=xss($_POST['plat']);
$id_relasi=xss($_POST['id_relasi']);


$query = mysql_query("UPDATE data_plat SET
plat = '$plat'
, id_relasi = '$id_relasi'
WHERE id_plat = '$id_plat'") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
