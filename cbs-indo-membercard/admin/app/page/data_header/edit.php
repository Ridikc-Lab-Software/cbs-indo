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
						$sql = mysql_query("SELECT * FROM data_header where id_header = '$proses'");
						$data = mysql_fetch_array($sql);
						?>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>id&nbsp;header <font color="red">*</font></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input type="%typepertama%" name="id_header" value="<?php echo $data['id_header']; ?>" readonly id="id_header" required="required">
							</td>
						</tr>



						<tr>
							<td width="25%" class="leftrowcms">
								<label>Foto<span class="highlight">*</span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<a href='../../../upload/<?php echo $data['foto']; ?>'><img onerror="this.src='<?php echo $imageerror; ?>'" width='100' height='60' src='../../../upload/<?php echo $data['foto']; ?>'></a>
								<br>
								<?php echo $data['foto']; ?>
								<input type="hidden" name="foto1" value="<?php echo $data['foto']; ?>">
								<br>
								<input class='form-control' type="file" name="foto" id="foto" placeholder="Foto" value="<?php echo ($data['foto']); ?>">
							</td>
						</tr>


						<tr>
							<td width="25%" class="leftrowcms">
								<label>Judul&nbsp;Header <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' required="required" type="text" name="judul" id="judul" placeholder="Judul&nbsp;Header" value="<?php echo ($data['judul']); ?>">



							</td>
						</tr>


						<tr>
							<td width="25%" class="leftrowcms">
								<label>Keterangan <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<textarea class='ckeditor' required="required" type="text" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php echo ($data['keterangan']); ?>"><?php echo $data['keterangan'] ?>
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