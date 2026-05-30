<?php
if (!empty($halaman)) {
	echo "ini home";
} else {
	if (!empty($_GET['input'])) {
		$input = mysql_real_escape_string($_GET['input']);

		if ($input == 'tampil') {
			//TAMPIL
			include 'tampil.php';
		} elseif ($input == 'grafik_penjualan') {
			//POPUP TAMBAH
			include 'grafik_penjualan.php';
		} elseif ($input == 'grafik_transaksi') {
			//POPUP TAMBAH
			include 'grafik_transaksi.php';
		} elseif ($input == 'grafik_relasi') {
			//POPUP TAMBAH
			include 'grafik_relasi.php';
		} elseif ($input == 'grafik_pernominal') {
			//POPUP TAMBAH
			include 'grafik_pernominal.php';
		} elseif ($input == 'jenis_bbm') {
			//POPUP TAMBAH
			include 'jenis_bbm.php';
		} elseif ($input == 'cetak_masa_aktif') {
			//POPUP TAMBAH
			include 'cetak_masa_aktif.php';
		} else {
			//LAINNYA
			echo "404";
		}
	} else {
		//TAMPIL
		include 'tampil.php';
	}
}
