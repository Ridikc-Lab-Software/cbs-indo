<div class="content-box">
    <h5><i class="fa fa-database"></i> Edit Data pengaturan </h5>
    <br>
    <form action="proses_update.php" enctype="multipart/form-data" method="post" id="update">
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
                        $sql = mysql_query("SELECT * FROM data_pengaturan where id_pengaturan = '$proses'");
                        $data = mysql_fetch_array($sql);
                        ?>
                        <!--h
                            <tr>
                                <td width="25%" class="leftrowcms">					
                                    <label >Id pengaturan  <font color="red">*</font></label>
                                </td>
                                <td width="2%">:</td>
                                <td>
                                <?php echo $data['id_pengaturan']; ?>	
                                </td>
                            </tr>
                            h-->
                        <input type="hidden" class="form-control" name="id_pengaturan" value="<?php echo $data['id_pengaturan']; ?>" readonly id="id_pengaturan" required="required">


                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Nama <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="text" name="nama" id="nama" placeholder="Nama" value="<?php echo ($data['nama']); ?>" required="required">
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Value <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <textarea class="form-control" style="width:50%" name="value" id="value" placeholder="Value" required="required"><?php echo ($data['value']); ?></textarea>
    </td>
</tr>
                        

                    </tbody>
                </table>
            </div>
        </div>

        <a href="<?php index(); ?>"> <?php btn_kembali(' Kembali'); ?></a>
        <?php btn_update(' Proses Update  Data '); ?>
    </form>
</div>