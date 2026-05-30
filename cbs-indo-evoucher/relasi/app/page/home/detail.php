
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
            $sql = mysql_query("SELECT * FROM data_voucher where id_voucher = '$proses'");
            $data = mysql_fetch_array($sql);
            ?>
          

            <tr>
                <td class="clleft" width="25%">Qrcode </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['qrcode']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Nama </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo baca_database("","nama","select * from data_relasi where id_relasi='$data[id_relasi]'")  ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Nominal </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['nominal']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Tanggal Kadaluarsa </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['tanggal_kadaluarsa']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Nama Spbu </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo baca_database("","nama_spbu","select * from data_spbu where id_spbu='$data[id_spbu]'")  ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Id Relasi </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo baca_database("","id_relasi","select * from data_penjualan_voucher where id_penjualan='$data[id_penjualan]'")  ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Status </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['status']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">File Voucher </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft">
                  <a href="../../../../admin/upload/<?php echo $data['file_voucher']; ?>"><img onerror="this.src='../../../data/image/error/file.png'" width="100"  src="../../../../admin/upload/<?php echo $data['file_voucher']; ?>"></a>
                    <br>
                  <?php echo $data['file_voucher']; ?></td>
            </tr>
            <tr>
                <td class="clleft" width="25%">Tanggal Dibuka </td>
                <td class="clleft" width="2%">:</td>
                <td class="clleft"><?php echo $data['tanggal_dibuka']; ?></td>
            </tr>




            </tbody>
        </table>
    </div>
</div>
