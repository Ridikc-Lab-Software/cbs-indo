<?php
// get_dashboard_data.php → Tanpa Filter SPBU/District
error_reporting(0);
ini_set('display_errors', 0);
header('Content-Type: application/json');

include "../../../include/koneksi/koneksi.php";
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

// Ambil parameter (spbu dihapus)
$kategori = isset($_GET['kategori']) ? trim(mysql_real_escape_string($_GET['kategori'])) : '';
$jenis_transaksi = isset($_GET['jenis_transaksi']) ? trim(mysql_real_escape_string($_GET['jenis_transaksi'])) : '';
$bulan = !empty($_GET['bulan']) ? (int) $_GET['bulan'] : 0;
$tahun = !empty($_GET['tahun']) ? (int) $_GET['tahun'] : 0;
$tanggal_mulai = !empty($_GET['mulai']) ? trim(mysql_real_escape_string($_GET['mulai'])) : $default_start;
$tanggal_sampai = !empty($_GET['sampai']) ? trim(mysql_real_escape_string($_GET['sampai'])) : $default_end;
$spbu = isset($_GET['spbu']) ? trim(mysql_real_escape_string($_GET['spbu'])) : $default_spbu;

// WHERE untuk data yang DIFILTER (tanpa filter SPBU)
$where_member = $where_trans = $where_redeem = $where_mitra = $where_rentang = $where_operator = "WHERE 1=1";

// Filter SPBU
if ($spbu != '') {
    // Extract SPBU prefix like "24.373.32" to allow partial matches when names are missing
    $spbu_prefix = $spbu;
    if (preg_match('/^([\d\.]+)/', $spbu, $matches)) {
        $spbu_prefix = $matches[1];
    }

    $where_member .= " AND spbu LIKE '$spbu_prefix%'";

    // Filter Transaksi & Redeem via Petugas SPBU
    $sub_petugas = "SELECT id_petugas FROM data_petugas WHERE nama_spbu LIKE '$spbu_prefix%'";
    $where_trans .= " AND t.id_petugas IN ($sub_petugas)";
    $where_redeem .= " AND r.id_petugas IN ($sub_petugas)";

    // Filter Operator Leaderboard & Mitra
    $where_operator .= " AND p.nama_spbu LIKE '$spbu_prefix%'";
} else {
    // Overall view: restrict to valid SPBU prefixes (Sarolangun and Singkut)
    $where_member .= " AND (spbu LIKE '24.373.27%' OR spbu LIKE '24.373.32%')";
    
    $sub_petugas = "SELECT id_petugas FROM data_petugas WHERE nama_spbu LIKE '24.373.27%' OR nama_spbu LIKE '24.373.32%'";
    $where_trans .= " AND t.id_petugas IN ($sub_petugas)";
    $where_redeem .= " AND r.id_petugas IN ($sub_petugas)";
    
    $where_operator .= " AND (p.nama_spbu LIKE '24.373.27%' OR p.nama_spbu LIKE '24.373.32%')";
}

if ($kategori != '') {
    $where_member .= " AND id_kategori_member = '$kategori'";
    $where_trans .= " AND t.id_kategori_member = '$kategori'";
}
if ($jenis_transaksi != '') {
    $where_trans .= " AND t.id_jenis_transaksi = '$jenis_transaksi'";
}
if ($bulan > 0) {
    $where_member .= " AND MONTH(tanggal_terdaftar) = $bulan";
    $where_trans .= " AND MONTH(t.tanggal) = $bulan";
    $where_redeem .= " AND MONTH(r.tanggal) = $bulan";
}
if ($tahun > 0) {
    $where_member .= " AND YEAR(tanggal_terdaftar) = $tahun";
    $where_trans .= " AND YEAR(t.tanggal) = $tahun";
    $where_redeem .= " AND YEAR(r.tanggal) = $tahun";
    $where_mitra .= " AND YEAR(tanggal_daftar) = $tahun";
}

// === Fungsi bantuan ===
function getSingle($sql)
{
    $res = mysql_query($sql);
    return ($res && mysql_num_rows($res) > 0) ? (int) mysql_result($res, 0) : 0;
}

function getArray($sql)
{
    $data = [];
    $res = mysql_query($sql);
    if ($res)
        while ($row = mysql_fetch_assoc($res))
            $data[] = $row;
    return $data;
}

// === TOTAL (mengikuti filter) ===
$where_rentang_mem = $where_member;
$where_rentang_trans = $where_trans;
$where_rentang_redeem = $where_redeem;
$where_rentang_mitra = $where_mitra;

if (!empty($tanggal_mulai) && !empty($tanggal_sampai)) {
    $where_rentang_mem .= " AND tanggal_terdaftar BETWEEN '$tanggal_mulai' AND '$tanggal_sampai 23:59:59'";
    $where_rentang_trans .= " AND t.tanggal BETWEEN '$tanggal_mulai' AND '$tanggal_sampai 23:59:59'";
    $where_rentang_redeem .= " AND r.tanggal BETWEEN '$tanggal_mulai' AND '$tanggal_sampai 23:59:59'";
    $where_rentang_mitra .= " AND tanggal_daftar BETWEEN '$tanggal_mulai' AND '$tanggal_sampai 23:59:59'";
}

$total_member = getSingle("SELECT COUNT(*) FROM data_member $where_rentang_mem");
$total_transaksi = getSingle("SELECT COUNT(*) FROM data_transaksi t LEFT JOIN data_petugas p ON t.id_petugas=p.id_petugas $where_rentang_trans");
$total_redeem = getSingle("SELECT COUNT(*) FROM data_redeem r LEFT JOIN data_petugas pt ON r.id_petugas=pt.id_petugas $where_rentang_redeem");
$total_promo = getSingle("SELECT COUNT(*) FROM data_promo");
$total_mitra = getSingle("SELECT COUNT(*) FROM data_mitra $where_rentang_mitra");

$ref_date = !empty($tanggal_sampai) ? $tanggal_sampai : date('Y-m-d');
$three_months_ago = date('Y-m-d', strtotime('-3 months', strtotime($ref_date)));

// Filter SPBU for member summary cards
$where_spbu_only = "WHERE 1=1";
$spbu_prefix = '';
if ($spbu != '') {
    $spbu_prefix = $spbu;
    if (preg_match('/^([\d\.]+)/', $spbu, $matches)) {
        $spbu_prefix = $matches[1];
    }
    $where_spbu_only .= " AND spbu LIKE '$spbu_prefix%'";
} else {
    $where_spbu_only .= " AND (spbu LIKE '24.373.27%' OR spbu LIKE '24.373.32%')";
}

// === OVERALL STATISTICS (FILTERED FOR MEMBER SUMMARY CARDS BY SPBU) ===
$total_member_overall = getSingle("SELECT COUNT(*) FROM data_member $where_spbu_only");
$member_aktif_overall = getSingle("
    SELECT COUNT(DISTINCT m.id_member)
    FROM data_member m
    INNER JOIN data_transaksi t ON m.id_member = t.id_member
    INNER JOIN data_petugas p ON t.id_petugas = p.id_petugas
    WHERE t.tanggal >= '$three_months_ago'
    AND t.tanggal <= '$ref_date'
    " . ($spbu != '' ? " AND m.spbu LIKE '$spbu_prefix%' AND p.nama_spbu LIKE '$spbu_prefix%'" : " AND ((m.spbu LIKE '24.373.27%' AND p.nama_spbu LIKE '24.373.27%') OR (m.spbu LIKE '24.373.32%' AND p.nama_spbu LIKE '24.373.32%'))") . "
");
$one_month_ago = date('Y-m-d', strtotime('-1 month', strtotime($ref_date)));
$new_member_count_overall = getSingle("
    SELECT COUNT(*) 
    FROM data_member 
    $where_spbu_only AND tanggal_terdaftar >= '$one_month_ago'
");

// === FILTERED ACTIVE / INACTIVE MEMBERS AND CATEGORY COUNTS (OPTIMIZED SINGLE PASS) ===
$member_categories = [];
$jumlah_kategori = [
    'motor' => 0,
    'mobil' => 0,
    'jerigen' => 0,
    'niaga' => 0
];

$where_q_trans = "WHERE 1=1";
if (!empty($tanggal_mulai) && !empty($tanggal_sampai)) {
    $where_q_trans .= " AND t.tanggal BETWEEN '$tanggal_mulai' AND '$tanggal_sampai 23:59:59'";
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

if ($q_trans_members) {
    while ($row = mysql_fetch_assoc($q_trans_members)) {
        $id_member = $row['id_member'];
        $cat = !empty($row['id_kategori_member']) ? $row['id_kategori_member'] : 'Lainnya';
        $cat_lower = strtolower($cat);
        
        // 1. Transaction category counts (only count if the transaction occurred at the selected SPBU)
        if ($spbu == '' || (isset($row['trans_spbu']) && strpos($row['trans_spbu'], $spbu_prefix) === 0)) {
            if (strpos($cat_lower, 'motor') !== false) {
                $jumlah_kategori['motor']++;
            } elseif (strpos($cat_lower, 'mobil') !== false) {
                $jumlah_kategori['mobil']++;
            } elseif (strpos($cat_lower, 'drigen') !== false || strpos($cat_lower, 'jerigen') !== false) {
                $jumlah_kategori['jerigen']++;
            } elseif (strpos($cat_lower, 'truck') !== false || strpos($cat_lower, 'niaga') !== false) {
                $jumlah_kategori['niaga']++;
            }
        }
        
        // 2. Track unique member categories (only if member exists in data_member)
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

// 3. Member category counts (for Member Category chart)
$member_cat_counts = [
    'Motor' => 0,
    'Mobil' => 0,
    'Drigen' => 0,
    'Truck/Niaga' => 0
];
foreach ($member_categories as $m_id => $m_cat) {
    $cat_lower = strtolower($m_cat);
    if (strpos($cat_lower, 'motor') !== false) {
        $member_cat_counts['Motor']++;
    } elseif (strpos($cat_lower, 'mobil') !== false) {
        $member_cat_counts['Mobil']++;
    } elseif (strpos($cat_lower, 'drigen') !== false || strpos($cat_lower, 'jerigen') !== false) {
        $member_cat_counts['Drigen']++;
    } elseif (strpos($cat_lower, 'truck') !== false || strpos($cat_lower, 'niaga') !== false) {
        $member_cat_counts['Truck/Niaga']++;
    }
}

$per_kategori = [
    ['kategori_member' => 'Motor', 'jml' => $member_cat_counts['Motor']],
    ['kategori_member' => 'Mobil', 'jml' => $member_cat_counts['Mobil']],
    ['kategori_member' => 'Drigen', 'jml' => $member_cat_counts['Drigen']],
    ['kategori_member' => 'Truck/Niaga', 'jml' => $member_cat_counts['Truck/Niaga']]
];

// 4. Active & Inactive members (for Active Members chart)
$member_aktif_filtered = count($member_categories);

$member_tidak_aktif_filtered = $total_member_overall - $member_aktif_filtered;
if ($member_tidak_aktif_filtered < 0) {
    $member_tidak_aktif_filtered = 0;
}


// === PER KATEGORI AKTIF/TIDAK AKTIF (keseluruhan) ===
$per_kategori_aktif = [];
$three_months_ago = date('Y-m-d', strtotime('-3 months'));
$qkat = mysql_query("SELECT id_kategori_member, kategori_member FROM data_kategori_member ORDER BY kategori_member");
while ($k = mysql_fetch_assoc($qkat)) {
    $idkat = $k['id_kategori_member'];
    $total_kat = getSingle("SELECT COUNT(*) FROM data_member WHERE id_kategori_member='$idkat'");
    $aktif_kat = getSingle("
        SELECT COUNT(DISTINCT m.id_member)
        FROM data_member m
        INNER JOIN data_transaksi t ON m.id_member = t.id_member
        WHERE m.id_kategori_member='$idkat' AND t.tanggal >= '$three_months_ago'
    ");
    if ($total_kat > 0) {
        $per_kategori_aktif[] = [
            'kategori' => $k['kategori_member'],
            'aktif' => $aktif_kat,
            'tidak_aktif' => $total_kat - $aktif_kat
        ];
    }
}

// === TOP LIST (aman ONLY_FULL_GROUP_BY) ===
$top_transaksi = getArray("
    SELECT COALESCE(MAX(m.nama), 'Tanpa Nama') AS nama, COUNT(*) AS jml
    FROM data_transaksi t
    LEFT JOIN data_member m ON t.id_member = m.id_member
    LEFT JOIN data_petugas p ON t.id_petugas = p.id_petugas
    $where_trans
    GROUP BY t.id_member ORDER BY jml DESC LIMIT 5
");

$top_redeem = getArray("
    SELECT COALESCE(MAX(m.nama), 'Tanpa Nama') AS nama, COUNT(*) AS jml
    FROM data_redeem r
    LEFT JOIN data_member m ON r.id_member = m.id_member
    LEFT JOIN data_petugas pt ON r.id_petugas = pt.id_petugas
    $where_redeem
    GROUP BY r.id_member ORDER BY jml DESC LIMIT 5
");

$top_point = getArray("
    SELECT COALESCE(nama, 'Tanpa Nama') AS nama, point
    FROM data_member $where_member
    ORDER BY point DESC LIMIT 4
");

// === PER SPBU (tetap ditampilkan untuk statistik) ===
$per_spbu = getArray("SELECT spbu AS nama_spbu, COUNT(*) AS jml FROM data_member $where_member GROUP BY spbu");

// === PER JENIS TRANSAKSI (dengan logo, harga, point) ===
$per_jenis_transaksi = getArray("
    SELECT 
        jt.jenis_transaksi,
        MAX(jt.gambar_logo) AS gambar_logo,
        MAX(jt.point) AS point,
        MAX(jt.harga) AS harga,
        COUNT(*) AS jml
    FROM data_transaksi t
    LEFT JOIN data_jenis_transaksi jt ON t.id_jenis_transaksi = jt.jenis_transaksi
    LEFT JOIN data_petugas p ON t.id_petugas = p.id_petugas
    $where_trans
    GROUP BY t.id_jenis_transaksi, jt.jenis_transaksi
    ORDER BY jml DESC
");

// Note: per_kategori and jumlah_kategori are computed in the single-pass above.

// === TREN BULANAN ===
$year = date('Y');
$months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
$arr_trans_month = [];
$arr_member_month = [];
$arr_redeem_month = [];

foreach ($months as $month) {
    $q = mysql_query("SELECT COUNT(*) AS bulan_$month FROM data_transaksi WHERE MONTH(tanggal)=$month AND YEAR(tanggal)=$year");
    $fetch = mysql_fetch_array($q);
    $arr_trans_month[] = $fetch["bulan_$month"];

    $q_member = mysql_query("SELECT COUNT(*) as bulan_$month FROM data_member WHERE MONTH(tanggal_terdaftar)=$month AND YEAR(tanggal_terdaftar)=$year");
    $fetch_member = mysql_fetch_array($q_member);
    $arr_member_month[] = $fetch_member["bulan_$month"];

    $q_redeem = mysql_query("SELECT COUNT(*) AS bulan_$month FROM data_redeem WHERE MONTH(tanggal)=$month AND YEAR(tanggal)=$year");
    $fetch_redeem = mysql_fetch_array($q_redeem);
    $arr_redeem_month[] = $fetch_redeem["bulan_$month"];
}

// === PROMO LIST ===
$arr_promos = [];
$q_promo = mysql_query("SELECT id_promo, nama_promo FROM data_promo WHERE status='aktif'");

if ($q_promo) {
    while ($d_promo = mysql_fetch_assoc($q_promo)) {
        $nama_bersih = iconv('UTF-8', 'UTF-8//IGNORE', $d_promo['nama_promo']);

        $arr_promos[] = [
            'id_promo' => (int) $d_promo['id_promo'],
            'nama_promo' => $nama_bersih
        ];
    }
}

// === JENIS BENSIN & LITER ===
$d_jenis = [];
$q_jenis_bensin = mysql_query("SELECT * FROM data_jenis_transaksi");
if ($q_jenis_bensin) {
    while ($d_jenis_bensin = mysql_fetch_array($q_jenis_bensin)) {
        $d_jenis[] = $d_jenis_bensin['jenis_transaksi'];
    }
}

$liter = [];
foreach ($d_jenis as $jenis) {
    $q_liter = mysql_query("
        SELECT tjt.jenis_transaksi, t.jumlah, COALESCE(ht.harga, tjt.harga) as harga 
        FROM data_transaksi t 
        JOIN data_jenis_transaksi tjt ON t.id_jenis_transaksi=tjt.jenis_transaksi 
        LEFT JOIN (SELECT id_transaksi, MAX(harga) as harga FROM data_harga_transaksi GROUP BY id_transaksi) ht ON t.id_transaksi=ht.id_transaksi 
        WHERE t.id_jenis_transaksi='$jenis'
    ");
    if ($q_liter) {
        while ($d_liter = mysql_fetch_array($q_liter)) {
            $liter[$jenis][] = $d_liter;
        }
    }
}

// === MITRA LIST ===
$mitras = [];
$q_mitra = mysql_query("SELECT * FROM data_mitra");
if ($q_mitra) {
    while ($d_mitra = mysql_fetch_array($q_mitra)) {
        $url_default = '../../../upload/' . $d_mitra['gambar_logo'];
        if (file_exists($url_default)) {
            $mitras[] = ['nama_mitra' => $d_mitra['nama_mitra'], 'gambar_logo' => $d_mitra['gambar_logo']];
        } else {
            $mitras[] = ['nama_mitra' => $d_mitra['nama_mitra'], 'gambar_logo' => 'default_image/slack.png'];
        }
    }
}

// === OPERATOR LEADERBOARD FULL ===
$where_trans_sub = str_replace("WHERE 1=1", "", $where_rentang_trans);
$where_member_sub = str_replace("WHERE 1=1", "", $where_rentang_mem);
$where_redeem_sub = str_replace("WHERE 1=1", "", $where_rentang_redeem);

$leaderboard_full = getArray("
    SELECT 
        COALESCE(NULLIF(TRIM(p.nama), ''), '-') AS nama,
        COALESCE((SELECT COUNT(*) FROM data_transaksi t WHERE t.id_petugas = p.id_petugas $where_trans_sub), 0) AS total_transaksi,
        0 AS new_member,
        COALESCE((SELECT COUNT(*) FROM data_redeem r WHERE r.id_petugas = p.id_petugas $where_redeem_sub), 0) AS total_redeem,
        COALESCE((SELECT COUNT(*) FROM data_transaksi_voucher_spbu v WHERE v.id_petugas = p.id_petugas), 0) AS total_voucher,
        COALESCE((SELECT SUM(t.jumlah) FROM data_transaksi t WHERE t.id_petugas = p.id_petugas AND t.kategori_jumlah = 'rupiah' $where_trans_sub), 0) AS total_sales
    FROM data_petugas p
    WHERE 1=1 AND ('$spbu' = '' OR p.nama_spbu LIKE '" . (preg_match('/^([\d\.]+)/', $spbu, $m) ? $m[1] : $spbu) . "%')
");

if ($spbu == '') {
    $unknown_trans = getSingle("SELECT COUNT(*) FROM data_transaksi t $where_rentang_trans AND (t.id_petugas IS NULL OR t.id_petugas = '' OR t.id_petugas = '0' OR t.id_petugas NOT IN (SELECT id_petugas FROM data_petugas))");

    $unknown_redeem = getSingle("SELECT COUNT(*) FROM data_redeem r $where_rentang_redeem AND (r.id_petugas IS NULL OR r.id_petugas = '' OR r.id_petugas = '0' OR r.id_petugas NOT IN (SELECT id_petugas FROM data_petugas))");

    $unknown_voucher = getSingle("SELECT COUNT(*) FROM data_transaksi_voucher_spbu v WHERE (v.id_petugas IS NULL OR v.id_petugas = '' OR v.id_petugas = '0' OR v.id_petugas NOT IN (SELECT id_petugas FROM data_petugas))");

    $unknown_sales = getSingle("SELECT SUM(t.jumlah) FROM data_transaksi t $where_rentang_trans AND t.kategori_jumlah = 'rupiah' AND (t.id_petugas IS NULL OR t.id_petugas = '' OR t.id_petugas = '0' OR t.id_petugas NOT IN (SELECT id_petugas FROM data_petugas))");

    if ($unknown_trans > 0 || $unknown_redeem > 0 || $unknown_voucher > 0 || $unknown_sales > 0) {
        $found = false;
        foreach ($leaderboard_full as &$lb) {
            if ($lb['nama'] === '-') {
                $lb['total_transaksi'] += $unknown_trans;
                $lb['total_redeem'] += $unknown_redeem;
                $lb['total_voucher'] += $unknown_voucher;
                $lb['total_sales'] += $unknown_sales ? $unknown_sales : 0;
                $found = true;
                break;
            }
        }
        if (!$found) {
            $leaderboard_full[] = [
                'nama' => '-',
                'total_transaksi' => $unknown_trans,
                'new_member' => 0,
                'total_redeem' => $unknown_redeem,
                'total_voucher' => $unknown_voucher,
                'total_sales' => $unknown_sales ? $unknown_sales : 0
            ];
        }
    }
}

// === NEW MEMBER GROUPED BY ADMIN / MANDIRI ===
$q_new_member = getArray("
    SELECT m.id_admin, COUNT(*) as jml, a.username 
    FROM data_member m 
    LEFT JOIN data_admin a ON m.id_admin = a.id_admin
    WHERE 1=1 " . str_replace("WHERE 1=1", "", $where_rentang_mem) . "
    GROUP BY m.id_admin, a.username
");

foreach ($q_new_member as $row) {
    if (empty($row['id_admin']) || $row['id_admin'] == '0') {
        $nama_pendaftar = '-';
    } else {
        $nama_pendaftar = 'ADMIN ' . (empty($row['username']) ? 'TIDAK DIKETAHUI' : strtoupper($row['username']));
    }

    $found = false;
    foreach ($leaderboard_full as &$lb) {
        if (strtoupper($lb['nama']) === strtoupper($nama_pendaftar)) {
            $lb['new_member'] += $row['jml'];
            $found = true;
            break;
        }
    }
    if (!$found) {
        $leaderboard_full[] = [
            'nama' => $nama_pendaftar,
            'total_transaksi' => 0,
            'new_member' => $row['jml'],
            'total_redeem' => 0,
            'total_voucher' => 0,
            'total_sales' => 0
        ];
    }
}

// Urutkan berdasarkan total transaksi descending
usort($leaderboard_full, function ($a, $b) {
    return $b['total_transaksi'] <=> $a['total_transaksi'];
});

// === OPERATOR LEADERBOARD ===
$operator_leaderboard = getArray("
    SELECT t.id_petugas, COALESCE(NULLIF(TRIM(p.nama), ''), 'Tidak Diketahui') AS nama, COUNT(*) AS jumlah_transaksi 
    FROM data_transaksi t 
    LEFT JOIN data_petugas p ON t.id_petugas = p.id_petugas 
    $where_rentang_trans
    GROUP BY t.id_petugas, p.nama 
    ORDER BY jumlah_transaksi DESC 
    LIMIT 5
");

// === REDEEM BY PROMO ===
$redeem_by_promo = getArray("
    SELECT p.nama_promo, COUNT(*) as jumlah
    FROM data_redeem r
    JOIN data_promo p ON r.id_promo = p.id_promo
    $where_rentang_redeem
    GROUP BY p.id_promo
    ORDER BY jumlah DESC
");


// === DAY OF MONTH STATS ===
// Tentukan range tanggal: jika ada filter gunakan filter, jika tidak gunakan bulan berjalan
if (!empty($tanggal_mulai) && !empty($tanggal_sampai)) {
    $range_start = $tanggal_mulai;
    $range_end   = $tanggal_sampai;
} else {
    // Default: bulan berjalan (1 sampai hari ini)
    $range_start = date('Y-m-01');
    $range_end   = date('Y-m-d');
}

// Generate semua tanggal dalam range
$day_stats = [];
$dt = strtotime($range_start);
$dt_end = strtotime($range_end);
while ($dt <= $dt_end) {
    $key = date('Y-m-d', $dt);
    $day_stats[$key] = [
        'date'        => $key,
        'day_label'   => date('d/m/Y', $dt),
        'transaction' => 0,
        'redeem'      => 0,
        'new_member'  => 0
    ];
    $dt = strtotime('+1 day', $dt);
}

// Transaction per tanggal
$q_day_trans = mysql_query("
    SELECT DATE(tanggal) as KEY_DATE, COUNT(*) as total 
    FROM data_transaksi t WHERE 1=1 $where_trans_sub
    AND DATE(tanggal) BETWEEN '$range_start' AND '$range_end'
    GROUP BY DATE(tanggal)
");
if ($q_day_trans) {
    while ($row = mysql_fetch_assoc($q_day_trans)) {
        if (isset($day_stats[$row['KEY_DATE']])) {
            $day_stats[$row['KEY_DATE']]['transaction'] = (int) $row['total'];
        }
    }
}

// Redeem per tanggal
$q_day_redeem = mysql_query("
    SELECT DATE(tanggal) as KEY_DATE, COUNT(*) as total 
    FROM data_redeem r WHERE 1=1 $where_redeem_sub
    AND DATE(tanggal) BETWEEN '$range_start' AND '$range_end'
    GROUP BY DATE(tanggal)
");
if ($q_day_redeem) {
    while ($row = mysql_fetch_assoc($q_day_redeem)) {
        if (isset($day_stats[$row['KEY_DATE']])) {
            $day_stats[$row['KEY_DATE']]['redeem'] = (int) $row['total'];
        }
    }
}

// New Member per tanggal
$q_day_member = mysql_query("
    SELECT DATE(tanggal_terdaftar) as KEY_DATE, COUNT(*) as total 
    FROM data_member m WHERE 1=1 $where_member_sub
    AND DATE(tanggal_terdaftar) BETWEEN '$range_start' AND '$range_end'
    GROUP BY DATE(tanggal_terdaftar)
");
if ($q_day_member) {
    while ($row = mysql_fetch_assoc($q_day_member)) {
        if (isset($day_stats[$row['KEY_DATE']])) {
            $day_stats[$row['KEY_DATE']]['new_member'] = (int) $row['total'];
        }
    }
}

$day_of_month_stats = array_values($day_stats);


// === OUTPUT JSON ===
$output = [
    'total_member' => $total_member,
    'total_transaksi' => $total_transaksi,
    'total_redeem' => $total_redeem,
    'total_promo' => $total_promo,
    'total_mitra' => $total_mitra,
    'total_member_overall' => $total_member_overall,
    'member_aktif_overall' => $member_aktif_overall,
    'new_member_count_overall' => $new_member_count_overall,
    'member_aktif_filtered' => $member_aktif_filtered,
    'member_tidak_aktif_filtered' => $member_tidak_aktif_filtered,
    'per_kategori_aktif' => $per_kategori_aktif,
    'top_transaksi' => $top_transaksi,
    'top_redeem' => $top_redeem,
    'top_point' => $top_point,
    'per_spbu' => $per_spbu,
    'per_jenis_transaksi' => $per_jenis_transaksi,
    'per_kategori' => $per_kategori,
    'jumlah_kategori' => $jumlah_kategori,
    'tren_trans_bulan' => $arr_trans_month,
    'tren_mem_bulan' => $arr_member_month,
    'tren_redeem_bulan' => $arr_redeem_month,
    'promo_list' => $arr_promos,
    'jenis_liter' => $liter,
    'mitra_list' => $mitras,
    'leader_operator' => $operator_leaderboard,
    'leaderboard_full' => $leaderboard_full,
    'redeem_by_promo' => $redeem_by_promo,
    'day_of_month_stats' => $day_of_month_stats,
    'debug_query' => [
        'where_member' => $where_member,
        'where_rentang_mem' => $where_rentang_mem,
        'where_trans' => $where_trans,
        'where_rentang_trans' => $where_rentang_trans,
        'where_redeem' => $where_redeem,
        'where_rentang_redeem' => $where_rentang_redeem,
        'spbu_param' => $spbu,
        'mulai_param' => $tanggal_mulai,
        'sampai_param' => $tanggal_sampai
    ]
];

// Helper recursive function to sanitize all strings to valid UTF-8
function sanitize_utf8($data) {
    if (is_string($data)) {
        return mb_convert_encoding($data, 'UTF-8', 'UTF-8');
    }
    if (is_array($data)) {
        $ret = [];
        foreach ($data as $i => $d) {
            $ret[$i] = sanitize_utf8($d);
        }
        return $ret;
    }
    return $data;
}

$output_safe = sanitize_utf8($output);

$json = json_encode($output_safe, JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE);

if ($json === false) {
    die(json_encode(['error' => 'JSON Encode Error', 'msg' => json_last_error_msg()]));
}

echo $json;
exit;