<?php if (empty($p)) {
	header("Location: index.php?p=home");
	die();
} ?>

<style>
	/* ===== MODERN CLEAN STYLE ===== */

	.promo-title {
		font-size: 32px;
		font-weight: 700;
		color: #222;
	}

	.promo-subtitle {
		font-size: 18px;
		color: #666;
	}

	.promo-card {
		background: #ffffff;
		border-radius: 18px;
		padding: 25px;
		margin-bottom: 25px;
		box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
		transition: 0.3s;
	}

	.promo-card:hover {
		transform: translateY(-5px);
		box-shadow: 0 18px 32px rgba(0, 0, 0, 0.12);
	}

	.promo-logo {
		width: 49%;
		height: 100px;
		border-radius: 12px;
		object-fit: cover;
		background: #f7f7f7;
	}

	.promo-name {
		font-size: 22px;
		font-weight: 700;
		color: #000;
	}

	.promo-points {
		background: #ff3b3b;
		padding: 6px 14px;
		border-radius: 8px;
		font-size: 15px;
		font-weight: bold;
		display: inline-block;
		color: #fff;
	}

	.info-text {
		font-size: 14px;
		color: #777;
	}

	.section-padding {
		padding: 30px 0;
	}
</style>


<section class="section-padding">
	<div class="container">

		<div class="text-center mb-5">
			<h3 class="promo-title">
				Kumpulkan Poin Dengan <br>Mengisi Bahan Bakar di Outlet SPBU PT. CBS
			</h3>
			<p class="promo-subtitle">Nikmati keuntungan eksklusif bagi member aktif</p>
		</div>

		<div class="row justify-content-center">

			<div class="col-md-10">

				<?php
				$no = 0;
				$dataPerPage = 12;
				$startRow = ($page - 1) * $dataPerPage;
				$no = $startRow;

				if (isset($_GET['Berdasarkan']) && !empty($_GET['Berdasarkan']) && isset($_GET['isi']) && !empty($_GET['isi'])) {
					$berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
					$isi = mysql_real_escape_string($_GET['isi']);
					$querytabel = "SELECT * FROM data_promo WHERE $berdasarkan LIKE '%$isi%' LIMIT $startRow,$dataPerPage";
					$querypagination = "SELECT COUNT(*) AS total FROM data_promo WHERE $berdasarkan LIKE '%$isi%'";
				} else {
					$querytabel = "SELECT * FROM data_jenis_transaksi";
					$querypagination = "SELECT COUNT(*) AS total FROM data_jenis_transaksi";
				}

				$proses = mysql_query($querytabel);
				while ($data = mysql_fetch_array($proses)) {
				?>

					<!-- CARD PROMO -->
					<div class="promo-card">
						<div class="row align-items-center">

							<!-- Logo -->
							<div class="col-md-9 text-center">
								<img src="admin/upload/<?php echo $data['gambar_logo']; ?>" class="promo-logo">
							</div>

							<!-- Info -->
							<div class="col-md-3">
								<div class="promo-name">
									<?php echo htmlspecialchars($data['jenis_transaksi']); ?>
								</div>

								<div class="promo-points">
									<?php echo $data['point']; ?> Point
								</div>
							</div>

						</div>
					</div>
					<!-- END CARD -->

				<?php } ?>

				<div class="info-text mt-4">
					* Perhitungan poin dihitung per liter pembelian.<br>
					* Berlaku khusus bagi member yang sudah terdaftar.
				</div>

			</div>
		</div>

	</div>
</section>

<br><br><br>