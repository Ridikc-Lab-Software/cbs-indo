<div class="content-box">
    <h5><i class="fa fa-database"></i> Tambah Data nominal </h5>
    <br>
    <form action="proses_simpan.php" enctype="multipart/form-data" method="post" id="simpan">
        <div class="content-box-content">
            <div id="postcustom">
                <table <?php tabel_in(100, '%', 0, 'center'); ?>>
                    <tbody>
                        <!--h
                        <tr>
                            <td width="25%" class="leftrowcms">					
                                <label >Id nominal  <span class="highlight">*</span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                              <?php echo id_otomatis("data_nominal", "id_nominal", "10"); ?>  		
                            </td>
                        </tr>
                        h-->
                        <input type="hidden" class="form-control" readonly value="<?php echo id_otomatis("data_nominal", "id_nominal", "10"); ?>" name="id_nominal" placeholder="Id nominal" id="id_nominal" required="required">


                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Nominal <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="number" name="nominal" id="nominal" placeholder="Nominal" required="required">
    </td>
</tr>
                        
                    </tbody>
                </table>
            </div>
        </div>


        <?php btn_simpan(' Proses Simpan Data '); ?>
    </form>
</div>