
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
            $sql = mysql_query("SELECT * FROM data_penjualan_voucher where id_penjualan = '$proses'");
            $data = mysql_fetch_array($sql);
            ?>
           <!--h
            <tr>
                <td class="clleft" width="25%">Id Penjualan </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['id_penjualan']; ?></td>	
            </tr>
           h-->

            <tr>
                <td class="clleft" width="25%">Nama </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo baca_database("","nama","select * from data_relasi where id_relasi='$data[id_relasi]'")  ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Tanggal Penjualan </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['tanggal_penjualan']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Jumlah Voucher </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['jumlah_voucher']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Nominal </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['nominal']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Password Voucher </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['password_voucher']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Tanggal Dibuka </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['tanggal_dibuka']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Sub Total </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['sub_total']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Persentase Ppn </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['persentase_ppn']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Ppn </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['ppn']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Total Bayar </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['total_bayar']; ?></td>
            </tr>




            </tbody>
        </table>
    </div>
</div>
