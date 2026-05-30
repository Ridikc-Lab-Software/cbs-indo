<?php
if (isset($_GET['input'])) {
    echo "<h3> Cetak Laporan ";
    tabelnomin();
    echo "</h3>";
?>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">
<?php
    action_cetak("data_transaksi");
} else {
    function location()
    {
        return "cetak";
    }
    include '../../../include/all_include.php';
    proses_action_cetak("data_transaksi");
?>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">


    <!-- HEADER -->
    <table border="0" style="width: 100%">
        <?php if (isset($_GET['export'])) {
        } else {
        ?>
            <tr>
                <td class="auto-style1" rowspan="3" width="101">
                    <img alt="" height="100" src="<?php echo $logo_laporan1; ?>" width="100">
                </td>

                <td class="auto-style1">
                    <center>
                        <h2 class="auto-style1"><?php echo $judul; ?></h2>
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
                    <strong>LAPORAN

                        <?php
                        $tabelnya = "data_transaksi";
                        $tabelnya = str_replace("_", " ", $tabelnya);
                        $tabelnya = str_replace("data", "", $tabelnya);
                        $tabelnya = strtoupper($tabelnya);
                        echo $tabelnya; ?>

                    </strong>
                </center>
            </td>
        </tr>

        <tr>
            <td class="auto-style2"><?php echo $alamat; ?></td>
        </tr>
    </table>
    <!-- HEADER -->

    <!-- BODY -->
    <table width="100%" class="tblcms2">
        <tr>

            <th>No</th>
            <th align="center" class="th_border cell">Nama</th>
            <th align="center" class="th_border cell">Point</th>
            <th align="center" class="th_border cell">Jumlah</th>
            <th align="center" class="th_border cell">Jenis Kendaraan</th>
            <th align="center" class="th_border cell">Jenis Transaksi</th>

            <th align="center" class="th_border cell">Tanggal</th>
            <th align="center" class="th_border cell">Transaksi&nbsp;Terakhir</th>
            <th align="center" class="th_border cell">Jam</th>

            <th align="center" class="th_border cell">Operator</th>
            <th align="center" class="th_border cell">Nama SPBU</th>
            <th align="center" class="th_border cell">Informasi Member</th>



        </tr>


        <tbody>
            <?php
            $no = 0;
            if (isset($_GET['isi']) && !empty($_GET['isi'])) {
                //BERDASARKAN
                $Berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
                $isi =  mysql_real_escape_string($_GET['isi']);
                echo '<center> Cetak berdasarkan <b>' . $Berdasarkan . '</b> : <b>' . $isi . '</b></center>';
                $querytabel = "SELECT * FROM data_transaksi where $Berdasarkan like '%$isi%'";
            } else if (isset($_GET['tanggal1']) && !empty($_GET['tanggal1'])) {
                //PERIODE
                $Berdasarkan =  mysql_real_escape_string($_GET['Berdasarkan']);
                $tanggal1 =  mysql_real_escape_string($_GET['tanggal1']);
                $tanggal2 =  mysql_real_escape_string($_GET['tanggal2']);
                $tanggal1_indo = format_indo($tanggal1);
                $tanggal2_indo = format_indo($tanggal2);
                
                $filter_spbu = "";
                $spbu_info = "";
                if (isset($_GET['spbu']) && !empty($_GET['spbu'])) {
                    $spbu_selected = mysql_real_escape_string($_GET['spbu']);
                    $filter_spbu = " AND id_petugas IN (SELECT id_petugas FROM data_petugas WHERE nama_spbu LIKE '$spbu_selected%')";
                    $spbu_info = ' | SPBU : <b>' . $spbu_selected . '</b>';
                }
                
                echo '<center> Cetak Berdasarkan <b>' . $Berdasarkan . '</b> Dari Tanggal <b>' . $tanggal1_indo . '</b> s/d <b>' . $tanggal2_indo . '</b>' . $spbu_info . '</center>';
                $querytabel = "SELECT * FROM data_transaksi where ($Berdasarkan BETWEEN '$tanggal1' AND '$tanggal2 23:59:59')$filter_spbu";
            } else {
                //SEMUA
                $querytabel = "SELECT * FROM data_transaksi";
            }
            $proses = mysql_query($querytabel);
            
            // === OPTIMASI N+1 QUERY (MENCEGAH TIMEOUT INTERNAL SERVER ERROR) ===
            $rows = [];
            $list_id_member = [];
            $list_id_petugas = [];
            $list_id_transaksi = [];
            
            while ($data = mysql_fetch_array($proses)) {
                $rows[] = $data;
                if (!empty($data['id_member'])) $list_id_member[$data['id_member']] = "'" . mysql_real_escape_string($data['id_member']) . "'";
                if (!empty($data['id_petugas'])) $list_id_petugas[$data['id_petugas']] = "'" . mysql_real_escape_string($data['id_petugas']) . "'";
                if (!empty($data['id_transaksi'])) $list_id_transaksi[$data['id_transaksi']] = "'" . mysql_real_escape_string($data['id_transaksi']) . "'";
            }
            
            $members = [];
            $transaksi_terakhir = [];
            if (!empty($list_id_member)) {
                $in_members = implode(',', $list_id_member);
                $qm = mysql_query("SELECT id_member, nama, tanggal_terdaftar FROM data_member WHERE id_member IN ($in_members)");
                while($m = mysql_fetch_array($qm)) {
                    $members[$m['id_member']] = $m;
                }
                
                $qt = mysql_query("SELECT id_member, MAX(tanggal) as max_tgl FROM data_transaksi WHERE id_member IN ($in_members) GROUP BY id_member");
                while($t = mysql_fetch_array($qt)) {
                    $transaksi_terakhir[$t['id_member']] = $t['max_tgl'];
                }
            }
            
            $petugas = [];
            if (!empty($list_id_petugas)) {
                $in_petugas = implode(',', $list_id_petugas);
                $qp = mysql_query("SELECT id_petugas, nama, nama_spbu FROM data_petugas WHERE id_petugas IN ($in_petugas)");
                while($p = mysql_fetch_array($qp)) {
                    $petugas[$p['id_petugas']] = $p;
                }
            }

            $jenis_bbm = [];
            $qj = mysql_query("SELECT jenis_transaksi, harga FROM data_jenis_transaksi");
            if ($qj) {
                while($j = mysql_fetch_array($qj)) {
                    $jenis_bbm[$j['jenis_transaksi']] = (float)$j['harga'];
                }
            }
            
            $harga_historis = [];
            if (!empty($list_id_transaksi)) {
                $in_trans = implode(',', $list_id_transaksi);
                $qh = mysql_query("SELECT id_transaksi, harga FROM data_harga_transaksi WHERE id_transaksi IN ($in_trans)");
                if ($qh) {
                    while($h = mysql_fetch_array($qh)) {
                        $harga_historis[$h['id_transaksi']] = (float)$h['harga'];
                    }
                }
            }
            // ===================================================================

            $total_sales_cetak = 0;
            $total_volume_cetak = 0;

            // Initialize structured data for summaries (overall + specific SPBUs)
            $spbus_to_track = ['24.373.27', '24.373.32'];
            $spbu_data = [];
            $spbu_codes_all = array_merge(['overall'], $spbus_to_track);
            foreach ($spbu_codes_all as $code) {
                $spbu_data[$code] = [
                    'summary_transaksi' => [],
                    'summary_rupiah' => [],
                    'summary_liter' => [],
                    'member_categories' => [],
                    'summary_transaction_category' => []
                ];
            }

            foreach ($rows as $data) {
                $id_member = $data['id_member'];
                $id_petugas = $data['id_petugas'];
                
                $nama_member = isset($members[$id_member]['nama']) ? $members[$id_member]['nama'] : '-';
                $tgl_daftar = isset($members[$id_member]['tanggal_terdaftar']) ? $members[$id_member]['tanggal_terdaftar'] : '';
                $max_tanggal = isset($transaksi_terakhir[$id_member]) ? $transaksi_terakhir[$id_member] : '-';
                
                $nama_petugas = isset($petugas[$id_petugas]['nama']) ? $petugas[$id_petugas]['nama'] : '-';
                $spbu_petugas = isset($petugas[$id_petugas]['nama_spbu']) ? $petugas[$id_petugas]['nama_spbu'] : '-';
            
                // Gunakan harga historis jika ada, jika tidak fallback ke jenis_bbm master
                $id_trx = $data['id_transaksi'];
                $harga_bbm = isset($harga_historis[$id_trx]) && $harga_historis[$id_trx] > 0 
                                ? $harga_historis[$id_trx] 
                                : (isset($jenis_bbm[$data['id_jenis_transaksi']]) ? $jenis_bbm[$data['id_jenis_transaksi']] : 0);
                                
                $jumlah_trx = (float)$data['jumlah'];

                if ($data['kategori_jumlah'] == 'rupiah') {
                    $total_sales_cetak += $jumlah_trx;
                }

                if ($harga_bbm > 0 && $data['kategori_jumlah'] == 'liter') {
                    $total_volume_cetak += $jumlah_trx;
                } else if ($harga_bbm > 0 && $data['kategori_jumlah'] == 'rupiah') {
                    $total_volume_cetak += ($jumlah_trx / $harga_bbm);
                }

                // --- Untuk Summary Tabel Bawah ---
                $spbu_code = explode(' ', $spbu_petugas)[0];
                $target_keys = ['overall'];
                if (in_array($spbu_code, $spbus_to_track)) {
                    $target_keys[] = $spbu_code;
                }

                $jenis = !empty($data['id_jenis_transaksi']) ? $data['id_jenis_transaksi'] : 'Lainnya';
                $cat = !empty($data['id_kategori_member']) ? $data['id_kategori_member'] : 'Lainnya';
                $cat_lower = strtolower($cat);
                if (strpos($cat_lower, 'truck') !== false || strpos($cat_lower, 'niaga') !== false) {
                    $cat = 'Truck atau niaga';
                }

                foreach ($target_keys as $key) {
                    if (!isset($spbu_data[$key]['summary_transaksi'][$jenis])) $spbu_data[$key]['summary_transaksi'][$jenis] = 0;
                    if (!isset($spbu_data[$key]['summary_rupiah'][$jenis])) $spbu_data[$key]['summary_rupiah'][$jenis] = 0;
                    if (!isset($spbu_data[$key]['summary_liter'][$jenis])) $spbu_data[$key]['summary_liter'][$jenis] = 0;

                    $spbu_data[$key]['summary_transaksi'][$jenis]++;
                    if ($data['kategori_jumlah'] == 'rupiah') {
                        $spbu_data[$key]['summary_rupiah'][$jenis] += $jumlah_trx;
                    }
                    if ($harga_bbm > 0 && $data['kategori_jumlah'] == 'liter') {
                        $spbu_data[$key]['summary_liter'][$jenis] += $jumlah_trx;
                    } else if ($harga_bbm > 0 && $data['kategori_jumlah'] == 'rupiah') {
                        $spbu_data[$key]['summary_liter'][$jenis] += ($jumlah_trx / $harga_bbm);
                    }

                    $spbu_data[$key]['summary_transaction_category'][$cat] = (isset($spbu_data[$key]['summary_transaction_category'][$cat]) ? $spbu_data[$key]['summary_transaction_category'][$cat] : 0) + 1;
                    if (!empty($id_member)) {
                        $spbu_data[$key]['member_categories'][$id_member] = $cat;
                    }
                }
            ?>
                <tr class="event2">

                    <td align="center" width="50"><?php $no = (($no + 1));
                                                    echo $no; ?></td>
                    <td align="center"><?php echo $nama_member; ?></td>
                    <td align="center" style="color:red"><?php echo ($data['point']); ?> point</td>
                    <td align="center" style="color:blue"><?php
                                                            if ($data['kategori_jumlah'] == "rupiah") {
                                                                echo rupiah($data['jumlah']);
                                                            } else {
                                                                echo ($data['jumlah']);
                                                                echo " " . ($data['kategori_jumlah']);
                                                            }

                                                            ?> </td>
                    <td align="center"><?php echo $data['id_kategori_member'] ?></td>
                    <td align="center"><?php echo $data['id_jenis_transaksi'] ?></td>

                    <td align="center"><?php echo (($data['tanggal'])); ?></td>
                    <td align="center"><?php echo $max_tanggal; ?></td>
                    <td align="center"><?php echo ($data['jam']); ?></td>

                    <td align="center"><?php echo $nama_petugas; ?></td>
                    <td align="center"><?php echo explode(' ', $spbu_petugas)[0]; ?></td>

                    <td align="center"><?php
                                        if ($tgl_daftar) {
                                            $endDate = date('Y-m-d', strtotime('+1 month', strtotime($tgl_daftar)));
                                            if (date('Y-m-d') >= $endDate) {
                                                echo "Member Lama";
                                            } else {
                                                echo "Member Baru";
                                            }
                                        } else {
                                            echo "-";
                                        }
                                        ?></td>


                </tr>
            <?php } ?>
                <tr class="event2" style="background-color: #dbeafe; font-weight: bold;">
                    <td colspan="3" align="right">TOTAL KESELURUHAN &nbsp;</td>
                    <td align="center" style="color:blue;">
                        Sales: <?php echo rupiah($total_sales_cetak); ?><br>
                        Volume: <?php echo round($total_volume_cetak, 2); ?> L
                    </td>
                    <td colspan="8"></td>
                </tr>
        </tbody>
    </table>
    <!-- BODY -->

    <?php
    // --- Hitung Active & Inactive Members serta Category Counts untuk setiap SPBU ---
    $ref_date = date('Y-m-d');
    $active_threshold_date = date('Y-m-d', strtotime('-3 months', strtotime($ref_date)));

    foreach ($spbu_data as $key => $sdata) {
        $summary_member_category = [];
        foreach ($sdata['member_categories'] as $m_id => $m_cat) {
            $summary_member_category[$m_cat] = (isset($summary_member_category[$m_cat]) ? $summary_member_category[$m_cat] : 0) + 1;
        }
        $spbu_data[$key]['summary_member_category'] = $summary_member_category;

        $count_active = 0;
        $count_inactive = 0;
        foreach ($sdata['member_categories'] as $m_id => $m_cat) {
            $last_trx = isset($transaksi_terakhir[$m_id]) ? $transaksi_terakhir[$m_id] : '';
            if (!empty($last_trx) && $last_trx >= $active_threshold_date) {
                $count_active++;
            } else {
                $count_inactive++;
            }
        }
        $spbu_data[$key]['count_active'] = $count_active;
        $spbu_data[$key]['count_inactive'] = $count_inactive;
    }
    ?>

    <?php
    $selected_spbu = '';
    if (isset($_GET['spbu']) && !empty($_GET['spbu'])) {
        $selected_spbu = explode(' ', $_GET['spbu'])[0];
    }

    $blocks_to_display = [];
    if (empty($selected_spbu)) {
        // If overall, display Keseluruhan, SPBU 24.373.27, and SPBU 24.373.32
        $blocks_to_display[] = ['key' => 'overall', 'title' => 'KESELURUHAN'];
        $blocks_to_display[] = ['key' => '24.373.27', 'title' => 'SPBU 24.373.27'];
        $blocks_to_display[] = ['key' => '24.373.32', 'title' => 'SPBU 24.373.32'];
    } else {
        // If filtered, display only that specific SPBU
        if ($selected_spbu == '24.373.27') {
            $blocks_to_display[] = ['key' => '24.373.27', 'title' => 'SPBU 24.373.27'];
        } else if ($selected_spbu == '24.373.32') {
            $blocks_to_display[] = ['key' => '24.373.32', 'title' => 'SPBU 24.373.32'];
        } else {
            // Fallback for other SPBUs (if any in the future)
            $blocks_to_display[] = ['key' => $selected_spbu, 'title' => 'SPBU ' . $selected_spbu];
        }
    }

    foreach ($blocks_to_display as $block) {
        $key = $block['key'];
        $sdata = $spbu_data[$key];
        
        // Define lists for order
        $bbm_list = ['PERTAMAX', 'DEXLITE', 'TURBO'];
        foreach (array_keys($sdata['summary_transaksi']) as $key_bbm) {
            if (!in_array($key_bbm, $bbm_list) && $key_bbm !== 'Lainnya') {
                $bbm_list[] = $key_bbm;
            }
        }
        if (isset($sdata['summary_transaksi']['Lainnya'])) {
            $bbm_list[] = 'Lainnya';
        }

        $cat_list = ['Motor', 'Mobil', 'Drigen', 'Truck atau niaga'];
        foreach (array_keys($sdata['summary_member_category']) as $key_cat) {
            if (!in_array($key_cat, $cat_list) && $key_cat !== 'Lainnya') {
                $cat_list[] = $key_cat;
            }
        }
        if (isset($sdata['summary_member_category']['Lainnya'])) {
            $cat_list[] = 'Lainnya';
        }

        $trx_cat_list = ['Motor', 'Mobil', 'Drigen', 'Truck atau niaga'];
        foreach (array_keys($sdata['summary_transaction_category']) as $key_cat) {
            if (!in_array($key_cat, $trx_cat_list) && $key_cat !== 'Lainnya') {
                $trx_cat_list[] = $key_cat;
            }
        }
        if (isset($sdata['summary_transaction_category']['Lainnya'])) {
            $trx_cat_list[] = 'Lainnya';
        }
        
        // Calculate totals for table headers / checks
        $total_members = 0;
        foreach ($cat_list as $cat) {
            $total_members += isset($sdata['summary_member_category'][$cat]) ? $sdata['summary_member_category'][$cat] : 0;
        }

        $total_trx_category = 0;
        foreach ($trx_cat_list as $cat) {
            $total_trx_category += isset($sdata['summary_transaction_category'][$cat]) ? $sdata['summary_transaction_category'][$cat] : 0;
        }
        ?>
        <h3 style="font-family: calibri, Arial, Helvetica, sans-serif; text-align: left; margin-bottom: 5px; margin-top: 25px; border-bottom: 2px solid #333; padding-bottom: 5px; text-transform: uppercase;">
            Summary <?php echo $block['title']; ?>
        </h3>
        
        <table width="100%" cellpadding="10" cellspacing="0" style="font-size: 13px; font-family: calibri, Arial, Helvetica, sans-serif;">
            <tr>
                <td valign="top" width="33%">
                    <table class="tabel2" width="100%" border="1" style="border-collapse: collapse;">
                        <thead>
                            <tr><th colspan="2" style="background-color: #fce7f3; padding: 5px;">Transaksi By BBM</th></tr>
                        </thead>
                        <tbody>
                            <?php 
                            $total_trx = 0;
                            foreach ($bbm_list as $jenis) { 
                                $jml = isset($sdata['summary_transaksi'][$jenis]) ? $sdata['summary_transaksi'][$jenis] : 0;
                                $total_trx += $jml;
                            ?>
                            <tr>
                                <td style="padding: 3px;"><?php echo $jenis; ?></td>
                                <td align="right" style="padding: 3px;"><?php echo number_format($jml, 0, ',', '.'); ?></td>
                            </tr>
                            <?php } ?>
                            <tr style="font-weight: bold; background-color: #f9fafb;">
                                <td style="padding: 3px;">TOTAL</td>
                                <td align="right" style="padding: 3px;"><?php echo number_format($total_trx, 0, ',', '.'); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td valign="top" width="33%">
                    <table class="tabel2" width="100%" border="1" style="border-collapse: collapse;">
                        <thead>
                            <tr><th colspan="2" style="background-color: #dbeafe; padding: 5px;">Sales SMC (Rupiah)</th></tr>
                        </thead>
                        <tbody>
                            <?php 
                            $total_rp = 0;
                            foreach ($bbm_list as $jenis) { 
                                $jml = isset($sdata['summary_rupiah'][$jenis]) ? $sdata['summary_rupiah'][$jenis] : 0;
                                $total_rp += $jml;
                            ?>
                            <tr>
                                <td style="padding: 3px;"><?php echo $jenis; ?></td>
                                <td align="right" style="padding: 3px;"><?php rupiah($jml); ?></td>
                            </tr>
                            <?php } ?>
                            <tr style="font-weight: bold; background-color: #f9fafb;">
                                <td style="padding: 3px;">TOTAL</td>
                                <td align="right" style="padding: 3px;"><?php rupiah($total_rp); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td valign="top" width="33%">
                    <table class="tabel2" width="100%" border="1" style="border-collapse: collapse;">
                        <thead>
                            <tr><th colspan="2" style="background-color: #fef3c7; padding: 5px;">Volume SMC (Liter)</th></tr>
                        </thead>
                        <tbody>
                            <?php 
                            $total_lit = 0;
                            foreach ($bbm_list as $jenis) { 
                                $jml = isset($sdata['summary_liter'][$jenis]) ? $sdata['summary_liter'][$jenis] : 0;
                                $total_lit += $jml;
                            ?>
                            <tr>
                                <td style="padding: 3px;"><?php echo $jenis; ?></td>
                                <td align="right" style="padding: 3px;"><?php echo number_format($jml, 2, ',', '.'); ?> L</td>
                            </tr>
                            <?php } ?>
                            <tr style="font-weight: bold; background-color: #f9fafb;">
                                <td style="padding: 3px;">TOTAL</td>
                                <td align="right" style="padding: 3px;"><?php echo number_format($total_lit, 2, ',', '.'); ?> L</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
        <br>
        <table width="100%" cellpadding="10" cellspacing="0" style="font-size: 13px; font-family: calibri, Arial, Helvetica, sans-serif;">
            <tr>
                <td valign="top" width="33%">
                    <table class="tabel2" width="100%" border="1" style="border-collapse: collapse;">
                        <thead>
                            <tr><th colspan="2" style="background-color: #ccfbf1; padding: 5px;">Member Category (<?php echo $total_members; ?>)</th></tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cat_list as $cat) { 
                                $jml = isset($sdata['summary_member_category'][$cat]) ? $sdata['summary_member_category'][$cat] : 0;
                            ?>
                            <tr>
                                <td style="padding: 3px;"><?php echo $cat; ?></td>
                                <td align="right" style="padding: 3px;"><?php echo number_format($jml, 0, ',', '.'); ?></td>
                            </tr>
                            <?php } ?>
                            <tr style="font-weight: bold; background-color: #f9fafb;">
                                <td style="padding: 3px;">TOTAL</td>
                                <td align="right" style="padding: 3px;"><?php echo number_format($total_members, 0, ',', '.'); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td valign="top" width="33%">
                    <table class="tabel2" width="100%" border="1" style="border-collapse: collapse;">
                        <thead>
                            <tr><th colspan="2" style="background-color: #e0f2fe; padding: 5px;">Transaction by Category (<?php echo $total_trx_category; ?>)</th></tr>
                        </thead>
                        <tbody>
                            <?php foreach ($trx_cat_list as $cat) { 
                                $jml = isset($sdata['summary_transaction_category'][$cat]) ? $sdata['summary_transaction_category'][$cat] : 0;
                            ?>
                            <tr>
                                <td style="padding: 3px;"><?php echo $cat; ?></td>
                                <td align="right" style="padding: 3px;"><?php echo number_format($jml, 0, ',', '.'); ?></td>
                            </tr>
                            <?php } ?>
                            <tr style="font-weight: bold; background-color: #f9fafb;">
                                <td style="padding: 3px;">TOTAL</td>
                                <td align="right" style="padding: 3px;"><?php echo number_format($total_trx_category, 0, ',', '.'); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td valign="top" width="33%">
                    <table class="tabel2" width="100%" border="1" style="border-collapse: collapse;">
                        <thead>
                            <tr><th colspan="2" style="background-color: #f3e8ff; padding: 5px;">Active Members (<?php echo ($sdata['count_active'] + $sdata['count_inactive']); ?>)</th></tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="padding: 3px;">Aktif</td>
                                <td align="right" style="padding: 3px;"><?php echo number_format($sdata['count_active'], 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <td style="padding: 3px;">Tidak Aktif</td>
                                <td align="right" style="padding: 3px;"><?php echo number_format($sdata['count_inactive'], 0, ',', '.'); ?></td>
                            </tr>
                            <tr style="font-weight: bold; background-color: #f9fafb;">
                                <td style="padding: 3px;">TOTAL</td>
                                <td align="right" style="padding: 3px;"><?php echo number_format($sdata['count_active'] + $sdata['count_inactive'], 0, ',', '.'); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
        <br>
        <?php
    }
    ?>

    <!-- FOOTER -->
    <p class="auto-style3"><?php echo $formatwaktu; ?>
    </p>
    <p class="auto-style3"><?php echo $ttd; ?></p>
    <p class="auto-style3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </p>
    <p class="auto-style3"><?php echo $siapa; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</p>
    <p class="auto-style3"></p>

<?php } ?>