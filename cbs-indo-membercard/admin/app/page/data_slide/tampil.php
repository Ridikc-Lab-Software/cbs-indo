<body>
	<a href="<?php index(); ?>?input=tambah">
		<?php //btn_tambah('Tambah'); 
		?>
	</a>

	<a target="blank" href="cetak.php?berdasarkan=data_slide&jenis=xls&pakaiperperiode=<?php echo $status_pakaiperperiode; ?>">
		<?php btn_export('Export Excel'); ?>
	</a>

	<a target="blank" href="cetak.php?berdasarkan=data_slide&jenis=print&pakaiperperiode=<?php echo $status_pakaiperperiode; ?>">
		<?php btn_cetak('Cetak'); ?>
	</a>

	<a href="<?php index(); ?>">
		<?php btn_refresh('Refresh'); ?>
	</a>

	<br><br>

	<form name="formcari" id="formcari" action="" method="get">
		<fieldset>
			<table>
				<tbody>
					<tr>
						<td>Berdasarkan</td>
						<td>:</td>
						<td>
							<!-- <input value="" name="Berdasarkan" id="Berdasarkan" > --> <select class="form-control" data-live-search="true" name="Berdasarkan" id="Berdasarkan">
								<?php
								$sql = "desc data_slide";
								$result = @mysql_query($sql);
								while ($row = @mysql_fetch_array($result)) {
									echo "<option name='berdasarkan' value=$row[0]>$row[0]</option>";
								}
								?>
							</select>
						</td>
					</tr>

					<tr>
						<td>Pencarian</td>
						<td>:</td>
						<td>
							<!--<input class="form-control" type="text" name="isi" value="" >--> <input type="text" name="isi" value="">
							<?php btn_cari('Cari'); ?>
						</td>
					</tr>
				</tbody>
			</table>
		</fieldset>
	</form>

	<div class="scroll-container">
		<table <?php tabel(100, '%', 1, 'left');  ?>>
			<tr>
				<th>Action</th>
				<th>No</th>
				<th>Id&nbsp;Company Value</th>
				<th align="center" class="th_border cell">Foto</th>
				<th align="center" class="th_border cell">header</th>
				<th align="center" class="th_border cell">Judul 1</th>
				<th align="center" class="th_border cell">Caption 1</th>
				<th align="center" class="th_border cell">Judul 2</th>
				<th align="center" class="th_border cell">Caption 2</th>
				<th align="center" class="th_border cell">Judul 3</th>
				<th align="center" class="th_border cell">Caption 3</th>
				<th align="center" class="th_border cell">Author</th>
				<th align="center" class="th_border cell">Jabatan</th>

			</tr>

			<tbody>
				<?php
				$no = 0;
				$startRow = ($page - 1) * $dataPerPage;
				$no = $startRow;

				if (isset($_GET['Berdasarkan']) && !empty($_GET['Berdasarkan']) && isset($_GET['isi']) && !empty($_GET['isi'])) {
					$berdasarkan =  mysql_real_escape_string($_GET['Berdasarkan']);
					$isi =  mysql_real_escape_string($_GET['isi']);
					$querytabel = "SELECT * FROM data_slide where $berdasarkan like '%$isi%'  LIMIT $startRow ,$dataPerPage";
					$querypagination = "SELECT COUNT(*) AS total FROM data_slide where $berdasarkan like '%$isi%'";
				} else {
					$querytabel = "SELECT * FROM data_slide LIMIT $startRow ,$dataPerPage";
					$querypagination = "SELECT COUNT(*) AS total FROM data_slide";
				}
				$proses = mysql_query($querytabel);
				while ($data = mysql_fetch_array($proses)) { ?>
					<tr class="event2">
						<td class="th_border cell" align="center" width="200">
							<table border="0">
								<tr>
									<td>
										<a href="<?php index(); ?>?input=detail&proses=<?= encrypt($data['id_slide']); ?>">
											<?php //btn_detail('Detail'); 
											?></a>
									</td>
									<td>
										<a href="<?php index(); ?>?input=edit&proses=<?= encrypt($data['id_slide']); ?>">
											<?php btn_edit('Edit'); ?></a>
									</td>
									<td>
										<a href="<?php index(); ?>?input=hapus&proses=<?= encrypt($data['id_slide']); ?>">
											<?php //btn_hapus('Hapus'); 
											?></a>
									</td>
								</tr>
							</table>
						</td>
						<td align="center" width="50"><?php $no = (($no + 1));
														echo $no;  ?></td>
						<td align="center"><?php echo $data['id_slide']; ?></td>
						<td align="center"><a href='../../../../admin/upload/<?php echo $data['foto']; ?>'><img onerror="this.src='<?php echo $imageerror; ?>'" width='50' height='30' src='../../../../admin/upload/<?php echo $data['foto']; ?>'></a></td>
						<td align="center"><?php echo ($data['header']); ?></td>
						<td align="center"><?php echo ($data['judul1']); ?></td>
						<td align="center"><?php echo ($data['caption1']); ?></td>
						<td align="center"><?php echo ($data['judul2']); ?></td>
						<td align="center"><?php echo ($data['caption2']); ?></td>
						<td align="center"><?php echo ($data['judul3']); ?></td>
						<td align="center"><?php echo ($data['caption3']); ?></td>
						<td align="center"><?php echo ($data['nama']); ?></td>
						<td align="center"><?php echo ($data['jabatan']); ?></td>


					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>

	<?php Pagination($page, $dataPerPage, $querypagination); ?>

</body>