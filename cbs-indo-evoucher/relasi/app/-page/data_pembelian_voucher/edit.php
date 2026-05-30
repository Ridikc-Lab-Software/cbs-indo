
<a href="<?php index(); ?>">
    <?php btn_kembali(' KEMBALI KE HALAMAN SEBELUMNYA'); ?>
</a>

    <div class="col-sm-12" style="margin-bottom: 20px; margin-top: 20px;">
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <strong>Edit Data Penjualan Voucher </strong>
        <hr class="message-inner-separator">
            <p>Silahkan Update Data Penjualan Voucher  dibawah ini.</p>
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
                    $sql = mysql_query("SELECT * FROM data_penjualan_voucher where id_penjualan = '$proses'");
                    $data = mysql_fetch_array($sql);
                    ?>
                    <!--h
                    <tr>
                        <td width="25%" class="leftrowcms">					
                            <label >Id Penjualan  <font color="red">*</font></label>
                        </td>
                        <td width="2%">:</td>
                        <td>
                           <?php echo $data['id_penjualan']; ?>	
                        </td>
                    </tr>
                    h-->
                    <input type="hidden" class="form-control" name="id_penjualan" value="<?php echo $data['id_penjualan']; ?>" readonly  id="id_penjualan" required="required">

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
                                <label >Tanggal Penjualan  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input value="<?php echo ($data['tanggal_penjualan']); ?>" class="form-control" style="width:50%" type="text" name="tanggal_penjualan" id="tanggal_penjualan" placeholder="Tanggal Penjualan " required="required">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Jumlah Voucher  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input onkeypress='return a(event)' class="form-control" style="width:50%" type="int" name="jumlah_voucher" id="jumlah_voucher" placeholder="Jumlah Voucher " required="required" value="<?php echo ($data['jumlah_voucher']); ?>">
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
                                <label >Password Voucher  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="varchar" name="password_voucher" id="password_voucher" placeholder="Password Voucher " required="required" value="<?php echo ($data['password_voucher']); ?>">
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
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Sub Total  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input onkeypress='return a(event)' class="form-control" style="width:50%" type="int" name="sub_total" id="sub_total" placeholder="Sub Total " required="required" value="<?php echo ($data['sub_total']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Persentase Ppn  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input onkeypress='return a(event)' class="form-control" style="width:50%" type="int" name="persentase_ppn" id="persentase_ppn" placeholder="Persentase Ppn " required="required" value="<?php echo ($data['persentase_ppn']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Ppn  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input onkeypress='return a(event)' class="form-control" style="width:50%" type="int" name="ppn" id="ppn" placeholder="Ppn " required="required" value="<?php echo ($data['ppn']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Total Bayar  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input onkeypress='return a(event)' class="form-control" style="width:50%" type="int" name="total_bayar" id="total_bayar" placeholder="Total Bayar " required="required" value="<?php echo ($data['total_bayar']); ?>">
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
