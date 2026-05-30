<!-- index.php -->
<div class="card-group-title">
  <div class="title-left">
    <img src="../../../data/tmp/membercard/files/icon/report.png" width="40" height="40" alt="Dashboard">
    <p>Dashboard</p>
  </div>
  <div class="title-right">
    <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-secondary btn-sm">
      Refresh
    </a>
    <a onclick="filter_dashboard()" class="btn btn-success btn-sm">
      Filter Dashboard
    </a>
  </div>
</div>

<?php
// Set default tahun = kosong untuk keseluruhan
$tahun_sekarang = date("Y");
$tahun = (isset($_GET['tahun']) && $_GET['tahun'] != '') ? $_GET['tahun'] : '';
?>

<!-- Filter Form -->
<div id="filterBox" style="display:none; background:#f8f9fa; padding:20px; margin:15px 0; border-radius:8px; border:1px solid #ddd;">
  <form method="GET" action="" style="margin:0; padding:0;">

    <!-- Wrapper full width + flex horizontal -->
    <div style="width:100%; display:flex; flex-wrap:wrap; gap:15px; align-items:end; margin-bottom:15px;">

      <!-- SPBU -->
      <div style="flex:1; min-width:220px;">
        <label style="display:block; margin-bottom:5px; font-weight:600;">SPBU</label>
        <select name="spbu" class="form-control" style="width:100%; padding:6px 10px; border:1px solid #ced4da; border-radius:4px; font-size:14px;">
          <option value="">Keseluruhan</option>
          <?php
          $q = mysql_query("SELECT DISTINCT nama_spbu FROM data_petugas WHERE nama_spbu IS NOT NULL AND nama_spbu != '' ORDER BY nama_spbu");
          while ($r = mysql_fetch_array($q)) {
            $selected = (isset($_GET['spbu']) && $_GET['spbu'] == $r['nama_spbu']) ? 'selected' : '';
            echo "<option value=\"" . htmlspecialchars($r['nama_spbu']) . "\" $selected>" . htmlspecialchars($r['nama_spbu']) . "</option>";
          }
          ?>
        </select>
      </div>

      <!-- Kategori Member -->
      <div style="flex:1; min-width:220px;">
        <label style="display:block; margin-bottom:5px; font-weight:600;">Kategori Member</label>
        <select name="kategori" class="form-control" style="width:100%; padding:6px 10px; border:1px solid #ced4da; border-radius:4px; font-size:14px;">
          <option value="">Keseluruhan</option>
          <?php
          $q = mysql_query("SELECT id_kategori_member, kategori_member FROM data_kategori_member ORDER BY kategori_member");
          while ($r = mysql_fetch_array($q)) {
            $selected = (isset($_GET['kategori']) && $_GET['kategori'] == $r['id_kategori_member']) ? 'selected' : '';
            echo "<option value=\"" . $r['id_kategori_member'] . "\" $selected>" . $r['kategori_member'] . "</option>";
          }
          ?>
        </select>
      </div>

      <!-- Jenis Transaksi -->
      <div style="flex:1; min-width:220px;">
        <label style="display:block; margin-bottom:5px; font-weight:600;">Jenis Transaksi</label>
        <select name="jenis_transaksi" class="form-control" style="width:100%; padding:6px 10px; border:1px solid #ced4da; border-radius:4px; font-size:14px;">
          <option value="">Keseluruhan</option>
          <?php
          $q = mysql_query("SELECT id_jenis_transaksi, jenis_transaksi FROM data_jenis_transaksi ORDER BY jenis_transaksi");
          while ($r = mysql_fetch_array($q)) {
            $selected = (isset($_GET['jenis_transaksi']) && $_GET['jenis_transaksi'] == $r['id_jenis_transaksi']) ? 'selected' : '';
            echo "<option value=\"" . $r['id_jenis_transaksi'] . "\" $selected>" . $r['jenis_transaksi'] . "</option>";
          }
          ?>
        </select>
      </div>

      <!-- Bulan -->
      <div style="flex:1; min-width:150px;">
        <label style="display:block; margin-bottom:5px; font-weight:600;">Bulan</label>
        <select name="bulan" class="form-control" style="width:100%; padding:6px 10px; border:1px solid #ced4da; border-radius:4px; font-size:14px;">
          <option value="">Semua</option>
          <?php
          $nama_bulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
          for ($i = 1; $i <= 12; $i++) {
            $selected = (isset($_GET['bulan']) && $_GET['bulan'] == $i) ? 'selected' : '';
            echo "<option value='$i' $selected>" . $nama_bulan[$i] . "</option>";
          }
          ?>
        </select>
      </div>

      <!-- Tahun -->
      <div style="flex:1; min-width:130px;">
        <label style="display:block; margin-bottom:5px; font-weight:600;">Tahun</label>
        <select name="tahun" class="form-control" style="width:100%; padding:6px 10px; border:1px solid #ced4da; border-radius:4px; font-size:14px;">
          <option value="">Keseluruhan</option>
          <?php
          for ($y = 2020; $y <= date("Y") + 1; $y++) {
            $selected = (isset($_GET['tahun']) && $_GET['tahun'] == $y) ? 'selected' : '';
            echo "<option value='$y' $selected>$y</option>";
          }
          ?>
        </select>
      </div>

      <!-- Button Group -->
      <div style="flex:none; display:flex; gap:8px; align-self:end;">
        <button type="submit" class="btn btn-success btn-sm"
          style="padding:8px 20px; font-size:14px; border:none; border-radius:4px; cursor:pointer;">
          Tampilkan
        </button>
        <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-secondary btn-sm"
          style="padding:8px 20px; font-size:14px; border:none; border-radius:4px; text-decoration:none; background:#6c757d; color:white;">
          Reset
        </a>
      </div>

    </div>
  </form>
</div>
<script>
  function filter_dashboard() {
    var x = document.getElementById("filterBox");
    x.style.display = (x.style.display === "block") ? "none" : "block";
  }
</script>

<!-- INFORMASI PENCARIAN -->
<?php
// === KUMPULIN INFO FILTER ===
$info = [];

// SPBU
if (!empty($_GET['spbu'])) {
  $info[] = "<strong>SPBU:</strong> " . htmlspecialchars($_GET['spbu']);
}

// Kategori Member
if (!empty($_GET['kategori'])) {
  $q = mysql_query("SELECT kategori_member FROM data_kategori_member WHERE id_kategori_member = '" . mysql_real_escape_string($_GET['kategori']) . "'");
  if ($r = mysql_fetch_array($q)) {
    $info[] = "<strong>Kategori:</strong> " . htmlspecialchars($r['kategori_member']);
  }
}

// Jenis Transaksi
if (!empty($_GET['jenis_transaksi'])) {
  $q = mysql_query("SELECT jenis_transaksi FROM data_jenis_transaksi WHERE id_jenis_transaksi = '" . mysql_real_escape_string($_GET['jenis_transaksi']) . "'");
  if ($r = mysql_fetch_array($q)) {
    $info[] = "<strong>Jenis Transaksi:</strong> " . htmlspecialchars($r['jenis_transaksi']);
  }
}

// Bulan
if (!empty($_GET['bulan'])) {
  $nama_bulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
  $bln = $nama_bulan[(int)$_GET['bulan']];
  $tahun_text = !empty($_GET['tahun']) ? " " . (int)$_GET['tahun'] : "";
  $info[] = "<strong>Bulan:</strong> $bln$tahun_text";
}

// Tahun (hanya jika tidak ada bulan)
if (!empty($_GET['tahun']) && empty($_GET['bulan'])) {
  $info[] = "<strong>Tahun:</strong> " . (int)$_GET['tahun'];
}

// === TAMPILKAN ALERT HANYA JIKA ADA FILTER ===
if (!empty($info)) {
?>
  <div class="mt-4 mb-3">
    <div class="alert alert-info text-center" style="border-radius:12px; padding:18px; font-size:16px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
      Menampilkan data untuk: <?= implode(" • ", $info) ?>
    </div>
  </div>
<?php
} else {
  // Jika tidak ada filter sama sekali → tidak tampilkan apa-apa (bahkan spasi kosong pun tidak)
  // Bisa juga ditambahkan pesan default jika mau:
  // echo '<div class="mt-4 mb-3 text-center" style="color:#666;font-style:italic;">Menampilkan <strong>Keseluruhan Data</strong></div>';
}
?>

<!-- Dashboard Cards -->
<div class="dashboard-container" style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
  <!-- Cards will be populated via JS -->
</div>

<!-- Member Status Charts -->
<div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap; padding-top: 20px;">
  <div class="card shadow mb-4" style="border-radius:12px; box-shadow:0 4px 14px rgba(0,0,0,0.08); padding:10px; padding-bottom:30px; width: 50%;">
    <br>
    <center>
      <h2>Status Member</h2>
    </center><br>
    <div class="card-body"><canvas id="chartMemberStatus" height="320"></canvas></div>
    <div class="card-footer text-center text-muted small">Member aktif jika transaksi terakhir < 3 bulan (Keseluruhan)</div>
    </div>

    <div class="card shadow mb-4" style="border-radius:12px; box-shadow:0 4px 14px rgba(0,0,0,0.08); padding:10px; padding-bottom:30px; width: 48%;">
      <br>
      <center>
        <h2>Status Member Per Kategori</h2>
      </center><br>
      <div class="card-body"><canvas id="chartPerKategoriStatus" height="320"></canvas></div>
      <div class="card-footer text-center text-muted small">Per Kategori Member (Keseluruhan)</div>
    </div>
  </div>

  <!-- Top Sections -->
  <!-- TOP 3 KOLOM – RAPI & MODERN -->
  <div class="top-container">
    <div class="top-card">
      <h3>Top Transaksi</h3>
      <div id="topTransaksi" class="top-list"></div>
    </div>

    <div class="top-card">
      <h3>Top Redeem</h3>
      <div id="topRedeem" class="top-list"></div>
    </div>

    <div class="top-card">
      <h3>Top Point</h3>
      <div id="topPoint" class="top-list"></div>
    </div>
  </div>

  <style>
    .top-container {
      display: flex;
      gap: 25px;
      justify-content: center;
      flex-wrap: wrap;
      margin: 50px 0;
    }

    .top-card {
      background: #fff;
      border-radius: 14px;
      padding: 20px;
      width: 332px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
      border: 1px solid #eee;
    }

    .top-card h3 {
      text-align: center;
      font-size: 1.25rem;
      color: #2c3e50;
      margin-bottom: 20px;
      font-weight: 600;
    }

    .top-list {
      font-size: 0.95rem;
      line-height: 1.7;
    }

    .top-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 12px 0;
      border-bottom: 1px dashed #ddd;
    }

    .top-item:last-child {
      border-bottom: none;
    }

    .top-rank {
      font-weight: bold;
      color: #4e73df;
      font-size: 12px;
      min-width: 30px;
    }

    .top-name {
      flex: 1;
      margin-left: -1px;
      color: rgba(4, 4, 5, 1)ff;
      font-size: 12px;
    }

    .top-value {
      font-weight: bold;
      color: #ee5049;
      font-size: 12px;
    }


    .stats-section {
      display: flex;
      gap: 30px;
      justify-content: center;
      flex-wrap: wrap;
      margin: 50px 0;
    }

    .stat-card {
      background: #fff;
      border-radius: 16px;
      padding: 25px;
      width: 100%;
      max-width: 500px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .stat-title {
      font-size: 1.4rem;
      color: #2c3e50;
      margin-bottom: 20px;
      font-weight: 600;
    }

    .stat-total {
      margin: 20px 0;
    }

    .big-number {
      font-size: 1.2rem;
      font-weight: bold;
      color: #ee5049;
    }



    .stat-list {
      margin-top: 20px;
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
      justify-content: center;
    }

    .stat-item {
      background: #ffffff;
      padding: 2px;
      place-items: center;
      align-content: flex-end;
      border-radius: 10px;
      min-width: 70px;
      font-size: 0.95rem;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    .stat-item strong {
      color: #2c3e50;
      font-size: 1.12px;
      display: block;
    }
  </style>

  <!-- GANTI SEMUA BAGIAN INI DENGKAP DENGAN INI -->
  <div class="stats-section">

    <!-- 1. TRANSAKSI PER JENIS BBM -->
    <div class="stat-card">
      <h3 class="stat-title">Transaksi per Jenis BBM</h3>
      <div class="stat-total">
        <span class="big-number" id="totalTransaksiJenis">0</span>
        <span class="label">Total Transaksi</span>
      </div>
      <canvas id="chartJenisBBM" height="280"></canvas>
      <div class="stat-list" id="listJenisBBM"></div>
    </div>

    <!-- 2. MEMBER PER KATEGORI -->
    <div class="stat-card">
      <h3 class="stat-title">Member per Kategori</h3>
      <div class="stat-total">
        <span class="big-number" id="totalMemberKategori">0</span>
        <span class="label">Total Member</span>
      </div>
      <canvas id="chartKategoriMember" height="280"></canvas>
      <div class="stat-list" id="listKategoriMember"></div>
    </div>



  </div>
  </a>
</div>

</div>

<!-- Chart.js + JavaScript Utama -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const urlParams = new URLSearchParams(window.location.search);
  const spbu = urlParams.get('spbu') || '';
  const kategori = urlParams.get('kategori') || '';
  const jenis = urlParams.get('jenis_transaksi') || '';
  const bulan = urlParams.get('bulan') || '';
  const tahun = urlParams.get('tahun') || '';

  fetch(`get_dashboard_data.php?spbu=${spbu}&kategori=${kategori}&jenis_transaksi=${jenis}&bulan=${bulan}&tahun=${tahun}`)
    .then(response => {
      if (!response.ok) throw new Error('HTTP ' + response.status);
      return response.json();
    })
    .then(data => {
      // ==== CARD UTAMA ====
      document.querySelector('.dashboard-container').innerHTML = `
        <div class="card" style="width:200px;padding:15px;border-radius:8px;box-shadow:0 2px 6px rgba(0,0,0,0.1);text-align:center">
          <center><img src="../../../data/tmp/membercard/files/icon/member.png" width="50"><h3 style="margin-top: 10px;">${data.total_member}</h3></center><p>Member</p>
        </div>
        <div class="card" style="width:200px;padding:15px;border-radius:8px;box-shadow:0 2px 6px rgba(0,0,0,0.1);text-align:center">
          <center><img src="../../../data/tmp/membercard/files/icon/transaksi.png" width="50"><h3 style="margin-top: 10px;">${data.total_transaksi}</h3></center><p>Transaksi</p>
        </div>
        <div class="card" style="width:200px;padding:15px;border-radius:8px;box-shadow:0 2px 6px rgba(0,0,0,0.1);text-align:center">
          <center><img src="../../../data/tmp/membercard/files/icon/redeem.png" width="50"><h3 style="margin-top: 10px;">${data.total_redeem}</h3></center><p>Redeem</p>
        </div>
        <div class="card" style="width:200px;padding:15px;border-radius:8px;box-shadow:0 2px 6px rgba(0,0,0,0.1);text-align:center">
          <center><img src="../../../data/tmp/membercard/files/icon/promo.png" width="50"><h3 style="margin-top: 10px;">${data.total_promo}</h3></center><p>Promo</p>
        </div>
        <div class="card" style="width:200px;padding:15px;border-radius:8px;box-shadow:0 2px 6px rgba(0,0,0,0.1);text-align:center">
          <center><img src="../../../data/tmp/membercard/files/icon/mitra.png" width="50"><h3 style="margin-top: 10px;">${data.total_mitra}</h3></center><p>Mitra</p>
        </div>
      `;

      // ==== PIE CHART KESELURUHAN ====
      new Chart(document.getElementById('chartMemberStatus'), {
        type: 'pie',
        data: {
          labels: ['Aktif (≤3 bulan)', 'Tidak Aktif'],
          datasets: [{
            data: [data.member_aktif, data.member_tidak_aktif],
            backgroundColor: ['#40978a', '#ee5049']
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: 'top'
            }
          }
        }
      });

      // ==== BAR CHART PER KATEGORI ====
      new Chart(document.getElementById('chartPerKategoriStatus'), {
        type: 'bar',
        data: {
          labels: data.per_kategori_aktif.map(x => x.kategori),
          datasets: [{
              label: 'Aktif',
              data: data.per_kategori_aktif.map(x => x.aktif),
              backgroundColor: '#40978a'
            },
            {
              label: 'Tidak Aktif',
              data: data.per_kategori_aktif.map(x => x.tidak_aktif),
              backgroundColor: '#ee5049'
            }
          ]
        },
        options: {
          responsive: true,
          scales: {
            y: {
              beginAtZero: true
            }
          },
          plugins: {
            legend: {
              position: 'top'
            }
          }
        }
      });

      // ==== TOP LIST TOP ====
      // TOP 5 TRANSAKSI
      document.getElementById('topTransaksi').innerHTML =
        (data.top_transaksi || []).map((item, index) => `
    <div class="top-item">
      <span class="top-rank">${index + 1}</span>
      <div class="top-name"><strong>${item.nama || 'Tanpa Nama'}</strong></div>
      <div class="top-value">${item.jml.toLocaleString()}</div>
    </div>
  `).join('');

      // TOP 5 REDEEM
      document.getElementById('topRedeem').innerHTML =
        (data.top_redeem || []).map((item, index) => `
    <div class="top-item">
      <span class="top-rank">${index + 1}</span>
      <div class="top-name"><strong>${item.nama || 'Tanpa Nama'}</strong></div>
      <div class="top-value">${item.jml.toLocaleString()}</div>
    </div>
  `).join('');

      // TOP 4 POINT
      document.getElementById('topPoint').innerHTML =
        (data.top_point || []).map((item, index) => `
    <div class="top-item">
      <span class="top-rank">${index + 1}</span>
      <div class="top-name"><strong>${item.nama || 'Tanpa Nama'}</strong></div>
      <div class="top-value">${(item.point || 0).toLocaleString()}</div>
    </div>
  `).join('');
      // ==== CARD PER SPBU / JENIS / KATEGORI ====
      const cont = document.querySelector('.per-category-container');
      let html = '';

      // === 1. TRANSAKSI PER JENIS BBM ===
      const jenisData = data.per_jenis_transaksi || [];
      const totalJenis = jenisData.reduce((a, b) => a + (parseInt(b.jml) || 0), 0);
      document.getElementById('totalTransaksiJenis').textContent = totalJenis.toLocaleString();

      // List kecil di bawah grafik
      let listJenis = '';
      jenisData.forEach(x => {
        const img = x.gambar_logo ? `../../../upload/${x.gambar_logo}` : '';
        listJenis += `
    <div class="stat-item">
      ${img ? `<img src="${img}" width="40" style="border-radius:6px;vertical-align:middle;margin-right:8px;">` : ''}
      <br>
      <p>${x.jml}</p>
      
      <small>${x.jenis_transaksi || 'Tidak Diketahui'}</small>
    </div>`;
      });
      document.getElementById('listJenisBBM').innerHTML = listJenis;

      // Grafik
      new Chart(document.getElementById('chartJenisBBM'), {
        type: 'bar',
        data: {
          labels: jenisData.map(x => x.jenis_transaksi || 'Lainnya'),
          datasets: [{
            label: 'Jumlah Transaksi',
            data: jenisData.map(x => x.jml),
            backgroundColor: '#ee5049',
            borderRadius: 8,
            borderSkipped: false,
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              display: false
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                font: {
                  size: 13
                }
              }
            }
          }
        }
      });

      // === 2. MEMBER PER KATEGORI ===
      const kategoriData = data.per_kategori || [];
      const totalKategori = kategoriData.reduce((a, b) => a + (parseInt(b.jml) || 0), 0);
      document.getElementById('totalMemberKategori').textContent = totalKategori.toLocaleString();

      // List kecil
      let listKategori = '';
      kategoriData.forEach(x => {

        const img = x.gambar_logo ? `../../../upload/${x.gambar_logo}` : '../../../data/tmp/membercard/files/icon/member.png';
        listKategori += `
    <div class="stat-item">
      ${img ? `<img src="${img}" width="40" style="border-radius:6px;vertical-align:middle;margin-right:8px;">` : ''}
      <br>
      <p>${x.jml}</p>
      <small>${x.kategori_member || 'Tidak Diketahui'}</small>
    </div>`;
      });
      document.getElementById('listKategoriMember').innerHTML = listKategori;

      // Grafik Doughnut cantik
      new Chart(document.getElementById('chartKategoriMember'), {
        type: 'doughnut',
        data: {
          labels: kategoriData.map(x => x.kategori_member || 'Tidak Diketahui'),
          datasets: [{
            data: kategoriData.map(x => x.jml),
            backgroundColor: ['#40978a', '#ee5049', '#ccb836ff', '#1554b1ff', '#91079eff', '#1b0d0aff'],
            borderWidth: 3,
            borderColor: '#fff'
          }]
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              position: 'bottom',
              labels: {
                padding: 20,
                font: {
                  size: 13
                }
              }
            }
          }
        }
      });

    })
    .catch(err => {
      console.error(err);
      alert('Gagal memuat data dashboard.\nPeriksa console browser dan pastikan file get_dashboard_data.php tidak error.');
    });
</script>