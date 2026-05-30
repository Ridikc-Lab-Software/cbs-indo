
<div class="content-box">
<h5><i class="fa fa-database"></i> Detail Data nominal </h5>
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
            $sql = mysql_query("SELECT * FROM data_nominal where id_nominal = '$proses'");
            $data = mysql_fetch_array($sql);
            ?>
           <!--h
            <tr>
                <td class="clleft" width="25%">Id nominal </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['id_nominal']; ?></td>	
            </tr>
           h-->

							<tr>
    <td class="clleft" width="25%">Nominal </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo rupiah($data['nominal']); ?></td>
</tr>
            
            </tbody>
        </table>
    </div>
              <a href="<?php index(); ?>"> <?php btn_kembali(' Kembali'); ?></a>
</div>
