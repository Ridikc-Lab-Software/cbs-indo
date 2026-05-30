<?php

if (isset($_GET['input'])) {
    echo "<h3> Cetak Laporan ";
    tabelnomin();
    echo "</h3>";
    ?>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">
    <?php
    action_cetak("data_transaksi_voucher");
} else {

    function location()
    {
        return "cetak";
    }

    include '../../../include/all_include.php';

    if (isset($_GET['export'])) {
        // header("Location:export_excel.php?".http_build_query($_GET));
    }

    proses_action_cetak("data_transaksi_voucher");

    ?>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">

    <style>
        .text-right { text-align: right; }
    </style>

    <?php

    // Ambil Data Shift untuk mapping
    $shifts = [];
    $q_shift = mysql_query("SELECT * FROM data_shift");
    while ($r_shift = mysql_fetch_array($q_shift)) {
        $shifts[] = $r_shift;
    }

    function get_shift($waktu, $shifts)
    {
        $jam = date('H:i:s', strtotime($waktu));
        foreach ($shifts as $s) {
            if ($jam >= $s['jam_mulai'] && $jam <= $s['jam_selesai']) {
                return $s['shift'];
            }
            // Handle shift nyebrang hari (misal 22:00 - 06:00)
            if ($s['jam_mulai'] > $s['jam_selesai']) {
                if ($jam >= $s['jam_mulai'] || $jam <= $s['jam_selesai']) {
                    return $s['shift'];
                }
            }
        }
        return "-";
    }

    // Ambil filter shift jika ada
    $filter_shift = isset($_GET['shift']) ? $_GET['shift'] : '';
    $jam_mulai = '';
    $jam_selesai = '';

    if ($filter_shift != '') {
        $q_shift = mysql_query("SELECT jam_mulai, jam_selesai FROM data_shift WHERE id_shift = '$filter_shift' LIMIT 1");
        if ($d_shift = mysql_fetch_assoc($q_shift)) {
            $jam_mulai = $d_shift['jam_mulai'];
            $jam_selesai = $d_shift['jam_selesai'];
        }
    }

    // Request parameter
    $request_jenis_bbm = new RequestString('jenis_bbm');
    $request_nominal   = new RequestPencarianNominal('nominal');
    $request_relasi    = new RequestString('relasi');
    $request_id_supir  = new RequestString('id_supir');          // BARU
    $request_no_plat   = new RequestString('no_plat_kendaraan'); // BARU

    ?>

    <!-- HEADER -->
    <table border="0" style="width: 100%">
        <?php if (!isset($_GET['export'])) { ?>
            <tr>
                <td class="auto-style1" rowspan="3" width="101">
                    <img alt="" height="100" src="<?php echo $logo_laporan1; ?>" width="100">
                </td>
                <td class="auto-style1">
                    <center><strong>PT. CAHAYA BUNGO SARKOPALMA</strong></center>
                </td>
                <td class="auto-style1" rowspan="3" width="101">
                    <img alt="" height="100" src="<?php echo $logo_laporan2; ?>" width="100">
                </td>
            </tr>
            <tr>
                <td class="auto-style2">
                    <center><h2 class="auto-style1" style="margin: 0px;">LAPORAN TRANSAKSI E-VOUCHER</h2></center>
                </td>
            </tr>
            <tr>
                <td class="auto-style2">
                    SPBU <?php 
                    $id_admin = decrypt($_COOKIE['kodene']);
                    $nama_spbu = baca_database("", "nama_spbu", "SELECT * FROM data_admin WHERE id_admin='$id_admin'");
                    echo $nama_spbu . ", ";
                    echo baca_database("", "alamat1", "SELECT * FROM data_spbu WHERE nama_spbu LIKE '%$nama_spbu%'");
                    ?>
                </td>
            </tr>
        <?php } ?>
    </table>
    <br>

    <!-- BODY -->
    <table width="100%" class="tblcms2">
        <tr>
            <th class="th_border cell">No</th>
            <th align="center" class="th_border cell">Nama Relasi</th>
            <th align="center" class="th_border cell">Tanggal Transaksi</th>
            <th align="center" class="th_border cell">Shift</th>
            <th align="center" class="th_border cell">Qrcode</th>
            <th align="center" class="th_border cell">Nama Supir</th>
            <th align="center" class="th_border cell">Nomor Plat</th>
            <th align="center" class="th_border cell">Foto</th>
            <th align="center" class="th_border cell">Jenis BBM</th>
            <th align="center" class="th_border cell">Nominal</th>
            <th align="center" class="th_border cell">Liter</th>
        </tr>

        <tbody>
            <?php
            $TURBO = $DEXLITE = $PERTAMAX = $PERTALITE = 0;
            $JML_TURBO = $JML_DEXLITE = $JML_PERTAMAX = $JML_PERTALITE = 0;
            $JML_TURBO_LITER = $JML_DEXLITE_LITER = $JML_PERTAMAX_LITER = $JML_PERTALITE_LITER = 0.0;

            $no = 0;
            $total = 0;
            $total_liter = 0;

            // Base query dengan JOIN yang diperlukan
            $querytabel = "SELECT dtv.*, dv.id_relasi 
                           FROM data_transaksi_voucher dtv
                           LEFT JOIN data_voucher dv ON dtv.id_voucher = dv.id_voucher
                           LEFT JOIN data_plat_kendaraan_transaksi_voucher dpktv 
                                  ON dpktv.id_transaksi_voucher = dtv.id_transaksi";

            $where_conditions = [];

            // Filter periode tanggal (utama)
            if (isset($_GET['tanggal1']) && !empty($_GET['tanggal1'])) {
                $tanggal1 = mysql_real_escape_string($_GET['tanggal1']);
                $tanggal2 = mysql_real_escape_string($_GET['tanggal2']);
                $tanggal1_indo = format_indo($tanggal1);
                $tanggal2_indo = format_indo($tanggal2);

                echo '<center> Cetak Berdasarkan <b>tanggal_transaksi</b> Dari Tanggal <b>' . $tanggal1_indo . '</b> s/d <b>' . $tanggal2_indo . '</b></center><br>';

                $where_conditions[] = "dtv.tanggal_transaksi >= '$tanggal1'";
                $where_conditions[] = "dtv.tanggal_transaksi < DATE_ADD('$tanggal2', INTERVAL 1 DAY)";
            }

            // Filter Jenis BBM
            if ($request_jenis_bbm->isValid() && $_GET['jenis_bbm'] != '') {
                $where_conditions[] = "dtv.jenis_bbm = '" . mysql_real_escape_string($_GET['jenis_bbm']) . "'";
            }

            // Filter Nominal
            if ($request_nominal->isValid() && $_GET['nominal'] != '') {
                $where_conditions[] = "dv.nominal = '" . mysql_real_escape_string($_GET['nominal']) . "'";
            }

            // Filter Relasi (hidden)
            if ($request_relasi->isValid() && $_GET['relasi'] != '') {
                $where_conditions[] = "dv.id_relasi = '" . mysql_real_escape_string($_GET['relasi']) . "'";
            }

            // Filter Supir (BARU)
            if ($request_id_supir->isValid() && $_GET['id_supir'] != '') {
                $where_conditions[] = "dpktv.id_supir = '" . mysql_real_escape_string($_GET['id_supir']) . "'";
            }

            // Filter Plat Kendaraan (BARU)
            if ($request_no_plat->isValid() && $_GET['no_plat_kendaraan'] != '') {
                $where_conditions[] = "dpktv.no_plat_kendaraan = '" . mysql_real_escape_string($_GET['no_plat_kendaraan']) . "'";
            }

            // Filter Shift berdasarkan jam
            if ($filter_shift != '' && $jam_mulai != '' && $jam_selesai != '') {
                if ($jam_mulai < $jam_selesai) {
                    $where_conditions[] = "TIME(dtv.tanggal_transaksi) BETWEEN '$jam_mulai' AND '$jam_selesai'";
                } else {
                    $where_conditions[] = "(TIME(dtv.tanggal_transaksi) >= '$jam_mulai' OR TIME(dtv.tanggal_transaksi) <= '$jam_selesai')";
                }
            }

            // Gabungkan WHERE
            if (!empty($where_conditions)) {
                $querytabel .= " WHERE " . implode(" AND ", $where_conditions);
            }

            $querytabel .= " ORDER BY dtv.tanggal_transaksi DESC";

            $proses = mysql_query($querytabel);
            $path = "http://localhost/GITHUB/Custom/CBS/cbs-indo-membercard/admin/upload/";

            while ($data = mysql_fetch_array($proses)) {
                $total += $data['nominal'];

                // Ambil data supir & plat dari tabel hubungan
                $id_transaksi_voucher = $data['id_transaksi'];

                $plat = baca_database("", "no_plat_kendaraan", "SELECT * from data_plat_kendaraan_transaksi_voucher 
                                                  WHERE id_transaksi_voucher = '$id_transaksi_voucher'");

                $plat = baca_database("", "plat", "SELECT * FROM data_plat 
                                                  WHERE id_plat = '$plat'");
                if ($plat == "") $plat = "-";


                $supir = baca_database("", "nama_supir", "SELECT nama_supir FROM data_supir ds 
                                                          JOIN data_plat_kendaraan_transaksi_voucher dpktv 
                                                          ON dpktv.id_supir = ds.id_supir 
                                                          WHERE dpktv.id_transaksi_voucher = '$id_transaksi_voucher' LIMIT 1");
                if ($supir == "") $supir = "-";

                $foto = baca_database("", "foto", "SELECT foto FROM data_plat_kendaraan_transaksi_voucher 
                                                   WHERE id_transaksi_voucher = '$id_transaksi_voucher'");

                $no++;
            ?>
                <tr class="event2">
                    <td align="center"><?php echo $no; ?></td>
                    <td><?php echo baca_database("", "nama", "SELECT nama FROM data_relasi WHERE id_relasi='{$data['id_relasi']}'"); ?></td>
                    <td align="center"><?php echo format_indo_jam($data['tanggal_transaksi']); ?></td>
                    <td align="center"><?php echo get_shift($data['tanggal_transaksi'], $shifts); ?></td>
                    <td align="center">ID<?php echo baca_database("", "id_voucher", "SELECT id_voucher FROM data_voucher WHERE id_voucher='{$data['id_voucher']}'"); ?></td>
                    <td><?php echo $supir; ?></td>
                    <td><?php echo $plat; ?></td>
                    <td>
                        <?php
                        if (!empty($foto)) {
                            $list_foto = explode(",", $foto);
                            foreach ($list_foto as $img) {
                                $img = trim($img);
                                if ($img != "") { ?>
                                    <a href="<?php echo $path . $img; ?>" target="_blank">
                                        <img src="<?php echo $path . $img; ?>" width="50" height="50" style="object-fit:cover; margin:3px;">
                                    </a>
                                <?php }
                            }
                        }
                        ?>
                    </td>
                    <td align="center">
                        <?php
                        $jenis_bbm_obj = QB::table("data_jenis_transaksi")->where("id_jenis_transaksi", $data['jenis_bbm'])->first();
                        $jenis_bbm = $jenis_bbm_obj ? $jenis_bbm_obj->jenis_transaksi : $data['jenis_bbm'];

                        echo $jenis_bbm;

                        // Hitung summary per jenis BBM
                        switch ($jenis_bbm) {
                            case "TURBO":     $TURBO++; $JML_TURBO += $data['nominal']; break;
                            case "DEXLITE":   $DEXLITE++; $JML_DEXLITE += $data['nominal']; break;
                            case "PERTAMAX":  $PERTAMAX++; $JML_PERTAMAX += $data['nominal']; break;
                            case "PERTALITE": $PERTALITE++; $JML_PERTALITE += $data['nominal']; break;
                        }
                        ?>
                    </td>
                    <td class="text-right"><?php echo rupiah($data['nominal']); ?></td>
                    <td align="center">
                        <?php
                        $harga_perliter = baca_database("", "harga", "SELECT harga FROM data_jenis_transaksi WHERE jenis_transaksi='$jenis_bbm'");
                        $liter = $harga_perliter > 0 ? round($data['nominal'] / $harga_perliter, 2) : 0;
                        echo $liter . " L";
                        $total_liter += $liter;

                        switch ($jenis_bbm) {
                            case "TURBO":     $JML_TURBO_LITER += $liter; break;
                            case "DEXLITE":   $JML_DEXLITE_LITER += $liter; break;
                            case "PERTAMAX":  $JML_PERTAMAX_LITER += $liter; break;
                            case "PERTALITE": $JML_PERTALITE_LITER += $liter; break;
                        }
                        ?>
                    </td>
                </tr>
            <?php } ?>

            <tr>
                <td colspan="9" class="text-right"><strong>Jumlah Voucher : <?php echo $no; ?></strong></td>
                <td class="text-right"><strong><?php echo rupiah($total); ?></strong></td>
                <td class="text-left"><strong><?php echo number_format($total_liter, 2, ',', '.'); ?> L</strong></td>
            </tr>
        </tbody>
    </table>

    <?php if ($_GET['jenis_bbm'] == "" || !isset($_GET['jenis_bbm'])) { ?>
        <br>
        <table border="0" style="border: 0px solid #ddd; width: 100%">
            <tr>
                <td>
                    <strong>Summary Jumlah Transaksi per Jenis BBM dan Total Liter</strong><br><br>
                    <table style="width: 60%;">
                        <tr>
                            <td>TURBO</td>
                            <td>:</td>
                            <td><?php echo $TURBO; ?></td>
                            <td>Nominal : <?php echo rupiah($JML_TURBO); ?></td>
                            <td>Liter : <?php echo number_format($JML_TURBO_LITER, 2, ',', '.'); ?> L</td>
                        </tr>
                        <tr>
                            <td>DEXLITE</td>
                            <td>:</td>
                            <td><?php echo $DEXLITE; ?></td>
                            <td>Nominal : <?php echo rupiah($JML_DEXLITE); ?></td>
                            <td>Liter : <?php echo number_format($JML_DEXLITE_LITER, 2, ',', '.'); ?> L</td>
                        </tr>
                        <tr>
                            <td>PERTAMAX</td>
                            <td>:</td>
                            <td><?php echo $PERTAMAX; ?></td>
                            <td>Nominal : <?php echo rupiah($JML_PERTAMAX); ?></td>
                            <td>Liter : <?php echo number_format($JML_PERTAMAX_LITER, 2, ',', '.'); ?> L</td>
                        </tr>
                        <tr>
                            <td>PERTALITE</td>
                            <td>:</td>
                            <td><?php echo $PERTALITE; ?></td>
                            <td>Nominal : <?php echo rupiah($JML_PERTALITE); ?></td>
                            <td>Liter : <?php echo number_format($JML_PERTALITE_LITER, 2, ',', '.'); ?> L</td>
                        </tr>
                    </table>
                </td>
                <td style="vertical-align: bottom; text-align: right;">
                    <?php ttd(); ?>
                </td>
            </tr>
        </table>
    <?php } ?>

<?php } ?>