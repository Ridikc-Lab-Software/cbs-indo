<?php
header('Content-Type: application/json');
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set('display_errors', 0);
require_once('../../../include/all_include.php');

$id_member = id_otomatis("data_member", "id_member", "10");
$nama = isset($_POST["nama"]) ? $_POST["nama"] : "";
$alamat = isset($_POST["alamat"]) ? $_POST["alamat"] : "";
$no_telepon = isset($_POST["no_telepon"]) ? $_POST["no_telepon"] : "";
$jenis_kelamin = isset($_POST["jenis_kelamin"]) ? strtolower($_POST["jenis_kelamin"]) : "";
$tanggal_terdaftar = isset($_POST["tanggal_terdaftar"]) ? $_POST["tanggal_terdaftar"] : "";
$id_kategori_member = isset($_POST["id_kategori_member"]) ? $_POST["id_kategori_member"] : "";
$kode_rfid = isset($_POST["kode_rfid"]) ? $_POST["kode_rfid"] : "";
$point = isset($_POST["point"]) ? $_POST["point"] : "";
$username = isset($_POST["username"]) ? $_POST["username"] : "";
$password = isset($_POST["password"]) ? md5($_POST["password"]) : "";
$agama = isset($_POST["agama"]) ? $_POST["agama"] : "";
$id_pekerjaan = isset($_POST["id_pekerjaan"]) ? $_POST["id_pekerjaan"] : "";
$id_spbu = isset($_POST["id_spbu"]) ? $_POST["id_spbu"] : "";
$id_admin = $_POST['id_member']; // numpang id_member
$status_perkawinan = 'Belum Menikah';

// --- Tanggal lahir ---
if (isset($_POST["tanggal_lahir"]) && $_POST["tanggal_lahir"] != "") {
  $tanggal_lahir_sql = "'" . $_POST["tanggal_lahir"] . "'";
} else {
  $tanggal_lahir_sql = "NULL";
}

// --- 1. CEK DUPLIKAT NO TELEPON ---
$cek = mysql_query("SELECT COUNT(*) as total FROM data_member WHERE no_telepon = '$no_telepon'");
$cek_hasil = mysql_fetch_assoc($cek);

if ($cek_hasil['total'] > 0) {
  echo json_encode([
    "status" => "gagal",
    "message" => "No telepon sudah terdaftar."
  ]);
  exit;
}

// --- 2. INSERT DATA ---
$query = mysql_query("
INSERT INTO data_member
(
  id_member,
  nik,
  nama,
  alamat,
  no_telepon,
  jenis_kelamin,
  tanggal_terdaftar,
  id_kategori_member,
  kode_rfid,
  point,
  username,
  password,
  tanggal_lahir,
  agama,
  status_perkawinan,
  id_pekerjaan,
  id_admin,
  spbu
)
VALUES
(
  '$id_member',
  '',
  '$nama',
  '$alamat',
  '$no_telepon',
  '$jenis_kelamin',
  '$tanggal_terdaftar',
  '$id_kategori_member',
  '$kode_rfid',
  '$point',
  '$username',
  '$password',
  $tanggal_lahir_sql,
  '$agama',
  '$status_perkawinan',
  '$id_pekerjaan',
  '$id_admin',
  '$id_spbu'
)
");

$resp = [];
if ($query) {
  $resp["status"] = "success";
} else {
  $resp["status"] = "gagal";
  $resp["message"] = mysql_error();
}

echo json_encode($resp);
?>