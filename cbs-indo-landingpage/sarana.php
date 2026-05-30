<?php if(empty($p)) { header("Location: index.php?p=home"); die(); } 

	if (!(isset($_GET['judul'])))
	{
	?>

<div class="container">
<div class="col-md-12">
<!--
			<form name="formcari" id="formcari" action="" method="get">
				<fieldset> 
					<table>
						<tbody>
						<tr>
							<td>Berdasarkan</td>	
							<td>:</td>	
							<td>
							 <select class="form-control selectpicker" data-live-search="true" name="Berdasarkan" id="Berdasarkan">
								<?php
								$sql = "desc data_sarana";
								$result = @mysql_query($sql);
								while($row = @mysql_fetch_array($result)){
									echo "<option name='berdasarkan' value=$row[0]>$row[0]</option>";
								}
								?>
							</select>							
							</td>
						</tr>

						<tr>
							<td>Pencarian</td>	
							<td>:</td>	
							<td>							
								 <input  type="text" name="isi" value="" >
								<?php btn_cari('Cari'); ?>
							</td>
						</tr>
					</tbody>
					</table>									
				</fieldset>
			</form>

			-->
			<br>
<section id="agency"> <form name="lala" id="lala" action="" method="get">
			<div class="section-detail">
				<h1>sarana</h1>
				<h2><?php echo $oke = mysql_real_escape_string($_GET['isi']); ?>.</h2>		
			</div>
			
			<div class="col-md-9" id="blog-list">
			<Br>
			<Br>
			
			<div class="section-title line-style">
							<h3 class="title">Total Sarana = <?php echo baca_database('','jumlah',"SELECT count(kategori) as jumlah FROM data_sarana where kategori = '$oke'"); ?></h3>
						</div>
						
			
			<Br>
			<div class="container">
			<?php
				$no = 0;
				$startRow=($page-1)*$dataPerPage;
				$no = $startRow;
				
				if (isset($_GET['Berdasarkan']) && !empty($_GET['Berdasarkan']) && isset($_GET['isi']) && !empty($_GET['isi']))
				{
				$berdasarkan =  mysql_real_escape_string($_GET['Berdasarkan']);
				$isi =  mysql_real_escape_string($_GET['isi']);
				$querytabel="SELECT * FROM data_sarana where $berdasarkan like '%$isi%'  LIMIT $startRow ,$dataPerPage";
				$querypagination="SELECT COUNT(*) AS total FROM data_sarana where $berdasarkan like '%$isi%'";
				}
				else
				{
				$querytabel="SELECT * FROM data_sarana  LIMIT $startRow ,$dataPerPage";
				$querypagination="SELECT COUNT(*) AS total FROM data_sarana";
				}
				$proses = mysql_query($querytabel);
				while ($data = mysql_fetch_array($proses))
				  { ?>
			 
              <div class="row agency-box">
					
					<div class="col-sm-3 col-md-3 col-sm-push-6 col-md-push-7">
						
					</div>
					<div class="col-sm-6 col-md-6 center-box col-sm-pull-3 col-md-pull-3">
						<h1 class="title"><a href=""><?php echo $data['nama']; ?></a></h1>
						<p class=""><i style='font-size:14px' class='far'>&#xf073;</i> &nbsp;<?php echo ($data['kategori']); ?></p>
						<span><i style='font-size:14px' class='fa fa-map-marker'></i>&nbsp;&nbsp;<?php echo ($data['alamat']); ?>. </span>
						
					</div>
				</div>
				
				  <?php } ?>
</div>
</div>
</form>
<br>
<br>
 	<div class="col-md-3">
						
						<div class="section-title line-style">
							<h3 class="title">Another Facility</h3>
						</div>
						
						<ul class="category-list">
							
							 <?php
				$querytabel="SELECT * FROM data_sarana LIMIT 0 ,15";
				$proses = mysql_query($querytabel);
				while ($data = mysql_fetch_array($proses))
				{ ?>
			
							<li><a href="index.php?p=sarana&Berdasarkan=kategori&isi=<?php echo $data['kategori']; ?>"><?php echo $data['kategori']; ?></a></li>
				<?php } ?>
						</ul>
       </div>
 
</div>

</section>

</div>

<Br>
<Br>
<Br>
<Br>
<center><?php Pagination_font_end($page,$dataPerPage,$querypagination); ?></center>

<!----- Detail Halaman ------>


<?php
} 

else {
$sql=mysql_query("SELECT * FROM $tabel where $judul = '".mysql_real_escape_string($_GET['judul'])."'");
$data=mysql_fetch_array($sql);
?>

<?php  $judul = mysql_real_escape_string($_GET['judul']);

 $id_sarana = baca_database('','id_sarana',"select * from data_sarana where judul = '$judul'"); 
 $foto = baca_database('','foto',"select * from data_sarana where judul = '$judul'"); 
 $isi = baca_database('','isi',"select * from data_sarana where judul = '$judul'"); ?>

<section id="agency" class="agency">

			<div class="container">
				<div class="row">
				
				<div class="col-sm-9 col-md-8">
			
				
						<center><h1 class="title"><?php echo ucwords($judul); ?> </h1></center>
						
							
				<div class="col-md-12">
									<a href="admin/upload/<?php echo $foto; ?>" class="hover-effect galleryItem" data-group="1">
										<img src="admin/upload/<?php echo $foto; ?>" alt="Sample images" class="img-responsive">
										<span class="cover"></span>
									</a>
								</div>
				
			
					<div class="col-md-12">
					<br>
						<div class="description">
				
							<?php echo $isi; ?><br><br>
						</div>
						</div>
						<div class="tabs line" id="tab3">
							<ul class="tab-button">
								<li class="active"><a href="#" data-target="tab3-a"><i class="fa fa-skyatlas"></i> Download Dokumen</a></li>
								</ul><!-- /.tab-button -->
							<div class="tab-text" data-effect="slide">
								<div id="tab3-a" class="tab" style="display: block;">
										<a class="btn btn-danger" href="admin/upload/<?php echo $data['upload_file']; ?>">Download File</a>
								</div>
								
							</div><!-- /.tab-text -->
						</div><!-- /.tabs -->
						</div>
					<div class="col-sm-12 col-md-4">
						<div class="row">
							<div class="col-sm-6 col-md-12">
								<!-- . Agent Box -->
								<div class="section-title line-style no-margin">
									<h3 class="title">sarana Update</h3>
								</div>
								
									
							<?php
			
			$querytabel="SELECT * FROM data_sarana ORDER BY tanggal DESC LIMIT 0 ,10";
			$proses = mysql_query($querytabel);
			while ($data = mysql_fetch_array($proses))
			  { ?>
		  
								<div class="agent-box-card grey">
									<div class="image-content">
										<div class="image image-"  style="">
											<a href="index.php?p=sarana&a&judul=<?php echo $data['judul'];?>" > 
											
											<img alt="Image Sample"  src="admin/upload/<?php echo $data['foto']; ?>" class="" style="width: 100%; height: 100%; top: 0px; left: -44px;"> </a>
										</div>						
									</div>
									<div class="info-agent">
										<a href="index.php?p=sarana&a&judul=<?php echo $data['judul'];?>"  ><span class="name" href="index.php?p=sarana&a&judul=<?php echo $data['judul'];?>" ><?php echo $data['judul']; ?> </a>
										
										
									</div>
								</div>	

			  <?php } ?>								
							</div>
						</div>
					</div>
				
				
				
				
				</div>
			</div>
		</section>
		

<?php } ?>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>