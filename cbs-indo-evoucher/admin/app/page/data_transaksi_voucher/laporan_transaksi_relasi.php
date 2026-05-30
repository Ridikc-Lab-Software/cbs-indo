<?php
// include '../../../include/koneksi/koneksi.php';  // pastikan sudah mysql_connect & mysql_select_db
// include '../../../include/function/all.php';

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set('display_errors', 0);

// === AMBIL DATA ADMIN ===
$username = decrypt($_COOKIE['jenenge']);
$id_admin = baca_database("","id_admin","SELECT * FROM data_admin WHERE username='$username'");
$nama     = baca_database("","nama","SELECT * FROM data_nama_admin WHERE id_admin='$id_admin'");
$jabatan  = baca_database("","hak_akses","SELECT * FROM data_admin WHERE username='$username'");
$spbu     = baca_database("","nama_spbu","SELECT * FROM data_admin WHERE username='$username'");
$alamat1  = baca_database("","alamat1","SELECT * FROM data_spbu WHERE nama_spbu='$spbu'");
$id_relasi= isset($_GET['relasi'])?$_GET['relasi']:'';
$nama_relasi_filter = baca_database("","nama","select * from data_relasi where id_relasi='$id_relasi'");

// Ambil Data Shift dulu untuk mapping
$shifts = [];
$q_shift = mysql_query("SELECT * FROM data_shift");
while($r_shift = mysql_fetch_array($q_shift)){
    $shifts[] = $r_shift;
}

function get_shift($waktu, $shifts) {
    $jam = date('H:i:s', strtotime($waktu));
    foreach ($shifts as $s) {
        if ($jam >= $s['jam_mulai'] && $jam <= $s['jam_selesai']) {
            return $s['shift'];
        }
        // Handle shift yang nyebrang hari (misal 22:00 - 06:00)
        if ($s['jam_mulai'] > $s['jam_selesai']) {
            if ($jam >= $s['jam_mulai'] || $jam <= $s['jam_selesai']) {
                return $s['shift'];
            }
        }
    }
    return "-";
}

// Cache Harga BBM untuk efisiensi loop
$harga_bbm = [];
$q_harga = mysql_query("SELECT jenis_transaksi, harga FROM data_jenis_transaksi");
while($h = mysql_fetch_array($q_harga)){
    $harga_bbm[strtoupper($h['jenis_transaksi'])] = $h['harga'];
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Rekap BBM</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 13px; margin: 30px; }
        table { border-collapse: collapse; width: 100%; margin: 15px 0; }
        th, td { border: 1px solid #000; padding: 8px; }
        th { background: #4c78a6; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .bold { font-weight: bold; }
        .bg-yellow { background: #ffffcc; }
        .mt30 { margin-top: 30px; }
        .ttd { width: 280px; display: inline-block; text-align: center; margin: 0 40px; }
    </style>
</head>
<body>

<!-- Kop Surat -->
<table style="width:100%; border:none;">
    <tr style="border:none;">
        <td width="110" style="border:none;"><img src="<?= $logo_laporan1 ?>" width="100" height="100"></td>
        <td style="font-size:20px; font-weight:bold; border:none;">PT. CAHAYA BUNGO SARKOPALMA</td>
    </tr>
</table>
<hr style='margin-bottom:20px'>
<div style="display:flex; justify-content:space-between; margin-bottom:20px;">
    <div>
        <table style="border:none;">
            <tr><td>Nomor</td><td>:</td><td>-</td></tr>
            <tr><td>Lampiran</td><td>:</td><td>-</td></tr>
            <tr><td>Perihal</td><td>:</td><td>Rekap Pengambilan BBM</td></tr>
        </table>
    </div>
    <div>
        <strong>Kepada yth;</strong><br>
        <?= $nama_relasi_filter ? $nama_relasi_filter : 'Semua Relasi' ?><br><br>
        <strong>Kabupaten Sarolangun</strong></div>
</div>

<p>Dengan Hormat,<br>
Bersama ini kami sampaikan rekap pengambilan BBM di SPBU <strong><?= htmlspecialchars($spbu) ?></strong>:</p>

<?php
// ================== BAGIAN FILTER ==================
$where = [];

// Filter jenis BBM
if (!empty($_GET['jenis_bbm']) && $_GET['jenis_bbm'] != 'semua') {
    $jenis_bbm = mysql_real_escape_string($_GET['jenis_bbm']);
    $where[] = "dtv.jenis_bbm = '$jenis_bbm'";
}

// Filter nominal
if (!empty($_GET['nominal']) && $_GET['nominal'] != 'semua') {
    $nominal = mysql_real_escape_string($_GET['nominal']);
    $where[] = "dtv.nominal = '$nominal'";
}

// Filter relasi
if (!empty($_GET['relasi'])) {
    $relasi = mysql_real_escape_string($_GET['relasi']);
    $where[] = "dv.id_relasi = '$relasi'";
}

// Filter pencarian bebas
if (!empty($_GET['isi'])) {
    $kolom = mysql_real_escape_string($_GET['Berdasarkan']);
    $isi   = mysql_real_escape_string($_GET['isi']);
    $where[] = "dtv.$kolom LIKE '%$isi%'";
    echo '<center class="mt30">Dicetak berdasarkan <b>'.$kolom.'</b> : <b>'.$isi.'</b></center><br>';
}

// Filter tanggal
if (!empty($_GET['tanggal1']) && !empty($_GET['tanggal2'])) {
    $tgl1 = mysql_real_escape_string($_GET['tanggal1']);
    $tgl2 = mysql_real_escape_string($_GET['tanggal2']);
    $where[] = "DATE(dtv.tanggal_transaksi) BETWEEN '$tgl1' AND '$tgl2'";
    echo '<center>Cetak Berdasarkan <b>tanggal_transaksi</b> Dari Tanggal <b>'.format_indo($tgl1).'</b> s/d <b>'.format_indo($tgl2).'</b></center><br>';
}

$where_clause = !empty($where) ? "WHERE " . implode(" AND ", $where) : "";

// QUERY UTAMA - Menampilkan transaksi detail, urut tanggal ASC
$query = "SELECT 
            dtv.*, 
            dv.id_voucher as vid, 
            dv.qrcode,
            dv.id_relasi
          FROM data_transaksi_voucher dtv
          LEFT JOIN data_voucher dv ON dtv.id_voucher = dv.id_voucher
          $where_clause
          ORDER BY dtv.tanggal_transaksi ASC";

$hasil = mysql_query($query) or die("Query error: " . mysql_error());

// Variabel untuk Summary
$summary = [
    'TURBO' => ['count'=>0, 'total'=>0, 'liter'=>0],
    'DEXLITE' => ['count'=>0, 'total'=>0, 'liter'=>0],
    'PERTAMAX' => ['count'=>0, 'total'=>0, 'liter'=>0],
    'PERTALITE' => ['count'=>0, 'total'=>0, 'liter'=>0],
];
$grand_total_nominal = 0;
$grand_total_count = 0;

?> 

<!-- TABEL TRANSAKSI DETAIL -->
<table>
    <thead style="background:#4a86e8; color:white;">
        <tr>
            <th>No</th>
            <th>Tanggal Transaksi</th>
            <th>Shift</th>
            <th>QR Code</th>
            <th>Nama Member / Supir</th>
            <th>Plat</th>
            <th>Nama Relasi</th>
            <th>Jenis BBM</th>
            <th>Nominal</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $no = 1;
        while ($r = mysql_fetch_array($hasil)): 
            // 1. Shift Logic
            $shift = get_shift($r['tanggal_transaksi'], $shifts);
            
            // 2. Plat Logic
            $plat = baca_database("","no_plat_kendaraan","SELECT no_plat_kendaraan FROM data_plat_kendaraan_transaksi_voucher WHERE id_transaksi_voucher='".$r['id_transaksi']."'");
            if(empty($plat)) $plat = "-";

            // 3. Nama Relasi
            $nama_relasi = baca_database("","nama","SELECT nama FROM data_relasi WHERE id_relasi='".$r['id_relasi']."'");

            // 4. Update Summary
            $jenis_upper = strtoupper($r['jenis_bbm']);
            $key_summary = "";
            if (strpos($jenis_upper, 'TURBO') !== false) $key_summary = 'TURBO';
            elseif (strpos($jenis_upper, 'DEXLITE') !== false) $key_summary = 'DEXLITE';
            elseif (strpos($jenis_upper, 'PERTAMAX') !== false) $key_summary = 'PERTAMAX';
            elseif (strpos($jenis_upper, 'PERTALITE') !== false) $key_summary = 'PERTALITE';

            // Hitung Liter
            $harga = isset($harga_bbm[$jenis_upper]) ? $harga_bbm[$jenis_upper] : 0;
            $liter = ($harga > 0) ? round($r['nominal'] / $harga, 2) : 0;

            if($key_summary != "") {
                $summary[$key_summary]['count']++;
                $summary[$key_summary]['total'] += $r['nominal'];
                $summary[$key_summary]['liter'] += $liter;
            }

            $grand_total_nominal += $r['nominal'];
            $grand_total_count++;
        ?>
            <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= format_indo($r['tanggal_transaksi']) ?> <?= date('H:i:s', strtotime($r['tanggal_transaksi'])) ?></td>
                <td class="text-center"><?= $shift ?></td>
                <td>ID<?= $r['id_voucher'] // Sesuai screenshot, pakai ID biasanya ?></td>
                <td><?= !empty($r['nama_member']) ? $r['nama_member'] : "" ?></td>
                <td><?= $plat ?></td>
                <td><?= $nama_relasi ?></td>
                <td><?= $r['jenis_bbm'] ?></td>
                <td class="text-right">Rp <?= number_format($r['nominal'], 0, ',', '.') ?></td>
            </tr>
        <?php endwhile; ?>
        
        <?php if ($grand_total_count == 0): ?>
            <tr><td colspan="9" class="text-center">Tidak ada data yang ditemukan</td></tr>
        <?php else: ?>
            <tr style="background:#f2f2f2; font-weight:bold;">
                <td colspan="8" class="text-right">Jumlah Voucher : <?= $grand_total_count ?></td>
                <td class="text-right">Rp <?= number_format($grand_total_nominal, 0, ',', '.') ?></td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- TABEL SUMMARY -->
<div class="mt30">
    <table style="width: 50%;">
        <?php foreach($summary as $key => $val): ?>
        <tr>
            <td style="border:none; border-bottom:1px solid #eee; padding:5px; font-weight:bold;"><?= $key ?></td>
            <td style="border:none; border-bottom:1px solid #eee; padding:5px;">:</td>
            <td style="border:none; border-bottom:1px solid #eee; padding:5px; text-align:right;"><?= $val['count'] ?> Transaksi</td>
            <td style="border:none; border-bottom:1px solid #eee; padding:5px;">Jumlah : Rp <?= number_format($val['total'], 0, ',', '.') ?> (<?= $val['liter'] ?> Liter)</td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<p class="mt30 bold" style="font-size:14px;">&bull;Summary Jumlah Transaksi per jenis BBM dan total liter.</p>

<div style="display:flex; justify-content:space-around; margin-top:80px;">
     <div style="text-align:right; width:100%;">
        Jambi, <?= format_indo(date('Y-m-d')) ?>
     </div>
</div>

</body>
</html>