<?php if(empty($p)) { header("Location: index.php?p=home"); die(); } 
?>


<section class="team-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2">
                        <div class="section-title-s5">
                            <span>Mitra Kami</span>
                            <h2>Kolaborasi Mitra</h2>
                          
                        </div>
                    </div>
                </div>
				 <div class="col col-xs-12">
                <div class="row">
                   
                       
					   
					   <?php
					$querytabel="SELECT * FROM data_tenant";
				$proses = mysql_query($querytabel);
				while ($data = mysql_fetch_array($proses))
				{ 
					?>
					
					
					   <div class="col-md-3">
					   <div class="team-grids">
                           
                                <div class="img-social">
                                    <div class="img-holder">
                                        <img src="admin/upload/<?php echo $data['foto']; ?>" alt="">
                                    </div>
                                  
                                </div>
                                <div class="details">
                                    <h3><?php echo $data['nama_tenant']; ?></h3>
                                    <span><?php echo $data['website']; ?></span>
                                </div>
                          
                        </div>
                        </div>
						
				<?php } ?>
						
                    </div>
                </div>
            </div> <!-- end container -->
        </section>