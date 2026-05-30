<!DOCTYPE html>
<html itemscope="" itemtype="http://schema.org/Product">
<?php
include '../../../include/all_include.php';
include '../../../include/function/session.php';
$proses = decrypt(mysql_real_escape_string($_GET['kode']));
$sql = mysql_query("SELECT * FROM data_penjualan_voucher where id_penjualan = '$proses'");
$data = mysql_fetch_array($sql);

$jatuh_tempo = date('Y-m-d H:i:s', strtotime($data['tanggal_penjualan'] . ' + 30 days'));
?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Kwitansi Pembayaran</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="icon" href="../../../data/image/logo/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="Kwitansi Pembayaran_files/style.css">
    <link rel="stylesheet" href="Kwitansi Pembayaran_files/bootstrap.min.css">
</head>

<body class="print" style="
    background-color: #ecf0f5;
">
    <div id="kwitansi">
        <div id="kwitansi-inner">
            <div id="header-kwitansi">
                <table style="width: auto !important;">
                    <tbody>
                        <tr>
                            <td>
                                <img id="logo" src="../../../data/image/logo/logo.png">
                            </td>
                            <td>
                                <div id="alamat" style="width: 100%;">
                                    <p style="margin-top: 6px;">
                                       PT.CAHAYA BUNGO SARKOPALMA
                                        <br>Jl. Lintas Sumatera, Bernai,<br>Kec. Sarolangun, Kabupaten Sarolangun, <br>Jambi 37481
                                    </p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <span id="kode-pembayaran" style="
    font-size: 16px;">No : ID<?php echo $data['id_penjualan']; ?></span>
            </div>
            <hr>
            <h3 id="judul-kwitansi">KWITANSI PEMBAYARAN</h3>

            <table>
                <tbody>
                    <tr>
                        <td style="width: 130px;">Sudah Terima Dari</td>
                        <td align="center" style="width: 10px;"> :</td>
                        <td><?php echo baca_database("", "nama", "select * from data_relasi where id_relasi='$data[id_relasi]'")  ?></td>
                    </tr>
                    <tr>
                        <td>Jumlah Diterima</td>
                        <td align="center"> :</td>
                        <td>
                            <?php echo rupiah($data['total_bayar']); ?> ( <?php echo terbilang($data['total_bayar']); ?> Rupiah )
                        </td>
                    </tr>
                    <tr>
                        <td>Deskripsi</td>
                        <td align="center"> :</td>
                        <td>
                            Pembayaran Transaksi E-Voucher kode INV<?php echo $data['id_penjualan']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="center"> </td>
                        <td>

                        </td>
                    </tr>
                </tbody>
            </table>

            <table id="kwitansi-ttd-area">
                <tbody>
                    <tr>
                        <td>
                            <div id="yang-menyerahkan">
                                <div style="margin-bottom: 38pt;">Diserahkan Oleh</div>
                                <div><?php echo baca_database("", "nama", "select * from data_relasi where id_relasi='$data[id_relasi]'")  ?></div>
                            </div>
                        </td>
                        <td>
                            <div id="yang-menerima">
                                <div>Sarolangun, <?php echo format_indo(date('Y-m-d')); ?></div>
                                <div style="margin-bottom: 38pt;">Diterima Oleh</div>
                                <div>PT.CAHAYA BUNGO SARKOPALMA</div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <img style="height: 225pt !important; width: 595.28pt !important;" id="bg-kwitansi" src="Kwitansi Pembayaran_files/bg-kwitansi.png">
        </div>



    </div>
</body>

</html>