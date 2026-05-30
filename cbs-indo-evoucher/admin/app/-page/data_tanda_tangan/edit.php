<div class="col-sm-12" style="margin-bottom: 20px; margin-top: 20px;">
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <strong>Edit Data Admin </strong>
        <hr class="message-inner-separator">
        <p>Silahkan Update Data Admin dibawah ini.</p>
    </div>
</div>


<div class="content-box">
    <form action="proses_update.php" enctype="multipart/form-data" method="post">
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
                        $sql = mysql_query("SELECT * FROM data_tanda_tangan where id_tanda_tangan = '$proses'");
                        $data = mysql_fetch_array($sql);
                        ?>
                        <!--h
                    <tr>
                        <td width="25%" class="leftrowcms">					
                            <label >Id Admin  <font color="red">*</font></label>
                        </td>
                        <td width="2%">:</td>
                        <td>
                           <?php echo $data['id_tanda_tangan']; ?>	
                        </td>
                    </tr>
                    h-->
                        <input type="hidden" class="form-control" name="id_tanda_tangan" value="<?php echo $data['id_tanda_tangan']; ?>" readonly id="id_tanda_tangan" required="required">

                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Hak Akses <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="hak_akses" id="hak_akses" placeholder="Hak Akses " required="required">
                                    <option value="<?php echo ($data['hak_akses']); ?>">- <?php echo ($data['hak_akses']); ?> -</option><?php combo_enum('data_tanda_tangan', 'hak_akses', ''); ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Tanda Tangan <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <a href=""><img src="../../../upload/<?= $data['tanda_tangan']?>" alt="" srcset=""></a>
                                <input type="hidden" name="tanda_tangan1" value="<?= $data['tanda_tangan'] ?>">
                                <input type="file" name="tanda_tangan" id="" required="required">
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