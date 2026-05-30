<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set('display_errors', 0);
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
include '../../../../admin/include/koneksi/koneksi.php';
include '../../../../admin/include/function/all.php';

function get($key, $default = "")
{
    return isset($_GET[$key]) ? $_GET[$key] : $default;
}

$jam_sekarang = date("H:i:s");
$q_shift = mysql_query("SELECT * FROM data_shift");
$shift = "-";
while ($row = mysql_fetch_assoc($q_shift)) {
    $jam_mulai = $row['jam_mulai'];
    $jam_selesai = $row['jam_selesai'];
    // SHIFT NORMAL (06:00 - 14:00, 14:00 - 22:00)
    if ($jam_mulai < $jam_selesai) {
        if ($jam_sekarang >= $jam_mulai && $jam_sekarang < $jam_selesai) {
            $shift = $row['shift'];
            break;
        }
    }
    // SHIFT MALAM (22:00 - 06:00)
    else {
        if ($jam_sekarang >= $jam_mulai || $jam_sekarang < $jam_selesai) {
            $shift = $row['shift'];
            break;
        }
    }
}

// --- FUNGSI CENTER TEXT ---
function center_text($text, $width = 32)
{
    $text = trim($text);
    $len = strlen($text);
    // Jika teks kepanjangan, biarkan dia diurus oleh logic pemecah baris manual di bawah
    if ($len >= $width)
        return $text;
    $pad = floor(($width - $len) / 2);
    return str_repeat(" ", $pad) . $text;
}

// --- AMBIL DATA ---
$id_redeem = get('id_redeem');
$nama = get('nama');
$nama_promo = get('nama_promo');
$mitra = get('mitra');
$point = get('point');
$pengurangan_point = get('pengurangan_point');
$id_operator = get('petugas');
$kategori_member = get('kategori_member');
$redeem_value = get('redeem_value');


$operator = baca_database("", "nama", "SELECT * FROM data_petugas WHERE id_petugas = '$id_operator'");
$nama_spbu = baca_database("", "nama_spbu", "SELECT * FROM data_petugas WHERE id_petugas = '$id_operator'");
$spbu = "SPBU " . $nama_spbu;
$telepon = baca_database("", "telepon", "SELECT * FROM data_spbu WHERE nama_spbu like '%$nama_spbu%'");
$alamat = baca_database("", "alamat1", "SELECT * FROM data_spbu WHERE nama_spbu like '%$nama_spbu%'");


$logo_response = "pertamina"; // cbs | pertamina

// Format Tanggal
date_default_timezone_set("Asia/Jakarta");
$tanggal = date("d M Y H:i:s");

$nama_mitra = baca_database("", "nama_mitra", "SELECT * FROM data_mitra WHERE id_mitra = '$mitra'");

// Format Rupiah
$redeem_value_rp = "Rp " . number_format((float) $redeem_value, 0, ',', '.');
$point_awal = $point + $pengurangan_point;

$point_awal = number_format($point_awal, 0, ',', '.');
$pengurangan_point = number_format($pengurangan_point, 0, ',', '.');
$point = number_format($point, 0, ',', '.');

// --- SUSUN STRUK ---
$receipt =
    // Header - Alamat dipecah jadi 3 baris
    center_text($spbu) . "\n" .
    center_text($alamat) . "\n" .
    center_text($telepon) . "\n" .
    "--------------------------------\n" .
    "Shift    : $shift\n" .
    "No.Rdm   : $id_redeem\n" .
    "Waktu    : $tanggal\n" .
    "--------------------------------\n" .
    "Promo    : $nama_promo\n" .
    "Kategori : $kategori_member\n" .
    "Mitra    : $nama_mitra\n" .
    "Total    : $redeem_value_rp\n" .
    "Operator : $operator\n" .
    "--------------------------------\n" .
    center_text("TRANSAKSI REDEEM") . "\n" .
    "Nama       : $nama\n" .
    "Point Awal : $point_awal \n" .
    "- Point    : $pengurangan_point \n" .
    "Sisa Point : $point \n\n" .
    center_text("TERIMAKASIH DAN SELAMAT JALAN") . "\n" .
    center_text("SMC PROMO SETIAP HARI") . "\n" .
    center_text("www.membercard.cbs-indo.com") . "\n\n" .
    "\n\n";

// --- OUTPUT ---
ob_clean();
echo json_encode([
    "logo" => $logo_response,
    "status" => "success",
    "receipt_text" => $receipt
], JSON_PRETTY_PRINT);

?>