<div class="content-box">
    <h5><i class="fa fa-database"></i> Tambah Data harga transaksi </h5>
    <br>
    <form action="proses_simpan.php" enctype="multipart/form-data" method="post" id="simpan">
        <div class="content-box-content">
            <div id="postcustom">
                <table <?php tabel_in(100, '%', 0, 'center'); ?>>
                    <tbody>
                        <!--h
                        <tr>
                            <td width="25%" class="leftrowcms">					
                                <label >Id harga transaksi  <span class="highlight">*</span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                              <?php echo id_otomatis("data_harga_transaksi", "id_harga_transaksi", "10"); ?>  		
                            </td>
                        </tr>
                        h-->
                        <input type="hidden" class="form-control" readonly value="<?php echo id_otomatis("data_harga_transaksi", "id_harga_transaksi", "10"); ?>" name="id_harga_transaksi" placeholder="Id harga transaksi" id="id_harga_transaksi" required="required">


                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Tanggal <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <select class="form-control" style="width:50%" type="text" name="id_transaksi" id="id_transaksi" placeholder="Id transaksi" required="required">
            <option value=''></option>  
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
            <option value=''></option>  
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
        <input class="form-control" style="width:50%" type="text" name="jenis_transaksi" id="jenis_transaksi" placeholder="Jenis transaksi" required="required">
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Point <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="text" name="point" id="point" placeholder="Point" required="required">
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Harga <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="number" name="harga" id="harga" placeholder="Harga" required="required">
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