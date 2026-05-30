<?php if(empty($p)) { header("Location: index.php?p=home"); die(); } 
?>

				
<?php
					$sql=mysql_query("SELECT * FROM data_profil");
					$data=mysql_fetch_array($sql);
					?>
                   
		
		
		<section class="service-single-section section-padding">
		 <div class="container">
                <div class="row">
		<div class="service-single-content">
                            
                            <div class="service-single-tab clearfix">
                                <ul class="nav">
                                    <li class="">
                                        <a href="#precautions" data-toggle="tab" aria-expanded="false">VISI</a>
                                    </li>
                                    <li class="">
                                        <a href="#intelligence" data-toggle="tab" aria-expanded="false">MISI</a>
                                    </li>
                                    <li class="active">
                                        <a href="#specializations" data-toggle="tab" aria-expanded="true">Sejarah</a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane fade" id="precautions">
                                        <p><?php echo $data['visi'];?></p>
                                    </div>
                                    <div class="tab-pane fade" id="intelligence">
                                        <p><?php echo $data['misi'];?></p>
                                    </div>
                                    <div class="tab-pane fade active in" id="specializations">
                                        <p><?php echo $data['sejarah'];?></p>
                                    </div>
                                </div>
                            </div>
                                               
                        </div>
                        </div>
                        </div>
		</section>
		
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
                                <img width="300px" src="membercard/admin/upload/<?php echo $data['foto'];?>" alt="">
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div> <!-- end container -->
        </section>
 <section class="contact-map-section">
            <h2 class="hidden">Contact map</h2>
            <div class="contact-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3986.5957508640845!2d102.6949025790911!3d-2.302986811209193!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2e2e95ebba397b%3A0x1e9954f89af85636!2sSPBU%20NO%2024%20373%2027%20Sarolangun!5e0!3m2!1sid!2sid!4v1612238891454!5m2!1sid!2sid" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </section>
        <!-- end contact-map -->