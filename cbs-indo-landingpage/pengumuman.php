<?php if(empty($p)) { header("Location: index.php?p=home"); die(); } 

	if (!(isset($_GET['judul'])))
	{
	?>

<br>
<center><h2> DOWNLOAD pengumuman </h2></center>
<br>

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
								$sql = "desc data_pengumuman";
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
<section id="agency">
			<div class="section-detail">
				<h1>Pengumuman</h1>
				<h2>Kumpulan Pengumuman.</h2>		
			</div>
			
			<div class="col-md-9" id="blog-list">
			<div class="container">
			<?php
				$no = 0;
				$startRow=($page-1)*$dataPerPage;
				$no = $startRow;
				
				if (isset($_GET['Berdasarkan']) && !empty($_GET['Berdasarkan']) && isset($_GET['isi']) && !empty($_GET['isi']))
				{
				$berdasarkan =  mysql_real_escape_string($_GET['Berdasarkan']);
				$isi =  mysql_real_escape_string($_GET['isi']);
				$querytabel="SELECT * FROM data_pengumuman where $berdasarkan like '%$isi%'  LIMIT $startRow ,$dataPerPage";
				$querypagination="SELECT COUNT(*) AS total FROM data_pengumuman where $berdasarkan like '%$isi%'";
				}
				else
				{
				$querytabel="SELECT * FROM data_pengumuman  LIMIT $startRow ,$dataPerPage";
				$querypagination="SELECT COUNT(*) AS total FROM data_pengumuman";
				}
				$proses = mysql_query($querytabel);
				while ($data = mysql_fetch_array($proses))
				  { ?>
			  <form name="lala" id="lala" action="" method="get">
              <div class="row agency-box">
					<div class="col-sm-3 col-md-2">
						<div class="logo"width='100%' height='300px' >
							<img src="admin/upload/<?php echo $data['foto']; ?>" class="img-responsive" alt="logo Agency">
						</div>
					</div>
					<div class="col-sm-3 col-md-3 col-sm-push-6 col-md-push-7">
						
					</div>
					<div class="col-sm-6 col-md-6 center-box col-sm-pull-3 col-md-pull-3">
						<h1 class="title"><a href="?p=pengumuman&a&judul=<?php echo $data['judul']; ?>"><?php echo $data['judul']; ?></a></h1>
						<p class=""><i style='font-size:24px' class='far'>&#xf073;</i> &nbsp;<?php echo format_indo($data['tanggal']); ?></p>
						<span><?php echo (substr($data['isi'],0,100)); ?>. </span>
						<div class="button-container">
							<a class="btn btn-default" href="index.php?p=pengumuman&a&judul=<?php echo $data['judul'];?>">View Details</a>
							<a class="btn btn-danger" href="admin/upload/<?php echo $data['upload_file']; ?>">Download</a>
						</div>
					</div>
				</div>
				</form>
				  <?php } ?>
</div>
</div>


 	<div class="col-md-3">
						<div class="section-title line-style no-margin">
							<h3 class="title">Search Post</h3>
						</div>
						<div class="blog-search">
						<form name="formcari" id="formcari" action="" method="get">
						
						 <input name="p" value="pengumuman" id="page" type="hidden">
                        <input
                            value="judul"
                            type="hidden"
                            name="Berdasarkan"
                            id="Berdasarkan">



						 <input type="text" name="isi" value="">
                                <?php
										if (isset($_GET['Berdasarkan']))
										{
											btn_cari('Cari');
											?>
                              <!--  <a class="btn btn-primary" href="index.php?p=pengumuman">
                                   Reset 
                                </a> -->
                            <?php
										}
										else
										{
											?>

                                <?php
											btn_cari('Cari');
											
										}
								?>
							
							</form>
						</div>
						<div class="section-title line-style">
							<h3 class="title">Update News</h3>
						</div>
						
						<ul class="category-list">
							
							 <?php
				$querytabel="SELECT * FROM data_pengumuman ORDER BY tanggal DESC LIMIT 0 ,15";
				$proses = mysql_query($querytabel);
				while ($data = mysql_fetch_array($proses))
				{ ?>
			
							<li><a href="index.php?p=pengumuman&a&judul=<?php echo $data[$judul];?>"><?php echo $data['judul']; ?></a></li>
				<?php } ?>
						</ul>
       </div>
 
</div>
</section>

<?php Pagination_font_end($page,$dataPerPage,$querypagination); ?>

</div>
</div>

<!----- Detail Halaman ------>


<?php
} 

else {
$sql=mysql_query("SELECT * FROM $tabel where $judul = '".mysql_real_escape_string($_GET['judul'])."'");
$data=mysql_fetch_array($sql);
?>

<?php  $judul = mysql_real_escape_string($_GET['judul']);

 $id_pengumuman = baca_database('','id_pengumuman',"select * from data_pengumuman where judul = '$judul'"); 
 $foto = baca_database('','foto',"select * from data_pengumuman where judul = '$judul'"); 
 $isi = baca_database('','isi',"select * from data_pengumuman where judul = '$judul'"); ?>

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
									<h3 class="title">Pengumuman Update</h3>
								</div>
								
									
							<?php
			
			$querytabel="SELECT * FROM data_pengumuman ORDER BY tanggal DESC LIMIT 0 ,10";
			$proses = mysql_query($querytabel);
			while ($data = mysql_fetch_array($proses))
			  { ?>
		  
								<div class="agent-box-card grey">
									<div class="image-content">
										<div class="image image-"  style="">
											<a href="index.php?p=pengumuman&a&judul=<?php echo $data['judul'];?>" > 
											
											<img alt="Image Sample"  src="admin/upload/<?php echo $data['foto']; ?>" class="" style="width: 100%; height: 100%; top: 0px; left: -44px;"> </a>
										</div>						
									</div>
									<div class="info-agent">
										<a href="index.php?p=pengumuman&a&judul=<?php echo $data['judul'];?>"  ><span class="name" href="index.php?p=pengumuman&a&judul=<?php echo $data['judul'];?>" ><?php echo $data['judul']; ?> </a>
										
										
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