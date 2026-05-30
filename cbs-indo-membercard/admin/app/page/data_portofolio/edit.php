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
						$sql = mysql_query("SELECT * FROM data_portofolio where id_portofolio = '$proses'");
						$data = mysql_fetch_array($sql);
						?>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>id&nbsp;faq <font color="red">*</font></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input type="%typepertama%" name="id_portofolio" value="<?php echo $data['id_portofolio']; ?>" readonly id="id_portofolio" required="required">
							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Logo<span class="highlight">*</span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<a href='../../../../admin/upload/<?php echo $data['logo']; ?>'><img onerror="this.src='<?php echo $imageerror; ?>'" width='100' height='60' src='../../../../admin/upload/<?php echo $data['logo']; ?>'></a>
								<br>
								<?php echo $data['foto']; ?>
								<input type="hidden" name="logo1" value="<?php echo $data['logo']; ?>">
								<br>
								<input class='form-control' type="file" name="logo" id="logo" placeholder="Logo" value="<?php echo ($data['logo']); ?>">



							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Keterangan<span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<textarea class='ckeditor' required="required" type="text" name="keterangan" id="keterangan" placeholder="Keterangan" value="<?php echo ($data['keterangan']); ?>">
<?php echo $data['keterangan'] ?>
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