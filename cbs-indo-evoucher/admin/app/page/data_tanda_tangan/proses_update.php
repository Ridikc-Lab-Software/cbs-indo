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

$id_tanda_tangan = xss($_POST['id_tanda_tangan']);
$hak_akses = xss($_POST['hak_akses']);
$tanda_tangan = !empty($_FILES)?upload('tanda_tangan'):$_POST['tanda_tangan1'];


$query = mysql_query("update data_tanda_tangan set 
hak_akses='$hak_akses',
tanda_tangan='$tanda_tangan'

where id_tanda_tangan='$id_tanda_tangan' ") or die(mysql_error());

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