<?php

require_once __DIR__ . '/vendor/autoload.php';

use Dompdf\Dompdf;

include 'share_link_evoucher.php';
include 'EmailShareLink.php';

function getEmailHtmlContent($link, $company_logo, $company_name, $recipient_name, $username, $password, $ttd_image)
{
    ob_start();
    include 'mail.php';
    $html = ob_get_clean();

    $html = str_replace(
        ['{link}', '{company_logo}', '{company_name}', '{recipient_name}', '{username}', '{password}', '{ttd_image}'],
        [$link, $company_logo, $company_name, $recipient_name, $username, $password, $ttd_image],
        $html
    );

    return $html;
}

function generatePdfFromHtml($html, $filename = 'e-voucher.pdf')
{
    $dompdf = new Dompdf();
    $dompdf->set_option('isRemoteEnabled', true);
    $dompdf->set_option('isHtml5ParserEnabled', true);
    $dompdf->set_option('defaultFont', 'DejaVuSans');

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    $pdfContent = $dompdf->output();

    // Debug simpan file
    file_put_contents('debug_' . $filename, $pdfContent);

    return [
        'content'  => $pdfContent,
        'filename' => $filename
    ];
}

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

$pdfFilename = "E-Voucher_{$username}.pdf";
$pdfData = generatePdfFromHtml($htmlContent, $pdfFilename);

/* ==================== BODY EMAIL ==================== */
$message = file_get_contents('message.php');
//$message = str_replace('ELKA', $recipient_name, $message);

/* ==================== KIRIM ==================== */
shareLinkToUser(
    new EmailShareLink(),
    $recipient_email,
    "E-Voucher Login - {$recipient_name}",
    $message,
    $pdfData['content'],
    $pdfData['filename']
);

echo "\nPDF debug disimpan sebagai: debug_{$pdfFilename}\nEmail kirim status: ";