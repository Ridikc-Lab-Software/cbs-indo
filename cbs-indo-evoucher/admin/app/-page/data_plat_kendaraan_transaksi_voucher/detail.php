
<div class="content-box">
<h5><i class="fa fa-database"></i> Detail Data plat kendaraan transaksi voucher </h5>
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
            $sql = mysql_query("SELECT * FROM data_plat_kendaraan_transaksi_voucher where id_plat_kendaraan_transaksi_voucher = '$proses'");
            $data = mysql_fetch_array($sql);
            ?>
           <!--h
            <tr>
                <td class="clleft" width="25%">Id plat kendaraan transaksi voucher </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['id_plat_kendaraan_transaksi_voucher']; ?></td>	
            </tr>
           h-->

							<tr>
    <td class="clleft" width="25%">Id Voucher </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo baca_database("","id_voucher","select * from data_transaksi_voucher where id_transaksi_voucher='$data[id_transaksi_voucher]'")  ?></td>
</tr>

            				<tr>
    <td class="clleft" width="25%">No plat kendaraan </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo $data['no_plat_kendaraan']; ?></td>
</tr>
            				<tr>
    <td class="clleft" width="25%">Nama Supir </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo baca_database("","nama_supir","select * from data_supir where id_supir='$data[id_supir]'")  ?></td>
</tr>

            				<tr>
    <td class="clleft" width="25%">Nama </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo baca_database("","nama","select * from data_relasi where id_relasi='$data[id_relasi]'")  ?></td>
</tr>

            				<tr>
    <td class="clleft" width="25%">Foto </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><a target="_blank" href="../../../../admin/upload/<?php echo $data['foto']; ?>"><img onerror="this.src='../../../data/image/error/file.png'" width="50" height="30" src="../../../../admin/upload/<?php echo $data['foto']; ?>"></a></td>
</tr>
            
            </tbody>
        </table>
    </div>
              <a href="<?php index(); ?>"> <?php btn_kembali(' Kembali'); ?></a>
</div>
