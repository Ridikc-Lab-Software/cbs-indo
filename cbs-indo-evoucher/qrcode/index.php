<?php
$kode = $_GET['kode'];
$qrcode = $_GET['kodeqr'];
?>
<iframe src="https://e-voucher.cbs-indo.com/admin/app/page/data_voucher/voucher.php?kode=<?php echo $kode;?>&kodeqr=<?php echo $qrcode;?>" 
        width="100%" height="100%" style="border:none;">
</iframe>
