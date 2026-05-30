
<div class="content-box">
<h5><i class="fa fa-database"></i> Detail Data sisa voucher </h5>
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
            $sql = mysql_query("SELECT * FROM data_sisa_voucher where id_sisa_voucher = '$proses'");
            $data = mysql_fetch_array($sql);
            ?>
           <!--h
            <tr>
                <td class="clleft" width="25%">Id sisa voucher </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['id_sisa_voucher']; ?></td>	
            </tr>
           h-->

							<tr>
    <td class="clleft" width="25%">Qrcode </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo baca_database("","qrcode","select * from data_voucher where id_voucher='$data[id_voucher]'")  ?></td>
</tr>

            				<tr>
    <td class="clleft" width="25%">Nama </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo baca_database("","nama","select * from data_relasi where id_relasi='$data[id_relasi]'")  ?></td>
</tr>

            				<tr>
    <td class="clleft" width="25%">Nominal voucher </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo rupiah($data['nominal_voucher']); ?></td>
</tr>
            				<tr>
    <td class="clleft" width="25%">Nominal transaksi </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo rupiah($data['nominal_transaksi']); ?></td>
</tr>
            				<tr>
    <td class="clleft" width="25%">Nominal sisa </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo rupiah($data['nominal_sisa']); ?></td>
</tr>
            				<tr>
    <td class="clleft" width="25%">Tanggal transaksi </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo format_indo($data['tanggal_transaksi']); ?></td>
</tr>
            				<tr>
    <td class="clleft" width="25%">Status </td>
    <td class="clleft" width="2%">:</td>
    <td class="clleft"><?php echo $data['status']; ?></td>
</tr>
            
            </tbody>
        </table>
    </div>
              <a href="<?php index(); ?>"> <?php btn_kembali(' Kembali'); ?></a>
</div>
