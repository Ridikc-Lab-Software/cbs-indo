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
								<label>id&nbsp;Slide Company<span class="highlight">*</span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input type="readonly" readonly value="<?php echo id_otomatis("data_slide", "id_slide", "10"); ?>" name="id_slide" placeholder="id_slide" id="id_slide" required="required">
							</td>
						</tr>

						<tr>
							<td width="25%" class="leftrowcms">
								<label>Foto<span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' value="" type="file" name="foto" id="foto" placeholder="Foto" required="required">
							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Header<span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' type="text" name="header" id="header" placeholder="Header" required="required">


							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Judul 1 <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' type="text" name="judul1" id="judul1" placeholder="Judul1" required="required">


							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Caption 1 <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<textarea class='ckeditor' type="text" name="caption1" id="caption1" placeholder="Caption1" required="required">
                </textarea>
							</td>
						</tr>

						<tr>
							<td width="25%" class="leftrowcms">
								<label>Judul 2 <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' type="text" name="judul2" id="judul2" placeholder="Judul2" required="required">


							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Caption 2 <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<textarea class='ckeditor' type="text" name="caption2" id="caption2" placeholder="caption2" required="required">
                </textarea>
							</td>
						</tr>

						<tr>
							<td width="25%" class="leftrowcms">
								<label>Judul 3 <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' type="text" name="judul3" id="judul3" placeholder="Judul3" required="required">


							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label> Caption 3 <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<textarea class='ckeditor' type="text" name="caption3" id="isi" placeholder="Isi" required="required">
                </textarea>
							</td>
						</tr>

						<tr>
							<td width="25%" class="leftrowcms">
								<label>Judul 4 <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' type="text" name="judul4" id="judul4" placeholder="Judul4" required="required">


							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label> Caption 4 <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<textarea class='ckeditor' type="text" name="caption4" id="isi" placeholder="Isi" required="required">
                </textarea>
							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Judul 5 <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' type="text" name="judul5" id="judul5" placeholder="Judul5" required="required">


							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label> Caption 5 <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<textarea class='ckeditor' type="text" name="caption5" id="isi" placeholder="Isi" required="required">
                </textarea>
							</td>
						</tr>

						<tr>
							<td width="25%" class="leftrowcms">
								<label>Nama <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' type="text" name="nama" id="nama" placeholder="nama" required="required">


							</td>
						</tr>

						<tr>
							<td width="25%" class="leftrowcms">
								<label>Jabatan <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' type="text" name="jabatan" id="jabatan" placeholder="jabatan" required="required">


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