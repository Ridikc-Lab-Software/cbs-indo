<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['image'])) {
        $imageData = $data['image'];
        $email = 'fajarudinsidik@gmail.com';

        $imageData = str_replace(' ', '+', $imageData);
        $imageData = substr($imageData, strpos($imageData, ',') + 1);
        $imageData = base64_decode($imageData);

        $fileName = 'voucher_' . uniqid() . '.png';
        file_put_contents($fileName, $imageData);

        $to = $email;
        $subject = 'Voucher Image';
        $message = 'Please find the attached voucher image.';
        $headers = "From: no-reply@example.com\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary=\"PHP-mixed-" . md5(time()) . "\"";

        $attachment = chunk_split(base64_encode(file_get_contents($fileName)));

        $body = "--PHP-mixed-" . md5(time()) . "\r\n";
        $body .= "Content-Type: text/plain; charset=\"utf-8\"\r\n";
        $body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $body .= $message . "\r\n";

        $body .= "--PHP-mixed-" . md5(time()) . "\r\n";
        $body .= "Content-Type: image/png; name=\"$fileName\"\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n";
        $body .= "Content-Disposition: attachment\r\n\r\n";
        $body .= $attachment . "\r\n";
        $body .= "--PHP-mixed-" . md5(time()) . "--\r\n";

        if (mail($to, $subject, $body, $headers)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Email failed to send.']);
        }

        unlink($fileName);
    } else {
        echo json_encode(['success' => false, 'error' => 'Image data missing.']);
    }
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
}
