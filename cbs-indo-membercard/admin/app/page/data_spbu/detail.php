
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
            $sql = mysql_query("SELECT * FROM data_spbu where id_spbu = '$proses'");
            $data = mysql_fetch_array($sql);
            ?>
           <!--h
            <tr>
                <td class="clleft" width="25%">Id Spbu </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['id_spbu']; ?></td>	
            </tr>
           h-->

            <tr>
                <td class="clleft" width="25%">Nama Spbu </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['nama_spbu']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Alamat1 </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['alamat1']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Alamat2 </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['alamat2']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Telepon </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['telepon']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Penutup </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['penutup']; ?></td>
            </tr>




            </tbody>
        </table>
    </div>
</div>
