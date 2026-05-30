<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set('display_errors', 0);

require_once('../../../include/all_include.php');

function jenis_transaksi_get($id_voucher)
{
    global $dbh;

    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try {
        $stmt = $dbh->prepare("SELECT jenis_bbm FROM data_transaksi_voucher WHERE id_voucher='$id_voucher'");
        $stmt->execute();
        $jenis_bbm = $stmt->fetchColumn();

        if ($jenis_bbm) {
            $stmt = $dbh->prepare("SELECT jenis_transaksi FROM data_jenis_transaksi WHERE id_jenis_transaksi='$jenis_bbm'");
            $stmt->execute();
            $jenis_transaksi = $stmt->fetchColumn();

            return $jenis_transaksi;
        }
    } catch (PDOException $e) {
        error_log("[ERROR] " . $e->getMessage());
        echo json_encode([
            'status' => 'gagal, mengambil data jenis transaksi',
        ]);
        die();
    }

    return null;
}

function is_kadaluarsa($tanggal_kadaluarsa)
{
    if ($tanggal_kadaluarsa < date("Y-m-d")) {
        return true;
    } else {
        return false;
    }
}

$resp = [];
$resp["status"] = "success";
$resp["result"] = array();

if (isset($_POST['berdasarkan']) && !empty($_POST['berdasarkan']) && isset($_POST['isi']) && !empty($_POST['isi'])) {
    $berdasarkan =  mysql_real_escape_string($_POST['berdasarkan']);
    $isi =  mysql_real_escape_string($_POST['isi']);
    $limit =  mysql_real_escape_string($_POST['limit']);
    $hal =  mysql_real_escape_string($_POST['hal']);
    if (isset($_POST['dari']) && !empty($_POST['dari']) && isset($_POST['sampai']) && !empty($_POST['sampai'])) {
        $dari =  mysql_real_escape_string($_POST['dari']);
        $sampai =  mysql_real_escape_string($_POST['sampai']);
        $query = "SELECT * FROM data_voucher WHERE $berdasarkan like '%$isi%'";
    } else {
        $query = "SELECT * FROM data_voucher WHERE $berdasarkan like '%$isi%'";
    }
} else {
    $query = "SELECT * FROM data_voucher";
}

$proses = mysql_query($query);
while ($data = mysql_fetch_array($proses)) {

    $id_voucher                    = $data["id_voucher"];
    $hasil['id_voucher']           = $id_voucher;
    $hasil['qrcode']               = $data["qrcode"];
    $hasil['id_relasi']            = $data["id_relasi"];
    $hasil['nominal']              = $data["nominal"];
    $hasil['tanggal_kadaluarsa']   = $data["tanggal_kadaluarsa"];
    $hasil['id_spbu']              = $data["id_spbu"];
    $hasil['id_penjualan_voucher'] = $data["id_penjualan"];
    $hasil['status']               = $data["status"];
    $hasil['file_voucher']         = $data["file_voucher"];
    $hasil['tanggal_dibuka']       = $data["tanggal_dibuka"];

    // relasi ke data_transaksi_voucher, data_jenis_transaksi
    $hasil['jenis_transaksi'] = jenis_transaksi_get($id_voucher);
    $hasil['kadaluarsa']      = is_kadaluarsa($data["tanggal_kadaluarsa"]);

    $hasil['nama_member'] = "";
    $hasil['nomor_telepon'] = "";

    $hasil['daftar_spbu'] = array();

    $spbus = QB::table("data_penjualan_voucher_spbu")
        ->join("data_spbu", "data_penjualan_voucher_spbu.id_spbu", "=", "data_spbu.id_spbu")
        ->where("data_penjualan_voucher_spbu.id_penjualan_voucher", $data['id_penjualan'])
        ->get();

    foreach ($spbus as $spbu) {
        array_push($hasil['daftar_spbu'], $spbu->nama_spbu);
    }

    if ($data['status'] == "Used") {
        $member = QB::table('data_member')
            ->join("data_transaksi_voucher", function ($table) use ($data) {
                $table->on("data_member.id_member", "=", "data_transaksi_voucher.id_member");
            })
            ->where("data_transaksi_voucher.id_voucher", $data['id_voucher'])
            ->first();

        if ($member) {
            $hasil['nama_member'] = $member->nama;
            $hasil['nomor_telepon'] = $member->no_telepon;
        }
    }

    array_push($resp["result"], $hasil);
}

json_print($resp);
