<a href="<?php index(); ?>">
    <?php btn_kembali(' KEMBALI KE HALAMAN SEBELUMNYA'); ?>
</a>

<div class="col-sm-12" style="margin-bottom: 20px; margin-top: 20px;">
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <strong>Edit Data Relasi </strong>
        <hr class="message-inner-separator">
        <p>Silahkan Update Data Relasi dibawah ini.</p>
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
                        $sql = mysql_query("SELECT * FROM data_relasi where id_relasi = '$proses'");
                        $data = mysql_fetch_array($sql);
                        ?>
                        <!--h
                    <tr>
                        <td width="25%" class="leftrowcms">
                            <label >Id Relasi  <font color="red">*</font></label>
                        </td>
                        <td width="2%">:</td>
                        <td>
                           <?php echo $data['id_relasi']; ?>
                        </td>
                    </tr>
                    h-->
                        <input type="hidden" class="form-control" name="id_relasi" value="<?php echo $data['id_relasi']; ?>" readonly id="id_relasi" required="required">

                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Nama <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="varchar" name="nama" id="nama" placeholder="Nama " required="required" value="<?php echo ($data['nama']); ?>">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Nomor Telepon <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="varchar" name="nomor_telepon" id="nomor_telepon" placeholder="Nomor Telepon " required="required" value="<?php echo ($data['nomor_telepon']); ?>">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Email <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input value="<?php echo ($data['email']); ?>" class="form-control" style="width:50%" type="text" name="email" id="email" placeholder="Email " required="required">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Alamat <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <textarea class="form-control" style="width:50%" type="text" name="alamat" id="alamat" placeholder="Alamat " required="required"><?php echo ($data['alamat']); ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Nama Spbu <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="id_spbu" id="id_spbu" placeholder="Id Spbu " required="required">
                                    <option value="<?php echo ($data['id_spbu']); ?>">- <?php echo baca_database("", "nama_spbu", "select * from data_spbu where id_spbu='$data[id_spbu]'"); ?> -</option><?php combo_database_v2('data_spbu', 'id_spbu', 'nama_spbu', ''); ?>
                                </select>
                            </td>
                        </tr>
                        <!-- <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Nama Spbu <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="varchar" name="nama_spbu" id="nama_spbu" placeholder="Nama Spbu " required="required" value="<?php echo ($data['nama_spbu']); ?>">
                            </td>
                        </tr> -->
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Password <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class="form-control" style="width:50%" type="text" name="password" id="password" placeholder="Password " required="required" value="<?php echo ($data['password']); ?>">
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