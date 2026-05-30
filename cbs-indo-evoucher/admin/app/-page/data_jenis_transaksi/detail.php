
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
            $sql = mysql_query("SELECT * FROM data_jenis_transaksi where id_jenis_transaksi = '$proses'");
            $data = mysql_fetch_array($sql);
            ?>
           <!--h
            <tr>
                <td class="clleft" width="25%">Id Jenis Transaksi </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['id_jenis_transaksi']; ?></td>	
            </tr>
           h-->

            <tr>
                <td class="clleft" width="25%">Jenis Transaksi </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['jenis_transaksi']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Gambar Logo </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft">
                  <a href="../../../../admin/upload/<?php echo $data['gambar_logo']; ?>"><img onerror="this.src='../../../data/image/error/file.png'" width="100"  src="../../../../admin/upload/<?php echo $data['gambar_logo']; ?>"></a>
                    <br>
                  <?php echo $data['gambar_logo']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Point </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['point']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Harga </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['harga']; ?></td>
            </tr>




            </tbody>
        </table>
    </div>
</div>
