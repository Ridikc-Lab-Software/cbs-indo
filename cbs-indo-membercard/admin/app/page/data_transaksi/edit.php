<a href="<?php index(); ?>">
    <?php btn_kembali(' KEMBALI'); ?>
</a>

<br><br>

<div class="content-box">
    <div class="content-box-header" style="height: 39px">Edit<h3></h3>
    </div>
    <form action="proses_update.php" enctype="multipart/form-data" method="post">
        <div class="content-box-content">
            <div id="postcustom">
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
                        $sql = mysql_query("SELECT * FROM data_transaksi where id_transaksi = '$proses'");
                        $data = mysql_fetch_array($sql);
                        ?>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>id&nbsp;transaksi <font color="red">*</font></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input type="%typepertama%" name="id_transaksi" value="<?php echo $data['id_transaksi']; ?>"
                                    readonly id="id_transaksi" required="required">
                            </td>
                        </tr>

                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Tanggal <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class='form-control' required="required" type="date" name="tanggal" id="tanggal"
                                    placeholder="Tanggal" value="<?php echo ($data['tanggal']); ?>">


                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Jam <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class='form-control' required="required" type="time" name="jam" id="jam" placeholder="Jam"
                                    value="<?php echo ($data['jam']); ?>">


                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Id&nbsp;Member <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <!-- -->
                                <select class='form-control' data-live-search='true' required="required" type="text"
                                    name="id_member" id="id_member" placeholder="Id&nbsp;Member"
                                    value="<?php echo ($data['id_member']); ?>">
                                    <option value='<?php echo $data[id_member]; ?>'>- <?php echo $data[id_member]; ?>-
                                    </option><?php combo_database2('data_member', 'id_member', 'nama', ''); ?>
                                </select>

                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Id&nbsp;Petugas <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <!-- -->
                                <select class='form-control' data-live-search='true' required="required" type="text"
                                    name="id_petugas" id="id_petugas" placeholder="Id&nbsp;Petugas"
                                    value="<?php echo ($data['id_petugas']); ?>">
                                    <option value='<?php echo $data[id_petugas]; ?>'>- <?php echo $data[id_petugas]; ?>-
                                    </option><?php combo_database2('data_petugas', 'id_petugas', 'nama', ''); ?>
                                </select>

                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Id&nbsp;Kategori&nbsp;Member <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <!-- -->
                                <select class='form-control' data-live-search='true' required="required" type="text"
                                    name="id_kategori_member" id="id_kategori_member"
                                    placeholder="Id&nbsp;Kategori&nbsp;Member"
                                    value="<?php echo ($data['id_kategori_member']); ?>">
                                    <option value='<?php echo $data[id_kategori_member]; ?>'>
                                        - <?php echo $data[id_kategori_member]; ?> -
                                    </option><?php combo_database('data_kategori_member', 'kategori_member', ''); ?>
                                </select>

                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Id&nbsp;Jenis&nbsp;Transaksi <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <!-- -->
                                <select class='form-control' data-live-search='true' required="required" type="text"
                                    name="id_jenis_transaksi" id="id_jenis_transaksi"
                                    placeholder="Id&nbsp;Jenis&nbsp;Transaksi"
                                    value="<?php echo ($data['id_jenis_transaksi']); ?>">
                                    <option value='<?php echo $data[id_jenis_transaksi]; ?>'>
                                        - <?php echo $data[id_jenis_transaksi]; ?> -
                                    </option><?php combo_database('data_jenis_transaksi', 'jenis_transaksi', ''); ?>
                                </select>

                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Point <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class='form-control' required="required" type="number" name="point" id="point"
                                    placeholder="Point" value="<?php echo ($data['point']); ?>">


                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Kategori&nbsp;Jumlah <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class='form-control' data-live-search='true' required="required" type="enum"
                                    name="kategori_jumlah" id="kategori_jumlah" placeholder="Kategori&nbsp;Jumlah"
                                    value="<?php echo ($data['kategori_jumlah']); ?>">
                                    <option value='<?php echo $data[kategori_jumlah]; ?>'>
                                        - <?php echo $data[kategori_jumlah]; ?> -
                                    </option><?php combo_enum('data_transaksi', 'kategori_jumlah', ''); ?>
                                </select>

                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Jumlah <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class='form-control' required="required" type="number" name="jumlah" id="jumlah"
                                    placeholder="Jumlah" value="<?php echo ($data['jumlah']); ?>">


                            </td>
                        </tr>

                    </tbody>
                </table>
                <div class="content-box-content">
                    <center>
                        <?php btn_update(' UPDATE'); ?>
                    </center>
                </div>
            </div>
        </div>
    </form>