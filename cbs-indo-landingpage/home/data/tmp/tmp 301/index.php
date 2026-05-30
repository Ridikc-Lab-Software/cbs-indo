<?php 
$url = "home/data/tmp/tmp 301/create/";
$komponen = "home/data/tmp/tmp 301/";
include 'home/include/all_include.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href= "https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700,900" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $url; ?>fonts/icomoon/style.css">

    <link rel="stylesheet" href="<?php echo $url; ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $url; ?>css/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo $url; ?>css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo $url; ?>css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?php echo $url; ?>css/owl.theme.default.min.css">

    <link rel="stylesheet" href="<?php echo $url; ?>css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="<?php echo $url; ?>css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="<?php echo $url; ?>fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="<?php echo $url; ?>css/aos.css">

    <link rel="stylesheet" href="<?php echo $url; ?>css/style.css">
    
  </head>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
  
  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
   
    <div class="border-bottom top-bar py-2 bg-dark" id="home-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <p class="mb-0">
              <span class="mr-3"><strong class="text-white">Phone:</strong> <a href="<?php echo $url; ?>tel://#"> <?php echo $telepon;?>
</a></span>
              <span><strong class="text-white">Email:</strong> <a href= "#"><?php echo $email;?></a></span>
            </p>
          </div>
          <div class="col-md-6">
            <ul class="social-media">
              <li><a href= "#" class="p-2"><span class="icon-facebook"></span></a></li>
              <li><a href= "#" class="p-2"><span class="icon-twitter"></span></a></li>
              <li><a href= "#" class="p-2"><span class="icon-instagram"></span></a></li>
              <li><a href= "#" class="p-2"><span class="icon-linkedin"></span></a></li>
            </ul>
          </div>
        </div>
      </div> 
    </div>

    <header class="site-navbar py-4 bg-white js-sticky-header site-navbar-target" role="banner">

      <div class="container">
        <div class="row align-items-center">
          
          <div class="col-12 col-xl-12">
            <h1 class="mb-0 site-logo"><a href="" class="text-black h2 mb-0"><?php echo  ucwords($judul);?><span class="text-primary">.</span> </a></h1>
          </div>
          <div class="col-12 col-md-10 d-none d-xl-block">
            <nav class="site-navigation position-relative text-right" role="navigation">

              <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                <!-- MENU -->
<?php
$m = new SimpleXMLElement('home/include/settings/menu.xml', null, true);
foreach($m as $i){if($i->t == 's' ){
?>
<!-- SINGLE -->
		<?php $apa = $i->n;
		if ($apa=="Login")
		{
			if ((isset($_COOKIE["kodene"])) && (isset($_COOKIE["token_user"])))
			{
				$kodene = decrypt($_COOKIE["kodene"]);
				$ip = $_SERVER['REMOTE_ADDR']; 
				$useragent = $_SERVER['HTTP_USER_AGENT'];
				$token = sha1($ip.$useragent.$key);
				$token = crypt($token, $key);
				if ($_COOKIE['token_user'] == $token)
				{
					$token = "ada";
				}
				else
				{
					$token = "";
				}
				$kode = cek_database("","","","select * from data_pelanggan where id_pelanggan='$kodene'");
			}
			else
			{
				$token = "";
				$kode ="";
			}
			if ($kode=="ada" && $token=="ada")
			{
			?>
			<!--
			<li class="nav-item"> <a class="nav-link" href="index.php?p=login&action=akun">Akun</a> </li>
			-->
			<li class="nav-item"> <a class="nav-link" href="index.php?p=login&action=logout">Logout</a> </li>
			<?php	 
			}
			else
			{
			?>
			<li class="nav-item"> <a class="nav-link" href="index.php?p=login&action=logout"><?php echo $i->n;?></a> </li>
			<?php
			}
		}
		else
		{
		?>
		 <li class="nav-item"> <a class="nav-link" href="<?php echo $i->l;?>"><?php echo $i->n;?></a> </li>
		<?php } ?>
<!-- /SINGLE -->
<?php
}else if($i->t == 'm' ){ $idmenu = $i->id;
?>
<!-- MULTI -->
		<li  class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $i->n;?><b class="caret hidden"></b></a>
		<ul class="dropdown-menu agile_short_dropdown">
		<?php
		$m1 = new SimpleXMLElement('home/include/settings/menu.xml', null, true);
		foreach($m1 as $i1) {
		if($i1->s=="$idmenu" and $i1->t=="sm" ){
		?>
			<li><li>
			<a class="item" onclick="window.location = '<?php echo $i1->l;?>'">
			<?php echo $i1->n;?></a>
			</li></li>
		<?php }} ?>
		</ul>
		</li>
<!-- /MULTI -->
		<?php }} ?>
<!-- /MENU -->
              </ul>
            </nav>
          </div>


          <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a href= "#" class="site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>

        </div>
      </div>
      
    </header>

 	<?php if(isset($_GET['p']) && ($_GET['p'] =="Home" or $_GET['p'] =="home")) { ?>

    <div class="site-blocks-cover overlay" style="background-image: url(<?php echo $slide_a1;?>);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">

          <div class="col-md-12" data-aos="fade-up" data-aos-delay="400">
                        
            <div class="row justify-content-center mb-4">
              <div class="col-md-8 text-center">
                <h1><?php echo  ucwords($judul);?> <span class="typed-words"></span></h1>
                <p class="lead mb-5">Selamat Datang <a href= "#" target="_blank">Pengunjung</a></p>
                <div><a data-fancybox data-ratio="2" href= "index.php?p=profil" class="btn btn-primary btn-md">Our Profile</a></div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>  


    

    <section class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-4">
            <div class="p-3 box-with-humber">
              <div class="number-behind">01.</div>
              <h2 class="text-primary">VISI</h2>
              <p class="mb-4">“ DESA BUTANG BARU DESA MANDIRI “.</p> <br>
			  <p class="mb-4">( Maju Pintar Berdaya Saing Rajin Dan Berakhlak Mulia</p>
              <ul class="list-unstyled ul-check primary">
               Rumusan Visi tersebut merupakan suatu ungkapan dari suatu niat yang luhur untuk memperbaiki dalam Penyelenggaraan Pemerintahan dan Pelaksanaan Pembangunan di Desa Butang Baru baik secara individu maupun kelembagaan sehingga 6 ( enam ) tahun ke depan Desa Butang Baru mengalami suatu perubahan yang lebih baik dan peningkatan kesejahteraan masyarakat dilihat dari segi ekonomi dengan dilandasi semangat kebersamaan dalam Penyelenggaraan Pemerintahan dan Pelaksanaan Pembangunan.
              </ul>
            </div>
          </div>

          <div class="col-md-6 col-lg-4">
            <div class="p-3 box-with-humber">
              <div class="number-behind">02.</div>
              <h2 class="text-primary">MISI</h2>
              
              <ul class="list-unstyled ul-check primary">
                <li>Meningkatkan sumber sumber pendanaan pemerintahan  dan pembangunan serta perekonomian desa;</li>
                <li>Menciptakan pemerintahan yang baik (good government) berdasarkan demokratisasi, transparansi. yang efisien, efektif dan bersih;</li>
                <li>Meningkatkan sarana dan prasarana fisik ( infrastruktur ) serta pelayanan kesejahteraan sosial masyarakat di bidang pendidikan, kesehatan, kebudayaan, keagamaan, dan olah raga;</li>
                <li>Menentukan kebijakan yang akan mendorong perkembangan dunia pendidikan dan mewujudkan pembangunan moral spiritual melalui bidang agama dan budaya;</li>
                <li>Menciptakan rasa aman dan tentram dalam suasana kehidupan masyarakat desa yang demokrasi dan agamis.</li>
              </ul>
            </div>
          </div>

          <div class="col-md-6 col-lg-4">
            <div class="p-3 box-with-humber">
              <div class="number-behind">03.</div>
              <h2 class="text-primary">Profil Desa</h2>
              <p class="mb-4">Profil Desa merupakan gambaran menyeluruh mengenai karakter desa yang meliputi sejarah desa dan kondisi umum desa, yang memuat letak geografis desa, data dasar keluarga, potensi sumber daya alam, sumber daya manusia, kelembagaan, prasarana dan sarana, serta perkembangan kemajuan dan permasalahan yang dihadapi desa.  Profil desa ini disusun berdasarkan atas hasil pengkajian melalui musyawarah masyarakat sebagai data primer dan didukung dengan data sekunder dari monografi desa, statistik dan sumber-sumber lain yang sah.</p>
             
            </div>
          </div>
        </div>
      </div>
    </section>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md10"><h2 class="text-white">Let's Get Started</h2></div>
        </div>
      </div>  
    </a>
	
	
	<?php } else { ?>
	
	<br>
	<br>
	<br>
	<br>
	<br>
	
	<section id="page-banner" class="pt-105 pb-110 bg_cover" data-overlay="8">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2><?php echo ucwords($_GET['p']) ?></h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="?p=home">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo ucwords($_GET['p']) ?></li>
                            </ol>
                        </nav>
                    </div>  <!-- page banner cont -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
	
	<?php } ?>
	
	
    <!--====== CATEGORY PART ENDS ======-->
   
    <!--====== ABOUT PART START ======-->
	<br>
  
	<?php include 'halaman.php';?>
	
    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-md-9">
            <div class="row">
              <div class="col-md-5">
                <h2 class="footer-heading mb-4">About Us</h2>
				
                <p>Ini adalah Website Kependudukan Desa Butang Baru yang mengatur tentang kependudukan penduduk Desa Butang Baru.</p>
              </div>
              <div class="col-md-3 ml-auto">
                <h2 class="footer-heading mb-4">Features</h2>
                <ul class="list-unstyled">
                  <li><a href= "?p=profil">About Us</a></li>
                  <li><a href= "?p=galery">Galery</a></li>
                  <li><a href= "?p=formulir">Formulir</a></li>
                  <li><a href= "?p=kontak">Contact Us</a></li>
                </ul>
              </div>
              <div class="col-md-3">
                <h2 class="footer-heading mb-4">Follow Us</h2>
                <a href= "<?php echo $facebook;?>" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
                <a href= "<?php echo $twitter;?>" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
                <a href= "<?php echo $instagram;?>" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                <a href= "<?php echo $google;?>" class="pl-3 pr-3"><span class="icon-youtube
"></span></a>
              </div>
            </div>
          </div>
          <div class="col-md-3">
           <center> <h2 class="footer-heading mb-4">From Us</h2> </center>
           <center> <img width="50" src="admin/data/image/logo/logo.png" alt=""> </center>
				
          </div>
        </div>
        <div class="row pt-5 mt-5 text-center">
          <div class="col-md-12">
            <div class="border-top pt-5">
            <p>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
           <script>document.write(new Date().getFullYear());</script> <?php echo $copyright;?> 
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
            </div>
          </div>
          
        </div>
      </div>
    </footer>

  </div> <!-- .site-wrap -->

  <script src="<?php echo $url; ?>js/jquery-3.3.1.min.js"></script>
  <script src="<?php echo $url; ?>js/jquery-migrate-3.0.1.min.js"></script>
  <script src="<?php echo $url; ?>js/jquery-ui.js"></script>
  <script src="<?php echo $url; ?>js/popper.min.js"></script>
  <script src="<?php echo $url; ?>js/bootstrap.min.js"></script>
  <script src="<?php echo $url; ?>js/owl.carousel.min.js"></script>
  <script src="<?php echo $url; ?>js/jquery.stellar.min.js"></script>
  <script src="<?php echo $url; ?>js/jquery.countdown.min.js"></script>
  <script src="<?php echo $url; ?>js/bootstrap-datepicker.min.js"></script>
  <script src="<?php echo $url; ?>js/jquery.easing.1.3.js"></script>
  <script src="<?php echo $url; ?>js/aos.js"></script>
  <script src="<?php echo $url; ?>js/jquery.fancybox.min.js"></script>
  <script src="<?php echo $url; ?>js/jquery.sticky.js"></script>

  <script src="<?php echo $url; ?>js/typed.js"></script>
            <script>
            var typed = new Typed('.typed-words', {
            strings: ["Web Apps"," WordPress"," Mobile Apps"],
            typeSpeed: 80,
            backSpeed: 80,
            backDelay: 4000,
            startDelay: 1000,
            loop: true,
            showCursor: true
            });
            </script>

  <script src="<?php echo $url; ?>js/main.js"></script>
  


  </body>
</html>