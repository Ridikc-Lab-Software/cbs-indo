<?php
header('Content-Type: application/json');
include '../../../include/koneksi/koneksi.php';
$q = isset($_GET['q']) ? trim($_GET['q']) : '';
if (strlen($q) < 2) {
    echo json_encode([]);
    exit;
}

$q = mysql_real_escape_string($q);

$sql = "SELECT m.id_member, m.nama, m.no_telepon, m.point, m.id_kategori_member, k.kategori_member
        FROM data_member m
        LEFT JOIN data_kategori_member k ON m.id_kategori_member = k.id_kategori_member
        WHERE (m.nama LIKE '%$q%' OR m.no_telepon LIKE '%$q%')
          AND m.nama IS NOT NULL AND TRIM(m.nama) != ''
        ORDER BY m.nama
        LIMIT 20";

$result = mysql_query($sql);
$data = [];
while ($row = mysql_fetch_assoc($result)) {
    $data[] = [
        'id_member' => $row['id_member'],
        'nama' => $row['nama'],
        'no_telepon' => $row['no_telepon'] ?: '-',
        'point' => (int) $row['point'],
        'kategori_member' => $row['kategori_member'] ?: '-',
        'id_kategori_member' => $row['id_kategori_member']
    ];
}

echo json_encode($data);
?>