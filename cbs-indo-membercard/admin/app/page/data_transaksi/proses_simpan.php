<?php
include '../../../include/all_include.php';

function id_otomatis_custom($tabel, $kolom, $prefix, $panjang_random)
{
	$query = mysql_query("SELECT MAX($kolom) as max_id FROM $tabel WHERE $kolom LIKE '$prefix%'");
	$data = mysql_fetch_array($query);
	$max_id = $data['max_id'];

	if ($max_id) {
		$nomor = substr($max_id, strlen($prefix));
		$nomor_next = str_pad($nomor + 1, $panjang_random, "0", STR_PAD_LEFT);
	} else {
		$nomor_next = str_pad(1, $panjang_random, "0", STR_PAD_LEFT);
	}
	return $prefix . $nomor_next;
}

// Cek akses POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	echo "<script>alert('Akses ditolak!'); location.href='index.php';</script>";
	die();
}

// Validasi wajib diisi
$required_fields = ['tanggal', 'jam', 'id_member', 'id_petugas', 'id_kategori_member', 'id_jenis_transaksi', 'point', 'kategori_jumlah', 'jumlah'];
foreach ($required_fields as $field) {
	if (!isset($_POST[$field]) || trim($_POST[$field]) === '') {
		echo "<script>alert('Data tidak lengkap!'); history.back();</script>";
		die();
	}
}

// Ambil dan bersihkan data
$tanggal = xss($_POST['tanggal']);
$jam = xss($_POST['jam']);
$id_member = xss($_POST['id_member']);
$id_petugas = xss($_POST['id_petugas']);
$id_kategori_member = xss($_POST['id_kategori_member']);
$id_jenis_transaksi = xss($_POST['id_jenis_transaksi']);
$point = xss($_POST['point']); // ini sudah final (bisa diedit manual)
$kategori_jumlah = xss($_POST['kategori_jumlah']);
$jumlah = xss($_POST['jumlah']);

// Generate ID Transaksi otomatis (format TRA + tanggal + jam + random)
$prefix = "TRA" . date('dmY', strtotime($tanggal)) . date('Hi', strtotime($jam));
$id_transaksi = id_otomatis_custom("data_transaksi", "id_transaksi", $prefix, 5);
// Fungsi id_otomatis_custom bisa Anda buat atau gunakan yang sudah ada, contoh: TRA31122025152107676

$id_kategori_member = baca_database("data_kategori_member", "kategori_member", "select * from data_kategori_member where id_kategori_member='$id_kategori_member'");
$id_jenis_transaksi = baca_database("data_jenis_transaksi", "jenis_transaksi", "select * from data_jenis_transaksi where id_jenis_transaksi='$id_jenis_transaksi'");

// Simpan ke database
$query = mysql_query("INSERT INTO data_transaksi (
    id_transaksi, tanggal, jam, id_member, id_petugas, 
    id_kategori_member, id_jenis_transaksi, point, 
    kategori_jumlah, jumlah
) VALUES (
    '$id_transaksi',
    '$tanggal',
    '$jam',
    '$id_member',
    '$id_petugas',
    '$id_kategori_member',
    '$id_jenis_transaksi',
    '$point',
    '$kategori_jumlah',
    '$jumlah'
)");

if ($query) {
	// Update point member (tambahkan point baru)
	mysql_query("UPDATE data_member SET point = point + '$point' WHERE id_member = '$id_member'");

	echo "<script>
        alert('Transaksi berhasil disimpan!\\nID: $id_transaksi\\nPoint +$point telah ditambahkan.');
        location.href = '../data_transaksi/index.php?input=tambah';
    </script>";
} else {
	echo "<script>
        alert('Gagal menyimpan transaksi!\\nError: " . mysql_error() . "');
        history.back();
    </script>";
}
?>