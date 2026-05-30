<?php
if (empty($p)) {
	header("Location: index.php?p=home");
	die();
}

// Fungsi cek status promo
function promo_status($start_date, $end_date)
{
	$today = date('Y-m-d');
	if ($today >= $start_date && $today <= $end_date) {
		return 'aktif';
	} else {
		return 'expired';
	}
}

$id_promo = mysql_real_escape_string(decrypt($_GET['id']));
$querytabel = "SELECT * FROM data_promo WHERE id_promo='$id_promo'";
$proses = mysql_query($querytabel);
$data = mysql_fetch_array($proses);

$status = promo_status($data['tanggal_mulai_berlaku'], $data['tanggal_batas_berlaku']);
$badge_color = $status === 'aktif' ? 'bg-success' : 'bg-danger';
$badge_text = $status === 'aktif' ? 'Aktif' : 'Expired';
?>

<section class="container py-5">
	<div class="row g-4 align-items-center">

		<!-- Gambar Kiri -->
		<div class="col-lg-6" data-aos="fade-right" data-aos-duration="1000">
			<div class="card shadow-lg border-0 h-100 position-relative">
				<img
					src="admin/upload/<?= $data['foto_promo']; ?>"
					class="card-img"
					style="height:100%; object-fit: cover;"
					alt="<?= htmlspecialchars($data['nama_promo']); ?>">
				<!-- Badge Status -->
				<span class="position-absolute top-0 start-0 m-3 px-3 py-1 rounded-pill <?= $badge_color ?> text-white fw-bold animate__animated animate__pulse animate__infinite">
					<?= $badge_text ?>
				</span>
			</div>
		</div>

		<!-- Deskripsi Kanan -->
		<div class="col-lg-6" data-aos="fade-left" data-aos-duration="1000">
			<div class="card shadow-sm border-0 p-4 h-100 d-flex flex-column justify-content-between">

				<div>
					<h2 class="fw-bold text-danger mb-3"><?= htmlspecialchars($data['nama_promo']); ?></h2>

					<p><strong>Masa Berlaku:</strong>
						<?= format_indo($data['tanggal_mulai_berlaku']); ?> s/d <?= format_indo($data['tanggal_batas_berlaku']); ?>
					</p>

					<p><strong>Keterangan:</strong><br><?= nl2br(htmlspecialchars($data['keterangan'])); ?></p>

					<p><strong>Syarat & Ketentuan:</strong><br><?= nl2br(htmlspecialchars($data['syarat_dan_ketentuan'])); ?></p>
				</div>

				<div class="text-end mt-3">
					<a href="?p=info_promo"
						class="btn btn-danger px-4 py-2 rounded-pill shadow-sm">
						<i class="bi bi-arrow-left-circle"></i> Kembali
					</a>
				</div>

			</div>
		</div>

	</div>
</section>

<!-- Tambahkan Animate.css & AOS jika belum ada -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
	AOS.init({
		once: true
	});
</script>

<br><br><br>