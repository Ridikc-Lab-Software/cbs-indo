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

$id_pengaturan = id_otomatis("data_pengaturan", "id_pengaturan", "10");
$nama=xss($_POST['nama']);
$value=xss($_POST['value']);

$query = mysql_query("insert into data_pengaturan values (
'$id_pengaturan'
 ,'$nama'
 ,'$value'
)");

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_tambah";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
