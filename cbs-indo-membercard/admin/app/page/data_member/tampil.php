<div class="card-group-title">
    <div class="title-left">
        <img src="../../../data/tmp/membercard/files/icon/member2.png" width="40px">
        <p>Data Member</p>
    </div>
    <div class="title-right">
        <a onclick="pencarian('data_member')">
            <?php btn_cari('Pencarian'); ?>
        </a>
        <a onclick="filter_bulan_tahun('data_member','spbu')">
            <?php btn_filter('Filter SPBU'); ?>
        </a>

    </div>
</div>
<div class="scroll-container">
    <table <?php tabel(100, '%', 1, 'left'); ?>>
        <tr>
            <!-- <th>Action</th> -->
            <th>No</th>
            <th align="center" style="min-width: 219px;" class="th_border cell">Nama Member</th>
            <th align="center" style="min-width: 139px;" class="th_border cell">Point</th>
            <th align="center" class="th_border cell">Nominal&nbsp;Transaksi Terakhir</th>
            <th align="center" class="th_border cell">Jenis Kendaraan</th>
            <th align="center" class="th_border cell">Alamat</th>
            <th align="center" class="th_border cell">No telepon</th>
            <th align="center" class="th_border cell">Jenis kelamin</th>
            <th align="center" class="th_border cell">Tanggal terdaftar</th>
            <th align="center" class="th_border cell">Kode rfid</th>
            <th align="center" class="th_border cell">Tanggal lahir</th>
            <th align="center" class="th_border cell">Agama</th>
            <th align="center" class="th_border cell">Pekerjaan</th>
            <th align="center" class="th_border cell">Nama SPBU</th>
            <th align="center" class="th_border cell">Informasi Member</th>
            <th align="center" class="th_border cell">Tanggal&nbsp;Transaksi Terakhir</th>
            <th align="center" class="th_border cell">Status</th>
        </tr>
        <tbody>
            <?php
            $no = 0;
            $startRow = ($page - 1) * $dataPerPage;
            $no = $startRow;

            $where = "1=1"; // Mulai dengan kondisi dasar

            if (isset($_GET['Berdasarkan']) && !empty($_GET['Berdasarkan']) && isset($_GET['isi']) && !empty($_GET['isi'])) {
                $berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
                $isi = mysql_real_escape_string($_GET['isi']);
                if ($berdasarkan == 'id_admin') {
                    $isi = baca_database('data_admin', 'id_admin', "select id_admin from data_admin where nama_spbu = '$isi'");
                }
                $where .= " AND $berdasarkan like '%$isi%'";
            }

            // Kondisi hardcode SPBU dihapus agar member dengan SPBU kosong tetap tampil

            // Tambahkan filter SPBU jika ada
            if (isset($_GET['spbu']) && $_GET['spbu'] != 'All' && !empty($_GET['spbu'])) {
                $spbu_filter = mysql_real_escape_string($_GET['spbu']);
                if (preg_match('/^([\d\.]+)/', $spbu_filter, $matches)) {
                    $spbu_filter = $matches[1];
                }
                $where .= " AND spbu LIKE '$spbu_filter%'";
            }

            // Tambahkan filter bulan dan tahun pada tanggal_terdaftar
            if (isset($_GET['bulan']) && !empty($_GET['bulan'])) {
                $bulan = (int)$_GET['bulan'];
                $where .= " AND MONTH(tanggal_terdaftar) = $bulan";
            }
            if (isset($_GET['tahun']) && !empty($_GET['tahun'])) {
                $tahun = (int)$_GET['tahun'];
                $where .= " AND YEAR(tanggal_terdaftar) = $tahun";
            }

            $querytabel = "SELECT * FROM data_member WHERE $where LIMIT $startRow, $dataPerPage";
            $querypagination = "SELECT COUNT(*) AS total FROM data_member WHERE $where";

            $proses = mysql_query($querytabel);
            while ($data = mysql_fetch_array($proses)) {
                $id_member = $data['id_member']; ?>
                <tr class="event2">
                    <td align="center" width="50"><?php $no = (($no + 1));
                                                    echo $no; ?></td>
                    <td align="left"><b><a style="color:#09090b" href="<?php index(); ?>?input=detail&proses=<?= encrypt($data['id_member']); ?>"><i class="fa fa-user"></i> <?php echo str_replace(" ", " ", $data['nama']); ?></a></b></td>
                    <td align="left"> <b><?php echo number_format($data['point']); ?> Point</b>
                        <br>
                        <?php $update = baca_database('', 'update_point', "select * from data_persetujuan_point where id_member='$id_member' and status='menunggu_persetujuan'");
                        if ($update == "") {
                        } else { ?>
                            Menunggu Persetujuan Update <br>
                            <b>
                                <?php echo baca_database('', 'update_point', "select * from data_persetujuan_point where id_member='$id_member' and status='menunggu_persetujuan'"); ?> Point
                            <?php } ?></b>
                    </td>
                    <td align="left">
                        <?php $jml = (baca_database("", "jumlah", "select * from data_transaksi where id_member ='$data[id_member]' order by tanggal desc limit 0,1")) ?>
                        <?php $kategori_jumlah = baca_database("", "kategori_jumlah", " select * from data_transaksi where id_member ='$data[id_member]' order by tanggal desc limit 0,1");
                        if ($kategori_jumlah == "rupiah") {
                            rupiah($jml);
                        } else {
                            echo number_format($jml);
                        }
                        ?>
                    </td>
                    <td align="center">
                        <b>
                            <?php echo baca_database("", "kategori_member", " select * from data_kategori_member where id_kategori_member ='$data[id_kategori_member]'") ?>
                        </b>
                    </td>
                    <td align="left"><?php echo ($data['alamat']); ?></td>
                    <td align="left"> <a style="color:black"
                            href="https://api.whatsapp.com/send?phone=<?php echo ($data['no_telepon']); ?>"><?php echo ($data['no_telepon']); ?> </a>
                    </td>
                    <td align="left"><?php echo ($data['jenis_kelamin']); ?></td>
                    <td align="left"><?php echo (format_indo($data['tanggal_terdaftar'])); ?></td>
                    <td align="left"><?php echo ($data['kode_rfid']); ?></td>
                    <td align="left"><?php echo (format_indo($data['tanggal_lahir'])); ?></td>
                    <td align="left"><?php echo ($data['agama']); ?></td>
                    <td align="left"><?php echo ($data['id_pekerjaan']); ?></td>
                    <td align="left">
                        <?php
                        $spbu = trim($data['spbu']);
                        if ($spbu !== '') {
                            $spbu_code = $spbu;
                            if (preg_match('/^([\d\.]+)/', $spbu, $matches)) {
                                $spbu_code = $matches[1];
                            }
                            echo htmlspecialchars($spbu_code);
                        } else {
                            echo "SPBU tidak dipilih";
                        }
                        ?>
                    </td>
                    <td align="left">
                        <?php
                        $tanggal_terdaftar = $data['tanggal_terdaftar'];
                        $endDate = date('Y-m-d', strtotime('+1 month', strtotime($tanggal_terdaftar)));
                        if (date('Y-m-d') >= $endDate) {
                            echo "Member Lama";
                        } else {
                            echo "Member Baru";
                        }
                        ?></td>
                    <td align="left"><?php $last = baca_database("", "tanggal", "SELECT tanggal FROM data_transaksi WHERE id_member = '$id_member' ORDER BY tanggal DESC, jam DESC LIMIT 1");

                                        if ($last == "") {
                                            echo "-";
                                        } else {
                                            echo format_indo($last);
                                        }
                                        ?></td>

                    <td align="left">
                        <?php

                        $endDate = date('Y-m-d', strtotime('+3 month', strtotime($last)));
                        if (date('Y-m-d') >= $endDate) {
                            echo "Tidak Aktif";
                        } else {
                            echo "Aktif";
                        }
                        ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php Pagination($page, $dataPerPage, $querypagination); ?>



<!-- ========================================== -->
<!-- MODAL PENCARIAN (Dengan Style Modern)     -->
<!-- ========================================== -->
<div id="modal_pencarian" class="modal-overlay">
    <div class="modal-card">
        <div class="modal-header">
            Pencarian Member
            <span class="close-btn" onclick="document.getElementById('modal_pencarian').style.display='none'">×</span>
        </div>
        <div class="modal-body">
            <form method="GET" action="">
                <div class="form-group">
                    <label>Berdasarkan Kolom</label>
                    <select name="Berdasarkan" class="form-control" required>
                        <?php
                        $columns = mysql_query("SHOW COLUMNS FROM data_member");
                        while ($col = mysql_fetch_array($columns)) {
                            $selected = (isset($_GET['Berdasarkan']) && $_GET['Berdasarkan'] == $col['Field']) ? 'selected' : '';
                            echo "<option value='{$col['Field']}' $selected>{$col['Field']}</option>";
                        }
                        ?>
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

<!-- ========================================== -->
<!-- MODAL FILTER SPBU + BULAN/TAHUN           -->
<!-- ========================================== -->
<div id="modal_filter" class="modal-overlay">
    <div class="modal-card">
        <div class="modal-header">
            Filter Data Member
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
                    <label>Bulan Terdaftar</label>
                    <select name="bulan" class="form-control">
                        <option value="">Semua Bulan</option>
                        <?php
                        $namaBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                        for ($b = 1; $b <= 12; $b++) {
                            $sel = (isset($_GET['bulan']) && $_GET['bulan'] == $b) ? 'selected' : '';
                            echo "<option value='$b' $sel>" . $namaBulan[$b - 1] . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Tahun Terdaftar</label>
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

<!-- JavaScript untuk Fungsi Dinamis -->
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
</body>