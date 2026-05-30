<?php
// Include necessary files and configurations
if (isset($_GET['export'])) {
    // Set headers for Excel file download
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="Laporan_Data_Member.xls"');


}
?>

<!-- Existing HTML and PHP code for displaying the table -->
<?php
if (isset($_GET['input'])) {
    echo "<h3> Cetak Laporan "; tabelnomin(); echo "</h3>";
    ?>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">
    <?php
    action_cetak("data_member");
} else {
    function location() { return "cetak"; }
    include '../../../include/all_include.php';
    proses_action_cetak("data_member");
    ?>
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new.css">
    <link rel="stylesheet" type="text/css" href="../../../data/cssjs/cetak/style_new2.css">

 
    <!-- FORM -->
    <form name="formcari" id="formcari" action="cetak.php" method="get" target="_blank">
        <!-- Your existing form code -->
        <tr>
            <td></td>
            <td>
                <?php btn_export_laporan('Export Excel'); ?>
            </td>
        </tr>
    </form>

<table border="0" style="width: 100%" >
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
			echo $tabelnya; ?> PROBLEM

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
        <th class="th_border cell"  >id_member</th>
        <th class="th_border cell"  >nik</th>
<th class="th_border cell"  >nama</th>
<th class="th_border cell"  >alamat</th>
<th class="th_border cell"  >no&nbsp;telepon</th>
<th class="th_border cell"  >jenis&nbsp;kelamin</th>
<th class="th_border cell"  >tanggal&nbsp;terdaftar</th>
<th class="th_border cell"  >Kategori Member</th>
<th class="th_border cell"  >kode&nbsp;rfid</th>
<th class="th_border cell"  >tanggal&nbsp;lahir</th>
<th class="th_border cell"  >agama</th>
<th class="th_border cell"  >status&nbsp;perkawinan</th>
<th class="th_border cell"  >pekerjaan</th>
<th class="th_border cell"  >username</th>
<th class="th_border cell"  >point</th>

<th class="th_border cell"  >Nama SPBU</th>
<th class="th_border cell"  >Informasi Member</th>


    </tr>

    <tbody>
    <?php
			
				     $querytabel="select * from data_member where spbu like '%spbu%'"; 
				  
				
				$proses = mysql_query($querytabel);
				while ($data = mysql_fetch_array($proses)) 
			{
			    
			       
			?>
        <tr class="event2">
            <td align="center" width="50"><?php $no = $no +1; echo $no; ?></td>
       
<td align="center"><?php echo ($data['id_member']); ?></td>
            <td align="center"><?php echo ($data['nik']); ?></td>
<td align="center"><?php echo ($data['nama']); ?></td>
<td align="center"><?php echo ($data['alamat']); ?></td>
<td align="center"><?php echo ($data['no_telepon']); ?></td>
<td align="center"><?php echo ($data['jenis_kelamin']); ?></td>
<td align="center"><?php echo (($data['tanggal_terdaftar'])); ?></td>

<td align="center"><?php echo baca_database("", "kategori_member", " select * from data_kategori_member where id_kategori_member ='$data[id_kategori_member]'") ?></td>
<td align="center"><?php echo ($data['kode_rfid']); ?></td>

<td align="center"><?php echo (($data['tanggal_lahir'])); ?></td>
<td align="center"><?php echo ($data['agama']); ?></td>
<td align="center"><?php echo ($data['status_perkawinan']); ?></td>
<td align="center"><?php echo ($data['id_pekerjaan']); ?></td>
<td align="center"><?php echo ($data['username']); ?></td>
<td align="center"><?php echo ($data['point']); ?></td>
<td align="center"><?php echo ($data['spbu']); ?></td>
<td align="center"><?php
$tanggal_terdaftar = $data['tanggal_terdaftar'];
$endDate = date('Y-m-d', strtotime('+1 month', strtotime($tanggal_terdaftar)));

if (date('Y-m-d') >= $endDate) {
    echo "Member Lama";
} else {
    echo "Member Baru";
}
?></td>

        </tr>
        <?php  } ?>
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

<?php }  ?>

<?php
// Include necessary files and configurations
if (isset($_GET['export'])) {


}
else
{
    ?>
    <a class="btn btn-primary" href="../data_member/index.php?input=member_problem">Perbaikan (khusus developer) </a>
    <?php
}
?>

