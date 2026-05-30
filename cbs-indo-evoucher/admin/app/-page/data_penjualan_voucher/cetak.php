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
        <?php } ?>

        <tr>
            <td class="auto-style2">
                <center>
                    
                        <h2 style="margin: 0px;"  class="auto-style1">LAPORAN PENJUALAN E-VOUCHER
                        </h2>
                </center>
            </td>
        </tr>

        <tr>
            <td class="auto-style2">SPBU <?php $id_admin = decrypt($_COOKIE['kodene']);
            echo $nama_spbu = baca_database("", "nama_spbu", "select * from data_admin where id_admin='$id_admin'");

            echo ", ";
            echo $alamat_spbu = baca_database("", "alamat1", "select * from data_spbu where nama_spbu like '%$nama_spbu%'")
                ?></td>
        </tr>
    </table>
    <!-- HEADER -->

    <!-- BODY -->
    <table width="100%" class="tblcms2">
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
                echo '<center> Cetak berdasarkan <b>' . $Berdasarkan . '</b> : <b>' . $isi . '</b></center>';
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
                $tanggal1_indo = format_indo($tanggal1);
                $tanggal2_indo = format_indo($tanggal2);
                echo '<center> Cetak Berdasarkan <b>' . $Berdasarkan . '</b> Dari Tanggal <b>' . $tanggal1_indo . '</b> s/d <b>' . $tanggal2_indo . '</b></center>';
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
                    <td class="text-right"><?php echo rupiah($data['nominal']); ?></td>
                    <td align="center"><?php echo $data['password_voucher']; ?></td>
                    <td align="center"><?php echo format_indo_jam($data['tanggal_dibuka']); ?></td>
                    <!-- <td class="text-right"><?php echo rupiah($data['sub_total']); ?></td> -->
                    <!-- <td align="center"><?php echo $data['persentase_ppn']; ?></td> -->
                    <!-- <td class="text-right"><?php echo rupiah($data['ppn']); ?></td> -->
                    <td class="text-right"><?php echo rupiah($data['total_bayar']); ?></td>

                </tr>
            <?php } ?>
            <tr>
                <td colspan="7" class="text-right"><b>Jumlah Voucher : <?php echo $jumlah_voucher; ?></b></td>
                <td class="text-right"><b><?php echo rupiah($total); ?></b></td>
            </tr>
        </tbody>
    </table>
    <!-- BODY -->


    <table width="100%" style="border: 0px solid #ddd;" >
        <tbody>
            <tr>
                <td width="80%"></td>
                <td style="align-content: baseline;">
                    <?php  ttd();?>
                </td>
            </tr>
        </tbody>
    </table>

<?php } ?>