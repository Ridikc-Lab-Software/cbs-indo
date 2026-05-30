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

$id_pengaturan = xss($_POST['id_pengaturan']);
$nama = xss($_POST['nama']);
$isi = xss($_POST['isi']);
$status = xss($_POST['status']);


$query = mysql_query("update data_pengaturan_voucher set 
nama='$nama',
isi='$isi',
status='$status'

where id_pengaturan='$id_pengaturan' ") or die(mysql_error());

if ($query) {
?>
    <script>
        location.href = "../home/";
    </script>
<?php
} else {
    echo "GAGAL DIPROSES";
}
?>