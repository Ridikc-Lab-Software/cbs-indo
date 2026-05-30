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
						$sql = mysql_query("SELECT * FROM data_galery where id_galery = '$proses'");
						$data = mysql_fetch_array($sql);
						?>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>id&nbsp;galery <font color="red">*</font></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input type="%typepertama%" name="id_galery" value="<?php echo $data['id_galery']; ?>" readonly id="id_galery" required="required">
							</td>
						</tr>

						<tr>
							<td width="25%" class="leftrowcms">
								<label>Tanggal <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' required="required" type="date" name="tanggal" id="tanggal" placeholder="Tanggal" value="<?php echo ($data['tanggal']); ?>">



							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Judul <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' required="required" type="text" name="judul" id="judul" placeholder="Judul" value="<?php echo ($data['judul']); ?>">



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
								<label>Isi <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<textarea class='ckeditor' required="required" type="text" name="isi" id="isi" placeholder="Isi" value="<?php echo ($data['isi']); ?>">
<?php echo $data['isi'] ?>
</textarea>

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