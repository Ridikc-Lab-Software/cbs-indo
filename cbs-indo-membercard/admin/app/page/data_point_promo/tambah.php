<a href="<?php index(); ?>">
	<?php btn_kembali(' KEMBALI'); ?>
</a>

<br><br>

<div class="content-box">
	<div class="content-box-header" style="height: 39px">Tambah<h3></h3>
	</div>
	<form action="proses_simpan.php" enctype="multipart/form-data" method="post">
		<div class="content-box-content">
			<div id="postcustom">
				<table <?php tabel_in(100, '%', 0, 'center');  ?>>
					<tbody>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>id&nbsp;point&nbsp;promo <span class="highlight">*</span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input type="readonly" readonly value="<?php echo id_otomatis("data_point_promo", "id_point_promo", "10"); ?>" name="id_point_promo" placeholder="id_point_promo" id="id_point_promo" required="required">
							</td>
						</tr>

						<tr>
							<td width="25%" class="leftrowcms">
								<label>Id&nbsp;Promo <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>

								<select class='form-control' data-live-search='true' type="text" name="id_promo" id="id_promo" placeholder="Id&nbsp;Promo" required="required">
									<option></option><?php combo_database('data_promo', 'id_promo', ''); ?>
								</select>
							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Id&nbsp;Kategori&nbsp;Member <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>

								<select class='form-control' data-live-search='true' type="text" name="id_kategori_member" id="id_kategori_member" placeholder="Id&nbsp;Kategori&nbsp;Member" required="required">
									<option></option><?php combo_database2('data_kategori_member', 'id_kategori_member', 'kategori_member', ''); ?>
								</select>
							</td>
						</tr>
						<tr>
							<td width="25%" class="leftrowcms">
								<label>Point <span class="highlight"></span></label>
							</td>
							<td width="2%">:</td>
							<td>
								<input class='form-control' type="text" name="point" id="point" placeholder="Point" required="required">


							</td>
						</tr>

					</tbody>
				</table>
				<div class="content-box-content">
					<center>
						<?php btn_simpan(' SIMPAN'); ?>
					</center>
				</div>
			</div>
		</div>
	</form>