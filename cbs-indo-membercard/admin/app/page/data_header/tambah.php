<?php

//KODE OTOMATIS	 	
function autonumber($id_terakhir, $panjang_kode, $panjang_angka)
{
	$kode = substr($id_terakhir, 0, $panjang_kode);
	$angka = substr($id_terakhir, $panjang_kode, $panjang_angka);
	$angka_baru = str_repeat("0", $panjang_angka - strlen($angka + 1)) . ($angka + 1);
	$id_baru = $kode . $angka_baru;
	return $id_baru;
}
$cek = mysqli_query($con_mysqli, "SELECT * FROM data_header");
$rowcek = mysqli_num_rows($cek);
if ($rowcek > 0) {
	$id_header = mysqli_query($con_mysqli, "SELECT max(id_header) as id_header FROM data_header");
	$data_header = mysqli_fetch_array($id_header);
	$id_header_akhir = $data_header['id_header'];
	$id_header_otomatis = autonumber($id_header_akhir, 3, 3);
} else {
	$kodedepan = strtoupper('data_header');
	$kodedepan = str_replace("DATA_", "", $kodedepan);
	$kodedepan = str_replace("DATA", "", $kodedepan);
	$kodedepan = str_replace("TABEL_", "", $kodedepan);
	$kodedepan = str_replace("TABEL", "", $kodedepan);
	$kodedepan = str_replace("TABLE_", "", $kodedepan);
	$kodedepan = strtoupper(substr($kodedepan, 0, 3));
	$id_header_otomatis = $kodedepan . "001";
}

?>

<a href="<?php index(); ?>">
	<?php btn_kembali(' KEMBALI'); ?>
</a>

<br><br>

<div class="content-box">
	<div class="content-box-header" style="height: 39px">Tambah<h3></h3>
	</div>
	<form action="proses_simpan.php" enctype="multipart/form-data" method="post">
		<div class="content-box-content">
			<div id="postcustom">
				<table <?php tabel_in(100, '%', 0, 'center');  ?>>
					<tbody>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>id&nbsp;header <span class="highlight">*</span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input type="readonly" readonly value="<?php echo $id_header_otomatis; ?>" name="id_header" placeholder="id_header" id="id_header" required="required">
							</td>
						</tr>



						<tr>
							<td width="25%" class="leftrowcms">
								<label>Foto <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' type="file" name="foto" id="foto" placeholder="Foto" required="required">


							</td>
						</tr>

						<tr>
							<td width="25%" class="leftrowcms">
								<label>judul<span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' type="text" name="judul" id="judul" placeholder="Judul&nbsp;Header" required="required">


							</td>
						</tr>




						<tr>
							<td width="25%" class="leftrowcms">
								<label>Keterangan <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<textarea class='ckeditor' type="text" name="keterangan" id="keterangan" placeholder="Keterangan" required="required">

</textarea>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="content-box-content">
					<center>
						<?php btn_simpan(' SIMPAN'); ?>
					</center>
				</div>
			</div>
		</div>
	</form>