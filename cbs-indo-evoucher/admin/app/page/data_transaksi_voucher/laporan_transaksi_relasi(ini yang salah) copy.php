<?php
// include '../../../include/koneksi/koneksi.php';  // pastikan sudah mysql_connect & mysql_select_db
// include '../../../include/function/all.php';

// === AMBIL DATA ADMIN ===
$username = decrypt($_COOKIE['jenenge']);
$id_admin = baca_database("","id_admin","SELECT * FROM data_admin WHERE username='$username'");
$nama     = baca_database("","nama","SELECT * FROM data_nama_admin WHERE id_admin='$id_admin'");
$jabatan  = baca_database("","hak_akses","SELECT * FROM data_admin WHERE username='$username'");
$spbu     = baca_database("","nama_spbu","SELECT * FROM data_admin WHERE username='$username'");
$alamat1  = baca_database("","alamat1","SELECT * FROM data_spbu WHERE nama_spbu='$spbu'");
$id_relasi=isset($_GET['relasi'])?$_GET['relasi']:'';
$nama=baca_database("","nama","select * from data_relasi where id_relasi='$id_relasi'");
// $logo_laporan1 = "assets/logo.png"; // sesuaikan
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Rekap BBM</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 13px; margin: 30px; }
        table { border-collapse: collapse; width: 100%; margin: 15px 0; }
        th, td { border: 1px solid #000; padding: 8px; }
        th { background: #f0f0f0; }
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
        <?= $nama?><br><br>
        <strong>Kabupaten Sarolangun</strong></div>
</div>

<p>Dengan Hormat,<br>
Bersama ini kami sampaikan rekap pengambilan BBM di SPBU <strong><?= htmlspecialchars($spbu) ?></strong>:</p>

<?php
// ================== BAGIAN FILTER (PAKAI mysql_real_escape_string) ==================
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
    echo '<center>Periode: <b>'.format_indo($tgl1).'</b> s/d <b>'.format_indo($tgl2).'</b></center><br>';
}

$where_clause = !empty($where) ? "WHERE " . implode(" AND ", $where) : "";

// QUERY UTAMA (SUDAH GROUP BY TANGGAL + JENIS BBM)
$query = "SELECT 
            DATE(dtv.tanggal_transaksi) as tgl,
            dtv.jenis_bbm,dtv.nominal
          FROM data_transaksi_voucher dtv
          LEFT JOIN data_voucher dv ON dtv.id_voucher = dv.id_voucher
          $where_clause
          GROUP BY DATE(dtv.tanggal_transaksi), dtv.jenis_bbm
          ORDER BY tgl ASC";

$hasil = mysql_query($query) or die("Query error: " . mysql_error());

// Proses hasil ke array
$data_per_tanggal = array();
while ($r = mysql_fetch_array($hasil)) {
    $tgl = $r['tgl'];
    $jenis = $r['jenis_bbm'];
    $q_detail=mysql_query("SELECT * FROM data_transaksi_voucher where jenis_bbm='$jenis' AND DATE(tanggal_transaksi)='$tgl'");
    $nominal=0;
    while($d_detail=mysql_fetch_array($q_detail)){
        $nominal+=$d_detail['nominal'];
    }
    $harga_perliter=baca_database("","harga","select * from data_jenis_transaksi where jenis_transaksi='$jenis'");
    $liter = round($nominal/$harga_perliter,2); 

    if (!isset($data_per_tanggal[$tgl])) {
        $data_per_tanggal[$tgl] = array(
            'Dexlite' => 0, 'Pertalite' => 0, 'Turbo' => 0, 'Pertamax' => 0, 'Deposit' => 0
        );
    }

    // Mapping jenis BBM
    if (stripos($jenis, 'dexlite') !== false)     $data_per_tanggal[$tgl]['Dexlite'] += $liter;
    elseif (stripos($jenis, 'pertalite') !== false) $data_per_tanggal[$tgl]['Pertalite'] += $liter;
    elseif (stripos($jenis, 'turbo') !== false)   $data_per_tanggal[$tgl]['Turbo'] += $liter;
    elseif (stripos($jenis, 'pertamax') !== false)$data_per_tanggal[$tgl]['Pertamax'] += $liter;

    $data_per_tanggal[$tgl]['Deposit'] += $deposit;
}

// Grand total
$grand = array('Dexlite'=>0, 'Pertalite'=>0, 'Turbo'=>0, 'Pertamax'=>0, 'Deposit'=>0);
foreach ($data_per_tanggal as $harian) {
    foreach ($harian as $jenis => $nilai) {
        $grand[$jenis] += $nilai;
    }
}

?> 
<!-- TABEL REKAP HARIAN -->
<table>
    <thead style="background:#e0e0e0">
        <tr>
            <th width="15%">Tanggal</th>
            <th>Dexlite</th>
            <th>Pertalite</th>
            <th>Turbo</th>
            <th>Pertamax</th>
            <th>Deposit</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data_per_tanggal as $tgl => $harian): ?>
            <tr>
                <td class="bold"><?= format_indo($tgl) ?></td>
                <td class="text-right"><?= number_format($harian['Dexlite']) ?></td>
                <td class="text-right"><?= number_format($harian['Pertalite']) ?></td>
                <td class="text-right"><?= number_format($harian['Turbo']) ?></td>
                <td class="text-right"><?= number_format($harian['Pertamax']) ?></td>
                <td class="text-right"><?= number_format($harian['Deposit']) ?></td>
            </tr>
        <?php endforeach; ?>

        <?php if (empty($data_per_tanggal)): ?>
            <tr><td colspan="6" class="text-center">Tidak ada data yang ditemukan</td></tr>
        <?php else: ?>
            <tr class="bg-yellow bold">
                <td>TOTAL</td>
                <td class="text-right"><?= number_format($grand['Dexlite']) ?></td>
                <td class="text-right"><?= number_format($grand['Pertalite']) ?></td>
                <td class="text-right"><?= number_format($grand['Turbo']) ?></td>
                <td class="text-right"><?= number_format($grand['Pertamax']) ?></td>
                <td class="text-right"><?= number_format($grand['Deposit']) ?></td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- RINGKASAN -->
<div class="mt30">
    <table width="65%">
        <thead style="background:#ddd">
            <tr><th>BBM</th><th>Liter</th><th>Harga/Liter</th><th>Total Rupiah</th></tr>
        </thead>
        <tbody>
            <?php
            $harga = array(
                'Dexlite'   => (int)baca_database("","harga","SELECT harga FROM data_jenis_bbm WHERE LOWER(jenis) LIKE '%dexlite%' ORDER BY id DESC LIMIT 1") ?: 13500,
                'Pertalite' => (int)baca_database("","harga","SELECT harga FROM data_jenis_bbm WHERE LOWER(jenis) LIKE '%pertalite%' ORDER BY id DESC LIMIT 1") ?: 10000,
                'Turbo'     => (int)baca_database("","harga","SELECT harga FROM data_jenis_bbm WHERE LOWER(jenis) LIKE '%turbo%' ORDER BY id DESC LIMIT 1") ?: 16500,
                'Pertamax'  => (int)baca_database("","harga","SELECT harga FROM data_jenis_bbm WHERE LOWER(jenis) LIKE '%pertamax%' ORDER BY id DESC LIMIT 1") ?: 14500,
            );
            ?>
            <tr><td>Dexlite</td>   <td class="text-right"><?=number_format($grand['Dexlite'])?></td>   <td class="text-right"><?=number_format($harga['Dexlite'])?></td>   <td class="text-right"><?=number_format($grand['Dexlite']*$harga['Dexlite'])?></td></tr>
            <tr><td>Pertalite</td> <td class="text-right"><?=number_format($grand['Pertalite'])?></td> <td class="text-right"><?=number_format($harga['Pertalite'])?></td> <td class="text-right"><?=number_format($grand['Pertalite']*$harga['Pertalite'])?></td></tr>
            <tr><td>Turbo</td>     <td class="text-right"><?=number_format($grand['Turbo'])?></td>     <td class="text-right"><?=number_format($harga['Turbo'])?></td>     <td class="text-right"><?=number_format($grand['Turbo']*$harga['Turbo'])?></td></tr>
            <tr><td>Pertamax</td>  <td class="text-right"><?=number_format($grand['Pertamax'])?></td>  <td class="text-right"><?=number_format($harga['Pertamax'])?></td>  <td class="text-right"><?=number_format($grand['Pertamax']*$harga['Pertamax'])?></td></tr>
        </tbody>
    </table>
</div>

<div style="margin-top:40px">
    <table>
        <tr>
            <td>Total Pengambilan</td>
            
            <td></td>
        </tr>
        <tr>
            <td>Saldo Awal</td>
            
            <td></td>
        </tr>
        <tr>
            <td>Deposit</td>
            
            <td></td>
        </tr>
        <tr>
            <td>Saldo Akhir</td>
           
            <td></td>
        </tr>
    </table>
</div>
<p class="mt30">Demikian laporan ini kami sampaikan, atas perhatiannya kami ucapkan terima kasih.</p>

<div style="display:flex; justify-content:space-around; margin-top:80px;">
    <div class="ttd">
        Sarolangun, <?= date('d F Y') ?><br>
        <b>PT. CAHAYA BUNGO SARKOPALMA</b><br><br><br><br>
        <u><?= htmlspecialchars($nama) ?></u><br>
        <i><?= htmlspecialchars($jabatan) ?></i>
    </div>
    <div class="ttd">
        Sarolangun, <?= date('d F Y') ?><br>
        <b>PT. CAHAYA BUNGO SARKOPALMA</b><br><br><br><br>
        <u>_________________________</u><br>
        <i>Manager SPBU</i>
    </div>
</div>

</body>
</html>