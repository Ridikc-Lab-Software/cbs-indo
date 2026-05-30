<div class="card-group-title">
    <div class="title-left">
        <img src="../../../data/tmp/membercard/files/icon/transaksi.png" width="40px">
        <p>Data Transaksi</p>
    </div>
    <div class="title-right">

        <a href="<?php index(); ?>?input=tambah">
            <?php btn_tambah('Transaksi Manual'); ?>
        </a>
        &nbsp;
        <a onclick="pencarian('data_transaksi')">
            <?php btn_cari('Pencarian'); ?>
        </a>
        &nbsp; <a onclick="filter_bulan_tahun('data_transaksi','tanggal')">
            <?php btn_filter('Filter SPBU'); ?>
        </a>
    </div>
</div>


<div class="scroll-container">
    <table <?php tabel(100, '%', 1, 'left'); ?>>
        <tr>
            <th>No</th>
            <th align="center" style="min-width: 219px;" class="th_border cell">Kode Transaksi</th>
            <th align="center" style="min-width: 139px;" class="th_border cell">Nama</th>
            <th align="center" class="th_border cell">Point</th>
            <th align="center" class="th_border cell">Jumlah</th>
            <th align="center" class="th_border cell">Jenis Kendaraan</th>
            <th align="center" class="th_border cell">Jenis Transaksi</th>
            <th align="center" class="th_border cell">Tanggal</th>
            <th align="center" class="th_border cell">Transaksi Terakhir</th>
            <th align="center" class="th_border cell">Jam</th>
            <th align="center" class="th_border cell">Operator</th>
            <th align="center" class="th_border cell">Nama SPBU</th>
            <th align="center" class="th_border cell">Informasi Member</th>
        </tr>
        <tbody>
            <?php
            $no = 0;
            $startRow = ($page - 1) * $dataPerPage;
            $no = $startRow;

            // ==== MULAI BUILD WHERE CLAUSE ====
            $where = "1=1";

            // Pencarian
            if (isset($_GET['Berdasarkan']) && !empty($_GET['Berdasarkan']) && isset($_GET['isi']) && !empty($_GET['isi'])) {
                $berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
                $isi = mysql_real_escape_string($_GET['isi']);

                // Khusus pencarian nama_spbu (join dengan data_petugas)
                if ($berdasarkan == 'nama_spbu') {
                    $where .= " AND EXISTS (
                        SELECT 1 FROM data_petugas 
                        WHERE data_petugas.id_petugas = data_transaksi.id_petugas 
                        AND data_petugas.nama_spbu LIKE '%$isi%'
                    )";
                } else {
                    $where .= " AND $berdasarkan LIKE '%$isi%'";
                }
            }

            // Filter SPBU
            if (isset($_GET['spbu']) && $_GET['spbu'] != '' && $_GET['spbu'] != 'All') {
                $spbu_filter = mysql_real_escape_string($_GET['spbu']);
                if (preg_match('/^([\d\.]+)/', $spbu_filter, $matches)) {
                    $spbu_filter = $matches[1];
                }
                $where .= " AND EXISTS (
                    SELECT 1 FROM data_petugas 
                    WHERE data_petugas.id_petugas = data_transaksi.id_petugas 
                    AND data_petugas.nama_spbu LIKE '$spbu_filter%'
                )";
            }

            // Filter Bulan & Tahun Transaksi (kolom tanggal)
            if (isset($_GET['bulan']) && !empty($_GET['bulan'])) {
                $bulan = (int) $_GET['bulan'];
                $where .= " AND MONTH(tanggal) = $bulan";
            }
            if (isset($_GET['tahun']) && !empty($_GET['tahun'])) {
                $tahun = (int) $_GET['tahun'];
                $where .= " AND YEAR(tanggal) = $tahun";
            }

            // Query utama
            $querytabel = "SELECT data_transaksi.* FROM data_transaksi 
                           WHERE $where 
                           ORDER BY tanggal DESC, jam DESC 
                           LIMIT $startRow, $dataPerPage";

            $querypagination = "SELECT COUNT(*) AS total FROM data_transaksi WHERE $where";

            $proses = mysql_query($querytabel);
            while ($data = mysql_fetch_array($proses)) {
                $id_member = $data['id_member'];
                ?>
                <tr class="event2">
                    <td align="center" width="50"><?php echo ++$no; ?></td>
                    <td align="left"><b>
                            <a style="color:#09090b"
                                href="<?php index(); ?>?input=detail&proses=<?= encrypt($data['id_transaksi']); ?>">
                                <i class="fas fa-book"></i> <?php echo $data['id_transaksi']; ?>
                            </a>
                        </b></td>
                    <td align="left">
                        <?php
                        $nama = baca_database("", "nama", "SELECT nama FROM data_member WHERE id_member = '$id_member'");
                        echo $nama ? htmlspecialchars($nama) : "-";
                        ?>
                    </td>
                    <td align="center"><?php echo number_format($data['point']); ?></td>
                    <td align="left">
                        <?php
                        if ($data['kategori_jumlah'] == "rupiah") {
                            echo rupiah($data['jumlah']);
                        } else {
                            echo number_format($data['jumlah']) . " " . $data['kategori_jumlah'];
                        }
                        ?>
                    </td>
                    <td align="center"><?php echo $data['id_kategori_member']; ?></td>
                    <td align="left"><?php echo $data['id_jenis_transaksi']; ?></td>
                    <td align="left"><?php echo format_indo($data['tanggal']); ?></td>
                    <td align="left">
                        <?php
                        $last = baca_database("", "tanggal", "SELECT tanggal FROM data_transaksi WHERE id_member = '$id_member' ORDER BY tanggal DESC, jam DESC LIMIT 1");
                        echo $last ? format_indo($last) : "-";
                        ?>
                    </td>
                    <td align="left"><?php echo $data['jam']; ?></td>
                    <td align="center">
                        <?php echo baca_database("", "nama", "SELECT nama FROM data_petugas WHERE id_petugas = '{$data['id_petugas']}'"); ?>
                    </td>
                    <td align="center">
                        <?php
                        $spbu = baca_database("data_petugas", "nama_spbu", "SELECT nama_spbu FROM data_petugas WHERE id_petugas = '{$data['id_petugas']}'");
                        if ($spbu) {
                            $spbu_code = $spbu;
                            if (preg_match('/^([\d\.]+)/', $spbu, $matches)) {
                                $spbu_code = $matches[1];
                            }
                            echo "<a href='?spbu=" . urlencode($spbu_code) . "'>" . htmlspecialchars($spbu_code) . "</a>";
                        } else {
                            echo "-";
                        }
                        ?>
                    </td>
                    <td align="center">
                        <?php
                        $tgl_daftar = baca_database("", "tanggal_terdaftar", "SELECT tanggal_terdaftar FROM data_member WHERE id_member = '$id_member'");
                        if ($tgl_daftar) {
                            $endDate = date('Y-m-d', strtotime($tgl_daftar . ' +3 month'));
                            echo (date('Y-m-d') >= $endDate) ? "Member<br>Lama" : "Member<br>Baru";
                        } else {
                            echo "-";
                        }
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php Pagination($page, $dataPerPage, $querypagination); ?>


<!-- MODAL PENCARIAN TRANSAKSI -->
<div id="modal_pencarian" class="modal-overlay">
    <div class="modal-card">
        <div class="modal-header">
            Pencarian Transaksi
            <span class="close-btn" onclick="document.getElementById('modal_pencarian').style.display='none'">×</span>
        </div>
        <div class="modal-body">
            <form method="GET" action="">
                <div class="form-group">
                    <label>Berdasarkan Kolom</label>
                    <select name="Berdasarkan" class="form-control" required>
                        <?php
                        $columns = mysql_query("SHOW COLUMNS FROM data_transaksi");
                        while ($col = mysql_fetch_array($columns)) {
                            $selected = (isset($_GET['Berdasarkan']) && $_GET['Berdasarkan'] == $col['Field']) ? 'selected' : '';
                            echo "<option value='{$col['Field']}' $selected>{$col['Field']}</option>";
                        }
                        ?>
                        <option value="nama_spbu" <?php echo (isset($_GET['Berdasarkan']) && $_GET['Berdasarkan'] == 'nama_spbu') ? 'selected' : ''; ?>>nama_spbu</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Kata Kunci</label>
                    <input type="text" name="isi" class="form-control" placeholder="Masukkan kata kunci..."
                        value="<?php echo isset($_GET['isi']) ? htmlspecialchars($_GET['isi']) : ''; ?>" required>
                </div>
                <div style="text-align: right; margin-top: 10px;">
                    <button type="submit" class="btn btn-success">Cari</button>
                    <button type="button" class="btn btn-secondary"
                        onclick="document.getElementById('modal_pencarian').style.display='none'">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL FILTER TRANSAKSI -->
<div id="modal_filter" class="modal-overlay">
    <div class="modal-card">
        <div class="modal-header">
            Filter Data Transaksi
            <span class="close-btn" onclick="document.getElementById('modal_filter').style.display='none'">×</span>
        </div>
        <div class="modal-body">
            <form method="GET" action="">
                <div class="form-group">
                    <label>Nama SPBU</label>
                    <select name="spbu" class="form-control">
                        <option value="All">Semua SPBU</option>
                        <?php
                        $spbus_list = ['24.373.27', '24.373.32'];
                        foreach ($spbus_list as $code) {
                            $selected = (isset($_GET['spbu']) && (strpos($_GET['spbu'], $code) === 0 || strpos($code, $_GET['spbu']) === 0)) ? 'selected' : '';
                            echo "<option value='$code' $selected>$code</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Bulan Transaksi</label>
                    <select name="bulan" class="form-control">
                        <option value="">Semua Bulan</option>
                        <?php
                        $namaBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                        for ($b = 1; $b <= 12; $b++) {
                            $sel = (isset($_GET['bulan']) && $_GET['bulan'] == $b) ? 'selected' : '';
                            echo "<option value='$b' $sel>{$namaBulan[$b - 1]}</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Tahun Transaksi</label>
                    <select name="tahun" class="form-control">
                        <option value="">Semua Tahun</option>
                        <?php
                        $cur_year = date('Y');
                        for ($y = $cur_year - 5; $y <= $cur_year + 1; $y++) {
                            $sel = (isset($_GET['tahun']) && $_GET['tahun'] == $y) ? 'selected' : '';
                            echo "<option value='$y' $sel>$y</option>";
                        }
                        ?>
                    </select>
                </div>

                <div style="text-align: right; margin-top: 15px;">
                    <button type="submit" class="btn btn-success">Terapkan Filter</button>
                    <button type="button" class="btn btn-secondary"
                        onclick="document.getElementById('modal_filter').style.display='none'">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    function pencarian(tabel) {
        // Fungsi dinamis untuk pencarian, bisa di-reuse dengan mengganti tabel di SHOW COLUMNS jika di halaman lain
        document.getElementById('modal_pencarian').style.display = 'flex';
    }

    function filter_bulan_tahun(tabel, kolom) {
        // Fungsi dinamis untuk filter, kolom bisa diubah untuk filter kolom lain, tapi disini hardcode untuk spbu dan tanggal_terdaftar
        // Untuk reuse di tabel lain, ubah query DISTINCT dan MONTH/YEAR ke kolom yang sesuai
        document.getElementById('modal_filter').style.display = 'flex';
    }
</script>