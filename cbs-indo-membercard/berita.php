<?php if(empty($p)) { header("Location: index.php?=home"); die(); } ?>

<br>
<center><h2> BERITA </h2></center>
<br>

<?php
if (!isset($_GET['action']))
{	
	    //TAMPIL BERITA
	    berita("data_berita","id_berita","tanggal","judul","foto","isi");
}
else
{
	$action = $_GET['action'];
	if ($action == "detail" || $action == "simpan")
	{
		//DETAIL
		$proses = $_GET['proses'];
		detail_berita("data_berita","id_berita","tanggal","judul","foto","isi",$proses);
	}
		//KOMENTAR
	elseif ($action == "simpan")
	{
		
	}
}

 ?>

 
 







