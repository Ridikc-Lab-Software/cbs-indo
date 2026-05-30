<a href="<?php index(); ?>">
    <?php btn_kembali(' KEMBALI'); ?>
</a>

<br><br>

<div class="content-box">
    <div class="content-box-header" style="height: 39px">Edit<h3></h3>
    </div>
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
                        $sql = mysql_query("SELECT * FROM data_member where id_member = '$proses'");
                        $data = mysql_fetch_array($sql);
                        ?>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>id&nbsp;member <font color="red">*</font></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input type="%typepertama%" name="id_member" value="<?php echo $data['id_member']; ?>"
                                    readonly id="id_member" required="required">
                            </td>
                        </tr>

                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Nik <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class='form-control' required="required" type="text" name="nik" id="nik" placeholder="Nik"
                                    value="<?php echo ($data['nik']); ?>">


                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Nama <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input onkeypress='return h(event)' class='form-control' required="required" type="text" name="nama"
                                    id="nama" placeholder="Nama" value="<?php echo ($data['nama']); ?>">


                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Alamat <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <textarea class='form-control' required="required" type="text" name="alamat" id="alamat" placeholder="Alamat"
                                    value="<?php echo ($data['alamat']); ?>">
<?php echo $data['alamat'] ?>
</textarea>

                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>No&nbsp;Telepon <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input onkeypress='return a(event)' class='form-control' required="required" type="text"
                                    name="no_telepon" id="no_telepon" placeholder="No&nbsp;Telepon"
                                    value="<?php echo ($data['no_telepon']); ?>">


                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Jenis&nbsp;Kelamin <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class='form-control' data-live-search='true' required="required" type="enum"
                                    name="jenis_kelamin" id="jenis_kelamin" placeholder="Jenis&nbsp;Kelamin"
                                    value="<?php echo ($data['jenis_kelamin']); ?>">
                                    <option value='<?php echo $data[jenis_kelamin]; ?>'>
                                        - <?php echo $data[jenis_kelamin]; ?> -
                                    </option><?php combo_enum('data_member', 'jenis_kelamin', ''); ?>
                                </select>

                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Tanggal&nbsp;Terdaftar <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class='form-control' required="required" type="date" name="tanggal_terdaftar"
                                    id="tanggal_terdaftar" placeholder="Tanggal&nbsp;Terdaftar"
                                    value="<?php echo ($data['tanggal_terdaftar']); ?>">


                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Id&nbsp;Kategori&nbsp;Member <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <!-- -->
                                <select class='form-control' data-live-search='true' required="required" type="text"
                                    name="id_kategori_member" id="id_kategori_member"
                                    placeholder="Id&nbsp;Kategori&nbsp;Member"
                                    value="<?php echo ($data['id_kategori_member']); ?>">
                                    <option value='<?php echo $data[id_kategori_member]; ?>'>
                                        - <?php echo $data[id_kategori_member]; ?> -
                                    </option><?php combo_database_v2('data_kategori_member', 'id_kategori_member', 'kategori_member', ''); ?>
                                </select>

                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Kode&nbsp;Rfid <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class='form-control' required="required" type="text" name="kode_rfid" id="kode_rfid"
                                    placeholder="Kode&nbsp;Rfid" value="<?php echo ($data['kode_rfid']); ?>">


                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>password Lama<span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class='form-control' type="" name="password_lama" id="password_lama"
                                    placeholder="password lama" value="">
                                <input type="hidden" name="password_validasi" id="password_validasi"
                                    placeholder="password_validasi" value="<?php echo encrypt($data['password']); ?>">
                                <br>Masukkan password Lama untuk Validasi, Kosongkan jika tidak ingin mengganti password
                            </td>
                        </tr>

                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>password Baru<span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class='form-control' type="" name="password" id="password" placeholder="password baru"
                                    value="">
                                <br>Kosongkan jika tidak ingin mengganti password
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Tanggal&nbsp;Lahir <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class='form-control' required="required" type="date" name="tanggal_lahir" id="tanggal_lahir"
                                    placeholder="Tanggal&nbsp;Lahir" value="<?php echo ($data['tanggal_lahir']); ?>">


                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Agama <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class="form-control" name="agama">
                                    <option value="<?= $data['agama']; ?>"><?= $data['agama']; ?></option>
                                    <?php
                                    combo_enum('data_member', 'agama', '')
                                    ?>

                                </select>


                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Status&nbsp;Perkawinan <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select name="status_perkawinan" class="form-control">
                                    <option value="<?= $data['status_perkawinan']; ?>"><?= $data['status_perkawinan']; ?></option>
                                    <?php
                                    combo_enum('data_member', 'status_perkawinan', '')
                                    ?>

                                </select>


                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Pekerjaan <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>

                            <td>
                                <select name="pekerjaan" id="pekerjaan" class="form-control">
                                    <option <?= $data['pekerjaan'] == 'ASN' ? 'selected' : '' ?>>ASN</option>
                                    <option <?= $data['pekerjaan'] == 'Enterpreneur' ? 'selected' : '' ?>>Enterpreneur</option>
                                    <option <?= $data['pekerjaan'] == 'Aparat Sipil' ? 'selected' : '' ?>>Aparat Sipil</option>
                                    <option <?= $data['pekerjaan'] == 'Tenaga Pengajar' ? 'selected' : '' ?>>Tenaga Pengajar</option>
                                    <option <?= $data['pekerjaan'] == 'Wiraswasta' ? 'selected' : '' ?>>Wiraswasta</option>
                                    <option <?= $data['pekerjaan'] == 'Pelajar' ? 'selected' : '' ?>>Pelajar</option>
                                    <option <?= $data['pekerjaan'] == 'Tenaga Keseluruhan' ? 'selected' : '' ?>>Tenaga Keseluruhan</option>
                                    <option <?= $data['pekerjaan'] == 'Konsultan' ? 'selected' : '' ?>>Konsultan</option>
                                    <option <?= $data['pekerjaan'] == 'Pemuka Agama' ? 'selected' : '' ?>>Pemuka Agama</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Username <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class='form-control' required="required" type="text" name="username" id="username"
                                    placeholder="Username" value="<?php echo ($data['username']); ?>">


                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Point <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class='form-control' required="required" type="number" name="point" id="point"
                                    placeholder="Point" value="<?php echo ($data['point']); ?>">


                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>SPBU <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <select class='form-control' type="text" name="spbu" id="spbu" placeholder="spbu"
                                    required="required">
                                    <option value="spbu"><?php echo $data['spbu'] ?></option>
                                    <?php combo_database("data_spbu", "nama_spbu", ""); ?>
                                </select>



                            </td>
                        </tr>

                        <?php $jenenge = decrypt($_COOKIE['jenenge']) ?>
                        <input type="hidden" name="id_admin"
                            value="<?= baca_database('data_admin', 'id_admin', "select id_admin from data_admin where username='$jenenge'"); ?>">

                    </tbody>
                </table>
                <div class="content-box-content">
                    <center>
                        <?php btn_update(' UPDATE'); ?>
                    </center>
                </div>
            </div>
        </div>
    </form>