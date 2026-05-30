<div class="content-box">
    <h5><i class="fa fa-database"></i> Tambah Data plat kendaraan transaksi voucher </h5>
    <br>
    <form action="proses_simpan.php" enctype="multipart/form-data" method="post" id="simpan">
        <div class="content-box-content">
            <div id="postcustom">
                <table <?php tabel_in(100, '%', 0, 'center'); ?>>
                    <tbody>
                        <!--h
                        <tr>
                            <td width="25%" class="leftrowcms">					
                                <label >Id plat kendaraan transaksi voucher  <span class="highlight">*</span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                              <?php echo id_otomatis("data_plat_kendaraan_transaksi_voucher", "id_plat_kendaraan_transaksi_voucher", "10"); ?>  		
                            </td>
                        </tr>
                        h-->
                        <input type="hidden" class="form-control" readonly value="<?php echo id_otomatis("data_plat_kendaraan_transaksi_voucher", "id_plat_kendaraan_transaksi_voucher", "10"); ?>" name="id_plat_kendaraan_transaksi_voucher" placeholder="Id plat kendaraan transaksi voucher" id="id_plat_kendaraan_transaksi_voucher" required="required">


                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Id Voucher <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <select class="form-control" style="width:50%" type="text" name="id_transaksi_voucher" id="id_transaksi_voucher" placeholder="Id transaksi voucher" required="required">
            <option value=''></option>  
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
        <input class="form-control" style="width:50%" type="text" name="no_plat_kendaraan" id="no_plat_kendaraan" placeholder="No plat kendaraan" required="required">
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Nama Supir <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <select class="form-control" style="width:50%" type="text" name="id_supir" id="id_supir" placeholder="Id supir" required="required">
            <option value=''></option>  
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
            <option value=''></option>  
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
        <input class="form-control" style="width:50%" type="file" name="foto" id="foto" placeholder="Foto" required="required">
    </td>
</tr>
                        
                    </tbody>
                </table>
            </div>
        </div>

        <a href="<?php index(); ?>"> <?php btn_kembali(' Kembali'); ?></a>
        <?php btn_simpan(' Proses Simpan Data '); ?>
    </form>
</div>