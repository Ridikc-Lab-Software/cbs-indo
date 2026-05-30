
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
			Detail data&nbsp;promo
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
			$sql=mysql_query("SELECT * FROM data_promo where id_promo = '$proses'");
			$data=mysql_fetch_array($sql);
			?>
			   <tr>
				<td class="clleft" width="25%">id&nbsp;promo</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo $data['id_promo']; ?></td>	
			   </tr>
			   
			   <tr>
				<td class="clleft" width="25%">Tanggal&nbsp;mulai&nbsp;berlaku</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo (format_indo($data['tanggal_mulai_berlaku'])); ?></td>	
			   </tr>
<tr>
				<td class="clleft" width="25%">Tanggal&nbsp;batas&nbsp;berlaku</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo (format_indo($data['tanggal_batas_berlaku'])); ?></td>	
			   </tr>
<tr>
				<td class="clleft" width="25%">Aktifkan&nbsp;pembatasan&nbsp;waktu</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo $data['aktifkan_pembatasan_waktu']; ?></td>	
			   </tr>
<tr>
				<td class="clleft" width="25%">Nama&nbsp;promo</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo $data['nama_promo']; ?></td>	
			   </tr>
<tr>
				<td class="clleft" width="25%">Keterangan</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo $data['keterangan']; ?></td>	
			   </tr>
<tr>
				<td class="clleft" width="25%">Syarat&nbsp;dan&nbsp;ketentuan</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo $data['syarat_dan_ketentuan']; ?></td>	
			   </tr>
<tr>
				<td class="clleft" width="25%">Foto&nbsp;promo</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><a href='../../../../admin/upload/<?php echo $data['foto_promo']; ?>'><img onerror="this.src='<?php echo $imageerror; ?>'" width='250'  src='../../../../admin/upload/<?php echo $data['foto_promo']; ?>'></a></td>	
			   </tr>
<tr>
				<td class="clleft" width="25%">Jumlah&nbsp;point</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo $data['jumlah_point']; ?></td>	
			   </tr>
<tr>
				<td class="clleft" width="25%">Id&nbsp;mitra</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo $data['id_mitra']; ?></td>	
			   </tr>
<tr>
				<td class="clleft" width="25%">Nama Mitra</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo baca_database("", "nama_mitra", " select * from data_mitra where id_mitra ='$data[id_mitra]'") ?></td>	
			   </tr>
<tr>
				<td class="clleft" width="25%">Status</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo $data['status']; ?></td>	
			   </tr>

				
	
</tbody>
</table>
</div>
</div>