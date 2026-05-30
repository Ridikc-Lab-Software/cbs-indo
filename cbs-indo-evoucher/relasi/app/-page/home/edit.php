
<a href="<?php index(); ?>">
    <?php btn_kembali(' KEMBALI KE HALAMAN SEBELUMNYA'); ?>
</a>

    <div class="col-sm-12" style="margin-bottom: 20px; margin-top: 20px;">
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <strong>Edit Data Voucher </strong>
        <hr class="message-inner-separator">
            <p>Silahkan Update Data Voucher  dibawah ini.</p>
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
                    $sql = mysql_query("SELECT * FROM data_voucher where id_voucher = '$proses'");
                    $data = mysql_fetch_array($sql);
                    ?>
                    <!--h
                    <tr>
                        <td width="25%" class="leftrowcms">					
                            <label >Id Voucher  <font color="red">*</font></label>
                        </td>
                        <td width="2%">:</td>
                        <td>
                           <?php echo $data['id_voucher']; ?>	
                        </td>
                    </tr>
                    h-->
                    <input type="hidden" class="form-control" name="id_voucher" value="<?php echo $data['id_voucher']; ?>" readonly  id="id_voucher" required="required">

                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Qrcode  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="varchar" name="qrcode" id="qrcode" placeholder="Qrcode " required="required" value="<?php echo ($data['qrcode']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Nama  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="id_relasi" id="id_relasi" placeholder="Id Relasi " required="required">
                                <option value="<?php echo ($data['id_relasi']); ?>">- <?php echo baca_database("","nama","select * from data_relasi where id_relasi='$data[id_relasi]'"); ?> -</option><?php combo_database_v2('data_relasi','id_relasi','nama',''); ?>
                                </select>
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
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Tanggal Kadaluarsa  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input value="<?php echo ($data['tanggal_kadaluarsa']); ?>" class="form-control" style="width:50%" type="text" name="tanggal_kadaluarsa" id="tanggal_kadaluarsa" placeholder="Tanggal Kadaluarsa " required="required">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Nama Spbu  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="id_spbu" id="id_spbu" placeholder="Id Spbu " required="required">
                                <option value="<?php echo ($data['id_spbu']); ?>">- <?php echo baca_database("","nama_spbu","select * from data_spbu where id_spbu='$data[id_spbu]'"); ?> -</option><?php combo_database_v2('data_spbu','id_spbu','nama_spbu',''); ?>
                                </select>
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Id Relasi  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="id_penjualan" id="id_penjualan" placeholder="Id Penjualan " required="required">
                                <option value="<?php echo ($data['id_penjualan']); ?>">- <?php echo baca_database("","id_relasi","select * from data_penjualan_voucher where id_penjualan='$data[id_penjualan]'"); ?> -</option><?php combo_database_v2('data_penjualan_voucher','id_penjualan','id_relasi',''); ?>
                                </select>
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Status  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="status" id="status" placeholder="Status " required="required">
                                <option value="<?php echo ($data['status']); ?>">- <?php echo ($data['status']); ?> -</option><?php combo_enum('data_voucher','status',''); ?>
                                </select>
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >File Voucher  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                 <a href="../../../../admin/upload/<?php echo $data['file_voucher']; ?>"><img onerror="this.src='../../../data/image/error/file.png'" width="100"  src="../../../../admin/upload/<?php echo $data['file_voucher']; ?>"></a>
                                 <input value="<?php echo ($data['file_voucher']); ?>" class="form-control" style="width:50%" type="hidden" name="file_voucher1" id="file_voucher1" placeholder="File Voucher  ">
                                 <input value="<?php echo ($data['file_voucher']); ?>" class="form-control" style="width:50%" type="file" name="file_voucher" id="file_voucher" placeholder="File Voucher  ">

                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Tanggal Dibuka  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input value="<?php echo ($data['tanggal_dibuka']); ?>" class="form-control" style="width:50%" type="text" name="tanggal_dibuka" id="tanggal_dibuka" placeholder="Tanggal Dibuka " required="required">
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
