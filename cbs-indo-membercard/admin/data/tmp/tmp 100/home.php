		
		
		<div class="row-fluid ">
				<div class="span2">
					<div class="board-widgets orange small-widget">
						<a href="../data_member/index.php"><span class="widget-stat"><?php total("data_member","");?></span><span class="widget-icon icon-user"></span><span class="widget-label">Member	</span></a>
					</div>
				</div>
				<div class="span2">
					<div class="board-widgets blue-violate small-widget">
						<a href="../data_transaksi/index.php"><span class="widget-stat"><?php total("data_transaksi","");?></span><span class="widget-icon icon-book"></span><span class="widget-label">Transaksi </span></a>
				
					</div>
				</div>
				<div class="span2">
					<div class="board-widgets  magenta small-widget">
							<a href="../data_redeem/index.php"><span class="widget-stat"><?php total("data_redeem","");?></span><span class="widget-icon icon-paste"></span><span class="widget-label"> Redeem</span></a>
						</div>
				</div>
				<div class="span2">
					<div class="board-widgets green small-widget">
						<a href="../data_promo/index.php"><span class="widget-stat"><?php total("data_promo","");?></span><span class="widget-icon icon-file"></span><span class="widget-label"> Promo</span></a>
					</div>
				</div>
				<div class="span2">
					<div class="board-widgets blue small-widget">
						<a href="../data_mitra/index.php"><span class="widget-stat"><?php total("data_mitra","");?></span><span class="widget-icon fas fa-indent"></span><span class="widget-label"> Mitra	</span></a>
					</div>
				</div>

				<div class="span2">
					<div class="board-widgets brown small-widget">
						<a href="../data_berita/index.php"><span class="widget-stat"><?php total("data_berita","");?></span><span class="widget-icon far fa-map"></span><span class="widget-label"> BERITA</span></a>
					</div>
				</div>
			</div>
			<div class="widget-head bondi-blue" style="
    background: #929292;
">
							<h3>Informasi Aplikasi</h3>
						</div>
			<div class="hero-unit">
			
			<div class="row-fluid ">
			
				<div class="span2" style="width: 100px;">
				<img width="100" src="../../../data/image/logo/logo.png">
				</div>
				<div class="span9">
				<h3><i class="icon-copy"></i> Selamat Datang</h3>
						<p 
						style="
    margin-bottom: 1px;
    padding: 1px;
    line-height: 23px;
"
						>
							 Aplikasi E-Member Card PT.CBS <br>
							 Cahaya Bungo Sarkopalma
						</p>
				</div>
			
					
					</div>
					</div>
				
			

			<div class="row-fluid">
				<div class="span6">
					<div class="content-widgets gray">
						<div class="widget-head blue">
							<h3>Data Transaksi Terbaru</h3>
						</div>
						<div class="widget-container">
							<ul class="sample-noty">
				<?php
				$querytabel="SELECT * FROM data_transaksi order by id_transaksi desc LIMIT 0 ,10 ";
				$proses = mysql_query($querytabel);
				while ($data = mysql_fetch_array($proses))
				  { ?> 
			
                	<li><a href="../data_transaksi/?Berdasarkan=id_transaksi&isi=<?php echo ($data['id_transaksi']);?>" id="remove-all-with-callbacks"><?php echo format_indo($data['tanggal']);?></a>
					: <?php echo ($data['jam']);?> : <?php echo ($data['id_jenis_transaksi']);?>
					</li>            
			
            	<?php } ?> 
							
								<br><br>
							</ul>
						</div>
					</div>
					<div>
					</div>
				</div>
				<div class="span6">
					<div class="content-widgets gray">
						<div class="widget-head bondi-blue">
							<h3>Data Redeem Terbaru</h3>
						</div>
						<div class="widget-container">
							<ul class="sample-noty">
								<?php
								$querytabel="SELECT * FROM data_redeem order by id_redeem desc LIMIT 0 ,10";
								$proses = mysql_query($querytabel);
								while ($data = mysql_fetch_array($proses))
								  { ?> 
								
								<li><a href="../data_redeem/?Berdasarkan=id_redeem&isi=<?php echo ($data['id_redeem']);?>" id="remove-all-with-callbacks"><?php echo format_indo($data['tanggal']);?></a>
					: <?php echo ($data['jam']);?> : <?php 
					
					$id_promo =  ($data['id_promo']);
					echo baca_database("","nama_promo","select * from data_promo where id_promo='$id_promo'");
					?>
					</li>      
							
								
								<?php  } ?>
								<br><br>
							</ul>
						</div>
					</div>
				</div>
			</div>