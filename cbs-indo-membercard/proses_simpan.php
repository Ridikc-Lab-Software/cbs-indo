<?php
// ==== DEBUG: Tampilkan semua error ====
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// Include semua file yang dibutuhkan
// Pastikan path ini benar. Jika error "failed to open stream", perbaiki path-nya.
function location() { return "home"; }
include 'home/include/all_include.php';

// Cek apakah fungsi penting ada
if (!function_exists('xss')) {
    die("Error: Fungsi xss() tidak ditemukan. Pastikan file all_include.php berisi fungsi xss().");
}
if (!function_exists('id_otomatis')) {
    die("Error: Fungsi id_otomatis() tidak ditemukan. Pastikan ada di all_include.php.");
}

// Generate ID member otomatis
$id_member = id_otomatis("data_member", "id_member", "10");

// Ambil dan sanitasi data dari POST
$nama               = isset($_POST['nama']) ? xss($_POST['nama']) : '';
$alamat             = isset($_POST['alamat']) ? xss($_POST['alamat']) : '';
$no_telepon         = isset($_POST['no_telepon']) ? xss($_POST['no_telepon']) : '';
$tanggal_terdaftar  = isset($_POST['tanggal_terdaftar']) ? xss($_POST['tanggal_terdaftar']) : date('Y-m-d');
$id_kategori_member = isset($_POST['id_kategori_member']) ? xss($_POST['id_kategori_member']) : '';
$kode_rfid          = isset($_POST['kode_rfid']) ? xss($_POST['kode_rfid']) : '';
$password           = isset($_POST['password']) ? md5($_POST['password']) : '';

$nik = isset($_POST['nik']) ? xss($_POST['nik']) : '';
if (empty($nik)) $nik = '0';

$jenis_kelamin = isset($_POST['jenis_kelamin']) ? xss($_POST['jenis_kelamin']) : 'laki-laki';
if (!in_array($jenis_kelamin, ['laki-laki', 'perempuan'])) {
    $jenis_kelamin = 'laki-laki';
}

$agama = isset($_POST['agama']) ? xss($_POST['agama']) : 'Islam';
$allowed_agama = ['Islam', 'Kristen Katolik', 'Kristen Protestan', 'Hindu', 'Budha'];
if (!in_array($agama, $allowed_agama)) $agama = 'Islam';

$status_perkawinan = isset($_POST['status_perkawinan']) ? xss($_POST['status_perkawinan']) : 'Belum Menikah';
if (!in_array($status_perkawinan, ['Menikah', 'Belum Menikah'])) {
    $status_perkawinan = 'Belum Menikah';
}

$id_pekerjaan = isset($_POST['id_pekerjaan']) ? xss($_POST['id_pekerjaan']) : '-'; // Sesuaikan default
if (empty($id_pekerjaan)) $id_pekerjaan = '-';

$spbu = isset($_POST['spbu']) ? xss($_POST['spbu']) : 'SPBU001'; // Sesuaikan default
if (empty($spbu)) $spbu = 'SPBU001';

$tanggal_lahir = isset($_POST['tanggal_lahir']) ? xss($_POST['tanggal_lahir']) : '';
if (empty($tanggal_lahir) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $tanggal_lahir)) {
    $tanggal_lahir_val = "NULL";
} else {
    $tanggal_lahir_val = "'$tanggal_lahir'";
}

$username = isset($_POST['username']) ? xss($_POST['username']) : $no_telepon;
$id_admin = isset($_POST['id_admin']) ? xss($_POST['id_admin']) : '';
$point = 0;

// Cek duplikat nomor telepon
$cek_hp = mysql_query("SELECT no_telepon FROM data_member WHERE no_telepon='$no_telepon' LIMIT 1") or die("Query cek HP gagal: " . mysql_error());
if (mysql_num_rows($cek_hp) > 0) {
    echo '<script>alert("Nomor telepon ini sudah terdaftar!"); history.back();</script>';
    exit;
}

// Query INSERT
$sql = "INSERT INTO data_member (
    id_member, nik, nama, alamat, no_telepon, jenis_kelamin, tanggal_terdaftar,
    id_kategori_member, kode_rfid, point, username, password, tanggal_lahir,
    agama, status_perkawinan, id_pekerjaan, id_admin, spbu
) VALUES (
    '$id_member', '$nik', '$nama', '$alamat', '$no_telepon', '$jenis_kelamin', '$tanggal_terdaftar',
    '$id_kategori_member', '$kode_rfid', '$point', '$username', '$password', 
    $tanggal_lahir_val,
    '$agama', '$status_perkawinan', '$id_pekerjaan', '$id_admin', '$spbu'
)";

// Debug: Tampilkan query (hapus setelah selesai)
//echo "<pre>QUERY: $sql</pre>";

$query = mysql_query($sql) or die("INSERT GAGAL!<br>Error: " . mysql_error() . "<br>Query: $sql");

// Jika sampai sini berarti berhasil
if ($query) {
    $modal_title   = "Berhasil!";
    $modal_message = "Pendaftaran Member Berhasil. Silahkan login menggunakan username dan password Anda.";
    $modal_class   = "modal-success";
} else {
    $modal_title   = "Gagal!";
    $modal_message = "Gagal diproses. Lihat error di atas.";
    $modal_class   = "modal-danger";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hasil Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="modal fade show" id="messageModal" style="display:block;">
    <div class="modal-dialog">
        <div class="modal-content <?php echo $modal_class; ?>">
            <div class="modal-header">
                <h5 class="modal-title"><?php echo $modal_title; ?></h5>
            </div>
            <div class="modal-body">
                <?php echo $modal_message; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="klikOk()">OK</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function klikOk() {
    <?php if ($query) { ?>
        window.location.href = 'index.php?p=login';
    <?php } else { ?>
        history.back();
    <?php } ?>
}
</script>
</body>
</html>