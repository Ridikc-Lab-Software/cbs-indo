<?php 
if (isset($_GET['input']))
{   
	echo "<h3> Cetak Laporan "; tabelnomin(); echo "</h3>";
	?>
	<link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
	<link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">
	<?php
	action_cetak("data_redeem"); 
}
else
{
	function location() { return "cetak"; }
	include '../../../include/all_include.php';
	proses_action_cetak("data_redeem");
?>
	<link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
	<link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">
	

<!-- HEADER -->
<table border="0" style="width: 100%">
	<?php if (isset($_GET['export']))
	{
	}
	else
	{	
	?>
    <tr>
        <td class="auto-style1" rowspan="3" width="101">
            <img alt="" height="100" src="<?php echo $logo_laporan1; ?>" width="100"></td>

        <td class="auto-style1">
            <center>
                <h2 class="auto-style1"><?php echo $judul; ?></h2>
            </center>
        </td>

        <td class="auto-style1" rowspan="3" width="101">
            <img alt="" height="100" src="<?php echo $logo_laporan2; ?>" width="100"></td>
    </tr>
	<?php } ?>

    <tr>
        <td class="auto-style2">
            <center>
                <strong>LAPORAN

                    <?php
			$tabelnya = "data_redeem";
			$tabelnya = str_replace("_"," ",$tabelnya);
			$tabelnya = str_replace("data","",$tabelnya);
			$tabelnya = strtoupper($tabelnya);
			echo $tabelnya; ?>

                </strong>
            </center>
        </td>
    </tr>

    <tr>
        <td class="auto-style2"><?php echo $alamat ; ?></td>
    </tr>
</table>
<!-- HEADER -->

<!-- BODY -->
<table width="100%"  class="tblcms2">
    <tr>
        <th class="th_border cell">No</th>
        
        <th class="th_border cell"  >tanggal</th>
<th class="th_border cell"  >jam</th>
<th class="th_border cell"  >Nama</th>
<th class="th_border cell"  >Nama Mitra</th>
<th class="th_border cell"  >id&nbsp;promo</th>
<th class="th_border cell"  >Nama Promo</th>
<th class="th_border cell"  >Pengurangan point</th>
      <th align="center" class="th_border cell">Jumlah</th>
            <th align="center" class="th_border cell">Point</th>
            <th align="center" class="th_border cell">Value</th>
<!--<th class="th_border cell"  >status</th>-->

            <th align="center" class="th_border cell">Nama SPBU</th>

    </tr>

    <tbody>
    <?php
				$no = 0;
				if (isset($_GET['isi']) && !empty($_GET['isi']))
				{
					//BERDASARKAN
					$Berdasarkan = mysql_real_escape_string($_GET['Berdasarkan']);
					$isi =  mysql_real_escape_string($_GET['isi']);
					echo '<center> Cetak berdasarkan <b>'.$Berdasarkan.'</b> : <b>'.$isi.'</b></center>';
					$querytabel="SELECT * FROM data_redeem where $Berdasarkan like '%$isi%'";
				}
				else if (isset($_GET['tanggal1']) && !empty($_GET['tanggal1']))
				{
					//PERIODE
					$Berdasarkan =  mysql_real_escape_string($_GET['Berdasarkan']);
					$tanggal1 =  mysql_real_escape_string($_GET['tanggal1']);
					$tanggal2 =  mysql_real_escape_string($_GET['tanggal2']);
					$tanggal1_indo = format_indo($tanggal1);
					$tanggal2_indo = format_indo($tanggal2);
					echo '<center> Cetak Berdasarkan <b>'.$Berdasarkan.'</b> Dari Tanggal <b>'.$tanggal1_indo.'</b> s/d <b>'.$tanggal2_indo.'</b></center>';
					$querytabel="SELECT * FROM data_redeem where ($Berdasarkan BETWEEN '$tanggal1' AND '$tanggal2')";
				
				}
				else
				{
					//SEMUA
					$querytabel="SELECT * FROM data_redeem";
				}
				$proses = mysql_query($querytabel);
				while ($data = mysql_fetch_array($proses)) 
			{
			?>
        <tr class="event2">
            <td align="center" width="50"><?php $no = $no +1; echo $no; ?></td>
     

            <td align="center"><?php echo (format_indo($data['tanggal'])); ?></td>
<td align="center"><?php echo ($data['jam']); ?></td>
<td align="center"><?php echo baca_database("", "nama", " select * from data_member where id_member ='$data[id_member]'") ?></td>
<td align="center"><?php echo ($data['id_mitra']); ?></td>
<td align="center"><?php echo ($data['id_promo']); ?></td>
<td align="center"><?php echo baca_database("", "nama_promo", " select * from data_promo where id_promo ='$data[id_promo]'") ?></td>
<td align="center"><?php echo ($data['point']); ?></td>
<!--<td align="center">--><?php //echo ($data['status']); ?><!--</td>-->
<td align="center"><?php echo($data['jumlah']); ?></td>
                <td align="center"><?php echo($data['jumlah'] * $data['point']); ?> Point</td>
                <td align="center"><?php echo rupiah($data['jumlah'] * $data['value_redeem']); ?></td>
                <?php
                    $spbu = baca_database('data_petugas', 'nama_spbu', "select nama_spbu from data_petugas where id_petugas='$data[id_petugas]'");
                    $spbu_code = $spbu;
                    if ($spbu) {
                        if (preg_match('/^([\d\.]+)/', $spbu, $matches)) {
                            $spbu_code = $matches[1];
                        }
                    } else {
                        $spbu_code = "-";
                    }
                ?>

                <td align="center">
                    <a href="index.php?spbu=<?php echo urlencode($spbu_code); ?>"><?php echo htmlspecialchars($spbu_code); ?></a>
                </td>

        </tr>
        <?php } ?>
    </tbody>
</table>
<!-- BODY -->

<!-- FOOTER -->
<p class="auto-style3"><?php echo $formatwaktu; ?>
</p>
<p class="auto-style3"><?php echo $ttd; ?></p>
<p class="auto-style3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</p>
<p class="auto-style3"><?php echo $siapa ; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</p>
<p class="auto-style3"></p>

<?php } ?>