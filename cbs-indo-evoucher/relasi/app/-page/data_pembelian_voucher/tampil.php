<body>
    <!-- <a href="<?php index(); ?>?input=tambah">
        <?php btn_tambah('Tambah Data'); ?>
    </a> -->

    <a target="blank"
        href="cetak.php?berdasarkan=data_penjualan_voucher&jenis=xls&pakaiperperiode=<?php echo $status_pakaiperperiode; ?>">
        <?php btn_export('Export Excel'); ?>
    </a>

    <a target="blank"
        href="cetak.php?berdasarkan=data_penjualan_voucher&jenis=print&pakaiperperiode=<?php echo $status_pakaiperperiode; ?>">
        <?php btn_cetak('Cetak'); ?>
    </a>

    <a href="<?php index(); ?>">
        <?php btn_refresh('Refresh Data'); ?>
    </a>

    <br><br>

    <form name="formcari" id="formcari" action="" method="get">
        <fieldset>
            <table style="width: 50%;">
                <tbody>
                    <tr>
                        <td>Berdasarkan</td>
                        <td>:</td>
                        <td>
                            <!-- <input value="" name="Berdasarkan" id="Berdasarkan" > -->
                            <select class="form-control selectpicker" data-live-search="true" name="Berdasarkan"
                                id="Berdasarkan">
                                <?php
                                $sql = "desc data_penjualan_voucher";
                                $result = @mysql_query($sql);
                                while ($row = @mysql_fetch_array($result)) {
                                    $berdasarkan = isset($_GET['Berdasarkan']) ? $_GET['Berdasarkan'] : '';
                                    $selected = $berdasarkan == $row[0] ? 'selected' : '';
                                    echo "<option name='berdasarkan' $selected value=$row[0]>$row[0]</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <?php

                    (new PencarianBuilder())
                        ->add('id_relasi', 'SELECT * FROM data_relasi', 'nama')
                        ->add('id_spbu', 'SELECT * FROM data_spbu', 'nama_spbu')
                        ->value(isset($_GET['Berdasarkan']) ? $_GET['Berdasarkan'] : '', isset($_GET['isi']) ? $_GET['isi'] : '')
                        ->render();

                    ?>

                </tbody>
            </table>
        </fieldset>
    </form>

    <div class="table-responsive mt-4">
        <table <?php tabel(100, '%', 1, 'left'); ?>>
            <tr <?php tabel_head_tr() ?>>
                <th>Action</th>
                <th>No</th>
                <!--h <th>Id Penjualan </th> h-->
                <th align="center" class="th_border cell">Nama </th>
                <th align="center" class="th_border cell">Tanggal Penjualan </th>
                <th align="center" class="th_border cell">Jumlah Voucher </th>
                <th align="center" class="th_border cell">Nominal </th>
                <th align="center" class="th_border cell">Password Voucher </th>
                <th align="center" class="th_border cell">Tanggal Dibuka </th>
                <th align="center" class="th_border cell">Sub Total </th>
                <th align="center" class="th_border cell">Persentase Ppn </th>
                <th align="center" class="th_border cell">Ppn </th>
                <th align="center" class="th_border cell">Total Bayar </th>

            </tr>

            <tbody>
                <?php
                $no = 0;
                $startRow = ($page - 1) * $dataPerPage;
                $no = $startRow;

                $sort = "ORDER BY id_penjualan DESC";

                if (isset($_GET['Berdasarkan']) && !empty($_GET['Berdasarkan']) && isset($_GET['isi']) && !empty($_GET['isi'])) {
                    $berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
                    $isi = mysql_real_escape_string($_GET['isi']);
                    $querytabel = "SELECT * FROM data_penjualan_voucher where $berdasarkan like '%$isi%' $sort LIMIT $startRow ,$dataPerPage";
                    $querypagination = "SELECT COUNT(*) AS total FROM data_penjualan_voucher where $berdasarkan like '%$isi%'";
                } else {
                    $querytabel = "SELECT * FROM data_penjualan_voucher  $sort LIMIT $startRow ,$dataPerPage";
                    $querypagination = "SELECT COUNT(*) AS total FROM data_penjualan_voucher";
                }
                $proses = mysql_query($querytabel);
                while ($data = mysql_fetch_array($proses)) {
                ?>
                    <tr class="event2">

                        <td class="th_border cell" align="center" width="200">
                            <table border="0">
                                <tr>
                                    <td>
                                        <a
                                            href="<?php index(); ?>?input=detail&proses=<?= encrypt($data['id_penjualan']); ?>">
                                            <?php btn_detail('Detail'); ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a
                                            href="<?php index(); ?>?input=edit&proses=<?= encrypt($data['id_penjualan']); ?>">
                                            <?php btn_edit('Edit'); ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a
                                            href="<?php index(); ?>?input=hapus&proses=<?= encrypt($data['id_penjualan']); ?>">
                                            <?php btn_hapus('Hapus'); ?>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>

                        <td align="center" width="50"><?php $no = (($no + 1));
                                                        echo $no; ?></td>
                        <!--h <td align="center"><?php echo $data['id_penjualan']; ?></td> h-->
                        <td align="center">
                            <?php echo baca_database("", "nama", "select * from data_relasi where id_relasi='$data[id_relasi]'") ?>
                        </td>
                        <td align="center"><?php echo $data['tanggal_penjualan']; ?></td>
                        <td align="center"><?php echo $data['jumlah_voucher']; ?></td>
                        <td align="center"><?php echo rupiah($data['nominal']); ?></td>
                        <td align="center"><?php echo $data['password_voucher']; ?></td>
                        <td align="center"><?php echo $data['tanggal_dibuka']; ?></td>
                        <td align="center"><?php echo rupiah($data['sub_total']); ?></td>
                        <td align="center"><?php echo $data['persentase_ppn']; ?></td>
                        <td align="center"><?php echo rupiah($data['ppn']); ?></td>
                        <td align="center"><?php echo rupiah($data['total_bayar']); ?></td>


                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php Pagination($page, $dataPerPage, $querypagination); ?>

</body>