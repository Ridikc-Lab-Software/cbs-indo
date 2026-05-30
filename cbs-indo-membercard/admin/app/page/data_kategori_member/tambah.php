<div class="content-box">
    <h5><i class="fa fa-database"></i> Tambah Data kategori member </h5>
    <br>
    <form action="proses_simpan.php" enctype="multipart/form-data" method="post" id="simpan">
        <div class="content-box-content">
            <div id="postcustom">
                <table <?php tabel_in(100, '%', 0, 'center'); ?>>
                    <tbody>
                        <!--h
                        <tr>
                            <td width="25%" class="leftrowcms">					
                                <label >Id kategori member  <span class="highlight">*</span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                              <?php echo id_otomatis("data_kategori_member", "id_kategori_member", "10"); ?>          
                            </td>
                        </tr>
                        h-->
                        <input type="hidden" class="form-control" readonly
                            value="<?php echo id_otomatis("data_kategori_member", "id_kategori_member", "10"); ?>"
                            name="id_kategori_member" placeholder="Id kategori member" id="id_kategori_member"
                            required="required">


                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Kategori member <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="text" name="kategori_member"
                                    id="kategori_member" placeholder="Kategori member" required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Gambar logo <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="file" name="gambar_logo"
                                    id="gambar_logo" placeholder="Gambar logo" required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Maksimal transaksi <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="text" name="maksimal_transaksi"
                                    id="maksimal_transaksi" placeholder="Maksimal transaksi" required="required">
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
                                    <option value=''></option>
                                    <?php combo_enum("data_kategori_member", "jenis", ""); ?>
                                </select>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>


        <?php btn_simpan(' Proses Simpan Data '); ?>
    </form>
</div>