<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require_once __DIR__ . '/vendor/autoload.php';

class EmailShareLink implements ShareLink
{
    // private $email_host = 'e-voucher.cbs-indo.com';
    // private $from_address = 'no-reply@e-voucher.cbs-indo.com';
    // private $from_name = 'CBS E Voucher Link';
    // private $username = 'no-reply@e-voucher.cbs-indo.com';
    // private $password = 'k;q2~I]7G!6H';

    private $email_host = 'smtp.gmail.com';
    private $from_address = 'smc.cbsindo@gmail.com';
    private $from_name = 'E-Voucher CBS-INDO';
    private $username = 'smc.cbsindo@gmail.com';
    private $password = 'qnih uofr aqro qvpt';


    public function share($recipient, $subject, $message)
    {
        $mail = new PHPMailer(true);

        // Konfigurasi email
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->isSMTP();
        $mail->Host = $this->email_host;
        $mail->SMTPAuth = true;
        $mail->Username = $this->username;
        $mail->Password = $this->password;
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        //$mail->Port = 465; //port lama


        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom($this->from_address, $this->from_name);
        $mail->addAddress($recipient);


        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        try {
            $mail->send();
            echo 'Email send';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            error_log(sprintf("[%s:%d %s] %s", basename(__FILE__), __LINE__, __FUNCTION__, $e->getMessage()), 0);
        }
    }
}
