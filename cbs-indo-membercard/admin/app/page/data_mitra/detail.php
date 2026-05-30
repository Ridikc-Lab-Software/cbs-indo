<a href="<?php index(); ?>">
	<?php btn_kembali(' KEMBALI'); ?>
</a>

<br><br>

<div class="content-box">
	<div class="content-box-header" style="height: 39px">Detail
		<h3 style="cursor: s-resize;"></h3>
	</div>
	<div class="content-box-content">
		<table <?php tabel_in(100, '%', 0, 'center');  ?>>
			<tbody>
				<tr class="event3">
					<td class="clleft" colspan="3">
						Detail data&nbsp;mitra
					</td>
				</tr>
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
				$sql = mysql_query("SELECT * FROM data_mitra where id_mitra = '$proses'");
				$data = mysql_fetch_array($sql);
				?>
				<tr>
					<td class="clleft" width="25%">id&nbsp;mitra</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><?php echo $data['id_mitra']; ?></td>
				</tr>

				<tr>
					<td class="clleft" width="25%">Nama&nbsp;mitra</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><?php echo $data['nama_mitra']; ?></td>
				</tr>
				<tr>
					<td class="clleft" width="25%">Alamat</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><?php echo $data['alamat']; ?></td>
				</tr>
				<tr>
					<td class="clleft" width="25%">No&nbsp;telepon</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><?php echo $data['no_telepon']; ?></td>
				</tr>
				<tr>
					<td class="clleft" width="25%">Nama&nbsp;pemilik</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><?php echo $data['nama_pemilik']; ?></td>
				</tr>
				<tr>
					<td class="clleft" width="25%">No&nbsp;telepon&nbsp;pemilik</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><?php echo $data['no_telepon_pemilik']; ?></td>
				</tr>
				<tr>
					<td class="clleft" width="25%">Tanggal&nbsp;daftar</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><?php echo (format_indo($data['tanggal_daftar'])); ?></td>
				</tr>
				<tr>
					<td class="clleft" width="25%">Username</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><?php echo $data['username']; ?></td>
				</tr>
				<tr>
					<td class="clleft" width="25%">Password</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><?php echo $data['password']; ?></td>
				</tr>
				<tr>
					<td class="clleft" width="25%">Status</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><?php echo $data['status']; ?></td>
				</tr>
				<tr>
					<td class="clleft" width="25%">Gambar&nbsp;logo</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><a href='../../../../admin/upload/<?php echo $data['gambar_logo']; ?>'><img onerror="this.src='<?php echo $imageerror; ?>'" width='250' src='../../../../admin/upload/<?php echo $data['gambar_logo']; ?>'></a></td>
				</tr>



			</tbody>
		</table>


		<a href="<?php index(); ?>?input=edit&proses=<?= encrypt($data['id_mitra']); ?>">
			<?php btn_edit('Edit'); ?></a>

		<?php
		$hak_akses = decrypt($_COOKIE['hak_akses']);
		if ($hak_akses == 'manager') { ?>



			<a href="<?php index(); ?>?input=hapus&proses=<?= encrypt($data['id_mitra']); ?>">
				<?php btn_hapus('Hapus'); ?></a>

		<?php } ?>
	</div>
</div>