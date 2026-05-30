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

/* ================= ADD ================= */
if ($aksi == 'add') {
    $id = uniqid('SP-');
    mysql_query(
        "INSERT INTO data_supir VALUES (
            '$id',
            '$_POST[nama_supir]',
            '$_POST[id_relasi]'
        )"
    );
    exit;
}

/* ================= EDIT ================= */
if ($aksi == 'edit') {
    mysql_query(
        "UPDATE data_supir SET
            nama_supir = '$_POST[nama_supir]'
         WHERE id_supir = '$_POST[id_supir]'"
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
