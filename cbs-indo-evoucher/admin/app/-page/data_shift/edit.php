<div class="content-box">
    <h5><i class="fa fa-database"></i> Edit Data shift </h5>
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
                        $sql = mysql_query("SELECT * FROM data_shift where id_shift = '$proses'");
                        $data = mysql_fetch_array($sql);
                        ?>
                        <!--h
                            <tr>
                                <td width="25%" class="leftrowcms">					
                                    <label >Id shift  <font color="red">*</font></label>
                                </td>
                                <td width="2%">:</td>
                                <td>
                                <?php echo $data['id_shift']; ?>	
                                </td>
                            </tr>
                            h-->
                        <input type="hidden" class="form-control" name="id_shift" value="<?php echo $data['id_shift']; ?>" readonly id="id_shift" required="required">


                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Shift <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="text" name="shift" id="shift" placeholder="Shift" value="<?php echo ($data['shift']); ?>" required="required">
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Jam mulai <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="time" name="jam_mulai" id="jam_mulai" placeholder="Jam mulai" value="<?php echo ($data['jam_mulai']); ?>" required="required">
    </td>
</tr>
                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Jam selesai <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="time" name="jam_selesai" id="jam_selesai" placeholder="Jam selesai" value="<?php echo ($data['jam_selesai']); ?>" required="required">
    </td>
</tr>
                        

                    </tbody>
                </table>
            </div>
        </div>

        
        <?php btn_update(' Proses Update  Data '); ?>
    </form>
</div>