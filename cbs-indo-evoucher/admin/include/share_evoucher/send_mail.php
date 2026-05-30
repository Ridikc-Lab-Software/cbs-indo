<?php

include 'share_link_evoucher.php';
include 'EmailShareLink.php';

function createMessage($link, $company_logo, $company_name, $recipient_name, $username, $password)
{
    ob_start();  // Mulai menangkap output
    include 'mail.php';  // Sertakan file seperti biasa
    $mail_content = ob_get_clean();  // Ambil output dan bersihkan buffer

    // Lakukan `str_replace` untuk mengganti placeholder
    $mail_content = str_replace(
        ['{link}', '{company_logo}', '{company_name}', '{recipient_name}', '{username}', '{password}'],
        [$link, $company_logo, $company_name, $recipient_name, $username, $password],
        $mail_content
    );

    return <<<HTML
$mail_content
HTML;
}




// $massage = createMessage(
//     "https://cbs-indo.com/login.php",
//     "https://cbs-indo.com/admin/data/image/logo/logo2.png",
//     "CBS E Voucher",
//     "PT. Ridikc Industries"
// );
//
// shareLinkToUser(
//     new EmailShareLink(),
//     "haryandb@gmail.com",
//     "CBS E Voucher",
//     $massage
// );
