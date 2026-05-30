<div class="content-box">
    <h5><i class="fa fa-database"></i> Edit Data harga transaksi </h5>
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
                        $sql = mysql_query("SELECT * FROM data_harga_transaksi where id_harga_transaksi = '$proses'");
                        $data = mysql_fetch_array($sql);
                        ?>
                        <!--h
                            <tr>
                                <td width="25%" class="leftrowcms">					
                                    <label >Id harga transaksi  <font color="red">*</font></label>
                                </td>
                                <td width="2%">:</td>
                                <td>
                                <?php echo $data['id_harga_transaksi']; ?>	
                                </td>
                            </tr>
                            h-->
                        <input type="hidden" class="form-control" name="id_harga_transaksi" value="<?php echo $data['id_harga_transaksi']; ?>" readonly id="id_harga_transaksi" required="required">


                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Tanggal <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <select class="form-control" style="width:50%" type="text" name="id_transaksi" id="id_transaksi" placeholder="Id transaksi" required="required">
          <option value="<?php echo ($data['id_transaksi']); ?>">- <?php echo baca_database("","tanggal","select * from data_transaksi where id_transaksi='$data[id_transaksi]'"); ?> -</option>
          <?php combo_database_v2("data_transaksi", "id_transaksi", "tanggal", ""); ?>
        </select>
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Jenis Transaksi <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <select class="form-control" style="width:50%" type="text" name="id_jenis_transaksi" id="id_jenis_transaksi" placeholder="Id jenis transaksi" required="required">
          <option value="<?php echo ($data['id_jenis_transaksi']); ?>">- <?php echo baca_database("","jenis_transaksi","select * from data_jenis_transaksi where id_jenis_transaksi='$data[id_jenis_transaksi]'"); ?> -</option>
          <?php combo_database_v2("data_jenis_transaksi", "id_jenis_transaksi", "jenis_transaksi", ""); ?>
        </select>
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Jenis transaksi <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="text" name="jenis_transaksi" id="jenis_transaksi" placeholder="Jenis transaksi" value="<?php echo ($data['jenis_transaksi']); ?>" required="required">
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Point <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="text" name="point" id="point" placeholder="Point" value="<?php echo ($data['point']); ?>" required="required">
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Harga <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="number" name="harga" id="harga" placeholder="Harga" value="<?php echo ($data['harga']); ?>" required="required">
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