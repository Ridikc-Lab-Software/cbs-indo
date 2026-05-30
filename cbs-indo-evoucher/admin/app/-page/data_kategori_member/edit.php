
<a href="<?php index(); ?>">
    <?php btn_kembali(' KEMBALI KE HALAMAN SEBELUMNYA'); ?>
</a>

    <div class="col-sm-12" style="margin-bottom: 20px; margin-top: 20px;">
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <strong>Edit Data Kategori Member </strong>
        <hr class="message-inner-separator">
            <p>Silahkan Update Data Kategori Member  dibawah ini.</p>
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
                    $sql = mysql_query("SELECT * FROM data_kategori_member where id_kategori_member = '$proses'");
                    $data = mysql_fetch_array($sql);
                    ?>
                    <!--h
                    <tr>
                        <td width="25%" class="leftrowcms">					
                            <label >Id Kategori Member  <font color="red">*</font></label>
                        </td>
                        <td width="2%">:</td>
                        <td>
                           <?php echo $data['id_kategori_member']; ?>	
                        </td>
                    </tr>
                    h-->
                    <input type="hidden" class="form-control" name="id_kategori_member" value="<?php echo $data['id_kategori_member']; ?>" readonly  id="id_kategori_member" required="required">

                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Kategori Member  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="varchar" name="kategori_member" id="kategori_member" placeholder="Kategori Member " required="required" value="<?php echo ($data['kategori_member']); ?>">
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
                                <label >Maksimal Transaksi  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="varchar" name="maksimal_transaksi" id="maksimal_transaksi" placeholder="Maksimal Transaksi " required="required" value="<?php echo ($data['maksimal_transaksi']); ?>">
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
