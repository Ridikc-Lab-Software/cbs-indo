
<div class="content-box">
<h5><i class="fa fa-database"></i> Detail Data shift </h5>
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
            $sql = mysql_query("SELECT * FROM data_shift where id_shift = '$proses'");
            $data = mysql_fetch_array($sql);
            ?>
           <!--h
            <tr>
                <td class="clleft" width="25%">Id shift </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['id_shift']; ?></td>	
            </tr>
           h-->

							<tr>
    <td class="clleft" width="25%">Shift </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo $data['shift']; ?></td>
</tr>
            				<tr>
    <td class="clleft" width="25%">Jam mulai </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo format_indo($data['jam_mulai']); ?></td>
</tr>
            				<tr>
    <td class="clleft" width="25%">Jam selesai </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo format_indo($data['jam_selesai']); ?></td>
</tr>
            
            </tbody>
        </table>
    </div>
              <a href="<?php index(); ?>"> <?php btn_kembali(' Kembali'); ?></a>
</div>
