<?php if(empty($p)) { header("Location: index.php?=home"); die(); } ?>

					<?php
					$sql=mysql_query("SELECT * FROM data_profil");
					$data=mysql_fetch_array($sql);
					?>
					
					
					<section id="contact">
			<div class="section-detail">
				<h1>Contact</h1>
				<h2>Our Contact and information about us.</h2>		
			</div>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15953.034774177135!2d103.65139571573656!3d-1.6020850318903301!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e258f17c5532acf%3A0x1d34c1290f22deb7!2sKasang%20Kumpeh%2C%20Kumpeh%20Ulu%2C%20Kabupaten%20Muaro%20Jambi%2C%20Jambi!5e0!3m2!1sid!2sid!4v1600152974449!5m2!1sid!2sid" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
					</div>
					<div class="col-md-9">
					<Br>
					<Br>
					<center><h3><b><?php echo $data['nama']; ?></b></h3></center>
					<Br>
					<Br>
					<Br>
					<center><img alt="Image Sample"  src="admin/upload/<?php echo $data['foto']; ?>" class="" style="width: 50%; height: 50%;"></center>
					<br>
					<br>
					<?php echo $data['deskripsi']; ?>
					
					</div>
					<div class="col-md-3">
						<div class="info-top">
							<h1>Contact</h1>
							<ul class="grey-box">
								<li><?php echo $data['no_telepon']; ?><i class="icon fa fa-phone"></i></li>
								<li><a href="#"><?php echo $data['email']; ?></a><i class="icon fa fa-envelope-o"></i></li>
							</ul>
							
						</div>
						
						<div class="info-top">
							<h1>Alamat</h1>
							<ul class="grey-box">
								<li><?php echo $data['alamat']; ?><i class="icon fa fa-map-marker"></i></li>
								
							</ul>
							
						</div>
						
					</div>
				</div>
			</div>
		</section>