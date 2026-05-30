<?php

if (!empty($halaman)) {
    echo "ini home";
} else {
    if (!empty($_GET['input'])) {
        $input = mysql_real_escape_string($_GET['input']);

        if ($input == 'tampil') {
            //TAMPIL
            include 'pengaturan_sistem_voucher.php';
        } elseif ($input == 'popup_edit') {
            //POPUP EDIT
            $url_index = "index.php";
            include 'tampil.php';
            popup("DATA BERHASIL DIEDIT", "SELESAI", "", $url_index, $url_index);
        } elseif ($input == 'edit') {
            //EDIT
            include 'edit.php';
        } elseif ($input == 'pengaturan_sistem_voucher') {
            include 'pengaturan_sistem_voucher.php';
        } else {
            //LAINNYA
            echo "404";
        }
    } else {
        //TAMPIL
        include 'pengaturan_sistem_voucher.php';
    }
}
