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
						$sql = mysql_query("SELECT * FROM data_karir where id_karir = '$proses'");
						$data = mysql_fetch_array($sql);
						?>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>id&nbsp;karir <font color="red">*</font></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input type="%typepertama%" name="id_karir" value="<?php echo $data['id_karir']; ?>" readonly id="id_karir" required="required">
							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Foto<span class="highlight">*</span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<a href='../../../../admin/upload/<?php echo $data['foto']; ?>'><img onerror="this.src='<?php echo $imageerror; ?>'" width='100' height='60' src='../../../../admin/upload/<?php echo $data['foto']; ?>'></a>
								<br>
								<?php echo $data['foto']; ?>
								<input type="hidden" name="foto1" value="<?php echo $data['foto']; ?>">
								<br>
								<input class='form-control' type="file" name="foto" id="foto" placeholder="Foto" value="<?php echo ($data['foto']); ?>">



							</td>
						</tr>

						<tr>
							<td width="25%" class="leftrowcms">
								<label>nama karir<span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>

								<input type="%typepertama%" name="nama_karir" value="<?php echo $data['nama_karir']; ?>" id="nama_karir" required="required">
							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>deskripsi karir<span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<textarea class='ckeditor' required="required" type="text" name="deskripsi_karir" id="deskripsi_karir" placeholder="Deskripsi_Karir" value="<?php echo ($data['deskripsi_karir']); ?>">
<?php echo $data['deskripsi_karir'] ?>
</textarea>

							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>kualifikasi karir<span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<textarea class='ckeditor' required="required" type="text" name="kualifikasi_karir" id="kualifikasi_karir" placeholder="Kualifikasi_Karir" value="<?php echo ($data['kualifikasi_karir']); ?>">
<?php echo $data['kualifikasi_karir'] ?>
</textarea>

							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>batas waktu karir<span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>

								<input type="%typepertama%" name="batas_lamar" value="<?php echo $data['batas_lamar']; ?>" id="batas_lamar" required="required">
							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>cara lamar pekerjaan<span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<textarea class='ckeditor' required="required" type="text" name="cara_lamar" id="cara_lamar" placeholder="cara lamar" value="<?php echo ($data['cara_lamar']); ?>">
<?php echo $data['cara_lamar'] ?>
</textarea>

							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>status <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<select name="status" id="status" type="text">
									<option><?php echo $data['status'] ?></option> <?php combo_enum("data_karir", "status", "") ?>

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