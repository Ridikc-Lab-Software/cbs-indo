
<a href="<?php index(); ?>">
    <?php btn_kembali(' KEMBALI KE HALAMAN SEBELUMNYA'); ?>
</a>

    <div class="col-sm-12" style="margin-bottom: 20px; margin-top: 20px;">
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <strong>Edit Data Transaksi Voucher </strong>
        <hr class="message-inner-separator">
            <p>Silahkan Update Data Transaksi Voucher  dibawah ini.</p>
        </div>
    </div>


<div class="content-box">
    <form action="proses_update.php"  enctype="multipart/form-data"  method="post">
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
                    $sql = mysql_query("SELECT * FROM data_transaksi_voucher where id_transaksi = '$proses'");
                    $data = mysql_fetch_array($sql);
                    ?>
                    <!--h
                    <tr>
                        <td width="25%" class="leftrowcms">					
                            <label >Id Transaksi  <font color="red">*</font></label>
                        </td>
                        <td width="2%">:</td>
                        <td>
                           <?php echo $data['id_transaksi']; ?>	
                        </td>
                    </tr>
                    h-->
                    <input type="hidden" class="form-control" name="id_transaksi" value="<?php echo $data['id_transaksi']; ?>" readonly  id="id_transaksi" required="required">

                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Qrcode  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="id_voucher" id="id_voucher" placeholder="Id Voucher " required="required">
                                <option value="<?php echo ($data['id_voucher']); ?>">- <?php echo baca_database("","qrcode","select * from data_voucher where id_voucher='$data[id_voucher]'"); ?> -</option><?php combo_database_v2('data_voucher','id_voucher','qrcode',''); ?>
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
                                <option value="<?php echo ($data['id_member']); ?>">- <?php echo baca_database("","nik","select * from data_member where id_member='$data[id_member]'"); ?> -</option><?php combo_database_v2('data_member','id_member','nik',''); ?>
                                </select>
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Nama Member  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="varchar" name="nama_member" id="nama_member" placeholder="Nama Member " required="required" value="<?php echo ($data['nama_member']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Tanggal Transaksi  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input value="<?php echo ($data['tanggal_transaksi']); ?>" class="form-control" style="width:50%" type="text" name="tanggal_transaksi" id="tanggal_transaksi" placeholder="Tanggal Transaksi " required="required">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Jenis Bbm  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="varchar" name="jenis_bbm" id="jenis_bbm" placeholder="Jenis Bbm " required="required" value="<?php echo ($data['jenis_bbm']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Nominal  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input onkeypress='return a(event)' class="form-control" style="width:50%" type="int" name="nominal" id="nominal" placeholder="Nominal " required="required" value="<?php echo ($data['nominal']); ?>">
                            </td>
                        </tr>


                    </tbody>
                </table>
                <div class="content-box-content">
                    <center>
                        <?php btn_update(' PROSES UPDATE DATA'); ?>
                    </center>
                </div>		
            </div>
        </div>
    </form>
