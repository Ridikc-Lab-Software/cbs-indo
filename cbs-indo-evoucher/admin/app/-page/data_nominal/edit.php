<div class="content-box">
    <h5><i class="fa fa-database"></i> Edit Data nominal </h5>
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
                        $sql = mysql_query("SELECT * FROM data_nominal where id_nominal = '$proses'");
                        $data = mysql_fetch_array($sql);
                        ?>
                        <!--h
                            <tr>
                                <td width="25%" class="leftrowcms">					
                                    <label >Id nominal  <font color="red">*</font></label>
                                </td>
                                <td width="2%">:</td>
                                <td>
                                <?php echo $data['id_nominal']; ?>	
                                </td>
                            </tr>
                            h-->
                        <input type="hidden" class="form-control" name="id_nominal" value="<?php echo $data['id_nominal']; ?>" readonly id="id_nominal" required="required">


                                                <tr>
    <td width="25%" class="leftrowcms">
        <label>Nominal <span class="highlight"></span></label>
    </td>
    <td width="2%">:</td>
    <td>
        <input class="form-control" style="width:50%" type="number" name="nominal" id="nominal" placeholder="Nominal" value="<?php echo ($data['nominal']); ?>" required="required">
    </td>
</tr>
                        

                    </tbody>
                </table>
            </div>
        </div>

        
        <?php btn_update(' Proses Update  Data '); ?>
    </form>
</div>