
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
            $sql = mysql_query("SELECT * FROM data_log_activity where id_log_activity = '$proses'");
            $data = mysql_fetch_array($sql);
            ?>
           <!--h
            <tr>
                <td class="clleft" width="25%">Id Log Activity </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['id_log_activity']; ?></td>	
            </tr>
           h-->

            <tr>
                <td class="clleft" width="25%">Waktu </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['waktu']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Kategori </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['kategori']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Deskripsi </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['deskripsi']; ?></td>
            </tr>




            </tbody>
        </table>
    </div>
</div>
