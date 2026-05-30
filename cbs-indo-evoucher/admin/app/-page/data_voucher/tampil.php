<body>
    <a href="<?php index(); ?>?input=tambah">
        <?php btn_tambah('Tambah Data'); ?>
    </a>

    <a target="blank" href="cetak.php?berdasarkan=data_voucher&jenis=xls&pakaiperperiode=<?php echo $status_pakaiperperiode; ?>">
        <?php btn_export('Export Excel'); ?>
    </a>

    <a target="blank" href="cetak.php?berdasarkan=data_voucher&jenis=print&pakaiperperiode=<?php echo $status_pakaiperperiode; ?>">
        <?php btn_cetak('Cetak'); ?>
    </a>

    <a href="<?php index(); ?>">
        <?php btn_refresh('Refresh Data'); ?>
    </a>

    <br><br>

    <form name="formcari" id="formcari" action="" method="get">
        <fieldset>
            <table>
                <tbody>
                    <tr>
                        <td>Berdasarkan</td>
                        <td>:</td>
                        <td>
                            <!-- <input value="" name="Berdasarkan" id="Berdasarkan" > -->
                            <select class="form-control selectpicker" data-live-search="true" name="Berdasarkan" id="Berdasarkan">
                                <?php
                                $sql = "desc data_voucher";
                                $result = @mysql_query($sql);
                                while ($row = @mysql_fetch_array($result)) {
                                    echo "<option name='berdasarkan' value=$row[0]>$row[0]</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Pencarian</td>
                        <td>:</td>
                        <td>
                            <!--<input class="form-control" type="text" name="isi" value="" >--> <input type="text" name="isi" value="">
                            <?php btn_cari('Cari'); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </fieldset>
    </form>

    <div style="overflow-x:auto;">
        <table <?php tabel(100, '%', 1, 'left'); ?>>
            <tr>
                <th>Action</th>
                <th>No</th>
                <!--h <th>Id Voucher </th> h-->
                <th align="center" class="th_border cell">Qrcode </th>
                <th align="center" class="th_border cell">Nama </th>
                <th align="center" class="th_border cell">Nominal </th>
                <th align="center" class="th_border cell">Tanggal Kadaluarsa </th>
                <th align="center" class="th_border cell">Nama Spbu </th>
                <th align="center" class="th_border cell">Id Relasi </th>
                <th align="center" class="th_border cell">Status </th>
                <th align="center" class="th_border cell">File Voucher </th>
                <th align="center" class="th_border cell">Tanggal Dibuka </th>

            </tr>

            <tbody>
                <?php
                $no = 0;
                $startRow = ($page - 1) * $dataPerPage;
                $no = $startRow;

                if (isset($_GET['Berdasarkan']) && !empty($_GET['Berdasarkan']) && isset($_GET['isi']) && !empty($_GET['isi'])) {
                    $berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
                    $isi = mysql_real_escape_string($_GET['isi']);
                    $querytabel = "SELECT * FROM data_voucher where $berdasarkan like '%$isi%'  LIMIT $startRow ,$dataPerPage";
                    $querypagination = "SELECT COUNT(*) AS total FROM data_voucher where $berdasarkan like '%$isi%'";
                } else {
                    $querytabel = "SELECT * FROM data_voucher  LIMIT $startRow ,$dataPerPage";
                    $querypagination = "SELECT COUNT(*) AS total FROM data_voucher";
                }
                $proses = mysql_query($querytabel);
                while ($data = mysql_fetch_array($proses)) {
                ?>
                    <tr class="event2">

                        <td class="th_border cell" align="center" width="200">
                            <table border="0">
                                <tr>
                                    <td>
                                        <a href="<?php index(); ?>?input=detail&proses=<?= encrypt($data['id_voucher']); ?>">
                                            <?php btn_detail('Detail'); ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?php index(); ?>?input=edit&proses=<?= encrypt($data['id_voucher']); ?>">
                                            <?php btn_edit('Edit'); ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?php index(); ?>?input=hapus&proses=<?= encrypt($data['id_voucher']); ?>">
                                            <?php btn_hapus('Hapus'); ?>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>

                        <td align="center" width="50"><?php $no = (($no + 1));
                                                        echo $no; ?></td>
                        <!--h <td align="center"><?php echo $data['id_voucher']; ?></td> h-->
                        <td align="center"><?php echo $data['qrcode']; ?></td>
                        <td align="center"><?php echo baca_database("", "nama", "select * from data_relasi where id_relasi='$data[id_relasi]'")  ?></td>
                        <td align="center"><?php echo $data['nominal']; ?></td>
                        <td align="center"><?php echo $data['tanggal_kadaluarsa']; ?></td>
                        <td align="center"><?php echo baca_database("", "nama_spbu", "select * from data_spbu where id_spbu='$data[id_spbu]'")  ?></td>
                        <td align="center"><?php echo baca_database("", "id_relasi", "select * from data_penjualan_voucher where id_penjualan='$data[id_penjualan]'")  ?></td>
                        <td align="center"><?php echo $data['status']; ?></td>
                        <td align="center"><a href="../../../../admin/upload/<?php echo $data['file_voucher']; ?>"><img onerror="this.src='../../../data/image/error/file.png'" width="50" height="30" src="../../../../admin/upload/<?php echo $data['file_voucher']; ?>"></a></td>
                        <td align="center"><?php echo $data['tanggal_dibuka']; ?></td>


                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php Pagination($page, $dataPerPage, $querypagination); ?>

</body>