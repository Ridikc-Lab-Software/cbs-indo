
<a href="<?php index(); ?>">
<?php btn_kembali(' KEMBALI'); ?>
</a>

<br><br>

<div class="content-box">
<div class="content-box-header" style="height: 39px">Detail
<h3 style="cursor: s-resize;"></h3></div>
<div class="content-box-content">
<table <?php tabel_in(100,'%',0,'center');  ?>>		
	<tbody>
	<tr class="event3">
		<td class="clleft" colspan="3">
			Detail data&nbsp;group&nbsp;jenis&nbsp;transaksi
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
			$sql=mysql_query("SELECT * FROM data_group_jenis_transaksi where id_group_jenis_transaksi = '$proses'");
			$data=mysql_fetch_array($sql);
			?>
			   <tr>
				<td class="clleft" width="25%">id&nbsp;group&nbsp;jenis&nbsp;transaksi</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo $data['id_group_jenis_transaksi']; ?></td>	
			   </tr>
			   
			   <tr>
				<td class="clleft" width="25%">Nama&nbsp;group</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo $data['nama_group']; ?></td>	
			   </tr>
<tr>
				<td class="clleft" width="25%">Id&nbsp;jenis&nbsp;transaksi</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo $data['id_jenis_transaksi']; ?></td>	
			   </tr>
<tr>
				<td class="clleft" width="25%">Jenis Transaksi</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo baca_database("", "jenis_transaksi", " select * from data_jenis_transaksi where id_jenis_transaksi ='$data[id_jenis_transaksi]'") ?></td>	
			   </tr>
<tr>
				<td class="clleft" width="25%">Gambar&nbsp;logo</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><a href='../../../../admin/upload/<?php echo $data['gambar_logo']; ?>'><img onerror="this.src='<?php echo $imageerror; ?>'" width='250'  src='../../../../admin/upload/<?php echo $data['gambar_logo']; ?>'></a></td>	
			   </tr>

				
	
</tbody>
</table>
</div>
</div>