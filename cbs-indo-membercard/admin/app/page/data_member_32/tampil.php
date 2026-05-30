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
                        <a href="../data_member_27/" class="btn btn-primary">Data SPBU 24.373.27</a>
                        <a href="../data_member_32/" class="btn btn-warning">Data SPBU 24.373.32</a>
                        <a href="../data_member/" class="btn btn-primary">Data Keseluruhan</a>
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
                            $sql = "desc data_member";
                            $result = @mysql_query($sql);
                            while ($row = @mysql_fetch_array($result)) {
                                if (in_array($row[0], ['nama', 'no_telepon', 'id_admin'])) {
                                    if ($row[0] == 'id_admin') {

                                        echo "<option name='berdasarkan' value='id_admin'>nama_spbu</option>";

                                        continue;
                                    }

                                    echo "<option name='berdasarkan' value=$row[0]>$row[0]</option>";
                                }
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

            <th align="center" class="th_border cell">Nik</th>
            <th align="center" class="th_border cell">Nama</th>
            <th align="center" class="th_border cell">Point</th>
            <th align="center" class="th_border cell">Transaksi&nbsp;Terakhir</th>
            <th align="center" class="th_border cell">Jenis&nbsp;Kendaraan</th>
            <th align="center" class="th_border cell">Alamat</th>
            <th align="center" class="th_border cell">No&nbsp;telepon</th>
            <th align="center" class="th_border cell">Jenis&nbsp;kelamin</th>
            <th align="center" class="th_border cell">Tanggal&nbsp;terdaftar</th>

            <th align="center" class="th_border cell">Kode&nbsp;rfid</th>
            <th align="center" class="th_border cell">Tanggal&nbsp;lahir</th>
            <th align="center" class="th_border cell">Agama</th>
            <th align="center" class="th_border cell">Status&nbsp;perkawinan</th>
            <th align="center" class="th_border cell">Pekerjaan</th>
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



                $querytabel = "SELECT * FROM data_member where $berdasarkan like '%$isi%'  and spbu = '24.373.32' LIMIT $startRow ,$dataPerPage";
                $querypagination = "SELECT COUNT(*) AS total FROM data_member where $berdasarkan like '%$isi%'  and spbu LIKE '%24.373.32%' LIMIT $startRow ,$dataPerPage";
            } else {


                $querytabel = "SELECT * FROM data_member where spbu LIKE '%24.373.32%'";
                $querypagination = "SELECT COUNT(*) AS total FROM data_member where spbu = '24.373.32'";
            }
            $proses = mysql_query($querytabel);
            while ($data = mysql_fetch_array($proses)) {


                $id_member = $data['id_member'];


            ?>
                <tr class="event2">
                    <td class="th_border cell" align="center" width="200">
                        <table border="0">
                            <tr>
                                <td>
                                    <a href="<?php index(); ?>?input=detail&proses=<?= encrypt($data['id_member']); ?>">
                                        <?php btn_detail('Detail'); ?></a>
                                </td>
                                <td>
                                    <a href="<?php index(); ?>?input=edit&proses=<?= encrypt($data['id_member']); ?>">
                                        <?php btn_edit('Edit'); ?></a>
                                </td>
                                <?php
                                $hak_akses = decrypt($_COOKIE['hak_akses']);
                                if ($hak_akses == 'manager') { ?>
                                    <td>
                                        <a href="<?php index(); ?>?input=hapus&proses=<?= encrypt($data['id_member']); ?>">
                                            <?php btn_hapus('Hapus'); ?></a>
                                    </td>
                                <?php } ?>
                                <td>
                                    <a href="../data_transaksi/index.php?input=tampil&Berdasarkan=id_member&isi=<?= $data['id_member']; ?>">
                                        <button type="submit"
                                            class="btn btn-round-min btn-white btn-sm text-white text-center">
                                            <i class="fa fa-history"></i>&nbsp;

                                        </button>
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td align="center" width="50"><?php $no = (($no + 1));
                                                    echo $no; ?></td>

                    <td align="center"><?php echo ($data['nik']); ?></td>
                    <td align="center"><?php echo ($data['nama']); ?></td>

                    <td align="center"><b style="color: red;"><?php echo number_format($data['point']); ?>&nbsp;Point</b>
                        <br>
                        <?php $update = baca_database('', 'update_point', "select * from data_persetujuan_point where id_member='$id_member' and status='menunggu_persetujuan'");

                        if ($update == "") {
                        } else {

                        ?>
                            Menunggu Persetujuan Update <br>
                            <b style="color: red;">
                                <?php echo baca_database('', 'update_point', "select * from data_persetujuan_point where id_member='$id_member' and status='menunggu_persetujuan'"); ?> Point
                            <?php } ?></b>
                    </td>
                    <td align="center">
                        <?php echo number_format(baca_database("", "jumlah", "select * from data_transaksi where id_member ='$data[id_member]' order by tanggal desc limit 0,1")) ?>
                        <?php echo baca_database("", "kategori_jumlah", " select * from data_transaksi where id_member ='$data[id_member]' order by tanggal desc limit 0,1") ?>
                    </td>
                    <td align="center">
                        <b style="color: orange;">
                            <?php echo baca_database("", "kategori_member", " select * from data_kategori_member where id_kategori_member ='$data[id_kategori_member]'") ?>
                        </b>
                    </td>

                    <td align="center"><?php echo ($data['alamat']); ?></td>
                    <td align="center"><a
                            href="https://api.whatsapp.com/send?phone=<?php echo ($data['no_telepon']); ?>"><?php echo ($data['no_telepon']); ?></a>
                    </td>
                    <td align="center"><?php echo ($data['jenis_kelamin']); ?></td>
                    <td align="center"><?php echo (format_indo($data['tanggal_terdaftar'])); ?></td>
                    <td align="center"><?php echo ($data['kode_rfid']); ?></td>
                    <td align="center"><?php echo (format_indo($data['tanggal_lahir'])); ?></td>
                    <td align="center"><?php echo ($data['agama']); ?></td>
                    <td align="center"><?php echo ($data['status_perkawinan']); ?></td>
                    <td align="center"><?php echo ($data['pekerjaan']); ?></td>

                    <td align="center"><?php echo ($data['spbu']); ?></td>


                </tr>
            <?php  } ?>
        </tbody>
    </table>
</div>

<?php //Pagination($page, $dataPerPage, $querypagination); 
?>

</body>