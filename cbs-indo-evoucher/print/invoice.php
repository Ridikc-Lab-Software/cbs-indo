<!DOCTYPE html>
<!-- saved from url=(0061)http://admin.demo.erahajj.co.id/transaksi/invoice/cetak/15313 -->
<html id="print-page" class="display"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Invoice Transaksi</title>
    <link rel="stylesheet" href="./Invoice Transaksi_files/admin.css">
    <link rel="stylesheet" href="./Invoice Transaksi_files/style.css">
    <link rel="stylesheet" href="./Invoice Transaksi_files/bootstrap.min.css">
    <link rel="stylesheet" href="./Invoice Transaksi_files/style.min.css">
    <link rel="stylesheet" href="./Invoice Transaksi_files/font-awesome.min.css">
    <style>  </style>
    
    <link rel="icon" href="http://cdn.demo.erahajj.co.id.s3.amazonaws.com/5ecb8a672730e3504d6cc22447235b879004c08b1570ced45e803897536ddd75786aa2dd3a53fe085e67dc73cb6eda67b4ddb5c09f2dd4ec8fb12b5f1982a4d1.png" type="image/x-icon">

    <script src="./Invoice Transaksi_files/jquery-1.10.2.min.js.download"></script>
    <script src="./Invoice Transaksi_files/bootstrap.min.js.download"></script>
    <script src="./Invoice Transaksi_files/accounting.min.js.download"></script>
    <script src="./Invoice Transaksi_files/cssmenu.js.download"></script>
    <script src="./Invoice Transaksi_files/main-script.js.download"></script>

    <style>
        @media  print {
            .no-print, .no-print * {
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
                
                    <img style="position: absolute; left: 90mm; top: 30mm; width: 50mm;" src="./Invoice Transaksi_files/stamp-belum-dibayar.png">

    <!-- header -->
    <div style="display: inline-block; width: 100%; margin-top: 5mm; margin-bottom: 5mm;">
        <table style="table-layout: fixed;width: 100%;">
            <tbody><tr>
                <td>
                    <img style="max-width: 240px; margin-top: 3mm; max-height: 75px;" src="./Invoice Transaksi_files/26c46d90fc3959cba10e29551f2230d0475d1bb73a987115fc9fccb1f0931d25ea2f53da198b4f5b7fa15f9677b63685fff687948a1313d836cdd488b433c1b1.png">
                </td>
                <td style="text-align: right !important;">
                    <div id="invoice-nama-perusahaan" class="active-color" style="font-size: 20px; font-weight: 500; margin-bottom: 2mm;">Erahajj Indonesia</div>
                    <div>
                        Jl. Tangkuban Perahu<br>
                        Denpasar Barat, Denpasar<br>
                        Bali, 80117
                    </div>
                </td>
            </tr>
        </tbody></table>
    </div>

    <table style="table-layout: fixed;width: 100%;">
        <tbody><tr>
            <td>
                <!-- header invoice -->
                <div class="background-color-5 border-color-50" style="border: 1px solid; padding: 2mm; margin-bottom: 3mm;">
                    <div style="font-weight: bold;margin-bottom: 1mm;position: relative;">
                        PROFORMA INVOICE PMA015313
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
                        ads<br>
                        dsasffdsds@gmail.com<br>
                        +6212354335
                    </div>
                </div>
            </td>
        </tr>
    </tbody></table>

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
        <a onclick="window.close()" class="btn" data-original-title="" title="" rel="noopener noreferrer">Tutup Halaman</a>
        <a onclick="window.print()" class="btn" data-original-title="" title="" rel="noopener noreferrer">Cetak Halaman</a>
        <a href="http://admin.demo.erahajj.co.id/transaksi/invoice/cetak/15313?download=1&amp;dxid=62733e277d9cc05690de80b03c49e0c1" class="btn btn-download" data-original-title="" title="" rel="noopener noreferrer">Download PDF</a>
    </div>
<textarea class="hidden" name="script_map" cols="50" rows="10">W10=</textarea>

</body></html>