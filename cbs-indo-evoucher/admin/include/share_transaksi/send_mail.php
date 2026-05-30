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


