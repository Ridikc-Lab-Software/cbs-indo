<?php
if (isset($_GET['input'])) {
    echo "<h3> Cetak Laporan ";
    tabelnomin();
    echo "</h3>";
    ?>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">
    <?php
    action_cetak("data_voucher");
} else {

    function location()
    {
        return "cetak";
    }

    include '../../../include/all_include.php';
    proses_action_cetak("data_voucher");
    ?>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">
    <style>
        .text-right {
            text-align: right;
        }
    </style>


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
                 
                    <strong>
                        PT. CAHAYA BUNGO SARKOPALMA
                    </strong>
                </td>

                <td class="auto-style1" rowspan="3" width="101">
                    <img alt="" height="100" src="<?php echo $logo_laporan2; ?>" width="100">
                </td>
            </tr>
        <?php } ?>

        <tr>
            <td class="auto-style2">
                <center>

                   <center>
                        <h2 style="margin: 0px;" class="auto-style1">LAPORAN E-VOUCHER
                        </h2>
                    </center>

                    
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
            <th align="center" class="th_border cell">Tanggal Dibuka </th>
            <!--h <th class="th_border cell">Id Voucher </th> h-->
            <th align="center" class="th_border cell">Qrcode </th>
            <th align="center" class="th_border cell">Nama </th>
            <th align="center" class="th_border cell">Nominal </th>
            <th align="center" class="th_border cell">Tanggal Kadaluarsa </th>
            <th align="center" class="th_border cell">Nama Spbu </th>
            <!-- <th align="center" class="th_border cell">Id Relasi </th> -->
            <th align="center" class="th_border cell">Status </th>
            <!-- <th align="center" class="th_border cell">File Voucher </th> -->



        </tr>

        <tbody>
            <?php

            $request_s_status = new RequestString("status");
            $request_s_relasi = new RequestString("relasi");
            $request_s_nominal = new RequestPencarianNominal("nominal");

            $no = 0;

            $q_builder = QB::table('data_voucher')
                ->setFetchMode(PDO::FETCH_ASSOC);

            if (isset($_GET['isi']) && !empty($_GET['isi'])) {
                //BERDASARKAN
                $Berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
                $isi = mysql_real_escape_string($_GET['isi']);
                echo '<center> Cetak berdasarkan <b>' . $Berdasarkan . '</b> : <b>' . $isi . '</b></center>';

                $q_builder = $q_builder->where($Berdasarkan, 'like', '%' . $isi . '%');
            } elseif (isset($_GET['tanggal1']) && !empty($_GET['tanggal1'])) {
                //PERIODE
                $Berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
                $tanggal1 = mysql_real_escape_string($_GET['tanggal1']);
                $tanggal2 = mysql_real_escape_string($_GET['tanggal2']);
                $tanggal1_indo = format_indo($tanggal1);
                $tanggal2_indo = format_indo($tanggal2);
                echo '<center> Cetak Berdasarkan <b>' . $Berdasarkan . '</b> Dari Tanggal <b>' . $tanggal1_indo . '</b> s/d <b>' . $tanggal2_indo . '</b></center>';

                $q_builder = $q_builder->whereBetween($Berdasarkan, $tanggal1, $tanggal2);
            }

            if ($request_s_status->isValid()) {
                if ($request_s_status->getValue() == "Kadaluarsa") {
                    //                    $q_builder = $q_builder->where('tanggal_kadaluarsa', "<", date("Y-m-d"));
                    $q_builder = $q_builder->where('tanggal_kadaluarsa', "<", date("Y-m-d"))
                        ->where('status', 'Unused');
                } else {
                    $q_builder = $q_builder->where('status', $request_s_status->getValue());
                }
            }

            if ($request_s_nominal->isValid()) {
                $q_builder = $q_builder->where('nominal', $request_s_nominal->getValue());
            }

            if ($request_s_relasi->isValid()) {
                $q_builder = $q_builder->where('id_relasi', $request_s_relasi->getValue());
            }

            foreach ($q_builder->get() as $data) {
                ?>
                <tr class="event2">
                    <td align="center" width="50"><?php $no = $no + 1;
                    echo $no; ?></td>
                    <!--h <td align="center"><?php echo $data['id_voucher']; ?></td> h-->
                    <td align="center"><?php echo $data['tanggal_dibuka']; ?></td>
                    <td align="center">ID<?php echo $data['id_voucher']; ?></td>
                    <td align="center">
                        <?php echo baca_database("", "nama", "select * from data_relasi where id_relasi='$data[id_relasi]'") ?>
                    </td>
                    <td align="center"><?php echo rupiah($data['nominal']); ?></td>
                    <td align="center"><?php echo $data['tanggal_kadaluarsa']; ?></td>
                    <td align="center">
                        <?php echo baca_database("", "nama_spbu", "select * from data_spbu where id_spbu='$data[id_spbu]'") ?>
                    </td>
                    <!-- <td align="center"><?php echo baca_database("", "id_relasi", "select * from data_penjualan_voucher where id_penjualan='$data[id_penjualan]'") ?></td> -->
                    <td align="center"><?php echo $data['status']; ?></td>
                    <!-- <td align="center"><a href="../../../../admin/upload/<?php echo $data['file_voucher']; ?>"><img onerror="this.src='../../../data/image/error/file.png'" width="50" height="30" src="../../../../admin/upload/<?php echo $data['file_voucher']; ?>"></a></td> -->

                </tr>
            <?php } ?>

            <tr>
                <td colspan="7" class="text-right"><strong>Jumlah Voucher</strong></td>
                <td class="text-center"><strong><?php echo $no; ?></strong></td>
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