<?php




if (!empty($halaman)) {
    if (isset($_GET['tmp'])) {
        temp();
    } else if (isset($_GET['tmp_f'])) {
        tmp_f();
    } else if ($_GET['import']) {
        include "import.php";
    } else {
        include "dashboard.php";
    }
} else {
    echo "Mau Ngapain..? Halaman Tidak Ada.";
}
