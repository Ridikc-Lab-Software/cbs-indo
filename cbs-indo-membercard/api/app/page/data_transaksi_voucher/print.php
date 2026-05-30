<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set('display_errors', 0);

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");

include '../../../../admin/include/koneksi/koneksi.php';
include '../../../../admin/include/function/all.php';


$rawInput = file_get_contents("php://input");
$jsonData = json_decode($rawInput, true);

/* helper ambil POST */
function post($key, $default = "")
{
    global $jsonData;

    if (isset($_POST[$key])) {
        return trim($_POST[$key]);
    }

    if (isset($jsonData[$key])) {
        return trim($jsonData[$key]);
    }

    return $default;
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

/* =============================
1. AMBIL DATA DARI REQUEST
============================= */
$id_transaksi = post('id_transaksi');
$id_voucher = post('id_voucher');
$waktu = post('waktu');
$product = strtoupper(post('product')); // Ini sudah UPPERCASE (DEXLITE, PERTALITE, dll)
$total = post('total');
$id_operator = post('operator');
$id_nopol = post('nopol');
$id_supir = post('id_supir');
$kategori_input = post('kategori');
$nominal_voucher = post('nominal_voucher');
$liter = post('liter');

$nominal_sisa_voucher = (float) $nominal_voucher - (float) $total;

if ($nominal_sisa_voucher != 0)
{
    $ada_sisa_voucher = true;
}
else{
    $ada_sisa_voucher = false;
}

$nominal_voucher = "Rp " . number_format((float) (int) $nominal_voucher, 0, ',', '.');
$nominal_sisa_voucher = "Rp " . number_format((float) $nominal_sisa_voucher, 0, ',', '.');



$nopol = baca_database(
    "",
    "plat",
    "SELECT * FROM data_plat WHERE id_plat = '$id_nopol'"
);



// --- 2. LOGIKA DATABASE & PERHITUNGAN ---
date_default_timezone_set("Asia/Jakarta");
$tanggal = date("d M Y H:i:s");


/* ambil harga per liter */
$harga_product = baca_database(
    "",
    "harga",
    "SELECT * FROM data_jenis_transaksi WHERE jenis_transaksi = '$product'"
);


$operator = baca_database("", "nama", "SELECT * FROM data_petugas WHERE id_petugas = '$id_operator'");
$nama_spbu = baca_database("", "nama_spbu", "SELECT * FROM data_petugas WHERE id_petugas = '$id_operator'");
$spbu = "SPBU " . $nama_spbu;
$telepon = baca_database("", "telepon", "SELECT * FROM data_spbu WHERE nama_spbu like '%$nama_spbu%'");
$alamat = baca_database("", "alamat1", "SELECT * FROM data_spbu WHERE nama_spbu like '%$nama_spbu%'");




$harga_rp = "Rp " . number_format((float) $harga_product, 0, ',', '.');



// 2. Volume (2 desimal, koma sbg pemisah desimal)
if (floor($liter) == $liter) {
    // Tidak ada desimal
    $str_volume = number_format($liter, 0, ',', '.');
} else {
    // Ada desimal
    $str_volume = number_format($liter, 2, ',', '.');
}

// 3. Total Bayar (Rupiah)
$str_total_bayar = "Rp " . number_format($total, 0, ',', '.');


$supir = baca_database(
    "",
    "nama_supir",
    "SELECT * FROM data_supir WHERE id_supir = '$id_supir'"
);

/* =============================
4. TEMPLATE STRUK
============================= */

if($ada_sisa_voucher)
{
    $receipt =
    center_text($spbu) . "\n" .
    center_text($alamat) . "\n" .
    center_text($telepon) . "\n" .
    "--------------------------------\n" .
    "Shift  : $shift\n" .
    "No.TRX : $id_transaksi\n" .
    "Waktu  : $tanggal\n" .
    "--------------------------------\n" .
    "Product     : $product\n" .
    "Harga/Liter : $harga_rp\n" .
    "Volume(L)   : $str_volume\n" .   
    "Nominal     : $nominal_voucher\n" .
    "Digunakan   : $str_total_bayar\n" .
    "Sisa        : $nominal_sisa_voucher\n" . // <--- SUDAH ADAPTIF
    "Operator    : $operator\n" .
    "--------------------------------\n" .
    center_text("TRANSAKSI VOUCHER") . "\n" .
    "ID Voucher  : $id_voucher\n" .
    "Nama Supir  : $supir\n" .
    "Nopol       : $nopol\n\n" .

    center_text("TERIMAKASIH DAN SELAMAT JALAN") . "\n" .
    center_text("SMC PROMO SETIAP HARI") . "\n" .
    center_text("www.membercard.cbs-indo.com") . "\n\n" .
    "\n\n";
}
else{
    $receipt =
    center_text($spbu) . "\n" .
    center_text($alamat) . "\n" .
    center_text($telepon) . "\n" .
    "--------------------------------\n" .
    "Shift  : $shift\n" .
    "No.TRX : $id_transaksi\n" .
    "Waktu  : $tanggal\n" .
    "--------------------------------\n" .
    "Product     : $product\n" .
    "Harga/Liter : $harga_rp\n" .
    "Volume(L)   : $str_volume\n" .    // <--- SUDAH ADAPTIF
    "Total       : $str_total_bayar\n" .
    "Operator    : $operator\n" .
    "--------------------------------\n" .
    center_text("TRANSAKSI VOUCHER") . "\n" .
    "ID Voucher  : $id_voucher\n" .
    "Nama Supir  : $supir\n" .
    "Nopol       : $nopol\n\n" .
    

    center_text("TERIMAKASIH DAN SELAMAT JALAN") . "\n" .
    center_text("SMC PROMO SETIAP HARI") . "\n" .
    center_text("www.membercard.cbs-indo.com") . "\n\n" .
    "\n\n";

}


function center_text($text, $width = 32)
{
    $text = trim($text);
    $len = strlen($text);
    if ($len >= $width)
        return $text;
    $pad = floor(($width - $len) / 2);
    return str_repeat(" ", $pad) . $text;
}

/* =============================
5. TENTUKAN LOGO (BARU)
============================= */
$logo_response = "pertamina";  // cbs | pertamina
/* =============================
6. RESPONSE JSON
============================= */
echo json_encode([
    "status" => "success",
    "receipt_text" => $receipt,
    "logo" => $logo_response // <--- Kirim key logo ke Android
], JSON_PRETTY_PRINT);

?>