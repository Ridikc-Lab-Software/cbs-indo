<?php
if (isset($_GET['page']) && !empty($_GET['page'])) {
	$page = (int) $_GET['page'];
} else {
	$page = 1;
}
if (isset($_GET['perPage']) && !empty($_GET['perPage'])) {
	$dataPerPage = (int) $_GET['perPage'];
} else {
	$dataPerPage = 10;
}




//PAGINATION
function Pagination($pagedefault, $limit, $querypagination)
{
	// Ambil parameter page dan perPage
	$page = (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0) ? (int) $_GET['page'] : 1;
	$dataPerPage = (isset($_GET['perPage']) && is_numeric($_GET['perPage']) && $_GET['perPage'] > 0) ? (int) $_GET['perPage'] : 10;

	// Bangun base URL dengan semua GET kecuali 'page' (biar tidak duplikat)
	$base_url_params = $_GET;
	unset($base_url_params['page']); // hapus page agar kita kontrol manual

	// Konversi ke query string, tapi belum tambah ?page=
	$query_string = http_build_query($base_url_params);
	$page_url = $query_string ? '?' . $query_string . '&' : '?';

	// Hitung total data
	$countTotalRow = mysql_query($querypagination);
	$queryResult = mysql_fetch_assoc($countTotalRow);
	$totalRow = isset($queryResult['total']) ? $queryResult['total'] : 0;

	$total_pages = $totalRow > 0 ? ceil($totalRow / $dataPerPage) : 1;
	if ($page > $total_pages)
		$page = $total_pages;

	// Tampilkan info
	echo "Jumlah {$totalRow} data, ";
	echo "Halaman {$page} dari {$total_pages} Halaman<br><br>";

	// Mulai buat pagination
	$pagination = '';

	// Fungsi bantu untuk buat link
	$link = function ($p) use ($page_url, $dataPerPage) {
		return $page_url . 'page=' . $p;
	};

	// Tombol First & Previous
	$pagination .= '<a class="btn btn-info btn-xs" href="' . $link(1) . '" title="First">«</a> ';
	$prev = $page <= 1 ? 1 : $page - 1;
	$pagination .= '<a class="btn btn-info btn-xs" href="' . $link($prev) . '" title="Previous">« Sebelumnya</a> ';

	// Nomor halaman di sekitar halaman aktif
	$start = max(1, $page - 2);
	$end = min($total_pages, $page + 3);

	// Jika halaman kecil, mulai dari 1
	if ($page <= 3) {
		$start = 1;
		$end = min($total_pages, 6);
	}
	// Jika mendekati akhir
	if ($page >= $total_pages - 2) {
		$start = max(1, $total_pages - 5);
		$end = $total_pages;
	}

	for ($i = $start; $i <= $end; $i++) {
		if ($i == $page) {
			$pagination .= '<a class="btn btn-default btn-xs active">' . $i . '</a> ';
		} else {
			$pagination .= '<a class="btn btn-info btn-xs" href="' . $link($i) . '">' . $i . '</a> ';
		}
	}

	// Next & Last
	$next = $page >= $total_pages ? $total_pages : $page + 1;
	$pagination .= '<a class="btn btn-info btn-xs" href="' . $link($next) . '">Berikutnya »</a> ';
	$pagination .= '<a class="btn btn-info btn-xs" href="' . $link($total_pages) . '" title="Last">»</a>';

	echo $pagination;
}
?>

<?php
//POTONG KALIMAT
// function cutText($text, $length, $mode = 2)
// {
// 	if ($mode != 1) {
// 		$char = $text{
// 			$length - 1};
// 		switch ($mode) {
// 			case 2:
// 				while ($char != ' ') {
// 					$char = $text{
// 						--$length};
// 				}
// 			case 3:
// 				while ($char != ' ') {
// 					$char = $text{
// 						++$num_char};
// 				}
// 		}
// 	}
// 	return substr($text, 0, $length);
// }


//COMBO DATABASE
function combo_database($tabel, $field, $query)
{
	if ($query == '') {
		$sql = mysql_query("SELECT * FROM $tabel");
	} else {
		$sql = mysql_query("$query");
	}
	if (mysql_num_rows($sql) != 0) {
		while ($data = mysql_fetch_assoc($sql)) {
			echo '<option>' . $data["$field"] . '</option>';
		}
	}
}

//COMBO DATABASE
function combo_database_v2($tabel, $id_field, $field, $query)
{
	if ($query == '') {
		$sql = mysql_query("SELECT * FROM $tabel");
	} else {
		$sql = mysql_query("$query");
	}
	if (mysql_num_rows($sql) != 0) {
		while ($data = mysql_fetch_assoc($sql)) {
			?>
			<option value="<?php echo $data["$id_field"]; ?>"> <?php echo $data["$field"]; ?> </option>
			<?php
		}
	}
}


//COMBO DATABASE 2
function combo_database2($tabel, $field1, $field2, $query)
{
	if ($query == '') {
		$sql = mysql_query("SELECT * FROM $tabel");
	} else {
		$sql = mysql_query("$query");
	}
	if (mysql_num_rows($sql) != 0) {
		while ($data = mysql_fetch_assoc($sql)) {
			?>
			<option value="<?php echo $data["$field1"] ?>"><?php echo $data["$field1"] . " ( " . $data["$field2"] . ")" ?></option>
			';
			<?php
		}
	}
}



//COMBO DATABASE 3
function combo_database3($tabel, $field1, $field2, $field3, $pembuka_pemisah, $penutup_pemisah, $query)
{
	if ($query == '') {
		$sql = mysql_query("SELECT * FROM $tabel");
	} else {
		$sql = mysql_query("$query");
	}
	if (mysql_num_rows($sql) != 0) {
		while ($data = mysql_fetch_assoc($sql)) {
			?>
			<option value="<?php echo $data["$field1"] ?>">
				<?php echo $pembuka_pemisah . $data["$field1"] . $penutup_pemisah . $pembuka_pemisah . $data["$field2"] . $penutup_pemisah . $pembuka_pemisah . $data["$field3"] . $penutup_pemisah; ?>
			</option>';
			<?php
		}
	}
}


//COMBO ENUM
function combo_enum($tabel, $field, $query)
{
	global $database;
	$result = mysql_query("SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS
		WHERE TABLE_SCHEMA = '$database' AND TABLE_NAME = '$tabel' AND COLUMN_NAME = '$field'")
		or die(mysql_error());

	$row = mysql_fetch_array($result);
	$enumList = explode(",", str_replace("'", "", substr($row['COLUMN_TYPE'], 5, (strlen($row['COLUMN_TYPE']) - 6))));

	foreach ($enumList as $value)
		$selectDropdown .= "<option>$value</option>";
	echo $selectDropdown;
	return $selectDropdown;
}


//CETAK BERDASARKAN
function cetakberdasarkan($tabel, $jenis, $pakaiperperiode)
{ ?>
	<style type="text/css">
		#tampil_modal {
			padding-top: 5em;
			background-color: rgba(0, 0, 0, 0.8);
			position: fixed;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			z-index: 10;
			display: block;
		}

		#modal {
			padding: 15px;
			font-size: 16px;
			background: #e74c3c;
			color: #000;
			width: 540px;
			border-radius: 15px;
			margin: 0 auto 20px;
			padding-bottom: 50px;
			z-index: 9;
		}

		#modal_atas {
			width: 540px;
			color: #fff;
			background: #c0392b;
			padding: 15px;
			margin-left: -15px;
			font-size: 18px;
			margin-top: -15px;
			border-top-left-radius: 15px;
			border-top-right-radius: 15px;
		}

		#oke {
			background: #c0392b;
			border: none;
			float: right;
			width: 80px;
			height: 30px;
			color: #fff;
			margin-right: 5px;
			cursor: pointer;
		}
	</style>
	<?php
	$ket = strtoupper($tabel);
	if ($jenis == "xls") {
		$judulcetak = "Export Ms.Excel";
	} elseif ($jenis == "doc") {
		$judulcetak = "Export Ms.Word";
	} else {
		$judulcetak = "Cetak Laporan";
	}
	?>
	<div id="tampil_modal">
		<div id="modal">
			<div id="modal_atas"><?php echo $judulcetak; ?></div>
			<br>
			<form action="cetak.php" method="get">

				<div class="item form-group">
					<label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_admin">Berdasarkan<span
							class="required">:</span>
					</label>
					<br>
					<select data-style="btn-default" class="selectpicker show-tick form-control" name="apa"
						data-live-search="true" data-size="7">

						<?php

						$sql = "desc $tabel";
						$result = @mysql_query($sql);
						while ($row = @mysql_fetch_array($result)) {
							echo "<option  data-icon='glyphicon glyphicon-search'  data-tokens='berdasarkan' name='apa' value=$row[0]>$row[0]</option>";
						}
						?>

					</select>
					<div class="input-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_admin">Pencarian
							<span class="required">:</span>
						</label><br>
						<span class="input-group-addon" id="basic-addon1">
							<i class="fa fa-indent"></i>
						</span>
						<input class="form-control col-md-7 col-xs-12" name="isi" type="text">
					</div>

					<?php if ($pakaiperperiode == "ya") { ?>
						<div class="input-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_admin">Dari Tanggal
								<span class="required">:</span>
							</label><br>
							<span class="input-group-addon" id="basic-addon1">
								<i class="fa fa-calendar"></i>
							</span>
							<input class="form-control col-md-7 col-xs-12" name="periode1" placeholder="periode1" type="date">
						</div>

						<div class="input-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_admin">Sampai Tanggal
								<span class="required">:</span>
							</label><br>
							<span class="input-group-addon" id="basic-addon1">
								<i class="fa fa-calendar"></i>
							</span>
							<input class="form-control col-md-7 col-xs-12" name="periode2" placeholder="periode2" type="date">
						</div>
					<?php } ?>
					<input name="jenis" value="<?php echo $jenis; ?>" type="hidden">
					<button type="submit" id="oke">Cetak</button>
					</a>
				</div>
			</form>
			<!-- <a href="index.php"><button id="oke">Batal</button></a> -->
		</div>
	</div>
<?php } ?>
<?php
//HEADER CETAK
function cetakapa($cetakapa)
{
	if ($cetakapa == "xls") {
		header("Content-Type: application/force-download");
		header("Cache-Control: no-cache, must-revalidate");
		header("content-disposition: attachment;filename=laporan_%tabel%_" . date('dmY') . ".xls");
	} elseif ($cetakapa == "doc") {
		header("Content-Type: application/force-download");
		header("Cache-Control: no-cache, must-revalidate");
		header("content-disposition: attachment;filename=laporan_%tabel%_" . date('dmY') . ".doc");
	} elseif ($cetakapa == "pdf") {
		header("Content-Type: application/force-download");
		header("Cache-Control: no-cache, must-revalidate");
		header("content-disposition: attachment;filename=laporan_%tabel%_" . date('dmY') . ".pdf");
	} elseif ($cetakapa == "print") {
		?>
		<script>
			window.print();
		</script>
		<?php
	}
}
?>
<?php
//POPUP
function popup($pesan, $judul, $button, $link_oke, $link_back)
{
	$judul = strtolower($pesan);
	if (strpos($judul, "hapus")) {
		$type = "error";
	} else {
		$type = "success";
	}
	?>
	<script>
		swal(
			'Sukses',
			'<?= $pesan ?>',
			'<?= $type ?>'
		);
	</script>
	<?php
}
?>
<?php
//KEYPRESS
function action($proses)
{
	echo "onkeyup='$proses();' onchange='$proses();' onkeyup='$proses();' onkeydown='$proses();' onclick='$proses();'";
}

function total($tabel, $query)
{
	if ($query == "") {
		$sql = 'SELECT * FROM ' . $tabel;
	} else {
		$sql = $query;
	}
	$query = mysql_query($sql);
	$count = mysql_num_rows($query);
	echo "$count";
}
?>

<?php
function totalr($tabel, $query)
{
	if ($query == "") {
		$sql = 'SELECT * FROM ' . $tabel;
	} else {
		$sql = $query;
	}
	$query = mysql_query($sql);
	$count = mysql_num_rows($query);
	return $count;
}
?>

<?php
//TANGGAL OTOMATIS
function tanggal_otomatis()
{
	$tanggal = date("Y-m-d");
	echo $tanggal;
}
?>
<?php
//TANGGAL OTOMATIS
function format_indo($t)
{
	$bulan = array(
		1 => 'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $t);
	return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
}

function bulanIndo($bulan)
{
	switch ($bulan) {
		case 1:
			return "Januari";
			break;
		case 2:
			return "Februari";
			break;
		case 3:
			return "Maret";
			break;
		case 4:
			return "April";
			break;
		case 5:
			return "Mei";
			break;
		case 6:
			return "Juni";
			break;
		case 7:
			return "Juli";
			break;
		case 8:
			return "Agustus";
			break;
		case 9:
			return "September";
			break;
		case 10:
			return "Oktober";
			break;
		case 11:
			return "November";
			break;
		case 12:
			return "Desember";
			break;
	}
}
?>

<?php
//FORMAT RUPIAH
function rupiah($rp)
{
	echo "Rp.";
	echo number_format($rp, 0, ",", ".");
}
?>
<?php
//dataBASE
function baca_database($tabel, $field, $query)
{
	if ($query == "") {
		$sql = 'SELECT * FROM ' . $tabel;
	} else {
		$sql = $query;
	}

	$prosesulala = mysql_query($sql);

	if (!$prosesulala) {
		// Debug query error
		trigger_error("Query Error: " . mysql_error() . " | SQL: " . $sql, E_USER_WARNING);
		return null;
	}

	$datahasilpemrosesanquery = mysql_fetch_array($prosesulala);

	if (!$datahasilpemrosesanquery) {
		// Tidak ada data
		return null;
	}

	if (!isset($datahasilpemrosesanquery[$field])) {
		// Field tidak ada di hasil
		trigger_error("Field '$field' tidak ditemukan di hasil query.", E_USER_NOTICE);
		return null;
	}

	return $datahasilpemrosesanquery[$field];
}

?>
<?php
function cek_database($tabel, $field, $value, $query)
{
	if ($query == "") {
		$sql = "SELECT * FROM " . $tabel . " WHERE " . $field . " ='" . $value . "'";
	} else {
		$sql = $query;
	}
	$cek_user = mysql_num_rows(mysql_query($sql));
	if ($cek_user > 0) {
		$hasiltermantab = "ada";
	} else {
		$hasiltermantab = "nggak";
	}
	return $hasiltermantab;
}
?>
<?php
function baca_session($namasession)
{
	session_save_path($_SERVER['DOCUMENT_ROOT'] . "/../tmp");
	session_id("login");
	if (session_status() == PHP_SESSION_NONE) {
		@session_start();
	}
	$hasiltermantab = $_SESSION[$namasession];
	return $hasiltermantab;
}
?>
<?php
function simpan_session($namasession, $apa)
{
	session_save_path($_SERVER['DOCUMENT_ROOT'] . "/../tmp");
	session_id("login");
	if (session_status() == PHP_SESSION_NONE) {
		@session_start();
	}
	$_SESSION[$namasession] = $apa;
}
?>
<?php
function cek_session($namasession)
{
	session_save_path($_SERVER['DOCUMENT_ROOT'] . "/../tmp");
	session_id("login");
	if (session_status() == PHP_SESSION_NONE) {
		@session_start();
	}
	if (empty($_SESSION[$namasession])) {
		$hasiltermantab = "nggak";
	} else {
		$hasiltermantab = "ada";
	}
	return $hasiltermantab;
}
?>
<?php
function halaman()
{
	if (!empty($_GET['halaman'])) {
		$halaman = $_GET['halaman'];
		$cari = 'components/halaman/' . $halaman . '.php';
		if (file_exists($cari)) {
			include 'components/halaman/' . $halaman . '.php';
		} else {
			echo "MAAF HALAMAN TIDAK TERSEDIA.";
		}
	} else {
		//HOME
		include 'components/halaman/home.php';
	}
}
?>
<?php
function kekata($x)
{
	$x = abs($x);
	$angka = array(
		"",
		"satu",
		"dua",
		"tiga",
		"empat",
		"lima",
		"enam",
		"tujuh",
		"delapan",
		"sembilan",
		"sepuluh",
		"sebelas"
	);
	$temp = "";
	if ($x < 12) {
		$temp = " " . $angka[$x];
	} else if ($x < 20) {
		$temp = kekata($x - 10) . " belas";
	} else if ($x < 100) {
		$temp = kekata($x / 10) . " puluh" . kekata($x % 10);
	} else if ($x < 200) {
		$temp = " seratus" . kekata($x - 100);
	} else if ($x < 1000) {
		$temp = kekata($x / 100) . " ratus" . kekata($x % 100);
	} else if ($x < 2000) {
		$temp = " seribu" . kekata($x - 1000);
	} else if ($x < 1000000) {
		$temp = kekata($x / 1000) . " ribu" . kekata($x % 1000);
	} else if ($x < 1000000000) {
		$temp = kekata($x / 1000000) . " juta" . kekata($x % 1000000);
	} else if ($x < 1000000000000) {
		$temp = kekata($x / 1000000000) . " milyar" . kekata(fmod($x, 1000000000));
	} else if ($x < 1000000000000000) {
		$temp = kekata($x / 1000000000000) . " trilyun" . kekata(fmod($x, 1000000000000));
	}
	return $temp;
}

function terbilang($x)
{
	if ($x < 0) {
		$hasil = "minus " . trim(kekata($x));
	} else {
		$hasil = trim(kekata($x));
	}

	$hasil = ucwords($hasil);
	return $hasil;
}



function temp()
{
	?>
	<form action="index.php" method="get">
		<center>
			<h1>SETTING TEMA</h1>
			<?php
			$xml = simplexml_load_file("../../../include/settings/settings.xml");
			$sxe = new SimpleXMLElement($xml->asXML());
			$rows = count($sxe);
			for ($i = 0; $i < $rows; $i++)
				if ($sxe->users[$i]->id == '1') {
					$tmp = ($sxe->users[$i]->tmp);
					$v = ($sxe->users[$i]->v);
				}
			?>

			<font color="green">

				<H3>VERSI : <?php echo $v; ?></H3>
				<br>
			</font>
			<font color="red">
				Tema Terpilih :
				<?php echo $tmp; ?>
			</font>
			<br>
			<br>
			Change Template :
			<select name="s">
				<option value="<?php echo $tmp; ?>"><?php echo $tmp; ?></option>
				<option value="<?php echo $tmp; ?>">----------------</option>
				<?php
				$dir = opendir('../../../data/tmp/');
				while ($file = readdir($dir)) {
					if ($file == '.' || $file == '..') {
						continue;
					}
					?>

					<option><?php echo $file; ?></option>
					<?php
				}
				closedir($dir);
				?>

			</select>
			<button class="btn btn-success" href="index.php?tmp=x">Simpan</button>
			<a class="btn btn-danger" href="index.php">Batal</a>
			<a class="btn btn-warning" href="index.php?tmp_f=x">Setting Front End</a>
			<input type="hidden" value="x" name="tmp">

			<br>
			<br>

			<div class="col-12">
				<?php



				$dir1 = opendir('../../../data/tmp/');

				while ($file1 = readdir($dir1)) {

					if ($file1 == '.' || $file1 == '..') {
						continue;
					}
					?>
					<div class="col-md-4">

						<a href="index.php?tmp=x&s=<?php echo $file1; ?>">

							<?php
							if (file_exists("../../../data/tmp/" . $file1 . "/menuutama.jpg")) {
								?>
								<img src="../../../data/tmp/<?php echo $file1; ?>/menuutama.jpg" width="300" height="200">
								<?php
							} else {
								?>
								<img src="../../../data/tmp/<?php echo $file1; ?>/menuutama.png" width="300" height="200">
								<?php
							}
							?>

							<center><?php echo $file1; ?>

								<?php
								if (file_exists("../../../data/tmp/" . $file1 . "/login.php")) {
									echo "+login";
								}
								?>
							</center>
						</a>
					</div>
					<?php
				}
				closedir($dir);
				?>
			</div>
	</form>
	<?php
}
?>


<?php
function tmp_f()
{
	?>
	<form action="index.php" method="get">
		<center>
			<h1>SETTING TEMA</h1>
			<?php
			$xml = simplexml_load_file("../../../../home/include/settings/settings.xml");
			$sxe = new SimpleXMLElement($xml->asXML());
			$rows = count($sxe);
			for ($i = 0; $i < $rows; $i++)
				if ($sxe->users[$i]->id == '1') {
					$tmp = ($sxe->users[$i]->tmp);
					$v = ($sxe->users[$i]->v);
				}
			?>
			<font color="green">
				<H3>VERSI : <?php echo $v; ?></H3>
				<br>
			</font>
			<font color="red">
				Tema Terpilih :
				<?php echo $tmp; ?>
			</font>
			<br>
			<br>
			Change Template :
			<select name="s">
				<option value="<?php echo $tmp; ?>"><?php echo $tmp; ?></option>
				<option value="<?php echo $tmp; ?>">----------------</option>
				<?php
				$dir = opendir('../../../../home/data/tmp/');
				while ($file = readdir($dir)) {
					if ($file == '.' || $file == '..') {
						continue;
					}
					?>

					<option><?php echo $file; ?></option>
					<?php
				}
				closedir($dir);
				?>

			</select>
			<button class="btn btn-success" href="index.php?tmp_f=x">Simpan</button>
			<a class="btn btn-danger" href="index.php">Batal</a>
			<a class="btn btn-primary" href="index.php?tmp=x">Setting Back End</a>
			<a target="_blank" class="btn btn-info" href="../../../../">Lihat Halaman Front End</a>
			<input type="hidden" value="x" name="tmp_f">

			<br>
			<br>

			<div class="col-12">
				<?php



				$dir1 = opendir('../../../../home/data/tmp/');

				while ($file1 = readdir($dir1)) {

					if ($file1 == '.' || $file1 == '..') {
						continue;
					}
					?>
					<div class="col-md-4">

						<a href="index.php?tmp_f=x&s=<?php echo $file1; ?>">

							<?php
							if (file_exists("../../../../home/data/tmp/" . $file1 . "/home.jpg")) {
								?>
								<img src="../../../../home/data/tmp/<?php echo $file1; ?>/home.jpg" width="300" height="200">
								<?php
							} else {
								?>
								<img src="../../../../home/data/tmp/<?php echo $file1; ?>/home.png" width="300" height="200">
								<?php
							}
							?>

							<center><?php echo $file1; ?>

								<?php
								if (file_exists("../../../../home/data/tmp/" . $file1 . "/login.php")) {
									echo "+login";
								}
								?>
							</center>
						</a>
					</div>
					<?php
				}
				closedir($dir);
				?>
			</div>
	</form>
	<?php
}
?>

<?php
//ACTION CETAK
function action_cetak($tabel)
{
	?>

	<form name="formcari" id="formcari" action="cetak.php" method="get" target="_blank">
		<fieldset>
			<table>
				<tbody>
					<tr>
						<td><b>CETAK KESELURUHAN</b></td>

						<td></td>
					</tr>


					<tr>
						<td style="width:40%"></td>

						<td>
							<?php btn_preview_laporan('Print Preview'); ?>
							<?php btn_cetak_laporan('Print'); ?>
							<?php btn_export_laporan('Export Excel'); ?>
						</td>
					</tr>
				</tbody>
			</table>
		</fieldset>
	</form>
	<br>
	<form name="formcari" id="formcari" action="cetak.php" method="get" target="_blank">
		<fieldset>
			<table>
				<tbody>
					<tr>
						<td><b>CETAK DENGAN FILTER</b></td>

						<td>
						</td>
					</tr>

					<tr>
						<td style="width:40%">Berdasarkan :</td>

						<td>
							<select class="form-control" data-live-search="true" name="Berdasarkan" id="Berdasarkan">
								<?php
								$sql = "desc $tabel";
								$result = @mysql_query($sql);
								while ($row = @mysql_fetch_array($result)) {
									echo "<option name='berdasarkan' value=$row[0]>$row[0]</option>";
								}
								?>
							</select>
						</td>
					</tr>

					<tr>
						<td style="width:40%">Pencarian :</td>

						<td>
							<input class="form-control" type="text" name="isi" value="">
						</td>
					</tr>

					<tr>
						<td></td>

						<td>
							<?php btn_preview_laporan('Print Preview'); ?>
							<?php btn_cetak_laporan('Print'); ?>
							<?php btn_export_laporan('Export Excel'); ?>
						</td>
					</tr>
				</tbody>
			</table>
		</fieldset>
	</form>

	<br>


	<?php
	$ada = 0;
	$sql = "desc $tabel";
	$result = @mysql_query($sql);
	while ($row = @mysql_fetch_array($result)) {
		$typedata = $row[1];

		$kalimat = $typedata;
		if (preg_match("/date/i", $kalimat)) {

			$ada = $ada + 1;
		} else {
		}
	}

	if ($ada > 0) {
		?>

		<form name="formcari" id="formcari" action="cetak.php" method="get" target="_blank">
			<fieldset>
				<table>
					<tbody>
						<tr>
							<td><b>CETAK PERPERIODE</b></td>

							<td></td>
						</tr>
						<tr>
							<td style="width:40%">Berdasarkan :</td>

							<td>
								<select class="form-control" data-live-search="true" name="Berdasarkan" id="Berdasarkan">
									<?php
									$sql = "desc $tabel";
									$result = @mysql_query($sql);
									while ($row = @mysql_fetch_array($result)) {
										$typedata = $row[1];

										$kalimat = $typedata;
										if (preg_match("/date/i", $kalimat)) {

											echo "<option name='berdasarkan' value=$row[0]>$row[0]</option>";
										}
									}
									?>
								</select>
							</td>
						</tr>


						<tr>
							<td style="width:40%">Dari Tanggal :</b></td>

							<td><input type="date" name="tanggal1"></td>
						</tr>

						<tr>
							<td style="width:40%">Sampai Tanggal :</b></td>

							<td><input type="date" name="tanggal2"></td>
						</tr>

						<?php if ($tabel == 'data_transaksi' || $tabel == 'data_member') { ?>
						<tr>
							<td style="width:40%">SPBU :</td>
							<td>
								<select class="form-control" name="spbu" id="spbu">
									<option value="">-- Semua SPBU --</option>
									<?php
									$q_spbu = mysql_query("SELECT nama_spbu FROM data_spbu");
									if ($q_spbu) {
										while ($r_spbu = mysql_fetch_array($q_spbu)) {
											$parts = explode(' ', trim($r_spbu['nama_spbu']));
											$no_spbu = isset($parts[0]) ? $parts[0] : '';
											if (!empty($no_spbu)) {
												echo "<option value='$no_spbu'>$no_spbu</option>";
											}
										}
									}
									?>
								</select>
							</td>
						</tr>
						<?php } ?>


						<tr>
							<td></td>

							<td>
								<?php btn_preview_laporan('Print Preview'); ?>
								<?php btn_cetak_laporan('Print'); ?>
								<?php btn_export_laporan('Export Excel'); ?>
							</td>
						</tr>
					</tbody>
				</table>
			</fieldset>
		</form>


		<?php
	}
}
//PROSES ACTION CETAK
function proses_action_cetak($tabel)
{
	$status = "";
	if (isset($_GET['preview'])) {
		$status = "preview";
		?>

		<?php
	} else if (isset($_GET['cetak'])) {
		$status = "cetak";
		?>
			<script>
				window.print();
			</script>
		<?php
	} else if (isset($_GET['export'])) {
		$status = "export";
		header("Content-Type: application/force-download");
		header("Cache-Control: no-cache, must-revalidate");
		header("content-disposition: attachment;filename=laporan_$tabel" . date('dmY') . ".xls");
	} else {
		include '../../../include/function/session.php';
	}
}

function xss($val)
{
	//$val = htmlentities($val);
	//	$val = strip_tags($val);
	//	$val = filter_var($val, FILTER_SANITIZE_STRING);
	return $val;
}

//UPLOAD
function upload($namafile)
{
	$time = time();
	$acak = rand(10000, 99999);
	$namaAsli = $_FILES[$namafile]['name'];
	$tmp_file = $_FILES[$namafile]['tmp_name'];

	// Buat nama file unik
	$foto = $time . "-" . $acak . "-" . $namaAsli;
	$path = "../../../upload/" . $foto;

	// Daftar ekstensi gambar yang diizinkan
	$ekstensi_diizinkan = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

	// Ambil ekstensi file
	$x = explode('.', $namaAsli);
	$ekstensi = strtolower(end($x));

	// Validasi ekstensi
	if (in_array($ekstensi, $ekstensi_diizinkan)) {
		// Validasi MIME type juga untuk keamanan tambahan
		$tipe = mime_content_type($tmp_file);
		if (strpos($tipe, 'image/') === 0) {
			move_uploaded_file($tmp_file, $path);
			return $foto;
		} else {
			echo "<script>alert('File yang diupload bukan gambar valid!'); window.history.back();</script>";
			exit;
		}
	} else {
		echo "<script>alert('Hanya file gambar (JPG, JPEG, PNG, GIF, WEBP) yang diizinkan!'); window.history.back();</script>";
		exit;
	}
}


//UPLOAD HOME
function upload_home($namafile)
{
	$time = time();
	$acak = rand(10000, 99999);
	$namaAsli = $_FILES[$namafile]['name'];
	$tmp_file = $_FILES[$namafile]['tmp_name'];

	// Buat nama file unik
	$foto = $time . "-" . $acak . "-" . $namaAsli;
	$path = "admin/upload/" . $foto;

	// Daftar ekstensi gambar yang diizinkan
	$ekstensi_diizinkan = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

	// Ambil ekstensi file
	$x = explode('.', $namaAsli);
	$ekstensi = strtolower(end($x));

	// Validasi ekstensi
	if (in_array($ekstensi, $ekstensi_diizinkan)) {
		// Validasi MIME type untuk memastikan file benar-benar gambar
		$tipe = mime_content_type($tmp_file);
		if (strpos($tipe, 'image/') === 0) {
			// (Opsional) Validasi ukuran file, misalnya maksimal 2 MB
			if ($_FILES[$namafile]['size'] > 2 * 1024 * 1024) {
				echo "<script>alert('Ukuran file terlalu besar (maks 2MB)!'); window.history.back();</script>";
				exit;
			}

			// Pindahkan file
			move_uploaded_file($tmp_file, $path);
			return $foto;
		} else {
			echo "<script>alert('File yang diupload bukan gambar valid!'); window.history.back();</script>";
			exit;
		}
	} else {
		echo "<script>alert('Hanya file gambar (JPG, JPEG, PNG, GIF, WEBP) yang diizinkan!'); window.history.back();</script>";
		exit;
	}
}


//UPLOAD ADMIN
function upload_admin($namafile)
{
	$time = time();
	$acak = rand(10000, 99999);
	$namaAsli = $_FILES[$namafile]['name'];
	$tmp_file = $_FILES[$namafile]['tmp_name'];

	// Buat nama file unik
	$foto = $time . "-" . $acak . "-" . $namaAsli;
	$pathFolder = "../../../../admin/upload/";
	$path = $pathFolder . $foto;

	// Buat folder jika belum ada
	if (!file_exists($pathFolder)) {
		mkdir($pathFolder, 0777, true);
	}

	// Daftar ekstensi gambar yang diizinkan
	$ekstensi_diizinkan = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

	// Ambil ekstensi file
	$x = explode('.', $namaAsli);
	$ekstensi = strtolower(end($x));

	// Validasi ekstensi
	if (in_array($ekstensi, $ekstensi_diizinkan)) {

		// Validasi MIME type
		$tipe = mime_content_type($tmp_file);
		if (strpos($tipe, 'image/') === 0) {

			// Validasi ukuran file (maks 2MB)
			if ($_FILES[$namafile]['size'] > 2 * 1024 * 1024) {
				echo "<script>alert('Ukuran file terlalu besar (maksimal 2MB)!'); window.history.back();</script>";
				exit;
			}

			// Pindahkan file
			move_uploaded_file($tmp_file, $path);
			return $foto;
		} else {
			echo "<script>alert('File yang diupload bukan gambar valid!'); window.history.back();</script>";
			exit;
		}
	} else {
		echo "<script>alert('Hanya file gambar (JPG, JPEG, PNG, GIF, WEBP) yang diizinkan!'); window.history.back();</script>";
		exit;
	}
}


function id_otomatis($nama_tabel, $id_nama_tabel, $panjang_id)
{
	$proses = mysql_query("select max($id_nama_tabel) as maxcode from $nama_tabel");
	$hasil = mysql_fetch_array($proses);
	$maxcode = $hasil['maxcode'];

	//TIDAK ADA
	$kodedepan = strtoupper($nama_tabel);
	$kodedepan = str_replace("DATA_", "", $kodedepan);
	$kodedepan = str_replace("DATA", "", $kodedepan);
	$kodedepan = str_replace("TABEL_", "", $kodedepan);
	$kodedepan = str_replace("TABEL", "", $kodedepan);
	$kodedepan = str_replace("TABLE_", "", $kodedepan);
	$kodedepan = strtoupper(substr($kodedepan, 0, 3));
	$id_tabel_otomatis = $kodedepan . date('YmdHis');
	$min = pow(10, 3 - 1);
	$max = pow(10, 3) - 1;

	$kodeakhir = mt_rand($min, $max);
	return $id_tabel_otomatis . $kodeakhir;
}

//JUMLAHKAN DATABASE
function jumlahkan_database($tabel, $total, $query)
{
	$sql = $query;
	$querytabelualala = $sql;
	$prosesulala = mysql_query($querytabelualala);
	$datahasilpemrosesanquery = mysql_fetch_array($prosesulala);
	$hasiltermantab = $datahasilpemrosesanquery[$total];
	return $hasiltermantab;
}

//FORMAT HIJRIAH
class HijriCalendar
{
	function monthName($i)
	{
		static $month = array(
		"Muharram",
		" Syafar",
		"Rabiul Awal",
		" Rabiul Akhir",
		"Jumadil Awal",
		" Jumadil Akhir",
		"Rajab",
		"Sya'ban",
		"Ramadhan",
		"Syawal",
		"Dzulka'dah",
		"Dzulhijjah"
		);
		return $month[$i - 1];
	}

	function GregorianToHijri($t)
	{
		$pecahkan = explode('-', $t);

		$m = $pecahkan[1];
		$d = $pecahkan[2];
		$y = $pecahkan[0];

		return HijriCalendar::JDToHijri(
			cal_to_jd(CAL_GREGORIAN, $m, $d, $y)
		);
	}
	function HijriToGregorian($m, $d, $y)
	{
		return jd_to_cal(
			CAL_GREGORIAN,
			HijriCalendar::HijriToJD($m, $d, $y)
		);
	}
	function JDToHijri($jd)
	{
		$jd = $jd - 1948440 + 10632;
		$n = (int) (($jd - 1) / 10631);
		$jd = $jd - 10631 * $n + 354;
		$j = ((int) ((10985 - $jd) / 5316)) *
			((int) (50 * $jd / 17719)) +
			((int) ($jd / 5670)) *
			((int) (43 * $jd / 15238));
		$jd = $jd - ((int) ((30 - $j) / 15)) *
			((int) ((17719 * $j) / 50)) -
			((int) ($j / 16)) *
			((int) ((15238 * $j) / 43)) + 29;
		$m = (int) (24 * $jd / 709);
		$d = $jd - (int) (709 * $m / 24);
		$y = 30 * $n + $j - 30;

		return array($m, $d, $y);
	}
	function HijriToJD($m, $d, $y)
	{
		return (int) ((11 * $y + 3) / 30) +
			354 * $y + 30 * $m -
			(int) (($m - 1) / 2) + $d + 1948440 - 385;
	}
}
;
function format_hijriah($t)
{
	$hijri = HijriCalendar::GregorianToHijri($t);
	return $hijri[1] . ' ' . HijriCalendar::monthName($hijri[0]) . ' ' . $hijri[2];
}
function hari_ini($hari)
{
	switch ($hari) {
		case $hari == "Sunday":
			// code...
			return 'minggu';
			break;
		case $hari == "Monday":
			// code...
			return 'senin';
			break;
		case $hari == "Tuesday":
			// code...
			return 'selasa';
			break;
		case $hari == "Wednesday":
			// code...
			return 'rabu';
			break;
		case $hari == "Thursday":
			// code...
			return 'kamis';
			break;
		case $hari == "Friday":
			// code...
			return 'jumat';
			break;
		case $hari == "Saturday":
			// code...
			return 'sabtu';
			break;
	}
}

?>
<?php

function disk_kosong($path)
{
	$bytes = disk_free_space($path);
	$si_prefix = array('B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB');
	$base = 1024;
	$class = min((int) log($bytes, $base), count($si_prefix) - 1);
	$disk = sprintf('%1.2f', $bytes / pow($base, $class)) . ' ' . $si_prefix[$class] . '<br />';

	return $disk;
}

function disk_digunakan($path)
{
	$bytes = disk_total_space($path);
	$si_prefix = array('B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB');
	$base = 1024;
	$class = min((int) log($bytes, $base), count($si_prefix) - 1);
	$disk = sprintf('%1.2f', $bytes / pow($base, $class)) . ' ' . $si_prefix[$class] . '<br />';

	return $disk;
}



function folderSize($dir)
{
	$count_size = 0;
	$count = 0;
	$dir_array = scandir($dir);
	foreach ($dir_array as $key => $filename) {
		if ($filename != ".." && $filename != ".") {
			if (is_dir($dir . "/" . $filename)) {
				$new_foldersize = foldersize($dir . "/" . $filename);
				$count_size = $count_size + $new_foldersize;
			} else if (is_file($dir . "/" . $filename)) {
				$count_size = $count_size + filesize($dir . "/" . $filename);
				$count++;
			}
		}
	}

	return $count_size;
}

function sizeFormat($bytes)
{
	$kb = 1024;
	$mb = $kb * 1024;
	$gb = $mb * 1024;
	$tb = $gb * 1024;

	if (($bytes >= 0) && ($bytes < $kb)) {
		return $bytes . ' B';
	} elseif (($bytes >= $kb) && ($bytes < $mb)) {
		return ceil($bytes / $kb) . ' KB';
	} elseif (($bytes >= $mb) && ($bytes < $gb)) {
		return ceil($bytes / $mb) . ' MB';
	} elseif (($bytes >= $gb) && ($bytes < $tb)) {
		return ceil($bytes / $gb) . ' GB';
	} elseif ($bytes >= $tb) {
		return ceil($bytes / $tb) . ' TB';
	} else {
		return $bytes . ' B';
	}
}




class RequestPencarianTanggal
{
	private $input_value;

	public function __construct($input_name)
	{
		if (isset($_GET[$input_name])) {
			$this->input_value = xss($_GET[$input_name]);
		}
	}

	public function isValid()
	{
		$d = DateTime::createFromFormat('Y-m-d', $this->input_value);
		return $d && $d->format('Y-m-d') == $this->input_value;
	}

	public function toShortenedString()
	{
		if ($this->isValid()) {
			$d = DateTime::createFromFormat('Y-m-d', $this->input_value);
			return $d->format('d M Y');
		} else {
			return 'Invalid Date';
		}
	}

	public function getValue()
	{
		return $this->input_value;
	}
}


class RequestPencarianNominal
{
	private $input_value;

	public function __construct($input_name)
	{
		if (isset($_GET[$input_name])) {
			$this->input_value = xss($_GET[$input_name]);
		}
	}

	public function isValid()
	{
		return is_numeric($this->input_value);
	}

	public function toShortenedString()
	{
		if ($this->isValid()) {
			return number_format($this->input_value, 0, ',', '.');
		} else {
			return 'Invalid Amount';
		}
	}

	public function getValue()
	{
		return $this->input_value;
	}
}

class RequestPencarianStatus
{
	private $input_value;

	public function __construct($input_name)
	{
		if (isset($_GET[$input_name])) {
			$this->input_value = xss($_GET[$input_name]);
		}
	}

	public function isValid()
	{
		return in_array($this->input_value, ['Used', 'Unused']);
	}

	public function getValue()
	{
		return $this->input_value;
	}
}

class RequestPencarianBulan
{
	private $input_value;

	public function __construct($input_name)
	{
		if (isset($_GET[$input_name])) {
			$this->input_value = xss($_GET[$input_name]);
		} else {
			$this->input_value = date('m');
		}
	}

	public function isValid()
	{
		return is_numeric($this->input_value) && $this->input_value >= 1 && $this->input_value <= 12;
	}

	public function getValue()
	{
		return $this->input_value;
	}
}

class RequestPencarianTahun
{
	private $input_value;

	public function __construct($input_name)
	{
		if (isset($_GET[$input_name])) {
			$this->input_value = xss($_GET[$input_name]);
		} else {
			$this->input_value = date('Y');
		}
	}

	public function isValid()
	{
		return is_numeric($this->input_value);
	}


	public function getValue()
	{
		return $this->input_value;
	}
}

class RequestString
{
	private $input_value;

	public function __construct($input_name)
	{
		if (isset($_GET[$input_name])) {
			$this->input_value = xss($_GET[$input_name]);
		}
	}

	public function getValue()
	{
		return $this->input_value;
	}

	public function isValid()
	{
		return $this->input_value != '' && $this->input_value != null && $this->input_value != 'null';
	}
}



function createHiddenFieldsFromGetExclude($excludeKeys = [])
{
	$fields = '';
	foreach ($_GET as $key => $value) {
		if (!in_array($key, $excludeKeys)) {
			$fields .= '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '">';
		}
	}
	return $fields;
}

class SettingVoucher
{

	public static $ppn = "ppn";
	public static $jatuh_tempo = "jatuh-tempo";
	public static $kadaluarsa = "kadaluarsa";

	public static function get_number($nama)
	{
		global $dbh;

		$stmt = $dbh->prepare("SELECT isi FROM data_pengaturan_voucher WHERE nama = ? AND status='Aktif'");
		$stmt->execute([$nama]);

		$isi = $stmt->fetchColumn();

		if ($isi == null) {
			throw new Exception("setting dengan nama $nama tidak ditemukan");
		}

		if (!is_numeric($isi)) {
			throw new Exception("setting $nama harus berupa angka");
		}

		return $isi;
	}
}



class PencarianBuilder
{
	private $includes = [];
	private $queries = [];

	private $render_html = [];
	private $berdasarkan;
	private $isi;

	public function add($column, $query, $column_display)
	{
		$this->includes[] = $column;
		$this->queries[$column] = [$query, $column_display];

		return $this;
	}

	public function render()
	{
		global $dbh;

		foreach ($this->queries as $key => $value) {
			$result = "";
			$stmt = $dbh->prepare($value[0]);
			$stmt->execute();
			$datas = $stmt->fetchAll();

			$result = "<select class='form-control' name='isi'>";
			foreach ($datas as $data) {
				$selected = $this->isi == $data[$key] ? 'selected' : '';
				$result .= "<option $selected value='" . $data[$key] . "'>" . $data[$value[1]] . "</option>";
			}
			$result .= "</select>";

			$this->render_html[$key] = $result;
		}
		?>
		<tr>
			<td>Pencarian</td>
			<td>:</td>
			<td id="main-isi">
			</td>
			<td>
				<?php btn_cari('Cari'); ?>
			</td>
		</tr>
		<script>
			var defaultIsi = document.getElementById("main-isi");
			var berdasarkan = document.getElementById("Berdasarkan");
			var excludeColumns = <?php echo json_encode($this->includes); ?>;
			var inputs = <?php echo json_encode($this->render_html) ?>;

			berdasarkan.onchange = function (e) {
				var selectedValue = e.target.value;
				if (excludeColumns.includes(selectedValue)) {
					defaultIsi.innerHTML = inputs[selectedValue];
				} else {
					defaultIsi.innerHTML = `
								<input type="text" class="form-control"
									name="isi" id="isi" value="<?= $this->isi ?>">

							`;
				}
			};
			berdasarkan.dispatchEvent(new Event('change'));
		</script>
		<?php

	}

	public function value($berdasarkan, $isi)
	{
		$this->berdasarkan = $berdasarkan;
		$this->isi = $isi;

		return $this;
	}
}



function potongTeks($teks, $panjang = 10)
{
	// Memeriksa apakah panjang teks lebih dari batas yang ditentukan
	if (strlen($teks) > $panjang) {
		// Memotong teks dan menambahkan elipsis
		return substr($teks, 0, $panjang) . '...';
	} else {
		// Mengembalikan teks asli jika tidak melebihi batas
		return $teks;
	}
}

?>