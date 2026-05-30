<style>
	/* ========================= CARD GRID ========================= */
	.list-wrap ul {
		display: grid;
		grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
		gap: 20px;
		padding: 0;
		margin: 0;
	}

	.list-wrap ul li {
		list-style: none;
	}

	/* ========================= CARD ========================= */
	.card-mitra {
		background: #fff;
		border-radius: 16px;
		padding: 20px;
		border: 1px solid #e9e9e9;
		box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);

		/* Agar tinggi sama */
		display: flex;
		flex-direction: column;
		justify-content: space-between;

		transition: .25s ease;
	}

	.card-mitra:hover {
		transform: translateY(-5px);
		box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
	}

	/* ========================= CONTENT WRAPPER ========================= */
	.card-content {
		display: flex;
		gap: 18px;
	}

	/* ========================= LEFT IMAGE ========================= */
	.card-img {
		width: 90px;
		height: 90px;
		border-radius: 14px;
		object-fit: cover;
		flex-shrink: 0;
	}

	/* ========================= RIGHT TEXT ========================= */
	.card-text {
		flex: 1;
	}

	.card-text h3 {
		margin: 0;
		font-size: 20px;
		color: #222;
		font-weight: 600;
	}

	.card-text .meta {
		color: #777;
		font-size: 13px;
		margin-top: 4px;
	}

	.card-text p {
		font-size: 14px;
		margin-top: 8px;
		color: #444;
		line-height: 1.4;
	}

	/* ========================= RIGHT BOTTOM ========================= */
	.card-right {
		margin-top: auto;
		text-align: right;
		padding-top: 12px;
		border-top: 1px solid #eee;
	}

	.price {
		font-weight: 600;
		color: #444;
		display: block;
		margin-bottom: 10px;
	}

	/* ========================= BUTTONS ========================= */
	.btn-modern {
		background: #4D7CFE;
		padding: 8px 14px;
		border-radius: 8px;
		color: #fff;
		font-size: 13px;
		text-decoration: none;
		margin-left: 6px;
		display: inline-block;
		transition: .2s ease;
	}

	.btn-modern:hover {
		background: #325fed;
	}

	.btn-info-modern {
		background: #00b894;
	}

	.btn-info-modern:hover {
		background: #009f7d;
	}
</style>
<div class="card-group-title">
	<div class="title-left">
		<img src="../../../data/tmp/membercard/files/icon/promo.png" width="40px">
		<p>
			Promo Mitra
		</p>
	</div>
</div>



<div class="content-widgets gray">

	<div class="widget-container">
		<div>
			<div class="clearfix list-search-bar">

			</div>
			<div class="list-wrap">
				<ul id="products" class="list clearfix">

					<?php
					$no = 0;
					$startRow = ($page - 1) * $dataPerPage;
					$no = $startRow;

					if (isset($_GET['Berdasarkan']) && !empty($_GET['Berdasarkan']) && isset($_GET['isi']) && !empty($_GET['isi'])) {
						$berdasarkan =  mysql_real_escape_string($_GET['Berdasarkan']);
						$isi =  mysql_real_escape_string($_GET['isi']);
						$querytabel = "SELECT * FROM data_mitra where $berdasarkan like '%$isi%' ";
						$querypagination = "SELECT COUNT(*) AS total FROM data_mitra where $berdasarkan like '%$isi%'";
					} else {
						$querytabel = "SELECT * FROM data_mitra  ";
						$querypagination = "SELECT COUNT(*) AS total FROM data_mitra";
					}
					$proses = mysql_query($querytabel);
					while ($data = mysql_fetch_array($proses)) { ?>
						<?php $id_mitra =  $data['id_mitra']; ?>
						<li>
							<div class="card-mitra">

								<div class="card-content">

									<!-- <img src="../../../../admin/upload/<?php echo $data['gambar_logo']; ?>" class="card-img" alt=""> -->
									<img src="../../../upload/<?php echo $data['gambar_logo']; ?>" class="card-img" alt="">

									<div class="card-text">
										<h3><?php echo ($data['nama_mitra']); ?></h3>
										<span class="meta">Pemilik: <?php echo ($data['nama_pemilik']); ?> | Kontak: <?php echo ($data['no_telepon_pemilik']); ?></span>
										<p>
											<?php echo ($data['nama_mitra']); ?> terdaftar pada
											<?php echo (format_indo($data['tanggal_daftar'])); ?>,
											beralamat di <?php
															$alamat = $data['alamat'];
															$alamat_singkat = (strlen($alamat) > 10) ? substr($alamat, 0, 10) . "..." : $alamat;
															echo $alamat_singkat;
															?>.
											<br>
											<br>


										</p>
									</div>

								</div>

								<div class="card-right">

									<a href="../data_mitra/index.php?input=detail&proses=<?php echo encrypt($id_mitra); ?>"
										class="btn btn-secondary">Detail</a>
									<a href="../data_redeem/index.php?Berdasarkan=id_mitra&isi=<?php echo $id_mitra; ?>"
										class="btn btn-primary">Riwayat Redeem</a>

									<a href="../data_promo/index.php?Berdasarkan=id_mitra&isi=<?php echo $id_mitra; ?>"
										class="btn btn-success">Lihat Promo</a>
								</div>

							</div>
						</li>



					<?php } ?>

				</ul>
			</div>

		</div>
	</div>
</div>