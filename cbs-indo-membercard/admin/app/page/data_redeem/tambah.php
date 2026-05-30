<a href="<?php index(); ?>">
    <?php btn_kembali(' KEMBALI'); ?>
</a>

<br><br>

<div class="content-box">
    <div class="content-box-header" style="height: 39px">Tambah<h3></h3>
    </div>
    <form action="proses_simpan.php" enctype="multipart/form-data" method="post">
        <div class="content-box-content">
            <div id="postcustom">
                <table <?php tabel_in(100, '%', 0, 'center'); ?>>
                    <tbody>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>id&nbsp;redeem <span class="highlight">*</span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input type="readonly" readonly
                                    value="<?php echo id_otomatis("data_redeem", "id_redeem", "10"); ?>" name="id_redeem"
                                    placeholder="id_redeem" id="id_redeem" required="required">
                            </td>
                        </tr>

                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Tanggal <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class='form-control' value="<?php echo tanggal_otomatis(); ?>" type="date" name="tanggal"
                                    id="tanggal" placeholder="Tanggal" required="required">


                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Jam <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class='form-control' type="time" name="jam" id="jam" placeholder="Jam" required="required">


                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Id&nbsp;Member <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>

                                <select class='form-control' data-live-search='true' type="text" name="id_member"
                                    id="id_member" placeholder="Id&nbsp;Member" required="required">
                                    <option></option><?php combo_database2('data_member', 'id_member', 'nama', ''); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Id&nbsp;Mitra <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>

                                <select class='form-control' data-live-search='true' type="text" name="id_mitra"
                                    id="id_mitra" placeholder="Id&nbsp;Mitra" required="required">
                                    <option></option><?php combo_database2('data_mitra', 'id_mitra', 'nama_mitra', ''); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Id&nbsp;Promo <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>

                                <select class='form-control' data-live-search='true' type="text" name="id_promo"
                                    id="id_promo" placeholder="Id&nbsp;Promo" required="required">
                                    <option></option><?php combo_database2('data_promo', 'id_promo', 'nama_promo', ''); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Point <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class='form-control' type="text" name="point" id="point" placeholder="Point" required="required">


                            </td>
                        </tr>

                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Jumlah <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class='form-control' type="text" name="jumlah" id="jumlah" placeholder="Point" required="required">
                            </td>
                        </tr>

                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Value Redeem <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class='form-control' type="text" name="value_redeem" id="value_redeem" placeholder="Point" required="required">
                            </td>
                        </tr>


                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Petugas <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>

                                <select class='selectpicker' data-live-search='true' type="enum" name="id_petugas" id="petugas"
                                    placeholder="Petugas" required="required">
                                    <?php
                                    $username = decrypt($_COOKIE['jenenge']);
                                    $nama_spbu = baca_database("data_admin", 'nama_spbu', "select * from data_admin where username = '$username'");

                                    ?>
                                    <option></option><?php combo_database2('data_petugas', 'id_petugas', 'nama', "select * from data_petugas where nama_spbu = '$nama_spbu'"); ?>
                                </select>
                            </td>
                        </tr>

                    </tbody>
                </table>
                <div class="content-box-content">
                    <center>
                        <?php btn_simpan(' SIMPAN'); ?>
                    </center>
                </div>
            </div>
        </div>
    </form>