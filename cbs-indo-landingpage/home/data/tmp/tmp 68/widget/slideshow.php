<?php 
function slideshow()
{ 
	include_once "home/include/settings/settings.php";
	
?>

<section id="home-slide" class="header-margin-dual-line">
			<div class="home-slider carousel" data-navigation=".home-slider-nav">
				<div class="crsl-wrap">
					<figure class="crsl-item" data-image="home/data/image/background/slide_a1.png">
						<div class="container slider-box">
							<div class="content"><h2>Tour & Travel</h2></div>
							<div class="content"><h1>Haji dan Umrah</h1></div>
							<div class="content"><h3>Almabrur&nbsp;Nadia&nbsp;Insani&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3></div>
						</div>
					</figure>
					<figure class="crsl-item" data-image="home/data/image/background/slide_a2.png">
						<div class="container slider-box">
							<div class="content"><h2>Tour & Travel</h2></div>
							<div class="content"><h1>Haji dan Umrah</h1></div>
							<div class="content"><h3>Almabrur&nbsp;Nadia&nbsp;Insani&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3></div>
						</div>
					</figure>
					<figure class="crsl-item" data-image="home/data/image/background/slide_a3.png">
						<div class="container slider-box">
							<div class="content"><h2>Tour & Travel</h2></div>
							<div class="content"><h1>Haji dan Umrah</h1></div>
							<div class="content"><h3>Almabrur&nbsp;Nadia&nbsp;Insani&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3></div>
						</div>
					</figure>
					
				</div>
				<p class="home-slider-nav previus">
					<a href="<?php echo $url;?>#" class="previous">previous</a>
				</p>
				<p class="home-slider-nav next">
					<a href="<?php echo $url;?>#" class="next">next</a>
				</p>
			</div>
		</section>

			

<?php } ?>