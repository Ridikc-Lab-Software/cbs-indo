
<div class="content-box">
<h5><i class="fa fa-database"></i> Detail Data harga transaksi </h5>
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
            $sql = mysql_query("SELECT * FROM data_harga_transaksi where id_harga_transaksi = '$proses'");
            $data = mysql_fetch_array($sql);
            ?>
           <!--h
            <tr>
                <td class="clleft" width="25%">Id harga transaksi </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['id_harga_transaksi']; ?></td>	
            </tr>
           h-->

							<tr>
    <td class="clleft" width="25%">Tanggal </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo baca_database("","tanggal","select * from data_transaksi where id_transaksi='$data[id_transaksi]'")  ?></td>
</tr>

            				<tr>
    <td class="clleft" width="25%">Jenis Transaksi </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo baca_database("","jenis_transaksi","select * from data_jenis_transaksi where id_jenis_transaksi='$data[id_jenis_transaksi]'")  ?></td>
</tr>

            				<tr>
    <td class="clleft" width="25%">Jenis transaksi </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo $data['jenis_transaksi']; ?></td>
</tr>
            				<tr>
    <td class="clleft" width="25%">Point </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo $data['point']; ?></td>
</tr>
            				<tr>
    <td class="clleft" width="25%">Harga </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo rupiah($data['harga']); ?></td>
</tr>
            
            </tbody>
        </table>
    </div>
              <a href="<?php index(); ?>"> <?php btn_kembali(' Kembali'); ?></a>
</div>
