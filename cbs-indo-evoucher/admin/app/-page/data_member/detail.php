<div class="content-box">
    <div class="content-box-content">
        <table <?php tabel_in(100, '%', 0, 'center'); ?>>
            <tbody>

                <?php
                if (!isset($_GET['proses'])) {
                        
                ?>
                    <script>
                        alert("AKSES DITOLAK");
                        location.href = "index.php";
                    </script>
                <?php
                    die();
                }
                $proses = decrypt(mysql_real_escape_string($_GET['proses']));
                $sql = mysql_query("SELECT * FROM data_member where id_member = '$proses'");
                $data = mysql_fetch_array($sql);
                ?>
                <!--h
            <tr>
                <td class="clleft" width="25%">Id Member </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['id_member']; ?></td>	
            </tr>
           h-->

                <tr>
                    <td class="clleft" width="25%">Nik </td>
                    <td class="clleft" width="2%">:</td>
                    <td class="clleft"><?php echo $data['nik']; ?></td>
                </tr>
                <tr>
                    <td class="clleft" width="25%">Nama </td>
                    <td class="clleft" width="2%">:</td>
                    <td class="clleft"><?php echo $data['nama']; ?></td>
                </tr>
                <tr>
                    <td class="clleft" width="25%">Alamat </td>
                    <td class="clleft" width="2%">:</td>
                    <td class="clleft"><?php echo $data['alamat']; ?></td>
                </tr>
                <tr>
                    <td class="clleft" width="25%">No Telepon </td>
                    <td class="clleft" width="2%">:</td>
                    <td class="clleft"><?php echo $data['no_telepon']; ?></td>
                </tr>
                <tr>
                    <td class="clleft" width="25%">Jenis Kelamin </td>
                    <td class="clleft" width="2%">:</td>
                    <td class="clleft"><?php echo $data['jenis_kelamin']; ?></td>
                </tr>
                <tr>
                    <td class="clleft" width="25%">Tanggal Terdaftar </td>
                    <td class="clleft" width="2%">:</td>
                    <td class="clleft"><?php echo format_indo($data['tanggal_terdaftar']); ?></td>
                </tr>
                <tr>
                    <td class="clleft" width="25%">Kategori Member </td>
                    <td class="clleft" width="2%">:</td>
                    <td class="clleft"><?php echo baca_database("", "kategori_member", "select * from data_kategori_member where id_kategori_member='$data[id_kategori_member]'")  ?></td>
                </tr>
                <tr>
                    <td class="clleft" width="25%">Kode Rfid </td>
                    <td class="clleft" width="2%">:</td>
                    <td class="clleft"><?php echo $data['kode_rfid']; ?></td>
                </tr>
                <tr>
                    <td class="clleft" width="25%">Point </td>
                    <td class="clleft" width="2%">:</td>
                    <td class="clleft"><?php echo $data['point']; ?></td>
                </tr>
                <tr>
                    <td class="clleft" width="25%">Username </td>
                    <td class="clleft" width="2%">:</td>
                    <td class="clleft"><?php echo $data['username']; ?></td>
                </tr>
                <tr>
                    <td class="clleft" width="25%">Password </td>
                    <td class="clleft" width="2%">:</td>
                    <td class="clleft"><?php echo $data['password']; ?></td>
                </tr>
                <tr>
                    <td class="clleft" width="25%">Tanggal Lahir </td>
                    <td class="clleft" width="2%">:</td>
                    <td class="clleft"><?php echo format_indo($data['tanggal_lahir']); ?></td>
                </tr>
                <tr>
                    <td class="clleft" width="25%">Agama </td>
                    <td class="clleft" width="2%">:</td>
                    <td class="clleft"><?php echo $data['agama']; ?></td>
                </tr>
                <tr>
                    <td class="clleft" width="25%">Status Perkawinan </td>
                    <td class="clleft" width="2%">:</td>
                    <td class="clleft"><?php echo $data['status_perkawinan']; ?></td>
                </tr>
                <tr>
                    <td class="clleft" width="25%">Pekerjaan </td>
                    <td class="clleft" width="2%">:</td>
                    <td class="clleft"><?php echo $data['pekerjaan']; ?></td>
                </tr>





            </tbody>
        </table>
    </div>
</div>


<div class="table-responsive mt-4">
    <table <?php tabel(100, '%', 1, 'left'); ?>>
        <tr <?php tabel_head_tr() ?>>

            <th>No</th>
            <!--h <th>Id Transaksi </th> h-->
            <th align="center" class="th_border cell">Qrcode </th>

            <th align="center" class="th_border cell">Tanggal Transaksi </th>
            <th align="center" class="th_border cell">Jenis Bbm </th>
            <th align="center" class="th_border cell">Nominal </th>

        </tr>

        <tbody>
            <?php
            $no = 0;

            $id_member = $data['id_member'];

            $querytabel = "SELECT * FROM data_transaksi_voucher where id_member='$id_member' order by id_transaksi desc";

            $proses = mysql_query($querytabel);
            while ($data = mysql_fetch_array($proses)) {
            ?>
                <tr class="event2">


                    <td align="center" width="50"><?php $no = (($no + 1));
                                                    echo $no; ?></td>
                    <!--h <td align="center"><?php echo $data['id_transaksi']; ?></td> h-->
                    <td align="center">
                        ID<?php echo $data['id_voucher'] ?>
                    </td>


                    <td align="center"><?php echo $data['tanggal_transaksi']; ?></td>
                    <td align="center">
                        <?php
                        $jenis_transaksi = QB::table("data_jenis_transaksi")->where("id_jenis_transaksi", $data['jenis_bbm'])->first();
                        if ($jenis_transaksi) {
                            echo $jenis_transaksi->jenis_transaksi;
                        } else {
                            echo $data['jenis_bbm'];
                        }
                        ?>
                    </td>
                    <td align="center"><?php echo rupiah($data['nominal']); ?></td>


                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>