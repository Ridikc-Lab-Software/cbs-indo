<?php if(empty($p)) { header("Location: index.php?=home"); die(); } ?>

<?php
if (!isset($_GET['action']))
{	
	    //TAMPIL BERITA
	    berita("data_berita","id_berita","tanggal","kategori_berita","judul","foto","");
}
else
{
	$action = $_GET['action'];
	if ($action == "detail" || $action == "simpan")
	{
		//DETAIL
		$proses = $_GET['proses'];
		detail_berita("data_berita","id_berita","tanggal","id_kategori_berita","judul","foto","isi",$proses);
	}
		//KOMENTAR
	elseif ($action == "simpan")
	{
		
	}
}

 ?>

 
 







