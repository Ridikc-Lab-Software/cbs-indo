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
								<label>id&nbsp;mitra <span class="highlight">*</span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input type="readonly" readonly value="<?php echo id_otomatis("data_mitra", "id_mitra", "10"); ?>" name="id_mitra" placeholder="id_mitra" id="id_mitra" required="required">
							</td>
						</tr>

						<tr>
							<td width="25%" class="leftrowcms">
								<label>Nama&nbsp;Mitra <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input onkeypress='return h(event)' class='form-control' type="text" name="nama_mitra" id="nama_mitra" placeholder="Nama&nbsp;Mitra" required="required">


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
								<label>No&nbsp;Telepon <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input onkeypress='return a(event)' class='form-control' type="text" name="no_telepon" id="no_telepon" placeholder="No&nbsp;Telepon" required="required">


							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Nama&nbsp;Pemilik <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input onkeypress='return h(event)' class='form-control' type="text" name="nama_pemilik" id="nama_pemilik" placeholder="Nama&nbsp;Pemilik" required="required">


							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>No&nbsp;Telepon&nbsp;Pemilik <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input onkeypress='return a(event)' class='form-control' type="text" name="no_telepon_pemilik" id="no_telepon_pemilik" placeholder="No&nbsp;Telepon&nbsp;Pemilik" required="required">


							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Tanggal&nbsp;Daftar <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' value="<?php echo tanggal_otomatis(); ?>" type="date" name="tanggal_daftar" id="tanggal_daftar" placeholder="Tanggal&nbsp;Daftar" required="required">


							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Username <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' type="text" name="username" id="username" placeholder="Username" required="required">


							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Password <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' type="password" name="password" id="password" placeholder="Password" required="required">


							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Status <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>

								<select class='form-control' data-live-search='true' type="enum" name="status" id="status" placeholder="Status" required="required">
									<option></option><?php combo_enum('data_mitra', 'status', ''); ?>
								</select>
							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Gambar&nbsp;Logo <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' type="file" name="gambar_logo" id="gambar_logo" placeholder="Gambar&nbsp;Logo" required="required">


							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>SPBU <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<select class='form-control' type="text" name="spbu" id="spbu" placeholder="spbu"
									required="required">
									<?php combo_database("data_spbu", "nama_spbu", ""); ?>
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