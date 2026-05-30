<?php if(empty($p)) { header("Location: index.php?=home"); die(); } ?>

<br>
<br>
<br>
<center><h2><b> GALERY VIDIO</b></h2></center>


<?php vidio("data_vidio","id_vidio","tanggal","judul","vidio","keterangan");?>

