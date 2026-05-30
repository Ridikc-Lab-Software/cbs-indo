<?php if (empty($p)) {
	header("Location: index.php?p=home");
	die();
} ?>
<br>
<center>
	<h2> PROMO </h2>
</center>
<br>


<div class="container">
	<div class="col-md-12">

		<br>
		<div class="scroll-container">
			<table <?php tabel(100, '%', 1, 'left');  ?>>
				<tr>

					<th>No</th>

					<th align="center" class="th_border cell">Tanggal&nbsp;mulai&nbsp;berlaku</th>
					<th align="center" class="th_border cell">Tanggal&nbsp;batas&nbsp;berlaku</th>
					<th align="center" class="th_border cell">Nama&nbsp;promo</th>
					<th align="center" class="th_border cell">Keterangan</th>
					<th align="center" class="th_border cell">Syarat&nbsp;dan&nbsp;ketentuan</th>
					<th align="center" class="th_border cell">Foto&nbsp;promo</th>
					<th align="center" class="th_border cell">Jumlah&nbsp;point</th>
					<th align="center" class="th_border cell">Status</th>

				</tr>

				<tbody>
					<?php
					$no = 0;
					$startRow = ($page - 1) * $dataPerPage;
					$no = $startRow;

					if (isset($_GET['Berdasarkan']) && !empty($_GET['Berdasarkan']) && isset($_GET['isi']) && !empty($_GET['isi'])) {
						$berdasarkan =  mysql_real_escape_string($_GET['Berdasarkan']);
						$isi =  mysql_real_escape_string($_GET['isi']);
						$querytabel = "SELECT * FROM data_promo where $berdasarkan like '%$isi%'  LIMIT $startRow ,$dataPerPage";
						$querypagination = "SELECT COUNT(*) AS total FROM data_promo where $berdasarkan like '%$isi%'";
					} else {
						$querytabel = "SELECT * FROM data_promo  LIMIT $startRow ,$dataPerPage";
						$querypagination = "SELECT COUNT(*) AS total FROM data_promo";
					}
					$proses = mysql_query($querytabel);
					while ($data = mysql_fetch_array($proses)) { ?>
						<tr class="event2">

							<td align="center" width="50"><?php $no = (($no + 1));
															echo $no;  ?></td>


							<td align="center"><?php echo (format_indo($data['tanggal_mulai_berlaku'])); ?></td>
							<td align="center"><?php echo (format_indo($data['tanggal_batas_berlaku'])); ?></td>
							<td align="center"><?php echo (substr($data['nama_promo'], 0, 100)); ?></td>
							<td align="center"><?php echo (substr($data['keterangan'], 0, 100)); ?></td>
							<td align="center"><?php echo (substr($data['syarat_dan_ketentuan'], 0, 100)); ?></td>
							<td align="center"><a href='admin/upload/<?php echo $data['foto_promo']; ?>'><img onerror="this.src='<?php echo $imageerror; ?>'" width='80' height='50' src='admin/upload/<?php echo $data['foto_promo']; ?>'></a></td>
							<td align="center"><?php echo ($data['jumlah_point']); ?></td>
							<td align="center"><?php echo (substr($data['status'], 0, 100)); ?></td>

						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>

		<?php Pagination_font_end($page, $dataPerPage, $querypagination); ?>

	</div>
</div>