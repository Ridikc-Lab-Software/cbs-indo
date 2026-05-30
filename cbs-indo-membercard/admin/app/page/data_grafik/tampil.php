<div class="card-group-title">
    <div class="title-left">
        <img src="../../../data/tmp/membercard/files/icon/report.png" width="40" height="40" alt="Grafik">
        <p>Grafik</p>
    </div>
    <div class="title-right">
        <a href="<?php echo $_SERVER['PHP_SELF']; ?>" class="btn btn-secondary btn-sm">
            Refresh
        </a>
        <a onclick="filter_grafik()" class="btn btn-success btn-sm">
            Filter Grafik
        </a>
    </div>
</div>

<?php
// Set default tahun = tahun sekarang
$tahun_sekarang = date("Y");
$tahun = (isset($_GET['tahun']) && $_GET['tahun'] != '') ? $_GET['tahun'] : $tahun_sekarang;

// URL Reset = kembali ke tahun berjalan
$reset_url = $_SERVER['PHP_SELF'] . "?tahun=" . $tahun_sekarang;
?>

<!-- Filter Form -->
<div id="filterBox" style="display:none; background:#f8f9fa; padding:20px; margin:15px 0; border-radius:8px; border:1px solid #ddd;">
    <form method="GET" action="">
        <div class="row gap-3">
            <div class="col-md-3">
                <label>SPBU</label>
                <select name="spbu" class="form-control form-control-sm">
                    <option value="">Keseluruhan</option>
                    <?php
                    $spbus_list = ['24.373.27', '24.373.32'];
                    foreach ($spbus_list as $code) {
                        $selected = (isset($_GET['spbu']) && (strpos($_GET['spbu'], $code) === 0 || strpos($code, $_GET['spbu']) === 0)) ? 'selected' : '';
                        echo "<option value='$code' $selected>$code</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-3">
                <label>Kategori Member</label>
                <select name="kategori" class="form-control form-control-sm">
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

            <div class="col-md-3">
                <label>Jenis Transaksi</label>
                <select name="jenis_transaksi" class="form-control form-control-sm">
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

            <div class="col-md-1">
                <label>Bulan</label>
                <select name="bulan" class="form-control form-control-sm">
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

            <div class="col-md-2">
                <label>Tahun</label>
                <select name="tahun" class="form-control form-control-sm">
                    <?php
                    for ($y = 2020; $y <= date("Y") + 1; $y++) {
                        $selected = ($y == $tahun) ? 'selected' : '';
                        echo "<option value='$y' $selected>$y</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <br>
        <br>
        <button type="submit" class="btn btn-success btn-sm">Tampilkan</button>
        <a href="<?php echo $reset_url; ?>" class="btn btn-secondary btn-sm">Reset</a>

    </form>
</div>

<script>
    function filter_grafik() {
        var x = document.getElementById("filterBox");
        x.style.display = (x.style.display === "block") ? "none" : "block";
    }
</script>

<!-- INFORMASI PENCARIAN -->
<div class="mt-4 mb-3">
    <div class="alert alert-info text-center" style="border-radius:12px; padding:18px; font-size:16px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <?php
        $info = [];
        if (!empty($_GET['spbu'])) {
            $info[] = "<strong>SPBU:</strong> " . htmlspecialchars($_GET['spbu']);
        }
        if (!empty($_GET['kategori'])) {
            $q = mysql_query("SELECT kategori_member FROM data_kategori_member WHERE id_kategori_member = '" . mysql_real_escape_string($_GET['kategori']) . "'");
            $r = mysql_fetch_array($q);
            $info[] = "<strong>Kategori:</strong> " . $r['kategori_member'];
        }
        if (!empty($_GET['jenis_transaksi'])) {
            $q = mysql_query("SELECT jenis_transaksi FROM data_jenis_transaksi WHERE id_jenis_transaksi = '" . mysql_real_escape_string($_GET['jenis_transaksi']) . "'");
            $r = mysql_fetch_array($q);
            $info[] = "<strong>Jenis Transaksi:</strong> " . $r['jenis_transaksi'];
        }
        if (!empty($_GET['bulan'])) {
            $nama_bulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            $info[] = "<strong>Bulan:</strong> " . $nama_bulan[(int)$_GET['bulan']] . " $tahun";
        }
        $info[] = "<strong>Tahun:</strong> $tahun";

        if (count($info) > 1 || !empty($_GET['spbu']) || !empty($_GET['kategori']) || !empty($_GET['jenis_transaksi']) || !empty($_GET['bulan'])) {
            echo "Menampilkan data untuk: " . implode(" • ", $info);
        } else {
            echo "Menampilkan data untuk <strong>Tahun: $tahun</strong> (semua SPBU, kategori, dan jenis transaksi)";
        }
        ?>
    </div>
</div>

<!-- 3 Grafik Full Width - Vertikal -->
<div class="mt-4">
    <div class="card shadow mb-4" style="border-radius:12px; box-shadow:0 4px 14px rgba(0,0,0,0.08); padding:10px; padding-bottom:30px;">
        <br>
        <center>
            <h2 id="titleTransaksi">Grafik Transaksi</h2>
        </center><br>
        <div class="card-body"><canvas id="chartTransaksi" height="320"></canvas></div>
        <div class="card-footer text-center text-muted small">Total Transaksi Berdasarkan Filter yang Dipilih</div>
    </div>

    <div class="card shadow mb-4" style="border-radius:12px; box-shadow:0 4px 14px rgba(0,0,0,0.08); padding:10px; padding-bottom:30px;">
        <br>
        <center>
            <h2 id="titleRedeem">Grafik Redeem</h2>
        </center><br>
        <div class="card-body"><canvas id="chartRedeem" height="320"></canvas></div>
        <div class="card-footer text-center text-muted small">Jumlah Penukaran Hadiah / Redeem Point</div>
    </div>

    <div class="card shadow mb-5" style="border-radius:12px; box-shadow:0 4px 14px rgba(0,0,0,0.08); padding:10px; padding-bottom:30px;">
        <br>
        <center>
            <h2 id="titleMember">Grafik Pendaftaran Member Baru</h2>
        </center><br>
        <div class="card-body"><canvas id="chartMember" height="320"></canvas></div>
        <div class="card-footer text-center text-muted small">Pertumbuhan Member Baru per Bulan</div>
    </div>
</div>

<!-- Chart.js + JavaScript Utama -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0"></script>
<script>
    // Register the datalabels plugin globally
    Chart.register(ChartDataLabels);

    // Ambil parameter (tahun default sudah ditangani di PHP)
    const urlParams = new URLSearchParams(window.location.search);
    const spbu = urlParams.get('spbu') || '';
    const kategori = urlParams.get('kategori') || '';
    const jenis = urlParams.get('jenis_transaksi') || '';
    const bulan = urlParams.get('bulan') || '';
    const tahun = urlParams.get('tahun') || '<?php echo $tahun_sekarang; ?>'; // fallback JS

    // Load data
    fetch(`get_grafik_data.php?spbu=${spbu}&kategori=${kategori}&jenis_transaksi=${jenis}&bulan=${bulan}&tahun=${tahun}`)
        .then(r => r.json())
        .then(data => {
            const labels = data.labels;

            // Calculate totals
            const totalTransaksi = data.transaksi.reduce((a, b) => a + b, 0);
            const totalRedeem = data.redeem.reduce((a, b) => a + b, 0);
            const totalMember = data.member.reduce((a, b) => a + b, 0);

            // Update titles with formatted totals
            document.getElementById('titleTransaksi').innerText = `Grafik Transaksi (Total: ${totalTransaksi.toLocaleString('id-ID')})`;
            document.getElementById('titleRedeem').innerText = `Grafik Redeem (Total: ${totalRedeem.toLocaleString('id-ID')})`;
            document.getElementById('titleMember').innerText = `Grafik Pendaftaran Member Baru (Total: ${totalMember.toLocaleString('id-ID')})`;

            // Grafik Transaksi
            new Chart(document.getElementById('chartTransaksi'), {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Transaksi',
                        data: data.transaksi,
                        borderColor: '#007bff',
                        backgroundColor: 'rgba(0,123,255,0.15)',
                        borderWidth: 3,
                        pointRadius: 5,
                        pointHoverRadius: 8,
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            top: 25
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                font: {
                                    size: 14
                                }
                            }
                        },
                        datalabels: {
                            display: true,
                            align: 'top',
                            anchor: 'end',
                            offset: 4,
                            color: '#333333',
                            font: {
                                weight: 'bold',
                                size: 11
                            },
                            formatter: function(value) {
                                return value.toLocaleString('id-ID');
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Grafik Redeem
            new Chart(document.getElementById('chartRedeem'), {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Redeem',
                        data: data.redeem,
                        borderColor: '#28a745',
                        backgroundColor: 'rgba(40,167,69,0.15)',
                        borderWidth: 3,
                        pointRadius: 5,
                        pointHoverRadius: 8,
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            top: 25
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                font: {
                                    size: 14
                                }
                            }
                        },
                        datalabels: {
                            display: true,
                            align: 'top',
                            anchor: 'end',
                            offset: 4,
                            color: '#333333',
                            font: {
                                weight: 'bold',
                                size: 11
                            },
                            formatter: function(value) {
                                return value.toLocaleString('id-ID');
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Grafik Member
            new Chart(document.getElementById('chartMember'), {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Member Baru',
                        data: data.member,
                        borderColor: '#17a2b8',
                        backgroundColor: 'rgba(23,162,184,0.15)',
                        borderWidth: 3,
                        pointRadius: 5,
                        pointHoverRadius: 8,
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            top: 25
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                font: {
                                    size: 14
                                }
                            }
                        },
                        datalabels: {
                            display: true,
                            align: 'top',
                            anchor: 'end',
                            offset: 4,
                            color: '#333333',
                            font: {
                                weight: 'bold',
                                size: 11
                            },
                            formatter: function(value) {
                                return value.toLocaleString('id-ID');
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        })
        .catch(err => {
            console.error(err);
            alert('Gagal memuat grafik. Silakan refresh halaman.');
        });
</script>