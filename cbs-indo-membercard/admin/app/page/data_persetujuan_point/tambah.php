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
$cek = mysqli_query($con_mysqli, "SELECT * FROM data_persetujuan_point");
$rowcek = mysqli_num_rows($cek);
if ($rowcek > 0) {
	$id_persetujuan_point = mysqli_query($con_mysqli, "SELECT max(id_persetujuan_point) as id_persetujuan_point FROM data_persetujuan_point");
	$data_persetujuan_point = mysqli_fetch_array($id_persetujuan_point);
	$id_persetujuan_point_akhir = $data_persetujuan_point['id_persetujuan_point'];
	$id_persetujuan_point_otomatis = autonumber($id_persetujuan_point_akhir, 3, 3);
} else {
	$kodedepan = strtoupper('data_persetujuan_point');
	$kodedepan = str_replace("DATA_", "", $kodedepan);
	$kodedepan = str_replace("DATA", "", $kodedepan);
	$kodedepan = str_replace("TABEL_", "", $kodedepan);
	$kodedepan = str_replace("TABEL", "", $kodedepan);
	$kodedepan = str_replace("TABLE_", "", $kodedepan);
	$kodedepan = strtoupper(substr($kodedepan, 0, 3));
	$id_persetujuan_point_otomatis = $kodedepan . "001";
}

?>

<a href="<?php index(); ?>">
	<?php btn_kembali(' KEMBALI'); ?>
</a>

<br><br>

<div class="content-box">
	<div class="content-box-persetujuan_point" style="height: 39px">Tambah<h3></h3>
	</div>
	<form action="proses_simpan.php" enctype="multipart/form-data" method="post">
		<div class="content-box-content">
			<div id="postcustom">
				<table <?php tabel_in(100, '%', 0, 'center');  ?>>
					<tbody>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Id&nbsp;Persetujuan&nbsp;Point <span class="highlight">*</span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input type="readonly" readonly value="<?php echo $id_persetujuan_point_otomatis; ?>" name="id_persetujuan_point" placeholder="id_persetujuan_point" id="id_persetujuan_point" required="required">
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