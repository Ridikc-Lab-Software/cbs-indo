<body>
    <a href="<?php index(); ?>?input=tambah">
        <?php btn_tambah("Tambah"); ?>
    </a>

    <a target="blank"
        href="cetak.php?berdasarkan=data_kategori_member&jenis=xls&pakaiperperiode=<?php echo $status_pakaiperperiode; ?>">
        <?php btn_export("Export Excel"); ?>
    </a>

    <a target="blank"
        href="cetak.php?berdasarkan=data_kategori_member&jenis=print&pakaiperperiode=<?php echo $status_pakaiperperiode; ?>">
        <?php btn_cetak("Cetak"); ?>
    </a>

    <a href="<?php index(); ?>">
        <?php btn_refresh("Refresh"); ?>
    </a>

    <br><br>


    <div style="overflow-x:auto;">
        <table <?php tabel(100, "%", 1, "left"); ?>>
            <tr>
                <th>Action</th>
                <th>No</th>
                <!--h <th>Id kategori member</th> -->
                <th align="left" class="th_border cell">Kategori member</th>
                <th align="left" class="th_border cell">Gambar logo</th>
                <th align="left" class="th_border cell">Maksimal transaksi</th>
                <th align="left" class="th_border cell">Jenis</th>
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
                    $querytabel = "SELECT * FROM data_kategori_member where $berdasarkan like '%$isi%'  LIMIT $startRow ,$dataPerPage";
                    $querypagination = "SELECT COUNT(*) AS total FROM data_kategori_member where $berdasarkan like '%$isi%'";
                } else {
                    $querytabel = "SELECT * FROM data_kategori_member  LIMIT $startRow ,$dataPerPage";
                    $querypagination =
                        "SELECT COUNT(*) AS total FROM data_kategori_member";
                }
                $proses = mysql_query($querytabel);
                while ($data = mysql_fetch_array($proses)) { ?>
                    <tr class="event2">

                        <td class="th_border cell" align="center" width="200">

                            <table style="border-collapse: collapse; border: none;">
                                <tr>
                                    <td style="padding: 2px; border: none;">
                                        <a
                                            href="<?php index(); ?>?input=detail&proses=<?= encrypt($data["id_kategori_member"]) ?>">
                                            <?php btn_detail("Detail"); ?>
                                        </a>
                                    </td>
                                    <td style="padding: 2px; border: none;">
                                        <a
                                            href="<?php index(); ?>?input=edit&proses=<?= encrypt($data["id_kategori_member"]) ?>">
                                            <?php btn_edit("Edit"); ?>
                                        </a>
                                    </td>
                                    <td style="padding: 2px; border: none;">
                                        <a
                                            href="<?php index(); ?>?input=hapus&proses=<?= encrypt($data["id_kategori_member"]) ?>">
                                            <?php btn_hapus("Hapus"); ?>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td align="center" width="50"><?php $no = $no + 1;
                        echo $no; ?></td>
                        <!--h <td align="center"><?php echo $data["id_kategori_member"]; ?></td> h-->
                        <td align="left"><?php echo $data["kategori_member"]; ?></td>
                        <td align="left"><a target="_blank"
                                href="../../../../admin/upload/<?php echo $data['gambar_logo']; ?>"><img
                                    onerror="this.src='../../../data/image/error/file.png'" width="50" height="30"
                                    src="../../../../admin/upload/<?php echo $data['gambar_logo']; ?>"></a></td>
                        <td align="left"><?php echo $data["maksimal_transaksi"]; ?></td>
                        <td align="left"><?php echo $data["jenis"]; ?></td>
                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>

    <?php Pagination($page, $dataPerPage, $querypagination); ?>

</body>