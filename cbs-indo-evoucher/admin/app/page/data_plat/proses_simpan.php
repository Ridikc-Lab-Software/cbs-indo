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

$id_plat = id_otomatis("data_plat", "id_plat", "10");
$plat=xss($_POST['plat']);
$id_relasi=xss($_POST['id_relasi']);

$query = mysql_query("insert into data_plat values (
'$id_plat'
 ,'$plat'
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
