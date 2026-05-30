<?php if (empty($p)) {
	header("Location: index.php?p=home");
	die();
} ?>
<br>
<center>
	<h2> EVENT </h2>
</center>
<br>

<div class="container">
	<div class="col-md-12">
		<!--
			<form name="formcari" id="formcari" action="" method="get">
				<fieldset> 
					<table>
						<tbody>
						<tr>
							<td>Berdasarkan</td>	
							<td>:</td>	
							<td>
							 <select class="form-control" data-live-search="true" name="Berdasarkan" id="Berdasarkan">
								<?php
								$sql = "desc data_event";
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
								 <input  type="text" name="isi" value="" >
								<?php btn_cari('Cari'); ?>
							</td>
						</tr>
					</tbody>
					</table>									
				</fieldset>
			</form>

			-->
		<br>
		<div class="scroll-container">
			<table <?php tabel(100, '%', 1, 'left');  ?>>
				<tr>

					<th>No</th>

					<th align="center" class="th_border cell">Tanggal</th>
					<th align="center" class="th_border cell">Judul</th>
					<th align="center" class="th_border cell">Foto</th>
					<th align="center" class="th_border cell">Isi</th>

				</tr>

				<tbody>
					<?php
					$no = 0;
					$startRow = ($page - 1) * $dataPerPage;
					$no = $startRow;

					if (isset($_GET['Berdasarkan']) && !empty($_GET['Berdasarkan']) && isset($_GET['isi']) && !empty($_GET['isi'])) {
						$berdasarkan =  mysql_real_escape_string($_GET['Berdasarkan']);
						$isi =  mysql_real_escape_string($_GET['isi']);
						$querytabel = "SELECT * FROM data_event where $berdasarkan like '%$isi%'  LIMIT $startRow ,$dataPerPage";
						$querypagination = "SELECT COUNT(*) AS total FROM data_event where $berdasarkan like '%$isi%'";
					} else {
						$querytabel = "SELECT * FROM data_event  LIMIT $startRow ,$dataPerPage";
						$querypagination = "SELECT COUNT(*) AS total FROM data_event";
					}
					$proses = mysql_query($querytabel);
					while ($data = mysql_fetch_array($proses)) { ?>
						<tr class="event2">

							<td align="center" width="50"><?php $no = (($no + 1));
															echo $no;  ?></td>


							<td align="center"><?php echo (format_indo($data['tanggal'])); ?></td>
							<td align="center"><?php echo (substr($data['judul'], 0, 100)); ?></td>
							<td align="center"><a href='admin/upload/<?php echo $data['foto']; ?>'><img onerror="this.src='<?php echo $imageerror; ?>'" width='80' height='50' src='admin/upload/<?php echo $data['foto']; ?>'></a></td>
							<td align="center"><?php echo (substr($data['isi'], 0, 100)); ?></td>

						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>

		<?php Pagination_font_end($page, $dataPerPage, $querypagination); ?>

	</div>
</div>