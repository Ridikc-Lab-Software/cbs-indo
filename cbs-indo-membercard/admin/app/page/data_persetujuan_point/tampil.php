<body>
	<br>
	<br>
	<center>
		<h2>Persetujuan</h2>
	</center>
	<br>
	<div class="scroll-container">
		<table <?php tabel(100, '%', 1, 'left');  ?>>
			<tr>
				<th class="th_border cell">Action</th>
				<th class="th_border cell">No</th>
				<th class="th_border cell">Jenis</th>
				<th class="th_border cell">Tanggal&nbsp;Permintaan</th>
				<th class="th_border cell">Tanggal&nbsp;Konfirmasi</th>
				<th class="th_border cell">Id&nbsp;Member</th>
				<th class="th_border cell">Nama&nbsp;Member</th>
				<th class="th_border cell">Id&nbsp;Admin</th>
				<th class="th_border cell">Nama&nbsp;Admin</th>
				<th class="th_border cell">Id&nbsp;Penyetuju</th>
				<th class="th_border cell">Nama&nbsp;Penyetuju</th>
				<th class="th_border cell">Point&nbsp;Awal</th>
				<th class="th_border cell">Update&nbsp;Point</th>
				<th class="th_border cell">Status</th>

			</tr>

			<tbody>
				<?php
				$no = 0;
				$startRow = ($page - 1) * $dataPerPage;
				$no = $startRow;

				$username = decrypt($_COOKIE['jenenge']);
				$id_adm = baca_database('', 'id_admin', "select * from data_admin where username ='$username'");
				$nama_spbu1 = baca_database('', 'nama_spbu', "select * from data_admin where id_admin ='$id_adm'");

				if (isset($_GET['Berdasarkan']) && !empty($_GET['Berdasarkan']) && isset($_GET['isi']) && !empty($_GET['isi'])) {
					$berdasarkan =  mysql_real_escape_string($_GET['Berdasarkan']);
					$isi =  mysql_real_escape_string($_GET['isi']);
					$querytabel = "SELECT * FROM data_persetujuan_point INNER JOIN data_admin ON data_persetujuan_point.id_admin = data_admin.id_admin
WHERE data_persetujuan_point.status='menunggu_persetujuan' where $berdasarkan like '%$isi%'  ";
					$querypagination = "SELECT COUNT(*) AS total FROM data_persetujuan_point where $berdasarkan like '%$isi%'";
				} else {
					$querytabel = "SELECT * FROM data_persetujuan_point INNER JOIN data_admin ON data_persetujuan_point.id_admin = data_admin.id_admin
WHERE data_persetujuan_point.status='menunggu_persetujuan'";
					$querypagination = "SELECT COUNT(*) AS total FROM data_persetujuan_point";
				}
				$proses = mysql_query($querytabel);
				while ($data = mysql_fetch_array($proses)) {

					$statuse = (substr($data['status'], 0, 100)); ?>
					<tr class="event2">
						<td class="th_border cell" align="center" width="200">
							<table border="0">
								<tr>
									<td>
										<a href="<?php index(); ?>?input=detail&proses=<?= encrypt($data['id_persetujuan_point']); ?>">
											<?php btn_detail('Detail'); ?></a>
									</td>
									<?php if ($statuse == "menunggu_persetujuan") { ?>
										<td>
											<a href="<?php index(); ?>?input=edit&proses=<?= encrypt($data['id_persetujuan_point']); ?>" class="btn ">
												Konfirmasi</a>
										</td>
									<?php } ?>
									<td>
										<a href="<?php index(); ?>?input=hapus&proses=<?= encrypt($data['id_persetujuan_point']); ?>">
											<?php //btn_hapus('Hapus'); 
											?></a>
									</td>
								</tr>
							</table>
						</td>
						<td align="center" width="50"><?php $no = (($no + 1));
														echo $no;  ?></td>
						<td align="center"><?php echo $jenis = ($data['jenis']); ?></td>
						<?php $data['id_persetujuan_point']; ?>
						<td align="center"><?php echo ($data['tanggal_permintaan']); ?></td>

						<td align="center"><?php $tgl_Setuju = ($data['tanggal_persetujuan']);

											if ($tgl_Setuju == "0000-00-00 00:00:00") {
											} else {
												echo ($data['tanggal_persetujuan']);
											}
											?></td>

						<td align="center"><?php echo $idm = ($data['id_member']); ?></td>
						<td align="center"><?php echo baca_database('', 'nama', "select * from data_member where id_member='$idm'");  ?></td>
						<td align="center"><?php echo $ida = ($data['id_admin']); ?></td>
						<td align="center"><?php echo baca_database('', 'username', "select * from data_admin where id_admin ='$ida'"); ?></td>

						<td align="center"><?php echo $idp = ($data['id_penyetuju']); ?></td>
						<td align="center"><?php echo $ida = baca_database('', 'username', "select * from data_admin where id_admin ='$idp'"); ?></td>
						<td align="center"><?php echo ($data['point_awal']); ?></td>
						<td align="center"><?php echo ($data['update_point']); ?></td>
						<td align="center"><?php echo (substr($data['status'], 0, 100)); ?></td>

					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>

	<?php //Pagination($page,$dataPerPage,$querypagination); 
	?>

</body>