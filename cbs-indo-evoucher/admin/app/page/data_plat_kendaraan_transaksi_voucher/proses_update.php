<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_plat_kendaraan_transaksi_voucher'])) {
        
    ?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
    <?php
    die();
}

$id_plat_kendaraan_transaksi_voucher=xss($_POST['id_plat_kendaraan_transaksi_voucher']);
$id_transaksi_voucher=xss($_POST['id_transaksi_voucher']);
$no_plat_kendaraan=xss($_POST['no_plat_kendaraan']);
$id_supir=xss($_POST['id_supir']);
$id_relasi=xss($_POST['id_relasi']);
if (!empty($_FILES['foto']['name'])) 
{
    $foto=upload('foto');
}
else
{
	  $foto=$_POST['foto1'];
}


$query = mysql_query("UPDATE data_plat_kendaraan_transaksi_voucher SET
id_transaksi_voucher = '$id_transaksi_voucher'
, no_plat_kendaraan = '$no_plat_kendaraan'
, id_supir = '$id_supir'
, id_relasi = '$id_relasi'
, foto = '$foto'
WHERE id_plat_kendaraan_transaksi_voucher = '$id_plat_kendaraan_transaksi_voucher'") or die(mysql_error());

if ($query) {
    ?>
    <script>location.href = "<?php index(); ?>?input=popup_edit";</script>
    <?php
} else {
    echo "GAGAL DIPROSES";
}
?>
