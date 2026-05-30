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
    function post($key, $default = "") {
        global $jsonData;

        if (isset($_POST[$key])) {
            return trim($_POST[$key]);
        }

        if (isset($jsonData[$key])) {
            return trim($jsonData[$key]);
        }

        return $default;
    }

    /* =============================
    1. AMBIL DATA DARI REQUEST
    ============================= */
    $id_transaksi = post('id_transaksi');
    $id_voucher   = post('id_voucher');
    $waktu        = post('waktu');
    $product      = strtoupper(post('product')); // Ini sudah UPPERCASE (DEXLITE, PERTALITE, dll)
    $total        = post('total');
    $id_operator  = post('operator');
    $id_nopol        = post('nopol');
    $id_supir     = post('id_supir');

    $nopol = baca_database(
        "",
        "plat",
        "SELECT * FROM data_plat WHERE id_plat = '$id_nopol'"
    );
    
    /* ambil nama operator */
    $operator = baca_database(
        "",
        "nama",
        "SELECT * FROM data_petugas WHERE id_petugas = '$id_operator'"
    );

    /* ambil harga per liter */
    $harga_product = baca_database(
        "",
        "harga",
        "SELECT * FROM data_jenis_transaksi WHERE jenis_transaksi = '$product'"
    );

    /* =============================
    2. DATA STATIS / KONFIG
    ============================= */
    $spbu    = "24.373.27";
    $telepon = "+62 811-7451-7431";

    /* =============================
    3. FORMAT DATA
    ============================= */
    $jumlah_rp = "Rp " . number_format((float)$total, 0, ',', '.');
    $harga_rp  = "Rp " . number_format((float)$harga_product, 0, ',', '.');


    $supir = baca_database(
        "",
        "nama_supir",
        "SELECT * FROM data_supir WHERE id_supir = '$id_supir'"
    );

    /* =============================
    4. TEMPLATE STRUK
    ============================= */
    $receipt =
    center_text("SPBU $spbu") . "\n\n" .
    center_text("Jl. Lintas Sumatra, KM 3") . "\n" .
    center_text("Desa Bernai, Sarolangun") . "\n" .
    center_text($telepon) . "\n" .
    "--------------------------------\n" .
    "Shift    : 2\n" .
    "No. TRX  : $id_transaksi\n" .
    "Waktu    : $waktu\n" .
    "--------------------------------\n" .
    "Product  : $product\n" .
    "Hrg/Ltr  : $harga_rp\n" .
    "Total    : $jumlah_rp\n" .
    "Operator : $operator\n" .
    "--------------------------------\n" .
    center_text("TRANSAKSI VOUCHER") . "\n" .
    "ID Vchr  : $id_voucher\n" .
    "Supir    : $supir\n" .
    "Nopol    : $nopol\n" .
    "--------------------------------\n" .
    center_text("TERIMA KASIH SELAMAT JALAN") . "\n" .
    center_text("SMC PROMO SETIAP HARIS") . "\n" .
    center_text("www.cbs-indo.com") . "\n\n\n";

    function center_text($text, $width = 32) {
        $text = trim($text);
        $len = strlen($text);
        if ($len >= $width) return $text;
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
        "status"       => "success",
        "receipt_text" => $receipt,
        "logo"         => $logo_response // <--- Kirim key logo ke Android
    ], JSON_PRETTY_PRINT);

?>