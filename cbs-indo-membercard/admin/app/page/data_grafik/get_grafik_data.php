<?php
include "../../../include/koneksi/koneksi.php"; // pastikan pakai mysql_connect
include "../../../include/function/enc.php";
include "../../../include/function/all.php";

$default_spbu = '';
$admin_username = '';
if (isset($_COOKIE['jenenge'])) {
    $admin_username = decrypt($_COOKIE['jenenge']);
}
if (!empty($admin_username)) {
    $admin_nama_spbu = baca_database('data_admin', 'nama_spbu', "SELECT nama_spbu FROM data_admin WHERE username='$admin_username'");
    if (!empty($admin_nama_spbu)) {
        if (preg_match('/^([\d\.]+)/', $admin_nama_spbu, $matches)) {
            $default_spbu = $matches[1];
        } else {
            $default_spbu = $admin_nama_spbu;
        }
    }
}

$default_start = date('Y-m-01');
$default_end = date('Y-m-t');

$spbu = isset($_GET['spbu']) ? mysql_real_escape_string($_GET['spbu']) : $default_spbu;
$kategori = isset($_GET['kategori']) ? mysql_real_escape_string($_GET['kategori']) : '';
$jenis_transaksi = isset($_GET['jenis_transaksi']) ? mysql_real_escape_string($_GET['jenis_transaksi']) : '';
$bulan = isset($_GET['bulan']) && $_GET['bulan'] !== '' ? (int) $_GET['bulan'] : '';
$tahun = isset($_GET['tahun']) && $_GET['tahun'] !== '' ? (int) $_GET['tahun'] : '';
$mulai = (isset($_GET['mulai']) && $_GET['mulai'] != '') ? mysql_real_escape_string($_GET['mulai']) : '';
$sampai = (isset($_GET['sampai']) && $_GET['sampai'] != '') ? mysql_real_escape_string($_GET['sampai']) : '';

// Bangun kondisi WHERE
$where_trans = "WHERE 1=1";
$where_redeem = "WHERE 1=1";
$where_member = "WHERE tanggal_terdaftar IS NOT NULL";

if ($spbu != '') {
    $spbu_prefix = $spbu;
    if (preg_match('/^([\d\.]+)/', $spbu, $matches)) {
        $spbu_prefix = $matches[1];
    }
    $where_trans .= " AND p.nama_spbu LIKE '$spbu_prefix%'";
    $where_redeem .= " AND p2.nama_spbu LIKE '$spbu_prefix%'";
    $where_member .= " AND m.spbu LIKE '$spbu_prefix%'";
}

if ($kategori != '') {
    $where_trans .= " AND m.id_kategori_member = '$kategori'";
}
if ($jenis_transaksi != '') {
    $where_trans .= " AND t.id_jenis_transaksi = '$jenis_transaksi'";
}
if ($bulan != '') {
    $where_trans .= " AND MONTH(t.tanggal) = $bulan";
    $where_redeem .= " AND MONTH(r.tanggal) = $bulan";
    $where_member .= " AND MONTH(m.tanggal_terdaftar) = $bulan";
}
if ($tahun != '') {
    $where_trans .= " AND YEAR(t.tanggal) = $tahun";
    $where_redeem .= " AND YEAR(r.tanggal) = $tahun";
    $where_member .= " AND YEAR(m.tanggal_terdaftar) = $tahun";
}
// Date range filter (only applied if explicitly passed from dashboard)
if ($mulai != '' && $sampai != '') {
    $where_trans .= " AND t.tanggal BETWEEN '$mulai' AND '$sampai 23:59:59'";
    $where_redeem .= " AND r.tanggal BETWEEN '$mulai' AND '$sampai 23:59:59'";
    $where_member .= " AND m.tanggal_terdaftar BETWEEN '$mulai' AND '$sampai 23:59:59'";
}

if ($bulan != '' && $tahun != '') {
    // Daily View (Specific Month)
    $days_in_month = (int)date('t', mktime(0, 0, 0, $bulan, 1, $tahun));
    
    // Generate daily labels like "01", "02", ..., "$days_in_month"
    $labels = [];
    for ($d = 1; $d <= $days_in_month; $d++) {
        $labels[] = sprintf('%02d', $d);
    }
    
    $transaksi = array_fill(0, $days_in_month, 0);
    $redeem = array_fill(0, $days_in_month, 0);
    $member = array_fill(0, $days_in_month, 0);
    
    // Query Transaksi grouped by DAY
    $q_trans = mysql_query("SELECT DAY(t.tanggal) as tgl, COUNT(*) as jml 
                            FROM data_transaksi t
                            LEFT JOIN data_member m ON t.id_member = m.id_member
                            LEFT JOIN data_petugas p ON t.id_petugas = p.id_petugas
                            $where_trans
                            GROUP BY DAY(t.tanggal)
                            ORDER BY DAY(t.tanggal)");
    if ($q_trans) {
        while ($r = mysql_fetch_array($q_trans)) {
            $idx = (int)$r['tgl'] - 1;
            if ($idx >= 0 && $idx < $days_in_month) {
                $transaksi[$idx] = (int)$r['jml'];
            }
        }
    }
    
    // Query Redeem grouped by DAY
    $q_redeem = mysql_query("SELECT DAY(r.tanggal) as tgl, COUNT(*) as jml 
                             FROM data_redeem r
                             LEFT JOIN data_petugas p2 ON r.id_petugas = p2.id_petugas
                             $where_redeem
                             GROUP BY DAY(r.tanggal)
                             ORDER BY DAY(r.tanggal)");
    if ($q_redeem) {
        while ($r = mysql_fetch_array($q_redeem)) {
            $idx = (int)$r['tgl'] - 1;
            if ($idx >= 0 && $idx < $days_in_month) {
                $redeem[$idx] = (int)$r['jml'];
            }
        }
    }
    
    // Query Member Baru grouped by DAY
    $q_member = mysql_query("SELECT DAY(m.tanggal_terdaftar) as tgl, COUNT(*) as jml 
                             FROM data_member m
                             $where_member
                             GROUP BY DAY(m.tanggal_terdaftar)
                             ORDER BY DAY(m.tanggal_terdaftar)");
    if ($q_member) {
        while ($r = mysql_fetch_array($q_member)) {
            $idx = (int)$r['tgl'] - 1;
            if ($idx >= 0 && $idx < $days_in_month) {
                $member[$idx] = (int)$r['jml'];
            }
        }
    }
} else {
    // Monthly View (All Months)
    $bulan_nama = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
    $labels = ($tahun != '') ? array_map(function ($b) use ($tahun) {
        return "$b $tahun";
    }, $bulan_nama) : $bulan_nama;
    
    $transaksi = array_fill(0, 12, 0);
    $redeem = array_fill(0, 12, 0);
    $member = array_fill(0, 12, 0);
    
    // Query Transaksi grouped by MONTH
    $q_trans = mysql_query("SELECT MONTH(t.tanggal) as bln, COUNT(*) as jml 
                            FROM data_transaksi t
                            LEFT JOIN data_member m ON t.id_member = m.id_member
                            LEFT JOIN data_petugas p ON t.id_petugas = p.id_petugas
                            $where_trans
                            GROUP BY MONTH(t.tanggal)
                            ORDER BY MONTH(t.tanggal)");
    if ($q_trans) {
        while ($r = mysql_fetch_array($q_trans)) {
            $idx = (int)$r['bln'] - 1;
            if ($idx >= 0 && $idx < 12) {
                $transaksi[$idx] = (int)$r['jml'];
            }
        }
    }
    
    // Query Redeem grouped by MONTH
    $q_redeem = mysql_query("SELECT MONTH(r.tanggal) as bln, COUNT(*) as jml 
                             FROM data_redeem r
                             LEFT JOIN data_petugas p2 ON r.id_petugas = p2.id_petugas
                             $where_redeem
                             GROUP BY MONTH(r.tanggal)
                             ORDER BY MONTH(r.tanggal)");
    if ($q_redeem) {
        while ($r = mysql_fetch_array($q_redeem)) {
            $idx = (int)$r['bln'] - 1;
            if ($idx >= 0 && $idx < 12) {
                $redeem[$idx] = (int)$r['jml'];
            }
        }
    }
    
    // Query Member Baru grouped by MONTH
    $q_member = mysql_query("SELECT MONTH(m.tanggal_terdaftar) as bln, COUNT(*) as jml 
                             FROM data_member m
                             $where_member
                             GROUP BY MONTH(m.tanggal_terdaftar)
                             ORDER BY MONTH(m.tanggal_terdaftar)");
    if ($q_member) {
        while ($r = mysql_fetch_array($q_member)) {
            $idx = (int)$r['bln'] - 1;
            if ($idx >= 0 && $idx < 12) {
                $member[$idx] = (int)$r['jml'];
            }
        }
    }
}

// === TOTAL SALES DAN VOLUME ===
$total_transaksi_count = 0;
$total_sales_rupiah = 0;
$total_volume_liter = 0;

$q_totals = mysql_query("SELECT t.jumlah, t.kategori_jumlah, COALESCE(ht.harga, jt.harga) as harga 
                         FROM data_transaksi t
                         LEFT JOIN data_member m ON t.id_member = m.id_member
                         LEFT JOIN data_petugas p ON t.id_petugas = p.id_petugas
                         LEFT JOIN data_jenis_transaksi jt ON t.id_jenis_transaksi = jt.jenis_transaksi
                         LEFT JOIN (SELECT id_transaksi, MAX(harga) as harga FROM data_harga_transaksi GROUP BY id_transaksi) ht ON t.id_transaksi = ht.id_transaksi
                         $where_trans");

if ($q_totals) {
    while ($row = mysql_fetch_array($q_totals)) {
        $jumlah = (float) $row['jumlah'];
        $harga = (float) $row['harga'];

        $total_transaksi_count++;
        if ($row['kategori_jumlah'] == 'rupiah') {
            $total_sales_rupiah += $jumlah;
        }

        if ($harga > 0 && $row['kategori_jumlah'] == 'liter') {
            $total_volume_liter += $jumlah;
        } else if ($harga > 0 && $row['kategori_jumlah'] == 'rupiah') {
            $total_volume_liter += ($jumlah / $harga);
        }
    }
}

// === DATA BY BBM TYPE ===
$trans_by_bbm_labels = [];
$trans_by_bbm_data = [];
$sales_by_bbm_data = [];
$volume_by_bbm_data = [];

// Query for transaction count by BBM type
$q_trans_by_bbm = mysql_query("SELECT jt.jenis_transaksi as bbm, COUNT(*) as count
                                FROM data_transaksi t
                                LEFT JOIN data_member m ON t.id_member = m.id_member
                                LEFT JOIN data_petugas p ON t.id_petugas = p.id_petugas
                                LEFT JOIN data_jenis_transaksi jt ON t.id_jenis_transaksi = jt.jenis_transaksi
                                $where_trans
                                GROUP BY jt.jenis_transaksi
                                ORDER BY jt.jenis_transaksi");

// Query for sales (Rupiah) by BBM type
$q_sales_by_bbm = mysql_query("SELECT jt.jenis_transaksi as bbm, SUM(t.jumlah) as total_rupiah
                                FROM data_transaksi t
                                LEFT JOIN data_member m ON t.id_member = m.id_member
                                LEFT JOIN data_petugas p ON t.id_petugas = p.id_petugas
                                LEFT JOIN data_jenis_transaksi jt ON t.id_jenis_transaksi = jt.jenis_transaksi
                                $where_trans AND t.kategori_jumlah = 'rupiah'
                                GROUP BY jt.jenis_transaksi
                                ORDER BY jt.jenis_transaksi");

// Query for volume (Liter) by BBM type (we manually calculate total liter below from the transaction loop so we dont do raw SUM here directly unless we split it)
$q_volume_by_bbm = mysql_query("SELECT jt.jenis_transaksi as bbm, 
                                SUM(IF(t.kategori_jumlah='liter', t.jumlah, t.jumlah/COALESCE(ht.harga, jt.harga))) as total_liter
                                FROM data_transaksi t
                                LEFT JOIN data_member m ON t.id_member = m.id_member
                                LEFT JOIN data_petugas p ON t.id_petugas = p.id_petugas
                                LEFT JOIN data_jenis_transaksi jt ON t.id_jenis_transaksi = jt.jenis_transaksi
                                LEFT JOIN (SELECT id_transaksi, MAX(harga) as harga FROM data_harga_transaksi GROUP BY id_transaksi) ht ON t.id_transaksi = ht.id_transaksi
                                $where_trans AND COALESCE(ht.harga, jt.harga) > 0
                                GROUP BY jt.jenis_transaksi
                                ORDER BY jt.jenis_transaksi");

if ($q_trans_by_bbm) {
    while ($row = mysql_fetch_array($q_trans_by_bbm)) {
        $trans_by_bbm_labels[] = $row['bbm'];
        $trans_by_bbm_data[] = (int) $row['count'];
    }
}

$sales_temp = [];
if ($q_sales_by_bbm) {
    while ($row = mysql_fetch_array($q_sales_by_bbm)) {
        $sales_temp[$row['bbm']] = (float) $row['total_rupiah'];
    }
}

$volume_temp = [];
if ($q_volume_by_bbm) {
    while ($row = mysql_fetch_array($q_volume_by_bbm)) {
        $volume_temp[$row['bbm']] = round((float) $row['total_liter'], 2);
    }
}

// Ensure sales and volume arrays match the labels order
foreach ($trans_by_bbm_labels as $bbm) {
    $sales_by_bbm_data[] = isset($sales_temp[$bbm]) ? $sales_temp[$bbm] : 0;
    $volume_by_bbm_data[] = isset($volume_temp[$bbm]) ? $volume_temp[$bbm] : 0;
}


header('Content-Type: application/json');
echo json_encode([
    'labels' => $labels,
    'transaksi' => array_values($transaksi),
    'redeem' => array_values($redeem),
    'member' => array_values($member),
    'total_transaksi_count' => $total_transaksi_count,
    'total_sales_rupiah' => $total_sales_rupiah,
    'total_volume_liter' => round($total_volume_liter, 2),
    'trans_by_bbm_labels' => $trans_by_bbm_labels,
    'trans_by_bbm_data' => $trans_by_bbm_data,
    'sales_by_bbm_data' => $sales_by_bbm_data,
    'volume_by_bbm_data' => $volume_by_bbm_data
]);
