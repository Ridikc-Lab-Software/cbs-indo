<div class="content-box">
    <h5><i class="fa fa-database"></i> Tambah Data sisa voucher </h5>
    <br>
    <form action="proses_simpan.php" enctype="multipart/form-data" method="post" id="simpan">
        <div class="content-box-content">
            <div id="postcustom">
                <table <?php tabel_in(100, '%', 0, 'center'); ?>>
                    <tbody>
                        <!--h
                        <tr>
                            <td width="25%" class="leftrowcms">					
                                <label >Id sisa voucher  <span class="highlight">*</span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                              <?php echo id_otomatis("data_sisa_voucher", "id_sisa_voucher", "10"); ?>  		
                            </td>
                        </tr>
                        h-->
                        <input type="hidden" class="form-control" readonly value="<?php echo id_otomatis("data_sisa_voucher", "id_sisa_voucher", "10"); ?>" name="id_sisa_voucher" placeholder="Id sisa voucher" id="id_sisa_voucher" required="required">


                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Qrcode <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <select class="form-control" style="width:50%" type="text" name="id_voucher" id="id_voucher" placeholder="Id voucher" required="required">
            <option value=''></option>  
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
            <option value=''></option>  
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
        <input class="form-control" style="width:50%" type="number" name="nominal_voucher" id="nominal_voucher" placeholder="Nominal voucher" required="required">
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Nominal transaksi <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="number" name="nominal_transaksi" id="nominal_transaksi" placeholder="Nominal transaksi" required="required">
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Nominal sisa <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="number" name="nominal_sisa" id="nominal_sisa" placeholder="Nominal sisa" required="required">
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Tanggal transaksi <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="datetime-local" name="tanggal_transaksi" id="tanggal_transaksi" placeholder="Tanggal transaksi" required="required">
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Status <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="text" name="status" id="status" placeholder="Status" required="required">
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