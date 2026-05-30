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
						$sql = mysql_query("SELECT * FROM data_mitra where id_mitra = '$proses'");
						$data = mysql_fetch_array($sql);
						?>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>id&nbsp;mitra <font color="red">*</font></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input type="%typepertama%" name="id_mitra" value="<?php echo $data['id_mitra']; ?>" readonly id="id_mitra" required="required">
							</td>
						</tr>

						<tr>
							<td width="25%" class="leftrowcms">
								<label>Nama&nbsp;Mitra <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input onkeypress='return h(event)' class='form-control' required="required" type="text" name="nama_mitra" id="nama_mitra" placeholder="Nama&nbsp;Mitra" value="<?php echo ($data['nama_mitra']); ?>">



							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Alamat <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<textarea class='form-control' required="required" type="text" name="alamat" id="alamat" placeholder="Alamat" value="<?php echo ($data['alamat']); ?>">
<?php echo $data['alamat'] ?>
</textarea>

							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>No&nbsp;Telepon <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input onkeypress='return a(event)' class='form-control' required="required" type="text" name="no_telepon" id="no_telepon" placeholder="No&nbsp;Telepon" value="<?php echo ($data['no_telepon']); ?>">



							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Nama&nbsp;Pemilik <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input onkeypress='return h(event)' class='form-control' required="required" type="text" name="nama_pemilik" id="nama_pemilik" placeholder="Nama&nbsp;Pemilik" value="<?php echo ($data['nama_pemilik']); ?>">



							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>No&nbsp;Telepon&nbsp;Pemilik <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input onkeypress='return a(event)' class='form-control' required="required" type="text" name="no_telepon_pemilik" id="no_telepon_pemilik" placeholder="No&nbsp;Telepon&nbsp;Pemilik" value="<?php echo ($data['no_telepon_pemilik']); ?>">



							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Tanggal&nbsp;Daftar <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' required="required" type="date" name="tanggal_daftar" id="tanggal_daftar" placeholder="Tanggal&nbsp;Daftar" value="<?php echo ($data['tanggal_daftar']); ?>">



							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Username <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' required="required" type="text" name="username" id="username" placeholder="Username" value="<?php echo ($data['username']); ?>">



							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>password Lama<span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' type="password" name="password_lama" id="password_lama" placeholder="password lama" value="">
								<input type="hidden" name="password_validasi" id="password_validasi" placeholder="password_validasi" value="<?php echo encrypt($data['password']); ?>">
								<br>Masukkan password Lama untuk Validasi, Kosongkan jika tidak ingin mengganti password
							</td>
						</tr>

						<tr>
							<td width="25%" class="leftrowcms">
								<label>password Baru<span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' type="password" name="password" id="password" placeholder="password baru" value="">
								<br>Kosongkan jika tidak ingin mengganti password
							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Status <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<select class='form-control' data-live-search='true' required="required" type="enum" name="status" id="status" placeholder="Status" value="<?php echo ($data['status']); ?>">
									<option value='<?php echo $data['status']; ?>'>- <?php echo $data['status']; ?> -</option><?php combo_enum('data_mitra', 'status', ''); ?>
								</select>

							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Gambar&nbsp;Logo<span class="highlight">*</span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<a href='../../../../admin/upload/<?php echo $data['gambar_logo']; ?>'><img onerror="this.src='<?php echo $imageerror; ?>'" width='100' height='60' src='../../../../admin/upload/<?php echo $data['gambar_logo']; ?>'></a>
								<br>
								<?php echo $data['gambar_logo']; ?>
								<input type="hidden" name="gambar_logo1" value="<?php echo $data['gambar_logo']; ?>">
								<br>
								<input class='form-control' type="file" name="gambar_logo" id="gambar_logo" placeholder="Gambar&nbsp;Logo" value="<?php echo ($data['gambar_logo']); ?>">



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
									<option value='<?php echo $data['spbu']; ?>'>- <?php echo $data['spbu']; ?> -</option>
									<?php combo_database("data_spbu", "nama_spbu", ""); ?>
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