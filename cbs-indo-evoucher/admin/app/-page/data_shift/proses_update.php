<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_shift'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_shift=xss($_POST['id_shift']);
$shift=xss($_POST['shift']);
$jam_mulai=xss($_POST['jam_mulai']);
$jam_selesai=xss($_POST['jam_selesai']);


$query = mysql_query("UPDATE data_shift SET
shift = '$shift'
, jam_mulai = '$jam_mulai'
, jam_selesai = '$jam_selesai'
WHERE id_shift = '$id_shift'") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
