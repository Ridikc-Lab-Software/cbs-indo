
	<?php
$default_url = '../data/tmp/tmp 100';
$tema = 'falgun/';
$url = $default_url.'/'.$tema;
?>
<?php include '../include/function/login.php';?>

 <link href="http://fonts.googleapis.com/css?family=Roboto+Slab:400,300,100,700" rel="stylesheet">
 <link href="http://fonts.googleapis.com/css?family=Roboto:500,400italic,100,700italic,300,700,500italic,400" rel="stylesheet">
 <link href="<?php echo $url;?>css/bootstrap.css" rel="stylesheet" />
 <link href="<?php echo $url;?>css/bootstrap-responsive.css" rel="stylesheet" />
 <link rel="stylesheet" href="<?php echo $url;?>css/font-awesome.css" />
 <link href="<?php echo $url;?>css/styles.css" rel="stylesheet" />
 <link href="<?php echo $url;?>css/aristo-ui.css" rel="stylesheet" />
 <link href="<?php echo $url;?>css/elfinder.css" rel="stylesheet" />
<script src="<?php echo $url;?>js/jquery.js"></script>
 <script src="<?php echo $url;?>js/jquery-ui-1.10.1.custom.min.js"></script>
 <script src="<?php echo $url;?>js/bootstrap.js"></script>
 </head>
 <body>
 <div class="layout">
	 <!-- Navbar================================================== -->
	 <div class="navbar navbar-inverse top-nav">
		 <div class="navbar-inner">
			 <div class="container">
				 <span class="home-link"></span><a class="brand" href="index.html"><img src="<?php echo $url;?>/images/logo-falgun.png" width="103" height="50" alt="Falgun" /></a>
				 <div class="btn-toolbar pull-right notification-nav">
					 <div class="btn-group">
						 <div class="dropdown">
							 <a href="../../" class="btn btn-notification"><i class="icon-reply"></i></a>
						 </div>
					 </div>
				 </div>
			 </div>
		 </div>
	 </div>
	 <div class="container">
		 <form class="form-signin" method="post">
		 
			 <h3 class="form-signin-heading">Please sign in </h3>
			 <br>
			<br>
			 <div class="controls input-icon">
				 <i class=" icon-user-md"></i>
				 <input type="text" class="input-block-level" placeholder="username" name="username" id="username" />
			 </div>
			 <div class="controls input-icon">
				 <i class=" icon-key"></i><input type="password" name="password" id="password" class="input-block-level" placeholder="Password" />
			 </div>
			
			 <button type="submit" type='submit' name="login" class="btn btn-success btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>LOGIN</button>
			
			<a href="../../" class="btn btn-inverse btn-block"><i class="fa fa-sign-out fa-lg fa-fw"></i>BATAL</a>
			<br>
			<br>
			<br>
			<br>
			 <center> <?php echo $copyright; ?> </center>
			 
			 
			 
		 </form>
	 </div>
 </div>
 <br>
 <br>
 <br>
 
</body>
 </html>
 










