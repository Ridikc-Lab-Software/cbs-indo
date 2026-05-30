<?php
// export_excel.php → VERSI FINAL YANG 100% BERHASIL DI XAMPP

// 1. Bersihkan semua buffer & matikan error display
ob_start();
error_reporting(0);
ini_set('display_errors', 0);

// 2. Header WAJIB paling atas
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Laporan_E-Voucher_'.date('Ymd_His').'.xlsx"');
header('Cache-Control: max-age=0');
header('Pragma: no-cache');
header('Expires: 0');

// 3. Baru include semua file
require_once 'inc_query_laporan.php';
require_once 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

// 4. Buat Excel
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Logo + Header
$sheet->getRowDimension(1)->setRowHeight(80);
if (!empty($logo_laporan1) && file_exists($logo_laporan1)) {
    $drawing = new Drawing();
    $drawing->setPath($logo_laporan1);
    $drawing->setCoordinates('A1');
    $drawing->setHeight(90);
    $drawing->setWorksheet($sheet);
}
if (!empty($logo_laporan2) && file_exists($logo_laporan2)) {
    $drawing = new Drawing();
    $drawing->setPath($logo_laporan2);
    $drawing->setCoordinates('J1');
    $drawing->setHeight(90);
    $drawing->setOffsetX(20);
    $drawing->setWorksheet($sheet);
}

$sheet->setCellValue('B2', 'PT. CAHAYA BUNGO SARKOPALMA SPBU '.strtoupper($spbu));
$sheet->mergeCells('B2:H2');
$sheet->setCellValue('B3', $alamat1);
$sheet->mergeCells('B3:H3');
$sheet->setCellValue('A5', 'LAPORAN TRANSAKSI E-VOUCHER');
$sheet->mergeCells('A5:I5');
$sheet->setCellValue('A6', strip_tags(isset($info_cetak) ?$info_cetak :'Semua Data'));
$sheet->mergeCells('A6:I6');
$sheet->getStyle('A5:I6')->getFont()->setSize(14)->setBold(true);
$sheet->getStyle('A5:I6')->getAlignment()->setHorizontal('center');

// Header kolom
$row = 8;
$headers = ['No','Tanggal Transaksi','Qrcode','Nama Supir','Nomor Plat','Nama Relasi','Jenis BBM','Jumlah (L)','Nominal'];
foreach ($headers as $i => $h) {
    $col = chr(65 + $i); // A, B, C...
    $sheet->setCellValue($col.$row, $h);
    $sheet->getStyle($col.$row)->getFont()->setBold(true);
    $sheet->getStyle($col.$row)->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setARGB('FFCCCCCC');
}

// Isi data
$row = 8;
$no = 0;
mysql_data_seek($proses, 0); // reset pointer
while ($data = mysql_fetch_array($proses)) {
    $no++; $row++;

    $plat = baca_database("","no_plat_kendaraan","SELECT no_plat_kendaraan FROM data_plat_kendaraan_transaksi_voucher WHERE id_transaksi_voucher='{$data['id_transaksi']}'");
    $plat = $plat ?: "-";

    $id_voucher = baca_database("","id_voucher","SELECT id_voucher FROM data_voucher WHERE id_voucher='{$data['id_voucher']}'");

    $supir = !empty($data['nama_member']) ? $data['nama_member'] : "Non member";
    $relasi_nama = baca_database("","nama","SELECT nama FROM data_relasi WHERE id_relasi='{$data['id_relasi']}'");

    $jenis = QB::table("data_jenis_transaksi")->where("id_jenis_transaksi", $data['jenis_bbm'])->first();
    $jenis_bbm_name = $jenis ? $jenis->jenis_transaksi : $data['jenis_bbm'];

    $harga_perliter = (int)baca_database("","harga","SELECT harga FROM data_jenis_transaksi WHERE jenis_transaksi='$jenis_bbm_name'");
    $liter = $harga_perliter > 0 ? round($data['nominal'] / $harga_perliter, 2) : 0;

    $sheet->setCellValue("A$row", $no);
    $sheet->setCellValue("B$row", format_indo_jam($data['tanggal_transaksi']));
    $sheet->setCellValue("C$row", 'ID'.$id_voucher);
    $sheet->setCellValue("D$row", $supir);
    $sheet->setCellValue("E$row", $plat);
    $sheet->setCellValue("F$row", $relasi_nama);
    $sheet->setCellValue("G$row", $jenis_bbm_name);
    $sheet->setCellValue("H$row", $liter);
    $sheet->setCellValue("I$row", $data['nominal']);
}

// Total
$row++;
$sheet->setCellValue("H$row", "Jumlah Voucher : $no");
$sheet->setCellValue("I$row", $total);
$sheet->getStyle("H$row:I$row")->getFont()->setBold(true);
$sheet->getStyle("I9:I$row")->getNumberFormat()->setFormatCode('#,##0');

// Ringkasan BBM
if (empty($jenis_bbm)) {
    $row += 3;
    $sheet->setCellValue("A$row", "Ringkasan per Jenis BBM"); $row++;
    $sheet->setCellValue("A$row", "TURBO");    $sheet->setCellValue("B$row", $TURBO);    $sheet->setCellValue("C$row", $JML_TURBO); $row++;
    $sheet->setCellValue("A$row", "DEXLITE");  $sheet->setCellValue("B$row", $DEXLITE);  $sheet->setCellValue("C$row", $JML_DEXLITE); $row++;
    $sheet->setCellValue("A$row", "PERTAMAX"); $sheet->setCellValue("B$row", $PERTAMAX); $sheet->setCellValue("C$row", $JML_PERTAMAX); $row++;
    $sheet->setCellValue("A$row", "PERTALITE");$sheet->setCellValue("B$row", $PERTALITE);$sheet->setCellValue("C$row", $JML_PERTALITE);
}

// Tanda tangan
$row += 5;
$sheet->setCellValue("G$row", $nama); $row++;
$sheet->setCellValue("G$row", $jabatan);

// Auto size kolom
for ($c = 'A'; $c <= 'I'; $c++) {
    $sheet->getColumnDimension($c)->setAutoSize(true);
}

// 5. Kirim file & bersihkan buffer
ob_end_clean(); // CRITICAL: bersihkan buffer sebelum save
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;