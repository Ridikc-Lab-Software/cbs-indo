
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
			Detail data&nbsp;point&nbsp;promo
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
			$sql=mysql_query("SELECT * FROM data_point_promo where id_point_promo = '$proses'");
			$data=mysql_fetch_array($sql);
			?>
			   <tr>
				<td class="clleft" width="25%">id&nbsp;point&nbsp;promo</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo $data['id_point_promo']; ?></td>	
			   </tr>
			   
			   <tr>
				<td class="clleft" width="25%">Id&nbsp;promo</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo $data['id_promo']; ?></td>	
			   </tr>
<tr>
				<td class="clleft" width="25%">Id&nbsp;kategori&nbsp;member</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo $data['id_kategori_member']; ?></td>	
			   </tr>
<tr>
				<td class="clleft" width="25%">Kategori Member</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo baca_database("", "kategori_member", " select * from data_kategori_member where id_kategori_member ='$data[id_kategori_member]'") ?></td>	
			   </tr>
<tr>
				<td class="clleft" width="25%">Point</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo $data['point']; ?></td>	
			   </tr>

				
	
</tbody>
</table>
</div>
</div>