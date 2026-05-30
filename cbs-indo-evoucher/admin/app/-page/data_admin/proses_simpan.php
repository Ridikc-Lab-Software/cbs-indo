<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_admin'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_admin = id_otomatis("data_admin", "id_admin", "10");
$hak_akses=xss($_POST['hak_akses']);
$username=xss($_POST['username']);
$password=md5($_POST['password']);
$nama_spbu=xss($_POST['nama_spbu']);
$nama=xss($_POST['nama']);
$jabatan=xss($_POST['jabatan']);
$foto_tanda_tangan=uploadtomember('foto_tanda_tangan');

$query = mysql_query("insert into data_admin values (
'$id_admin'
 ,'$hak_akses'
 ,'$username'
 ,'$password'
 ,'$nama_spbu'
 ,'$nama'
 ,'$jabatan'
 ,'$foto_tanda_tangan'
)");

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_tambah";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
