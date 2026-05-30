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
                        $sql = mysql_query("SELECT * FROM data_redeem where id_redeem = '$proses'");
                        $data = mysql_fetch_array($sql);
                        ?>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>id&nbsp;redeem <font color="red">*</font></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input type="%typepertama%" name="id_redeem" value="<?php echo $data['id_redeem']; ?>"
                                    readonly id="id_redeem" required="required">
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
                                <label>Id&nbsp;Mitra <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <!-- -->
                                <select class='form-control' data-live-search='true' required="required" type="text"
                                    name="id_mitra" id="id_mitra" placeholder="Id&nbsp;Mitra"
                                    value="<?php echo ($data['id_mitra']); ?>">
                                    <option value='<?php echo $data[id_mitra]; ?>'>- <?php echo $data[id_mitra]; ?>-
                                    </option><?php combo_database2('data_mitra', 'id_mitra', 'nama_mitra', ''); ?>
                                </select>

                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Id&nbsp;Promo <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <!-- -->
                                <select class='form-control' data-live-search='true' required="required" type="text"
                                    name="id_promo" id="id_promo" placeholder="Id&nbsp;Promo"
                                    value="<?php echo ($data['id_promo']); ?>">
                                    <option value='<?php echo $data[id_promo]; ?>'>- <?php echo $data[id_promo]; ?>-
                                    </option><?php combo_database2('data_promo', 'id_promo', 'nama_promo', ''); ?>
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
                        <!--                    <tr>-->
                        <!--                        <td width="25%" class="leftrowcms">-->
                        <!--                            <label>Status <span class="highlight"></span></label>-->
                        <!--                        </td>-->
                        <!--                        <td width="2%">:</td>-->
                        <!--                        <td>-->
                        <!--                            <select class='form-control' data-live-search='true' required="required" type="enum"-->
                        <!--                                    name="status" id="status" placeholder="Status"-->
                        <!--                                    value="--><?php //echo($data['status']); 
                                                                            ?><!--">-->
                        <!--                                <option value='--><?php //echo $data[status]; 
                                                                                ?><!--'>- --><?php //echo $data[status]; 
                                                                                                ?><!----->
                        <!--                                </option>--><?php //combo_enum('data_redeem', 'status', ''); 
                                                                        ?>
                        <!--                            </select>-->
                        <!---->
                        <!--                        </td>-->
                        <!--                    </tr>-->

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