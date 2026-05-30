<body>

    <a href="<?php index(); ?>">
        <?php btn_refresh('Refresh Data'); ?>
    </a>

    <div class="table-responsive mt-4">
        <table <?php tabel(100, '%', 0, 'left'); ?>>
            <thead>
                <tr <?php tabel_head_tr() ?>>
                    <th>Action</th>
                    <th>No</th>
                    <!--h <th>Id Pengaturan </th> h-->
                    <th align="center" class="th_border cell">Nama </th>
                    <th align="center" class="th_border cell">Isi </th>
                    <th align="center" class="th_border cell">Status </th>

                </tr>
            </thead>
            <tbody>
                <?php
                $no = 0;

                $querytabel = "SELECT * FROM data_pengaturan_voucher  ";

                $proses = mysql_query($querytabel);
                while ($data = mysql_fetch_array($proses)) {
                ?>
                    <tr class="event2">

                        <td class="th_border cell" align="center" width="200">
                            <table border="0">
                                <tr>
                                    <td>
                                        <a href="<?php index(); ?>?input=detail&proses=<?= encrypt($data['id_pengaturan']); ?>">
                                            <?php btn_detail('Detail'); ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?php index(); ?>?input=edit&proses=<?= encrypt($data['id_pengaturan']); ?>">
                                            <?php btn_edit('Edit'); ?>
                                        </a>
                                    </td>
                                    <!-- <td>
                                        <a href="<?php index(); ?>?input=hapus&proses=<?= encrypt($data['id_pengaturan']); ?>">
                                            <?php btn_hapus('Hapus'); ?>
                                        </a>
                                    </td> -->
                                </tr>
                            </table>
                        </td>

                        <td align="center" width="50"><?php $no = (($no + 1));
                                                        echo $no; ?></td>
                        <!--h <td align="center"><?php echo $data['id_pengaturan']; ?></td> h-->
                        <td align="center"><?php echo $data['nama']; ?></td>
                        <td align="center"><?php echo $data['isi']; ?></td>
                        <td align="center"><?php echo $data['status']; ?></td>


                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php // Pagination($page, $dataPerPage, $querypagination);
    ?>

</body>