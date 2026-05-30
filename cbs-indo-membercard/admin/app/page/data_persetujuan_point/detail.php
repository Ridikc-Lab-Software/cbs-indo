
<a href="<?php index(); ?>">
<?php btn_kembali(' KEMBALI'); ?>
</a>

<br><br>

<div class="content-box">
<div class="content-box-persetujuan_point" style="height: 39px">Detail
<h3 style="cursor: s-resize;"></h3></div>
<div class="content-box-content">
<table <?php tabel_in(100,'%',0,'center');  ?>>		
	<tbody>
	<tr class="event3">
		<td class="clleft" colspan="3">
			Detail data&nbsp;persetujuan_point
		</td>
	</tr>	
			<?php

if (!isset($_GET['proses']))
{
	    ?>
	<script>
	alert("AKSES DITOLAK");
	location.href = "index.php";
	</script>
	<?php
	die();
}
			$proses = decrypt(mysql_real_escape_string($_GET['proses']));
			$sql=mysql_query("SELECT * FROM data_persetujuan_point where id_persetujuan_point = '$proses'");
			$data=mysql_fetch_array($sql);
			?>
			   <tr>
				<td class="clleft" width="25%">Id&nbsp;Persetujuan&nbsp;Point</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo $data['id_persetujuan_point']; ?></td>	
			   </tr>
			   
			    <tr>
				<td class="clleft" width="25%">Tanggal&nbsp;Permintaan</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo format_indo($data['tanggal_permintaan']); ?></td>	
			   </tr>
			   
			   
			    <tr>
				<td class="clleft" width="25%">Tanggal&nbsp;Konfirmasi</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo format_indo($data['tanggal_persetujuan']); ?></td>	
			   </tr>
			   
<tr>
				<td class="clleft" width="25%">Member</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php $idm = $data['id_member']; echo baca_database('','nama',"select * from data_member where id_member='$idm'"); ?></td>	
			   </tr>
<tr>
				<td class="clleft" width="25%">Admin</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php $ida = $data['id_admin']; echo baca_database('','username',"select * from data_admin where id_admin ='$ida'"); ?></td>	
			   </tr>

<tr>
				<td class="clleft" width="25%">Penyetuju</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php $idp = $data['id_penyetuju']; echo baca_database('','username',"select * from data_admin where id_admin ='$idp'"); ?></td>	
			   </tr>
			   
			   
			   <tr>
				<td class="clleft" width="25%">Point&nbsp;Awal</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo $data['point_awal']; ?></td>	
			   </tr>
			   
			   			   <tr>
				<td class="clleft" width="25%">Point&nbsp;Update</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo $data['update_point']; ?></td>	
			   </tr>
			   
<tr>

				<td class="clleft" width="25%">status</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo (substr($data['status'],0,100)); ?></td>	
			   </tr>

				
	
</tbody>
</table>
</div>
</div>