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
						$sql = mysql_query("SELECT * FROM data_profil where id_profil = '$proses'");
						$data = mysql_fetch_array($sql);
						?>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>id&nbsp;profil <font color="red">*</font></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input type="%typepertama%" name="id_profil" value="<?php echo $data['id_profil']; ?>" readonly id="id_profil" required="required">
							</td>
						</tr>

						<tr>
							<td width="25%" class="leftrowcms">
								<label>Nama <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input onkeypress='return h(event)' class='form-control' required="required" type="text" name="nama" id="nama" placeholder="Nama" value="<?php echo ($data['nama']); ?>">



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
								<label>No&nbsp;Telepon SPBU 1 <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input onkeypress='return a(event)' class='form-control' required="required" type="text" name="no_telepon1" id="no_telepon1" placeholder="No&nbsp;Telepon" value="<?php echo ($data['no_telepon1']); ?>">



							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>No&nbsp;Telepon SPBU 2 <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input onkeypress='return a(event)' class='form-control' required="required" type="text" name="no_telepon2" id="no_telepon2" placeholder="No&nbsp;Telepon" value="<?php echo ($data['no_telepon2']); ?>">



							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Email <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' required="required" type="text" name="email" id="email" placeholder="No&nbsp;Telepon" value="<?php echo ($data['email']); ?>">



							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Sejarah <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<textarea class='ckeditor' required="required" type="text" name="sejarah" id="sejarah" placeholder="Sejarah" value="<?php echo ($data['sejarah']); ?>">
<?php echo $data['sejarah'] ?>
</textarea>

							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Visi <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<textarea class='ckeditor' required="required" type="text" name="visi" id="visi" placeholder="Visi" value="<?php echo ($data['visi']); ?>">
<?php echo $data['visi'] ?>
</textarea>

							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Misi <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<textarea class='ckeditor' required="required" type="text" name="misi" id="misi" placeholder="Misi" value="<?php echo ($data['misi']); ?>">
<?php echo $data['misi'] ?>
</textarea>

							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Deskripsi <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<textarea class='ckeditor' required="required" type="text" name="deskripsi" id="deskripsi" placeholder="Deskripsi" value="<?php echo ($data['deskripsi']); ?>">
<?php echo $data['deskripsi'] ?>
</textarea>

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