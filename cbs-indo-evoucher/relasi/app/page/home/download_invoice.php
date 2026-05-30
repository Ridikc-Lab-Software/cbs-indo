<?php
require_once __DIR__ . '/vendor/autoload.php'; // jika pakai composer
include '../../../include/all_include.php';
include '../../../include/function/session.php';

$durasi_jatuh_tempo = SettingVoucher::get_number(SettingVoucher::$jatuh_tempo);
$proses = isset($_GET['kode'])?decrypt($_GET['kode']) : '';
if (!$proses) die('Kode tidak valid');

$sql = mysql_query("SELECT *, DATE_ADD(tanggal_penjualan, INTERVAL $durasi_jatuh_tempo DAY) AS jatuh_tempo 
                    FROM data_penjualan_voucher WHERE id_penjualan = '$proses'");
$data = mysql_fetch_array($sql);

$jatuh_tempo = date('Y-m-d H:i:s', strtotime($data['jatuh_tempo']));
$jenenge     = decrypt($_COOKIE['jenenge']);
$hakAkses    = baca_database("","hak_akses","select * from data_admin where username='$jenenge'");

// ========================================
// SEMUA KODE HTML INVOICE SAMA PERSIS seperti file lama
// (copy seluruh <html> … </html> dari file lama ke variabel $html)
// ========================================

ob_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice INV<?php echo $data['id_penjualan']; ?></title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 5px; }
        .right { text-align: right; }
        .center { text-align: center; }
        @media print {

            .no-print,
            .no-print * {
                display: none !important;
            }

            body {
                padding: 0 !important;
                border: 0 none !important;
            }
        }

        img {
            z-index: 100;
            position: relative;
        }
    </style>
</head>
<body>
   <!-- header -->
    <div style="display: inline-block; width: 100%; margin-top: 5mm; margin-bottom: 5mm;">
        <table style="table-layout: fixed;width: 100%;">
            <tbody>
                <tr>
                    <td>
                        <img style="max-width: 240px; margin-top: 3mm; max-height: 75px;" src="../../../data/image/logo/logo.png">
                    </td>
                    <td style="text-align: right !important;">
                        <div id="invoice-nama-perusahaan" class="active-color" style="font-size: 20px; font-weight: 500; margin-bottom: 2mm;">
                            PT.CAHAYA BUNGO SARKOPALMA
                        </div>
                        <div>
                            <p class="text-start fs-5" >no SPBU :<?= baca_database("","nama_spbu","select * from data_spbu where id_spbu='$data[id_spbu]'") ?></p>
                        </div>
                        <div>
                            Jl. Lintas Sumatera, Bernai,<br>Kec. Sarolangun, Kabupaten Sarolangun, <br>Jambi 37481
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <table style="table-layout: fixed;width: 100%;">
        <tbody>
            <tr>
                <td>
                    <!-- header invoice -->
                    <div class="background-color-5 border-color-50" style="border: 1px solid; padding: 2mm; margin-bottom: 3mm;">
                        <div style="font-weight: bold;margin-bottom: 1mm;position: relative;">
                            INVOICE INV<?php echo $data['id_penjualan']; ?>
                        </div>
                        <div>
                            Waktu Tagihan : <?php echo format_indo_jam($data['tanggal_penjualan']); ?><br>
                            Waktu Jatuh Tempo : <?php echo format_indo_jam($jatuh_tempo); ?>
                        </div>
                    </div>
                </td>
                <td style="text-align: right !important;">
                    <!-- header tertagih -->
                    <div style="margin-bottom: 5mm;">
                        <div style="font-weight: bold;margin-bottom: 1mm;text-align:center">KEPADA</div>
                        <div>
                            <table style="margin-left:auto">
                                <tr>
                                    <td style='text-align:left'>Nama Relasi</td>
                                    <td style='width:20px'>:</td>
                                    <td style='text-align:left'>&nbsp;<?= baca_database("", "nama", "SELECT * FROM data_relasi where id_relasi='$data[id_relasi]'") ?></td>
                                </tr>
                                <tr>
                                    <td style='text-align:left'>Alamat</td>
                                    <td style='width:20px'>:</td>
                                    <td style='text-align:left'>&nbsp;<?= baca_database("", "alamat", "SELECT * FROM data_relasi where id_relasi='$data[id_relasi]'") ?></td>
                                </tr>
                                <tr>
                                    <td style='text-align:left'>No HP </td>
                                    <td style='width:20px'>:</td>
                                    <td style='text-align:left'>&nbsp;<?=baca_database("", "nomor_telepon", "SELECT * FROM data_relasi where id_relasi='$data[id_relasi]'");?></td>
                                </tr>
                                <tr>
                                    <td style='text-align:left'>Email</td>
                                    <td style='width:20px'>:</td>
                                    <td>&nbsp;<?= baca_database("", "email", "SELECT * FROM data_relasi where id_relasi='$data[id_relasi]'")?></td>
                                </tr>
                            </table>

                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- detail tagihan -->
    <div style="margin-bottom: 5mm;">
        <div style="font-weight: bold; margin-bottom: 1mm;">Detail Tagihan</div>
        <table class="tabel-detail-invoice" style="width: 100%">
            <thead>
                <tr>
                    <th class="active-background-color" colspan="2">Item </th>
                    <th class="active-background-color">Sub Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2" style="height:50px;">Pembayaran Pembelian E-Voucher kode INV<?php echo $data['id_penjualan']; ?></td>
                    <td class="right" style="width:150px; text-align: right !important;"><?php echo rupiah($data['sub_total']); ?></td>
                </tr>
                <tr>
                    <td class="center" rowspan="2"> <b>Terbilang : <?php echo terbilang($data['total_bayar']); ?> Rupiah</td>
                    <?php if ($data['persentase_ppn'] > 0) { ?>
                        <td class="left" style="width:150px; text-align: left !important;">PPN <?php echo ($data['persentase_ppn']); ?>%</td>
                        <td class="right" style="width:150px; text-align: right !important;"><?php echo rupiah($data['ppn']); ?></td>
                    <?php } ?>
                </tr>

                <tr>

                    <td class="left" style="width:150px; text-align: left !important;">Total Tagihan</td>
                    <td class="right" style="width:150px; text-align: right !important;"><?php echo rupiah($data['total_bayar']); ?></td>
                </tr>
            </tbody>
        </table>
    </div>



    <!-- informasi transfer -->

    <table width="100%" >
        <tbody>
            <tr>
                <td width="70%">
                    <div style='margin-bottom:60px;background:#f7f7f7; padding:15px; border:1px #d4d4d4ff'>
                    <b>Pembayaran Transfer :</b><br>
                        <table >
                        <?php
                        $data_banks = QB::table('data_bank')->get();
                            foreach($data_banks as $bank):
                        ?>
                        
                        <tr>
                           Bank <?=$bank->nama_bank?> <br>
                           <b> <?= $bank->nomor_rekening ?> </b><br>
                           PT Cahaya Bungo Sarkopalma
                        </tr>

                        <?php
                        endforeach?>
                        </table>
                </div>
                </td>
                <td>
                    <div id="yang-menerima">
                        <div style="margin-bottom: 60pt; text-align:center;">Sarolangun, <?php echo format_indo(date('Y-m-d')); ?></div>
                        <div style=" text-align:center;"></div>
                        <div style="margin-bottom: 10pt; text-align:center;"><?= ucwords($hakAkses)?></div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <div style='width:100%'>

        <a href="download_invoice.php?kode=<?= $_GET['kode'] ?>" target="_blank"style="float:right" class="btn btn-primary btn-sm">Download Invoice</a>
    </div>
</body>
</html>
<?php
$html = ob_get_clean();

// ========================================
// GENERATE PDF dengan mPDF
// ========================================

$mpdf = new \Mpdf\Mpdf([
    'mode' => 'utf-8',
    'format' => 'A4',
    'margin_left' => 10,
    'margin_right' => 10,
    'margin_top' => 10,
    'margin_bottom' => 10,
    'margin_header' => 5,
    'margin_footer' => 5,
]);

$mpdf->SetTitle('Invoice INV'.$data['id_penjualan']);
$mpdf->SetAuthor('PT. Cahaya Bungo Sarkopalma');
$mpdf->SetCreator('Sistem E-Voucher');

$mpdf->WriteHTML($html);

// Nama file yang akan di-download
$filename = 'Invoice_INV'.$data['id_penjualan'].'_'.date('Ymd').'.pdf';

$mpdf->Output($filename, 'D'); // 'D' = force download
exit;