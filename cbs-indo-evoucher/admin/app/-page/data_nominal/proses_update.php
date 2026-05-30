<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_nominal'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_nominal=xss($_POST['id_nominal']);
$nominal=xss($_POST['nominal']);


$query = mysql_query("UPDATE data_nominal SET
nominal = '$nominal'
WHERE id_nominal = '$id_nominal'") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
