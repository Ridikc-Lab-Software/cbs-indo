<div class="content-box">
    <h5><i class="fa fa-database"></i> Edit Data admin </h5>
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
                        $sql = mysql_query("SELECT * FROM data_admin where id_admin = '$proses'");
                        $data = mysql_fetch_array($sql);
                        ?>
                        <!--h
                            <tr>
                                <td width="25%" class="leftrowcms">					
                                    <label >Id admin  <font color="red">*</font></label>
                                </td>
                                <td width="2%">:</td>
                                <td>
                                <?php echo $data['id_admin']; ?>    
                                </td>
                            </tr>
                            h-->
                        <input type="hidden" class="form-control" name="id_admin"
                            value="<?php echo $data['id_admin']; ?>" readonly id="id_admin" required="required">


                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Hak akses <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="hak_akses"
                                    id="hak_akses" placeholder="Hak akses" required="required">
                                    <option value="<?php echo ($data['hak_akses']); ?>"> -
                                        <?php echo ($data['hak_akses']); ?> -
                                    </option>
                                    <?php combo_enum("data_admin", "hak_akses", ""); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Username <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="text" name="username" id="username"
                                    placeholder="Username" value="<?php echo ($data['username']); ?>"
                                    required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Password <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="password" name="password"
                                    id="password" placeholder="Password">
                                <input class="form-control" style="width:50%" type="hidden" name="password_lama"
                                    id="password_lama" placeholder="Password"
                                    value="<?php echo ($data['password']); ?>">
                                <p>Password boleh dikosongkan jika tidak ingin mengubah password</p>
                            </td>
                        </tr>

                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Nama spbu <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>


                                <select class="form-control" style="width:50%" type="text" name="nama_spbu"
                                    id="nama_spbu" placeholder="Nama spbu" required="required">
                                    <option value="<?php echo ($data['nama_spbu']); ?>"> -
                                        <?php echo ($data['nama_spbu']); ?> - </option>
                                    <?php combo_database("data_spbu", "nama_spbu", ""); ?>
                                </select>
                        </tr>
                        </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Nama <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="text" name="nama" id="nama"
                                    placeholder="Nama" value="<?php echo ($data['nama']); ?>" required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Jabatan <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="text" name="jabatan" id="jabatan"
                                    placeholder="Jabatan" value="<?php echo ($data['jabatan']); ?>" required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Foto tanda tangan <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <a href="../../../../admin/upload/<?php echo $data['foto_tanda_tangan']; ?>">
                                    <img onerror="this.src='../../../data/image/error/file.png'" width="100"
                                        src="../../../../admin/upload/<?php echo $data['foto_tanda_tangan']; ?>">
                                    <br><?php echo $data['foto_tanda_tangan']; ?>
                                </a>
                                <input value="<?php echo ($data['foto_tanda_tangan']); ?>" class="form-control"
                                    style="width:50%" type="hidden" name="foto_tanda_tangan1" id="foto_tanda_tangan1"
                                    placeholder="Foto tanda tangan">
                                <input value="<?php echo ($data['foto_tanda_tangan']); ?>" class="form-control"
                                    style="width:50%" type="file" name="foto_tanda_tangan" id="foto_tanda_tangan"
                                    placeholder="Foto tanda tangan">
                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>
        </div>


        <?php btn_update(' Proses Update  Data '); ?>
    </form>
</div>