<a href="<?php index(); ?>">
    <?php btn_kembali(' KEMBALI'); ?>
</a>

<br><br>

<div class="content-box">
    <div class="content-box-header" style="height: 39px">Tambah<h3></h3>
    </div>
    <form action="proses_simpan.php" enctype="multipart/form-data" method="post">
        <div class="content-box-content">
            <div id="postcustom">
                <table <?php tabel_in(100, '%', 0, 'center'); ?>>
                    <tbody>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>id&nbsp;petugas <span class="highlight">*</span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input type="readonly" readonly
                                    value="<?php echo id_otomatis("data_petugas", "id_petugas", "10"); ?>"
                                    name="id_petugas" placeholder="id_petugas" id="id_petugas" required="required">
                            </td>
                        </tr>

                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Nama <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input onkeypress='return h(event)' class='form-control' type="text" name="nama" id="nama"
                                    placeholder="Nama" required="required">


                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Alamat <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <textarea class='form-control' type="text" name="alamat" id="alamat" placeholder="Alamat" required="required">

</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>No&nbsp;Telepon <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input onkeypress='return a(event)' class='form-control' type="text" name="no_telepon" id="no_telepon"
                                    placeholder="No&nbsp;Telepon" required="required">


                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Jenis&nbsp;Kelamin <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class='form-control' type="text" name="jenis_kelamin" id="jenis_kelamin"
                                    placeholder="Jenis&nbsp;Kelamin" required="required">


                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Username <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class='form-control' type="text" name="username" id="username" placeholder="Username"
                                    required="required">


                            </td>
                        </tr>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>Password <span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class='form-control' type="text" name="password" id="password" placeholder="Password"
                                    required="required">


                            </td>
                        </tr>


                        <?php $jenenge = decrypt($_COOKIE['jenenge']) ?>
                        <input type="hidden" name="nama_spbu" value="<?= baca_database('data_admin', 'nama_spbu', "select nama_spbu from data_admin where username='$jenenge'"); ?>">

                    </tbody>
                </table>
                <div class="content-box-content">
                    <center>
                        <?php btn_simpan(' SIMPAN'); ?>
                    </center>
                </div>
            </div>
        </div>
    </form>