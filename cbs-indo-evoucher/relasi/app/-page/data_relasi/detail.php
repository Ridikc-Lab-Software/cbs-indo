
<a href="<?php index(); ?>">
    <?php btn_kembali(' KEMBALI'); ?>
</a>

<br><br>

<div class="content-box">
    <div class="content-box-content">
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
                <td class="clleft" width="25%">Id Relasi </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['id_relasi']; ?></td>	
            </tr>
           h-->

            <tr>
                <td class="clleft" width="25%">Nama </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['nama']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Nomor Telepon </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['nomor_telepon']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Email </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['email']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Alamat </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['alamat']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Nama Spbu </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo baca_database("","nama_spbu","select * from data_spbu where id_spbu='$data[id_spbu]'")  ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Nama Spbu </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['nama_spbu']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Password </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['password']; ?></td>
            </tr>




            </tbody>
        </table>
    </div>
</div>
