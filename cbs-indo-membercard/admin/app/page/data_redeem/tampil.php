<div class="card-group-title">
    <div class="title-left">
        <img src="../../../data/tmp/membercard/files/icon/redeem.png" width="40px">
        <p>Data Redeem</p>
    </div>
    <div class="title-right">
        <a onclick="pencarian('data_redeem')">
            <?php btn_cari('Pencarian'); ?>
        </a>
        <a onclick="filter_bulan_tahun('data_redeem','redeem')">
            <?php btn_filter('Filter SPBU'); ?>
        </a>
    </div>
</div>

<div class="scroll-container">
    <table <?php tabel(100, '%', 1, 'left'); ?>>
        <tr>
            <th>No</th>
            <th align="center" style="min-width: 219px;" class="th_border cell">Kode Redeem</th>
            <th align="center" style="min-width: 139px;" class="th_border cell">Member</th>
            <th align="center" class="th_border cell">Mitra</th>
            <th align="center" class="th_border cell">Promo</th>
            <th align="center" class="th_border cell">Tanggal</th>
            <th align="center" class="th_border cell">Jam</th>
            <th align="center" class="th_border cell">Jumlah</th>
            <th align="center" class="th_border cell">Point</th>
            <th align="center" class="th_border cell">Value</th>
            <th align="center" class="th_border cell">Nama SPBU</th>
        </tr>
        <tbody>
            <?php
            $no = 0;
            $startRow = ($page - 1) * $dataPerPage;
            $no = $startRow;

            // ==== BUILD WHERE CLAUSE ====
            $where = "1=1";

            // Pencarian
            if (isset($_GET['Berdasarkan']) && !empty($_GET['Berdasarkan']) && isset($_GET['isi']) && !empty($_GET['isi'])) {
                $berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
                $isi = mysql_real_escape_string($_GET['isi']);

                if ($berdasarkan == 'nama_spbu') {
                    $where .= " AND EXISTS (
                        SELECT 1 FROM data_petugas 
                        WHERE data_petugas.id_petugas = data_redeem.id_petugas 
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
                    WHERE data_petugas.id_petugas = data_redeem.id_petugas 
                    AND data_petugas.nama_spbu LIKE '$spbu_filter%'
                )";
            }

            // Filter Bulan & Tahun (berdasarkan tanggal redeem)
            if (isset($_GET['bulan']) && !empty($_GET['bulan'])) {
                $bulan = (int)$_GET['bulan'];
                $where .= " AND MONTH(tanggal) = $bulan";
            }
            if (isset($_GET['tahun']) && !empty($_GET['tahun'])) {
                $tahun = (int)$_GET['tahun'];
                $where .= " AND YEAR(tanggal) = $tahun";
            }

            // Query utama
            $querytabel = "SELECT data_redeem.* FROM data_redeem 
                           WHERE $where 
                           ORDER BY tanggal DESC, jam DESC 
                           LIMIT $startRow, $dataPerPage";

            $querypagination = "SELECT COUNT(*) AS total FROM data_redeem WHERE $where";

            $proses = mysql_query($querytabel);
            while ($data = mysql_fetch_array($proses)) {
                $id_member = $data['id_member'];
            ?>
                <tr class="event2">
                    <td align="center" width="50"><?php echo ++$no; ?></td>
                    <td align="left"><b>
                            <a style="color:#09090b" href="<?php index(); ?>?input=detail&proses=<?= encrypt($data['id_redeem']); ?>">
                                <i class="fas fa-star"></i> <?php echo $data['id_redeem']; ?>
                            </a>
                        </b></td>
                    <td align="left">
                        <?php
                        $nama_member = baca_database("", "nama", "SELECT nama FROM data_member WHERE id_member = '$id_member'");
                        if ($nama_member) {
                            echo '<a href="../data_member/index.php?input=detail&proses=' . encrypt($id_member) . '">' . htmlspecialchars($nama_member) . '</a>';
                        } else {
                            echo "-";
                        }
                        ?>
                    </td>
                    <td align="center">
                        <?php echo baca_database("", "nama_mitra", "SELECT nama_mitra FROM data_mitra WHERE id_mitra = '{$data['id_mitra']}'"); ?>
                    </td>
                    <td align="left">
                        <?php echo baca_database("", "nama_promo", "SELECT nama_promo FROM data_promo WHERE id_promo = '{$data['id_promo']}'"); ?>
                    </td>
                    <td align="left"><?php echo format_indo($data['tanggal']); ?></td>
                    <td align="left"><?php echo $data['jam']; ?></td>
                    <td align="center"><?php echo number_format($data['jumlah']); ?></td>
                    <td align="center"><b><?php echo number_format($data['jumlah'] * $data['point']); ?> Point</b></td>
                    <td align="left"><b><?php echo rupiah($data['jumlah'] * $data['value_redeem']); ?></b></td>
                    <td align="center">
                        <?php
                        $spbu = baca_database("data_petugas", "nama_spbu", "SELECT nama_spbu FROM data_petugas WHERE id_petugas = '{$data['id_petugas']}'");
                        if ($spbu) {
                            $spbu_code = $spbu;
                            if (preg_match('/^([\d\.]+)/', $spbu, $matches)) {
                                $spbu_code = $matches[1];
                            }
                            echo '<a href="?spbu=' . urlencode($spbu_code) . '">' . htmlspecialchars($spbu_code) . '</a>';
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


<!-- MODAL PENCARIAN REDEEM -->
<div id="modal_pencarian" class="modal-overlay">
    <div class="modal-card">
        <div class="modal-header">
            Pencarian Redeem
            <span class="close-btn" onclick="document.getElementById('modal_pencarian').style.display='none'">×</span>
        </div>
        <div class="modal-body">
            <form method="GET" action="">
                <div class="form-group">
                    <label>Berdasarkan Kolom</label>
                    <select name="Berdasarkan" class="form-control" required>
                        <?php
                        $columns = mysql_query("SHOW COLUMNS FROM data_redeem");
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
                    <button type="button" class="btn btn-secondary" onclick="document.getElementById('modal_pencarian').style.display='none'">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL FILTER REDEEM -->
<div id="modal_filter" class="modal-overlay">
    <div class="modal-card">
        <div class="modal-header">
            Filter Data Redeem
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
                    <label>Bulan Redeem</label>
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
                    <label>Tahun Redeem</label>
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
                    <button type="button" class="btn btn-secondary" onclick="document.getElementById('modal_filter').style.display='none'">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    function pencarian(tabel) {
        document.getElementById('modal_pencarian').style.display = 'flex';
    }

    function filter_bulan_tahun(tabel, jenis) {
        document.getElementById('modal_filter').style.display = 'flex';
    }
</script>