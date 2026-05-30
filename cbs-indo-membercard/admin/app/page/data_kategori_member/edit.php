<div class="content-box">
    <h5><i class="fa fa-database"></i> Edit Data kategori member </h5>
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
                        $sql = mysql_query("SELECT * FROM data_kategori_member where id_kategori_member = '$proses'");
                        $data = mysql_fetch_array($sql);
                        ?>
                        <!--h
                            <tr>
                                <td width="25%" class="leftrowcms">					
                                    <label >Id kategori member  <font color="red">*</font></label>
                                </td>
                                <td width="2%">:</td>
                                <td>
                                <?php echo $data['id_kategori_member']; ?>    
                                </td>
                            </tr>
                            h-->
                        <input type="hidden" class="form-control" name="id_kategori_member"
                            value="<?php echo $data['id_kategori_member']; ?>" readonly id="id_kategori_member"
                            required="required">


                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Kategori member <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="text" name="kategori_member"
                                    id="kategori_member" placeholder="Kategori member"
                                    value="<?php echo ($data['kategori_member']); ?>" required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Gambar logo <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <a href="../../../../admin/upload/<?php echo $data['gambar_logo']; ?>">
                                    <img onerror="this.src='../../../data/image/error/file.png'" width="100"
                                        src="../../../../admin/upload/<?php echo $data['gambar_logo']; ?>">
                                    <br><?php echo $data['gambar_logo']; ?>
                                </a>
                                <input value="<?php echo ($data['gambar_logo']); ?>" class="form-control"
                                    style="width:50%" type="hidden" name="gambar_logo1" id="gambar_logo1"
                                    placeholder="Gambar logo">
                                <input value="<?php echo ($data['gambar_logo']); ?>" class="form-control"
                                    style="width:50%" type="file" name="gambar_logo" id="gambar_logo"
                                    placeholder="Gambar logo">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Maksimal transaksi <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="text" name="maksimal_transaksi"
                                    id="maksimal_transaksi" placeholder="Maksimal transaksi"
                                    value="<?php echo ($data['maksimal_transaksi']); ?>" required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Jenis <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="jenis" id="jenis"
                                    placeholder="Jenis" required="required">
                                    <option value="<?php echo ($data['jenis']); ?>"> - <?php echo ($data['jenis']); ?> -
                                    </option>
                                    <?php combo_enum("data_kategori_member", "jenis", ""); ?>
                                </select>
                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>
        </div>


        <?php btn_update(' Proses Update  Data '); ?>
    </form>
</div>