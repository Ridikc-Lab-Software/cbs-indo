<?php
function form_pendaftaran_member()
{
?>
	<br><br>
	<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh; background: #f5f6fa;">

		<div class="register-card p-4">

			<h2 class="text-center mb-3 fw-bold">Pendaftaran Member Baru</h2>
			<p class="text-center small mb-4">Sudah punya akun? <a href="index.php?p=login" class="text-danger">Masuk di sini</a></p>

			<form action="proses_simpan.php" method="post" enctype="multipart/form-data" autocomplete="off">

				<!-- ID Member -->
				<input type="hidden" readonly name="id_member" value="<?= htmlspecialchars(id_otomatis("data_member", "id_member", "10")); ?>">

				<!-- Nik -->
				<div class="mb-3">
					<label class="form-label">NIK</label>
					<input type="text" class="form-control" name="nik" placeholder="NIK" required>
				</div>

				<!-- Nama -->
				<div class="mb-3">
					<label class="form-label">Nama</label>
					<input type="text" class="form-control" name="nama" placeholder="Nama" onkeyup="this.value=this.value.toUpperCase()" required>
				</div>

				<!-- Alamat -->
				<div class="mb-3">
					<label class="form-label">Alamat</label>
					<input type="text" class="form-control" name="alamat" placeholder="Alamat" onkeyup="this.value=this.value.toUpperCase()" required>
				</div>

				<!-- No Telepon -->
				<div class="mb-3">
					<label class="form-label">No Telepon</label>
					<input type="tel" class="form-control" name="no_telepon" placeholder="No Telepon" required>
				</div>

				<!-- Jenis Kelamin -->
				<div class="mb-3">
					<label class="form-label">Jenis Kelamin</label>
					<select class="form-control" name="jenis_kelamin" required>
						<option value="">-- Pilih --</option>
						<?php combo_enum('data_member', 'jenis_kelamin', ''); ?>
					</select>
				</div>

				<!-- Tanggal Lahir -->
				<div class="mb-3">
					<label class="form-label">Tanggal Lahir</label>
					<input type="date" class="form-control" name="tanggal_lahir" value="<?= date('Y-m-d'); ?>" required>
				</div>

				<!-- Agama -->
				<div class="mb-3">
					<label class="form-label">Agama</label>
					<select class="form-control" name="agama" required>
						<option value="">-- Pilih --</option>
						<?php combo_enum('data_member', 'agama', ''); ?>
					</select>
				</div>

				<!-- Status Perkawinan -->
				<div class="mb-3">
					<label class="form-label">Status Perkawinan</label>
					<select class="form-control" name="status_perkawinan" required>
						<option value="">-- Pilih --</option>
						<?php combo_enum('data_member', 'status_perkawinan', ''); ?>
					</select>
				</div>

				<!-- Pekerjaan -->
				<div class="mb-3">
					<label class="form-label">Pekerjaan</label>
					<select class="form-control" name="id_pekerjaan" required>
						<option value="">-- Pilih --</option>
						<?php combo_database("data_pekerjaan", "nama", ""); ?>
					</select>
				</div>

				<!-- Kategori Member -->
				<div class="mb-3">
					<label class="form-label">Kategori Member</label>
					<select class="form-control" name="id_kategori_member" required>
						<option value="">-- Pilih --</option>
						<?php combo_database_v2('data_kategori_member', 'id_kategori_member', 'kategori_member', ''); ?>
					</select>
				</div>

				<!-- SPBU -->
				<div class="mb-3">
					<label class="form-label">SPBU</label>
					<select class="form-control" name="spbu" required>
						<option value="">-- Pilih --</option>
						<?php combo_database("data_spbu", "nama_spbu", ""); ?>
					</select>
				</div>

				<!-- Username & Password -->
				<div class="mb-3">
					<label class="form-label">Username</label>
					<input type="text" class="form-control" name="username" placeholder="Username" required>
				</div>

				<div class="mb-3 position-relative">
					<label class="form-label">Password</label>
					<input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
					<span class="show-pass" onclick="togglePassword()">👁️</span>
				</div>

				<!-- Hidden Fields -->
				<input type="hidden" name="kode_rfid">
				<input type="hidden" name="point">
				<input type="hidden" name="tanggal_terdaftar" value="<?= tanggal_otomatis(); ?>">
				<input type="hidden" name="id_admin" value="<?= baca_database('data_admin', 'id_admin', "select id_admin from data_admin where username='" . decrypt($_COOKIE['jenenge']) . "'"); ?>">

				<!-- Submit -->
				<div class="text-center mt-4">
					<button type="submit" class="btn btn-success w-100 py-2 rounded-pill">Proses Pendaftaran</button>
				</div>

			</form>
		</div>
	</div>

	<style>
		body {
			font-family: 'Asap', sans-serif;
		}

		.register-card {
			background: #fff;
			width: 100%;
			max-width: 600px;
			border-radius: 15px;
			padding: 30px 25px;
			box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
			position: relative;
		}

		.form-control {
			border-radius: 8px;
			border: 1px solid #ccc;
			padding: 10px;
			transition: all 0.3s;
		}

		.form-control:focus {
			border-color: #28a745;
			box-shadow: 0 0 5px rgba(40, 167, 69, 0.3);
		}

		.btn-success {
			background: linear-gradient(90deg, #28a745, #218838);
			border: none;
			font-weight: 600;
			font-size: 16px;
			transition: 0.3s;
		}

		.btn-success:hover {
			background: linear-gradient(90deg, #218838, #28a745);
			transform: translateY(-2px);
			box-shadow: 0 5px 15px rgba(33, 136, 56, 0.3);
		}

		.position-relative {
			position: relative;
		}

		.show-pass {
			position: absolute;
			right: 12px;
			top: 50%;
			transform: translateY(-50%);
			cursor: pointer;
			user-select: none;
			font-size: 18px;
		}
	</style>

	<script>
		function togglePassword() {
			const pass = document.getElementById('password');
			if (pass.type === 'password') pass.type = 'text';
			else pass.type = 'password';
		}
	</script>

<?php
}
?>