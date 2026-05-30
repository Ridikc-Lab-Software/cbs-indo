
<div class="content-box">
<h5><i class="fa fa-database"></i> Detail Data admin </h5>
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
            $sql = mysql_query("SELECT * FROM data_admin where id_admin = '$proses'");
            $data = mysql_fetch_array($sql);
            ?>
           <!--h
            <tr>
                <td class="clleft" width="25%">Id admin </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['id_admin']; ?></td>	
            </tr>
           h-->

							<tr>
    <td class="clleft" width="25%">Hak akses </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo $data['hak_akses']; ?></td>
</tr>
            				<tr>
    <td class="clleft" width="25%">Username </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo $data['username']; ?></td>
</tr>
            				<tr>
    <td class="clleft" width="25%">Password </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo $data['password']; ?></td>
</tr>
            				<tr>
    <td class="clleft" width="25%">Nama spbu </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo $data['nama_spbu']; ?></td>
</tr>
            				<tr>
    <td class="clleft" width="25%">Nama </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo $data['nama']; ?></td>
</tr>
            				<tr>
    <td class="clleft" width="25%">Jabatan </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo $data['jabatan']; ?></td>
</tr>
            				<tr>
    <td class="clleft" width="25%">Foto tanda tangan </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><a target="_blank" href="../../../../admin/upload/<?php echo $data['foto_tanda_tangan']; ?>"><img onerror="this.src='../../../data/image/error/file.png'" width="50" height="30" src="../../../../admin/upload/<?php echo $data['foto_tanda_tangan']; ?>"></a></td>
</tr>
            
            </tbody>
        </table>
    </div>
              <a href="<?php index(); ?>"> <?php btn_kembali(' Kembali'); ?></a>
</div>
