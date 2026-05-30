<a href="<?php index(); ?>">
    <?php btn_kembali(' KEMBALI'); ?>
</a>

<br><br>
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
                $sql = mysql_query("SELECT * FROM data_member where id_member = '$proses'");
                $data = mysql_fetch_array($sql);

                $qrcode = "http://membercard.cbs-indo.com/index.php?p=login&code=".encrypt($data['id_member']);
                ?>
<div class="content-box">
    <div class="content-box-header" style="height: 39px">Detail
        <h3 style="cursor: s-resize;"></h3>
    </div>
    <div class="content-box-content">
        <table <?php tabel_in(100, '%', 0, 'center'); ?>>
            <tbody>
                <tr class="event3">
                    <td class="clleft" colspan="3">
                        
                          <a target="_blank"
       href="https://api.qrserver.com/v1/create-qr-code/?size=500x500&data=<?= urlencode($qrcode ); ?>">
        <img 
            src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=<?= urlencode($qrcode ); ?>"
            alt="QR <?= $data['id_petugas']; ?>"
        >
    </a>

    <br>
                    </td>
                </tr>
                
                <tr>
                    <td class="clleft" width="25%">id&nbsp;member</td>
                    <td class="clleft" width="2%">:</td>
                    <td class="clleft"><?php echo ($data['id_member']); ?>
                
                
              

</td>
                </tr>

                <tr>
                    <td class="clleft" width="25%">Nik</td>
                    <td class="clleft" width="2%">:</td>
                    <td class="clleft"><?php echo $data['nik']; ?></td>
                </tr>
                <tr>
                    <td class="clleft" width="25%">Nama</td>
                    <td class="clleft" width="2%">:</td>
                    <td class="clleft"><?php echo $data['nama']; ?></td>
                </tr>
                <tr>
                    <td class="clleft" width="25%">Alamat</td>
                    <td class="clleft" width="2%">:</td>
                    <td class="clleft"><?php echo $data['alamat']; ?></td>
                </tr>
                <tr>
                    <td class="clleft" width="25%">No&nbsp;telepon</td>
                    <td class="clleft" width="2%">:</td>
                    <td class="clleft"><?php echo $data['no_telepon']; ?></td>
                </tr>
                <tr>
                    <td class="clleft" width="25%">Jenis&nbsp;kelamin</td>
                    <td class="clleft" width="2%">:</td>
                    <td class="clleft"><?php echo $data['jenis_kelamin']; ?></td>
                </tr>
                <tr>
                    <td class="clleft" width="25%">Tanggal&nbsp;terdaftar</td>
                    <td class="clleft" width="2%">:</td>
                    <td class="clleft"><?php echo (format_indo($data['tanggal_terdaftar'])); ?></td>
                </tr>

                <tr>
                    <td class="clleft" width="25%">Kategori Member</td>
                    <td class="clleft" width="2%">:</td>
                    <td class="clleft"><?php echo baca_database("", "kategori_member", " select * from data_kategori_member where id_kategori_member ='$data[id_kategori_member]'") ?></td>
                </tr>
                <tr>
                    <td class="clleft" width="25%">Kode&nbsp;rfid</td>
                    <td class="clleft" width="2%">:</td>
                    <td class="clleft"><?php echo $data['kode_rfid']; ?></td>
                </tr>
                <tr>
                    <td class="clleft" width="25%">Password</td>
                    <td class="clleft" width="2%">:</td>
                    <td class="clleft"><?php echo $data['password']; ?></td>
                </tr>
                <tr>
                    <td class="clleft" width="25%">Tanggal&nbsp;lahir</td>
                    <td class="clleft" width="2%">:</td>
                    <td class="clleft"><?php echo (format_indo($data['tanggal_lahir'])); ?></td>
                </tr>
                <tr>
                    <td class="clleft" width="25%">Agama</td>
                    <td class="clleft" width="2%">:</td>
                    <td class="clleft"><?php echo $data['agama']; ?></td>
                </tr>

                <tr>
                    <td class="clleft" width="25%">Pekerjaan</td>
                    <td class="clleft" width="2%">:</td>
                    <td class="clleft"><?php echo $data['pekerjaan']; ?></td>
                </tr>
                <tr>
                    <td class="clleft" width="25%">Username</td>
                    <td class="clleft" width="2%">:</td>
                    <td class="clleft"><?php echo $data['username']; ?></td>
                </tr>
                <tr>
                    <td class="clleft" width="25%">Point</td>
                    <td class="clleft" width="2%">:</td>
                    <td class="clleft"><?php echo $data['point']; ?></td>
                </tr>

                <tr>
                    <td class="clleft" width="25%">Nama SPBU</td>
                    <td class="clleft" width="2%">:</td>

                    <?php

                    $username = decrypt($_COOKIE['jenenge']);
                    $spbu = baca_database('data_admin', 'nama_spbu', "select nama_spbu from data_admin where username='$username'");

                    ?>

                    <td class="clleft"><?php echo $spbu; ?></td>
                </tr>


            </tbody>
        </table>



    </div>
</div>


<a href="<?php index(); ?>?input=detail&proses=<?= encrypt($data['id_member']); ?>">
    <?php btn_detail('Detail'); ?></a>

<a href="<?php index(); ?>?input=edit&proses=<?= encrypt($data['id_member']); ?>">
    <?php btn_edit('Edit'); ?></a>

<?php
$hak_akses = decrypt($_COOKIE['hak_akses']);
if ($hak_akses == 'manager') { ?>



    <a href="<?php index(); ?>?input=hapus&proses=<?= encrypt($data['id_member']); ?>">
        <?php btn_hapus('Hapus'); ?></a>

<?php } ?>

<a href="../data_transaksi/index.php?input=tampil&Berdasarkan=id_member&isi=<?= $data['id_member']; ?>">
    <button type="submit"
        class="btn btn-success">
        Riwayat Transaksi
    </button>
</a>

<a href="../data_redeem/index.php?input=tampil&Berdasarkan=id_member&isi=<?= $data['id_member']; ?>">
    <button type="submit"
        class="btn btn-success">
        Riwayat Redeem
    </button>
</a>