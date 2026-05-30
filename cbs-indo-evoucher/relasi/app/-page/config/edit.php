<div class="col-sm-12" style="margin-bottom: 20px; margin-top: 20px;">
    <div class="alert alert-warning">
        <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button> -->
        <strong>Edit Data Pengaturan Voucher </strong>
        <hr class="message-inner-separator">
        <p>Silahkan Update Data Pengaturan Voucher dibawah ini.</p>
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
                        $sql = mysql_query("SELECT * FROM data_pengaturan_voucher where id_pengaturan = '$proses'");
                        $data = mysql_fetch_array($sql);
                        ?>
                        <!--h
                    <tr>
                        <td width="25%" class="leftrowcms">
                            <label >Id Pengaturan  <font color="red">*</font></label>
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
                                <input readonly class="form-control" style="width:50%" type="varchar" readonly name="nama" id="nama" placeholder="Nama " required="required" value="<?php echo ($data['nama']); ?>">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Isi <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="varchar" name="isi" id="isi" placeholder="Isi " required="required" value="<?php echo ($data['isi']); ?>">
                            </td>
                        </tr>

                        <input class="form-control" style="width:50%" type="hidden" name="status" id="status" placeholder="Status " required="required" value="<?php echo ($data['status']); ?>">



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