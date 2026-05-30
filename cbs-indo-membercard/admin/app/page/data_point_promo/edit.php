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
						$sql = mysql_query("SELECT * FROM data_point_promo where id_point_promo = '$proses'");
						$data = mysql_fetch_array($sql);
						?>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>id&nbsp;point&nbsp;promo <font color="red">*</font></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input type="%typepertama%" name="id_point_promo" value="<?php echo $data['id_point_promo']; ?>" readonly id="id_point_promo" required="required">
							</td>
						</tr>

						<tr>
							<td width="25%" class="leftrowcms">
								<label>Id&nbsp;Promo <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<!-- -->
								<select class='form-control' data-live-search='true' required="required" type="text" name="id_promo" id="id_promo" placeholder="Id&nbsp;Promo" value="<?php echo ($data['id_promo']); ?>">
									<option value='<?php echo $data[id_promo]; ?>'>- <?php echo $data[id_promo]; ?> -</option><?php combo_database('data_promo', 'id_promo', ''); ?>
								</select>

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