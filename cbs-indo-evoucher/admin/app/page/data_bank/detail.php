
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
            $sql = mysql_query("SELECT * FROM data_bank where id_bank = '$proses'");
            $data = mysql_fetch_array($sql);
            ?>
           <!--h
            <tr>
                <td class="clleft" width="25%">Id Bank </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['id_bank']; ?></td>	
            </tr>
           h-->

            <tr>
                <td class="clleft" width="25%">Nama Bank </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['nama_bank']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Nomor Rekening </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['nomor_rekening']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Atas Nama </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['atas_nama']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Gambar </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft">
                  <a href="../../../../admin/upload/<?php echo $data['gambar']; ?>"><img onerror="this.src='../../../data/image/error/file.png'" width="100"  src="../../../../admin/upload/<?php echo $data['gambar']; ?>"></a>
                    <br>
                  <?php echo $data['gambar']; ?></td>
            </tr>




            </tbody>
        </table>
    </div>
</div>
