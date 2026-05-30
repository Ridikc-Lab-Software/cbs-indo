<?php

include "../../../../admin/include/function/enc.php";
include "../../../include/share_evoucher/send_mail.php";
include "../../../../admin/include/koneksi/koneksi.php";
include "../../../../admin/include/function/all.php";

$key = 'qJB0rGtIn5UB1xG03efyCp';
$proses = isset($_GET['proses']) ? decrypt(mysql_real_escape_string($_GET['proses'])) : false;

if ($proses == false) {
    exit('Gagal, proses tidak ditemukan');
}

$penjualan = QB::table("data_penjualan_voucher")
    ->select(["data_relasi.email", "data_relasi.nama", "data_penjualan_voucher.password_voucher", "data_penjualan_voucher.id_penjualan"])
    ->join("data_relasi", function ($table) {
        $table->on("data_penjualan_voucher.id_relasi", "=", "data_relasi.id_relasi");
    })
    ->where("data_penjualan_voucher.id_penjualan", $proses)
    ->first();


if (!$penjualan) {
    exit("Gagal, mitra tidak ditemukan.");
}

$link = "https://e-voucher.cbs-indo.com/login/" . $_GET['proses'];
$company_logo = "https://cbs-indo.com/admin/data/image/logo/logo2.png";
$company_name = "PT.Cahaya Bungo Sarkopalma";
$recipient_name = $penjualan->nama;
$username = $_GET['proses'];
$password = $penjualan->password_voucher;
$id_relasi = $penjualan->id_relasi;
$id_penjualan = $penjualan->id_penjualan;

$massage = createMessage(
    $link,
    $company_logo,
    $company_name,
    $recipient_name,
    $username,
    $password
);

shareLinkToUser(
    new EmailShareLink(),
    $penjualan->email,
    "E-Voucher CBS-INDO - " . $recipient_name . " - " . $id_penjualan,
    $massage
);
