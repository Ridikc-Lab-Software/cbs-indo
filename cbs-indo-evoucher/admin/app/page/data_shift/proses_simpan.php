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

$id_shift = id_otomatis("data_shift", "id_shift", "10");
$shift=xss($_POST['shift']);
$jam_mulai=xss($_POST['jam_mulai']);
$jam_selesai=xss($_POST['jam_selesai']);

$query = mysql_query("insert into data_shift values (
'$id_shift'
 ,'$shift'
 ,'$jam_mulai'
 ,'$jam_selesai'
)");

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_tambah";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
