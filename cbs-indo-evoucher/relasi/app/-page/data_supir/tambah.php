<div class="content-box">
    <h5><i class="fa fa-database"></i> Tambah Data supir </h5>
    <br>
    <form action="proses_simpan.php" enctype="multipart/form-data" method="post" id="simpan">
        <div class="content-box-content">
            <div id="postcustom">
                <table <?php tabel_in(100, '%', 0, 'center'); ?>>
                    <tbody>
                        <!--h
                        <tr>
                            <td width="25%" class="leftrowcms">					
                                <label >Id supir  <span class="highlight">*</span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                              <?php echo id_otomatis("data_supir", "id_supir", "10"); ?>  		
                            </td>
                        </tr>
                        h-->
                        <input type="hidden" class="form-control" readonly value="<?php echo id_otomatis("data_supir", "id_supir", "10"); ?>" name="id_supir" placeholder="Id supir" id="id_supir" required="required">


                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Nama supir <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="text" name="nama_supir" id="nama_supir" placeholder="Nama supir" required="required">
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
                        
                    </tbody>
                </table>
            </div>
        </div>

        <a href="<?php index(); ?>"> <?php btn_kembali(' Kembali'); ?></a>
        <?php btn_simpan(' Proses Simpan Data '); ?>
    </form>
</div>