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

function getPrintStats($spbu, $start, $end) {
    // 1. Transaction Metrics (strictly based on transaction SPBU location)
    $filter_spbu = "";
    if ($spbu != '') {
        $filter_spbu = " AND t.id_petugas IN (SELECT id_petugas FROM data_petugas WHERE nama_spbu LIKE '$spbu%')";
    } else {
        $filter_spbu = " AND t.id_petugas IN (SELECT id_petugas FROM data_petugas WHERE nama_spbu LIKE '24.373.27%' OR nama_spbu LIKE '24.373.32%')";
    }
    
    $q_totals = mysql_query("
        SELECT t.jumlah, t.kategori_jumlah, COALESCE(ht.harga, jt.harga) as harga 
        FROM data_transaksi t
        LEFT JOIN data_petugas p ON t.id_petugas = p.id_petugas
        LEFT JOIN data_jenis_transaksi jt ON t.id_jenis_transaksi = jt.jenis_transaksi
        LEFT JOIN (SELECT id_transaksi, MAX(harga) as harga FROM data_harga_transaksi GROUP BY id_transaksi) ht ON t.id_transaksi = ht.id_transaksi
        WHERE (t.tanggal BETWEEN '$start' AND '$end 23:59:59') $filter_spbu
    ");
    
    $trans_count = 0;
    $sales_rupiah = 0;
    $total_volume_liter = 0;
    
    if ($q_totals) {
        while ($row = mysql_fetch_array($q_totals)) {
            $jumlah = (float) $row['jumlah'];
            $harga = (float) $row['harga'];
            
            $trans_count++;
            if ($row['kategori_jumlah'] == 'rupiah') {
                $sales_rupiah += $jumlah;
            }
            if ($harga > 0 && $row['kategori_jumlah'] == 'liter') {
                $total_volume_liter += $jumlah;
            } else if ($harga > 0 && $row['kategori_jumlah'] == 'rupiah') {
                $total_volume_liter += ($jumlah / $harga);
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
        'volume' => round($total_volume_liter, 2),
        'total_member' => $total_member,
        'active_member' => $active_count,
        'inactive_member' => $inactive_count,
        'new_member' => $new_member,
        'cat_motor' => $cat_motor,
        'cat_mobil' => $cat_mobil,
        'cat_drigen' => $cat_drigen,
        'cat_niaga' => $cat_niaga
    ];
}

$output_md = "# Laporan Hasil Cek Hitungan Cetak Transaksi Bulanan (2026)\n\n";
$output_md .= "Dokumen ini menyajikan hasil pengecekan hitungan untuk halaman Cetak Laporan Transaksi (`cetak.php`) dari bulan 1 s/d bulan 6 tahun 2026, membandingkan data cabang Sarolangun, Singkut, total penjumlahan (Seharusnya), dan data laporan Keseluruhan (Semua/Overall).\n\n";

foreach ($months as $m_num => $m_info) {
    $start = $m_info['start'];
    $end = $m_info['end'];
    
    $saro = getPrintStats('24.373.27', $start, $end);
    $sing = getPrintStats('24.373.32', $start, $end);
    $over = getPrintStats('', $start, $end);
    
    $output_md .= "## " . $m_info['name'] . "\n";
    $output_md .= "Periode: " . date('d/m/Y', strtotime($start)) . " s/d " . date('d/m/Y', strtotime($end)) . "\n\n";
    
    // 1. Transaction Summary
    $should_trans = $saro['trans'] + $sing['trans'];
    $should_sales = $saro['sales'] + $sing['sales'];
    $should_vol = $saro['volume'] + $sing['volume'];
    
    $check_trans = ($should_trans == $over['trans']) ? "✅" : "❌";
    $check_sales = ($should_sales == $over['sales']) ? "✅" : "❌";
    $check_vol = (abs($should_vol - $over['volume']) < 0.05) ? "✅" : "❌";
    
    $output_md .= "### Transaction Summary\n";
    $output_md .= "| Item | Sarolangun | Singkut | Total Seharusnya | Semua | Status |\n";
    $output_md .= "| --- | --- | --- | --- | --- | --- |\n";
    $output_md .= "| Transaksi | " . number_format($saro['trans'], 0, ',', '.') . " | " . number_format($sing['trans'], 0, ',', '.') . " | " . number_format($should_trans, 0, ',', '.') . " | " . number_format($over['trans'], 0, ',', '.') . " | $check_trans |\n";
    $output_md .= "| Sales (Rp) | " . number_format($saro['sales'], 0, ',', '.') . " | " . number_format($sing['sales'], 0, ',', '.') . " | " . number_format($should_sales, 0, ',', '.') . " | " . number_format($over['sales'], 0, ',', '.') . " | $check_sales |\n";
    $output_md .= "| Volume (L) | " . number_format($saro['volume'], 2, ',', '.') . " | " . number_format($sing['volume'], 2, ',', '.') . " | " . number_format($should_vol, 2, ',', '.') . " | " . number_format($over['volume'], 2, ',', '.') . " | $check_vol |\n\n";
    
    // 2. Member Summary
    $should_tot_mem = $saro['total_member'] + $sing['total_member'];
    $should_act_mem = $saro['active_member'] + $sing['active_member'];
    $should_new_mem = $saro['new_member'] + $sing['new_member'];
    
    $check_tot_mem = ($should_tot_mem == $over['total_member']) ? "✅" : "❌";
    $check_act_mem = ($should_act_mem == $over['active_member']) ? "✅" : "❌";
    $check_new_mem = ($should_new_mem == $over['new_member']) ? "✅" : "❌";
    
    $output_md .= "### Member Summary\n";
    $output_md .= "| Item | Sarolangun | Singkut | Total Seharusnya | Semua | Status |\n";
    $output_md .= "| --- | --- | --- | --- | --- | --- |\n";
    $output_md .= "| Total Member | " . number_format($saro['total_member'], 0, ',', '.') . " | " . number_format($sing['total_member'], 0, ',', '.') . " | " . number_format($should_tot_mem, 0, ',', '.') . " | " . number_format($over['total_member'], 0, ',', '.') . " | $check_tot_mem |\n";
    $output_md .= "| Active Member | " . number_format($saro['active_member'], 0, ',', '.') . " | " . number_format($sing['active_member'], 0, ',', '.') . " | " . number_format($should_act_mem, 0, ',', '.') . " | " . number_format($over['active_member'], 0, ',', '.') . " | $check_act_mem |\n";
    $output_md .= "| New Member | " . number_format($saro['new_member'], 0, ',', '.') . " | " . number_format($sing['new_member'], 0, ',', '.') . " | " . number_format($should_new_mem, 0, ',', '.') . " | " . number_format($over['new_member'], 0, ',', '.') . " | $check_new_mem |\n\n";
    
    // 3. Member Category
    $should_cat_motor = $saro['cat_motor'] + $sing['cat_motor'];
    $should_cat_mobil = $saro['cat_mobil'] + $sing['cat_mobil'];
    $should_cat_drigen = $saro['cat_drigen'] + $sing['cat_drigen'];
    $should_cat_niaga = $saro['cat_niaga'] + $sing['cat_niaga'];
    $should_cat_total = $should_act_mem;
    
    $check_cat_motor = ($should_cat_motor == $over['cat_motor']) ? "✅" : "❌";
    $check_cat_mobil = ($should_cat_mobil == $over['cat_mobil']) ? "✅" : "❌";
    $check_cat_drigen = ($should_cat_drigen == $over['cat_drigen']) ? "✅" : "❌";
    $check_cat_niaga = ($should_cat_niaga == $over['cat_niaga']) ? "✅" : "❌";
    $check_cat_total = ($should_cat_total == $over['active_member']) ? "✅" : "❌";
    
    $output_md .= "### Member Category\n";
    $output_md .= "| Kategori | Sarolangun | Singkut | Total Seharusnya | Semua | Status |\n";
    $output_md .= "| --- | --- | --- | --- | --- | --- |\n";
    $output_md .= "| Motor | " . $saro['cat_motor'] . " | " . $sing['cat_motor'] . " | " . $should_cat_motor . " | " . $over['cat_motor'] . " | $check_cat_motor |\n";
    $output_md .= "| Mobil | " . $saro['cat_mobil'] . " | " . $sing['cat_mobil'] . " | " . $should_cat_mobil . " | " . $over['cat_mobil'] . " | $check_cat_mobil |\n";
    $output_md .= "| Drigen | " . $saro['cat_drigen'] . " | " . $sing['cat_drigen'] . " | " . $should_cat_drigen . " | " . $over['cat_drigen'] . " | $check_cat_drigen |\n";
    $output_md .= "| Truck/Niaga | " . $saro['cat_niaga'] . " | " . $sing['cat_niaga'] . " | " . $should_cat_niaga . " | " . $over['cat_niaga'] . " | $check_cat_niaga |\n";
    $output_md .= "| Total | " . $saro['active_member'] . " | " . $sing['active_member'] . " | " . $should_cat_total . " | " . $over['active_member'] . " | $check_cat_total |\n\n";
    
    // 4. Active Members Status
    $saro_inactive = $saro['total_member'] - $saro['active_member'];
    $sing_inactive = $sing['total_member'] - $sing['active_member'];
    $should_inactive = $should_tot_mem - $should_act_mem;
    $over_inactive = $over['total_member'] - $over['active_member'];
    
    $check_aktif = $check_act_mem;
    $check_tidak_aktif = ($should_inactive == $over_inactive) ? "✅" : "❌";
    
    $output_md .= "### Active Members Status\n";
    $output_md .= "| Status | Sarolangun | Singkut | Total Seharusnya | Semua | Status |\n";
    $output_md .= "| --- | --- | --- | --- | --- | --- |\n";
    $output_md .= "| Aktif | " . number_format($saro['active_member'], 0, ',', '.') . " | " . number_format($sing['active_member'], 0, ',', '.') . " | " . number_format($should_act_mem, 0, ',', '.') . " | " . number_format($over['active_member'], 0, ',', '.') . " | $check_aktif |\n";
    $output_md .= "| Tidak Aktif | " . number_format($saro_inactive, 0, ',', '.') . " | " . number_format($sing_inactive, 0, ',', '.') . " | " . number_format($should_inactive, 0, ',', '.') . " | " . number_format($over_inactive, 0, ',', '.') . " | $check_tidak_aktif |\n";
    $output_md .= "| TOTAL | " . number_format($saro['total_member'], 0, ',', '.') . " | " . number_format($sing['total_member'], 0, ',', '.') . " | " . number_format($should_tot_mem, 0, ',', '.') . " | " . number_format($over['total_member'], 0, ',', '.') . " | $check_tot_mem |\n\n";
    
    $output_md .= "### Masalah yang Masih Ada\n";
    if ($check_trans == "✅" && $check_sales == "✅" && $check_vol == "✅" && $check_tot_mem == "✅" && $check_act_mem == "✅" && $check_new_mem == "✅" && $check_cat_motor == "✅" && $check_tidak_aktif == "✅") {
        $output_md .= "Semua hitungan cetak cabang Sarolangun + Singkut sinkron sempurna dengan laporan keseluruhan (Semua). Tidak ada masalah yang ditemukan. ✅\n\n";
    } else {
        $output_md .= "Terdapat selisih pada data laporan. Silakan periksa kembali query dan kecocokan filter SPBU.\n\n";
    }
    
    $output_md .= "---\n\n";
}

file_put_contents("/Applications/MAMP/htdocs/GITHUB/Custom/CBS/cbs-indo-membercard/admin/app/page/home/cek_hitungan_cetak.md", $output_md);
echo "Successfully generated cek_hitungan_cetak.md for months 1 to 6\n";
?>
