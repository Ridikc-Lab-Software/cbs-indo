<?php
require_once('../../../include/all_include.php');

$id_transaksi       = isset($_POST["id_transaksi"]) ? $_POST["id_transaksi"] : "";
$tanggal            = isset($_POST["tanggal"]) ? $_POST["tanggal"] : "";
$jam                = isset($_POST["jam"]) ? $_POST["jam"] : "";
$id_member          = isset($_POST["id_member"]) ? $_POST["id_member"] : "";
$id_petugas         = isset($_POST["id_petugas"]) ? $_POST["id_petugas"] : "";
$id_kategori_member = isset($_POST["id_kategori_member"]) ? $_POST["id_kategori_member"] : ""; // bukan id, kategori_member (motor, mobil)
$id_jenis_transaksi = isset($_POST["id_jenis_transaksi"]) ? $_POST["id_jenis_transaksi"] : ""; // bukan id, jenis_bbm
$point              = isset($_POST["point"]) ? $_POST["point"] : "";
$jumlah             = isset($_POST["jumlah"]) ? $_POST["jumlah"] : ""; // nominal (jumlah transaksi)
$aksi               = isset($_POST["aksi"]) ? $_POST["aksi"] : "";

if ($jumlah > 1000) {
    $kategori_jumlah = "rupiah";
} else {
    $kategori_jumlah = "liter";
}

$query = mysql_query("INSERT INTO data_transaksi VALUES (
    '$id_transaksi'
    ,'$tanggal'
    ,'$jam'
    ,'$id_member'
    ,'$id_petugas'
    ,'$id_kategori_member'
    ,'$id_jenis_transaksi'
    ,'$point'
    ,'$kategori_jumlah'
    ,'$jumlah'

)");

$point_awal = baca_database("", "point", "SELECT * FROM data_member WHERE id_member='$id_member'");
$point_nilai = baca_database("", "point", "SELECT * FROM data_jenis_transaksi WHERE jenis_transaksi='$id_jenis_transaksi'");
$harga = baca_database("", "harga", "SELECT * FROM data_jenis_transaksi WHERE jenis_transaksi='$id_jenis_transaksi'");
$sisa_point = $point_awal + $point;



$sql = "UPDATE data_member SET
point=?
WHERE id_member=?";

$stmt = $dbh->prepare($sql);
$stmt->execute([
    $sisa_point,
    $id_member
]);

if ($aksi == "simpan-voucher") {
    date_default_timezone_set('Asia/Jakarta');
    $id_transaksi_voucher = $id_transaksi;
    $id_voucher           = isset($_POST["id_voucher"]) ? $_POST["id_voucher"] : "";
    $id_member            = isset($_POST["id_member"]) ? $_POST["id_member"] : "";
    $nama_member          = baca_database("", "nama", "SELECT nama FROM data_member WHERE id_member='$id_member'");
    $tanggal_transaksi    = date("Y-m-d H:i:s");
    $jenis_bbm            = $id_jenis_transaksi;
    $nominal              = $jumlah;

    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->beginTransaction();

    try {
        $stmt = $dbh->prepare("UPDATE data_voucher SET status = 'Used' WHERE id_voucher = ?");
        $stmt->execute([$id_voucher]);

        $stmt = $dbh->prepare("INSERT INTO data_transaksi_voucher VALUES (
            '$id_transaksi_voucher'
            ,'$id_voucher'
            ,'$id_member'
            ,'$nama_member'
            ,'$tanggal_transaksi'
            ,'$jenis_bbm'
            ,'$nominal'
        )");
        $stmt->execute();

        $dbh->commit();
    } catch (Exception $e) {
        $dbh->rollBack();

        echo json_encode([
            'status' => 'gagal',
            'pesan'  => 'gagal update data voucher',
            // 'error'  => $e->getMessage(),
        ]);
        http_response_code(500);

        die();
    }
}

$resp = [];
if ($query) {
    $resp["status"] = "success";
} else {
    $resp["status"] = "gagal";
}

echo (json_encode($resp));
