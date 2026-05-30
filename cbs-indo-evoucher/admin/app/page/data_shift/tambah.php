<div class="content-box">
    <h5><i class="fa fa-database"></i> Tambah Data shift </h5>
    <br>
    <form action="proses_simpan.php" enctype="multipart/form-data" method="post" id="simpan">
        <div class="content-box-content">
            <div id="postcustom">
                <table <?php tabel_in(100, '%', 0, 'center'); ?>>
                    <tbody>
                        <!--h
                        <tr>
                            <td width="25%" class="leftrowcms">					
                                <label >Id shift  <span class="highlight">*</span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                              <?php echo id_otomatis("data_shift", "id_shift", "10"); ?>  		
                            </td>
                        </tr>
                        h-->
                        <input type="hidden" class="form-control" readonly value="<?php echo id_otomatis("data_shift", "id_shift", "10"); ?>" name="id_shift" placeholder="Id shift" id="id_shift" required="required">


                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Shift <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="text" name="shift" id="shift" placeholder="Shift" required="required">
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Jam mulai <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="time" name="jam_mulai" id="jam_mulai" placeholder="Jam mulai" required="required">
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Jam selesai <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="time" name="jam_selesai" id="jam_selesai" placeholder="Jam selesai" required="required">
    </td>
</tr>
                        
                    </tbody>
                </table>
            </div>
        </div>

        
        <?php btn_simpan(' Proses Simpan Data '); ?>
    </form>
</div>