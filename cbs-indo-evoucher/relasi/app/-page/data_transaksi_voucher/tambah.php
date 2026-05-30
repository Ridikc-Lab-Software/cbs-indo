
<a href="<?php index(); ?>">
    <?php btn_kembali(' KEMBALI KEHALAMAN SEBELUMNYA'); ?>
</a>	

    <div class="col-sm-12" style="margin-bottom: 20px; margin-top: 20px;">
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <strong>Tambah Data Transaksi Voucher </strong>
        <hr class="message-inner-separator">
            <p>Silahkan input Data Transaksi Voucher  dibawah ini.</p>
        </div>
    </div>

<div class="content-box">
    <form action="proses_simpan.php" enctype="multipart/form-data"  method="post">
        <div class="content-box-content">
            <div id="postcustom">	
                <table <?php tabel_in(100, '%', 0, 'center'); ?>>		
                    <tbody>
                        <!--h
                        <tr>
                            <td width="25%" class="leftrowcms">					
                                <label >Id Transaksi  <span class="highlight">*</span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                              <?php echo id_otomatis("data_transaksi_voucher", "id_transaksi", "10"); ?>  		
                            </td>
                        </tr>
                        h-->
                        <input type="hidden" class="form-control" readonly value="<?php echo id_otomatis("data_transaksi_voucher", "id_transaksi", "10"); ?>" name="id_transaksi" placeholder="Id Transaksi " id="id_transaksi" required="required">

                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Qrcode  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="id_voucher" id="id_voucher" placeholder="Id Voucher " required="required">
                                <option></option><?php combo_database_v2('data_voucher','id_voucher','qrcode',''); ?>
                                </select>
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Nik  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="id_member" id="id_member" placeholder="Id Member " required="required">
                                <option></option><?php combo_database_v2('data_member','id_member','nik',''); ?>
                                </select>
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Nama Member  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="varchar" name="nama_member" id="nama_member" placeholder="Nama Member " required="required">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Tanggal Transaksi  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="datetime-local" name="tanggal_transaksi" id="tanggal_transaksi" placeholder="Tanggal Transaksi " required="required">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Jenis Bbm  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="varchar" name="jenis_bbm" id="jenis_bbm" placeholder="Jenis Bbm " required="required">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Nominal  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input onkeypress='return a(event)' class="form-control" style="width:50%" type="int" name="nominal" id="nominal" placeholder="Nominal " required="required">
                            </td>
                        </tr>
                        
                
                        
                    </tbody>
                </table>
                <div class="content-box-content">
                    <center>
                        <?php btn_simpan(' PROSES SIMPAN DATA'); ?>
                    </center>
                </div>		
            </div>
        </div>
    </form>
