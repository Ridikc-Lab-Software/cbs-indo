<div class="content-box">
    <h5><i class="fa fa-database"></i> Tambah Data admin </h5>
    <br>
    <form action="proses_simpan.php" enctype="multipart/form-data" method="post" id="simpan">
        <div class="content-box-content">
            <div id="postcustom">
                <table <?php tabel_in(100, '%', 0, 'center'); ?>>
                    <tbody>
                        <!--h
                        <tr>
                            <td width="25%" class="leftrowcms">					
                                <label >Id admin  <span class="highlight">*</span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                              <?php echo id_otomatis("data_admin", "id_admin", "10"); ?>          
                            </td>
                        </tr>
                        h-->
                        <input type="hidden" class="form-control" readonly
                            value="<?php echo id_otomatis("data_admin", "id_admin", "10"); ?>" name="id_admin"
                            placeholder="Id admin" id="id_admin" required="required">


                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Hak akses <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="hak_akses"
                                    id="hak_akses" placeholder="Hak akses" required="required">
                                    <option value=''></option>
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
                                    placeholder="Username" required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Password <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="text" name="password" id="password"
                                    placeholder="Password" required="required">
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
                                    <?php combo_database("data_spbu", "nama_spbu", ""); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Nama <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="text" name="nama" id="nama"
                                    placeholder="Nama" required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Jabatan <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="text" name="jabatan" id="jabatan"
                                    placeholder="Jabatan" required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Foto tanda tangan <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="file" name="foto_tanda_tangan"
                                    id="foto_tanda_tangan" placeholder="Foto tanda tangan" required="required">
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>


        <?php btn_simpan(' Proses Simpan Data '); ?>
    </form>
</div>