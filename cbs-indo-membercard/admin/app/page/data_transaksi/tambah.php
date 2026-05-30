<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tambah Transaksi</title>
	<script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100 min-h-screen py-8">


	<div>
		<div class="bg-white rounded-xl shadow-xl overflow-hidden">
			<div class="bg-gray-600 text-white text-2xl font-bold py-6 px-8">
				Tambah Transaksi Baru
			</div>
			<div class="p-8">
				<form action="proses_simpan.php" method="post">

					<!-- ID Transaksi -->
					<div class="mb-6">
						<label class="block text-gray-700 font-semibold mb-2">ID Transaksi <span
								class="text-red-500">*</span></label>
						<input type="text" readonly
							value="<?php echo id_otomatis("data_transaksi", "id_transaksi", "10"); ?>"
							name="id_transaksi" class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50">
					</div>

					<!-- Tanggal & Jam -->
					<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
						<div>
							<label class="block text-gray-700 font-semibold mb-2">Tanggal</label>
							<input type="date" value="<?php echo tanggal_otomatis(); ?>" name="tanggal" required
								class="w-full px-4 py-3 border border-gray-300 rounded-lg">
						</div>
						<div>
							<label class="block text-gray-700 font-semibold mb-2">Jam</label>
							<input type="time" name="jam" required
								class="w-full px-4 py-3 border border-gray-300 rounded-lg">
						</div>
					</div>

					<!-- Pilih Member dengan Search AJAX -->
					<div class="mb-6">
						<label class="block text-gray-700 font-semibold mb-2">Member <span
								class="text-red-500">*</span></label>
						<input type="text" id="searchMemberInput" placeholder="Ketik nama atau no telepon member..."
							autocomplete="off" class="w-full px-4 py-3 border border-gray-300 rounded-lg">
						<div id="memberResults"
							class="mt-2 max-h-60 overflow-y-auto border border-gray-300 rounded-lg hidden bg-white shadow-lg">
						</div>
						<div id="selectedMemberDisplay"
							class="mt-3 p-4 bg-green-50 border border-green-300 rounded-lg hidden">
							<strong id="displayNama"></strong> (<span id="displayTelepon"></span>)
						</div>
						<input type="hidden" name="id_member" id="selectedMemberId" required>
					</div>

					<!-- Kategori Member & Point Saat Ini -->
					<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
						<div>
							<label class="block text-gray-700 font-semibold mb-2">Kategori Member</label>
							<input type="text" id="kategoriMemberDisplay" readonly
								class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50">
							<input type="hidden" name="id_kategori_member" id="selectedKategoriMemberId">
						</div>
						<div>
							<label class="block text-gray-700 font-semibold mb-2">Point Saat Ini</label>
							<input type="text" id="currentPoint" readonly value="0"
								class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 font-bold text-blue-600">
						</div>
					</div>

					<!-- Petugas (Searchable Combobox dengan TomSelect) -->
					<div class="mb-6">
						<label class="block text-gray-700 font-semibold mb-2">Petugas <span
								class="text-red-500">*</span></label>
						<div class="relative">
							<select name="id_petugas" id="select-petugas" required
								class="w-full px-4 py-3 border border-gray-300 rounded-lg">
								<option value="">Pilih atau ketik nama petugas...</option>
								<?php
								$query = "SELECT id_petugas, nama FROM data_petugas ORDER BY nama ASC";
								$result = mysql_query($query);
								while ($row = mysql_fetch_array($result)) {
									$id = $row['id_petugas'];
									$nama = htmlspecialchars($row['nama']);
									echo "<option value=\"$id\">$nama</option>";
								}
								?>
							</select>

						</div>
					</div>

					<!-- Jenis Transaksi -->
					<div class="mb-6">
						<label class="block text-gray-700 font-semibold mb-2">Jenis Transaksi <span
								class="text-red-500">*</span></label>
						<select name="id_jenis_transaksi" id="jenisTransaksi" required
							class="w-full px-4 py-3 border border-gray-300 rounded-lg">
							<option value="">Pilih Jenis Transaksi</option>
							<?php
							$query = "SELECT id_jenis_transaksi, jenis_transaksi, point, harga FROM data_jenis_transaksi ORDER BY jenis_transaksi";
							$result = mysql_query($query);
							while ($row = mysql_fetch_array($result)) {
								$id = $row['id_jenis_transaksi'];
								$nama = htmlspecialchars($row['jenis_transaksi']);
								$point = $row['point'];
								$harga = $row['harga'];
								echo "<option value=\"$id\" data-point=\"$point\" data-harga=\"$harga\">$nama</option>";
							}
							?>
						</select>

						<div id="infoHargaPoint"
							class="mt-4 p-5 bg-gradient-to-r from-blue-50 to-cyan-50 border-2 border-blue-200 rounded-xl hidden">
							<div class="grid grid-cols-2 gap-8 text-lg font-semibold">
								<div>Harga per Liter: <span id="hargaPerLiter"
										class="text-2xl text-red-600 font-bold">Rp 0</span></div>
								<div>Point per Liter: <span id="pointPerLiter"
										class="text-2xl text-green-600 font-bold">0</span></div>
							</div>
							<div id="infoKelipatan">

							</div>
						</div>
					</div>

					<!-- Kategori Jumlah & Jumlah -->
					<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
						<div>
							<label class="block text-gray-700 font-semibold mb-2">Kategori Jumlah <span
									class="text-red-500">*</span></label>
							<select name="kategori_jumlah" id="kategoriJumlah" required
								class="w-full px-4 py-3 border border-gray-300 rounded-lg">
								<option value="">Pilih Kategori</option>
								<?php combo_enum('data_transaksi', 'kategori_jumlah', ''); ?>
							</select>
						</div>
						<div>
							<label class="block text-gray-700 font-semibold mb-2">Jumlah <span
									class="text-red-500">*</span></label>
							<input type="number" step="any" id="jumlah" name="jumlah" required
								placeholder="Pilih Member & Jenis Transaksi dulu..."
								class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 text-gray-500"
								disabled>
							<p id="infoMinimal" class="text-sm text-gray-600 mt-2 hidden"></p>
						</div>
					</div>

					<!-- Point Otomatis & Final -->
					<div class="bg-green-50 border-2 border-green-300 rounded-xl p-6 mb-8">
						<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
							<div>
								<label class="block text-gray-700 font-semibold mb-2">+ Point (otomatis)</label>
								<input type="text" id="pointDidapatAuto" readonly value="0"
									class="w-full px-4 py-3 text-3xl font-bold text-green-600 bg-white border-2 border-green-400 rounded-lg">
							</div>
							<div>
								<label class="block text-gray-700 font-semibold mb-2">Edit Point (Manual)</label>
								<input type="number" id="pointFinal" name="point" value="0" min="0" step="1"
									class="w-full px-4 py-3 text-3xl font-bold text-green-600 bg-white border-2 border-green-400 rounded-lg focus:border-green-600">
							</div>
						</div>
						<div class="mt-6">
							<label class="block text-gray-700 font-semibold mb-2">Total Point Setelah Transaksi</label>
							<input type="text" id="totalPoint" readonly value="0"
								class="w-full px-4 py-3 text-3xl font-bold text-green-700 bg-white border-2 border-green-500 rounded-lg">
						</div>
					</div>

					<div class="text-center">
						<button type="submit"
							class="px-12 py-4 bg-red-600 text-white font-bold text-xl rounded-lg hover:bg-red-700 transition shadow-lg">
							PROSES TRANSAKSI
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script>


		// AJAX Search Member
		document.getElementById('searchMemberInput').addEventListener('input', function () {
			const query = this.value.trim();
			const resultsDiv = document.getElementById('memberResults');
			if (query.length < 2) {
				resultsDiv.innerHTML = '';
				resultsDiv.classList.add('hidden');
				return;
			}

			fetch('apimember.php?q=' + encodeURIComponent(query))
				.then(response => response.json())
				.then(data => {
					resultsDiv.innerHTML = '';
					if (data.length === 0) {
						resultsDiv.innerHTML = '<div class="p-4 text-center text-gray-500">Tidak ditemukan</div>';
						resultsDiv.classList.remove('hidden');
						return;
					}
					data.forEach(member => {
						const div = document.createElement('div');
						div.className = 'p-4 hover:bg-gray-100 cursor-pointer border-b';
						div.innerHTML = `<strong>${member.nama}</strong> (${member.no_telepon}) - ${member.kategori_member} - Point: ${member.point}`;
						div.onclick = () => selectMember(member);
						resultsDiv.appendChild(div);
					});
					resultsDiv.classList.remove('hidden');
				});
		});

		function selectMember(member) {
			document.getElementById('selectedMemberId').value = member.id_member;
			document.getElementById('displayNama').textContent = member.nama;
			document.getElementById('displayTelepon').textContent = member.no_telepon;
			document.getElementById('selectedMemberDisplay').classList.remove('hidden');
			document.getElementById('kategoriMemberDisplay').value = member.kategori_member;
			document.getElementById('selectedKategoriMemberId').value = member.id_kategori_member;
			document.getElementById('currentPoint').value = member.point;
			document.getElementById('memberResults').classList.add('hidden');
			document.getElementById('searchMemberInput').value = '';
			checkEnableJumlah();
			calculatePoints();
		}

		function checkEnableJumlah() {
			const memberOk = document.getElementById('selectedMemberId').value !== '';
			const jenisOk = document.getElementById('jenisTransaksi').value !== '';
			const input = document.getElementById('jumlah');
			if (memberOk && jenisOk) {
				input.disabled = false;
				input.classList.remove('bg-gray-100', 'text-gray-500');
				input.classList.add('bg-white');
				input.placeholder = '';
			} else {
				input.disabled = true;
				input.value = '';
				input.placeholder = 'Pilih Member & Jenis Transaksi dulu...';
			}
			updateMinimalInfo();
		}

		document.getElementById('jenisTransaksi').addEventListener('change', function () {
			const opt = this.options[this.selectedIndex];
			const harga = opt.dataset.harga || '0';
			const point = opt.dataset.point || '0';
			const box = document.getElementById('infoHargaPoint');
			const kelipatanInfo = document.getElementById('infoKelipatan');
			if (this.value) {
				box.classList.remove('hidden');
				document.getElementById('hargaPerLiter').textContent = 'Rp ' + parseInt(harga).toLocaleString('id-ID');
				document.getElementById('pointPerLiter').textContent = point;
				if (document.getElementById('kategoriJumlah').value === 'rupiah') {
					kelipatanInfo.classList.remove('hidden');
				}
			} else {
				box.classList.add('hidden');
				kelipatanInfo.classList.add('hidden');
			}
			checkEnableJumlah();
			calculatePoints();
		});

		function updateMinimalInfo() {
			const kat = document.getElementById('kategoriJumlah').value;
			const harga = parseFloat(document.querySelector('#jenisTransaksi option:checked')?.dataset.harga) || 0;
			const input = document.getElementById('jumlah');
			const info = document.getElementById('infoMinimal');
			const kelipatanInfo = document.getElementById('infoKelipatan');

			if (kat === 'rupiah' && harga > 0) {
				input.min = harga;
				input.step = 'any';
				info.innerHTML = `Minimal: Rp ${parseInt(harga).toLocaleString('id-ID')}`;
				info.classList.remove('hidden');
				kelipatanInfo.classList.remove('hidden');
			} else if (kat === 'liter') {
				input.min = 1;
				input.step = 'any';
				info.textContent = 'Minimal: 1 liter';
				info.classList.remove('hidden');
				kelipatanInfo.classList.add('hidden');
			} else {
				info.classList.add('hidden');
				kelipatanInfo.classList.add('hidden');
			}
		}

		function calculatePoints() {
			const curr = parseFloat(document.getElementById('currentPoint').value) || 0;
			const kat = document.getElementById('kategoriJumlah').value;
			const jml = parseFloat(document.getElementById('jumlah').value) || 0;
			const opt = document.querySelector('#jenisTransaksi option:checked');
			const rate = parseFloat(opt?.dataset.point) || 0;
			const hargaPerLiter = parseFloat(opt?.dataset.harga) || 0;

			let auto = 0;

			if (kat === 'liter' && rate > 0) {
				auto = Math.floor(jml) * rate; // Hanya liter penuh
			} else if (kat === 'rupiah' && hargaPerLiter > 0 && rate > 0) {
				const literPenuh = Math.floor(jml / hargaPerLiter);
				auto = literPenuh * rate; // Point hanya per kelipatan
			}

			document.getElementById('pointDidapatAuto').value = auto.toLocaleString('id-ID');

			const finalInput = document.getElementById('pointFinal');
			if (!finalInput.dataset.edited) {
				finalInput.value = auto;
			}

			const finalPoint = parseFloat(finalInput.value) || 0;
			document.getElementById('totalPoint').value = (curr + finalPoint).toLocaleString('id-ID');
		}

		document.getElementById('pointFinal').addEventListener('input', function () {
			this.dataset.edited = 'true';
			calculatePoints();
		});

		document.getElementById('kategoriJumlah').addEventListener('change', () => {
			updateMinimalInfo();
			calculatePoints();
		});

		document.getElementById('jumlah').addEventListener('input', calculatePoints);

		// Init
		checkEnableJumlah();
	</script>
</body>

</html>