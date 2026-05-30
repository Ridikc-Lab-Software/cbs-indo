<?php

include 'share_link_evoucher.php';
include 'EmailShareLink.php';

function createMessage(
    $link,
    $company_logo,
    $company_name,
    $recipient_name,
    $voucher_code,
    $transaction_time,
    $spbu_number,
    $vehicle_plate,
    $driver_name,
    $voucher_nominal,
    $transaction_nominal,
    $remaining_nominal
) {
    ob_start();
    include 'mail.php';
    $mail_content = ob_get_clean();

    $mail_content = str_replace(
        [
            '{link}',
            '{company_logo}',
            '{company_name}',
            '{recipient_name}',
            '{voucher_code}',
            '{transaction_time}',
            '{spbu_number}',
            '{vehicle_plate}',
            '{driver_name}',
            '{voucher_nominal}',
            '{transaction_nominal}',
            '{remaining_nominal}'
        ],
        [
            $link,
            $company_logo,
            $company_name,
            $recipient_name,
            $voucher_code,
            $transaction_time,
            $spbu_number,
            $vehicle_plate,
            $driver_name,
            $voucher_nominal,
            $transaction_nominal,
            $remaining_nominal
        ],
        $mail_content
    );

    return $mail_content;
}


$message = createMessage(
    "https://cbs-indo.com/evoucher/detail.php",
    "https://cbs-indo.com/admin/data/image/logo/logo2.png",
    "CBS E-Voucher",
    "PT. Ridikc Industries",
    "EVR-2026-000231",
    "02 Feb 2026 14:35 WIB",
    "34.123.05",
    "B 1234 XYZ",
    "Ahmad Fauzi",
    "Rp 500.000",
    "Rp 150.000",
    "Rp 350.000"
);

shareLinkToUser(
    new EmailShareLink(),
    "fajarudinsidik@gmail.com",
    "Transaksi E-VOucher - ELKA - 20251009082104",
    $message
);