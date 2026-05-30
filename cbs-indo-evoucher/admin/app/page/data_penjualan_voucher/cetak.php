<?php
if (isset($_GET['input'])) {
    echo "<h3> Cetak Laporan ";
    tabelnomin();
    echo "</h3>";
    ?>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">
    <?php
    action_cetak("data_penjualan_voucher");
} else {

    function location()
    {
        return "cetak";
    }

    include '../../../include/all_include.php';
    proses_action_cetak("data_penjualan_voucher");
    ?>
    <style>
        .text-right {
            text-align: right;
        }
    </style>

    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">


    <!-- HEADER -->
    <table border="0" style="width: 100%">
        <?php
        if (isset($_GET['export'])) {
            ?>
            <tr>
                <td colspan="8" align="center" class="auto-style1">
                    <center>
                        <strong>
                        PT. CAHAYA BUNGO SARKOPALMA
                        </strong>
                    </center>
                </td>
            </tr>

            <tr>
                <td colspan="8" align="center" class="auto-style2">
                    <center>
                        <h2 style="margin: 0px;" class="auto-style1">LAPORAN PENJUALAN E-VOUCHER</h2>
                    </center>
                </td>
            </tr>

            <tr>
                <td colspan="8" align="center" class="auto-style2"><center>SPBU <?php $id_admin = decrypt($_COOKIE['kodene']);
                echo $nama_spbu = baca_database("", "nama_spbu", "select * from data_admin where id_admin='$id_admin'");

                echo ", ";
                echo $alamat_spbu = baca_database("", "alamat1", "select * from data_spbu where nama_spbu like '%$nama_spbu%'")
                    ?></center></td>
            </tr>
            <?php
        } else {
            ?>
            <tr>
                <td class="auto-style1" rowspan="3" width="101">
                    <img alt="" height="100" src="<?php echo $logo_laporan1; ?>" width="100">
                </td>

                <td class="auto-style1">
                    <center>
                        <strong>
                        PT. CAHAYA BUNGO SARKOPALMA
                    </strong>
                    </center>
                </td>

                <td class="auto-style1" rowspan="3" width="101">
                    <img alt="" height="100" src="<?php echo $logo_laporan2; ?>" width="100">
                </td>
            </tr>

            <tr>
                <td class="auto-style2">
                    <center>
                        <h2 style="margin: 0px;" class="auto-style1">LAPORAN PENJUALAN E-VOUCHER
                        </h2>
                    </center>
                </td>
            </tr>

            <tr>
                <td class="auto-style2"><center>SPBU <?php $id_admin = decrypt($_COOKIE['kodene']);
                echo $nama_spbu = baca_database("", "nama_spbu", "select * from data_admin where id_admin='$id_admin'");

                echo ", ";
                echo $alamat_spbu = baca_database("", "alamat1", "select * from data_spbu where nama_spbu like '%$nama_spbu%'")
                    ?></center></td>
            </tr>
        <?php } ?>
    </table>
    <!-- HEADER -->

    <?php
    $text_cetak = "";
    if (isset($_GET['isi']) && !empty($_GET['isi'])) {
        $Berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
        $isi = mysql_real_escape_string($_GET['isi']);
        $text_cetak = 'Cetak berdasarkan <b>' . $Berdasarkan . '</b> : <b>' . $isi . '</b>';
    } elseif (isset($_GET['tanggal1']) && !empty($_GET['tanggal1'])) {
        $Berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
        $tanggal1 = mysql_real_escape_string($_GET['tanggal1']);
        $tanggal2 = mysql_real_escape_string($_GET['tanggal2']);
        $tanggal1_indo = format_indo($tanggal1);
        $tanggal2_indo = format_indo($tanggal2);
        $text_cetak = 'Cetak Berdasarkan <b>' . $Berdasarkan . '</b> Dari Tanggal <b>' . $tanggal1_indo . '</b> s/d <b>' . $tanggal2_indo . '</b>';
    }
    
    if($text_cetak != "") {
        if(isset($_GET['export'])) {
            echo '<table width="100%" border="0"><tr><td colspan="8" align="center"><center>'.$text_cetak.'</center></td></tr></table><br>';
        } else {
            echo '<center>'.$text_cetak.'</center>';
        }
    }
    ?>

    <!-- BODY -->
    <table width="100%" <?php echo isset($_GET['export']) ? 'border="1" style="border-collapse:collapse;"' : 'class="tblcms2"'; ?>>
        <tr>
            <th class="th_border cell">No</th>
            <!--h <th class="th_border cell">Id Penjualan </th> h-->
            <th align="center" class="th_border cell">Nama </th>
            <th align="center" class="th_border cell">Tanggal Penjualan </th>
            <th align="center" class="th_border cell">Jumlah Voucher </th>
            <th align="center" class="th_border cell">Nominal </th>
            <th align="center" class="th_border cell">Password Voucher </th>
            <th align="center" class="th_border cell">Tanggal Dibuka </th>
            <!-- <th align="center" class="th_border cell">Sub Total </th> -->
            <!-- <th align="center" class="th_border cell">Persentase Ppn </th> -->
            <!-- <th align="center" class="th_border cell">Ppn </th> -->
            <th align="center" class="th_border cell">Total Bayar </th>


        </tr>

        <tbody>
            <?php
            $no = 0;
            $jumlah_voucher = 0;

            $request_nominal = new RequestPencarianNominal('nominal');
            $request_relasi = new RequestString('relasi');

            if (isset($_GET['isi']) && !empty($_GET['isi'])) {
                //BERDASARKAN
                $Berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
                $isi = mysql_real_escape_string($_GET['isi']);
                $querytabel = "SELECT * FROM data_penjualan_voucher where $Berdasarkan like '%$isi%'";
                if ($request_nominal->isValid()) {
                    $querytabel .= " AND nominal = " . $request_nominal->getValue();
                }

                if ($request_relasi->isValid()) {
                    $querytabel .= " AND id_relasi = '" . $request_relasi->getValue() . "'";
                }
            } elseif (isset($_GET['tanggal1']) && !empty($_GET['tanggal1'])) {
                //PERIODE
                $Berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
                $tanggal1 = mysql_real_escape_string($_GET['tanggal1']);
                $tanggal2 = mysql_real_escape_string($_GET['tanggal2']);
                $querytabel = "SELECT * FROM data_penjualan_voucher where ($Berdasarkan BETWEEN '$tanggal1' AND '$tanggal2')";
                if ($request_nominal->isValid()) {
                    $querytabel .= " AND nominal = " . $request_nominal->getValue();
                }

                if ($request_relasi->isValid()) {
                    $querytabel .= " AND id_relasi = '" . $request_relasi->getValue() . "'";
                }
            } else {
                //SEMUA
                $querytabel = "SELECT * FROM data_penjualan_voucher";
                if ($request_nominal->isValid()) {
                    $querytabel .= " WHERE nominal = " . $request_nominal->getValue();
                }
            }
            $proses = mysql_query($querytabel);
            while ($data = mysql_fetch_array($proses)) {
                $total += $data['total_bayar'];
                ?>
                <tr class="event2">
                    <td align="center" width="50"><?php $no = $no + 1;
                    echo $no; ?></td>
                    <!--h <td align="center"><?php echo $data['id_penjualan']; ?></td> h-->
                    <td align="center">
                        <?php echo baca_database("", "nama", "select * from data_relasi where id_relasi='$data[id_relasi]'") ?>
                    </td>
                    <td align="center"><?php echo format_indo_jam($data['tanggal_penjualan']); ?></td>
                    <td align="center"><?php echo $data['jumlah_voucher'];
                    $jumlah_voucher = $jumlah_voucher + $data['jumlah_voucher'];

                    ?></td>
                    <td align="right" class="text-right"><?php echo rupiah($data['nominal']); ?></td>
                    <td align="center"><?php echo $data['password_voucher']; ?></td>
                    <td align="center"><?php echo format_indo_jam($data['tanggal_dibuka']); ?></td>
                    <!-- <td align="right" class="text-right"><?php echo rupiah($data['sub_total']); ?></td> -->
                    <!-- <td align="center"><?php echo $data['persentase_ppn']; ?></td> -->
                    <!-- <td align="right" class="text-right"><?php echo rupiah($data['ppn']); ?></td> -->
                    <td align="right" class="text-right"><?php echo rupiah($data['total_bayar']); ?></td>

                </tr>
            <?php } ?>
            <tr>
                <td colspan="7" align="right" class="text-right"><b>Jumlah Voucher : <?php echo $jumlah_voucher; ?></b></td>
                <td align="right" class="text-right"><b><?php echo rupiah($total); ?></b></td>
            </tr>
        </tbody>
    </table>
    <!-- BODY -->


    <table width="100%" style="border: 0px solid #ddd;" >
        <tbody>
            <tr>
                <?php if (isset($_GET['export'])) { ?>
                <td colspan="7"></td>
                <td colspan="1" align="center" style="align-content: baseline;">
                    <?php  ttd();?>
                </td>
                <?php } else { ?>
                <td width="80%"></td>
                <td style="align-content: baseline;" align="center">
                    <?php  ttd();?>
                </td>
                <?php } ?>
            </tr>
        </tbody>
    </table>

<?php } ?>