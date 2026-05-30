<?php 
$url = "home/data/tmp/tmp 68/proalmab/";
$komponen = "home/data/tmp/tmp 68/";
include 'home/include/all_include.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">

	<link rel="stylesheet" href="<?php echo $url;?>css/bootstrap.min.css">                            
    <link rel="stylesheet" href="<?php echo $url;?>css/vendor/font-awesom/css/font-awesome.min.css">  
	<link rel="stylesheet" href="<?php echo $url;?>css/vendor/mmenu/jquery.mmenu.all.css" />          
	<link rel="stylesheet" href="<?php echo $url;?>css/vendor/animate-wow/animate.css">               

    <link rel="stylesheet" href="<?php echo $url;?>css/vendor/labelauty/labelauty.css">               
	<link rel="stylesheet" href="<?php echo $url;?>css/vendor/nouislider/nouislider.min.css">         
    <link rel="stylesheet" href="<?php echo $url;?>css/vendor/easydropdown/easydropdown.css">         
	<link rel="stylesheet" href="<?php echo $url;?>css/vendor/fotorama/fotorama.css">                                
    <link rel="stylesheet" href="<?php echo $url;?>css/ui-spinner.css">                               
    

	<link rel="stylesheet" href="<?php echo $url;?>css/menu.css">                                     
	<link rel="stylesheet" href="<?php echo $url;?>css/custom.css">                                   
    <link rel="stylesheet" href="<?php echo $url;?>css/media-query.css">  

    <style>
    	img{
    		object-fit: cover;
    	}
    </style>    


	<script src="<?php echo $url;?>script/modernizr.min.js"></script> 

  </head>
  <body class="fixed-header">

	<div id="page-container">
	

	
		<header class="menu-dual-line" id="header-container-box">
			<div class="info"><!-- info -->
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<a id="mobile-menu-button" href="#mobile-menu" class="visible-xs"><i class="fa fa-bars"></i></a>
							<a class="hidden-xs" href="call:1-800-555-1234"><i class="icon fa fa-phone"></i> <?php echo $telepon;?></a>
							<a class="hidden-xs" data-section="modal-contact" data-target="#modal-contact" data-toggle="modal" href="#"><i class="icon fa fa-envelope-o"></i> <?php echo $email;?></a>
							
						</div>
						
						<div id="login-pan" class="col-md-6 hidden-xs">
							<?php
							if (isset($_COOKIE['token_user']))
							{ 
						?>
						<a  href="" ><i class="icon fa fa-time"></i><div id="clock"></div>
		<script type="text/javascript">
		<!--
		function showTime() {
		    var a_p = "";
		    var today = new Date();
		    var curr_hour = today.getHours();
		    var curr_minute = today.getMinutes();
		    var curr_second = today.getSeconds();
		    if (curr_hour < 12) {
		        a_p = "AM";
		    } else {
		        a_p = "PM";
		    }
		    if (curr_hour == 0) {
		        curr_hour = 12;
		    }
		    if (curr_hour > 12) {
		        curr_hour = curr_hour - 12;
		    }
		    curr_hour = checkTime(curr_hour);
		    curr_minute = checkTime(curr_minute);
		    curr_second = checkTime(curr_second);
		 document.getElementById('clock').innerHTML=curr_hour + ":" + curr_minute + ":" + curr_second + " " + a_p;
		    }
 
		function checkTime(i) {
		    if (i < 10) {
		        i = "0" + i;
		    }
		    return i;
		}
		setInterval(showTime, 500);
		//-->
		</script></a >
 
		<!-- Menampilkan Hari, Bulan dan Tahun -->
<a ><i class="icon fa fa-date"></i>
		<script type='text/javascript'>
			<!--
			var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
			var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
			var date = new Date();
			var day = date.getDate();
			var month = date.getMonth();
			var thisDay = date.getDay(),
			    thisDay = myDays[thisDay];
			var yy = date.getYear();
			var year = (yy < 1000) ? yy + 1900 : yy;
			document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
			//-->
		</script></a>
					
						
						<?php
						} else { ?>
						<a  data-toggle="modal" data-target=".login-modal" data-section="sign-in"><i class="icon fa fa-pencil-square-o"></i> Pendaftaran</a>
						<a data-toggle="modal" data-target=".login-modal"  data-section="login"><i class="icon fa fa-user user"></i> Login</a>
							<?php } ?>
						</div>
						
					</div>
				</div>			
			</div><!-- /.info -->
			
			<div class="modal fade login-modal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
			<div class="modal-dialog">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
				<div class="login-button-container">
					<a href="#" data-section="login" class=""><i class="fa fa-user"></i></a>
					<a href="#" data-section="sign-in" class=""><i class="fa fa-pencil-square-o"></i></a>
					
					<a href="#" data-section="setting" class=""><i class="fa fa-cog"></i></a>
				</div><!-- ./login-button-container -->
				<div class="form-container">
					<form method="post" action="cek_login.php">
						<div id="login" class="box" style="display: none;" wfd-invisible="true">
							<h2 class="title">Silahkan Login</h2>
							<h3 class="sub-title">Silahkan Masukkan Username Dan Password dibawah ini.</h3>
							<div class="field">
								<input id="user-log" name="username" class="form-control" type="text" placeholder="Username">
								<i class="fa fa-user user"></i>
							</div>
							<div class="field">
								<input id="password-log" name="password" class="form-control" type="password" placeholder="Password">
								<i class="fa fa-ellipsis-h"></i>
							</div>
							<div class="field footer-form text-right">
								
								<button type="reset" class="btn btn-reverse button-form">Reset</button>
								<button type="submit" class="btn btn-default button-form">Login</button>
							</div>
						</div>
						</form>
						
						<form method="post" action="daftar.php">
						<div id="sign-in" class="box" style="display: block;">
							<h2 class="title">Pendaftaran</h2>
							<h3 class="sub-title">Jika Anda Belum Memiliki Akun, Silahkan Lakukan Pendaftaran. </h3>
							<div class="form-inline">
								<div class="form-group">
									<input id="nama_lengkap" name="nama_lengkap" class="form-control input-inline margin-right" type="text" placeholder="Nama Lengkap">
									<i class="fa fa-user user"></i>
								</div>
								<div class="form-group">
									<input id="hp_atau_telepon" class="form-control input-inline" type="text" name="hp_atau_telepon" placeholder="Telepon / WA">
									<i class="fa fa-phone"></i>
								</div>
							</div>

							<div class="form-inline">
								<div class="form-group">
									<input id="nomor_ktp" name="nomor_ktp" class="form-control input-inline margin-right" type="text" placeholder="Nomor KTP">
									<i class="fa fa-pencil"></i>
								</div>
								<div class="form-group">
									<input id="provinsi" class="form-control input-inline" type="text" name="provinsi" placeholder="Wilayah Provinsi">

									<i class="fa fa-book"></i>
								</div>
							</div>


							<div class="field">
								<input id="lrg_atau_gg_atau_perum" class="form-control" type="text" name="lrg_atau_gg_atau_perum" placeholder="Alamat Lengkap">
								<i class="fa fa-info"></i>
							</div>
							
							
							
							<div class="form-inline">
							
						
						
						
							<div class="form-group">
								<input id="username" class="form-control input-inline margin-right" type="text" name="username" placeholder="username">
								<i class="fa fa-user"></i>
							</div>
							
							
							<div class="form-group">
								<input id="password" class="form-control input-inline" type="password" name="password" placeholder="Password">
								<i class="fa fa-ellipsis-h"></i>
							</div>
							
							
							
							</div>
							
							
							
							<div class="field footer-form text-right">
								<button type="reset" class="btn btn-reverse button-form">Reset</button>
								<button type="submit" class="btn btn-default button-form">Pendaftaran</button>
							</div>
						</div>
						</form>
						
						
					<div id="setting" class="box" style="display: none;" wfd-invisible="true">
						<span class="title">CONTACT WHATSAPP</span>
						<br>
						Jika Membutuhkan Bantuan Silahkan WA Contact Dibawah ini :
						<br>
						<br>
						
						 <a href='https://api.whatsapp.com/send?phone=6282184658000&amp;text=' target='_blank'><img alt='wa' src='home/data/image/content/wa.png' title='wa' style="width: 30px;"/>0821-8465-8000</a>
 <br>

 
  <a href='https://api.whatsapp.com/send?phone=628117410088&amp;text=' target='_blank'><img alt='wa' src='home/data/image/content/wa.png' title='wa' style="width: 30px;"/>0811-741-0088</a>

<br>
 
  <a href='https://api.whatsapp.com/send?phone=6281973553045&amp;text=' target='_blank'><img alt='wa' src='home/data/image/content/wa.png' title='wa' style="width: 30px;"/>0819-7355-3045</a>
 <br>
						<span class="address">
						</span>
						</div>
				</div><!-- ./login-button-container -->
			</div><!-- /.modal-dialog -->
		</div>
		
		
			<div class="container hidden-xs" id="menu-nav">
				<div class="logo">
					<center><a href="#"><img width="60" id="logo-header" src="admin/data/image/logo/logo.png" alt="Logo" />&nbsp; <font color="black" size="3"></font></a></center>
				</div><!-- /.logo -->
				<nav id="navigation">
					<ul>
						
<?php
$m = new SimpleXMLElement('home/include/settings/menu.xml', null, true);
foreach($m as $i){if($i->t == 's' ){
?>
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
		 <li class="nav-item"> <a class="nav-link" href="<?php echo $i->l;?>">
		 <!-- <i class="<?php echo $i->i;?>"></i>&nbsp; -->
		 
		 <b><?php echo $i->n;?></b></a> </li>
		<?php } ?>
<?php
}else if($i->t == 'm' ){ $idmenu = $i->id;
?>
					<li class="has_submenu">
							<a href="#"><b><?php echo $i->n;?></b></a>
							<ul>
								<?php
									$m1 = new SimpleXMLElement('home/include/settings/menu.xml', null, true);
									foreach($m1 as $i1) {
									if($i1->s=="$idmenu" and $i1->t=="sm" ){
										
										$submenu = $i1->l;
										$submenu = str_replace("xxx","&",$submenu);
									?>
										<li><li>
										<a  onclick="window.location = '<?php echo $submenu;?>'"><i class="<?php echo $i1->i;?>"></i>&nbsp;
										<?php echo $i1->n;?></a>
										</li></li>
									<?php }} ?>
								
							</ul>
						</li>
		<?php }} ?>

						
						</ul>
				</nav>
			</div>
			
			<a href="#" class="fixed-button "><i class="fa fa-chevron-up"></i></a>
			<a href="index.php?p=kontak" class="hidden-xs fixed-button email" ><i class="fa fa-envelope-o"></i></a>
		</header>
		
		
	 	<?php if(isset($_GET['p']) && ($_GET['p'] =="Home" or $_GET['p'] =="home")) { 
	
			 ?>
			 
			 
		<?php } else { ?>	 
			 
		<style>
		.skyline {
         margin-top:-120px;        
		}
		</style>

		<section id="header-page" class="header-margin-base">
			<div class="skyline">
				<div data-offset="50" class="p1 parallax" style="transform: translate3d(-13px, 7px, 0px);"></div>
				<div data-offset="25" class="p2 parallax" style="transform: translate3d(-6px, 4px, 0px);"></div>
				<div data-offset="15" class="p3 parallax" style="transform: translate3d(-4px, 2px, 0px);"></div>
				<div data-offset="8" class="p4 parallax" style="transform: translate3d(-2px, 1px, 0px);"></div>
				<span class="cover"></span>
				<div class="container header-text">
					<div><h1 class="title"><?php echo str_replace("_"," ",strtoupper($_GET['p']));?></h1></div>
					<div><h2 class="sub-title"><?php echo ucwords($judul);?></h2></div>
				</div>
			</div>
			<div id="breadcrumb">
				<div class="container">
					<ol class="breadcrumb">
						<li><a href="#"><i class="fa fa-home"></i></a></li>
						<li><a href="#">Halaman</a></li>
						<li class="active"><?php echo ucwords($_GET['p']);?></li>
					</ol>
				</div>
			</div>
			<span class="cover"></span>
		</section>
		<?php  } ?>
		
		<?php include 'halaman.php';?>
		<h2>&nbsp;</h2>

		<footer id="footer-page" class="section-color">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-3">
						<span class="title with-icon">
							<img class="logo-footer" src="<?php echo $url;?>images/mini-logo-x1.png" alt="logo" />
							ABOUT
						</span>
						<span class="text">
							<?php echo $judul;?>
						</span>
						<?php echo $alamat;?><br />
						<i class="fa fa-map-marker"></i> Jambi, Indonesia
					</div>
					<div class="col-sm-6 col-md-3">
						<span class="title">CONTACT OFFICE</span>
						<span class="phone"><i class="fa fa-fax"></i> 0741-30-414 79</span>
						<i class="fa fa-phone"></i> 0822-4913-0300 <br>
						<i class="fa fa-phone"></i> 0813-7355-3045 <br>
						
						
						<span class="address">
						</span>
						
					</div>
					
					<div class="col-sm-6 col-md-6">
						<span class="title"><center>Lokasi</center></span>
						
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15953.034774177135!2d103.65139571573656!3d-1.6020850318903301!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e258f17c5532acf%3A0x1d34c1290f22deb7!2sKasang%20Kumpeh%2C%20Kumpeh%20Ulu%2C%20Kabupaten%20Muaro%20Jambi%2C%20Jambi!5e0!3m2!1sid!2sid!4v1600152974449!5m2!1sid!2sid" width="600" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
						
					</div>
					</div>
			</div>
			<div class="credits">
				<div class="container">
					<div class="row">
						<div class="hidden-xs col-md-6 credits-text"><?php echo $copyright;?></div>
						
						<div class="col-md-6">
							<ul class="social-icons">
								<li><a href="<?php echo $facebook;?>"><span class="fa fa-facebook"></span></a></li>
								<li><a href="<?php echo $twitter;?>"><span class="fa fa-twitter"></span></a></li>
								<li><a href="<?php echo $instagram;?>"><span class="fa fa-instagram"></span></a></li>
								<li><a href="<?php echo $google;?>"><span class="fa fa-google"></span></a></li>
								<li><a href="<?php echo $google;?>"><span class="fa fa-youtube"></span></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</footer>

		
	</div>

	<script	src="<?php echo $url;?>script/jquery.min.js"></script>		
	<script	src="<?php echo $url;?>script/jquery-ui.min.js"></script>	
	<script	src="<?php echo $url;?>script/bootstrap.min.js"></script>	
	<script	src="<?php echo $url;?>script/vendor/mmenu/mmenu.min.all.js"></script>					
	<script	src="<?php echo $url;?>script/vendor/animation-wow/wow.min.js"></script>				
	<script src="<?php echo $url;?>script/vendor/labelauty/labelauty.min.js"></script>				
	<script	src="<?php echo $url;?>script/vendor/parallax/parallax.min.js"></script>				
	<script	src="<?php echo $url;?>script/vendor/images-fill/imagesloaded.min.js"></script>			
	<script src="<?php echo $url;?>script/vendor/images-fill/imagefill.min.js"></script>			
	<script	src="<?php echo $url;?>script/vendor/easydropdown/jquery.easydropdown.min.js"></script>	
	<script	src="<?php echo $url;?>script/vendor/carousel/responsiveCarousel.min.js"></script>		
	<script	src="<?php echo $url;?>script/vendor/fotorama/fotorama.min.js"></script>
	<script	src="<?php echo $url;?>script/vendor/noui-slider/nouislider.all.min.js"></script>		
	<script	src="<?php echo $url;?>script/custom.js"></script>	

  </body>
</html>