<?php if (empty($p)) {
	header("Location: index.php?p=home");
	die();
} ?>

<?php
function check_in_range($start, $end, $now)
{
	return strtotime($now) >= strtotime($start) && strtotime($now) <= strtotime($end);
}
?>

<style>
	.promo-card {
		background: #ffffff;
		border-radius: 18px;
		box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
		padding: 25px;
		margin-bottom: 25px;
		transition: .3s;
	}

	.promo-card:hover {
		transform: translateY(-5px);
		box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
	}

	.promo-img {
		width: 160px;
		height: 110px;
		object-fit: cover;
		border-radius: 12px;
	}

	.promo-title {
		font-size: 26px;
		font-weight: 700;
		margin-bottom: 5px;
	}

	.promo-detail-text {
		font-size: 15px;
		color: #555;
	}

	.badge-active {
		background: #28a745;
		color: #fff;
		font-size: 13px;
		padding: 5px 12px;
		border-radius: 6px;
	}

	.badge-expired {
		background: #777;
		color: #fff;
		font-size: 13px;
		padding: 5px 12px;
		border-radius: 6px;
	}
</style>


<section class="agency_section layout_padding2-top">
	<div class="agency_container">
		<div class="box" style="width:100%">
			<div class="detail-box">

				<section id="about" class="about">
					<div class="container">

						<h3 class="text-center mb-4">
							Informasi Promo Mitra <br>
							<b>
								<?php
								$id_mitra = mysql_real_escape_string(decrypt($_GET['id']));
								echo htmlspecialchars(baca_database("", "nama_mitra", "SELECT * FROM data_mitra WHERE id_mitra='$id_mitra'"));
								?>
							</b>
						</h3>

						<div class="row justify-content-center">
							<div class="col-md-8">

								<?php
								if (isset($_GET['detail'])) {
									echo '<a href="?p=detail_promo&id=' . htmlspecialchars($_GET['id']) . '" class="btn btn-danger mb-4">⬅ Kembali ke Informasi Promo</a>';

									$id_promo = mysql_real_escape_string(decrypt($_GET['detail']));
									$query = "SELECT * FROM data_promo WHERE id_mitra='$id_mitra' AND id_promo='$id_promo'";
								} else {
									$query = "SELECT * FROM data_promo WHERE id_mitra='$id_mitra' ORDER BY tanggal_mulai_berlaku DESC";
								}

								$res = mysql_query($query);
								while ($data = mysql_fetch_array($res)) {

									$start = $data['tanggal_mulai_berlaku'];
									$end = $data['tanggal_batas_berlaku'];
									$now = date("Y-m-d");

									$is_active = ($data['aktifkan_pembatasan_waktu'] == "ya")
										? check_in_range($start, $end, $now)
										: true;

									$badge = $is_active
										? "<span class='badge-active'>AKTIF</span>"
										: "<span class='badge-expired'>EXPIRED</span>";
								?>

									<!-- CARD MODERN -->
									<div class="promo-card">

										<div class="row align-items-center">
											<div class="col-md-4 text-center">
												<img src="admin/upload/<?php echo htmlspecialchars($data['foto_promo']); ?>"
													class="promo-img"
													onerror="this.src='<?php echo $imageerror; ?>'">
											</div>

											<div class="col-md-8">

												<div class="d-flex justify-content-between mb-2">
													<h4 class="promo-title">
														<?php echo htmlspecialchars($data['nama_promo']); ?>
													</h4>
													<?php echo $badge; ?>
												</div>

												<p class="promo-detail-text">
													<b>Masa berlaku:</b><br>
													<?php echo format_indo($start); ?> — <?php echo format_indo($end); ?>
												</p>

												<?php if (isset($_GET['detail'])) { ?>

													<p class="promo-detail-text">
														<b>Keterangan:</b><br>
														<?php echo nl2br(htmlspecialchars($data['keterangan'])); ?>
													</p>

													<p class="promo-detail-text">
														<b>Syarat & Ketentuan:</b><br>
														<?php echo nl2br(htmlspecialchars($data['syarat_dan_ketentuan'])); ?>
													</p>

												<?php } else { ?>

													<p class="promo-detail-text">
														<b>Keterangan:</b><br>
														<?php echo nl2br(htmlspecialchars($data['keterangan'])); ?>
													</p>

													<a href="?p=detail_promo&id=<?php echo htmlspecialchars($_GET['id']); ?>&detail=<?php echo encrypt($data['id_promo']); ?>"
														class="btn btn-primary mt-2">
														Detail Informasi Promo
													</a>

												<?php } ?>

											</div>
										</div>
									</div>

								<?php } ?>

							</div>
						</div>

					</div>
				</section>

			</div>
		</div>
	</div>
</section>


<br><br><br>