<?php
include '../../../include/koneksi/koneksi.php';

$aksi = isset($_POST['aksi']) ? $_POST['aksi'] : $_GET['aksi'];

/* ================= LIST ================= */
if ($aksi == 'list') {
    $id_relasi = $_GET['id_relasi'];
    $q = mysql_query(
        "SELECT * FROM data_supir
         WHERE id_relasi = '$id_relasi'
         ORDER BY nama_supir"
    );

    $data = [];
    while ($r = mysql_fetch_assoc($q)) {
        $data[] = $r;
    }
    echo json_encode($data);
    exit;
}

/* ================= SEARCH MEMBER ================= */
if ($aksi == 'search_member') {
    $q_query = isset($_GET['query']) ? $_GET['query'] : '';
    $data = [];
    if ($q_query !== '') {
        $search = mysql_real_escape_string($q_query);
        $q = mysql_query(
            "SELECT id_member, nama, no_telepon FROM data_member
             WHERE nama LIKE '%$search%' OR no_telepon LIKE '%$search%'
             LIMIT 15"
        );
        while ($r = mysql_fetch_assoc($q)) {
            $data[] = $r;
        }
    }
    echo json_encode($data);
    exit;
}

/* ================= ADD ================= */
if ($aksi == 'add') {
    $id = uniqid('SP-');
    $id_member = isset($_POST['id_member']) && $_POST['id_member'] !== '' ? "'" . mysql_real_escape_string($_POST['id_member']) . "'" : "NULL";
    $nama_supir = mysql_real_escape_string($_POST['nama_supir']);
    $id_relasi = mysql_real_escape_string($_POST['id_relasi']);

    mysql_query(
        "INSERT INTO data_supir (id_supir, nama_supir, id_relasi, id_member) VALUES (
            '$id',
            '$nama_supir',
            '$id_relasi',
            $id_member
        )"
    );
    exit;
}

/* ================= EDIT ================= */
if ($aksi == 'edit') {
    $id_member = isset($_POST['id_member']) && $_POST['id_member'] !== '' ? "'" . mysql_real_escape_string($_POST['id_member']) . "'" : "NULL";
    $nama_supir = mysql_real_escape_string($_POST['nama_supir']);
    $id_supir = mysql_real_escape_string($_POST['id_supir']);

    mysql_query(
        "UPDATE data_supir SET
            nama_supir = '$nama_supir',
            id_member = $id_member
         WHERE id_supir = '$id_supir'"
    );
    exit;
}

/* ================= DELETE ================= */
if ($aksi == 'delete') {
    mysql_query(
        "DELETE FROM data_supir
         WHERE id_supir = '$_POST[id]'"
    );
    exit;
}
