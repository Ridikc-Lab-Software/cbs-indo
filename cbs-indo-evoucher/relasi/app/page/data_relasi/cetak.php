<?php
if (isset($_GET['input'])) {
    echo "<h3> Cetak Laporan ";
    tabelnomin();
    echo "</h3>";
    ?>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">
    <?php
    action_cetak("data_relasi");
} else {

    function location()
    {
        return "cetak";
    }

    include '../../../include/all_include.php';
    proses_action_cetak("data_relasi");
    ?>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">


    
    <!-- HEADER -->
    <table border="0" style="width: 100%">
        <?php
        if (isset($_GET['export'])) {
        } else {
            ?>
            <tr>
                <td class="auto-style1" rowspan="3" width="101">
                    <img alt="" height="100" src="<?php echo $logo_laporan1; ?>" width="100">
                </td>

                <td class="auto-style1">
                    <center>
                        <strong>
                        PT. CAHAYA BUNGO SARKOPALMA
                    </strong>
                    </center>
                </td>

                <td class="auto-style1" rowspan="3" width="101">
                    <img alt="" height="100" src="<?php echo $logo_laporan2; ?>" width="100">
                </td>
            </tr>
        <?php } ?>

        <tr>
            <td class="auto-style2">
                <center>

                 <h2 style="margin: 0px;"  class="auto-style1">LAPORAN RELASI E-VOUCHER
                        </h2>

                    
                </center>
            </td>
        </tr>

        <tr>
            <td class="auto-style2">SPBU <?php $id_admin = decrypt($_COOKIE['kodene']);
            echo $nama_spbu = baca_database("", "nama_spbu", "select * from data_admin where id_admin='$id_admin'");

            echo ", ";
            echo $alamat_spbu = baca_database("", "alamat1", "select * from data_spbu where nama_spbu like '%$nama_spbu%'")
                ?></td>
        </tr>
    </table>
    <!-- HEADER -->

    <!-- BODY -->
    <table width="100%" class="tblcms2">
        <tr>
            <th class="th_border cell">No</th>
            <!--h <th class="th_border cell">Id Relasi </th> h-->
            <th align="center" class="th_border cell">Tanggal Daftar </th>
            <th align="center" class="th_border cell">Nama </th>
            <th align="center" class="th_border cell">Nomor Telepon </th>
            <th align="center" class="th_border cell">Email </th>
            <th align="center" class="th_border cell">Alamat </th>
            <th align="center" class="th_border cell">Nama Spbu </th>
            <th align="center" class="th_border cell">Nama Spbu </th>
            <th align="center" class="th_border cell">Password </th>


        </tr>

        <tbody>
            <?php
            $no = 0;
            if (isset($_GET['isi']) && !empty($_GET['isi'])) {
                //BERDASARKAN
                $Berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
                $isi = mysql_real_escape_string($_GET['isi']);
                echo '<center> Cetak berdasarkan <b>' . $Berdasarkan . '</b> : <b>' . $isi . '</b></center>';
                $querytabel = "SELECT * FROM data_relasi where $Berdasarkan like '%$isi%'";
            } elseif (isset($_GET['tanggal1']) && !empty($_GET['tanggal1'])) {
                //PERIODE
                $Berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
                $tanggal1 = mysql_real_escape_string($_GET['tanggal1']);
                $tanggal2 = mysql_real_escape_string($_GET['tanggal2']);
                $tanggal1_indo = format_indo($tanggal1);
                $tanggal2_indo = format_indo($tanggal2);
                echo '<center> Cetak Berdasarkan <b>' . $Berdasarkan . '</b> Dari Tanggal <b>' . $tanggal1_indo . '</b> s/d <b>' . $tanggal2_indo . '</b></center>';
                $querytabel = "SELECT * FROM data_relasi where ($Berdasarkan BETWEEN '$tanggal1' AND '$tanggal2')";
            } else {
                //SEMUA
                $querytabel = "SELECT * FROM data_relasi";
            }
            $proses = mysql_query($querytabel);
            while ($data = mysql_fetch_array($proses)) {
                ?>
                <tr class="event2">
                    <td align="center" width="50"><?php $no = $no + 1;
                    echo $no; ?></td>
                    <!--h <td align="center"><?php echo $data['id_relasi']; ?></td> h-->
                    <td align="center"><?php echo format_indo_jam($data['tanggal_daftar']); ?></td>
                    <td align="center"><?php echo $data['nama']; ?></td>
                    <td align="center"><?php echo $data['nomor_telepon']; ?></td>
                    <td align="center"><?php echo $data['email']; ?></td>
                    <td align="center"><?php echo $data['alamat']; ?></td>
                    <td align="center">
                        <?php echo baca_database("", "nama_spbu", "select * from data_spbu where id_spbu='$data[id_spbu]'") ?>
                    </td>
                    <td align="center"><?php echo $data['nama_spbu']; ?></td>
                    <td align="center"><?php echo $data['password']; ?></td>



                </tr>
            <?php } ?>
        </tbody>
    </table>
    <!-- BODY -->

    <table width="100%" style="border: 0px solid #ddd;" >
        <tbody>
            <tr>
                <td width="85%"></td>
                <td style="align-content: baseline;">
                    <?php  ttd();?>
                </td>
            </tr>
        </tbody>
    </table>

<?php } ?>