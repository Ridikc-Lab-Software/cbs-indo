<?php include '../admin/include/koneksi/koneksi.php';

$q = mysql_query("SELECT value FROM data_pengaturan WHERE nama='url_evoucher' LIMIT 1");
$d = mysql_fetch_array($q);
$url_evoucher = $d['value'];

?>
<script>
    window.location.href='<?php echo $url_evoucher ;?>index.php?p=home&code=<?php echo  $_GET['code'];
?>';
</script>
