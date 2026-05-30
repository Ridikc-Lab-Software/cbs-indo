<?php

use Pixie\QueryBuilder\QueryBuilderHandler;
use Pixie\Connection;

include 'pixie/vendor/autoload.php';

// Konfigurasi koneksi database
$config = [
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'databases_2021_cbs_indo',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => ''
];

$connection = new Connection('mysql', $config);
$queryBuilder = new QueryBuilderHandler($connection);

// Set nilai offset (ganti sesuai kebutuhan)
$offset = 11;

// Query untuk menghitung total links per id_group
$subquery = $queryBuilder->table('data_link')
    ->select(['id_group', $queryBuilder->raw('COUNT(*) AS total_links')])
    ->groupBy('id_group');

// Query utama dengan row_number dan effective_offset
$mainQuery = $queryBuilder->table('data_link AS dl')
    ->select([
        'dl.id_link',
        'dl.kode',
        'dl.username',
        'dl.judul',
        'dl.link',
        'dl.id_group',
        'subquery.total_links',
        $queryBuilder->raw('@row_num := IF(@group = dl.id_group, @row_num + 1, 1) AS row_number'),
        $queryBuilder->raw('@group := dl.id_group AS group_id'),
        $queryBuilder->raw("(({$offset} - 1) % subquery.total_links) + 1 AS effective_offset")
    ])
    ->join($subquery, 'subquery.id_group', '=', 'dl.id_group')
    ->join('data_group AS dg', 'dl.id_group', '=', 'dg.id_group')
    ->where('dg.id_kategori_group', '=', 'KAT20231201121810671')
    ->where('dl.username', '=', 'scode.aplikasi.31')
    ->orderBy('dl.id_group')
    ->orderBy('dl.id_link');

// Query untuk mendapatkan hasil akhir dengan row_number = effective_offset
$finalQuery = $queryBuilder->table($mainQuery, 'numbered_links')
    ->select([
        'numbered_links.id_link',
        'numbered_links.kode',
        'numbered_links.username',
        'numbered_links.judul',
        'numbered_links.link',
        'numbered_links.id_group',
        'numbered_links.total_links',
        'numbered_links.row_number',
        'numbered_links.effective_offset'
    ])
    ->where('numbered_links.row_number', '=', $queryBuilder->raw('numbered_links.effective_offset'));

// Eksekusi query
$results = $finalQuery->get();
