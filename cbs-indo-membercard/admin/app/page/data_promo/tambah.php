<div class="content-box">
	<form action="proses_simpan.php" enctype="multipart/form-data" method="post">
		<div class="content-box-content">
			<div id="postcustom">
				<table <?php tabel_in(100, '%', 0, 'center');  ?>>
					<tbody>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>id&nbsp;promo <span class="highlight">*</span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input type="readonly" readonly value="<?php echo id_otomatis("data_promo", "id_promo", "10"); ?>" name="id_promo" placeholder="id_promo" id="id_promo" required="required">
							</td>
						</tr>

						<tr>
							<td width="25%" class="leftrowcms">
								<label>Tanggal&nbsp;Mulai&nbsp;Berlaku <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' value="<?php echo tanggal_otomatis(); ?>" type="date" name="tanggal_mulai_berlaku" id="tanggal_mulai_berlaku" placeholder="Tanggal&nbsp;Mulai&nbsp;Berlaku" required="required">


							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Tanggal&nbsp;Batas&nbsp;Berlaku <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' value="<?php echo tanggal_otomatis(); ?>" type="date" name="tanggal_batas_berlaku" id="tanggal_batas_berlaku" placeholder="Tanggal&nbsp;Batas&nbsp;Berlaku" required="required">


							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Aktifkan&nbsp;Pembatasan&nbsp;Waktu <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>

								<select class='form-control' data-live-search='true' type="enum" name="aktifkan_pembatasan_waktu" id="aktifkan_pembatasan_waktu" placeholder="Aktifkan&nbsp;Pembatasan&nbsp;Waktu" required="required">
									<option></option><?php combo_enum('data_promo', 'aktifkan_pembatasan_waktu', ''); ?>
								</select>
							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Nama&nbsp;Promo <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' type="text" name="nama_promo" id="nama_promo" placeholder="Nama&nbsp;Promo" required="required">


							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Keterangan <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<textarea class='form-control' type="text" name="keterangan" id="keterangan" placeholder="Keterangan" required="required">

</textarea>
							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Syarat&nbsp;Dan&nbsp;Ketentuan <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<textarea class='form-control' type="text" name="syarat_dan_ketentuan" id="syarat_dan_ketentuan" placeholder="Syarat&nbsp;Dan&nbsp;Ketentuan" required="required">

</textarea>
							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Foto&nbsp;Promo <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' type="file" name="foto_promo" id="foto_promo" placeholder="Foto&nbsp;Promo" required="required">


							</td>
						</tr>

						<input class='form-control' type="hidden" name="jumlah_point" id="jumlah_point" placeholder="Jumlah&nbsp;Point" required="required">


						<?php
						$querytabel1 = "SELECT * FROM data_kategori_member ";
						$proses1 = mysql_query($querytabel1);
						while ($data1 = mysql_fetch_array($proses1)) { ?>
							<tr>
								<td style="color:green" width="25%" class="leftrowcms">
									<label>Point Redeem <b><?php echo ($data1['kategori_member']); ?></b><span class="highlight"></span></label>
								</td>
								<td width="2%">:</td>
								<td>
									<input class='form-control' type="text" name="jumlah_point_<?php echo ($data1['kategori_member']); ?>" id="jumlah_point_<?php echo ($data1['kategori_member']); ?>" placeholder=" Point Redeem <?php echo ($data1['kategori_member']); ?>" required="required">
								</td>
							</tr>
							<tr>
								<td width="25%" class="leftrowcms">
									<label>Redeem Value <b><?php echo ($data1['kategori_member']); ?></b><span class="highlight"></span></label>
								</td>
								<td width="2%">:</td>
								<td>
									<input class='form-control' type="text" name="jumlah_value_<?php echo ($data1['kategori_member']); ?>" id="jumlah_value_<?php echo ($data1['kategori_member']); ?>" placeholder="Redeem value <?php echo ($data1['kategori_member']); ?>" required="required">
								</td>
							</tr>
						<?php
						}
						?>




						<tr>
							<td width="25%" class="leftrowcms">
								<label>Mitra <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>

								<input readonly value="<?php echo $id_mitra = $_GET['isi']; ?>" class='form-control' data-live-search='true' type="hidden" name="id_mitra" id="id_mitra" placeholder="Id&nbsp;Mitra" required="required">
								<?php echo baca_database("", "nama_mitra", "select * from data_mitra where id_mitra='$id_mitra'"); ?>
							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Status <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>

								<select class='form-control' data-live-search='true' type="enum" name="status" id="status" placeholder="Status" required="required">
									<option></option><?php combo_enum('data_promo', 'status', ''); ?>
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