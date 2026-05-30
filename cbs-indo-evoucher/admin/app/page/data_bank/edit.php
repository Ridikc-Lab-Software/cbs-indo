
<a href="<?php index(); ?>">
    <?php btn_kembali(' KEMBALI KE HALAMAN SEBELUMNYA'); ?>
</a>

    <div class="col-sm-12" style="margin-bottom: 20px; margin-top: 20px;">
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <strong>Edit Data Bank </strong>
        <hr class="message-inner-separator">
            <p>Silahkan Update Data Bank  dibawah ini.</p>
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
                    $sql = mysql_query("SELECT * FROM data_bank where id_bank = '$proses'");
                    $data = mysql_fetch_array($sql);
                    ?>
                    <!--h
                    <tr>
                        <td width="25%" class="leftrowcms">					
                            <label >Id Bank  <font color="red">*</font></label>
                        </td>
                        <td width="2%">:</td>
                        <td>
                           <?php echo $data['id_bank']; ?>	
                        </td>
                    </tr>
                    h-->
                    <input type="hidden" class="form-control" name="id_bank" value="<?php echo $data['id_bank']; ?>" readonly  id="id_bank" required="required">

                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Nama Bank  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="varchar" name="nama_bank" id="nama_bank" placeholder="Nama Bank " required="required" value="<?php echo ($data['nama_bank']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Nomor Rekening  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="varchar" name="nomor_rekening" id="nomor_rekening" placeholder="Nomor Rekening " required="required" value="<?php echo ($data['nomor_rekening']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Atas Nama  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="varchar" name="atas_nama" id="atas_nama" placeholder="Atas Nama " required="required" value="<?php echo ($data['atas_nama']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Gambar  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                 <a href="../../../../admin/upload/<?php echo $data['gambar']; ?>"><img onerror="this.src='../../../data/image/error/file.png'" width="100"  src="../../../../admin/upload/<?php echo $data['gambar']; ?>"></a>
                                 <input value="<?php echo ($data['gambar']); ?>" class="form-control" style="width:50%" type="hidden" name="gambar1" id="gambar1" placeholder="Gambar  ">
                                 <input value="<?php echo ($data['gambar']); ?>" class="form-control" style="width:50%" type="file" name="gambar" id="gambar" placeholder="Gambar  ">

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
