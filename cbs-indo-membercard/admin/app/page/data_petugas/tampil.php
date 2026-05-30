<body>
    <a href="<?php index(); ?>?input=tambah">
        <?php btn_tambah('Tambah'); ?>
    </a>

    <a target="blank"
        href="cetak.php?berdasarkan=data_petugas&jenis=xls&pakaiperperiode=<?php echo $status_pakaiperperiode; ?>">
        <?php btn_export('Export Excel'); ?>
    </a>

    <a target="blank"
        href="cetak.php?berdasarkan=data_petugas&jenis=print&pakaiperperiode=<?php echo $status_pakaiperperiode; ?>">
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
                        <td>Berdasarkan</td>
                        <td>:</td>
                        <td>
                            <!-- <input value="" name="Berdasarkan" id="Berdasarkan" > --> <select
                                class="form-control" data-live-search="true" name="Berdasarkan"
                                id="Berdasarkan">
                                <?php
                                $sql = "desc data_petugas";
                                $result = @mysql_query($sql);
                                while ($row = @mysql_fetch_array($result)) {
                                    if (in_array($row[0], ['nama', 'no_telepon', 'nama_spbu']))
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
                <th>Qrcode</th>
                <th align="center" class="th_border cell">Nama</th>
                <th align="center" class="th_border cell">Alamat</th>
                <th align="center" class="th_border cell">No&nbsp;telepon</th>
                <th align="center" class="th_border cell">Jenis&nbsp;kelamin</th>
                <th align="center" class="th_border cell">Username</th>
                <th align="center" class="th_border cell">Password</th>
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
                    $querytabel = "SELECT * FROM data_petugas where $berdasarkan like '%$isi%'  LIMIT $startRow ,$dataPerPage";
                    $querypagination = "SELECT COUNT(*) AS total FROM data_petugas where $berdasarkan like '%$isi%'";
                } else {
                    $querytabel = "SELECT * FROM data_petugas  LIMIT $startRow ,$dataPerPage";
                    $querypagination = "SELECT COUNT(*) AS total FROM data_petugas";
                }
                $proses = mysql_query($querytabel);
                while ($data = mysql_fetch_array($proses)) { ?>
                    <tr class="event2">
                        <td class="th_border cell" align="center" width="200">
                            <table border="0">
                                <tr>
                                    <td>
                                        <a href="<?php index(); ?>?input=detail&proses=<?= encrypt($data['id_petugas']); ?>">
                                            <?php btn_detail('Detail'); ?></a>
                                    </td>
                                    <td>
                                        <a href="<?php index(); ?>?input=edit&proses=<?= encrypt($data['id_petugas']); ?>">
                                            <?php btn_edit('Edit'); ?></a>
                                    </td>
                                    <td>
                                        <a href="<?php index(); ?>?input=hapus&proses=<?= encrypt($data['id_petugas']); ?>">
                                            <?php btn_hapus('Hapus'); ?></a>
                                    </td>

                                    <td>
                                        <a href="../data_transaksi/index.php?input=tampil&Berdasarkan=id_petugas&isi=<?= $data['id_petugas']; ?>">
                                            <button type="submit"
                                                class="btn btn-secondary">
                                                <i class="fa fa-history"></i>&nbsp;

                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td align="center" width="50"><?php $no = (($no + 1));
                                                        echo $no; ?></td>
                    <td align="center">
    <a target="_blank"
       href="print_idcard.php?id=<?= encrypt($data['id_petugas']); ?>">
        <img 
            src="https://api.qrserver.com/v1/create-qr-code/?size=30x30&data=<?= urlencode($data['id_petugas']); ?>"
            alt="QR <?= $data['id_petugas']; ?>"
        >
    </a>
</td>


                        <td align="left"><?php echo ($data['nama']); ?></td>
                        <td align="left"><?php echo ($data['alamat']); ?></td>
                        <td align="left"><?php echo ($data['no_telepon']); ?></td>
                        <td align="left"><?php echo ($data['jenis_kelamin']); ?></td>
                        <td align="left"><?php echo ($data['username']); ?></td>
                        <td align="left"><?php echo ($data['password']); ?></td>
                        <td align="left">
                            <a href="index.php?Berdasarkan=nama_spbu&isi=<?php echo ($data['nama_spbu']); ?>"><?php echo ($data['nama_spbu']); ?></a>
                        </td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php Pagination($page, $dataPerPage, $querypagination); ?>

</body>