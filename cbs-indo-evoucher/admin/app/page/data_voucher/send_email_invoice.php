<?php 



include "../../../../admin/include/function/enc.php";
include "../../../include/share_invoice/send_mail.php";
include "../../../../admin/include/koneksi/koneksi.php";
include "../../../../admin/include/function/all.php";

$key = 'qJB0rGtIn5UB1xG03efyCp';
$proses = isset($_GET['kode']) ? decrypt(mysql_real_escape_string($_GET['kode'])) : false;

if ($proses == false) {
    exit('Gagal, proses tidak ditemukan');
}

$penjualan = QB::table("data_penjualan_voucher")
    ->select(["data_relasi.email", "data_relasi.nama","data_relasi.id_relasi", "data_penjualan_voucher.password_voucher", "data_penjualan_voucher.id_penjualan"])
    ->join("data_relasi", function ($table) {
        $table->on("data_penjualan_voucher.id_relasi", "=", "data_relasi.id_relasi");
    })
    ->where("data_penjualan_voucher.id_penjualan", $proses)
    ->first();


if (!$penjualan) {
    exit("Gagal, mitra tidak ditemukan.");
}



$url_evoucher = pengaturan("url_evoucher");
$link = $url_evoucher . "login/" . $_GET['proses'];
$company_logo = "https://cbs-indo.com/admin/data/image/logo/logo2.png";
$company_name = "PT.Cahaya Bungo Sarkopalma";
$recipient_name = $penjualan->nama;
$id_relasi = $penjualan->id_relasi;
$id_penjualan = $penjualan->id_penjualan;



/* ==================== DATA ==================== */
$link           = "https://e-voucher.cbs-indo.com/login/fajar";
$company_logo   = "https://cbs-indo.com/admin/data/image/logo/logo2.png";
$company_name   = "PT. CAHAYA BUNGO SARKOPALMA";
$recipient_name = "Fajar Udin";
$username       = "fajar";
$password       = "123";
$ttd_image      = "https://cbs-indo.com/admin/data/image/ttd/fajar.png"; // Ganti dengan URL gambar ttd yang VALID & PUBLIK
$recipient_email = "fajarudinsidik@gmail.com";

/* ==================== GENERATE ==================== */
$htmlContent = getEmailHtmlContent($link, $company_logo, $company_name, $recipient_name, $username, $password, $ttd_image);

echo $pdfFilename = "../../../include/share_invoice/E-Voucher_{$username}.pdf";
$pdfData = generatePdfFromHtml($htmlContent, $pdfFilename);

/* ==================== BODY EMAIL ==================== */
$message = file_get_contents('"../../../include/share_invoice/message.php');
//$message = str_replace('ELKA', $recipient_name, $message);

// /* ==================== KIRIM ==================== */
shareLinkToUser(
    new EmailShareLink(),
    $recipient_email,
    "E-Voucher Login - {$recipient_name}",
    $message,
    $pdfData['content'],
    $pdfData['filename']
);

// echo "\nPDF debug disimpan sebagai: debug_{$pdfFilename}\nEmail kirim status: ";

die();

//close tab
//header("Location: ../data_voucher/index.php?input=list_detail_voucher&proses=".$_GET['kode']."&preview=");

?>