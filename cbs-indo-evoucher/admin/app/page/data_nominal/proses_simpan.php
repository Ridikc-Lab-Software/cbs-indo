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

$id_nominal = id_otomatis("data_nominal", "id_nominal", "10");
$nominal=xss($_POST['nominal']);

$query = mysql_query("insert into data_nominal values (
'$id_nominal'
 ,'$nominal'
)");

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_tambah";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
