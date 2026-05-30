<?php if(empty($p)) { header("Location: index.php?=home"); die(); } ?>


<?php
if (!isset($_GET['action']))
{	
	    //TAMPIL BERITA
	    prestasi("data_prestasi","id_prestasi","tanggal","judul","foto","keterangan");
}
else
{
	$action = $_GET['action'];
	if ($action == "detail" || $action == "simpan")
	{
		//DETAIL
		$proses = $_GET['proses'];
		detail_prestasi("data_prestasi","tanggal","id_prestasi","judul","foto","keterangan",$proses);
	}
		//KOMENTAR
	elseif ($action == "simpan")
	{
		
	}
}

 ?>

 
 







