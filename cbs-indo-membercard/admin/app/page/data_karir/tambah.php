
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
				<label >id&nbsp;karir<span class="highlight">*</span></label>
			   </td>
				<td width="2%">:</td>
				<td>
				<input type="readonly" readonly value="<?php echo id_otomatis("data_karir","id_karir","10");?>" name="id_karir" placeholder="id_karir" id="id_karir" required="required">		
				</td>
			   </tr>
			    <tr>
				<td width="25%" class="leftrowcms">					
				<label >foto<span class="highlight">*</span></label>
			   </td>
				<td width="2%">:</td>
				<td>
				<input type="file" name="foto" placeholder="foto" id="foto" required="required">		
				</td>
			   </tr>
			   <tr>
				<td width="25%" class="leftrowcms">					
				<label >nama karir<span class="highlight">*</span></label>
			   </td>
				<td width="2%">:</td>
				<td>
				<input type="text" name="nama_karir" placeholder="nama_karir" id="nama_karir" required="required">		
				</td>
			   </tr>
			   
			   <tr>
				<td width="25%" class="leftrowcms">					
				<label >deskripsi karir<span class="highlight"></span></label>
			   </td>
				<td width="2%">:</td>
				<td>
				<textarea class='ckeditor'  type="text" name="deskripsi_karir" id="deskripsi_karir" placeholder="Deskripsi Karir" required="required">

</textarea>		
				</td>
			   </tr>
			   <tr>
				<td width="25%" class="leftrowcms">					
				<label >Kualifikasi Karir <span class="highlight"></span></label>
			   </td>
				<td width="2%">:</td>
				<td>
				<textarea class='ckeditor'  type="text" name="kualifikasi_karir" id="kualifikasi_karir" placeholder="Kualifikasi Karir" required="required">

</textarea>		
				</td>
			   </tr>
			    <tr>
				<td width="25%" class="leftrowcms">					
				<label >batas waktu karir<span class="highlight">*</span></label>
			   </td>
				<td width="2%">:</td>
				<td>
				<input type="date" value="<?php echo tanggal_otomatis();?>" name="batas_lamar" placeholder="batas_lamar" id="batas_lamar" required="required">		
				</td>
			   </tr>
			   		   <tr>
				<td width="25%" class="leftrowcms">					
				<label >cara lamar pekerjaan<span class="highlight"></span></label>
			   </td>
				<td width="2%">:</td>
				<td>
				<textarea class='ckeditor'  type="text" name="cara_lamar" id="cara_lamar" placeholder="Cara Lamar" required="required">

</textarea>		
				</td>
			   </tr>
			   		   <tr>
				<td width="25%" class="leftrowcms">					
				<label >status <span class="highlight"></span></label>
			   </td>
				<td width="2%">:</td>
				<td>
				<select name="status" id="status" type="text" >
				    <option></option> <?php combo_enum("data_karir","status","")?>
				    
				</select>
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
