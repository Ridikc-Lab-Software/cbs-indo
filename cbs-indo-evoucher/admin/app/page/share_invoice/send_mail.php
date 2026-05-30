<?php


include "../../../../admin/include/function/enc.php";
include "../../../../admin/include/koneksi/koneksi.php";
 include "../../../../admin/include/function/all.php";
require_once __DIR__ . '/vendor/autoload.php';

use Dompdf\Dompdf;

include 'share_link_evoucher.php';
include 'EmailShareLink.php';

function getEmailHtmlContent($kode_email, $company_logo, $company_name, $invoice, $nama_relasi, $alamat_relasi, $email_relasi, $telepon_relasi, $total_bayar, $terbilang, $tanggal, $tanda_tangan, $admin, $jabatan, $info_rekening)
{
    ob_start();
    include 'mail.php';
    $html = ob_get_clean();

    $html = str_replace(
        ['{kode_email}', '{company_logo}', '{company_name}', '{invoice}', '{nama_relasi}', '{alamat_relasi}', '{email_relasi}', '{telepon_relasi}', '{total_bayar}', '{terbilang}', '{tanggal}', '{tanda_tangan}', '{admin}', '{jabatan}', '{info_rekening}'],
        [$kode_email, $company_logo, $company_name, $invoice, $nama_relasi, $alamat_relasi, $email_relasi, $telepon_relasi, $total_bayar, $terbilang, $tanggal, $tanda_tangan, $admin, $jabatan, $info_rekening],
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
    file_put_contents( $filename, $pdfContent);

    return [
        'content'  => $pdfContent,
        'filename' => $filename
    ];
}



$key = 'qJB0rGtIn5UB1xG03efyCp';
$proses = isset($_GET['kode']) ? decrypt(mysql_real_escape_string($_GET['kode'])) : false;

if ($proses == false) {
    exit('Gagal, kode tidak ditemukan');
}

$penjualan = QB::table("data_penjualan_voucher")
    ->select(["data_relasi.email", "data_relasi.nama","data_relasi.nomor_telepon","data_relasi.alamat", "data_relasi.id_relasi", "data_penjualan_voucher.password_voucher", "data_penjualan_voucher.id_penjualan","data_penjualan_voucher.total_bayar","data_penjualan_voucher.id_admin"])
    ->join("data_relasi", function ($table) {
        $table->on("data_penjualan_voucher.id_relasi", "=", "data_relasi.id_relasi");
    })
    ->where("data_penjualan_voucher.id_penjualan", $proses)
    ->first();


if (!$penjualan) {
    exit("Gagal, mitra tidak ditemukan.");
}

$url_evoucher = pengaturan("url_evoucher");
$url_membercard = pengaturan("url_smc");
$link = $url_evoucher . "login/" . $_GET['proses'];
$company_logo = "https://cbs-indo.com/admin/data/image/logo/logo2.png";
$company_name = "PT.Cahaya Bungo Sarkopalma";
$recipient_name = $penjualan->nama;
$id_invoice = decrypt($_GET['kode']);
$password = $penjualan->password_voucher;
$id_relasi = $penjualan->id_relasi;
$id_penjualan = $penjualan->id_penjualan;
$email_penerima = $penjualan->email;
$nama_relasi = $penjualan->nama;
$nomor_telepon_relasi = $penjualan->nomor_telepon;
$alamat_relasi = $penjualan->alamat;
$total_bayar = $penjualan->total_bayar;
$terbilang = terbilang($total_bayar).' Rupiah';

$kode_email = "Invoice E-Voucher CBS-INDO - ".$nama_relasi." - ".$id_penjualan;
$invoice = $id_penjualan;
$email_relasi = $email_penerima;
$telepon_relasi = $nomor_telepon_relasi;
$total_bayar = "Rp " . number_format($total_bayar, 0, ',', '.');
$tanggal = format_indo(date('Y-m-d'));
$id_admin = $penjualan->id_admin;
$tanda_tangan = $url_membercard."admin/upload/".baca_database("", "foto_tanda_tangan", "select foto_tanda_tangan from data_admin where id_admin='$id_admin'");
$admin = baca_database("", "nama", "select nama from data_admin where id_admin='$id_admin'");
$jabatan = baca_database("", "jabatan", "select jabatan from data_admin where id_admin='$id_admin'");

//buat di loopng untuk bank
$info_rekening = '';
$banks = QB::table('data_bank')->get();
if ($banks) {
    foreach ($banks as $b) {
        $nama_bank = isset($b->nama_bank) ? $b->nama_bank : '';
        $nomor_rekening = isset($b->nomor_rekening) ? $b->nomor_rekening : '';
        $atas_nama = isset($b->atas_nama) ? $b->atas_nama : '';

        $info_rekening .= '<div class="inforekening">';
        $info_rekening .= '<strong>' . htmlspecialchars($nama_bank) . '</strong><br>';
        $info_rekening .= htmlspecialchars($nomor_rekening) . '<br>';
        $info_rekening .= htmlspecialchars($atas_nama) . '<br>';
        $info_rekening .= '</div>';
    }
}



// /* ==================== GENERATE ==================== */
$htmlContent = getEmailHtmlContent(
    $kode_email,
    $company_logo,
    $company_name,
    $invoice,
    $nama_relasi,
    $alamat_relasi,
    $email_relasi,
    $telepon_relasi,
    $total_bayar,
    $terbilang,
    $tanggal,
    $tanda_tangan,
    $admin,
    $jabatan,
    $info_rekening
);

$pdfFilename = $kode_email . '.pdf';
$pdfData = generatePdfFromHtml($htmlContent, $pdfFilename);

// /* ==================== BODY EMAIL ==================== */
$message = file_get_contents('message.php');
$message = str_replace('{kode_email}', $kode_email, $message);
$message = str_replace('{invoice}', $invoice, $message);
$message = str_replace('{nama_relasi}', $nama_relasi, $message);
$message = str_replace('{alamat_relasi}', $alamat_relasi, $message);
$message = str_replace('{email_relasi}', $email_relasi, $message);
$message = str_replace('{telepon_relasi}', $telepon_relasi, $message);
$message = str_replace('{total_bayar}', $total_bayar, $message);
$message = str_replace('{terbilang}', $terbilang, $message);
$message = str_replace('{tanggal}', $tanggal, $message);
$message = str_replace('{admin}', $admin, $message);
$message = str_replace('{jabatan}', $jabatan, $message);
$message = str_replace('{info_rekening}', $info_rekening, $message);


// /* ==================== KIRIM ==================== */
shareLinkToUser(
    new EmailShareLink(),
    $email_penerima,
    "" . $kode_email,
    $message,
    $pdfData['content'],
    $pdfData['filename']
);
?>

<script>
    alert('PDF Berhasil dibuat dan Email invoice e-voucher berhasil dikirim ke <?php echo $email_penerima; ?>');
    window.location.href = " ../data_voucher/index.php?input=list_detail_voucher&proses=<?php echo $_GET['kode']; ?>&preview=";
</script>
