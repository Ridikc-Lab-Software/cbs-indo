<?php

if (!empty($halaman)) {
	echo "ini home";
} else {
	if (!empty($_GET['input'])) {
		$input = mysql_real_escape_string($_GET['input']);

		if ($input == 'backup') {
			//TAMPIL
			include 'backup.php';
		} elseif ($input == 'restore') {
			//POPUP TAMBAH
			include 'restore.php';
		}
	} else {
		//TAMPIL
		include 'tampil.php';
	}
}
