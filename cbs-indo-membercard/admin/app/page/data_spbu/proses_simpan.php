<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_spbu'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}


$id_spbu = id_otomatis("data_spbu", "id_spbu", "10");
              $nama_spbu=xss($_POST['nama_spbu']);
              $alamat1=xss($_POST['alamat1']);
              $alamat2=xss($_POST['alamat2']);
              $telepon=xss($_POST['telepon']);
              $penutup=xss($_POST['penutup']);


$query = mysql_query("insert into data_spbu values (
'$id_spbu'
 ,'$nama_spbu'
 ,'$alamat1'
 ,'$alamat2'
 ,'$telepon'
 ,'$penutup'

)");

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_tambah";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
