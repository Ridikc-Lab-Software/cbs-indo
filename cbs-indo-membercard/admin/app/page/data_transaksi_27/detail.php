
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
			Detail data&nbsp;transaksi
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
			$sql=mysql_query("SELECT * FROM data_transaksi where id_transaksi = '$proses'");
			$data=mysql_fetch_array($sql);
			?>
			   <tr>
				<td class="clleft" width="25%">id&nbsp;transaksi</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo $data['id_transaksi']; ?></td>	
			   </tr>
			   
			   <tr>
				<td class="clleft" width="25%">Tanggal</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo (format_indo($data['tanggal'])); ?></td>	
			   </tr>
<tr>
				<td class="clleft" width="25%">Jam</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo $data['jam']; ?></td>	
			   </tr>
<tr>
				<td class="clleft" width="25%">Id&nbsp;member</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo $data['id_member']; ?></td>	
			   </tr>
<tr>
				<td class="clleft" width="25%">Nama</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo baca_database("", "nama", " select * from data_member where id_member ='$data[id_member]'") ?></td>	
			   </tr>
<tr>
				<td class="clleft" width="25%">Id&nbsp;petugas</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo $data['id_petugas']; ?></td>	
			   </tr>
<tr>
				<td class="clleft" width="25%">Nama</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo baca_database("", "nama", " select * from data_petugas where id_petugas ='$data[id_petugas]'") ?></td>	
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
				<td class="clleft" width="25%">Point</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo $data['point']; ?></td>	
			   </tr>
<tr>
				<td class="clleft" width="25%">Kategori&nbsp;jumlah</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo $data['kategori_jumlah']; ?></td>	
			   </tr>
<tr>
				<td class="clleft" width="25%">Jumlah</td>
				<td class="clleft" width="2%">:</td>
				<td class="clleft"><?php echo $data['jumlah']; ?></td>	
			   </tr>

    <tr>
				<td class="clleft" width="25%">Nama SPBU</td>
				<td class="clleft" width="2%">:</td>

        <?php

        $spbu = baca_database('data_petugas', 'nama_spbu', "select nama_spbu from data_petugas where id_petugas='$data[id_petugas]'");
        ?>

        <td align="center">
            <a href="index.php?Berdasarkan=nama_spbu&isi=<?php echo $spbu; ?>"><?php echo $spbu; ?></a>
        </td>
			   </tr>

				
	
</tbody>
</table>
</div>
</div>