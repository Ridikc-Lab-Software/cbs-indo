<a href="<?php index(); ?>">
	<?php btn_kembali(' KEMBALI'); ?>
</a>

<br><br>

<div class="content-box">
	<div class="content-box-header" style="height: 39px">Edit<h3></h3>
	</div>
	<form action="proses_update.php" enctype="multipart/form-data" method="post">
		<div class="content-box-content">
			<div id="postcustom">
				<table <?php tabel_in(100, '%', 0, 'center');  ?>>
					<tbody>
						<?php

						if (!isset($_GET['proses'])) {
						?>
							<script>
								alert("AKSES DITOLAK");
								location.href = "index.php";
							</script>
						<?php
							die();
						}
						$proses = decrypt(mysql_real_escape_string($_GET['proses']));
						$sql = mysql_query("SELECT * FROM data_promo where id_promo = '$proses'");
						$data = mysql_fetch_array($sql);
						?>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>id&nbsp;promo <font color="red">*</font></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input type="%typepertama%" name="id_promo" value="<?php echo $id_promo =  $data['id_promo']; ?>" readonly id="id_promo" required="required">
							</td>
						</tr>

						<tr>
							<td width="25%" class="leftrowcms">
								<label>Tanggal&nbsp;Mulai&nbsp;Berlaku <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' required="required" type="date" name="tanggal_mulai_berlaku" id="tanggal_mulai_berlaku" placeholder="Tanggal&nbsp;Mulai&nbsp;Berlaku" value="<?php echo ($data['tanggal_mulai_berlaku']); ?>">



							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Tanggal&nbsp;Batas&nbsp;Berlaku <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' required="required" type="date" name="tanggal_batas_berlaku" id="tanggal_batas_berlaku" placeholder="Tanggal&nbsp;Batas&nbsp;Berlaku" value="<?php echo ($data['tanggal_batas_berlaku']); ?>">



							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Aktifkan&nbsp;Pembatasan&nbsp;Waktu <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<select class='form-control' data-live-search='true' required="required" type="enum" name="aktifkan_pembatasan_waktu" id="aktifkan_pembatasan_waktu" placeholder="Aktifkan&nbsp;Pembatasan&nbsp;Waktu" value="<?php echo ($data['aktifkan_pembatasan_waktu']); ?>">
									<option value='<?php echo $data[aktifkan_pembatasan_waktu]; ?>'>- <?php echo $data[aktifkan_pembatasan_waktu]; ?> -</option><?php combo_enum('data_promo', 'aktifkan_pembatasan_waktu', ''); ?>
								</select>

							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Nama&nbsp;Promo <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input onkeypress='return h(event)' class='form-control' required="required" type="text" name="nama_promo" id="nama_promo" placeholder="Nama&nbsp;Promo" value="<?php echo ($data['nama_promo']); ?>">



							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Keterangan <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<textarea class='form-control' required="required" type="text" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php echo ($data['keterangan']); ?>">
<?php echo $data['keterangan'] ?>
</textarea>

							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Syarat&nbsp;Dan&nbsp;Ketentuan <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<textarea class='form-control' required="required" type="text" name="syarat_dan_ketentuan" id="syarat_dan_ketentuan" placeholder="Syarat&nbsp;Dan&nbsp;Ketentuan" value="<?php echo ($data['syarat_dan_ketentuan']); ?>">
<?php echo $data['syarat_dan_ketentuan'] ?>
</textarea>

							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Foto&nbsp;Promo<span class="highlight">*</span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<a href='../../../../admin/upload/<?php echo $data['foto_promo']; ?>'><img onerror="this.src='<?php echo $imageerror; ?>'" width='100' height='60' src='../../../../admin/upload/<?php echo $data['foto_promo']; ?>'></a>
								<br>
								<?php echo $data['foto_promo']; ?>
								<input type="hidden" name="foto_promo1" value="<?php echo $data['foto_promo']; ?>">
								<br>
								<input class='form-control' type="file" name="foto_promo" id="foto_promo" placeholder="Foto&nbsp;Promo" value="<?php echo ($data['foto_promo']); ?>">



							</td>
						</tr>

						<?php
						$querytabel1 = "SELECT * FROM data_kategori_member ";
						$proses1 = mysql_query($querytabel1);
						while ($data1 = mysql_fetch_array($proses1)) {
							$id_kategori_member = $data1['id_kategori_member'];
						?>

							<tr>
								<td style="color:green" width="25%" class="leftrowcms">
									<label>Point Redeem <b><?php echo ($data1['kategori_member']); ?></b><span class="highlight"></span></label>
								</td>
								<td width="2%">:</td>
								<td>

									<input class='form-control' type="text" name="jumlah_point_<?php echo ($data1['kategori_member']); ?>" id="jumlah_point_<?php echo ($data1['kategori_member']); ?>" placeholder=" Point Redeem <?php echo ($data1['kategori_member']); ?>"
										value="<?php
												echo baca_database("", "point", "select * from data_point_promo where id_promo='$id_promo' and id_kategori_member='$id_kategori_member'"); ?>"
										required="required">

								</td>
							</tr>


							<tr>
								<td width="25%" class="leftrowcms">
									<label>Redeem Value <b><?php echo ($data1['kategori_member']); ?></b><span class="highlight"></span></label>
								</td>
								<td width="2%">:</td>
								<td>
									<input class='form-control' value="<?php
																		echo baca_database("", "value", "select * from data_point_promo where id_promo='$id_promo' and id_kategori_member='$id_kategori_member'"); ?>" type="text" name="jumlah_value_<?php echo ($data1['kategori_member']); ?>" id="jumlah_value_<?php echo ($data1['kategori_member']); ?>" placeholder="Redeem value <?php echo ($data1['kategori_member']); ?>" required="required">
								</td>
							</tr>


						<?php
						}
						?>

						<tr>
							<td width="25%" class="leftrowcms">
								<label>Id&nbsp;Mitra <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<!-- -->
								<select class='form-control' data-live-search='true' required="required" type="text" name="id_mitra" id="id_mitra" placeholder="Id&nbsp;Mitra" value="<?php echo ($data['id_mitra']); ?>">
									<option value='<?php echo $data[id_mitra]; ?>'>- <?php echo $data[id_mitra]; ?> -</option><?php combo_database2('data_mitra', 'id_mitra', 'nama_mitra', ''); ?>
								</select>

							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Status <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<select class='form-control' data-live-search='true' required="required" type="enum" name="status" id="status" placeholder="Status" value="<?php echo ($data['status']); ?>">
									<option value='<?php echo $data[status]; ?>'>- <?php echo $data[status]; ?> -</option><?php combo_enum('data_promo', 'status', ''); ?>
								</select>

							</td>
						</tr>

					</tbody>
				</table>
				<div class="content-box-content">
					<center>
						<?php btn_update(' UPDATE'); ?>
					</center>
				</div>
			</div>
		</div>
	</form>