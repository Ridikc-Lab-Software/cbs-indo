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
                            <select class="form-control selectpicker" data-live-search="true" name="Berdasarkan" id="Berdasarkan">
                                <?php
                                $sql = "desc data_log_activity";
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
                <!--h <th>Id Log Activity </th> h-->
                <th align="center" class="th_border cell">Waktu </th>
                <th align="center" class="th_border cell">Admin </th>
                <th align="center" class="th_border cell">Kategori </th>
                <th align="center" class="th_border cell">Deskripsi </th>

            </tr>

            <tbody>
                <?php
                $no = 0;
                $startRow = ($page - 1) * $dataPerPage;
                $no = $startRow;

                if (isset($_GET['Berdasarkan']) && !empty($_GET['Berdasarkan']) && isset($_GET['isi']) && !empty($_GET['isi'])) {
                    $berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
                    $isi = mysql_real_escape_string($_GET['isi']);
                    $querytabel = "SELECT * FROM data_log_activity where $berdasarkan like '%$isi%' order by waktu desc LIMIT $startRow ,$dataPerPage";
                    $querypagination = "SELECT COUNT(*) AS total FROM data_log_activity where $berdasarkan like '%$isi%'";
                } else {
                    $querytabel = "SELECT * FROM data_log_activity order by waktu desc  LIMIT $startRow ,$dataPerPage";
                    $querypagination = "SELECT COUNT(*) AS total FROM data_log_activity";
                }
                $proses = mysql_query($querytabel);
                while ($data = mysql_fetch_array($proses)) {
                ?>
                    <tr class="event2">

                        <td class="th_border cell" align="center" width="200">
                            <table border="0">
                                <tr>
                                    <td>
                                        <a href="<?php index(); ?>?input=detail&proses=<?= encrypt($data['id_log_activity']); ?>">
                                            <?php btn_detail('Detail'); ?>
                                        </a>
                                    </td>

                                </tr>
                            </table>
                        </td>

                        <td align="center" width="50"><?php $no = (($no + 1));
                                                        echo $no; ?></td>
                        <!--h <td align="center"><?php echo $data['id_log_activity']; ?></td> h-->
                        <td align="left"><?php echo $data['waktu']; ?></td>
                        <td align="left"><?php $id_admin =  $data['id_admin'];
                                            echo baca_database("", "nama", "select * from admin where id_admin='$id_admin'")
                                            ?></td>
                        <td align="left"><?php echo $data['kategori']; ?></td>
                        <td align="left"><?php echo $data['deskripsi']; ?></td>


                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php Pagination($page, $dataPerPage, $querypagination); ?>

</body>