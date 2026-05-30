<?php

function location()
{
    return "cetak";
}

include '../../../include/all_include.php';

if (isset($_GET['export'])) {
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=laporan_penjualan_pemakaian.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
}

// === HEADER LAPORAN ===

$id_admin = decrypt($_COOKIE['kodene']);
$nama_spbu = baca_database("", "nama_spbu", "SELECT * FROM data_admin WHERE id_admin='$id_admin'");
$alamat_spbu = baca_database("", "alamat1", "SELECT * FROM data_spbu WHERE nama_spbu LIKE '%$nama_spbu%'");

?>
<link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
<link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">
<style>
    .text-right { text-align: right; }
    .text-center { text-align: center; }
    .text-bold { font-weight: bold; }
    td, th { padding: 3px 6px; }
</style>

<?php
// === PARAMETER INPUT ===
$tanggal1 = isset($_GET['tanggal1']) ? mysql_real_escape_string($_GET['tanggal1']) : date('Y-m-01');
$tanggal2 = isset($_GET['tanggal2']) ? mysql_real_escape_string($_GET['tanggal2']) : date('Y-m-t');
$relasi   = isset($_GET['relasi'])   ? mysql_real_escape_string($_GET['relasi'])   : '';

$tanggal1_indo = format_indo($tanggal1);
$tanggal2_indo = format_indo($tanggal2);

// === HEADER ===
if (isset($_GET['export'])) { ?>
<table width="100%" border="0">
    <tr>
        <td colspan="7" align="center" class="auto-style1"><strong>PT. CAHAYA BUNGO SARKOPALMA</strong></td>
    </tr>
    <tr>
        <td colspan="7" align="center" class="auto-style2"><strong>LAPORAN PENJUALAN & PEMAKAIAN</strong></td>
    </tr>
    <tr>
        <td colspan="7" align="center">SPBU <?= $nama_spbu ?>, <?= $alamat_spbu ?></td>
    </tr>
</table>
<?php } else { ?>
<table border="0" style="width: 100%">
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
            <center><h2 class="auto-style1" style="margin:0px;">LAPORAN PENJUALAN & PEMAKAIAN</h2></center>
        </td>
    </tr>
    <tr>
        <td class="auto-style2">
            <center>SPBU <?= $nama_spbu ?>, <?= $alamat_spbu ?></center>
        </td>
    </tr>
</table>
<?php } ?>

<br>
<?php
$nm_relasi = '';
if ($relasi != '') {
    $nm_relasi = baca_database("", "nama", "SELECT nama FROM data_relasi WHERE id_relasi='$relasi'");
}
$label_relasi = $nm_relasi != '' ? $nm_relasi : 'Semua Relasi';
?>
<center>
    Laporan Relasi <b><?= $label_relasi ?></b>, Per Tanggal: <b><?= $tanggal1_indo ?></b> &mdash; <b><?= $tanggal2_indo ?></b>
</center>
<br>

<?php

// === QUERY PEMAKAIAN (TRANSAKSI BBM PER HARI) ===
$where_trans = [];
$where_trans[] = "DATE(dtv.tanggal_transaksi) >= '$tanggal1'";
$where_trans[] = "DATE(dtv.tanggal_transaksi) <= '$tanggal2'";
if ($relasi != '') {
    $where_trans[] = "dv.id_relasi = '$relasi'";
}
$where_trans_str = implode(" AND ", $where_trans);

$q_trans = mysql_query("
    SELECT 
        DATE(dtv.tanggal_transaksi) AS tgl,
        djt.jenis_transaksi AS jenis_bbm,
        SUM(dtv.nominal / NULLIF(dht.harga, 0)) AS total_liter
    FROM data_transaksi_voucher dtv
    LEFT JOIN data_voucher dv ON dtv.id_voucher = dv.id_voucher
    LEFT JOIN data_jenis_transaksi djt ON dtv.jenis_bbm = djt.id_jenis_transaksi
    LEFT JOIN data_harga_transaksi dht ON dht.id_jenis_transaksi = djt.id_jenis_transaksi
    WHERE $where_trans_str
    GROUP BY DATE(dtv.tanggal_transaksi), djt.jenis_transaksi
    ORDER BY DATE(dtv.tanggal_transaksi)
");

// Buat peta: [tanggal][nama_jenis_bbm] => total_liter
$pemakaian = [];
while ($row = mysql_fetch_assoc($q_trans)) {
    $pemakaian[$row['tgl']][$row['jenis_bbm']] = (float)$row['total_liter'];
}

// === QUERY PENJUALAN VOUCHER PER HARI ===
$where_jual = [];
$where_jual[] = "DATE(tanggal_penjualan) >= '$tanggal1'";
$where_jual[] = "DATE(tanggal_penjualan) <= '$tanggal2'";
if ($relasi != '') {
    $where_jual[] = "id_relasi = '$relasi'";
}
$where_jual_str = implode(" AND ", $where_jual);

$q_jual = mysql_query("
    SELECT 
        DATE(tanggal_penjualan) AS tgl,
        SUM(nominal) AS total_deposit
    FROM data_penjualan_voucher
    WHERE $where_jual_str
    GROUP BY DATE(tanggal_penjualan)
    ORDER BY DATE(tanggal_penjualan)
");

$deposit = [];
while ($row = mysql_fetch_assoc($q_jual)) {
    $deposit[$row['tgl']] = (float)$row['total_deposit'];
}

// === KUMPULKAN SEMUA TANGGAL YANG ADA DATA (transaksi OR penjualan) ===
$all_dates_set = array_unique(array_merge(array_keys($pemakaian), array_keys($deposit)));
sort($all_dates_set);

// === KOLOM BBM TETAP: urutan Turbo, Dexlite, Pertamax, Pertalite ===
$jenis_bbm_list = ['Turbo', 'Dexlite', 'Pertamax', 'Pertalite'];

// Total akumulasi
$total_per_bbm = array_fill_keys($jenis_bbm_list, 0);
$total_deposit_all = 0;

$is_export = isset($_GET['export']);
$border_attr = $is_export ? 'border="1" style="border-collapse:collapse;"' : 'class="tblcms2"';
?>

<!-- TABEL UTAMA -->
<table width="100%" <?= $border_attr ?>>
    <thead>
        <tr>
            <th class="text-center th_border cell">TANGGAL</th>
            <?php foreach ($jenis_bbm_list as $bbm): ?>
            <th class="text-center th_border cell"><?= strtoupper(htmlspecialchars($bbm)) ?></th>
            <?php endforeach; ?>
            <th class="text-center th_border cell">PENJUALAN</th>
        </tr>
    </thead>
    <tbody>
    <?php
    if (empty($all_dates_set)) {
        $total_cols = count($jenis_bbm_list) + 2; // TANGGAL + BBM + PENJUALAN
        echo '<tr><td colspan="' . $total_cols . '" class="text-center cell" style="padding:20px; color:#888; font-style:italic;">Tidak ada transaksi pemakaian maupun penjualan voucher pada periode ini.</td></tr>';
    }
    foreach ($all_dates_set as $tgl) {
        echo '<tr>';

        // Kolom Tanggal
        $tgl_display = date('d-M-y', strtotime($tgl));
        echo '<td class="cell text-center">' . $tgl_display . '</td>';

        // Kolom BBM
        foreach ($jenis_bbm_list as $bbm) {
            $liter = isset($pemakaian[$tgl][$bbm]) ? $pemakaian[$tgl][$bbm] : 0;
            $total_per_bbm[$bbm] += $liter;
            if ($liter > 0) {
                echo '<td class="cell text-right">' . number_format($liter, 0, ',', '.') . '</td>';
            } else {
                echo '<td class="cell text-center">-</td>';
            }
        }

        // Kolom Deposit
        $dep = isset($deposit[$tgl]) ? $deposit[$tgl] : 0;
        $total_deposit_all += $dep;
        if ($dep > 0) {
            echo '<td class="cell text-right">' . number_format($dep, 0, ',', '.') . '</td>';
        } else {
            echo '<td class="cell text-center">-</td>';
        }

        echo '</tr>';
    }
    ?>
    </tbody>

    <!-- BARIS TOTAL -->
    <tfoot>
        <tr>
            <th class="text-center th_border cell">TOTAL</th>
            <?php foreach ($jenis_bbm_list as $bbm): ?>
            <th class="text-right th_border cell">
                <?= $total_per_bbm[$bbm] > 0 ? number_format($total_per_bbm[$bbm], 0, ',', '.') : '-' ?>
            </th>
            <?php endforeach; ?>
            <th class="text-right th_border cell">
                <?= $total_deposit_all > 0 ? number_format($total_deposit_all, 0, ',', '.') : '-' ?>
            </th>
        </tr>
    </tfoot>
</table>
<br>

<!-- SUMMARY PER BBM -->
<?php
// Ambil harga BBM
$q_harga = mysql_query("
    SELECT djt.jenis_transaksi, dht.harga
    FROM data_harga_transaksi dht
    LEFT JOIN data_jenis_transaksi djt ON dht.id_jenis_transaksi = djt.id_jenis_transaksi
");
$harga_bbm = [];
while ($row = mysql_fetch_assoc($q_harga)) {
    $harga_bbm[$row['jenis_transaksi']] = (float)$row['harga'];
}

$grand_total = 0;
?>
<table width="60%" <?= $border_attr ?>>
    <thead>
        <tr>
            <th class="th_border cell">BBM</th>
            <th class="text-right th_border cell">Liter</th>
            <th class="th_border cell" colspan="2">Harga</th>
            <th class="th_border cell" colspan="2">Total</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($jenis_bbm_list as $bbm):
        $liter = $total_per_bbm[$bbm];
        $harga = isset($harga_bbm[$bbm]) ? $harga_bbm[$bbm] : 0;
        $ttl   = $liter * $harga;
        $grand_total += $ttl;
    ?>
        <tr>
            <td class="cell"><?= htmlspecialchars($bbm) ?></td>
            <td class="cell text-right"><?= number_format($liter, 0, ',', '.') ?></td>
            <td class="cell">Rp</td>
            <td class="cell text-right"><?= number_format($harga, 0, ',', '.') ?></td>
            <td class="cell">Rp</td>
            <td class="cell text-right"><?= $ttl > 0 ? number_format($ttl, 0, ',', '.') : '-' ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<br>

<!-- SUMMARY KEUANGAN -->
<?php
// Total Pemakaian = grand_total dari BBM summary
$total_pemakaian = $grand_total;

// Total Penjualan (dalam periode ini)
$total_penjualan_period = $total_deposit_all;

// Sisa Voucher = Penjualan - Pemakaian
$sisa_voucher = $total_penjualan_period - $total_pemakaian;
?>
<table width="60%" <?= $border_attr ?>>
    <colgroup>
        <col width="60%">
        <col width="10%">
        <col width="30%">
    </colgroup>
    <tbody>
        <tr>
            <td class="cell"><b>Total Penjualan</b></td>
            <td class="cell">Rp</td>
            <td class="cell" style="text-align:right;"><b><?= number_format($total_penjualan_period, 0, ',', '.') ?></b></td>
        </tr>
        <tr>
            <td class="cell"><b>Total Pemakaian</b></td>
            <td class="cell">Rp</td>
            <td class="cell" style="text-align:right;"><b><?= number_format($total_pemakaian, 0, ',', '.') ?></b></td>
        </tr>
        <tr>
            <td class="cell"><b>Sisa Voucher</b></td>
            <td class="cell">Rp</td>
            <td class="cell" style="text-align:right;"><b><?= number_format($sisa_voucher, 0, ',', '.') ?></b></td>
        </tr>
    </tbody>
</table>
<br><br>

<?php
// Ambil data TTD admin yang login
$jenenge = decrypt($_COOKIE['jenenge']);
$jabatan_ttd = baca_database("", "jabatan", "SELECT * FROM data_admin WHERE username='$jenenge'");
$nama_ttd    = baca_database("", "nama",    "SELECT * FROM data_admin WHERE username='$jenenge'");
$foto_ttd    = baca_database("", "foto_tanda_tangan", "SELECT * FROM data_admin WHERE username='$jenenge'");

$path_ttd = __DIR__ . '/../../../include/../../../cbs-indo-membercard/admin/upload/' . $foto_ttd;
if (file_exists($path_ttd) && !empty($foto_ttd)) {
    $type_ttd = pathinfo($path_ttd, PATHINFO_EXTENSION);
    $data_ttd = file_get_contents($path_ttd);
    $src_ttd  = 'data:image/' . $type_ttd . ';base64,' . base64_encode($data_ttd);
} else {
    $src_ttd  = pengaturan("url_smc") . "admin/upload/" . $foto_ttd;
}
?>
<?php if ($is_export):
    // Jumlah kolom total: TANGGAL + (BBM) + PENJUALAN
    $total_cols_main = count($jenis_bbm_list) + 2;
    $left_cols = $total_cols_main - 1; // kolom kosong kiri
?>
<table border="0">
    <tr>
        <td colspan="<?= $left_cols ?>">&nbsp;</td>
        <td align="center">
            Sarolangun, <?= format_indo(date('Y-m-d')) ?><br><br>
            <img width="150" height="80" style="object-fit:contain;" src="<?= $src_ttd ?>"><br>
            <strong><?= ucwords($nama_ttd) ?></strong><br>
            <?= ucwords($jabatan_ttd) ?>
        </td>
    </tr>
</table>
<?php else: ?>
<div style="width:250px; margin-left:auto; text-align:center; margin-top:10px;">
    Sarolangun, <?= format_indo(date('Y-m-d')) ?><br><br>
    <img width="150" height="80" style="object-fit:contain;" src="<?= $src_ttd ?>"><br>
    <strong><?= ucwords($nama_ttd) ?></strong><br>
    <?= ucwords($jabatan_ttd) ?>
</div>
<?php endif; ?>


