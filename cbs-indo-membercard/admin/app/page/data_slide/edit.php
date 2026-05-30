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
						$sql = mysql_query("SELECT * FROM data_slide where id_slide = '$proses'");
						$data = mysql_fetch_array($sql);
						?>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>id&nbsp;slide<font color="red">*</font></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input type="%typepertama%" name="id_slide" value="<?php echo $data['id_slide']; ?>" readonly id="id_slide" required="required">
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
								<label>Header <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' required="required" type="text" name="header" id="tanggal" placeholder="Header" value="<?php echo ($data['header']); ?>">



							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Judul 1 <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' required="required" type="text" name="judul1" id="judul" placeholder="Judul1" value="<?php echo ($data['judul1']); ?>">



							</td>
						</tr>

						<tr>
							<td width="25%" class="leftrowcms">
								<label>Caption 1 <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<textarea class='ckeditor' required="required" type="text" name="caption1" id="isi" placeholder="Isi" value="<?php echo ($data['caption1']); ?>">
<?php echo $data['caption1'] ?>
</textarea>

							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Judul 2 <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' required="required" type="text" name="judul2" id="judul" placeholder="Judul1" value="<?php echo ($data['judul2']); ?>">



							</td>
						</tr>

						<tr>
							<td width="25%" class="leftrowcms">
								<label>Caption 2 <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<textarea class='ckeditor' required="required" type="text" name="caption2" id="isi" placeholder="Isi" value="<?php echo ($data['caption2']); ?>">
<?php echo $data['caption1'] ?>
</textarea>

							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Judul 3<span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' required="required" type="text" name="judul3" id="judul" placeholder="Judul3" value="<?php echo ($data['judul3']); ?>">



							</td>
						</tr>

						<tr>
							<td width="25%" class="leftrowcms">
								<label>Caption 3<span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<textarea class='ckeditor' required="required" type="text" name="caption3" id="isi" placeholder="Isi" value="<?php echo ($data['caption3']); ?>">
<?php echo $data['caption3'] ?>
</textarea>

							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Judul 4 <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' required="required" type="text" name="judul4" id="judul" placeholder="Judul4" value="<?php echo ($data['judul4']); ?>">



							</td>
						</tr>

						<tr>
							<td width="25%" class="leftrowcms">
								<label>Caption 4 <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<textarea class='ckeditor' required="required" type="text" name="caption4" id="isi" placeholder="Isi" value="<?php echo ($data['caption4']); ?>">
<?php echo $data['caption4'] ?>
</textarea>

							</td>
						</tr>

						<tr>
							<td width="25%" class="leftrowcms">
								<label>Judul 5 <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' required="required" type="text" name="judul5" id="judul" placeholder="Judul1" value="<?php echo ($data['judul5']); ?>">



							</td>
						</tr>

						<tr>
							<td width="25%" class="leftrowcms">
								<label>Caption 5 <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<textarea class='ckeditor' required="required" type="text" name="caption5" id="isi" placeholder="Isi" value="<?php echo ($data['caption5']); ?>">
<?php echo $data['caption5'] ?>
</textarea>

							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Nama <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' required="required" type="text" name="nama" id="tanggal" placeholder="Header" value="<?php echo ($data['nama']); ?>">



							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Jabatan <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' required="required" type="text" name="jabatan" id="jabatan" placeholder="Header" value="<?php echo ($data['jabatan']); ?>">



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