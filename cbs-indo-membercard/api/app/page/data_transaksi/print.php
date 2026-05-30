<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set('display_errors', 0);
//error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
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


$id_transaksi = get('id_transaksi');
$nama = get('nama');
$kategori_member = get('kategori_member');
$jenis_transaksi = strtoupper(get('jenis_transaksi'));
$point_awal = get('point_awal');
$point = get('point');
$tambahan_point = get('tambahan_point');
$jumlah = get('jumlah'); // Ini angka mentah (bisa Rupiah, bisa Liter)
$id_operator = get("operator");
$kategori_input = get('kategori');

// --- 2. LOGIKA DATABASE & PERHITUNGAN ---
date_default_timezone_set("Asia/Jakarta");
$tanggal = date("d M Y H:i:s");

// Ambil Harga & Operator dari Database
$harga_product = baca_database("", "harga", "SELECT * FROM data_jenis_transaksi WHERE jenis_transaksi = '$jenis_transaksi'");
$operator = baca_database("", "nama", "SELECT * FROM data_petugas WHERE id_petugas = '$id_operator'");
$nama_spbu = baca_database("", "nama_spbu", "SELECT * FROM data_petugas WHERE id_petugas = '$id_operator'");
$spbu = "SPBU " . $nama_spbu;
$telepon = baca_database("", "telepon", "SELECT * FROM data_spbu WHERE nama_spbu like '%$nama_spbu%'");
$alamat = baca_database("", "alamat1", "SELECT * FROM data_spbu WHERE nama_spbu like '%$nama_spbu%'");

// Pastikan harga float agar aman dihitung
$harga_satuan = (float) $harga_product;
$input_user = (float) $jumlah;

// --- LOGIKA ADAPTIF (INTI PERUBAHAN) ---
$final_volume = 0;
$final_rupiah = 0;

if ($kategori_input == 'liter') {
    // KASUS 1: User Input LITER
    // Maka jumlah yang dikirim adalah Volume
    $final_volume = $input_user;

    // Hitung Total Rupiahnya
    $final_rupiah = $final_volume * $harga_satuan;

} else {
    // KASUS 2: User Input RUPIAH (Default)
    // Maka jumlah yang dikirim adalah Uang
    $final_rupiah = $input_user;

    // Hitung Volumenya
    if ($harga_satuan > 0) {
        $final_volume = $final_rupiah / $harga_satuan;
    } else {
        $final_volume = 0;
    }
}

// --- FORMATTING UNTUK TAMPILAN ---
// 1. Harga Satuan
$str_harga_satuan = "Rp " . number_format($harga_satuan, 0, ',', '.');

// 2. Volume (2 desimal, koma sbg pemisah desimal)
if (floor($final_volume) == $final_volume) {
    // Tidak ada desimal
    $str_volume = number_format($final_volume, 0, ',', '.');
} else {
    // Ada desimal
    $str_volume = number_format($final_volume, 2, ',', '.');
}

// 3. Total Bayar (Rupiah)
$str_total_bayar = "Rp " . number_format($final_rupiah, 0, ',', '.');


// --- 3. LOGIKA PENENTUAN LOGO ---
$logo_response = "pertamina";

// --- 4. TEMPLATE STRUK ---

function center_text($text, $width = 32)
{
    $text = trim($text);
    $len = strlen($text);
    if ($len >= $width)
        return $text;
    $pad = floor(($width - $len) / 2);
    return str_repeat(" ", $pad) . $text;
}

$point_awal = number_format($point_awal, 0, ',', '.');
$tambahan_point = number_format($tambahan_point, 0, ',', '.');
$point = number_format($point, 0, ',', '.');

$receipt =
    center_text($spbu) . "\n" .
    center_text($alamat) . "\n" .
    center_text($telepon) . "\n" .
    "--------------------------------\n" .
    "Shift    : $shift\n" .
    "No.TRX   : $id_transaksi\n" .
    "Waktu    : $tanggal\n" .
    "--------------------------------\n" .
    "Product     : $jenis_transaksi\n" .
    "Harga/Liter : $str_harga_satuan\n" .
    "Volume(L)   : $str_volume\n" .    // <--- SUDAH ADAPTIF
    "Total       : $str_total_bayar\n" . // <--- TAMBAHAN BIAR JELAS
    "Operator    : $operator\n" .
    "--------------------------------\n" .
    center_text("SMART MEMBERCARD CBS") . "\n" .
    "Nama        : $nama\n" .
    "Point Awal  : $point_awal \n" .
    "+ Point     : $tambahan_point \n" .
    "Total Point : $point \n\n" .
    center_text("TERIMAKASIH DAN SELAMAT JALAN") . "\n" .
    center_text("SMC PROMO SETIAP HARI") . "\n" .
    center_text("www.membercard.cbs-indo.com") . "\n\n" .
    "\n\n";

// --- 5. OUTPUT KE JSON ---
echo json_encode([
    "status" => "success",
    "receipt_text" => $receipt,
    "logo" => $logo_response
], JSON_PRETTY_PRINT);

?>