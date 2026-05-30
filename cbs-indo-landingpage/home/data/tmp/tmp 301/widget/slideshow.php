<?php 
function slideshow()
{ 
	include_once "home/include/settings/settings.php";
?>



<!-- banner -->
<section class="banner_w3lspvt" id="home">
	<div class="csslider infinity" id="slider1">
		<input type="radio" name="slides" checked="checked" id="slides_1"/>
		<input type="radio" name="slides" id="slides_2"/>
		<input type="radio" name="slides" id="slides_3"/>

		<ul class="banner_slide_bg">
			<li>
				<div class="slider-info bg1">
					<div class="bs-slider-overlay">
						<div class="banner-text">
							<div class="container">
								
								<h2 class="movetxt agile-title text-capitalize"><?php echo $judul_slide;?>
								</h2>
									<h5>Website Ilham Modelling School</h5>
								
								<a href="<?php echo $link_slide;?>" class="btn"><?php echo $tombol_slide;?></a>
							</div>
						</div>
					</div>
				</div>
			</li>
			<li>
				<div class="slider-info bg2">
					<div class="bs-slider-overlay1">
						<div class="banner-text">
							<div class="container">
								
								<h2 class="movetxt agile-title text-capitalize"><?php echo $judul_slide;?>
								</h2>
									<h5>Website Ilham Modelling School</h5>
								
								<a href="<?php echo $link_slide;?>" class="btn"><?php echo $tombol_slide;?></a>
							</div>
						</div>
					</div>
				</div>
			</li>
			<li>
				<div class="slider-info bg3">
					<div class="bs-slider-overlay1">
						<div class="banner-text">
							<div class="container">
								<h2 class="movetxt agile-title text-capitalize"><?php echo $judul_slide;?>
								</h2>
									<h5>Website Ilham Modelling School</h5>
								
								<a href="<?php echo $link_slide;?>" class="btn"><?php echo $tombol_slide;?></a>
							</div>
						</div>
					</div>
				</div>
			</li>
		</ul>
		<div class="navigation"> 
			<div>
			  <label for="slides_1"></label>
			  <label for="slides_2"></label>
			  <label for="slides_3"></label>
			</div>
		</div>
	</div>
</section>
<!-- //banner -->

			

<?php } ?>