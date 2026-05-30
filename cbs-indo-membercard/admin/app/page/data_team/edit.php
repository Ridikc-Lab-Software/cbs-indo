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
						$sql = mysql_query("SELECT * FROM data_team where id_team = '$proses'");
						$data = mysql_fetch_array($sql);
						?>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>id&nbsp;team <font color="red">*</font></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input type="%typepertama%" name="id_team" value="<?php echo $data['id_team']; ?>" readonly id="id_team" required="required">
							</td>
						</tr>

						<tr>
							<td width="25%" class="leftrowcms">
								<label>Nama&nbsp;Team <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input onkeypress='return h(event)' class='form-control' required="required" type="text" name="nama_team" id="nama_team" placeholder="Nama&nbsp;Team" value="<?php echo ($data['nama_team']); ?>">



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
								<label>Email <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' required="required" type="email" name="email" id="email" placeholder="Email" value="<?php echo ($data['email']); ?>">



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
								<label>Telepon <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' required="required" type="text" name="telepon" id="telepon" placeholder="Telepon" value="<?php echo ($data['telepon']); ?>">



							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Bagian <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' required="required" type="text" name="bagian" id="bagian" placeholder="Bagian" value="<?php echo ($data['bagian']); ?>">



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