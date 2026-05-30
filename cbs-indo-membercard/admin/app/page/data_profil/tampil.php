<div class="scroll-container">
	<table <?php tabel(100, '%', 1, 'left');  ?>>
		<tr>
			<th>Action</th>
			<th>No</th>
			<th>Id&nbsp;profil</th>
			<th align="center" class="th_border cell">Nama</th>
			<th align="center" class="th_border cell">Alamat</th>
			<th align="center" class="th_border cell">Nomor Telepon SPBU 1</th>
			<th align="center" class="th_border cell">Nomor Telepon SPBU 2</th>
			<th align="center" class="th_border cell">Email</th>
			<th align="center" class="th_border cell">Sejarah</th>
			<th align="center" class="th_border cell">Visi</th>
			<th align="center" class="th_border cell">Misi</th>
			<th align="center" class="th_border cell">Deskripsi</th>
			<th align="center" class="th_border cell">Foto</th>

		</tr>

		<tbody>
			<?php
			$no = 0;
			$startRow = ($page - 1) * $dataPerPage;
			$no = $startRow;

			if (isset($_GET['Berdasarkan']) && !empty($_GET['Berdasarkan']) && isset($_GET['isi']) && !empty($_GET['isi'])) {
				$berdasarkan =  mysql_real_escape_string($_GET['Berdasarkan']);
				$isi =  mysql_real_escape_string($_GET['isi']);
				$querytabel = "SELECT * FROM data_profil where $berdasarkan like '%$isi%'  LIMIT $startRow ,$dataPerPage";
				$querypagination = "SELECT COUNT(*) AS total FROM data_profil where $berdasarkan like '%$isi%'";
			} else {
				$querytabel = "SELECT * FROM data_profil  LIMIT $startRow ,$dataPerPage";
				$querypagination = "SELECT COUNT(*) AS total FROM data_profil";
			}
			$proses = mysql_query($querytabel);
			while ($data = mysql_fetch_array($proses)) { ?>
				<tr class="event2">
					<td class="th_border cell" align="center" width="200">
						<table border="0">
							<tr>

								<td>
									<a href="<?php index(); ?>?input=edit&proses=<?= encrypt($data['id_profil']); ?>">
										<?php btn_edit('Edit'); ?></a>
								</td>

							</tr>
						</table>
					</td>
					<td align="center" width="50"><?php $no = (($no + 1));
													echo $no;  ?></td>
					<td align="center"><?php echo $data['id_profil']; ?></td>

					<td align="center"><?php echo ($data['nama']); ?></td>
					<td align="center"><?php echo ($data['alamat']); ?></td>
					<td align="center"><?php echo ($data['no_telepon1']); ?></td>
					<td align="center"><?php echo ($data['no_telepon2']); ?></td>
					<td align="center"><?php echo ($data['email']); ?></td>
					<td align="center"><?php echo (substr($data['sejarah'], 0, 100)); ?></td>
					<td align="center"><?php echo (substr($data['visi'], 0, 100)); ?></td>
					<td align="center"><?php echo (substr($data['misi'], 0, 100)); ?></td>
					<td align="center"><?php echo (substr($data['deskripsi'], 0, 100)); ?></td>
					<td align="center"><a href='../../../../admin/upload/<?php echo $data['foto']; ?>'><img onerror="this.src='<?php echo $imageerror; ?>'" width='50' height='30' src='../../../../admin/upload/<?php echo $data['foto']; ?>'></a></td>

				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>

<?php //Pagination($page,$dataPerPage,$querypagination); 
?>

</body>