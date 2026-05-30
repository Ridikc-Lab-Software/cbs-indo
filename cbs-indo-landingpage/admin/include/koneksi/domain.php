<?php
date_default_timezone_set('Asia/Jakarta');
$cookie_name = "cek_domain_cache";
$cache_time  = 600;
$halaman_status = "Halaman normal berjalan...";
if (isset($_COOKIE[$cookie_name])) {
    $data = json_decode($_COOKIE[$cookie_name], true);
    if (is_array($data) && isset($data['status'])) {
        if ($data['status'] === 'expired') {
            die($data['respon']);
        } elseif ($data['status'] === 'ok') {
            $halaman_status = "Halaman normal berjalan... (from cookie)";
        }
    }
} else {
    $host = $_SERVER['HTTP_HOST'];
    $script = $_SERVER['SCRIPT_NAME'];
    $folder_path = rtrim(dirname($script), '/');
    $domain_path = $host . $folder_path;
    $ip         = $_SERVER['REMOTE_ADDR'] ?? '';
    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
    $full_url   = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http')
        . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $cek_url = 'https://project.ridikcindustries.com/cek_domain.php'
        . '?domain=' . urlencode($domain_path)
        . '&ip=' . urlencode($ip)
        . '&ua=' . urlencode($user_agent)
        . '&full=' . urlencode($full_url);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $cek_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    $response = curl_exec($ch);
    curl_close($ch);
    if ($response === false) {
        $halaman_status = "Halaman normal berjalan (cek_domain gagal)";
    } else {
        $data = json_decode($response, true);
        setcookie($cookie_name, $response, time() + $cache_time, "/");
        if (is_array($data) && isset($data['status'])) {
            if ($data['status'] === 'expired') {
                die($data['respon']);
            } elseif ($data['status'] === 'ok') {
                $halaman_status = "Halaman normal berjalan... (from request)";
            }
        } else {
            $halaman_status = "Halaman normal berjalan (unknown response)";
        }
    }
}
