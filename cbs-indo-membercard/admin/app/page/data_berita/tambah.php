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
								<label>id&nbsp;berita <span class="highlight">*</span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input type="readonly" readonly value="<?php echo id_otomatis("data_berita", "id_berita", "10"); ?>" name="id_berita" placeholder="id_berita" id="id_berita" required="required">
							</td>
						</tr>

						<tr>
							<td width="25%" class="leftrowcms">
								<label>Tanggal <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' value="<?php echo tanggal_otomatis(); ?>" type="date" name="tanggal" id="tanggal" placeholder="Tanggal" required="required">


							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Judul <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' type="text" name="judul" id="judul" placeholder="Judul" required="required">


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
								<label>Isi <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<textarea class='ckeditor' type="text" name="isi" id="isi" placeholder="Isi" required="required">

</textarea>
							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Kategori Berita<span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<select name="kategori_berita">
									<option></option><?php combo_enum("data_berita", "kategori_berita", "") ?>
								</select>
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