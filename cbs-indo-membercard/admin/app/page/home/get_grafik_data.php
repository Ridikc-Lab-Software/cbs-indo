<?php
header('Content-Type: application/json');
error_reporting(0);
ini_set('display_errors', 0);
include "../../../include/koneksi/koneksi.php";

$spbu = isset($_GET['spbu']) ? trim($_GET['spbu']) : '';
$kategori = isset($_GET['kategori']) ? trim($_GET['kategori']) : '';
$jenis = isset($_GET['jenis_transaksi']) ? trim($_GET['jenis_transaksi']) : '';
$bulan = isset($_GET['bulan']) && $_GET['bulan'] ? (int) $_GET['bulan'] : 0;
$tahun = isset($_GET['tahun']) && $_GET['tahun'] ? (int) $_GET['tahun'] : date('Y');
$tanggal_mulai = isset($_GET['mulai']) ? trim($_GET['mulai']) : '';
$tanggal_sampai = isset($_GET['sampai']) ? trim($_GET['sampai']) : '';

$where_member = "WHERE 1=1";
$where_trans = "WHERE 1=1";
$where_redeem = "WHERE 1=1";

if ($spbu !== '') {
  $spbu_prefix = $spbu;
  if (preg_match('/^([\d\.]+)/', $spbu, $matches)) {
    $spbu_prefix = $matches[1];
  }
  $spbu_prefix = mysql_real_escape_string($spbu_prefix);

  $where_member .= " AND m.spbu LIKE '$spbu_prefix%'";
  $where_trans .= " AND p.nama_spbu LIKE '$spbu_prefix%'";
  $where_redeem .= " AND p2.nama_spbu LIKE '$spbu_prefix%'";
}
if ($kategori !== '') {
  $kategori = mysql_real_escape_string($kategori);
  $where_member .= " AND m.id_kategori_member = '$kategori'";
  $where_trans .= " AND t.id_kategori_member = '$kategori'";
}
if ($jenis !== '') {
  $jenis = mysql_real_escape_string($jenis);
  $where_trans .= " AND t.id_jenis_transaksi = '$jenis'";
}
if ($bulan > 0) {
  $where_member .= " AND MONTH(m.tanggal_terdaftar)=$bulan";
  $where_trans .= " AND MONTH(t.tanggal)=$bulan";
  $where_redeem .= " AND MONTH(r.tanggal)=$bulan";
}
if ($tahun > 0) {
  $where_member .= " AND YEAR(m.tanggal_terdaftar)=$tahun";
  $where_trans .= " AND YEAR(t.tanggal)=$tahun";
  $where_redeem .= " AND YEAR(r.tanggal)=$tahun";
}
if ($tanggal_mulai !== '' && $tanggal_sampai !== '') {
  $tanggal_mulai = mysql_real_escape_string($tanggal_mulai);
  $tanggal_sampai = mysql_real_escape_string($tanggal_sampai);
  $where_member .= " AND m.tanggal_terdaftar BETWEEN '$tanggal_mulai' AND '$tanggal_sampai 23:59:59'";
  $where_trans .= " AND t.tanggal BETWEEN '$tanggal_mulai' AND '$tanggal_sampai 23:59:59'";
  $where_redeem .= " AND r.tanggal BETWEEN '$tanggal_mulai' AND '$tanggal_sampai 23:59:59'";
}

// 1. Aktif vs Tidak Aktif
$three = date('Y-m-d', strtotime('-3 months'));
$q = mysql_query("SELECT COUNT(*) c FROM (
                    SELECT m.id_member 
                    FROM data_member m 
                    INNER JOIN data_transaksi t ON m.id_member=t.id_member AND t.tanggal>='$three'
                    $where_member
                    GROUP BY m.id_member
                  ) AS aktif_members");
$aktif = mysql_result($q, 0) ?: 0;

$q = mysql_query("SELECT COUNT(*) FROM data_member m $where_member");
$total = mysql_result($q, 0) ?: 0;
// 2. Top 5 Transaksi
$top_transaksi = [];
$q = mysql_query("SELECT m.nama, COUNT(*) j
                  FROM data_transaksi t
                  JOIN data_member m ON t.id_member = m.id_member
                  $where_trans

                  GROUP BY t.id_member ORDER BY j DESC LIMIT 5");
if ($q) {
  while ($r = mysql_fetch_assoc($q)) {
    $top_transaksi[] = $r;
  }
}

echo json_encode([
  'aktif' => $aktif,
  'tidak_aktif' => $tidak_aktif,
  'top_transaksi' => $top_transaksi,
  'debug_query' => [
    'where_member' => $where_member,
    'where_trans' => $where_trans,
    'where_redeem' => $where_redeem,
    'spbu_param' => $spbu,
    'mulai_param' => $tanggal_mulai,
    'sampai_param' => $tanggal_sampai
  ]
]);