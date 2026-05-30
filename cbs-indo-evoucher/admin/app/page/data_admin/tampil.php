<body>
    <a href="<?php index(); ?>?input=tambah">
        <?php btn_tambah("Tambah"); ?>
    </a>

    <a target="blank"
        href="cetak.php?berdasarkan=data_admin&jenis=xls&pakaiperperiode=<?php echo $status_pakaiperperiode; ?>">
        <?php btn_export("Export Excel"); ?>
    </a>

    <a target="blank"
        href="cetak.php?berdasarkan=data_admin&jenis=print&pakaiperperiode=<?php echo $status_pakaiperperiode; ?>">
        <?php btn_cetak("Cetak"); ?>
    </a>

    <a href="<?php index(); ?>">
        <?php btn_refresh("Refresh"); ?>
    </a>

    <br><br>



    <div style="overflow-x:auto;">
        <table <?php tabel(100, "%", 1, "left"); ?>>
            <tr>
                <!-- <th>Action</th> -->
                <th>&nbsp;No</th>
                <!--h <th>Id admin</th> -->
                <th align="left" class="th_border cell">Hak akses</th>
                <th align="left" class="th_border cell">Username</th>
                <th align="left" class="th_border cell">Password</th>
                <th align="left" class="th_border cell">Nama spbu</th>
                <th align="left" class="th_border cell">Nama</th>
                <th align="left" class="th_border cell">Jabatan</th>
                <th align="left" class="th_border cell">Foto tanda tangan</th>
            </tr>

            <tbody>
                <?php
                $no = 0;
                $startRow = ($page - 1) * $dataPerPage;
                $no = $startRow;

                if (
                    isset($_GET["Berdasarkan"]) &&
                    !empty($_GET["Berdasarkan"]) &&
                    isset($_GET["isi"]) &&
                    !empty($_GET["isi"])
                ) {
                    $berdasarkan = mysql_real_escape_string(
                        $_GET["Berdasarkan"]
                    );
                    $isi = mysql_real_escape_string($_GET["isi"]);
                    $querytabel = "SELECT * FROM data_admin where $berdasarkan like '%$isi%'  LIMIT $startRow ,$dataPerPage";
                    $querypagination = "SELECT COUNT(*) AS total FROM data_admin where $berdasarkan like '%$isi%'";
                } else {
                    $querytabel = "SELECT * FROM data_admin ";
                    $querypagination =
                        "SELECT COUNT(*) AS total FROM data_admin";
                }
                $proses = mysql_query($querytabel);
                while ($data = mysql_fetch_array($proses)) { ?>
                    <tr class="event2">

                        <td class="th_border cell" align="center" width="200">

                            <table style="border-collapse: collapse; border: none;">
                                <tr>

                                    <td style="padding: 2px; border: none;">
                                        <a href="<?php index(); ?>?input=edit&proses=<?= encrypt($data["id_admin"]) ?>">
                                            <?php btn_edit("Edit"); ?>
                                        </a>
                                    </td>
                                    <td style="padding: 2px; border: none;">
                                        <a href="<?php index(); ?>?input=hapus&proses=<?= encrypt($data["id_admin"]) ?>">
                                            <?php btn_hapus("Hapus"); ?>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td align="center" width="50"><?php $no = $no + 1;
                        echo $no; ?></td>
                        <!--h <td align="center"><?php echo $data["id_admin"]; ?></td> h-->
                        <td align="left"><?php echo $data["hak_akses"]; ?></td>
                        <td align="left"><?php echo $data["username"]; ?></td>
                        <td align="left"><?php echo $data["password"]; ?></td>
                        <td align="left"><?php echo $data["nama_spbu"]; ?></td>
                        <td align="left"><?php echo $data["nama"]; ?></td>
                        <td align="left"><?php echo $data["jabatan"]; ?></td>
                        <td align="left"><a target="_blank"
                                href="<?php echo pengaturan("url_smc"); ?>admin/upload/<?php echo $data['foto_tanda_tangan']; ?>">
                                <img width="50" height="30"
                                    src="<?php echo pengaturan("url_smc"); ?>admin/upload/<?php echo $data['foto_tanda_tangan']; ?>">
                            </a>
                        </td>
                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>

    <?php //Pagination($page, $dataPerPage, $querypagination); ?>

</body>