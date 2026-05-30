
<div class="content-box">
<h5><i class="fa fa-database"></i> Detail Data supir </h5>
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
            $sql = mysql_query("SELECT * FROM data_supir where id_supir = '$proses'");
            $data = mysql_fetch_array($sql);
            ?>
           <!--h
            <tr>
                <td class="clleft" width="25%">Id supir </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['id_supir']; ?></td>	
            </tr>
           h-->

							<tr>
    <td class="clleft" width="25%">Nama supir </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo $data['nama_supir']; ?></td>
</tr>
            				<tr>
    <td class="clleft" width="25%">Nama </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo baca_database("","nama","select * from data_relasi where id_relasi='$data[id_relasi]'")  ?></td>
</tr>

            
            </tbody>
        </table>
    </div>
              <a href="<?php index(); ?>"> <?php btn_kembali(' Kembali'); ?></a>
</div>
