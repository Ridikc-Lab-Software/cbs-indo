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
                        $sql = mysql_query("SELECT * FROM data_petugas where id_petugas = '$proses'");
                        $data = mysql_fetch_array($sql);
                        ?>
                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>id&nbsp;petugas <font color="red">*</font></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input type="%typepertama%" name="id_petugas" value="<?php echo $data['id_petugas']; ?>"
                                    readonly id="id_petugas" required="required">
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
                                <input class='form-control' required="required" type="text" name="jenis_kelamin" id="jenis_kelamin"
                                    placeholder="Jenis&nbsp;Kelamin" value="<?php echo ($data['jenis_kelamin']); ?>">


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
                                <label>password Lama<span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class='form-control' type="password" name="password_lama" id="password_lama"
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
                                <input class='form-control' type="text" name="password" id="password" placeholder="password baru"
                                    value="">
                                <br>Kosongkan jika tidak ingin mengganti password
                            </td>
                        </tr>

                        <?php

                        $username = decrypt($_COOKIE['jenenge']);
                        $spbu = baca_database('data_admin', 'nama_spbu', "select nama_spbu from data_admin where username='$username'");

                        ?>

                        <input type="hidden" name="nama_spbu" value="<?= $spbu; ?>">

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