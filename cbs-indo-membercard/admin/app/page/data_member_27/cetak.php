<?php 
if (isset($_GET['input']))
{   
	echo "<h3> Cetak Laporan "; tabelnomin(); echo "</h3>";
	?>
	<link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
	<link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">
	<?php
	action_cetak("data_member"); 
}
else
{
	function location() { return "cetak"; }
	include '../../../include/all_include.php';
	proses_action_cetak("data_member");
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
			$tabelnya = "data_member";
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
        <th class="th_border cell">id&nbsp;member</th>
        <th class="th_border cell"  >nik</th>
<th class="th_border cell"  >nama</th>
<th class="th_border cell"  >alamat</th>
<th class="th_border cell"  >no&nbsp;telepon</th>
<th class="th_border cell"  >jenis&nbsp;kelamin</th>
<th class="th_border cell"  >tanggal&nbsp;terdaftar</th>
<th class="th_border cell"  >id&nbsp;kategori&nbsp;member</th>
<th class="th_border cell"  >Kategori Member</th>
<th class="th_border cell"  >kode&nbsp;rfid</th>
<th class="th_border cell"  >password</th>
<th class="th_border cell"  >tanggal&nbsp;lahir</th>
<th class="th_border cell"  >agama</th>
<th class="th_border cell"  >status&nbsp;perkawinan</th>
<th class="th_border cell"  >pekerjaan</th>
<th class="th_border cell"  >username</th>
<th class="th_border cell"  >point</th>
<th class="th_border cell"  >kewarganegawaan</th>
<th class="th_border cell"  >Nama SPBU</th>

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
					$querytabel="SELECT * FROM data_member where $Berdasarkan like '%$isi%'";
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
					$querytabel="SELECT * FROM data_member where ($Berdasarkan BETWEEN '$tanggal1' AND '$tanggal2')";
				
				}
				else
				{
					//SEMUA
					$querytabel="SELECT * FROM data_member";
				}
				$proses = mysql_query($querytabel);
				while ($data = mysql_fetch_array($proses)) 
			{
			?>
        <tr class="event2">
            <td align="center" width="50"><?php $no = $no +1; echo $no; ?></td>
            <td align="center"><?php echo $data['id_member']; ?></td>

            <td align="center"><?php echo ($data['nik']); ?></td>
<td align="center"><?php echo ($data['nama']); ?></td>
<td align="center"><?php echo ($data['alamat']); ?></td>
<td align="center"><?php echo ($data['no_telepon']); ?></td>
<td align="center"><?php echo ($data['jenis_kelamin']); ?></td>
<td align="center"><?php echo (format_indo($data['tanggal_terdaftar'])); ?></td>
<td align="center"><?php echo ($data['id_kategori_member']); ?></td>
<td align="center"><?php echo baca_database("", "kategori_member", " select * from data_kategori_member where id_kategori_member ='$data[id_kategori_member]'") ?></td>
<td align="center"><?php echo ($data['kode_rfid']); ?></td>
<td align="center"><?php echo ($data['password']); ?></td>
<td align="center"><?php echo (($data['tanggal_lahir'])); ?></td>
<td align="center"><?php echo ($data['agama']); ?></td>
<td align="center"><?php echo ($data['status_perkawinan']); ?></td>
<td align="center"><?php echo ($data['pekerjaan']); ?></td>
<td align="center"><?php echo ($data['username']); ?></td>
<td align="center"><?php echo ($data['point']); ?></td>
<td align="center"><?php echo ($data['nama_spbu']); ?></td>

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