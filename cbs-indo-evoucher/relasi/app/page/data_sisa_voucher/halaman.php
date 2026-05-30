<?php
if (!empty($halaman)) {
	include 'tampil.php';
} else {
	$input = isset($_GET['input']) ? mysql_real_escape_string($_GET['input']) : 'tampil';

	$fileMap = [
		'tampil'         => 'tampil.php',
		'tambah'         => 'tambah.php',
		'detail'         => 'detail.php',
		'edit'           => 'edit.php',
		'hapus'          => 'hapus.php',
		'proses_tambah'  => 'proses_tambah.php',
		'proses_edit'    => 'proses_edit.php',
		'proses_hapus'   => 'proses_hapus.php',
		'cetak'          => 'cetak.php',
	];

	$popupMap = [
		'popup_hapus'  => 'DATA BERHASIL DIHAPUS',
		'popup_edit'   => 'DATA BERHASIL DIEDIT',
		'popup_tambah' => 'DATA BERHASIL DITAMBAHKAN',
	];

	if (isset($fileMap[$input])) {
		include $fileMap[$input];
	} elseif (isset($popupMap[$input])) {
		include 'tampil.php';
		popup($popupMap[$input], "SELESAI", "", $url_index, $url_index);
	} else {
		include 'tampil.php';
	}
}
