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
								<label>id&nbsp;pengaturan&nbsp;point <span class="highlight">*</span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input type="readonly" readonly value="<?php echo id_otomatis("data_pengaturan_point", "id_pengaturan_point", "10"); ?>" name="id_pengaturan_point" placeholder="id_pengaturan_point" id="id_pengaturan_point" required="required">
							</td>
						</tr>

						<tr>
							<td width="25%" class="leftrowcms">
								<label>Nama&nbsp;Pengaturan <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input onkeypress='return h(event)' class='form-control' type="text" name="nama_pengaturan" id="nama_pengaturan" placeholder="Nama&nbsp;Pengaturan" required="required">


							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Id&nbsp;Kategori&nbsp;Member <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>

								<select class='form-control' data-live-search='true' type="text" name="id_kategori_member" id="id_kategori_member" placeholder="Id&nbsp;Kategori&nbsp;Member" required="required">
									<option></option><?php combo_database2('data_kategori_member', 'id_kategori_member', 'kategori_member', ''); ?>
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
									<option></option><?php combo_database2('data_jenis_transaksi', 'id_jenis_transaksi', 'jenis_transaksi', ''); ?>
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