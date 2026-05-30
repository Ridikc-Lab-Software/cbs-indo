<!DOCTYPE html>
<!-- saved from url=(0061)http://admin.demo.erahajj.co.id/transaksi/invoice/cetak/15313 -->
<html id="print-page" class="display">

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
                        <img style="max-width: 240px; margin-top: 3mm; max-height: 75px;" src="../../../data/image/logo/logo.png">
                    </td>
                    <td style="text-align: right !important;">
                        <div id="invoice-nama-perusahaan" class="active-color" style="font-size: 20px; font-weight: 500; margin-bottom: 2mm;">
                            PT.CBS INDO SARKOPALMA
                        </div>

                        <div>
                            Jl. Tangkuban Perahu<br>
                            Denpasar Barat, Denpasar<br>
                            Bali, 80117
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
                            INVOICE INV2348739487
                        </div>
                        <div>
                            Waktu Tagihan : 30 September 2019, 12:36:02<br>
                            Waktu Jatuh Tempo : 27 September 2019, 03:16:06<br>
                            Waktu Pembayaran : -
                        </div>
                    </div>
                </td>
                <td style="text-align: right !important;">
                    <!-- header tertagih -->
                    <div style="margin-bottom: 5mm;">
                        <div style="font-weight: bold;margin-bottom: 1mm;">KEPADA</div>
                        <div>
                            PT.Ridikc Industri Indonesia<br>
                            fajarudinsidik@gmail.com<br>
                            +6212354335
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
                    <th class="active-background-color">Item Tagihan</th>
                    <th class="active-background-color">Jumlah Tagihan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Pembayaran Transaksi Paket Umrah kode TRA008981</td>
                    <td class="center">IDR 2.500.000,00</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- detail pembayaran -->
    <div style="margin-bottom: 10mm;">
        <div style="font-weight: bold; margin-bottom: 1mm;">Pembayaran Dilakukan</div>
        <table class="tabel-detail-invoice" style="width: 100%">
            <thead>
                <tr>
                    <th class="active-background-color">Waktu Pembayaran</th>
                    <th class="active-background-color">Metode Pembayaran</th>
                    <th class="active-background-color">Jumlah Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="3" class="center"><i>Belum ada pembayaran dilakukan</i></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- informasi transfer -->
    <div style="margin-bottom: 10mm;">
        <b>Catatan :</b><br>
        Pembayaran dibatalkan oleh sistem karena melewati batas waktu yang ditentukan
        <br><br>
        <b>Untuk pembayaran melalui transfer dapat ditujukan ke :</b>
        <table class="tabel-detail-invoice" style="width: 100%; margin-top: 1mm;">
            <thead>
                <tr>
                    <th class="active-background-color">Bank</th>
                    <th class="active-background-color">Kantor Cabang</th>
                    <th class="active-background-color">Nomor Rekening</th>
                    <th class="active-background-color">Atas Nama</th>
                </tr>
            </thead>
            <tbody>
                <tr class="nowrap">
                    <td>Mandiri (IDR)</td>
                    <td class="center">Raya Darmo</td>
                    <td class="center">111111111111</td>
                    <td class="center">Erahajj Indonesia</td>
                </tr>
                <tr class="nowrap">
                    <td>BCA (IDR)</td>
                    <td class="center">Raya Darmo</td>
                    <td class="center">222222222222</td>
                    <td class="center">Erahajj Indonesia</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div id="print-area-btn" class="no-print">
        <hr>

    </div>

</body>

</html>