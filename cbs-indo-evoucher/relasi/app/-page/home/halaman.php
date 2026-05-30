<?php
if (!empty($halaman)) {
    echo "ini home";
} else {
    if (!empty($_GET['input'])) {
        $input = mysql_real_escape_string($_GET['input']);

        if ($input == 'tampil') {
            //TAMPIL
            include 'tampil.php';
        } elseif ($input == 'generate') {
            //TAMPIL
            include 'generate.php';
        } elseif ($input == 'list') {
            //TAMBAH
            include 'list.php';
        } elseif ($input == 'list_detail') {
            //TAMBAH
            include 'list_detail.php';
        } elseif ($input == 'penjualan') {
            //TAMBAH
            include 'penjualan.php';
        } elseif ($input == 'transaksi') {
            //TAMBAH
            include 'transaksi.php';
        } elseif ($input == 'invoice') {
            //TAMBAH
            include 'invoice.php';
        } elseif ($input == 'grafik') {
            //TAMBAH
            include 'grafik.php';
        } elseif ($input == 'detail') {
            //DETAIL
            include 'detail.php';
        } elseif ($input == 'edit') {
            //EDIT
            include 'edit.php';
        } elseif ($input == 'hapus') {
            //HAPUS
            include 'hapus.php';
        } elseif ($input == 'proses_tambah') {
            //PROSES TAMBAH
            include 'proses_tambah.php';
        } elseif ($input == 'proses_edit') {
            //PROSES EDIT
            include 'proses_edit.php';
        } elseif ($input == 'list_detail_info') {
            //PROSES EDIT
            include 'list_detail_info.php';
        } elseif ($input == 'list_detail_voucher') {
            //PROSES EDIT
            include 'list_detail_voucher.php';
        } elseif ($input == 'manual') {
            //PROSES EDIT
            include 'manual.php';
        } elseif ($input == 'voucher_aktif') {
            //PROSES EDIT
            include 'voucher_aktif.php';
        } elseif ($input == 'voucher_digunakan') {
            //PROSES EDIT
            include 'voucher_digunakan.php';
        } elseif ($input == 'voucher_kadaluarsa') {
            //PROSES EDIT
            include 'voucher_kadaluarsa.php';
        } elseif ($input == 'vouher_keseluruhan') {
            //PROSES EDIT
            include 'vouher_keseluruhan.php';
        } elseif ($input == 'proses_hapus') {
            //PROSES HAPUS
            include 'proses_hapus.php';
        } elseif ($input == 'popup_hapus') {
            //POPUP HAPUS
            include 'tampil.php';
            popup("DATA BERHASIL DIHAPUS", "SELESAI", "", $url_index, $url_index);
        } elseif ($input == 'popup_edit') {
            //POPUP EDIT
            include 'tampil.php';
            popup("DATA BERHASIL DIEDIT", "SELESAI", "", $url_index, $url_index);
        } elseif ($input == 'popup_tambah') {
            //POPUP TAMBAH
            include 'tampil.php';
            popup("DATA BERHASIL DITAMBAHKAN", "SELESAI", "", $url_index, $url_index);
        } elseif ($input == 'cetak') {
            //POPUP TAMBAH
            include 'cetak.php';
        } else {
        }
    } else {
        //TAMPIL
        include 'tampil.php';
    }
}
