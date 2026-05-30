<div class="content-box">
    <h5><i class="fa fa-database"></i> Tambah Data pengaturan </h5>
    <br>
    <form action="proses_simpan.php" enctype="multipart/form-data" method="post" id="simpan">
        <div class="content-box-content">
            <div id="postcustom">
                <table <?php tabel_in(100, '%', 0, 'center'); ?>>
                    <tbody>
                        <!--h
                        <tr>
                            <td width="25%" class="leftrowcms">					
                                <label >Id pengaturan  <span class="highlight">*</span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                              <?php echo id_otomatis("data_pengaturan", "id_pengaturan", "10"); ?>  		
                            </td>
                        </tr>
                        h-->
                        <input type="hidden" class="form-control" readonly value="<?php echo id_otomatis("data_pengaturan", "id_pengaturan", "10"); ?>" name="id_pengaturan" placeholder="Id pengaturan" id="id_pengaturan" required="required">


                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Nama <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="text" name="nama" id="nama" placeholder="Nama" required="required">
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Value <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <textarea class="form-control" style="width:50%" type="text" name="value" id="value" placeholder="Value" required="required"></textarea>
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