
<a href="<?php index(); ?>">
    <?php btn_kembali(' KEMBALI KE HALAMAN SEBELUMNYA'); ?>
</a>

    <div class="col-sm-12" style="margin-bottom: 20px; margin-top: 20px;">
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <strong>Edit Data Member </strong>
        <hr class="message-inner-separator">
            <p>Silahkan Update Data Member  dibawah ini.</p>
        </div>
    </div>


<div class="content-box">
    <form action="proses_update.php"  enctype="multipart/form-data"  method="post">
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
                    $sql = mysql_query("SELECT * FROM data_member where id_member = '$proses'");
                    $data = mysql_fetch_array($sql);
                    ?>
                    <!--h
                    <tr>
                        <td width="25%" class="leftrowcms">					
                            <label >Id Member  <font color="red">*</font></label>
                        </td>
                        <td width="2%">:</td>
                        <td>
                           <?php echo $data['id_member']; ?>	
                        </td>
                    </tr>
                    h-->
                    <input type="hidden" class="form-control" name="id_member" value="<?php echo $data['id_member']; ?>" readonly  id="id_member" required="required">

                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Nik  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="varchar" name="nik" id="nik" placeholder="Nik " required="required" value="<?php echo ($data['nik']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Nama  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="varchar" name="nama" id="nama" placeholder="Nama " required="required" value="<?php echo ($data['nama']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Alamat  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <textarea class="form-control" style="width:50%" type="text" name="alamat" id="alamat" placeholder="Alamat " required="required"><?php echo ($data['alamat']); ?></textarea>
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >No Telepon  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="varchar" name="no_telepon" id="no_telepon" placeholder="No Telepon " required="required" value="<?php echo ($data['no_telepon']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Jenis Kelamin  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="jenis_kelamin" id="jenis_kelamin" placeholder="Jenis Kelamin " required="required">
                                <option value="<?php echo ($data['jenis_kelamin']); ?>">- <?php echo ($data['jenis_kelamin']); ?> -</option><?php combo_enum('data_member','jenis_kelamin',''); ?>
                                </select>
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Tanggal Terdaftar  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="date" name="tanggal_terdaftar" id="tanggal_terdaftar" placeholder="Tanggal Terdaftar " required="required" value="<?php echo ($data['tanggal_terdaftar']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Kategori Member  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="id_kategori_member" id="id_kategori_member" placeholder="Id Kategori Member " required="required">
                                <option value="<?php echo ($data['id_kategori_member']); ?>">- <?php echo baca_database("","kategori_member","select * from data_kategori_member where id_kategori_member='$data[id_kategori_member]'"); ?> -</option><?php combo_database_v2('data_kategori_member','id_kategori_member','kategori_member',''); ?>
                                </select>
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Kode Rfid  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="varchar" name="kode_rfid" id="kode_rfid" placeholder="Kode Rfid " required="required" value="<?php echo ($data['kode_rfid']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Point  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input onkeypress='return a(event)' class="form-control" style="width:50%" type="int" name="point" id="point" placeholder="Point " required="required" value="<?php echo ($data['point']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Username  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="varchar" name="username" id="username" placeholder="Username " required="required" value="<?php echo ($data['username']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Password  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="password" name="password" id="password" placeholder="Password " required="required" value="<?php echo ($data['password']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Tanggal Lahir  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="date" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir " required="required" value="<?php echo ($data['tanggal_lahir']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Agama  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="agama" id="agama" placeholder="Agama " required="required">
                                <option value="<?php echo ($data['agama']); ?>">- <?php echo ($data['agama']); ?> -</option><?php combo_enum('data_member','agama',''); ?>
                                </select>
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Status Perkawinan  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="status_perkawinan" id="status_perkawinan" placeholder="Status Perkawinan " required="required">
                                <option value="<?php echo ($data['status_perkawinan']); ?>">- <?php echo ($data['status_perkawinan']); ?> -</option><?php combo_enum('data_member','status_perkawinan',''); ?>
                                </select>
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Pekerjaan  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input  class="form-control" style="width:50%" type="varchar" name="pekerjaan" id="pekerjaan" placeholder="Pekerjaan " required="required" value="<?php echo ($data['pekerjaan']); ?>">
                            </td>
                        </tr>
                          <tr>
                            <td width="25%" class="leftrowcms">
                                <label >Hak Akses  <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" style="width:50%" type="text" name="id_admin" id="id_admin" placeholder="Id Admin " required="required">
                                <option value="<?php echo ($data['id_admin']); ?>">- <?php echo baca_database("","hak_akses","select * from data_admin where id_admin='$data[id_admin]'"); ?> -</option><?php combo_database_v2('data_admin','id_admin','hak_akses',''); ?>
                                </select>
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
