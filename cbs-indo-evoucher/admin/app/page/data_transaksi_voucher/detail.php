<?php
/* ================== DATA UTAMA ================== */
if (isset($_GET['proses'])) {
    $id = decrypt(mysql_real_escape_string($_GET['proses']));
    $q = mysql_query("SELECT * FROM data_transaksi_voucher WHERE id_transaksi='$id'");
} else {
    $id = mysql_real_escape_string($_GET['id_voucher']);
    $q = mysql_query("SELECT * FROM data_transaksi_voucher WHERE id_voucher='$id'");
}
$data = mysql_fetch_array($q);

/* Plat & Supir */
$q_plat = mysql_fetch_array(mysql_query("
    SELECT * FROM data_plat_kendaraan_transaksi_voucher
    WHERE id_transaksi_voucher='$data[id_transaksi]'
"));

$q_supir = mysql_fetch_array(mysql_query("
    SELECT * FROM data_supir WHERE id_supir='$q_plat[id_supir]'
"));

$q_relasi = mysql_fetch_array(mysql_query("
    SELECT * FROM data_relasi WHERE id_relasi='$q_plat[id_relasi]'
"));

/* ================== FILTER TANGGAL ================== */
$tgl_awal  = isset($_GET['tgl_awal']) ? $_GET['tgl_awal'] : date('Y-m-01');
$tgl_akhir = isset($_GET['tgl_akhir']) ? $_GET['tgl_akhir'] : date('Y-m-d');

/* ================== RIWAYAT SUPIR ================== */
$q_supir_trx = mysql_query("
    SELECT t.*
    FROM data_transaksi_voucher t
    JOIN data_plat_kendaraan_transaksi_voucher p
        ON t.id_transaksi = p.id_transaksi_voucher
    WHERE p.id_supir = '$q_plat[id_supir]'
    AND DATE(t.tanggal_transaksi)
        BETWEEN '$tgl_awal' AND '$tgl_akhir'
    ORDER BY t.tanggal_transaksi DESC
");

/* ================== RIWAYAT PLAT ================== */
$q_plat_trx = mysql_query("
    SELECT t.*
    FROM data_transaksi_voucher t
    JOIN data_plat_kendaraan_transaksi_voucher p
        ON t.id_transaksi = p.id_transaksi_voucher
    WHERE p.no_plat_kendaraan = '$q_plat[no_plat_kendaraan]'
    AND DATE(t.tanggal_transaksi)
        BETWEEN '$tgl_awal' AND '$tgl_akhir'
    ORDER BY t.tanggal_transaksi DESC
");


$nominal_voucher = baca_database("", "nominal_voucher", "select * from data_sisa_voucher where id_voucher='$id'");
$nominal_transaksi = baca_database("", "nominal_transaksi", "select * from data_sisa_voucher where id_voucher='$id'");
$nominal_sisa = baca_database("", "nominal_sisa", "select * from data_sisa_voucher where id_voucher='$id'");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Detail Transaksi Voucher</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
body{
    background:#eef2f7;
    font-family:'Segoe UI',sans-serif;
    padding:25px;
}

/* CARD */
.card-transaksi{
    max-width:1100px;
    margin:auto;
    background:#fff;
    border-radius:22px;
    padding:30px;
    box-shadow:0 20px 40px rgba(0,0,0,.08);
}

/* HEADER */
.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}
.header h1{margin:0;font-size:22px}
.bbm-pill{
    background:linear-gradient(135deg,#38a2f7,#5ccece);
    color:#fff;
    padding:8px 18px;
    border-radius:30px;
    font-size:13px;
}

/* GRID INFO */
.grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(230px,1fr));
    gap:18px;
}
.box{
    background:#f8f9fb;
    border-radius:16px;
    padding:18px;
    display:flex;
    gap:14px;
}
.box:hover{
    transform:translateY(-3px);
    box-shadow:0 12px 25px rgba(0,0,0,.08);
}
.icon{
    width:46px;height:46px;
    border-radius:14px;
    display:flex;
    align-items:center;
    justify-content:center;
    background:#e7f1ff;
    color:#0d6efd;
    font-size:20px;
}
.label{font-size:12px;color:#6c757d}
.value{font-size:15px;font-weight:600}

/* HIGHLIGHT */
.highlight{
    grid-column:span 2;
    background:linear-gradient(135deg,#38a2f7,#5ccece);
    color:#fff;
}
.highlight .icon{
    background:rgba(255,255,255,.25);
    color:#fff;
}
.highlight .label{color:rgba(255,255,255,.8)}

/* SECTION */
.section{
    margin-top:45px;
}
.section-title{
    font-size:18px;
    font-weight:600;
    margin-bottom:15px;
    display:flex;
    align-items:center;
    gap:10px;
}

/* FILTER */
.filter-box{
    display:flex;
    gap:10px;
    margin-bottom:20px;
}
.filter-box input{
    padding:8px 12px;
    border-radius:10px;
    border:1px solid #ddd;
}
.filter-box button{
    border:none;
    cursor:pointer;
}

/* LIST TRANSAKSI */
.transaksi-list{
    display:grid;
    gap:14px;
}
.trx-item{
    background:#f8f9fb;
    border-radius:14px;
    padding:16px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}
.trx-left{
    display:flex;
    gap:14px;
    align-items:center;
}
.trx-icon{
    width:42px;height:42px;
    border-radius:12px;
    background:#e7f1ff;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#0d6efd;
}
.trx-date{font-size:12px;color:#6c757d}
.trx-amount{font-weight:600;color:#198754}

@media(max-width:600px){
    .highlight{grid-column:span 1}
}
</style>
</head>

<body>

<div class="card-transaksi">

    <!-- HEADER -->
    <div class="header">
        <h1><i class="fa-solid fa-receipt"></i> Detail Transaksi Voucher</h1>
        <div class="bbm-pill">
            <i class="fa-solid fa-gas-pump"></i>
            <?php echo $data['jenis_bbm']; ?>
        </div>
    </div>

    <!-- INFO UTAMA -->
    <div class="grid">
        <div class="box highlight">
            <div class="icon"><i class="fa-solid fa-money-bill-wave"></i></div>
            <div>
                <div class="label">Nominal Voucher</div>
                <div class="value"><?php echo rupiah($nominal_voucher); ?></div>
            </div>
        </div>

         <div class="box ">
            <div class="icon"><i class="fa-solid fa-money-bill-wave"></i></div>
            <div>
                <div class="label">Digunakan</div>
                <div class="value"><?php echo rupiah($nominal_transaksi); ?></div>
            </div>
        </div>

        <div class="box ">
            <div class="icon"><i class="fa-solid fa-money-bill-wave"></i></div>
            <div>
                <div class="label">Sisa</div>
                <div class="value"><?php echo rupiah($nominal_sisa); ?></div>
            </div>
        </div>

        <div class="box">
            <div class="icon"><i class="fa-solid fa-calendar-day"></i></div>
            <div>
                <div class="label">Tanggal</div>
                <div class="value"><?php echo $data['tanggal_transaksi']; ?></div>
            </div>
        </div>

        <div class="box">
            <div class="icon"><i class="fa-solid fa-id-card"></i></div>
            <div>
                <div class="label">Supir</div>
                <div class="value"><?php echo $q_supir['nama_supir']; ?></div>
            </div>
        </div>

        <div class="box">
            <div class="icon"><i class="fa-solid fa-car"></i></div>
            <div>
                <div class="label">Plat</div>
                <div class="value">
                    <?php
                    echo baca_database("","plat",
                        "select * from data_plat where id_plat='$q_plat[no_plat_kendaraan]'"
                    );
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- RIWAYAT SUPIR -->
    <div class="section">
        <div class="section-title">
            <i class="fa-solid fa-id-card"></i> Riwayat Transaksi Supir
        </div>


        <div class="transaksi-list">
            <?php while($r=mysql_fetch_array($q_supir_trx)){ ?>
            <div class="trx-item">
                <div class="trx-left">
                    <div class="trx-icon"><i class="fa-solid fa-gas-pump"></i></div>
                    <div>
                        <strong><?php echo $r['jenis_bbm']; ?></strong>
                        <div class="trx-date"><?php echo $r['tanggal_transaksi']; ?></div>
                    </div>
                </div>
                <div class="trx-amount"><?php echo rupiah($r['nominal']); ?></div>
            </div>
            <?php } ?>
        </div>
    </div>

    <!-- RIWAYAT PLAT -->
    <div class="section">
        <div class="section-title">
            <i class="fa-solid fa-car"></i> Riwayat Transaksi Plat Kendaraan
        </div>

        <div class="transaksi-list">
            <?php while($r=mysql_fetch_array($q_plat_trx)){ ?>
            <div class="trx-item">
                <div class="trx-left">
                    <div class="trx-icon"><i class="fa-solid fa-gas-pump"></i></div>
                    <div>
                        <strong><?php echo $r['jenis_bbm']; ?></strong>
                        <div class="trx-date"><?php echo $r['tanggal_transaksi']; ?></div>
                    </div>
                </div>
                <div class="trx-amount"><?php echo rupiah($r['nominal']); ?></div>
            </div>
            <?php } ?>
        </div>
    </div>

</div>

</body>
</html>
