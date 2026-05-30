				
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
		