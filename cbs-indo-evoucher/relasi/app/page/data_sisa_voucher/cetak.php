<?php
function location() {
    return "cetak";
}

include '../../../include/all_include.php';
proses_action_cetak("data_sisa_voucher");
?>
<link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
<link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">

<!-- HEADER (DESAIN LAMA) -->
    <!-- HEADER -->
    <table border="0" style="width: 100%">
        <?php if (isset($_GET['export'])) { ?>
            <tr>
                <td colspan="7" align="center" class="auto-style1">
                    <center>
                        <strong>PT. CAHAYA BUNGO SARKOPALMA</strong>
                    </center>
                </td>
            </tr>
            <tr>
                <td colspan="7" align="center" class="auto-style2">
                    <center>
                        <h2 style="margin: 0px;" class="auto-style1">LAPORAN SISA TRANSAKSI E-VOUCHER</h2>
                    </center>
                </td>
            </tr>
            <tr>
                <td colspan="7" align="center" class="auto-style2">
                    <center>SPBU <?php 
                    $id_relasi = decrypt($_COOKIE['kodene']);
                    $id_spbu = baca_database("", "id_spbu", "SELECT * FROM data_relasi WHERE id_relasi='$id_relasi'");
                    $nama_spbu = baca_database("", "nama_spbu", "SELECT * FROM data_spbu WHERE id_spbu='$id_spbu'");
                    echo $nama_spbu . ", ";
                    echo baca_database("", "alamat1", "SELECT * FROM data_spbu WHERE id_spbu='$id_spbu'");
                    ?></center>
                </td>
            </tr>
        <?php } else { ?>
            <tr>
                <td class="auto-style1" rowspan="3" width="101">
                    <img alt="" height="100" src="<?php echo $logo_laporan1; ?>" width="100">
                </td>
                <td class="auto-style1">
                    <center>
                        <strong>PT. CAHAYA BUNGO SARKOPALMA</strong>
                    </center>
                </td>
                <td class="auto-style1" rowspan="3" width="101">
                    <img alt="" height="100" src="<?php echo $logo_laporan2; ?>" width="100">
                </td>
            </tr>
            <tr>
                <td class="auto-style2">
                    <center><h2 class="auto-style1" style="margin: 0px;">LAPORAN SISA TRANSAKSI E-VOUCHER</h2></center>
                </td>
            </tr>
            <tr>
                <td class="auto-style2">
                    <center>SPBU <?php 
                    $id_relasi = decrypt($_COOKIE['kodene']);
                    $id_spbu = baca_database("", "id_spbu", "SELECT * FROM data_relasi WHERE id_relasi='$id_relasi'");
                    $nama_spbu = baca_database("", "nama_spbu", "SELECT * FROM data_spbu WHERE id_spbu='$id_spbu'");
                    echo $nama_spbu . ", ";
                    echo baca_database("", "alamat1", "SELECT * FROM data_spbu WHERE id_spbu='$id_spbu'");
                    ?></center>
                </td>
            </tr>
        <?php } ?>
    </table>
    <!-- HEADER -->

<?php
// =================== PROSES FILTER ===================
$querytabel = "SELECT * FROM data_sisa_voucher WHERE 1=1";
$filter_text = "";
$ada_filter_relasi = false;

// Filter Tanggal
if (!empty($_GET['tanggal1']) && !empty($_GET['tanggal2'])) {
    $tanggal1 = $_GET['tanggal1']; // misal: 2026-01-01
    $tanggal2 = $_GET['tanggal2']; // misal: 2026-01-03
    
    // Ubah jadi include seluruh hari tanggal2 dengan tambah 23:59:59
    $querytabel .= " AND tanggal_transaksi >= '$tanggal1' AND tanggal_transaksi <= '$tanggal2 23:59:59'";
    
    $filter_text .= "Periode: " . format_indo($tanggal1) . " s/d " . format_indo($tanggal2);
}

// Filter Nominal Voucher
if (!empty($_GET['nominal'])) {
    $nominal = intval($_GET['nominal']);
    $querytabel .= " AND nominal_voucher = $nominal";
    if (!empty($filter_text)) $filter_text .= " | ";
    $filter_text .= "Nominal Voucher: Rp " . number_format($nominal);
}

// Filter Relasi
if (!empty($_GET['relasi'])) {
    $id_relasi = $_GET['relasi'];
    $querytabel .= " AND id_relasi = '$id_relasi'";
    
    $nama_relasi = baca_database("", "nama", "SELECT * FROM data_relasi WHERE id_relasi = '$id_relasi'");
    if (empty($nama_relasi)) $nama_relasi = "Tidak Diketahui";
    
    if (!empty($filter_text)) $filter_text .= " | ";
    $filter_text .= "Relasi: " . $nama_relasi;
    
    $ada_filter_relasi = true;
}

// Jika tidak ada filter
if (empty($filter_text)) {
    $filter_text = "Semua Data";
}

// Eksekusi query
$proses = mysql_query($querytabel);
$total_data = mysql_num_rows($proses);

// Hitung total sisa + kumpulkan per relasi jika relasi TIDAK difilter
$total_sisa_keseluruhan = 0;
$sisa_per_relasi = array(); // format: [id_relasi => ['nama' => ..., 'total_sisa' => ...]]

if ($total_data > 0) {
    while ($data = mysql_fetch_array($proses)) {
        $sisa = (int)$data['nominal_sisa'];
        $total_sisa_keseluruhan += $sisa;

        if (!$ada_filter_relasi) {
            $id_rel = $data['id_relasi'];
            $nama_rel = baca_database("", "nama", "SELECT * FROM data_relasi WHERE id_relasi = '$id_rel'");
            if (empty($nama_rel)) $nama_rel = "Tidak Diketahui";

            if (!isset($sisa_per_relasi[$id_rel])) {
                $sisa_per_relasi[$id_rel] = array('nama' => $nama_rel, 'total_sisa' => 0);
            }
            $sisa_per_relasi[$id_rel]['total_sisa'] += $sisa;
        }
    }
    mysql_data_seek($proses, 0); // reset untuk loop tabel
}
?>

<!-- INFORMASI FILTER -->
<table width="100%" border="0"  >
    <tr>
        <td style="text-align: center; font-size: 14px;">
            <?php echo $filter_text; ?> 
            
        </td>
    </tr>
</table>

<!-- TABEL DATA -->
<table width="100%" class="tblcms2">
    <tr>
        <th class="th_border cell">No</th>
        <th align="center" class="th_border cell">ID Voucher</th>
        <th align="center" class="th_border cell">Relasi</th>
        <th align="center" class="th_border cell">Tanggal</th>
        <th align="center" class="th_border cell">Nominal Voucher</th>
        <th align="center" class="th_border cell">Nominal Transaksi</th>
        <th align="center" class="th_border cell">Nominal Sisa</th>
    </tr>

    <tbody>
        <?php if ($total_data > 0) { 
            $no = 0;
            while ($data = mysql_fetch_array($proses)) {
                $no++;
        ?>
                <tr class="event2">
                    <td align="center" width="50"><?php echo $no; ?></td>
                    <td align="center"><?php echo $data["id_voucher"]; ?></td>
                    <td align="center"><?php echo baca_database("","nama","SELECT * FROM data_relasi WHERE id_relasi='{$data['id_relasi']}'"); ?></td>
                    <td align="center"><?php echo format_indo($data["tanggal_transaksi"]); ?></td>
                    <td align="right"><?php echo rupiah($data["nominal_voucher"]); ?></td>
                    <td align="right"><?php echo rupiah($data["nominal_transaksi"]); ?></td>
                    <td align="right"><?php echo rupiah($data["nominal_sisa"]); ?></td>
                </tr>
        <?php 
            }
        } else { ?>
            <tr>
                <td colspan="7" align="center" style="padding: 15px; color: #888;">Data tidak ditemukan sesuai filter.</td>
            </tr>
        <?php } ?>
        
        <!-- TOTAL KESELURUHAN -->
        <tr style="background-color: #f0f0f0; font-weight: bold; font-size: 14px;">
            <td colspan="6" align="right" style="padding: 12px;">TOTAL NOMINAL SISA:</td>
            <td align="right" style="padding: 12px;"><?php echo rupiah($total_sisa_keseluruhan); ?></td>
        </tr>
    </tbody>
</table>

<?php
// SUMMARY PER RELASI - HANYA JIKA RELASI TIDAK DIFILTER DAN ADA DATA
if (!$ada_filter_relasi && !empty($sisa_per_relasi)) {
?>

 <table border="0" style="border: 0px solid #ddd;width: 100%">
            <tr>
                <td>


Summary Jumlah Sisa Voucher per Relasi <br><br>

<table style="width: 50%;  border-collapse: collapse; font-size: 14px;">
    <tbody>
        <?php 
        foreach ($sisa_per_relasi as $rel) {
            if ($rel['total_sisa'] > 0) { // hanya tampilkan yang ada sisa
        ?>
        <tr>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;"><strong><?php echo htmlspecialchars($rel['nama']); ?></strong></td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd;">:</td>
            <td style="padding: 8px; border-bottom: 1px solid #ddd; text-align: right; font-weight: bold;"><?php echo rupiah($rel['total_sisa']); ?></td>
        </tr>
        <?php 
            }
        } 
        ?>
        <tr style="background-color: #e9e9e9; font-weight: bold; ">
            <td style="padding: 10px; text-align: left;">GRAND TOTAL</td>
             <td style="padding: 8px; border-bottom: 1px solid #ddd;">:</td>
            <td style="padding: 10px; text-align: right;"><?php echo rupiah($total_sisa_keseluruhan); ?></td>
        </tr>
    </tbody>
</table>
                </td>

                 <td>


                </td>

            </tr>
        </table>

<?php } ?>


    <table width="100%" style="border: 0px solid #ddd;" >
        <tbody>
            <tr>
                <td width="80%"></td>
                <td style="align-content: baseline;">
                    <?php  ttd();?>
                </td>
            </tr>
        </tbody>
    </table>
