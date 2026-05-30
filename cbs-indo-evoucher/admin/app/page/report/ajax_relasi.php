<?php
include "../../../include/koneksi/koneksi.php"; // SESUAIKAN PATH KONEKSI

$id_relasi = mysql_real_escape_string($_GET['id_relasi']);

// ===== SUPIR =====
$q_supir = mysql_query("
    SELECT id_supir, nama_supir 
    FROM data_supir 
    WHERE id_relasi='$id_relasi'
");

$supir = [];
while ($s = mysql_fetch_assoc($q_supir)) {
    $supir[] = $s;
}

// ===== PLAT =====
$q_plat = mysql_query("
    SELECT plat 
    FROM data_plat 
    WHERE id_relasi='$id_relasi'
");

$plat = [];
while ($p = mysql_fetch_assoc($q_plat)) {
    $plat[] = $p;
}

echo json_encode([
    "supir" => $supir,
    "plat"  => $plat
]);
