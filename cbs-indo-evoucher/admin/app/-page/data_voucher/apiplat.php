<?php
include '../../../include/koneksi/koneksi.php';

$aksi = isset($_POST['aksi']) ? $_POST['aksi'] : $_GET['aksi'];

/* ================= LIST ================= */
if ($aksi == 'list') {
    $id_relasi = $_GET['id_relasi'];
    $q = mysql_query(
        "SELECT p.*, k.kategori_member
         FROM data_plat p
         LEFT JOIN data_kategori_member k
           ON p.id_kategori_member = k.id_kategori_member
         WHERE p.id_relasi = '$id_relasi'
         ORDER BY p.plat"
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
    $id = uniqid('PL-');
    mysql_query(
        "INSERT INTO data_plat
         (id_plat, plat, id_relasi, id_kategori_member)
         VALUES (
            '$id',
            '$_POST[plat]',
            '$_POST[id_relasi]',
            '$_POST[id_kategori_member]'
         )"
    );
    exit;
}


/* ================= EDIT ================= */
if ($aksi == 'edit') {
    mysql_query(
        "UPDATE data_plat SET
            plat = '$_POST[plat]',
            id_kategori_member = '$_POST[id_kategori_member]'
         WHERE id_plat = '$_POST[id_plat]'"
    );
    exit;
}


/* ================= DELETE ================= */
if ($aksi == 'delete') {
    mysql_query(
        "DELETE FROM data_plat
         WHERE id_plat = '$_POST[id]'"
    );
    exit;
}
