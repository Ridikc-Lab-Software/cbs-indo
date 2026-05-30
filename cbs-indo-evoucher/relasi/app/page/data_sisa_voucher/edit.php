<div class="content-box">
    <h5><i class="fa fa-database"></i> Edit Data sisa voucher </h5>
    <br>
    <form action="proses_update.php" enctype="multipart/form-data" method="post" id="update">
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
                        $sql = mysql_query("SELECT * FROM data_sisa_voucher where id_sisa_voucher = '$proses'");
                        $data = mysql_fetch_array($sql);
                        ?>
                        <!--h
                            <tr>
                                <td width="25%" class="leftrowcms">					
                                    <label >Id sisa voucher  <font color="red">*</font></label>
                                </td>
                                <td width="2%">:</td>
                                <td>
                                <?php echo $data['id_sisa_voucher']; ?>	
                                </td>
                            </tr>
                            h-->
                        <input type="hidden" class="form-control" name="id_sisa_voucher" value="<?php echo $data['id_sisa_voucher']; ?>" readonly id="id_sisa_voucher" required="required">


                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Qrcode <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <select class="form-control" style="width:50%" type="text" name="id_voucher" id="id_voucher" placeholder="Id voucher" required="required">
          <option value="<?php echo ($data['id_voucher']); ?>">- <?php echo baca_database("","qrcode","select * from data_voucher where id_voucher='$data[id_voucher]'"); ?> -</option>
          <?php combo_database_v2("data_voucher", "id_voucher", "qrcode", ""); ?>
        </select>
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Nama <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <select class="form-control" style="width:50%" type="text" name="id_relasi" id="id_relasi" placeholder="Id relasi" required="required">
          <option value="<?php echo ($data['id_relasi']); ?>">- <?php echo baca_database("","nama","select * from data_relasi where id_relasi='$data[id_relasi]'"); ?> -</option>
          <?php combo_database_v2("data_relasi", "id_relasi", "nama", ""); ?>
        </select>
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Nominal voucher <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="number" name="nominal_voucher" id="nominal_voucher" placeholder="Nominal voucher" value="<?php echo ($data['nominal_voucher']); ?>" required="required">
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Nominal transaksi <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="number" name="nominal_transaksi" id="nominal_transaksi" placeholder="Nominal transaksi" value="<?php echo ($data['nominal_transaksi']); ?>" required="required">
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Nominal sisa <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="number" name="nominal_sisa" id="nominal_sisa" placeholder="Nominal sisa" value="<?php echo ($data['nominal_sisa']); ?>" required="required">
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Tanggal transaksi <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="datetime-local" name="tanggal_transaksi" id="tanggal_transaksi" placeholder="Tanggal transaksi" value="<?php echo ($data['tanggal_transaksi']); ?>" required="required">
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Status <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="text" name="status" id="status" placeholder="Status" value="<?php echo ($data['status']); ?>" required="required">
    </td>
</tr>
                        

                    </tbody>
                </table>
            </div>
        </div>

        <a href="<?php index(); ?>"> <?php btn_kembali(' Kembali'); ?></a>
        <?php btn_update(' Proses Update  Data '); ?>
    </form>
</div>