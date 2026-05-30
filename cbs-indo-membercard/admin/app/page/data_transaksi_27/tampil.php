<body>
    <a href="<?php index(); ?>?input=tambah">
        <?php btn_tambah('Tambah'); ?>
    </a>

    <a target="blank"
        href="cetak.php?berdasarkan=data_transaksi&jenis=xls&pakaiperperiode=<?php echo $status_pakaiperperiode; ?>">
        <?php btn_export('Export Excel'); ?>
    </a>

    <a target="blank"
        href="cetak.php?berdasarkan=data_transaksi&jenis=print&pakaiperperiode=<?php echo $status_pakaiperperiode; ?>">
        <?php btn_cetak('Cetak'); ?>
    </a>

    <a href="<?php index(); ?>">
        <?php btn_refresh('Refresh'); ?>
    </a>

    <br><br>

    <form name="formcari" id="formcari" action="" method="get">
        <fieldset>
            <table>
                <tbody>

                    <tr>
                        <td>
                            Tampilkan Data Spbu
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            <a href="../data_transaksi/" class="btn btn-primary">Semua Data</a>

                            <a href="../data_transaksi_27/" class="btn btn-warning">Data SPBU
                                24.373.27</a>
                            <a href="../data_transaksi_32/" class="btn btn-primary">Data SPBU
                                24.373.32</a>
                        </td>
                    </tr>

                    <tr>
                        <td>Berdasarkan</td>
                        <td>:</td>
                        <td>
                            <!-- <input value="" name="Berdasarkan" id="Berdasarkan" > --> <select
                                class="form-control" data-live-search="true" name="Berdasarkan"
                                id="Berdasarkan">
                                <?php
                                $sql = "desc data_transaksi";
                                $result = @mysql_query($sql);
                                while ($row = @mysql_fetch_array($result)) {


                                    echo "<option name='berdasarkan' value=$row[0]>$row[0]</option>";
                                }
                                echo "<option name='berdasarkan' value=nama_spbu>nama_spbu</option>";
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Pencarian</td>
                        <td>:</td>
                        <td>
                            <!--<input class="form-control" type="text" name="isi" value="" >--> <input type="text" name="isi"
                                value="" class="form-control">
                            <?php btn_cari('Cari'); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </fieldset>
    </form>

    <div class="scroll-container">
        <table <?php tabel(100, '%', 1, 'left'); ?>>
            <tr>
                <th>Action</th>
                <th>No</th>
                <th align="center" class="th_border cell">Nama</th>
                <th align="center" class="th_border cell">Point</th>
                <th align="center" class="th_border cell">Jumlah</th>
                <th align="center" class="th_border cell">Jenis Kendaraan</th>
                <th align="center" class="th_border cell">Jenis Transaksi</th>

                <th align="center" class="th_border cell">Tanggal</th>
                <th align="center" class="th_border cell">Terakhir Transaksi</th>
                <th align="center" class="th_border cell">Jam</th>

                <th align="center" class="th_border cell">Operator</th>
                <th align="center" class="th_border cell">Nama SPBU</th>


            </tr>

            <tbody>
                <?php
                $no = 0;
                $startRow = ($page - 1) * $dataPerPage;
                $no = $startRow;

                if (isset($_GET['Berdasarkan']) && !empty($_GET['Berdasarkan']) && isset($_GET['isi']) && !empty($_GET['isi'])) {
                    $berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
                    $isi = mysql_real_escape_string($_GET['isi']);
                    $querytabel = "SELECT * FROM data_transaksi where $berdasarkan like '%$isi%'  LIMIT $startRow ,$dataPerPage";

                    if ($berdasarkan == 'nama_spbu') {

                        $querytabel = "SELECT data_transaksi.* FROM data_transaksi join data_petugas on data_transaksi.id_petugas = data_petugas.id_petugas where data_petugas.nama_spbu like '%$isi%' group by data_transaksi.id_transaksi  LIMIT $startRow ,$dataPerPage";
                    }

                    $querypagination = "SELECT COUNT(*) AS total FROM data_transaksi where $berdasarkan like '%$isi%'";
                } else {
                    $querytabel = "SELECT * FROM data_transaksi";
                    $querypagination = "SELECT COUNT(*) AS total FROM data_transaksi";
                }
                $proses = mysql_query($querytabel);
                while ($data = mysql_fetch_array($proses)) {

                    $spbu = baca_database('data_petugas', 'nama_spbu', "select nama_spbu from data_petugas where id_petugas='$data[id_petugas]'");
                    if ($spbu == "24.373.27") {
                        $nama = baca_database("", "nama", " select * from data_member where id_member ='$data[id_member]'");
                        if ($nama == "") {
                        } else {
                ?>
                            <tr class="event2">
                                <td class="th_border cell" align="center" width="50">
                                    <table border="0">
                                        <tr>

                                            <td>
                                                <a href="<?php index(); ?>?input=hapus&proses=<?= encrypt($data['id_transaksi']); ?>">
                                                    <?php btn_hapus('Hapus'); ?></a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td align="center" width="50"><?php $no = (($no + 1));
                                                                echo $no; ?></td>
                                <td align="center"><?php echo baca_database("", "nama", " select * from data_member where id_member ='$data[id_member]'") ?></td>
                                <td align="center" style="color:red"><?php echo ($data['point']); ?> point</td>
                                <td align="center" style="color:blue"><?php
                                                                        if ($data['kategori_jumlah'] == "rupiah") {
                                                                            echo rupiah($data['jumlah']);
                                                                        } else {
                                                                            echo ($data['jumlah']);
                                                                            echo " " . ($data['kategori_jumlah']);
                                                                        }

                                                                        ?> </td>
                                <td align="center"><?php echo $data['id_kategori_member'] ?></td>
                                <td align="center"><?php echo $data['id_jenis_transaksi'] ?></td>

                                <td align="center"><?php echo (format_indo($data['tanggal'])); ?></td>
                                <td align="center"><?php
                                                    $id_member = $data['id_member'];
                                                    $tanggal = baca_database("", "tanggal", "select * from data_transaksi where id_member = '$id_member' order by tanggal desc limit 1");

                                                    echo (format_indo($tanggal)); ?></td>
                                <td align="center"><?php echo ($data['jam']); ?></td>

                                <td align="center"><?php echo baca_database("", "nama", " select * from data_petugas where id_petugas ='$data[id_petugas]'") ?></td>

                                <?php

                                $spbu = baca_database('data_petugas', 'nama_spbu', "select nama_spbu from data_petugas where id_petugas='$data[id_petugas]'");
                                ?>

                                <td align="center">
                                    <a href="index.php?Berdasarkan=nama_spbu&isi=<?php echo $spbu; ?>"><?php echo $spbu; ?></a>
                                </td>

                            </tr>
                <?php }
                    }
                } ?>
            </tbody>
        </table>
    </div>

    <?php //Pagination($page, $dataPerPage, $querypagination); 
    ?>

</body>