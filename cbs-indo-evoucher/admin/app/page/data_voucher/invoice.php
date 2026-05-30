<!DOCTYPE html>
<html id="print-page" class="display">
<?php
include '../../../include/all_include.php';
include '../../../include/function/session.php';

$durasi_jatuh_tempo = SettingVoucher::get_number(SettingVoucher::$jatuh_tempo);

$proses = decrypt(mysql_real_escape_string($_GET['kode']));
$sql = mysql_query("SELECT *, DATE_ADD(tanggal_penjualan, INTERVAL $durasi_jatuh_tempo DAY) AS jatuh_tempo FROM data_penjualan_voucher WHERE id_penjualan = '$proses'");
$data = mysql_fetch_array($sql);

$jenenge = decrypt($_COOKIE['jenenge']);
$jabatan = baca_database("", "jabatan", "select * from data_admin where username='$jenenge'");
$nama = baca_database("", "nama", "select * from data_admin where username='$jenenge'");
$ttd = baca_database("", "foto_tanda_tangan", "select * from data_admin where username='$jenenge'");
$nama_relasi = baca_database("", "nama", "SELECT * FROM data_relasi where id_relasi='$data[id_relasi]'");
$jatuh_tempo = date('Y-m-d H:i:s', strtotime($data['jatuh_tempo']));
$title = "Invoice - E-Voucher CBS-Indo - " . $nama_relasi . " - " . substr($data['id_penjualan'], -5);

?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Invoice Transaksi</title>
    <link rel="stylesheet" href="./Invoice Transaksi_files/admin.css">
    <link rel="stylesheet" href="./Invoice Transaksi_files/style.css">
    <link rel="stylesheet" href="./Invoice Transaksi_files/bootstrap.min.css">
    <link rel="stylesheet" href="./Invoice Transaksi_files/style.min.css">
    <link rel="stylesheet" href="./Invoice Transaksi_files/font-awesome.min.css">

    <script src="./Invoice Transaksi_files/jquery-1.10.2.min.js.download"></script>
    <script src="./Invoice Transaksi_files/bootstrap.min.js.download"></script>
    <script src="./Invoice Transaksi_files/accounting.min.js.download"></script>
    <script src="./Invoice Transaksi_files/cssmenu.js.download"></script>
    <script src="./Invoice Transaksi_files/main-script.js.download"></script>

    <style>
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

<body id="form-cetak-invoice" style="">


    <!-- header -->
    <div style="display: inline-block; width: 100%; margin-top: 5mm; margin-bottom: 5mm;">
        <table style="table-layout: fixed;width: 100%;">
            <tbody>
                <tr>
                    <td>
                        <img style="max-width: 240px; margin-top: 3mm; max-height: 75px;"
                            src="../../../data/image/logo/logo.png">
                    </td>
                    <td style="text-align: right !important;">
                        <div id="invoice-nama-perusahaan" class="active-color"
                            style="font-size: 20px; font-weight: 500; margin-bottom: 2mm;">
                            PT.CAHAYA BUNGO SARKOPALMA
                        </div>

                        <div>
                            <?= baca_database("", "nama_spbu", "select * from data_spbu where id_spbu='$data[id_spbu]'") ?><br>
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
                    <div class="background-color-5 border-color-50"
                        style="border: 1px solid; padding: 2mm; margin-bottom: 3mm;">
                        <div style="font-weight: bold;margin-bottom: -1mm;position: relative;">
                            INVOICE INV<?php echo $data['id_penjualan']; ?>
                        </div>
                        <!-- <div>
                            Waktu Tagihan : <?php echo format_indo_jam($data['tanggal_penjualan']); ?><br>
                            Waktu Jatuh Tempo : <?php echo format_indo_jam($jatuh_tempo); ?>
                        </div> -->
                    </div>
                </td>
                <td style="text-align: right !important;">
                    <!-- header tertagih -->
                    <div style="margin-bottom: 5mm;">

                        <div>
                            <div>
                                <b>KEPADA </b>
                                <br>
                                <?= $nama_relasi ?><br>
                                <?= baca_database("", "alamat", "SELECT * FROM data_relasi where id_relasi='$data[id_relasi]'") ?><br>

                                
                                <?= baca_database("", "email", "SELECT * FROM data_relasi where id_relasi='$data[id_relasi]'") ?>
                                <br>
                                <?= baca_database("", "nomor_telepon", "SELECT * FROM data_relasi where id_relasi='$data[id_relasi]'"); ?>
                            </div>



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
                    <td colspan="2" style="height:50px;text-align:center">Pembayaran E-Voucher Kode
                        INV<?php echo $data['id_penjualan']; ?></td>
                    <td class="right" style="width:150px; text-align: right !important;">
                        <?php echo rupiah($data['sub_total']); ?>
                    </td>
                </tr>
                <tr>
                    <td class="center" rowspan="2"> <b>Terbilang : <?php echo terbilang($data['total_bayar']); ?> Rupiah
                    </td>
                    <?php if ($data['persentase_ppn'] > 0) { ?>
                            <td class="left" style="width:150px; text-align: left !important;">PPN
                                <?php echo ($data['persentase_ppn']); ?>%
                            </td>
                            <td class="right" style="width:150px; text-align: right !important;">
                                <?php echo rupiah($data['ppn']); ?>
                            </td>
                    <?php } ?>
                </tr>

                <tr>

                    <td class="left" style="width:150px; text-align: left !important;">Total Tagihan</td>
                    <td class="right" style="width:150px; text-align: right !important;">
                        <?php echo rupiah($data['total_bayar']); ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>



    <!-- informasi transfer -->

    <table width="100%">
        <tbody>
            <tr>
                <td width="70%">
                    <div
                        style='margin-bottom:30px;background:#f7f7f7; padding:15px; border:1px #d4d4d4ff;max-width: 73%;'>
                        <b>Pembayaran Transfer :</b><br>
                        <table>
                            <?php
                            $data_banks = QB::table('data_bank')->get();
                            foreach ($data_banks as $bank):
                                ?>

                                    <tr>
                                        <br>
                                        Bank <?= $bank->nama_bank ?> <br>
                                        <b> <?= $bank->nomor_rekening ?> </b><br>
                                        <?= $bank->atas_nama ?> <br>
                                    </tr>

                                    <?php
                            endforeach ?>
                        </table>
                    </div>
                </td>
                <td style="align-content: baseline;">
                    <?php  ttd();?>
                </td>
            </tr>
        </tbody>
    </table>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        const header = document.getElementById('print-page');
        header.querySelector('title').innerText = "<?= $title ?>"
        // Pastikan DOM sudah fully loaded
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("btnDownloadPDF").addEventListener("click", function () {
                const button = this;
                button.style.display = "none";

                // 1. Scroll ke atas dulu (WAJIB!)
                window.scrollTo(0, 0);

                // 2. Bungkus semua konten dalam satu div fixed size A4
                const invoiceWrapper = document.createElement("div");
                invoiceWrapper.style.width = "210mm";
                invoiceWrapper.style.minHeight = "297mm";
                invoiceWrapper.style.padding = "10mm";
                invoiceWrapper.style.boxSizing = "border-box";
                invoiceWrapper.style.background = "white";
                invoiceWrapper.style.position = "relative";
                invoiceWrapper.style.margin = "0 auto";
                invoiceWrapper.style.fontFamily = "Arial, sans-serif";

                // Pindahkan semua konten body ke dalam wrapper ini
                while (document.body.firstChild) {
                    invoiceWrapper.appendChild(document.body.firstChild);
                }
                document.body.appendChild(invoiceWrapper);

                // 3. Opsi html2pdf yang sudah terbukti 100% tidak kepotong
                const opt = {
                    margin: [0, 0, 0, 0],
                    filename: "Invoice_INV<?php echo $data['id_penjualan']; ?>_<?php echo substr($id, max(0, strlen($id) - 5)); ?>.pdf",
                    image: { type: "jpeg", quality: 0.98 },
                    html2canvas: {
                        scale: 2,
                        useCORS: true,
                        letterRendering: true,
                        allowTaint: false,
                        backgroundColor: "#ffffff",
                        scrollX: 0,
                        scrollY: 0,
                        windowWidth: 794,   // 210mm
                        windowHeight: 1123, // 297mm
                        // Yang paling penting:
                        height: invoiceWrapper.scrollHeight + 200,
                        width: invoiceWrapper.scrollWidth
                    },
                    jsPDF: {
                        unit: "mm",
                        format: "a4",
                        orientation: "portrait"
                    },
                    pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
                };

                // 4. Generate PDF
                html2pdf().set(opt).from(invoiceWrapper).save().then(() => {
                    // Kembalikan semuanya ke posisi semula
                    while (invoiceWrapper.firstChild) {
                        document.body.appendChild(invoiceWrapper.firstChild);
                    }
                    document.body.removeChild(invoiceWrapper);
                    button.style.display = "block";
                });
            });
        });
    </script>
    <style>
        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</body>

</html>