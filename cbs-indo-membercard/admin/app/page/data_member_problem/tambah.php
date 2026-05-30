<a href="<?php index(); ?>">
    <?php btn_kembali(' KEMBALI'); ?>
</a>
<br>
<br>

<form action="proses_simpan.php" enctype="multipart/form-data" method="post">
    <div class="content-box-content">
        <div id="postcustom">

            <div class="row-fluid">
                <div class="span6">
                    <div class="content-widgets gray">
                        <div class="widget-head magenta">
                            <h3>Pendaftaran Baru</h3>
                        </div>
                        <div class="widget-container">

                            <table <?php tabel_in(100, '%', 0, 'center'); ?>>
                                <tbody>
                                    <tr>
                                        <td width="25%" class="leftrowcms">
                                            <label>id&nbsp;member <span class="highlight">*</span></label>
                                        </td>
                                        <td width="2%">:</td>
                                        <td>
                                            <input type="readonly" readonly
                                                value="<?php echo id_otomatis("data_member", "id_member", "10"); ?>"
                                                name="id_member" placeholder="id_member" id="id_member"
                                                required="required">
                                        </td>
                                    </tr>

                                    <tr>
                                        <td width="25%" class="leftrowcms">
                                            <label>Nik <span class="highlight"></span></label>
                                        </td>
                                        <td width="2%">:</td>
                                        <td>
                                            <input class='form-control' type="text" name="nik" id="nik" placeholder="Nik"
                                                required="required">


                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%" class="leftrowcms">
                                            <label>Nama <span class="highlight"></span></label>
                                        </td>
                                        <td width="2%">:</td>
                                        <td>
                                            <input onkeypress='return h(event)' class='form-control' type="text" onkeyup="this.value = this.value.toUpperCase()" name="nama" id="nama"
                                                placeholder="Nama" required="required">


                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%" class="leftrowcms">
                                            <label>Alamat <span class="highlight"></span></label>
                                        </td>
                                        <td width="2%">:</td>
                                        <td>
                                            <textarea class='form-control' type="text" onkeyup="this.value = this.value.toUpperCase()" name="alamat" id="alamat" placeholder="Alamat" required="required">

</textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%" class="leftrowcms">
                                            <label>No&nbsp;Telepon <span class="highlight"></span></label>
                                        </td>
                                        <td width="2%">:</td>
                                        <td>
                                            <input onkeypress='return a(event)' class='form-control' type="text" name="no_telepon"
                                                id="no_telepon" placeholder="No&nbsp;Telepon" required="required">


                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%" class="leftrowcms">
                                            <label>Jenis&nbsp;Kelamin <span class="highlight"></span></label>
                                        </td>
                                        <td width="2%">:</td>
                                        <td>

                                            <select class='form-control' data-live-search='true' type="enum"
                                                name="jenis_kelamin" id="jenis_kelamin" placeholder="Jenis&nbsp;Kelamin"
                                                required="required">
                                                <option></option><?php combo_enum('data_member', 'jenis_kelamin', ''); ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%" class="leftrowcms">
                                            <label>Tanggal&nbsp;Terdaftar <span class="highlight"></span></label>
                                        </td>
                                        <td width="2%">:</td>
                                        <td>
                                            <input class='form-control' value="<?php echo tanggal_otomatis(); ?>" type="date"
                                                name="tanggal_terdaftar" id="tanggal_terdaftar"
                                                placeholder="Tanggal&nbsp;Terdaftar" required="required">


                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%" class="leftrowcms">
                                            <label>Kategori&nbsp;Member <span class="highlight"></span></label>
                                        </td>
                                        <td width="2%">:</td>
                                        <td>

                                            <select class='form-control' data-live-search='true' type="text"
                                                name="id_kategori_member" id="id_kategori_member"
                                                placeholder="Id&nbsp;Kategori&nbsp;Member" required="required">
                                                <option></option><?php combo_database_v2('data_kategori_member', 'id_kategori_member', 'kategori_member', ''); ?>
                                            </select>
                                        </td>
                                    </tr>


                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div>
                    </div>
                </div>
                <div class="span6">
                    <div class="content-widgets gray">
                        <div class="widget-head magenta">
                            <h3>Pendaftaran Baru</h3>
                        </div>
                        <div class="widget-container">

                            <table <?php tabel_in(100, '%', 0, 'center'); ?>>

                                <tr>
                                    <td width="25%" class="leftrowcms">
                                        <label>Kode&nbsp;Rfid <span class="highlight"></span></label>
                                    </td>
                                    <td width="2%">:</td>
                                    <td>
                                        <input class='form-control' type="text" name="kode_rfid" id="kode_rfid"
                                            placeholder="Kode&nbsp;Rfid" required="required">


                                    </td>
                                </tr>
                                <tr>
                                    <td width="25%" class="leftrowcms">
                                        <label>Password <span class="highlight"></span></label>
                                    </td>
                                    <td width="2%">:</td>
                                    <td>
                                        <input class='form-control' type="" name="password" id="password" value='123456'
                                            placeholder="Password" required="required">

                                    </td>
                                </tr>
                                <tr>
                                    <td width="25%" class="leftrowcms">
                                        <label>Tanggal&nbsp;Lahir <span class="highlight"></span></label>
                                    </td>
                                    <td width="2%">:</td>
                                    <td>
                                        <input class='form-control' value="<?php echo tanggal_otomatis(); ?>" type="date"
                                            name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal&nbsp;Lahir"
                                            required="required">


                                    </td>
                                </tr>
                                <tr>
                                    <td width="25%" class="leftrowcms">
                                        <label>Agama <span class="highlight"></span></label>
                                    </td>
                                    <td width="2%">:</td>
                                    <td>
                                        <select class="form-control" name="agama">
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
                                            <option>ASN</option>
                                            <option>Enterpreneur</option>
                                            <option>Aparat Sipil</option>
                                            <option>Tenaga Pengajar</option>
                                            <option>Wiraswasta</option>
                                            <option>Pelajar</option>
                                            <option>Tenaga Kesehatan</option>
                                            <option>Konsultan</option>
                                            <option>Pemuka Agama</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="25%" class="leftrowcms">
                                        <label>Username <span class="highlight"></span></label>
                                    </td>
                                    <td width="2%">:</td>
                                    <td>
                                        <input class='form-control' onkeyup="this.value = this.value.toUpperCase()" type="text" name="username" id="username" placeholder="Username"> <br>Jika dikosongkan username otomatis No Telepon


                                    </td>
                                </tr>
                                <tr>
                                    <td width="25%" class="leftrowcms">
                                        <label>Point <span class="highlight"></span></label>
                                    </td>
                                    <td width="2%">:</td>
                                    <td>
                                        <input class='form-control' type="text" name="point" id="point" placeholder="Point"
                                            required="required">


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
                                            <?php combo_database("data_spbu", "nama_spbu", ""); ?>
                                        </select>


                                    </td>
                                </tr>


                                <?php $jenenge = decrypt($_COOKIE['jenenge']) ?>
                                <input type="hidden" name="id_admin" value="<?= baca_database('data_admin', 'id_admin', "select id_admin from data_admin where username='$jenenge'"); ?>">

                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <div class="content-box-content">
                <center>
                    <?php btn_simpan(' PROSES SIMPAN PENDAFTARAN'); ?>
                </center>
            </div>
        </div>
    </div>
</form>