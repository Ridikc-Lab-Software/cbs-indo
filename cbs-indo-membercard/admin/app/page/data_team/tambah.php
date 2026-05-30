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
								<label>id&nbsp;team <span class="highlight">*</span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input type="readonly" readonly value="<?php echo id_otomatis("data_team", "id_team", "10"); ?>" name="id_team" placeholder="id_team" id="id_team" required="required">
							</td>
						</tr>

						<tr>
							<td width="25%" class="leftrowcms">
								<label>Nama&nbsp;Team <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input onkeypress='return h(event)' class='form-control' type="text" name="nama_team" id="nama_team" placeholder="Nama&nbsp;Team" required="required">


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
								<label>Email <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' type="email" name="email" id="email" placeholder="Email" required="required">


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
								<label>Telepon <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' type="text" name="telepon" id="telepon" placeholder="Telepon" required="required">


							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Bagian <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' type="text" name="bagian" id="bagian" placeholder="Bagian" required="required">


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