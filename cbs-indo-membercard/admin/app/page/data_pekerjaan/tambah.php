
<a href="<?php index(); ?>">
<?php btn_kembali(' KEMBALI'); ?>
</a>	

<br><br>

<div class="content-box">
<div class="content-box-header" style="height: 39px">Tambah<h3></h3></div>
<form action="proses_simpan.php" enctype="multipart/form-data"  method="post">
<div class="content-box-content">
<div id="postcustom">	
<table <?php tabel_in(100,'%',0,'center');  ?>>		
	<tbody>
			   <tr>
				<td width="25%" class="leftrowcms">					
				<label >id&nbsp;pekerjaan <span class="highlight">*</span></label>
			   </td>
				<td width="2%">:</td>
				<td>
				<input type="readonly" readonly value="<?php echo id_otomatis("data_pekerjaan","id_pekerjaan","10");?>" name="id_pekerjaan" placeholder="id_pekerjaan" id="id_pekerjaan" required="required">		
				</td>
			   </tr>
			   
			   <tr>
				<td width="25%" class="leftrowcms">					
				<label >Nama Pekerjaan <span class="highlight"></span></label>
			   </td>
				<td width="2%">:</td>
				<td>
				<input class='ckeditor'  type="text" name="nama" id="nama" placeholder="Nama" required="required">

	
				</td>
			   </tr>
			  
			   
	</tbody>
</table>
<div class="content-box-content">
<center>
<?php btn_simpan(' SIMPAN'); ?>
</center>
</div>		
</div>
</div>
</form>
