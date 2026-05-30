<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../../../include/koneksi/koneksi.php";

$tables = ['data_petugas', 'data_redeem', 'data_spbu', 'data_member'];

foreach ($tables as $table) {
    echo "=== $table ===\n";
    $sql = "DESCRIBE $table";
    $res = mysql_query($sql);
    if (!$res) {
        echo "Error: " . mysql_error() . "\n";
    } else {
        while ($row = mysql_fetch_assoc($res)) {
            echo $row['Field'] . " - " . $row['Type'] . "\n";
        }
    }
    echo "\n";
}
?>