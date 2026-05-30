<div class="content-box">
    <h5><i class="fa fa-database"></i> Edit Data plat kendaraan transaksi voucher </h5>
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
                        $sql = mysql_query("SELECT * FROM data_plat_kendaraan_transaksi_voucher where id_plat_kendaraan_transaksi_voucher = '$proses'");
                        $data = mysql_fetch_array($sql);
                        ?>
                        <!--h
                            <tr>
                                <td width="25%" class="leftrowcms">					
                                    <label >Id plat kendaraan transaksi voucher  <font color="red">*</font></label>
                                </td>
                                <td width="2%">:</td>
                                <td>
                                <?php echo $data['id_plat_kendaraan_transaksi_voucher']; ?>	
                                </td>
                            </tr>
                            h-->
                        <input type="hidden" class="form-control" name="id_plat_kendaraan_transaksi_voucher" value="<?php echo $data['id_plat_kendaraan_transaksi_voucher']; ?>" readonly id="id_plat_kendaraan_transaksi_voucher" required="required">


                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Id Voucher <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <select class="form-control" style="width:50%" type="text" name="id_transaksi_voucher" id="id_transaksi_voucher" placeholder="Id transaksi voucher" required="required">
          <option value="<?php echo ($data['id_transaksi_voucher']); ?>">- <?php echo baca_database("","id_voucher","select * from data_transaksi_voucher where id_transaksi_voucher='$data[id_transaksi_voucher]'"); ?> -</option>
          <?php combo_database_v2("data_transaksi_voucher", "id_transaksi_voucher", "id_voucher", ""); ?>
        </select>
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>No plat kendaraan <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="text" name="no_plat_kendaraan" id="no_plat_kendaraan" placeholder="No plat kendaraan" value="<?php echo ($data['no_plat_kendaraan']); ?>" required="required">
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Nama Supir <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <select class="form-control" style="width:50%" type="text" name="id_supir" id="id_supir" placeholder="Id supir" required="required">
          <option value="<?php echo ($data['id_supir']); ?>">- <?php echo baca_database("","nama_supir","select * from data_supir where id_supir='$data[id_supir]'"); ?> -</option>
          <?php combo_database_v2("data_supir", "id_supir", "nama_supir", ""); ?>
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
        <label>Foto <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
          <a href="../../../../admin/upload/<?php echo $data['foto']; ?>">
            <img onerror="this.src='../../../data/image/error/file.png'" width="100"  src="../../../../admin/upload/<?php echo $data['foto']; ?>">
              <br><?php echo $data['foto']; ?>
          </a>
		  <input value="<?php echo ($data['foto']); ?>" class="form-control" style="width:50%" type="hidden" name="foto1" id="foto1" placeholder="Foto">
		  <input value="<?php echo ($data['foto']); ?>" class="form-control" style="width:50%" type="file" name="foto" id="foto" placeholder="Foto">
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