<?php
include '../../../include/all_include.php';
$username = decrypt($_COOKIE['jenenge']);
$id_admin = baca_database("","id_admin","select * from data_admin where username='$username'");
$nama     = baca_database("","nama","select * from data_nama_admin where id_admin='$id_admin'");
$jabatan  = baca_database("","hak_akses","select * from data_admin where username='$username'");
$spbu     = baca_database("","nama_spbu","select * from data_admin where username='$username'");
$alamat1  = baca_database("","alamat1","select * from data_spbu where nama_spbu='$spbu'");

// Tangkap semua parameter
$isi         = isset($_GET['isi']) ? $_GET['isi'] : '';
$Berdasarkan = isset($_GET['Berdasarkan']) ? $_GET['Berdasarkan'] : '';
$tanggal1    = isset($_GET['tanggal1']) ? $_GET['tanggal1'] : '';
$tanggal2    = isset($_GET['tanggal2']) ? $_GET['tanggal2'] : '';
$jenis_bbm   = isset($_GET['jenis_bbm']) ? $_GET['jenis_bbm'] : '';
$nominal     = isset($_GET['nominal']) ? $_GET['nominal'] : '';
$relasi      = isset($_GET['relasi']) ? $_GET['relasi'] : '';

// Bangun query (LOGIKA SAMA PERSIS seperti preview)
$querytabel = "SELECT dtv.*, dv.id_relasi 
               FROM data_transaksi_voucher dtv
               LEFT JOIN data_voucher dv ON dtv.id_voucher = dv.id_voucher
               WHERE 1=1";

if ($isi != '' && $Berdasarkan != '') {
    $isi = mysql_real_escape_string($isi);
    $Berdasarkan = mysql_real_escape_string($Berdasarkan);
    $querytabel .= " AND dtv.$Berdasarkan LIKE '%$isi%'";
    $info_cetak = "Berdasarkan <b>$Berdasarkan</b> : <b>$isi</b>";
} elseif ($tanggal1 != '' && $tanggal2 != '') {
    $tanggal1 = mysql_real_escape_string($tanggal1);
    $tanggal2 = mysql_real_escape_string($tanggal2);
    $querytabel .= " AND dtv.tanggal_transaksi >= '$tanggal1' 
                     AND dtv.tanggal_transaksi < DATE_ADD('$tanggal2', INTERVAL 1 DAY)";
    $info_cetak = "Periode <b>".format_indo($tanggal1)."</b> s/d <b>".format_indo($tanggal2)."</b>";
} else {
    $info_cetak = "Semua Data";
}

// Filter tambahan
if ($jenis_bbm != '') $querytabel .= " AND dtv.jenis_bbm = '$jenis_bbm'";
if ($nominal != '')   $querytabel .= " AND dtv.nominal = '$nominal'";
if ($relasi != '')    $querytabel .= " AND dv.id_relasi = '$relasi'";

$proses = mysql_query($querytabel);

// Hitung total + ringkasan BBM
$total = 0;
$TURBO=$DEXLITE=$PERTAMAX=$PERTALITE=0;
$JML_TURBO=$JML_DEXLITE=$JML_PERTAMAX=$JML_PERTALITE=0;

$no = 0;
while ($data = mysql_fetch_array($proses)) {
    $no++;
    $total += $data['nominal'];

    // Logika jenis BBM (sama persis)
    $jenis = QB::table("data_jenis_transaksi")->where("id_jenis_transaksi", $data['jenis_bbm'])->first();
    $jenis_bbm_name = $jenis ? $jenis->jenis_transaksi : $data['jenis_bbm'];

    if ($jenis_bbm_name == "TURBO")     { $TURBO++;     $JML_TURBO += $data['nominal']; }
    if ($jenis_bbm_name == "DEXLITE")   { $DEXLITE++;   $JML_DEXLITE += $data['nominal']; }
    if ($jenis_bbm_name == "PERTAMAX")  { $PERTAMAX++;  $JML_PERTAMAX += $data['nominal']; }
    if ($jenis_bbm_name == "PERTALITE") { $PERTALITE++; $JML_PERTALITE += $data['nominal']; }
}

// Simpan jumlah record
$jumlah_record = $no;

// Reset pointer biar bisa dipakai lagi
mysql_data_seek($proses, 0);
