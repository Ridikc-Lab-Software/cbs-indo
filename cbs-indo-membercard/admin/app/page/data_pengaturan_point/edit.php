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
						$sql = mysql_query("SELECT * FROM data_pengaturan_point where id_pengaturan_point = '$proses'");
						$data = mysql_fetch_array($sql);
						?>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>id&nbsp;pengaturan&nbsp;point <font color="red">*</font></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input type="%typepertama%" name="id_pengaturan_point" value="<?php echo $data['id_pengaturan_point']; ?>" readonly id="id_pengaturan_point" required="required">
							</td>
						</tr>

						<tr>
							<td width="25%" class="leftrowcms">
								<label>Nama&nbsp;Pengaturan <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input onkeypress='return h(event)' class='form-control' required="required" type="text" name="nama_pengaturan" id="nama_pengaturan" placeholder="Nama&nbsp;Pengaturan" value="<?php echo ($data['nama_pengaturan']); ?>">



							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Id&nbsp;Kategori&nbsp;Member <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<!-- -->
								<select class='form-control' data-live-search='true' required="required" type="text" name="id_kategori_member" id="id_kategori_member" placeholder="Id&nbsp;Kategori&nbsp;Member" value="<?php echo ($data['id_kategori_member']); ?>">
									<option value='<?php echo $data[id_kategori_member]; ?>'>- <?php echo $data[id_kategori_member]; ?> -</option><?php combo_database2('data_kategori_member', 'id_kategori_member', 'kategori_member', ''); ?>
								</select>

							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Id&nbsp;Jenis&nbsp;Transaksi <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<!-- -->
								<select class='form-control' data-live-search='true' required="required" type="text" name="id_jenis_transaksi" id="id_jenis_transaksi" placeholder="Id&nbsp;Jenis&nbsp;Transaksi" value="<?php echo ($data['id_jenis_transaksi']); ?>">
									<option value='<?php echo $data[id_jenis_transaksi]; ?>'>- <?php echo $data[id_jenis_transaksi]; ?> -</option><?php combo_database2('data_jenis_transaksi', 'id_jenis_transaksi', 'jenis_transaksi', ''); ?>
								</select>

							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Point <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' required="required" type="number" name="point" id="point" placeholder="Point" value="<?php echo ($data['point']); ?>">



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