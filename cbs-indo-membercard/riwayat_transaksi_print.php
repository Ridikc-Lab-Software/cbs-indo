

<?php
$nama_file = "riwayat_transaksi.xls";

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$nama_file\"");
header("Pragma: no-cache");
header("Expires: 0");
?>

<?php
function location() { return "home"; }
include 'admin/include/all_include.php';
?>
<br>
<center>
    <h3>Info Riwayat transaksi Member</h3>

</center>
<br>


<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="scroll-container">
                <table <?php tabel(100, '%', 1, 'left'); ?>>
                    <tr>

                        <th>No</th>
                        <th align="center" class="th_border cell">Nama</th>
                        <th align="center" class="th_border cell">Point</th>
                        <th align="center" class="th_border cell">Jumlah</th>
                        <th align="center" class="th_border cell">Jenis&nbsp;Kendaraan</th>
                        <th align="center" class="th_border cell">Jenis&nbsp;Transaksi</th>

                        <th align="center" class="th_border cell">Tanggal</th>
                        <th align="center" class="th_border cell">Jam</th>

                        <th align="center" class="th_border cell">Operator</th>
                        <th align="center" class="th_border cell">Nama&nbsp;SPBU</th>


                    </tr>

                    <tbody>
                        <?php
                        $id_member = mysql_real_escape_string(decrypt($_COOKIE['kodene']));
                        $no = 0;
                        $startRow = ($page - 1) * $dataPerPage;
                        $no = $startRow;



                        $querytabel = "SELECT * FROM data_transaksi where id_member = '$id_member' order by tanggal desc";


                        $proses = mysql_query($querytabel);
                        while ($data = mysql_fetch_array($proses)) { ?>
                            <tr class="event2">

                                <td align="center" width="50"><?php $no = (($no + 1));
                                                                echo $no; ?></td>
                                <td align="left"><?php echo baca_database("", "nama", " select * from data_member where id_member ='$data[id_member]'") ?></td>
                                <td align="left" style="color:red"><?php echo ($data['point']); ?>&nbsp;point</td>
                                <td align="left" style="color:blue"><?php
                                                                    if ($data['kategori_jumlah'] == "rupiah") {
                                                                        echo rupiah($data['jumlah']);
                                                                    } else {
                                                                        echo ($data['jumlah']);
                                                                        echo " " . ($data['kategori_jumlah']);
                                                                    }

                                                                    ?> </td>
                                <td align="left"><?php echo $data['id_kategori_member'] ?></td>
                                <td align="left"><?php echo $data['id_jenis_transaksi'] ?></td>

                                <td align="left"><?php echo (format_indo($data['tanggal'])); ?></td>
                                <td align="left"><?php echo ($data['jam']); ?></td>

                                <td align="left"><?php echo baca_database("", "nama", " select * from data_petugas where id_petugas ='$data[id_petugas]'") ?></td>

                                <?php

                                $spbu = baca_database('data_petugas', 'nama_spbu', "select nama_spbu from data_petugas where id_petugas='$data[id_petugas]'");
                                ?>

                                <td align="center">
                                    <?php echo $spbu; ?>
                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

