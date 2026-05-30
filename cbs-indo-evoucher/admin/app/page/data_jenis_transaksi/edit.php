
<a href="<?php index(); ?>">
    <?php btn_kembali(' KEMBALI KE HALAMAN SEBELUMNYA'); ?>
</a>

    <div class="col-sm-12" style="margin-bottom: 20px; margin-top: 20px;">
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <strong>Edit Data Jenis Transaksi </strong>
        <hr class="message-inner-separator">
            <p>Silahkan Update Data Jenis Transaksi  dibawah ini.</p>
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
                    $sql = mysql_query("SELECT * FROM data_jenis_transaksi where id_jenis_transaksi = '$proses'");
                    $data = mysql_fetch_array($sql);
                    ?>
                    <!--h
                    <tr>
                        <td width="25%" class="leftrowcms">					
                            <label >Id Jenis Transaksi  <font color="red">*</font></label>
                        </td>
                        <td width="2%">:</td>
                        <td>
                           <?php echo $data['id_jenis_transaksi']; ?>	
                        </td>
                    </tr>
                    h-->
                    <input type="hidden" class="form-control" name="id_jenis_transaksi" value="<?php echo $data['id_jenis_transaksi']; ?>" readonly  id="id_jenis_transaksi" required="required">

                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Jenis Transaksi  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="varchar" name="jenis_transaksi" id="jenis_transaksi" placeholder="Jenis Transaksi " required="required" value="<?php echo ($data['jenis_transaksi']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Gambar Logo  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                 <a href="../../../../admin/upload/<?php echo $data['gambar_logo']; ?>"><img onerror="this.src='../../../data/image/error/file.png'" width="100"  src="../../../../admin/upload/<?php echo $data['gambar_logo']; ?>"></a>
                                 <input value="<?php echo ($data['gambar_logo']); ?>" class="form-control" style="width:50%" type="hidden" name="gambar_logo1" id="gambar_logo1" placeholder="Gambar Logo  ">
                                 <input value="<?php echo ($data['gambar_logo']); ?>" class="form-control" style="width:50%" type="file" name="gambar_logo" id="gambar_logo" placeholder="Gambar Logo  ">

                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Point  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="varchar" name="point" id="point" placeholder="Point " required="required" value="<?php echo ($data['point']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Harga  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input onkeypress='return a(event)' class="form-control" style="width:50%" type="varchar" name="harga" id="harga" placeholder="Harga " required="required" value="<?php echo ($data['harga']); ?>">
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
