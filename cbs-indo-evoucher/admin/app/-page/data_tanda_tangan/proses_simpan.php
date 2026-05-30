<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_tanda_tangan'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}


$id_tanda_tangan = id_otomatis("data_tanda_tangan", "id_tanda_tangan", "10");
              $hak_akses=xss($_POST['hak_akses']);

              $tanda_tangan=upload("tanda_tangan");


$query = mysql_query("insert into data_tanda_tangan values (
'$id_tanda_tangan'
 ,'$hak_akses'
 ,'$tanda_tangan'

)");

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_tambah";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
