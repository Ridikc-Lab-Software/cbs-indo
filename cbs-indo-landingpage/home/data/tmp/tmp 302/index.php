<?php 
$url = "home/data/tmp/tmp 302/dustech-industry-factory-html-template/";
$komponen = "home/data/tmp/tmp 302/";
include 'home/include/all_include.php';
?>
<!DOCTYPE html>
<html lang="en">

<!-- dustech/  13 Nov 2019 12:52:03 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="irstheme">

    <title> </title>
    
    <link href="<?php echo $url; ?>assets/css/themify-icons.css" rel="stylesheet">
    <link href="<?php echo $url; ?>assets/css/flaticon.css" rel="stylesheet">
    <link href="<?php echo $url; ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $url; ?>assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo $url; ?>assets/css/owl.carousel.css" rel="stylesheet">
    <link href="<?php echo $url; ?>assets/css/owl.theme.css" rel="stylesheet">
    <link href="<?php echo $url; ?>assets/css/slick.css" rel="stylesheet">
    <link href="<?php echo $url; ?>assets/css/slick-theme.css" rel="stylesheet">
    <link href="<?php echo $url; ?>assets/css/swiper.min.css" rel="stylesheet">
    <link href="<?php echo $url; ?>assets/css/odometer-theme-default.css" rel="stylesheet">
    <link href="<?php echo $url; ?>assets/css/owl.transitions.css" rel="stylesheet">
    <link href="<?php echo $url; ?>assets/css/jquery.fancybox.css" rel="stylesheet">
    <link href="<?php echo $url; ?>assets/css/style.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/a34asdfsd.js" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src= "https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src= "https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- start page-wrapper -->
    <div class="page-wrapper">

        <!-- start preloader -->
        <div class="preloader">
            <div class="loader">
                <div class="gear two">
                    <svg viewbox="0 0 100 100" fill="#131e4a">
                        <path d="M97.6,55.7V44.3l-13.6-2.9c-0.8-3.3-2.1-6.4-3.9-9.3l7.6-11.7l-8-8L67.9,20c-2.9-1.7-6-3.1-9.3-3.9L55.7,2.4H44.3l-2.9,13.6      c-3.3,0.8-6.4,2.1-9.3,3.9l-11.7-7.6l-8,8L20,32.1c-1.7,2.9-3.1,6-3.9,9.3L2.4,44.3v11.4l13.6,2.9c0.8,3.3,2.1,6.4,3.9,9.3      l-7.6,11.7l8,8L32.1,80c2.9,1.7,6,3.1,9.3,3.9l2.9,13.6h11.4l2.9-13.6c3.3-0.8,6.4-2.1,9.3-3.9l11.7,7.6l8-8L80,67.9      c1.7-2.9,3.1-6,3.9-9.3L97.6,55.7z M50,65.6c-8.7,0-15.6-7-15.6-15.6s7-15.6,15.6-15.6s15.6,7,15.6,15.6S58.7,65.6,50,65.6z"></path>
                    </svg>
                </div>
                <div class="gear three">
                    <svg viewbox="0 0 100 100" fill="#fd5f17">
                        <path d="M97.6,55.7V44.3l-13.6-2.9c-0.8-3.3-2.1-6.4-3.9-9.3l7.6-11.7l-8-8L67.9,20c-2.9-1.7-6-3.1-9.3-3.9L55.7,2.4H44.3l-2.9,13.6      c-3.3,0.8-6.4,2.1-9.3,3.9l-11.7-7.6l-8,8L20,32.1c-1.7,2.9-3.1,6-3.9,9.3L2.4,44.3v11.4l13.6,2.9c0.8,3.3,2.1,6.4,3.9,9.3      l-7.6,11.7l8,8L32.1,80c2.9,1.7,6,3.1,9.3,3.9l2.9,13.6h11.4l2.9-13.6c3.3-0.8,6.4-2.1,9.3-3.9l11.7,7.6l8-8L80,67.9      c1.7-2.9,3.1-6,3.9-9.3L97.6,55.7z M50,65.6c-8.7,0-15.6-7-15.6-15.6s7-15.6,15.6-15.6s15.6,7,15.6,15.6S58.7,65.6,50,65.6z"></path>
                    </svg>
                </div>
            </div>
        </div>
        <!-- end preloader -->



        <!-- Start header -->
        <header id="header" class="site-header header-style-1" style="background-color: rgb(0 0 0 / 54%)">
            <nav class="navigation navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="open-btn">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href=""><img src="admin/data/image/logo/logo2.png" alt=""style="width:60px" ></a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse navigation-holder">
                        <button class="close-navbar"><i class="ti-close"></i></button>
                        <ul class="nav navbar-nav">
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
                    </div><!-- end of nav-collapse -->

                    <div class="search-contact">
                      
                        <div class="contact">
                            <div class="call">
                                <i class=""></i>
                               
                            </div>
                            <a target="blank" href= "mailto:<?php echo baca_database('data_profil','email',"select * From data_profil"); ?>?subject=Informasi" class="theme-btn">Hubungi Kami</a>
                        </div>
                    </div>
                </div><!-- end of container -->
            </nav>
        </header>
        <!-- end of header -->

	<?php if(isset($_GET['p']) && ($_GET['p'] =="Home" or $_GET['p'] =="home")) { ?>
			
        <!-- start of hero -->
        <section class="hero-slider hero-style-1">
            <div class="swiper-container">
                <div class="swiper-wrapper">
				<?php 
							
				
				$querytabel1="SELECT * FROM data_header";
				$proses1 = mysql_query($querytabel1);
				while ($data1 = mysql_fetch_array($proses1))
				  {
 $id_header= $data1['id_header'];
			  ?>
                    <div class="swiper-slide" >
                        <div class="slide-inner slide-bg-image" style="width:100%;height:680px" data-background="membercard/admin/upload/<?php echo $data1['foto'];?>">
                            <div class="container">
                                <div data-swiper-parallax="300" class="slide-title" style="background-color: rgb(0 0 0 / 54%)">
                                    <h2 style="font-size:50px"><?php echo $data1['judul'];?></h2>
                                </div>
                                <div data-swiper-parallax="400" class="slide-text" style="background-color: rgb(0 0 0 / 54%)">
                                    <p><?php echo $data1['keterangan'];?></p>
                                </div>
                                <div class="clearfix"></div>
                                
                            </div>
                        </div> <!-- end slide-inner --> 
                    </div> <!-- end swiper-slide -->
				  <?PHP } ?>
			  </div>
                <!-- end swiper-wrapper -->

                <!-- swipper controls -->
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </section>
        <!-- end of hero slider -->


        <!-- start about-us-section -->
   <!--     <section class="about-us-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col col-md-6">
                        <div class="section-title">
                            <span>About us</span>
                            <h2>We set the standards others try to live up to.</h2>
                        </div>
                        <div class="details">
                            <p>It wasn't a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright</p>
                            <div class="clearfix">
                                <ul>
                                    <li><i class="ti-check"></i> Cut out of an illustrated magazine</li>
                                    <li><i class="ti-check"></i> Showed a lady fitted out</li>
                                </ul>
                                <ul>
                                    <li><i class="ti-check"></i> Raising a heavy fur muff</li>
                                    <li><i class="ti-check"></i> Magazine and housed in a nice</li>
                                </ul>
                            </div>
                            <div class="btns">
                                <a href= "#" class="theme-btn">Our Services</a>
                                <a href= "#" class="theme-btn-s3">Contact with us</a>
                            </div>
                        </div>
                    </div>
                    <div class="col col-md-6">
                        <div class="right-col">
                            <div class="img-holder">
                                <img src="<?php echo $url; ?>assets/images/about.png" alt>
                            </div>
                            <div class="video-holder">
                                <a href= "https://www.youtube.com/embed/7e90gBu4pas?autoplay=1" class="hero-video-btn video-btn"  data-type="iframe" tabindex="0"><i class="fi flaticon-play-button"></i>Watch our intro video</a> 
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end container -->
        </section>
        <!-- end about-us-section -->
		
<br>
<br>
<br>

<section class="fun-fact-section">
            <div class="container">
                <div class="row">
                    <div class="col col-xs-12">
                        <div class="fun-fact-grids clearfix">
                            <div class="grid">
                                <div class="info">
                                    <i class="fi flaticon-worker"></i>
                                    <h3><span class="odometer odometer-auto-theme" data-count="28"><div class="odometer-inside"><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">1</span></span></span></span></span><span class="odometer-formatting-mark">,</span><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">2</span></span></span></span></span><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">0</span></span></span></span></span><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">0</span></span></span></span></span></div></span>+</h3>
                                    <p>Team Work</p>
                                </div>
                            </div>
                            <div class="grid">
                                <div class="info">
                                    <i class="fi flaticon-engineer"></i>
                                    <h3><span class="odometer odometer-auto-theme" data-count="5"><div class="odometer-inside"><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">1</span></span></span></span></span><span class="odometer-formatting-mark">,</span><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">5</span></span></span></span></span><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">0</span></span></span></span></span><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">0</span></span></span></span></span></div></span>+</h3>
                                    <p>Fasilitas</p>
                                </div>
                            </div>
                            <div class="grid">
                                <div class="info">
                                    <i class="fi flaticon-24-hours"></i>
                                    <h3><span class="odometer odometer-auto-theme" data-count="24"><div class="odometer-inside"><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">2</span></span></span></span></span><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">5</span></span></span></span></span></div></span> Jam</h3>
                                    <p> Layanan SPBU 24 Jam</p>
                                </div>
                            </div>
                            <div class="grid">
                                <div class="info">
                                    <i class="fi flaticon-like-1"></i>
                                    <h3><span class="odometer odometer-auto-theme" data-count="90"><div class="odometer-inside"><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">1</span></span></span></span></span><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">0</span></span></span></span></span><span class="odometer-digit"><span class="odometer-digit-spacer">8</span><span class="odometer-digit-inner"><span class="odometer-ribbon"><span class="odometer-ribbon-inner"><span class="odometer-value">0</span></span></span></span></span></div></span>%</h3>
                                    <p>Kepuasan Pelanggan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end container -->
        </section>
        <!-- start service-section -->
        



   <section class="testimonials-section">
        <?php
    $sql = mysql_query("SELECT * FROM data_slide");
    $data = mysql_fetch_array($sql);


 ?>
            <div class="container">
                <div class="row">
                    <div class="col col-lg-6 col-lg-offset-3">
                        <div class="section-title-s4">
                            <span>PT. Cahaya Bungo Sarkopalma</span>
                            <h2><?php echo $data['header']?></h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-md-4">
                        <div class="testimonial-left-img-holder">
                            <img src="membercard/admin/upload/<?php echo $data['foto']?>" alt>
                        </div>
                    </div>
                    <div class="col col-md-8">
                        <div class="testimonial-grids testimonial-slider clearfix">
                            <div class="grid">
                                <div class="quote">
                                   <i class="fi flaticon"><a style="font-size:3.75rem; color: #fd5f17; MARGIN : 1em 0 0.3em; display:block"><?php echo $data['judul1'] ?></a></i>
                                    <p><?php  echo ucwords ($data['caption1'])?></p>
                                </div>
                                <div class="client-info" style="padding-left:0px">
                                   
                                    <div class="details">
                                     <h5><?php echo $data['nama'] ?></h5>
                                        <p><?php echo $data['jabatan'] ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="grid">
                                <div class="quote">
                                   <i class="fi flaticon"><a style="font-size:3.75rem; color: #fd5f17; MARGIN : 1em 0 0.3em; display:block"><?php echo $data['judul2'] ?></a></i>
                                    <p><?php  echo ucwords ($data['caption2'])?></p>
                                </div>
                                <div class="client-info" style="padding-left:0px">
                                   
                                    <div class="details">
                                        <h5><?php echo $data['nama'] ?></h5>
                                        <p><?php echo $data['jabatan'] ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="grid">
                                <div class="quote">
                                   <i class="fi flaticon"><a style="font-size:3.75rem; color: #fd5f17; MARGIN : 1em 0 0.3em; display:block"><?php echo $data['judul3'] ?> </a></i>
                                    <p><?php  echo ucwords ($data['caption3']);?></p>
                                </div>
                                  <div class="client-info" style="padding-left:0px">
                                   
                                    <div class="details">
                                     <h5><?php echo $data['nama'] ?></h5>
                                        <p><?php echo $data['jabatan'] ?></p>
                                    </div>
                                </div>
                            </div>
							
							 <div class="grid">
                                <div class="quote">
                                   <i class="fi flaticon"><a style="font-size:3.75rem; color: #fd5f17; MARGIN : 1em 0 0.3em; display:block"><?php echo $data['judul4'] ?></a></i>
                                    <p><?php  echo ucwords ($data ['caption4']);?></p>
                                </div>
                                   <div class="client-info" style="padding-left:0px">
                                   
                                    <div class="details">
                                        <h5>Heri</h5>
                                        <p>Director of PT.Cahaya Bungo Sarkopalma</p>
                                    </div>
                                </div>
                            </div>
							
							 <div class="grid">
                                <div class="quote">
                                   <i class="fi flaticon"><a style="font-size:3.75rem; color: #fd5f17; MARGIN : 1em 0 0.3em; display:block"><?php echo $data['judul5'] ?></a></i>
                                    <p><?php  echo ucwords ($data['caption5']);?></p>
                                </div>
                                   <div class="client-info" style="padding-left:0px">
                                   
                                    <div class="details">
                                        <h5><?php echo $data['nama'] ?></h5>
                                        <p><?php echo $data['jabatan'] ?></p>
                                    </div>
                                </div>
                            </div>
							
							
                        </div>
                    </div>
                </div>
            </div> <!-- end container -->
        </section>
     



       <!-- start why-choose-section -->
        <section class="why-choose-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2">
                        <div class="section-title-s3">
                            <span>Our Service</span>
                            <h2>Kenapa Kami</h2>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-xs-12">
                        <div class="why-choose-grids clearfix">
                            <div class="grid">
                                <i class="fi flaticon-network-1"></i>
                                <h3>Layanan Terbaik</h3>
                                <p>Pelayanan dan kepuasan pelanggan adalah hal yang kami prioritaskan, selain
 pelayanan kami juga memiliki team yang solid operator yang ramah dan siap
 membantu dan melayani anda dengan baik.</p>
                            </div>
                            <div class="grid">
                                <i class="fi flaticon-gear"></i>
                                <h3>Fasilitas Lengkap</h3>
                                <p>Untuk kenyamanan pelanggan kami meyediakan fasilitas yang lengkap yang
mana seperti, musholla, toilet, mesin ATM, Cafe dan pengisian angin yang
tersedia gratis dan tentu nya yang paling utama adalah kebersihan
</p>
                            </div>
                            <div class="grid">
                                <i class="fi flaticon-trophy"></i>
                                <h3>Penghargaan</h3>
                                <p>Pada tahun 2019 SPBU 24.37327 berhasil menerima Sertifikat dan Piagam
 Best Maintained Facility Pasti Pas, serta memiiki beberapa
program untuk meningkatkan kepuasan konsumen dan karyawan dengan cara
memberikan gift terhadap konsumen dan karyawan PT. CBS</p>
                            </div>
                            <div class="grid">
                                <i class="fi flaticon-24-hours"></i>
                                <h3>SPBU 24 Jam</h3>
                                <p>SPBU Kami mayoritas dapat men-support anda selama 24 Jam tanpa henti,
 anda dapat beristirahat untuk beribadah sejenak dengan beberapa fasiitas
 yang kami sediakan.. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end container -->
        </section>
        <!-- end why-choose-section -->


        <!-- start testimonials-section -->
   <!--     <section class="testimonials-section">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-6 col-lg-offset-3">
                        <div class="section-title-s4">
                            <span>Testimonials</span>
                            <h2>What People say’s About us</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-md-4">
                        <div class="testimonial-left-img-holder">
                            <img src="<?php echo $url; ?>assets/images/testimonials/man.png" alt>
                        </div>
                    </div>
                    <div class="col col-md-8">
                        <div class="testimonial-grids testimonial-slider clearfix">
                            <div class="grid">
                                <div class="quote">
                                    <i class="fi flaticon-quote"></i>
                                    <p>“Recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look ”</p>
                                </div>
                                <div class="client-info">
                                    <div class="img-holder">
                                        <img src="<?php echo $url; ?>assets/images/testimonials/img-1.jpg" alt>
                                    </div>
                                    <div class="details">
                                        <h5>Michel jhon</h5>
                                        <p>Manager of Automation</p>
                                    </div>
                                </div>
                            </div>
                            <div class="grid">
                                <div class="quote">
                                    <i class="fi flaticon-quote"></i>
                                    <p>“Recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look ”</p>
                                </div>
                                <div class="client-info">
                                    <div class="img-holder">
                                        <img src="<?php echo $url; ?>assets/images/testimonials/img-2.jpg" alt>
                                    </div>
                                    <div class="details">
                                        <h5>Alaska</h5>
                                        <p>Business Officer</p>
                                    </div>
                                </div>
                            </div>
                            <div class="grid">
                                <div class="quote">
                                    <i class="fi flaticon-quote"></i>
                                    <p>“Recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look ”</p>
                                </div>
                                <div class="client-info">
                                    <div class="img-holder">
                                        <img src="<?php echo $url; ?>assets/images/testimonials/img-3.jpg" alt>
                                    </div>
                                    <div class="details">
                                        <h5>Shain on</h5>
                                        <p>Manager of Automation</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> end container
        </section>
        <!-- end testimonials-section -->


        <!-- start featured-project-section -->
  <!--      <section class="featured-project-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2">
                        <div class="section-title-s5">
                            <span>Featured Projects</span>
                            <h2>Explore What We've Done</h2>
                            <p>Hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-area">
                <div class="project-grids clearfix">
                    <div class="grid">
                        <div class="overlay">
                            <span class="count">01.</span>
                            <h3>Welding Processing</h3>
                            <p>Travelling salesman and above it there hung a picture that he had recently cut out</p>
                            <a href= "#" class="theme-btn">Read More</a>
                        </div>
                    </div>
                    <div class="grid">
                        <div class="overlay">
                            <span class="count">02.</span>
                            <h3>Materials project</h3>
                            <p>Travelling salesman and above it there hung a picture that he had recently cut out</p>
                            <a href= "#" class="theme-btn">Read More</a>
                        </div>
                    </div>
                    <div class="grid">
                        <div class="overlay">
                            <span class="count">03.</span>
                            <h3>Oil & Gas project</h3>
                            <p>Travelling salesman and above it there hung a picture that he had recently cut out</p>
                            <a href= "#" class="theme-btn">Read More</a>
                        </div>
                    </div>
                    <div class="grid">
                        <div class="overlay">
                            <span class="count">04.</span>
                            <h3>Power Energy project</h3>
                            <p>Travelling salesman and above it there hung a picture that he had recently cut out</p>
                            <a href= "#" class="theme-btn">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end featured-project-section -->


        <!-- start partners-section -->
    <!--    <section class="partners-section">
            <h2 class="hidden">Partners</h2>
            <div class="container">
                <div class="row">
                    <div class="col col-xs-12">
                        <div class="partner-grids partners-slider">
                            <div class="grid">
                                <img src="<?php echo $url; ?>assets/images/partners/img-1.jpg" alt>
                            </div>
                            <div class="grid">
                                <img src="<?php echo $url; ?>assets/images/partners/img-2.jpg" alt>
                            </div>
                            <div class="grid">
                                <img src="<?php echo $url; ?>assets/images/partners/img-3.jpg" alt>
                            </div>
                            <div class="grid">
                                <img src="<?php echo $url; ?>assets/images/partners/img-4.jpg" alt>
                            </div>
                            <div class="grid">
                                <img src="<?php echo $url; ?>assets/images/partners/img-5.jpg" alt>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </section>
        <!-- end partners-section -->


        <!-- start fun-fact-section -->
      <!--  <section class="fun-fact-section">
            <div class="container">
                <div class="row">
                    <div class="col col-xs-12">
                        <div class="fun-fact-grids clearfix">
                            <div class="grid">
                                <div class="info">
                                    <i class="fi flaticon-worker"></i>
                                    <h3><span class="odometer" data-count="1200">00</span></h3>
                                    <p>Employed</p>
                                </div>
                            </div>
                            <div class="grid">
                                <div class="info">
                                    <i class="fi flaticon-engineer"></i>
                                    <h3><span class="odometer" data-count="1500">00</span></h3>
                                    <p>Project Completed</p>
                                </div>
                            </div>
                            <div class="grid">
                                <div class="info">
                                    <i class="fi flaticon-trophy"></i>
                                    <h3><span class="odometer" data-count="25">00</span>+</h3>
                                    <p>Award Won</p>
                                </div>
                            </div>
                            <div class="grid">
                                <div class="info">
                                    <i class="fi flaticon-like-1"></i>
                                    <h3><span class="odometer" data-count="100">00</span>%</h3>
                                    <p>Satisfied customers</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end container -->
        </section>
        <!-- end fun-fact-section -->


        <!-- start team-section -->
       <!-- <section class="team-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2">
                        <div class="section-title-s5">
                            <span>Our Team</span>
                            <h2>Dedicated Team</h2>
                            <p>Hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-xs-12">
                        <div class="team-grids">
                            <div class="grid">
                                <div class="img-social">
                                    <div class="img-holder">
                                        <img src="<?php echo $url; ?>assets/images/team/img-1.jpg" alt>
                                    </div>
                                    <div class="social">
                                        <ul>
                                            <li><a href= "#"><i class="ti-facebook"></i></a></li>
                                            <li><a href= "#"><i class="ti-twitter-alt"></i></a></li>
                                            <li><a href= "#"><i class="ti-linkedin"></i></a></li>
                                            <li><a href= "#"><i class="ti-pinterest"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="details">
                                    <h3>Michel Jhon</h3>
                                    <span>Mechanical Engineering</span>
                                </div>
                            </div>
                            <div class="grid">
                                <div class="img-social">
                                    <div class="img-holder">
                                        <img src="<?php echo $url; ?>assets/images/team/img-2.jpg" alt>
                                    </div>
                                    <div class="social">
                                        <ul>
                                            <li><a href= "#"><i class="ti-facebook"></i></a></li>
                                            <li><a href= "#"><i class="ti-twitter-alt"></i></a></li>
                                            <li><a href= "#"><i class="ti-linkedin"></i></a></li>
                                            <li><a href= "#"><i class="ti-pinterest"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="details">
                                    <h3>Wilium Mice</h3>
                                    <span>Site Manager</span>
                                </div>
                            </div>
                            <div class="grid">
                                <div class="img-social">
                                    <div class="img-holder">
                                        <img src="<?php echo $url; ?>assets/images/team/img-3.jpg" alt>
                                    </div>
                                    <div class="social">
                                        <ul>
                                            <li><a href= "#"><i class="ti-facebook"></i></a></li>
                                            <li><a href= "#"><i class="ti-twitter-alt"></i></a></li>
                                            <li><a href= "#"><i class="ti-linkedin"></i></a></li>
                                            <li><a href= "#"><i class="ti-pinterest"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="details">
                                    <h3>Jonthon teat</h3>
                                    <span>Testing Manager</span>
                                </div>
                            </div>
                            <div class="grid">
                                <div class="img-social">
                                    <div class="img-holder">
                                        <img src="<?php echo $url; ?>assets/images/team/img-4.jpg" alt>
                                    </div>
                                    <div class="social">
                                        <ul>
                                            <li><a href= "#"><i class="ti-facebook"></i></a></li>
                                            <li><a href= "#"><i class="ti-twitter-alt"></i></a></li>
                                            <li><a href= "#"><i class="ti-linkedin"></i></a></li>
                                            <li><a href= "#"><i class="ti-pinterest"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="details">
                                    <h3>Shown kel</h3>
                                    <span>Cheif Officer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end container 
        </section>
        <!-- end team-section -->


        <!-- start quote-section -->
       <!-- <section class="quote-section">
            <div class="content-area clearfix">
                <div class="left-col">
                    <h2>Imagination What we can easily see is only a small</h2>
                    <div class="details">
                        <p>It wasn't a dream. His room, a proper human room although a little too small, lay peacefully between its four familiar walls. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame. It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered </p>
                        <div class="clearfix">
                            <ul>
                                <li><i class="ti-check"></i> Cut out of an illustrated magazine</li>
                                <li><i class="ti-check"></i> Showed a lady fitted out</li>
                            </ul>
                            <ul>
                                <li><i class="ti-check"></i> Raising a heavy fur muff</li>
                                <li><i class="ti-check"></i> Magazine and housed in a nice</li>
                            </ul>
                        </div>
                        <div class="btns">
                            <a href= "#" class="theme-btn">Our Services</a>
                            <a href= "#" class="theme-btn-s3">Contact with us</a>
                        </div>
                    </div>
                </div>
                <div class="right-col">
                    <div class="quote-area">
                        <h3>Request A Quote</h3>
                        <p>Lower arm towards the viewer. Gregor then turned to look out the window</p>
                        <form method="post" class="contact-validation-active" id="contact-quote-form">
                            <div>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name*">
                            </div>
                            <div>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email*">
                            </div>
                            <div>
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone*">
                            </div>
                            <div>
                                <textarea class="form-control" name="note"  id="note" placeholder="Case Description..."></textarea>
                            </div>
                            <div class="submit-area">
                                <button type="submit" class="theme-btn">Get a quote</button>
                                <div id="loader">
                                    <i class="ti-reload"></i>
                                </div>
                            </div>
                            <div class="clearfix error-handling-messages">
                                <div id="success">Thank you</div>
                                <div id="error"> Error occurred while sending email. Please try again later. </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- end quote-section -->


        <!-- start blog-section -->
        <section class="blog-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2">
                        <div class="section-title-s5">
                            <span>Sekilas Informasi</span>
                            <h2>Berita Informasi Terbaru</h2>
                            <p>Kami akan memberikan serangkaian informasi dan berita terbaru secara up to
date</p>
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <div class="col col-xs-12">
                        <div class="blog-grids">
						
						<?php 
							
				
				$querytabel1="SELECT * FROM data_berita ORDER BY tanggal DESC LIMIT 0,3";
				$proses1 = mysql_query($querytabel1);
				while ($data1 = mysql_fetch_array($proses1))
				  {
$id_berita= $data1['id_berita'];
			  ?>
                            <div class="grid">
                                <div class="entry-media">
                                    <img src="membercard/admin/upload/<?php echo $data1['foto']; ?>" width="100%" height="220px" alt>
                                </div>
                                <div class="entry-body">
                                 
                                    <h4><a href= "#"><?php echo $data1['judul']; ?></a></h4>
                                    <p class="date"><?php echo format_indo($data1['tanggal']); ?></p>
                                    <a href= "index.php?p=berita&a&Go=<?php echo $data1['judul'];?>" class="read-more">Read More <i class="fi flaticon-next"></i></a>
                                </div>
                            </div>
				  <?php } ?>


					   </div>
                    </div>
                </div>               
            </div> <!-- end container -->
        </section>
        <!-- end blog-section -->





<?php } else { ?>


<section class="page-title">
            <div class="container">
                <div class="row">
                    <div class="col col-xs-12">
                        <h2><?php 
						$taa= $_GET['p'];
						if ($taa=="Tenant") {
							echo "Mitra";
							
						} else {
						echo ucwords($_GET['p']); } ?></h2>
                    </div>
                </div> <!-- end row -->
            </div> <!-- end container -->
        </section>


<?php } ?>

	<?php include 'halaman.php';?>








        <!-- start cta-section -->
        <section class="cta-section">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-5 col-md-6">
                        <div class="cta-text">
                            <h3>Official Contact</h3>
                            <p>Silahkan menghubungi kami untuk mendapatkan informasi lebih lanjut.</p>
                        </div>
                    </div>
                    <div class="col col-lg-6 col-lg-offset-1 col-md-6">
					<?php
					$sql=mysql_query("SELECT * FROM data_profil");
					$data=mysql_fetch_array($sql);
					?>
                        <div class="contact-info">
                            <div>
                                <i class="fi flaticon-call"></i>
                                <h4>Call us</h4>
                                <p><?php echo $data['no_telepon1']; ?></p>
                                 <p><?php echo $data['no_telepon2']; ?></p>
                            </div>
                            <div>
                                <i class="fi flaticon-contact"></i>
                                <h4>Email us</h4>
                                <p><?php echo $data['email']; ?></p>
                            </div>
                        </div>
						<?php ?>
                    </div>
                </div>
            </div> <!-- end container -->
        </section>
        <!-- end cta-section -->


        <!-- start site-footer -->
        <footer class="site-footer">
            <div class="upper-footer">
                <div class="container">
                    <div class="row">
                        <div class="col col-lg-3 col-md-3 col-sm-6">
                            <div class="widget about-widget">
                                <div class="logo widget-title">
                                    <img src="admin/data/image/logo/logo.png" alt>
                                </div>
                              <!--  <p>PT. CBS Merupakan Perusahaan Penyalur BBM, Badan Usaha Niaga Migas untuk kegiatan usaha Niga umum BBM dibawah naungan PT. PERTAMINA PERSERO.</p>-->
                                <div class="social-icons">
                                    <ul>
                                        <li><a href= "https://www.facebook.com/profile.php?id=100005292735721&mibextid=LQQJ4d"><i class="ti-facebook"></i>Facebook Bernai</a></li>
                                        <br>
                                        <li><a href= "https://www.facebook.com/profile.php?id=100079011957832&mibextid=LQQJ4d"><i class="ti-facebook"></i>Facebook Singkut</a></li>
                                        <br>
                                        <li><a href= "https://www.instagram.com/spbu2437327_jambi_1/"><i class="ti-instagram"></i>&nbsp;IG SPBU 24.373.27 </a></li>
                                        <br>
                                         <li><a href= "https://www.instagram.com/spbu2437332_jambi1/"><i class="ti-instagram"></i>&nbsp;IG SPBU 24.373.32  </a></li>
                                         <br>
                                        <li><a href= "https://www.tiktok.com/@spbupunyacerita?is_from_webapp=1&sender_device=pc"><svg class='fontawesomesvg' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Free 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. --><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg>
Tiktok</a></li>
<style>
    .fontawesomesvg {width: 1em;
      height: 1em;
      vertical-align: -.125em;
    }
  </style>
                                       
                                    </ul>
                                    <style> 
                                    .fontawesomeicon::before {
                                        display: inline-block;
                                        text-rendering: auto;
                                        -webkit-font-smoothing: antialiased;
                                     }
                                    
                                    .Tiktok::before {
                                       font: var(--fa-font-brands);
                                        content: ' \e07b';
                                     }
                                     </style>
                                </div>
                            </div>
                        </div>
						 <div class="col col-lg-3 col-md-3 col-sm-6">
                            <div class="widget about-widget">
							<div class="widget-title">
                                    <h3>Sekilas tentang PT. CBS</h3>
                                </div>
						<p>PT. CBS Merupakan Perusahaan Penyalur BBM, Badan Usaha Niaga Migas untuk kegiatan usaha Niga umum BBM dibawah naungan PT. PERTAMINA PERSERO.</p>
						
						</div>
						</div>
                        <div class="col col-lg-3 col-md-3 col-sm-6">
                            <div class="widget link-widget">
                                <div class="widget-title">
                                    <h3>Link Terkait</h3>
                                </div>
                                <ul>
                                    <li><a href= "?p=profil">Tentang</a></li>
                                    <li><a href= "?p=berita">Berita</a></li>
                                    <li><a href= "?p=galery">Galery</a></li>
                                    <li><a href= "?p=tenant">Mitra</a></li>
                                </ul>
                               
                            </div>
                        </div>
                        <div class="col col-lg-3 col-md-3 col-sm-6">
						<?php
					$sql=mysql_query("SELECT * FROM data_profil");
					$data=mysql_fetch_array($sql);
					?>
                            <div class="widget contact-widget service-link-widget">
                                <div class="widget-title">
                                    <h3>Alamat Kami</h3>
                                </div>
                                <ul>
                                    <li><?php echo $data['alamat']; ?></li>
                                    <li><span>Phone SPBU 24.373.27:</span> <?php echo $data['no_telepon1']; ?></li>
                                     <li><span>Phone SPBU 24.373.32:</span> <?php echo $data['no_telepon2']; ?></li>
                                    <li><span>Email:</span> <?php echo $data['email']; ?></li>
                                    <li><span>Office Time:</span> 7AM- 5PM</li>
                                </ul>
                            </div>
							<?php ?>
                        </div>
                       
                    </div>
                </div> <!-- end container -->
            </div>
           
        </footer>
        <!-- end site-footer -->


    </div>
    <!-- end of page-wrapper -->



    <!-- All JavaScript files
    ================================================== -->
    <script src="<?php echo $url; ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo $url; ?>assets/js/bootstrap.min.js"></script>

    <!-- Plugins for this template -->
    <script src="<?php echo $url; ?>assets/js/jquery-plugin-collection.js"></script>

    <!-- Custom script for this template -->
    <script src="<?php echo $url; ?>assets/js/script.js"></script>
</body>

<!-- dustech/  13 Nov 2019 12:54:40 GMT -->
</html>

