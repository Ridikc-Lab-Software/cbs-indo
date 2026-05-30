<?php
if (!empty($halaman)) {
	echo "ini home";
} else {
	if (!empty($_GET['input'])) {
		$input = mysql_real_escape_string($_GET['input']);

		if ($input == 'tampil') {
			//TAMPIL
			include 'tampil.php';
		} elseif ($input == 'cetak_penjualan') {
			//POPUP TAMBAH
			include 'cetak_penjualan.php';
		} elseif ($input == 'cetak_transaksi') {
			//POPUP TAMBAH
			include 'cetak_transaksi.php';
		} elseif ($input == 'cetak_penjualan') {
			//POPUP TAMBAH
			include 'cetak_penjualan.php';
		} elseif ($input == 'cetak_relasi') {
			//POPUP TAMBAH
			include 'cetak_relasi.php';
		} elseif ($input == 'cetak_belum_transaksi') {
			//POPUP TAMBAH
			include 'cetak_belum_transaksi.php';
		} elseif ($input == 'cetak_masa_aktif') {
			//POPUP TAMBAH
			include 'cetak_masa_aktif.php';
		
		} elseif ($input == 'cetak_sisa_voucher') {
			//POPUP TAMBAH
			include 'cetak_sisa_voucher.php';
		}else {
			//LAINNYA
			echo "404";
		}
	} else {
		//TAMPIL
		include 'tampil.php';
	}
}
