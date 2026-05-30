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
								<label>id&nbsp;transaksi <span class="highlight">*</span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input type="readonly" readonly value="<?php echo id_otomatis("data_transaksi", "id_transaksi", "10"); ?>" name="id_transaksi" placeholder="id_transaksi" id="id_transaksi" required="required">
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
								<label>Jam <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' type="time" name="jam" id="jam" placeholder="Jam" required="required">


							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Id&nbsp;Member <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>

								<select class='form-control' data-live-search='true' type="text" name="id_member" id="id_member" placeholder="Id&nbsp;Member" required="required">
									<option></option><?php combo_database2('data_member', 'id_member', 'nama', ''); ?>
								</select>
							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Id&nbsp;Petugas <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>

								<select class='form-control' data-live-search='true' type="text" name="id_petugas" id="id_petugas" placeholder="Id&nbsp;Petugas" required="required">
									<option></option><?php combo_database2('data_petugas', 'id_petugas', 'nama', ''); ?>
								</select>
							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Id&nbsp;Kategori&nbsp;Member <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>

								<select class='form-control' data-live-search='true' type="text" name="id_kategori_member" id="id_kategori_member" placeholder="Id&nbsp;Kategori&nbsp;Member" required="required">
									<option></option><?php combo_database('data_kategori_member', 'kategori_member', ''); ?>
								</select>
							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Id&nbsp;Jenis&nbsp;Transaksi <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>

								<select class='form-control' data-live-search='true' type="text" name="id_jenis_transaksi" id="id_jenis_transaksi" placeholder="Id&nbsp;Jenis&nbsp;Transaksi" required="required">
									<option></option><?php combo_database('data_jenis_transaksi', 'jenis_transaksi', ''); ?>
								</select>
							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Point <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' type="text" name="point" id="point" placeholder="Point" required="required">


							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Kategori&nbsp;Jumlah <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>

								<select class='form-control' data-live-search='true' type="enum" name="kategori_jumlah" id="kategori_jumlah" placeholder="Kategori&nbsp;Jumlah" required="required">
									<option></option><?php combo_enum('data_transaksi', 'kategori_jumlah', ''); ?>
								</select>
							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Jumlah <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' type="text" name="jumlah" id="jumlah" placeholder="Jumlah" required="required">


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