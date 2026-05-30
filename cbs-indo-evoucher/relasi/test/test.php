<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Relasi</title>

    <!-- Bootstrap 5 + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .modal-header {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border-radius: 0;
        }
        .modal-title {
            font-weight: 800;
        }
        .relasi-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            transition: all 0.4s ease;
            cursor: pointer;
            height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 1.5rem;
            position: relative;
            border: 1px solid rgba(255,255,255,0.3);
        }
        .relasi-card:hover {
            transform: translateY(-12px) scale(1.05);
            box-shadow: 0 20px 40px rgba(0,0,0,0.25);
            background: white;
        }
        .relasi-card .icon {
            font-size: 3.2rem;
            margin-bottom: 0.8rem;
            color: #667eea;
            transition: all 0.4s;
        }
        .relasi-card:hover .icon {
            color: #764ba2;
            transform: scale(1.2);
        }
        .relasi-card h5 {
            font-weight: 700;
            color: #333;
            margin: 0;
        }
        .relasi-card small {
            color: #666;
            font-size: 0.85rem;
        }
        .badge {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 0.65rem;
        }
        /* Ripple Effect */
        .relasi-card {
            overflow: hidden;
        }
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.7);
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        }
        @keyframes ripple {
            to { transform: scale(4); opacity: 0; }
        }
    </style>
</head>
<body class="d-flex flex-column justify-content-center align-items-center min-vh-100">

    <!-- Tombol untuk buka modal -->
     <div class='container-sm mb-4'>

         <input type="text" name="relasi" id="relasi" class='form-control'>
        </div>
    <button type="button" class="btn btn-light btn-lg px-5 py-3 shadow-lg" data-bs-toggle="modal" data-bs-target="#modalRelasi">
        <i class="bi bi-building me-2"></i> PILIH RELASI
    </button>

    <!-- Modal -->
    <div class="modal fade" id="modalRelasi" tabindex="-1" aria-labelledby="modalRelasiLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content overflow-hidden">
                <div class="modal-header text-white">
                    <h1 class="modal-title fs-4" id="modalRelasiLabel">
                        <i class="bi bi-grid-3x3-gap-fill me-2"></i> PILIH RELASI
                    </h1>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body py-4">
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4 justify-content-center">

                        <!-- Relasi 1 -->
                        <div class="col" onclick='select_relasi(this)'>
                            <input type="hidden" name="relasi" value="A">
                            <a href="#" class="text-decoration-none">
                                <div class="relasi-card">
                                    <i class="bi bi-building icon"></i>
                                    <h5>PT Cahaya Bungo</h5>
                                    <small>Jl. Lintas Sumatera KM 12</small>
                                    <span class="badge bg-success">Aktif</span>
                                </div>
                            </a>
                        </div>

                        <!-- Relasi 2 -->
                        <div class="col" onclick='select_relasi(this)'>
                            <input type="hidden" name="relasi" value="B">
                            <a href="#" class="text-decoration-none">
                                <div class="relasi-card">
                                    <i class="bi bi-truck icon"></i>
                                    <h5>PT Sarkopalma</h5>
                                    <small>50 Kendaraan Aktif</small>
                                    <span class="badge bg-primary">Premium</span>
                                </div>
                            </a>
                        </div>

                        <!-- Relasi 3 -->
                        <div class="col" onclick='select_relasi(this)'>
                            <input type="hidden" name="relasi" value="C">
                            <a href="#" class="text-decoration-none">
                                <div class="relasi-card">
                                    <i class="bi bi-shop icon"></i>
                                    <h5>CV Maju Jaya</h5>
                                    <small>Distributor Resmi</small>
                                </div>
                            </a>
                        </div>

                        <!-- Relasi 4 -->
                        <div class="col" onclick='select_relasi(this)'>
                            <input type="hidden" name="relasi" value="D">
                            <a href="#" class="text-decoration-none">
                                <div class="relasi-card">
                                    <i class="bi bi-people icon"></i>
                                    <h5>Toko Bersama</h5>
                                    <small>Koperasi Karyawan</small>
                                </div>
                            </a>
                        </div>

                        <!-- Relasi 5 -->
                        <div class="col" onclick='select_relasi(this)'>
                            <input type="hidden" name="relasi" value="E">
                            <a href="#" class="text-decoration-none">
                                <div class="relasi-card">
                                    <i class="bi bi-award icon"></i>
                                    <h5>UD Sumber Rejeki</h5>
                                    <small>Partner Terbaik 2024</small>
                                    <span class="badge bg-warning text-dark">Top</span>
                                </div>
                            </a>
                        </div>

                        <!-- Tambah Relasi -->
                        <div class="col" onclick='select_relasi(this)'>
                            <input type="hidden" name="relasi" value="F">
                            <a href="#" class="text-decoration-none">
                                <div class="relasi-card bg-primary text-white border-0">
                                    <i class="bi bi-plus-circle-dotted icon" style="font-size:4rem;"></i>
                                    <h5 class="mt-3">Tambah Relasi</h5>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Efek Ripple saat klik kartu -->
<script>
    // Efek ripple saat klik kartu
    document.querySelectorAll('.relasi-card').forEach(card => {
        card.addEventListener('click', function(e) {
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size/2;
            const y = e.clientY - rect.top - size/2;

            const ripple = document.createElement('span');
            ripple.classList.add('ripple');
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';

            this.appendChild(ripple);
            setTimeout(() => ripple.remove(), 600);
        });
    });

    // FUNGSI UTAMA: PILIH RELASI + TUTUP MODAL
    function select_relasi(item) {
        // Ambil data dari kartu
        const kodeRelasi = item.querySelector('input[type="hidden"]').value;
        const namaRelasi = item.querySelector('h5').textContent.trim();

        // Masukkan ke input di luar modal
        const inputRelasi = document.getElementById("relasi");
        inputRelasi.value = kodeRelasi;

        // Optional: ubah placeholder atau tampilkan nama relasi
        inputRelasi.placeholder = namaRelasi;
        inputRelasi.setAttribute('data-nama', namaRelasi);

        // Tutup modal dengan benar (pakai Bootstrap API)
        const modal = bootstrap.Modal.getInstance(document.getElementById('modalRelasi'));
        modal.hide();
    }

    // Optional: biar lebih keren, ubah tombol jadi menunjukkan relasi yang dipilih
    document.getElementById('relasi').addEventListener('input', function() {
        const tombol = document.querySelector('button[data-bs-target="#modalRelasi"]');
        if (this.value) {
            tombol.innerHTML = `<i class="bi bi-check-circle-fill me-2"></i> ${this.getAttribute('data-nama') || this.value}`;
            tombol.classList.remove('btn-light');
            tombol.classList.add('btn-success');
        } else {
            tombol.innerHTML = `<i class="bi bi-building me-2"></i> PILIH RELASI`;
            tombol.classList.remove('btn-success');
            tombol.classList.add('btn-light');
        }
    });
</script>
</body>
</html>