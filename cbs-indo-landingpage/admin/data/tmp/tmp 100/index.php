<?php 
    $url = '../../../data/tmp/tmp 100/falgun/';
	include '../../../include/all_include.php';    
	$maintenance = false;
	?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<link href="<?php echo $url;?>css/bootstrap.css" rel="stylesheet">
<link href="<?php echo $url;?>css/jquery.gritter.css" rel="stylesheet">
<link href="<?php echo $url;?>css/bootstrap-responsive.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo $url;?>css/font-awesome.css">
<link href="<?php echo $url;?>css/tablecloth.css" rel="stylesheet">
<link href="<?php echo $url;?>css/styles.css" rel="stylesheet">
<link href='<?php echo $url;?>fonts.googleapis.com/css_f18968c9.css' rel='stylesheet' type='text/css'>
<link href='<?php echo $url;?>fontawesome/css/all.min.css' rel='stylesheet' type='text/css'>
<link rel="shortcut icon" href="<?php echo $url;?>ico/favicon.ico">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $url;?>ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $url;?>ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $url;?>ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="<?php echo $url;?>ico/apple-touch-icon-57-precomposed.png">
<script src="<?php echo $url;?>js/jquery.js"></script>
<script src="<?php echo $url;?>js/jquery-ui-1.10.1.custom.min.js"></script>
<script src="<?php echo $url;?>js/bootstrap.js"></script>
<script src="<?php echo $url;?>js/jquery.sparkline.js"></script>
<script src="<?php echo $url;?>js/bootstrap-fileupload.js"></script>
<script src="<?php echo $url;?>js/jquery.metadata.js"></script>
<script src="<?php echo $url;?>js/jquery.tablesorter.min.js"></script>
<script src="<?php echo $url;?>js/jquery.tablecloth.js"></script>
<script src="<?php echo $url;?>js/jquery.flot.js"></script> 
<script src="<?php echo $url;?>js/jquery.flot.selection.js"></script>
<script src="<?php echo $url;?>js/excanvas.js"></script>
<script src="<?php echo $url;?>js/jquery.flot.pie.js"></script>
<script src="<?php echo $url;?>js/jquery.flot.stack.js"></script>
<script src="<?php echo $url;?>js/jquery.flot.time.js"></script>
<script src="<?php echo $url;?>js/jquery.flot.tooltip.js"></script>
<script src="<?php echo $url;?>js/jquery.flot.resize.js"></script>
<script src="<?php echo $url;?>js/jquery.collapsible.js"></script>
<script src="<?php echo $url;?>js/accordion.nav.js"></script>
<script src="<?php echo $url;?>js/jquery.gritter.js"></script>
<script src="<?php echo $url;?>js/tiny_mce/jquery.tinymce.js"></script>
<script src="<?php echo $url;?>js/custom.js"></script>
<script src="<?php echo $url;?>js/respond.min.js"></script>
<script src="<?php echo $url;?>js/ios-orientationchange-fix.js"></script>

<div class="loader"></div>
<style>
.loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('https://www.toolsvilla.com/assets/images/main/loader.gif') 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;
}
</style>

<script type="text/javascript">
$(window).load(function() {
    $(".loader").fadeOut("slow");
});
</script>

<script>
        $(function() {
		$('textarea.chat-inputbox').tinymce({
			script_url : '<?php echo $url;?>js/tiny_mce/tiny_mce.js',
			theme : "simple"
			});
		});
$(function() {
        $(".paper-table").tablecloth({
          theme: "paper",
          striped: true,
          sortable: true,
          condensed: false
        });
      });
	  
$(function(){

$(function () {
    $(".line-min-chart").sparkline([50, 10, 2, 3, 40, 5, 26, 10, 15, 20, 40, 60], {
        type: 'line',
        width: '80',
        height: '40',
        lineColor: '#2b2b2b',
        fillColor: '#e5e5e5',
        lineWidth: 2,
        highlightSpotColor: '#0e8e0e',
        spotRadius: 3,
        drawNormalOnTop: true
    });
    $(".bar-min-chart").sparkline([50, 10, 2, 3, 40, 5, 26, 10, -15, 20, 40, 60], {
        type: 'bar',
        height: '40',
        barWidth: 4,
        barSpacing: 1,
        barColor: '#007f00'
    });
    $(".pie-min-chart").sparkline([3, 5, 2, 10, 8], {
        type: 'pie',
        width: '40',
        height: '40'
    });
    $(".tristate-min-chart").sparkline([1, 1, 0, 1, -1, -1, 1, -1, 0, 0, 1, 1], {
        type: 'tristate',
        height: '40',
        posBarColor: '#bf005f',
        negBarColor: '#ff7f00',
        zeroBarColor: '#545454',
        barWidth: 4,
        barSpacing: 1
    });
});
$(function () {
    $(".left-primary-nav a").hover(function () {
        $(this).stop().animate({
            fontSize: "30px"
        }, 200);
    }, function () {
        $(this).stop().animate({
            fontSize: "24px"
        }, 100);
    });
});
</script>
<script type="text/javascript">

    var data7_1 = [
        [1354586000000, 153],
        [1354587000000, 658],
        [1354588000000, 198],
        [1354589000000, 663],
        [1354590000000, 801],
        [1354591000000, 1080],
        [1354592000000, 353],
        [1354593000000, 749],
        [1354594000000, 523],
        [1354595000000, 258],
        [1354596000000, 688],
        [1354597000000, 364]
    ];
    var data7_2 = [
        [1354586000000, 53],
        [1354587000000, 65],
        [1354588000000, 98],
        [1354589000000, 83],
        [1354590000000, 80],
        [1354591000000, 108],
        [1354592000000, 120],
        [1354593000000, 74],
        [1354594000000, 23],
        [1354595000000, 79],
        [1354596000000, 88],
        [1354597000000, 36]
    ];
    $(function () {
        $.plot($("#visitors-chart #visitors-container"), [{
            data: data7_1,
            label: "Page View",
            lines: {
                fill: true
            }
        }, {
            data: data7_2,
            label: "Online User",
            points: {
                show: true
            },
            lines: {
                show: true
            },
            yaxis: 2
        }
        ],
        {
            series: {
                lines: {
                    show: true,
                    fill: false
                },
                points: {
                    show: true,
                    lineWidth: 2,
                    fill: true,
                    fillColor: "#ffffff",
                    symbol: "circle",
                    radius: 5,
                },
                shadowSize: 0,
            },
            grid: {
                hoverable: true,
                clickable: true,
                tickColor: "#f9f9f9",
                borderWidth: 1
            },
            colors: ["#b086c3", "#ea701b"],
            tooltip: true,
            tooltipOpts: {
				  shifts: { 
					  x: -100                     //10
				  },
                defaultTheme: false
            },
            xaxis: {
                mode: "time",
                timeformat: "%0m/%0d %0H:%0M"
            },
            yaxes: [{
            }, {
                position: "right" /* left or right */
            }]
        }
        );
    });
</script>
<script type="text/javascript">

    $(function () {
        var data = [{
            label: "Page View",
            data: 70
        }, {
            label: "Online User",
            data: 30
        }];
        var options = {
            series: {
                pie: {
                    show: true,
					innerRadius: 0.5,
            show: true
                }
            },
            legend: {
                show: true
            },
            grid: {
                hoverable: true,
                clickable: true
            },
			 colors: ["#b086c3", "#ea701b"],
            tooltip: true,
            tooltipOpts: {
				shifts: { 
					  x: -100                     //10
				  },
                defaultTheme: false
            }
        };
        $.plot($("#pie-chart-donut #pie-donutContainer"), data, options);
    });
</script>
</head>
<body>
<div class="layout">
	<!-- Navbar
    ================================================== -->
	<div class="navbar navbar-inverse top-nav">
		<div class="navbar-inner">
			<div class="container">
			<font color="white">
				<a class="brand" href="#">
				</font>
				</a>
				<div class="nav-collapse">
					<ul class="nav">
					<li><a  href="../home/"><b style="font-size: 15px;color: aliceblue;">E-MEMBER CARD PT.CBS </b> </a>
						<li><a href="../home/"><i class="fa fa-home"></i> Home</a></li>
						<li class="dropdown"><a data-toggle="dropdown" class="dropdown-toggle" href="<?php echo $url;?>#"><i class="icon-th-large"></i> Help <b class="icon-angle-down"></b></a>
						<div class="dropdown-menu">
							<ul>
								<li><a target="blank" href="https://api.whatsapp.com/send?phone=6285267792168&text=&source=&data="><i class="icon-external-link"></i> Contact Admin </a></li>
							</ul>
						</div>
						</li>
						
					</ul>
				</div>
				<div class="btn-toolbar pull-right notification-nav">
					<div class="btn-group">
						<div class="dropdown">
						</div>
					</div>
					<div class="btn-group">
						<div class="dropdown" style="background-color: #3e3c3c;">
							<a href="<?php logout();?>" class="btn btn-notification"><i class="icon-lock"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="leftbar leftbar-close clearfix">
		<div class="admin-info clearfix">
			<div class="admin-thumb">
				<img src="<?php echo $avatar;?>" style="width: 150px;
    			height: 50px;
    			object-fit: cover;" 
				width="10">
			</div>
			<div class="admin-meta">
				<ul>
					<li class="admin-username">Login : <?php echo ucwords($siapa);?></li>
					<li><a href="../data_admin/index.php?input=edit&proses=<?php echo $id_admin?>">Edit Profile</a></li>
					<li><a href="../data_admin/index.php?input=detail&proses=<?php echo $id_admin?>">View Profile </a><a href="<?php logout();?>"><i class="icon-lock"></i> Logout</a></li>
				</ul>
			</div>
		</div>

	<div class="left-nav clearfix">
			<div class="left-primary-nav">
				<ul id="myTab">
					<li class="active"><a href="#main" class="icon-th-large" data-original-title="Dashboard" style="font-size: 24px;"></a></li>
					<li class=""><a href="#forms" class="icon-file-alt" data-original-title="Master Data" style="font-size: 24px;"></a></li>
					<li><a href="#pages" class="icon-cogs" data-original-title="Pengaturan"></a></li>
					<li><a href="#chart" class="fa fa-database" data-original-title="Backup Restore"></a></li>
					<li><a href="#features" class="icon-bar-chart" data-original-title="Laporan"></a></li>
				</ul>				
			</div>

			<div class="responsive-leftbar" wfd-invisible="true">
				<i class="icon-list"></i>
			</div>

			<div class="left-secondary-nav tab-content">
				<div class="tab-pane active" id="main">
					<h4 class="side-head">Dashboard</h4>
					<div class="search-box">
						<div class="input-append input-icon">
						<form action="../data_member/index.php">
							<input name="isi" class="search-input" placeholder="Search..." type="text">
							<i class=" icon-search"></i>
							<input class="btn" type="submit" value="Go!">
							<input name="Berdasarkan" type="hidden" value="tanggal_muat">
							</form>
						</div>
					</div>
					<ul class="metro-sidenav clearfix">
						<li><a href="../data_member/index.php?input=tambah" class="brown"><i class="icon-pencil"></i><span>Pendaftaran</span></a></li>
						<li><a href="../data_member/index.php" class="orange"><i class="icon-user"></i><span>Member</span></a></li>
						<li><a href="../data_transaksi/index.php" class=" blue-violate"><i class="icon-book"></i><span> Transaksi </span></a></li>
						<li><a href="../data_redeem/index.php" class=" magenta"><i class="icon-paste"></i><span > Redeem</span></a></li>
						<li><a href="../data_promo/index.php" class="green"><i class="icon-file-alt"></i><span >Promo</span></a></li>
						<li><a href="../data_mitra/index.php" class=" blue"><i class="fas fa-indent"></i><span >Mitra</span></a></li>
						<li><a  href="../data_grafik/" class=" bondi-blue"><i class="fas fa-chart-line"></i><span >Grafik</span></a></li>
						<li><a  href="../backuprestore/index.php?p=backup" class=" dark-yellow"><i class="fa fa-database"></i><span >Backup </span></a></li>
					</ul>
					<div class="side-widget">

					


						
						<div class="board-widgets light-blue ">
							<div class="board-widgets-head clearfix">
								<h4 class="pull-left">Total Transaksi </h4>
								<a href="#" class="widget-settings"><i class="icon-hdd"></i></a>
							</div>
							<div class="board-widgets-content">
								<div class="progress progress-striped active min progress-success">
								
									<div class="bar" style="width: 100%;">
									</div>
								</div>
								<div >
								<br>
									<i >Bulan ini : 5</i> 
								</div>
							</div>
						</div>


						
					</div>
				</div>
				<div class="tab-pane" id="forms" wfd-invisible="true">
					<h4 class="side-head">Master Data</h4>
					<ul id="nav" class="accordion-nav">						  
					<?php
					$m = new SimpleXMLElement('../../../include/settings/menu.xml', null, true);
					foreach($m as $i){if($i->t == 's' ){
					?>
					<li><a href="<?php echo $i->l;?>"><i class="<?php echo $i->i;?>"></i> <?php echo $i->n;?></a></li>
					<?php
					}}
					?>
					</ul>
				</div>
				<div class="tab-pane" id="features" wfd-invisible="true">
					<h4 class="side-head">Laporan</h4>
					<ul class="accordion-nav">
					<?php
					$m = new SimpleXMLElement('../../../include/settings/laporan.xml', null, true);
					foreach($m as $i){if($i->t == 's' ){
					?>
					<li><a href="<?php echo $i->l;?>"><i class="<?php echo $i->i;?>"></i> <?php echo $i->n;?></a></li>
					<?php
					}}
					?>
					</ul>
				</div>
				<div class="tab-pane" id="pages" wfd-invisible="true">
					<h4 class="side-head">Pengaturan</h4>
					<ul class="accordion-nav">
						<?php
					$m = new SimpleXMLElement('../../../include/settings/pengaturan.xml', null, true);
					foreach($m as $i){if($i->t == 's' ){
					?>
					<li><a href="<?php echo $i->l;?>"><i class="<?php echo $i->i;?>"></i> <?php echo $i->n;?></a></li>
					<?php
					}}
					?>
					</ul>
				</div>
				<div class="tab-pane" id="chart" wfd-invisible="true">
					<h4 class="side-head">Backup Restore</h4>
					<ul class="accordion-nav">
						<?php
					$m = new SimpleXMLElement('../../../include/settings/backuprestore.xml', null, true);
					foreach($m as $i){if($i->t == 's' ){
					?>
					<li><a href="<?php echo $i->l;?>"><i class="<?php echo $i->i;?>"></i> <?php echo $i->n;?></a></li>
					<?php
					}}
					?>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="main-wrapper">
		<div class="container-fluid">

			
			
			
			<div class="row-fluid">
				 <div class="span12">
				 <div class="content-widgets white">	 
					<div class="content-widgets light-gray">
						<div class="widget-head blue">
						<h3><?php ucwords(tabelnomin());?> </h3> <ul class="breadcrumb">
						<li ><a href="../home/" class="icon-home"></a><span class="divider "><i class="icon-angle-right"></i></span></li>
						<li><a href="#"> Halaman</a><span class="divider"><i class="icon-angle-right"></i></span></li>
						<li class="active"><?php ucwords(tabelnomin());?></li>
						</div>
					 </div>
						 <div class="widget-container">
						<?php 
						if ($maintenance == true)
						{ ?>
						<div class="alert alert-error">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<i class="icon-exclamation-sign"></i><strong>Warning!</strong> Website under maintenance.
						</div>
						<?php } ?>
							  <?php include 'halaman.php'; ?>
							  <br>
                			  <br>
                			  <br>
						 </div>
					 </div>
                </div>
			</div>
		</div>
	</div>
	
	<div class="copyright">
		<p>
			 <?php echo $copyright();?>
		</p>
	</div>

	<div class="scroll-top">
		<a href="#" class="tip-top" title="Go Top"><i class="icon-double-angle-up"></i></a>
	</div>
</div>
</body>
</html>