<?php
include '../../../include/all_include.php';

if (!isset($_POST['id_log_activity'])) {
        
?>
    <script>
        alert("AKSES DITOLAK");
        location.href = "index.php";
    </script>
<?php
    die();
}


$id_log_activity = "LOG" . date('YmdHis');
$waktu = date('Y-m-d H:i:s');
$kategori = "";

$ip = $_SERVER['REMOTE_ADDR'];
$useragent = $_SERVER['HTTP_USER_AGENT'];
$url = $_SERVER['REQUEST_URI'];
$deskripsi = "IP: " . $ip . " USER AGENT: " . $useragent . " URL: " . $url;


$query = mysql_query("insert into data_log_activity values (
'$id_log_activity'
 ,'$waktu'
 ,'$kategori'
 ,'$deskripsi'

)");

if ($query) {
?>
    <script>
        location.href = "<?php index(); ?>?input=popup_tambah";
    </script>
<?php
} else {
    echo "GAGAL DIPROSES";
}
?>