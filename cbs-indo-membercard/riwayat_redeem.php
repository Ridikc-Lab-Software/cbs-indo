<br>
<center>
    <h3>Info Riwayat Redeem Member</h3>

</center>
<br>


<div class="container">
    <div class="row">
        <div class="col-sm-12">

            <div class="scroll-container">
                <table <?php tabel(100, '%', 1, 'left'); ?>>
                    <tr>

                        <th>No</th>
                        <th align="center" class="th_border cell">Member</th>
                        <th align="center" class="th_border cell">Mitra</th>
                        <th align="center" class="th_border cell">Promo</th>

                        <th align="center" class="th_border cell">Tanggal</th>
                        <th align="center" class="th_border cell">Jam</th>
                        <th align="center" class="th_border cell">Jumlah</th>
                        <th align="center" class="th_border cell">Point</th>
                        <th align="center" class="th_border cell">Value</th>
                        <th align="center" class="th_border cell">Nama SPBU</th>


                    </tr>

                    <tbody>
                        <?php
                        $no = 0;
                        $startRow = ($page - 1) * $dataPerPage;
                        $no = $startRow;

                        $id_member = mysql_real_escape_string(decrypt($_COOKIE['kodene']));
                        $querytabel = "SELECT * FROM data_redeem  where id_member = '$id_member'";

                        $proses = mysql_query($querytabel);
                        while ($data = mysql_fetch_array($proses)) { ?>
                            <tr class="event2">

                                <td align="center" width="50"><?php $no = (($no + 1));
                                                                echo $no; ?></td>

                                <td align="center">

                                    <?php echo baca_database("", "nama", " select * from data_member where id_member ='$data[id_member]'") ?>

                                </td>
                                <td align="center"><?php echo baca_database("", "nama_mitra", " select * from data_mitra where id_mitra ='$data[id_mitra]'") ?></td>
                                <td align="center"><?php echo baca_database("", "nama_promo", " select * from data_promo where id_promo ='$data[id_promo]'") ?></td>

                                <td align="center"><?php echo (format_indo($data['tanggal'])); ?></td>
                                <td align="center"><?php echo ($data['jam']); ?></td>
                                <td align="center"><?php echo ($data['jumlah']); ?></td>
                                <td align="center"><?php echo ($data['jumlah'] * $data['point']); ?> Point</td>
                                <td align="center"><?php echo rupiah($data['jumlah'] * $data['value_redeem']); ?></td>

                                <?php

                                $spbu = baca_database('data_petugas', 'nama_spbu', "select nama_spbu from data_petugas where id_petugas='$data[id_petugas]'");
                                ?>

                                <td align="center">
                                    <a href="index.php?Berdasarkan=nama_spbu&isi=<?php echo $spbu; ?>"><?php echo $spbu; ?></a>
                                </td>


                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<center>
<a href="riwayat_redeem_print.php" target="_blank">
    <button type="button" class="btn btn-info"><i class="fa fa-print"></i>&nbsp;Download Excel</button>
    </a>
</center>
<br>
<br>