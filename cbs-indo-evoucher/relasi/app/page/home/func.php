<?php

function get_status_voucher($id_voucher)
{
    global $dbh;

    $query = "SELECT * FROM data_transaksi_voucher WHERE id_voucher='$id_voucher'";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($data) {
        return 'Used';
    } else {
        return "Unused";
    }
}
