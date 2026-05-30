<div class="content-box">
    <div class="content-box-header" style="height: 39px">Ganti Password<h3></h3>
    </div>
    <form action="proses_update.php" enctype="multipart/form-data" method="post">
        <div class="content-box-content">
            <div id="postcustom">
                <table <?php tabel_in(100, '%', 0, 'center'); ?>>
                    <tbody>
                        <?php


                        $proses = (($_COOKIE['admin']));
                        $sql = mysql_query("SELECT * FROM data_admin where id_admin = '$proses'");
                        $data = mysql_fetch_array($sql);
                        ?>

                        <input type="hidden" name="id_admin" value="<?php echo $data['id_admin']; ?>"
                            readonly id="id_admin" required="required">



                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>password Lama<span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td> Masukkan password Lama untuk Validasi
                                <input class='form-control' type="password" name="password_lama" id="password_lama"
                                    placeholder="password lama" value="">
                                <input type="hidden" name="password_validasi" id="password_validasi"
                                    placeholder="password_validasi" value="<?php echo encrypt($data['password']); ?>">
                                <br>
                            </td>
                        </tr>

                        <tr>
                            <td width="25%" class="leftrowcms">
                                <label>password Baru<span class="highlight"></span></label>
                            </td>
                            <td width="2%">:</td>
                            <td>
                                <input class='form-control' type="password" name="password" id="password" placeholder="password baru"
                                    value="">

                            </td>
                        </tr>



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