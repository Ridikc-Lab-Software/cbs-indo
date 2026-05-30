				
<?php
					$sql=mysql_query("SELECT * FROM data_profil");
					$data=mysql_fetch_array($sql);
					?>
<section class="about-us-section section-padding">
            <div class="container">
                <div class="row">
 <div class="col col-md-8">
                        <div class="section-title">
                            <span>About us</span>
                            <h2><?php echo $data['nama'];;?></h2>
                        </div>
                        <div class="details">
                            <p><?php echo $data['deskripsi'];?></p>
                            <div class="clearfix">
                                
                            </div>
                            <div class="btns">
                               
                            </div>
                        </div>
                    </div>
                    <div class="col col-md-4">
                        <div class="right-col">
                            <div class="img-holder">
                                <img width="300px" src="admin/data/image/logo/logo.png" alt="">
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div> <!-- end container -->
        </section>
