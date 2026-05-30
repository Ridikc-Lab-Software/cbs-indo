<?php
include '../../../../include/koneksi/koneksi.php';

// Get the search query from the request
$searchQuery = isset($_GET['query']) ? $_GET['query'] : '';

// Prepare the SQL query
if ($searchQuery) {
    $query = "SELECT * FROM data_relasi WHERE nama LIKE '%" . mysql_real_escape_string($searchQuery) . "%' OR email LIKE '%" . mysql_real_escape_string($searchQuery) . "%' LIMIT 10";
} else {
    $query = "SELECT * FROM data_relasi LIMIT 10"; // Default to show 10 items
}

$result = mysql_query($query);

$data = [];
while ($row = mysql_fetch_assoc($result)) {
    $data[] = $row;
}

// Return the data as a JSON response
echo json_encode($data);

// Close the database connection
// mysql_close($connection);
