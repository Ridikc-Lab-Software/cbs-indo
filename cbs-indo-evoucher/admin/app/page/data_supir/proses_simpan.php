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

$id_supir = id_otomatis("data_supir", "id_supir", "10");
$nama_supir=xss($_POST['nama_supir']);
$id_relasi=xss($_POST['id_relasi']);

$query = mysql_query("insert into data_supir values (
'$id_supir'
 ,'$nama_supir'
 ,'$id_relasi'
)");

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_tambah";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
