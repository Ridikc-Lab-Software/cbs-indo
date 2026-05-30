<body>


    <form name="formcari" id="formcari" action="" method="get">
        <fieldset>
            <table>
                <tbody>
                    <tr>
                        <td>Berdasarkan</td>
                        <td>:</td>
                        <td>
                            <!-- <input value="" name="Berdasarkan" id="Berdasarkan" > -->
                            <select class="form-control selectpicker" data-live-search="true" name="Berdasarkan"
                                id="Berdasarkan">
                                <?php
                                $sql = "desc data_tanda_tangan";
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
                            <!--<input class="form-control" type="text" name="isi" value="" >--> <input type="text"
                                name="isi" value="">
                            <?php btn_cari('Cari'); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </fieldset>
    </form>

    <div class="table-responsive mt-4">
        <table <?php tabel(100, '%', 1, 'left'); ?>>
            <tr <?php tabel_head_tr() ?>>
                <th>Action</th>
                <th>No</th>
                <!--h <th>Id Admin </th> h-->
                <th align="center" class="th_border cell">Hak Akses </th>

                <th align="center" class="th_border cell">Tanda Tangan</th>

            </tr>

            <tbody>
                <?php
                $no = 0;
                $startRow = ($page - 1) * $dataPerPage;
                $no = $startRow;

                if (isset($_GET['Berdasarkan']) && !empty($_GET['Berdasarkan']) && isset($_GET['isi']) && !empty($_GET['isi'])) {
                    $berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
                    $isi = mysql_real_escape_string($_GET['isi']);
                    $querytabel = "SELECT * FROM data_tanda_tangan where $berdasarkan like '%$isi%'  LIMIT $startRow ,$dataPerPage";
                    $querypagination = "SELECT COUNT(*) AS total FROM data_tanda_tangan where $berdasarkan like '%$isi%'";
                } else {
                    $querytabel = "SELECT * FROM data_tanda_tangan  LIMIT $startRow ,$dataPerPage";
                    $querypagination = "SELECT COUNT(*) AS total FROM data_tanda_tangan";
                }
                $proses = mysql_query($querytabel);
                while ($data = mysql_fetch_array($proses)) {
                ?>
                    <tr class="event2">

                        <td class="th_border cell" align="center" width="200">
                            <table border="0">
                                <tr>
                                    <td>
                                        <a href="<?php index(); ?>?input=edit&proses=<?= encrypt($data['id_tanda_tangan']); ?>">
                                            <?php btn_edit('Edit'); ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?php index(); ?>?input=hapus&proses=<?= encrypt($data['id_tanda_tangan']); ?>">
                                            <?php btn_hapus('Hapus'); ?>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>

                        <td align="center" width="50"><?php $no = (($no + 1));
                                                        echo $no; ?></td>
                        <!--h <td align="center"><?php echo $data['id_tanda_tangan']; ?></td> h-->
                        <td align="center"><?php echo $data['hak_akses']; ?></td>
                        <td align="center">
                            <a href="../../../upload/<?= $data['tanda_tangan']?>" target="_blank"><img src="../../../upload/<?= $data['tanda_tangan']?> " alt="" srcset="" width="120";height="90"></a></td>
                     
                        


                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php Pagination($page, $dataPerPage, $querypagination); ?>

</body>