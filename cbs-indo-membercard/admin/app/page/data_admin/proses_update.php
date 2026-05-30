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

$id_admin=xss($_POST['id_admin']);
$hak_akses=xss($_POST['hak_akses']);
$username=xss($_POST['username']);
if ($_POST['password'] == "")
{
  $password=($_POST['password_lama']);
}
else
{
  $password=md5($_POST['password']);
}

$nama_spbu=xss($_POST['nama_spbu']);
$nama=xss($_POST['nama']);
$jabatan=xss($_POST['jabatan']);
if (!empty($_FILES['foto_tanda_tangan']['name'])) 
{
    $foto_tanda_tangan=upload('foto_tanda_tangan');
}
else
{
	  $foto_tanda_tangan=$_POST['foto_tanda_tangan1'];
}


$query = mysql_query("UPDATE data_admin SET
hak_akses = '$hak_akses'
, username = '$username'
, password = '$password'
, nama_spbu = '$nama_spbu'
, nama = '$nama'
, jabatan = '$jabatan'
, foto_tanda_tangan = '$foto_tanda_tangan'
WHERE id_admin = '$id_admin'") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
