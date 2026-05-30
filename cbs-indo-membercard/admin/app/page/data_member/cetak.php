<?php
// Include necessary files and configurations
if (isset($_GET['export'])) {
    // Set headers for Excel file download
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="Laporan_Data_Member.xls"');
}
?>

<!-- Existing HTML and PHP code for displaying the table -->
<?php
if (isset($_GET['input'])) {
    echo "<h3> Cetak Laporan ";
    tabelnomin();
    echo "</h3>";
?>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">
<?php
    action_cetak("data_member");
} else {
    function location()
    {
        return "cetak";
    }
    include '../../../include/all_include.php';
    proses_action_cetak("data_member");
?>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">

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
                        $tabelnya = "data_member";
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
            <th class="th_border cell">No</th>
            <th class="th_border cell">Nama Member</th>
            <th class="th_border cell">Point</th>
            <th class="th_border cell">Nominal&nbsp;Transaksi Terakhir</th>
            <th class="th_border cell">Jenis Kendaraan</th>
            <th class="th_border cell">Alamat</th>
            <th class="th_border cell">No telepon</th>
            <th class="th_border cell">Jenis kelamin</th>
            <th class="th_border cell">Tanggal terdaftar</th>
            <th class="th_border cell">Kode rfid</th>
            <th class="th_border cell">Tanggal lahir</th>
            <th class="th_border cell">Agama</th>
            <th class="th_border cell">Pekerjaan</th>
            <th class="th_border cell">Nama SPBU</th>
            <th class="th_border cell">Informasi Member</th>
            <th class="th_border cell">Tanggal&nbsp;Transaksi Terakhir</th>
            <th class="th_border cell">Status</th>
        </tr>

        <?php
        $no = 0;

        // ---------------------------------------------------------------
        // 1. BANGUN WHERE SESUAI MODE YANG DIPAKAI (sama persis seperti lama)
        // ---------------------------------------------------------------
        $where = "1=1"; // default: tampilkan semua member

        if (isset($_GET['isi']) && !empty($_GET['isi'])) {
            // MODE PENCARIAN
            $Berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
            $isi         = mysql_real_escape_string($_GET['isi']);
            $where = "$Berdasarkan LIKE '%$isi%'";
            echo '<center>Cetak berdasarkan <b>' . $Berdasarkan . '</b> : <b>' . $isi . '</b></center><br>';
        } elseif (isset($_GET['tanggal1']) && !empty($_GET['tanggal1'])) {
            // MODE PERIODE
            $tanggal1 = mysql_real_escape_string($_GET['tanggal1']);
            $tanggal2 = mysql_real_escape_string($_GET['tanggal2']);
            $Berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
            $where = "($Berdasarkan BETWEEN '$tanggal1' AND '$tanggal2 23:59:59')";
            
            $spbu_info = "";
            if (isset($_GET['spbu']) && !empty($_GET['spbu'])) {
                $spbu_selected = mysql_real_escape_string($_GET['spbu']);
                if (preg_match('/^([\d\.]+)/', $spbu_selected, $matches)) {
                    $spbu_selected = $matches[1];
                }
                $where .= " AND spbu LIKE '$spbu_selected%'";
                $spbu_info = ' | SPBU : <b>' . $spbu_selected . '</b>';
            }
            echo '<center>Cetak Berdasarkan <b>' . $Berdasarkan . '</b> Dari Tanggal <b>' . format_indo($tanggal1) . '</b> s/d <b>' . format_indo($tanggal2) . '</b>' . $spbu_info . '</center><br>';
        } else {
            // MODE SPBU ATAU KESELURUHAN
            if (isset($_GET['spbu']) && !empty($_GET['spbu'])) {
                $spbu = mysql_real_escape_string($_GET['spbu']);
                if (preg_match('/^([\d\.]+)/', $spbu, $matches)) {
                    $spbu = $matches[1];
                }
                $where = "spbu LIKE '$spbu%'";
            }
            // Tanpa filter spbu: where tetap "1=1" → tampilkan semua member
        }

        // ---------------------------------------------------------------
        // 2. AMBIL SEMUA MEMBER SESUAI WHERE DI ATAS
        // ---------------------------------------------------------------
        $query_member = "SELECT * FROM data_member WHERE $where ORDER BY id_member ASC";
        $proses = mysql_query($query_member);

        // ---------------------------------------------------------------
        // 3. AMBIL TRANSAKSI TERAKHIR SEKALIGUS (hanya 1 query tambahan!)
        // ---------------------------------------------------------------
        $list_id_member = '';
        while ($m = mysql_fetch_array($proses)) {
            $list_id_member .= "'" . $m['id_member'] . "',";
        }
        $list_id_member = rtrim($list_id_member, ',');

        $transaksi_terakhir = array();
        $nominal_terakhir = array();
        $kategori_jumlah_terakhir = array();
        if ($list_id_member != '') {
            // Pre-fetch max date
            $q = mysql_query("
                SELECT id_member, MAX(tanggal) AS tanggal_terakhir
                FROM data_transaksi 
                WHERE id_member IN ($list_id_member)
                GROUP BY id_member
            ");
            while ($t = mysql_fetch_array($q)) {
                $transaksi_terakhir[$t['id_member']] = $t['tanggal_terakhir'];
            }

            // Pre-fetch last nominal and currency category
            $q_nom = mysql_query("
                SELECT t.id_member, t.jumlah, t.kategori_jumlah
                FROM data_transaksi t
                WHERE t.id_transaksi IN (
                    SELECT MAX(t2.id_transaksi)
                    FROM data_transaksi t2
                    WHERE t2.id_member IN ($list_id_member)
                    GROUP BY t2.id_member
                )
            ");
            if ($q_nom) {
                while ($t = mysql_fetch_array($q_nom)) {
                    $nominal_terakhir[$t['id_member']] = $t['jumlah'];
                    $kategori_jumlah_terakhir[$t['id_member']] = $t['kategori_jumlah'];
                }
            }
        }

        // Kembalikan pointer hasil member ke awal
        mysql_data_seek($proses, 0);

        // VARIABEL PERHITUNGAN ACTIVE & NEW MEMBER DARI SUBSET
        $active_member_count = 0;
        $new_member_count = 0;

        // Referensi tanggal: gunakan tanggal2 filter jika ada, atau akhir bulan berjalan
        $ref_date_cetak = !empty($tanggal2) ? $tanggal2 : date('Y-m-t');
        $one_month_ago_cetak = date('Y-m-d', strtotime('-1 month', strtotime($ref_date_cetak)));
        $three_months_ago_cetak = date('Y-m-d', strtotime('-3 months', strtotime($ref_date_cetak)));

        // Pre-fetch: member yang AKTIF = punya transaksi dalam window [three_months_ago, ref_date]
        // Logika identik dengan dashboard (bukan cek MAX saja)
        $active_member_ids = [];
        if ($list_id_member != '') {
            $q_aktif = mysql_query("
                SELECT DISTINCT id_member
                FROM data_transaksi
                WHERE id_member IN ($list_id_member)
                AND tanggal >= '$three_months_ago_cetak'
                AND tanggal <= '$ref_date_cetak 23:59:59'
            ");
            while ($ak = mysql_fetch_array($q_aktif)) {
                $active_member_ids[$ak['id_member']] = true;
            }
        }


        // ---------------------------------------------------------------
        // 4. LOOP TAMPILKAN DATA (sekarang sudah cepat!)
        // ---------------------------------------------------------------
        while ($data = mysql_fetch_array($proses)) {
            $no++;
            $id_member = $data['id_member'];
            $last = isset($transaksi_terakhir[$id_member]) ? $transaksi_terakhir[$id_member] : '';
        ?>
            <tr class="event2">
                <td align="center" width="50"><?php echo $no; ?></td>
                <td align="center"><?php echo $data['nama']; ?></td>
                <td align="center"><?php echo number_format($data['point']); ?> Point</td>
                <td align="center">
                    <?php
                    $nom = isset($nominal_terakhir[$id_member]) ? $nominal_terakhir[$id_member] : '';
                    $kat = isset($kategori_jumlah_terakhir[$id_member]) ? $kategori_jumlah_terakhir[$id_member] : '';
                    if ($nom !== '') {
                        if ($kat == 'rupiah') {
                            rupiah($nom);
                        } else {
                            echo number_format($nom);
                        }
                    } else {
                        echo "-";
                    }
                    ?>
                </td>
                <td align="center"><?php echo baca_database("", "kategori_member", "SELECT kategori_member FROM data_kategori_member WHERE id_kategori_member='{$data['id_kategori_member']}'"); ?></td>
                <td align="center"><?php echo $data['alamat']; ?></td>
                <td align="center"><?php echo $data['no_telepon']; ?></td>
                <td align="center"><?php echo $data['jenis_kelamin']; ?></td>
                <td align="center"><?php echo format_indo($data['tanggal_terdaftar']); ?></td>
                <td align="center"><?php echo $data['kode_rfid']; ?></td>
                <td align="center"><?php echo format_indo($data['tanggal_lahir']); ?></td>
                <td align="center"><?php echo $data['agama']; ?></td>
                <td align="center"><?php echo $data['id_pekerjaan']; ?></td>
                <td align="center">
                    <?php
                    $spbu = trim($data['spbu']);
                    if ($spbu !== '') {
                        echo explode(' ', $spbu)[0];
                    } else {
                        echo "SPBU tidak dipilih";
                    }
                    ?>
                </td>

                <!-- Informasi Member -->
                <td align="center">
                    <?php
                    $tgl_daftar = date('Y-m-d', strtotime($data['tanggal_terdaftar']));
                    
                    if ($tgl_daftar >= $one_month_ago_cetak) {
                        echo "Member Baru";
                        $new_member_count++;
                    } else {
                        echo "Member Lama";
                    }
                    ?>
                </td>

                <!-- Tanggal Transaksi Terakhir -->
                <td align="center"><?php echo $last ? format_indo($last) : "-"; ?></td>

                <!-- Status Aktif / Tidak Aktif -->
                <td align="center" style="font-weight:bold;">
                    <?php
                    // Cek dari pre-fetched set: apakah member ini punya transaksi dalam window aktif?
                    if (isset($active_member_ids[$id_member])) {
                        echo "Aktif";
                        $active_member_count++;
                    } else {
                        echo "Tidak Aktif";
                    }
                    ?>
                </td>
            </tr>
        <?php } ?>
    </table>
    <!-- BODY -->

    <br>
    <table cellpadding="5" cellspacing="0" border="1" style="font-size: 14px; border-collapse: collapse; min-width: 300px;">
        <tr>
            <th style="background: #f1f1f1; text-align: left; padding: 8px;">ACTIVE MEMBER</th>
            <td style="font-weight: bold; text-align: right; padding: 8px;"><?php echo number_format($active_member_count); ?></td>
        </tr>
        <tr>
            <th style="background: #f1f1f1; text-align: left; padding: 8px;">NEW MEMBER</th>
            <td style="font-weight: bold; text-align: right; padding: 8px;"><?php echo number_format($new_member_count); ?></td>
        </tr>
    </table>
    <br>

    <!-- FOOTER -->
    <p class="auto-style3"><?php echo $formatwaktu; ?>
    </p>
    <p class="auto-style3"><?php echo $ttd; ?></p>
    <p class="auto-style3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </p>
    <p class="auto-style3"><?php echo $siapa; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</p>
    <p class="auto-style3"></p>

<?php }
?>