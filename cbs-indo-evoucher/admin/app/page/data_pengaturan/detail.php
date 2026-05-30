
<div class="content-box">
<h5><i class="fa fa-database"></i> Detail Data pengaturan </h5>
<br>
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
            $sql = mysql_query("SELECT * FROM data_pengaturan where id_pengaturan = '$proses'");
            $data = mysql_fetch_array($sql);
            ?>
           <!--h
            <tr>
                <td class="clleft" width="25%">Id pengaturan </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['id_pengaturan']; ?></td>	
            </tr>
           h-->

							<tr>
    <td class="clleft" width="25%">Nama </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo $data['nama']; ?></td>
</tr>
            				<tr>
    <td class="clleft" width="25%">Value </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo readmore($data['value']); ?></td>
</tr>
            
            </tbody>
        </table>
    </div>
              <a href="<?php index(); ?>"> <?php btn_kembali(' Kembali'); ?></a>
</div>
