<?php if(empty($p)) { header("Location: index.php?p=home"); die(); } ?>






<section id="grid-content">
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						
						<?php
				$no = 0;
				$startRow=($page-1)*$dataPerPage;
				$no = $startRow;
				
				if (isset($_GET['Berdasarkan']) && !empty($_GET['Berdasarkan']) && isset($_GET['isi']) && !empty($_GET['isi']))
				{
				$berdasarkan =  mysql_real_escape_string($_GET['Berdasarkan']);
				$isi =  mysql_real_escape_string($_GET['isi']);
				$querytabel="SELECT * FROM data_download where $berdasarkan like '%$isi%'  LIMIT $startRow ,$dataPerPage";
				$querypagination="SELECT COUNT(*) AS total FROM data_download where $berdasarkan like '%$isi%'";
				}
				else
				{
				$querytabel="SELECT * FROM data_download  LIMIT $startRow ,$dataPerPage";
				$querypagination="SELECT COUNT(*) AS total FROM data_download";
				}
				$proses = mysql_query($querytabel);
				while ($data = mysql_fetch_array($proses))
				  { ?>
			  
						<div class="box-ads box-list">
							
							<span class="price"><?php echo format_indo($data['tanggal']); ?></span>
							<span class="address"><i class="fa fa-map-marker"></i> <?php echo $data['judul']; ?></span>
							<span class="description"><?php echo $data['isi']; ?>.</span>
							
							<div class="footer">
								Download Dokumen disini
								<a href="admin/upload/<?php echo $data['upload_file']; ?>" class="btn btn-default">Download now</a>
							</div>
						</div><!-- ./box-ads -->

				  <?php }?>	
					</div><!-- ./col-md-9 -->
					<div class="col-md-3">

						<button id="add-property" class="btn btn-default" type="button"><i class="icon fa fa-plus-square"></i> Another Download</button>
						<!-- ===================== filter ===================== -->
						<div class="section-title line-style no-margin">
							<h3 class="title">Semua</h3>
						</div>
						<div id="filter-box">
						
						<?php
			
			$querytabel="SELECT * FROM data_download ORDER BY tanggal DESC LIMIT 0 ,20";
			$proses = mysql_query($querytabel);
			while ($data = mysql_fetch_array($proses))
			  { ?>
							<a href="index.php?p=download&a&judul=<?php echo $data['judul'];?>" class="filter"><?php echo $data['judul'];?><i class="fa fa-times"></i></a>
							
			  <?php } ?>	
							
						</div>

					</div><!-- ./col-md-3 -->
				</div><!-- ./row -->
			</div><!-- ./container -->
			<!-- pagination -->	
			
		</section>