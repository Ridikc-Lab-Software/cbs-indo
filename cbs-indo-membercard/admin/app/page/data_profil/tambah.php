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
								<label>id&nbsp;profil <span class="highlight">*</span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input type="readonly" readonly value="<?php echo id_otomatis("data_profil", "id_profil", "10"); ?>" name="id_profil" placeholder="id_profil" id="id_profil" required="required">
							</td>
						</tr>

						<tr>
							<td width="25%" class="leftrowcms">
								<label>Nama <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input onkeypress='return h(event)' class='form-control' type="text" name="nama" id="nama" placeholder="Nama" required="required">


							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Alamat <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<textarea class='form-control' type="text" name="alamat" id="alamat" placeholder="Alamat" required="required">

</textarea>
							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Nomor Telepon SPBU 1 <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input onkeypress='return a(event)' class='form-control' type="text" name="no_telepon1" id="no_telepon1" placeholder="No&nbsp;Telepon SPBU 1" required="required">


							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Nomor Telepon SPBU 2 <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input onkeypress='return a(event)' class='form-control' type="text" name="no_telepon2" id="no_telepon2" placeholder="No&nbsp;Telepon SPBU 2" required="required">


							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Sejarah <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<textarea class='ckeditor' type="text" name="sejarah" id="sejarah" placeholder="Sejarah" required="required">

</textarea>
							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Visi <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<textarea class='ckeditor' type="text" name="visi" id="visi" placeholder="Visi" required="required">

</textarea>
							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Misi <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<textarea class='ckeditor' type="text" name="misi" id="misi" placeholder="Misi" required="required">

</textarea>
							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Deskripsi <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<textarea class='ckeditor' type="text" name="deskripsi" id="deskripsi" placeholder="Deskripsi" required="required">

</textarea>
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