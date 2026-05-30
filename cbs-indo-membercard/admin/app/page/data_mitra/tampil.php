<div class="card-group-title">
	<div class="title-left">
		<img src="../../../data/tmp/membercard/files/icon/mitra2.png" width="40" height="40" alt="Icon">
		<p>Data Mitra</p>
	</div>

	<div class="title-right">

		<a href=#">
			<?php btn_cari('Pencarian'); ?>
		</a>

		<a href="<?php index(); ?>?input=tambah">
			<?php btn_tambah('Tambah'); ?>
		</a>
	</div>
</div>

<body>



	<div class="scroll-container">
		<table <?php tabel(100, '%', 1, 'left');  ?>>
			<tr>

				<th>No</th>

				<th align="center" style="min-width: 219px;" class="th_border cell">Nama&nbsp;mitra</th>
				<th align="center" class="th_border cell">Logo</th>
				<th align="center" style="min-width: 150px;" class="th_border cell">No&nbsp;telepon</th>
				<th align="center" class="th_border cell">Nama&nbsp;pemilik</th>
				<th align="center" class="th_border cell">No&nbsp;telepon&nbsp;pemilik</th>
				<th align="center" class="th_border cell">Alamat</th>
				<th align="center" class="th_border cell">Tanggal&nbsp;daftar</th>
				<th align="center" class="th_border cell">Username</th>
				<th align="center" class="th_border cell">Password</th>
				<th align="center" class="th_border cell">Status</th>

				<th align="center" class="th_border cell">SPBU Pendaftaran</th>

			</tr>

			<tbody>
				<?php
				$no = 0;
				$startRow = ($page - 1) * $dataPerPage;
				$no = $startRow;

				if (isset($_GET['Berdasarkan']) && !empty($_GET['Berdasarkan']) && isset($_GET['isi']) && !empty($_GET['isi'])) {
					$berdasarkan =  mysql_real_escape_string($_GET['Berdasarkan']);
					$isi =  mysql_real_escape_string($_GET['isi']);
					$querytabel = "SELECT * FROM data_mitra where $berdasarkan like '%$isi%'  LIMIT $startRow ,$dataPerPage";
					$querypagination = "SELECT COUNT(*) AS total FROM data_mitra where $berdasarkan like '%$isi%'";
				} else {
					$querytabel = "SELECT * FROM data_mitra  LIMIT $startRow ,$dataPerPage";
					$querypagination = "SELECT COUNT(*) AS total FROM data_mitra";
				}
				$proses = mysql_query($querytabel);
				while ($data = mysql_fetch_array($proses)) { ?>
					<tr class="event2">

						<td align="center" width="50"><?php $no = (($no + 1));
														echo $no;  ?></td>
						<td align="left"><b><a style="color:#09090b" href="<?php index(); ?>?input=detail&proses=<?= encrypt($data['id_mitra']); ?>"><i class="fa fa-user"></i>&nbsp;<?php echo strtoupper($data['nama_mitra']); ?></a></b></td>

						<td align="center"><a href='../../../../admin/upload/<?php echo $data['gambar_logo']; ?>'><img onerror="this.src='<?php echo $imageerror; ?>'" width='50' height='30' src='../../../../admin/upload/<?php echo $data['gambar_logo']; ?>'></a></td>


						<td align="left"><?php echo ($data['no_telepon']); ?></td>
						<td align="left"><?php echo ($data['nama_pemilik']); ?></td>
						<td align="left"><?php echo ($data['no_telepon_pemilik']); ?></td>
						<td align="left"><?php echo  mb_strlen($data['alamat']) > 50 ? mb_substr($data['alamat'], 0, 50) . '...' : $data['alamat'];  ?></td>
						<td align="left"><?php echo (format_indo($data['tanggal_daftar'])); ?></td>
						<td align="left"><?php echo ($data['username']); ?></td>
						<td align="left"><?php echo ($data['password']); ?></td>
						<td align="center"><?php echo ($data['status']); ?></td>

						<td align="center"><?php echo ($data['spbu']); ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>

	<?php Pagination($page, $dataPerPage, $querypagination); ?>

</body>