<?php
include "/Applications/MAMP/htdocs/GITHUB/Custom/CBS/cbs-indo-membercard/admin/include/koneksi/koneksi.php";

$months = [
    1 => ['start' => '2026-01-01', 'end' => '2026-01-31', 'name' => 'Bulan 1 (Januari 2026)'],
    2 => ['start' => '2026-02-01', 'end' => '2026-02-28', 'name' => 'Bulan 2 (Februari 2026)'],
    3 => ['start' => '2026-03-01', 'end' => '2026-03-31', 'name' => 'Bulan 3 (Maret 2026)'],
    4 => ['start' => '2026-04-01', 'end' => '2026-04-30', 'name' => 'Bulan 4 (April 2026)'],
    5 => ['start' => '2026-05-01', 'end' => '2026-05-31', 'name' => 'Bulan 5 (Mei 2026)'],
    6 => ['start' => '2026-06-01', 'end' => '2026-06-30', 'name' => 'Bulan 6 (Juni 2026)'],
];

// Helper function to get Dashboard Stats
function getDashboardStats($spbu, $start, $end) {
    $spbu_prefix = $spbu;
    $where_spbu_only = "WHERE 1=1";
    if ($spbu != '') {
        $where_spbu_only .= " AND spbu LIKE '$spbu_prefix%'";
    } else {
        $where_spbu_only .= " AND (spbu LIKE '24.373.27%' OR spbu LIKE '24.373.32%')";
    }
    
    // Total member
    $total_member = (int) mysql_result(mysql_query("SELECT COUNT(*) FROM data_member $where_spbu_only"), 0);

    // New member
    $new_member = (int) mysql_result(mysql_query("SELECT COUNT(*) FROM data_member $where_spbu_only AND tanggal_terdaftar BETWEEN '$start' AND '$end 23:59:59'"), 0);

    // Transactions loop to calculate unique active members
    $where_q_trans = "WHERE 1=1";
    if (!empty($start) && !empty($end)) {
        $where_q_trans .= " AND t.tanggal BETWEEN '$start' AND '$end 23:59:59'";
    }
    if ($spbu != '') {
        $where_q_trans .= " AND p.nama_spbu LIKE '$spbu_prefix%'";
    } else {
        $where_q_trans .= " AND (p.nama_spbu LIKE '24.373.27%' OR p.nama_spbu LIKE '24.373.32%')";
    }

    $q_trans_members = mysql_query("
        SELECT t.id_member, t.id_kategori_member, m.spbu AS member_spbu, p.nama_spbu AS trans_spbu, m.id_member AS member_exists
        FROM data_transaksi t
        LEFT JOIN data_petugas p ON t.id_petugas = p.id_petugas
        LEFT JOIN data_member m ON t.id_member = m.id_member
        $where_q_trans
    ");

    $member_categories = [];
    $jumlah_kategori = ['Motor' => 0, 'Mobil' => 0, 'Drigen' => 0, 'Truck/Niaga' => 0];

    if ($q_trans_members) {
        while ($row = mysql_fetch_assoc($q_trans_members)) {
            $id_member = $row['id_member'];
            $cat = !empty($row['id_kategori_member']) ? $row['id_kategori_member'] : 'Lainnya';
            $cat_lower = strtolower($cat);
            
            // Transaction category counts
            if ($spbu == '' || (isset($row['trans_spbu']) && strpos($row['trans_spbu'], $spbu_prefix) === 0)) {
                if (strpos($cat_lower, 'motor') !== false) {
                    $jumlah_kategori['Motor']++;
                } elseif (strpos($cat_lower, 'mobil') !== false) {
                    $jumlah_kategori['Mobil']++;
                } elseif (strpos($cat_lower, 'drigen') !== false || strpos($cat_lower, 'jerigen') !== false) {
                    $jumlah_kategori['Drigen']++;
                } elseif (strpos($cat_lower, 'truck') !== false || strpos($cat_lower, 'niaga') !== false) {
                    $jumlah_kategori['Truck/Niaga']++;
                }
            }

            // Track unique active member categories
            if (!empty($id_member) && !empty($row['member_exists'])) {
                $t_spbu_code = isset($row['trans_spbu']) ? explode(' ', $row['trans_spbu'])[0] : '';
                $m_spbu_code = isset($row['member_spbu']) ? explode(' ', $row['member_spbu'])[0] : '';
                if ($t_spbu_code === $m_spbu_code && !empty($t_spbu_code)) {
                    if ($spbu == '' || $m_spbu_code === $spbu_prefix) {
                        $member_categories[$id_member] = $cat;
                    }
                }
            }
        }
    }

    $active_count = count($member_categories);
    $inactive_count = $total_member - $active_count;

    // Member category counts
    $cat_motor = count(array_filter($member_categories, function($c) { return strpos(strtolower($c), 'motor') !== false; }));
    $cat_mobil = count(array_filter($member_categories, function($c) { return strpos(strtolower($c), 'mobil') !== false; }));
    $cat_drigen = count(array_filter($member_categories, function($c) { return (strpos(strtolower($c), 'drigen') !== false || strpos(strtolower($c), 'jerigen') !== false); }));
    $cat_niaga = count(array_filter($member_categories, function($c) { return (strpos(strtolower($c), 'niaga') !== false || strpos(strtolower($c), 'truck') !== false); }));

    // Transaction Summary (Sales, Volume, and Count)
    $where_trans_summary = "WHERE t.tanggal BETWEEN '$start' AND '$end 23:59:59'";
    if ($spbu != '') {
        $where_trans_summary .= " AND p.nama_spbu LIKE '$spbu_prefix%'";
    } else {
        $where_trans_summary .= " AND (p.nama_spbu LIKE '24.373.27%' OR p.nama_spbu LIKE '24.373.32%')";
    }
    
    $q_totals = mysql_query("
        SELECT t.jumlah, t.kategori_jumlah, COALESCE(ht.harga, jt.harga) as harga 
        FROM data_transaksi t
        LEFT JOIN data_petugas p ON t.id_petugas = p.id_petugas
        LEFT JOIN data_jenis_transaksi jt ON t.id_jenis_transaksi = jt.jenis_transaksi
        LEFT JOIN (SELECT id_transaksi, MAX(harga) as harga FROM data_harga_transaksi GROUP BY id_transaksi) ht ON t.id_transaksi = ht.id_transaksi
        $where_trans_summary
    ");

    $trans_count = 0;
    $sales_rupiah = 0;
    $volume_liter = 0;

    if ($q_totals) {
        while ($row = mysql_fetch_array($q_totals)) {
            $jumlah = (float) $row['jumlah'];
            $harga = (float) $row['harga'];
            
            $trans_count++;
            if ($row['kategori_jumlah'] == 'rupiah') {
                $sales_rupiah += $jumlah;
            }
            if ($harga > 0 && $row['kategori_jumlah'] == 'liter') {
                $volume_liter += $jumlah;
            } else if ($harga > 0 && $row['kategori_jumlah'] == 'rupiah') {
                $volume_liter += ($jumlah / $harga);
            }
        }
    }

    return [
        'trans' => $trans_count,
        'sales' => $sales_rupiah,
        'volume' => round($volume_liter, 2),
        'total_member' => $total_member,
        'active_member' => $active_count,
        'inactive_member' => $inactive_count,
        'new_member' => $new_member,
        'cat_motor' => $cat_motor,
        'cat_mobil' => $cat_mobil,
        'cat_drigen' => $cat_drigen,
        'cat_niaga' => $cat_niaga,
        'trx_motor' => $jumlah_kategori['Motor'],
        'trx_mobil' => $jumlah_kategori['Mobil'],
        'trx_drigen' => $jumlah_kategori['Drigen'],
        'trx_niaga' => $jumlah_kategori['Truck/Niaga']
    ];
}

// Helper function to get Print Stats (aligned with cetak.php)
function getPrintStats($spbu, $start, $end) {
    // 1. Transaction Metrics (strictly based on transaction SPBU location)
    $filter_spbu = "";
    if ($spbu != '') {
        $filter_spbu = " AND t.id_petugas IN (SELECT id_petugas FROM data_petugas WHERE nama_spbu LIKE '$spbu%')";
    } else {
        $filter_spbu = " AND t.id_petugas IN (SELECT id_petugas FROM data_petugas WHERE nama_spbu LIKE '24.373.27%' OR nama_spbu LIKE '24.373.32%')";
    }
    
    $q_totals = mysql_query("
        SELECT t.jumlah, t.kategori_jumlah, t.id_kategori_member, COALESCE(ht.harga, jt.harga) as harga 
        FROM data_transaksi t
        LEFT JOIN data_petugas p ON t.id_petugas = p.id_petugas
        LEFT JOIN data_jenis_transaksi jt ON t.id_jenis_transaksi = jt.jenis_transaksi
        LEFT JOIN (SELECT id_transaksi, MAX(harga) as harga FROM data_harga_transaksi GROUP BY id_transaksi) ht ON t.id_transaksi = ht.id_transaksi
        WHERE (t.tanggal BETWEEN '$start' AND '$end 23:59:59') $filter_spbu
    ");
    
    $trans_count = 0;
    $sales_rupiah = 0;
    $volume_liter = 0;
    $trx_kategori = ['Motor' => 0, 'Mobil' => 0, 'Drigen' => 0, 'Truck/Niaga' => 0];
    
    if ($q_totals) {
        while ($row = mysql_fetch_array($q_totals)) {
            $jumlah = (float) $row['jumlah'];
            $harga = (float) $row['harga'];
            $cat = !empty($row['id_kategori_member']) ? $row['id_kategori_member'] : 'Lainnya';
            $cat_lower = strtolower($cat);
            
            $trans_count++;
            if ($row['kategori_jumlah'] == 'rupiah') {
                $sales_rupiah += $jumlah;
            }
            if ($harga > 0 && $row['kategori_jumlah'] == 'liter') {
                $volume_liter += $jumlah;
            } else if ($harga > 0 && $row['kategori_jumlah'] == 'rupiah') {
                $volume_liter += ($jumlah / $harga);
            }
            
            if (strpos($cat_lower, 'motor') !== false) {
                $trx_kategori['Motor']++;
            } elseif (strpos($cat_lower, 'mobil') !== false) {
                $trx_kategori['Mobil']++;
            } elseif (strpos($cat_lower, 'drigen') !== false || strpos($cat_lower, 'jerigen') !== false) {
                $trx_kategori['Drigen']++;
            } elseif (strpos($cat_lower, 'truck') !== false || strpos($cat_lower, 'niaga') !== false) {
                $trx_kategori['Truck/Niaga']++;
            }
        }
    }
    
    // 2. Active Member Metrics (based on member's registered SPBU matching transaction SPBU)
    $q_active = mysql_query("
        SELECT DISTINCT t.id_member, m.spbu AS member_spbu, t.id_kategori_member, p.nama_spbu AS trans_spbu
        FROM data_transaksi t
        INNER JOIN data_member m ON t.id_member = m.id_member
        LEFT JOIN data_petugas p ON t.id_petugas = p.id_petugas
        WHERE t.tanggal BETWEEN '$start' AND '$end 23:59:59'
    ");
    
    $active_members = [];
    if ($q_active) {
        while ($row = mysql_fetch_assoc($q_active)) {
            $id_member = $row['id_member'];
            $m_spbu = $row['member_spbu'];
            $t_spbu = $row['trans_spbu'];
            $cat = !empty($row['id_kategori_member']) ? $row['id_kategori_member'] : 'Lainnya';
            $cat_lower = strtolower($cat);
            if (strpos($cat_lower, 'truck') !== false || strpos($cat_lower, 'niaga') !== false) {
                $cat = 'Truck atau niaga';
            } elseif (strpos($cat_lower, 'drigen') !== false || strpos($cat_lower, 'jerigen') !== false) {
                $cat = 'Drigen';
            } elseif (strpos($cat_lower, 'motor') !== false) {
                $cat = 'Motor';
            } elseif (strpos($cat_lower, 'mobil') !== false) {
                $cat = 'Mobil';
            }
            
            $m_spbu_code = explode(' ', $m_spbu)[0];
            $t_spbu_code = explode(' ', $t_spbu)[0];
            
            if ($m_spbu_code === $t_spbu_code && !empty($m_spbu_code)) {
                if ($spbu == '') {
                    if (in_array($m_spbu_code, ['24.373.27', '24.373.32'])) {
                        $active_members[$id_member] = $cat;
                    }
                } else {
                    if ($m_spbu_code === $spbu) {
                        $active_members[$id_member] = $cat;
                    }
                }
            }
        }
    }
    
    $active_count = count($active_members);
    
    // 3. Total Members registered at this SPBU (or valid SPBUs)
    if ($spbu == '') {
        $total_member = (int) mysql_result(mysql_query("SELECT COUNT(*) FROM data_member WHERE (spbu LIKE '24.373.27%' OR spbu LIKE '24.373.32%')"), 0);
    } else {
        $total_member = (int) mysql_result(mysql_query("SELECT COUNT(*) FROM data_member WHERE spbu LIKE '$spbu%'"), 0);
    }
    
    $inactive_count = $total_member - $active_count;
    
    // Categories count
    $cat_motor = count(array_filter($active_members, function($c) { return strpos(strtolower($c), 'motor') !== false; }));
    $cat_mobil = count(array_filter($active_members, function($c) { return strpos(strtolower($c), 'mobil') !== false; }));
    $cat_drigen = count(array_filter($active_members, function($c) { return (strpos(strtolower($c), 'drigen') !== false || strpos(strtolower($c), 'jerigen') !== false); }));
    $cat_niaga = count(array_filter($active_members, function($c) { return (strpos(strtolower($c), 'niaga') !== false || strpos(strtolower($c), 'truck') !== false); }));
    
    // New members registered in period
    if ($spbu == '') {
        $new_member = (int) mysql_result(mysql_query("SELECT COUNT(*) FROM data_member WHERE (spbu LIKE '24.373.27%' OR spbu LIKE '24.373.32%') AND tanggal_terdaftar BETWEEN '$start' AND '$end 23:59:59'"), 0);
    } else {
        $new_member = (int) mysql_result(mysql_query("SELECT COUNT(*) FROM data_member WHERE spbu LIKE '$spbu%' AND tanggal_terdaftar BETWEEN '$start' AND '$end 23:59:59'"), 0);
    }

    return [
        'trans' => $trans_count,
        'sales' => $sales_rupiah,
        'volume' => round($volume_liter, 2),
        'total_member' => $total_member,
        'active_member' => $active_count,
        'inactive_member' => $inactive_count,
        'new_member' => $new_member,
        'cat_motor' => $cat_motor,
        'cat_mobil' => $cat_mobil,
        'cat_drigen' => $cat_drigen,
        'cat_niaga' => $cat_niaga,
        'trx_motor' => $trx_kategori['Motor'],
        'trx_mobil' => $trx_kategori['Mobil'],
        'trx_drigen' => $trx_kategori['Drigen'],
        'trx_niaga' => $trx_kategori['Truck/Niaga']
    ];
}

// Compare function that formats mismatch in red
function compare($db_val, $print_val, $format = 'number') {
    if ($format == 'rupiah') {
        $db_disp = "Rp " . number_format($db_val, 0, ',', '.');
        $print_disp = "Rp " . number_format($print_val, 0, ',', '.');
        $equal = ($db_val == $print_val);
    } elseif ($format == 'volume') {
        $db_disp = number_format($db_val, 2, ',', '.') . " L";
        $print_disp = number_format($print_val, 2, ',', '.') . " L";
        $equal = (abs($db_val - $print_val) < 0.05);
    } else {
        $db_disp = number_format($db_val, 0, ',', '.');
        $print_disp = number_format($print_val, 0, ',', '.');
        $equal = ($db_val == $print_val);
    }

    if ($equal) {
        return "$db_disp | ✅";
    } else {
        return "<span style=\"color:red; font-weight:bold;\">MISMATCH: DB ($db_disp) vs Print ($print_disp)</span> | ❌";
    }
}

$output_md = "# Laporan Hasil Perbandingan Dashboard vs Cetak Transaksi (2026)\n\n";
$output_md .= "Dokumen ini membandingkan hitungan antara **Dashboard** (`graphic_test.php`/`get_dashboard_data.php`) dengan **Cetak Laporan** (`cetak.php`) untuk bulan 1 s/d 6 tahun 2026. Setiap ketidakcocokan akan disorot dengan warna **merah**.\n\n";

$spbus = [
    '' => 'KESELURUHAN (ALL SPBU)',
    '24.373.27' => 'SPBU 24.373.27 (SAROLANGUN)',
    '24.373.32' => 'SPBU 24.373.32 (SINGKUT)'
];

foreach ($months as $m_num => $m_info) {
    $start = $m_info['start'];
    $end = $m_info['end'];
    
    $output_md .= "## " . $m_info['name'] . " (Periode: " . date('d/m/Y', strtotime($start)) . " s/d " . date('d/m/Y', strtotime($end)) . ")\n\n";
    
    foreach ($spbus as $spbu_code => $spbu_name) {
        $output_md .= "### " . $spbu_name . "\n\n";
        
        $db = getDashboardStats($spbu_code, $start, $end);
        $pr = getPrintStats($spbu_code, $start, $end);
        
        $output_md .= "| Item / Metric | Nilai (Dashboard vs Cetak) | Status |\n";
        $output_md .= "| --- | --- | --- |\n";
        
        // 1. Transaction Summary
        $output_md .= "| Jumlah Transaksi | " . compare($db['trans'], $pr['trans']) . "\n";
        $output_md .= "| Sales Rupiah | " . compare($db['sales'], $pr['sales'], 'rupiah') . "\n";
        $output_md .= "| Volume Liter | " . compare($db['volume'], $pr['volume'], 'volume') . "\n";
        
        // 2. Member Summary
        $output_md .= "| Total Member | " . compare($db['total_member'], $pr['total_member']) . "\n";
        $output_md .= "| Active Member (Aktif) | " . compare($db['active_member'], $pr['active_member']) . "\n";
        $output_md .= "| Inactive Member (Tidak Aktif) | " . compare($db['inactive_member'], $pr['inactive_member']) . "\n";
        $output_md .= "| New Member (Member Baru) | " . compare($db['new_member'], $pr['new_member']) . "\n";
        
        // 3. Member Category
        $output_md .= "| Member Cat: Motor | " . compare($db['cat_motor'], $pr['cat_motor']) . "\n";
        $output_md .= "| Member Cat: Mobil | " . compare($db['cat_mobil'], $pr['cat_mobil']) . "\n";
        $output_md .= "| Member Cat: Drigen | " . compare($db['cat_drigen'], $pr['cat_drigen']) . "\n";
        $output_md .= "| Member Cat: Truck/Niaga | " . compare($db['cat_niaga'], $pr['cat_niaga']) . "\n";
        
        // 4. Transaction by Category
        $output_md .= "| Trx Cat: Motor | " . compare($db['trx_motor'], $pr['trx_motor']) . "\n";
        $output_md .= "| Trx Cat: Mobil | " . compare($db['trx_mobil'], $pr['trx_mobil']) . "\n";
        $output_md .= "| Trx Cat: Drigen | " . compare($db['trx_drigen'], $pr['trx_drigen']) . "\n";
        $output_md .= "| Trx Cat: Truck/Niaga | " . compare($db['trx_niaga'], $pr['trx_niaga']) . "\n";
        
        $output_md .= "\n";
    }
    
    $output_md .= "---\n\n";
}

file_put_contents("/Applications/MAMP/htdocs/GITHUB/Custom/CBS/cbs-indo-membercard/admin/app/page/home/cek_hitungan_dashboard_dan_cetak.md", $output_md);
echo "Successfully generated cek_hitungan_dashboard_dan_cetak.md\n";
?>
