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
						Detail data&nbsp;redeem
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
				$sql = mysql_query("SELECT * FROM data_redeem where id_redeem = '$proses'");
				$data = mysql_fetch_array($sql);
				?>
				<tr>
					<td class="clleft" width="25%">id&nbsp;redeem</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><?php echo $data['id_redeem']; ?></td>
				</tr>

				<tr>
					<td class="clleft" width="25%">Tanggal</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><?php echo (format_indo($data['tanggal'])); ?></td>
				</tr>
				<tr>
					<td class="clleft" width="25%">Jam</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><?php echo $data['jam']; ?></td>
				</tr>
				<tr>
					<td class="clleft" width="25%">Id&nbsp;member</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><?php echo $data['id_member']; ?></td>
				</tr>
				<tr>
					<td class="clleft" width="25%">Nama</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><?php echo baca_database("", "nama", " select * from data_member where id_member ='$data[id_member]'") ?></td>
				</tr>
				<tr>
					<td class="clleft" width="25%">Id&nbsp;mitra</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><?php echo $data['id_mitra']; ?></td>
				</tr>
				<tr>
					<td class="clleft" width="25%">Nama Mitra</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><?php echo baca_database("", "nama_mitra", " select * from data_mitra where id_mitra ='$data[id_mitra]'") ?></td>
				</tr>
				<tr>
					<td class="clleft" width="25%">Id&nbsp;promo</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><?php echo $data['id_promo']; ?></td>
				</tr>
				<tr>
					<td class="clleft" width="25%">Nama Promo</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><?php echo baca_database("", "nama_promo", " select * from data_promo where id_promo ='$data[id_promo]'") ?></td>
				</tr>
				<tr>
					<td class="clleft" width="25%">Point</td>
					<td class="clleft" width="2%">:</td>
					<td class="clleft"><?php echo $data['point']; ?></td>
				</tr>
				<!--<tr>-->
				<!--				<td class="clleft" width="25%">Status</td>-->
				<!--				<td class="clleft" width="2%">:</td>-->
				<!--				<td class="clleft">--><?php //echo $data['status']; 
															?><!--</td>	-->
				<!--			   </tr>-->

				<tr>
					<td class="clleft" width="25%">Nama SPBU</td>
					<td class="clleft" width="2%">:</td>

					<?php

					$spbu = baca_database('data_petugas', 'nama_spbu', "select nama_spbu from data_petugas where id_petugas='$data[id_petugas]'");
					?>

					<td align="center">
						<a href="index.php?Berdasarkan=nama_spbu&isi=<?php echo $spbu; ?>"><?php echo $spbu; ?></a>
					</td>

				</tr>



			</tbody>
		</table>

		<br>
		<a href="<?php index(); ?>?input=hapus&proses=<?= encrypt($data['id_transaksi']); ?>">
			<?php btn_hapus('Hapus'); ?></a>
	</div>
</div>