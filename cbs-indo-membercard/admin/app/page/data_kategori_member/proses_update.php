<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_kategori_member'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_kategori_member=xss($_POST['id_kategori_member']);
$kategori_member=xss($_POST['kategori_member']);
if (!empty($_FILES['gambar_logo']['name'])) 
{
    $gambar_logo=upload('gambar_logo');
}
else
{
	  $gambar_logo=$_POST['gambar_logo1'];
}
$maksimal_transaksi=xss($_POST['maksimal_transaksi']);
$jenis=xss($_POST['jenis']);


$query = mysql_query("UPDATE data_kategori_member SET
kategori_member = '$kategori_member'
, gambar_logo = '$gambar_logo'
, maksimal_transaksi = '$maksimal_transaksi'
, jenis = '$jenis'
WHERE id_kategori_member = '$id_kategori_member'") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
