    	<?php
      $url = '../../../data/tmp/tmp 100/falgun/';
      include '../../../include/all_include.php';
      $maintenance = false;
      ?>
    	<!DOCTYPE HTML>
    	<html lang="en">

    	<head>
    	  <link href="<?php echo $url; ?>css/bootstrap.css" rel="stylesheet">
    	  <link href="<?php echo $url; ?>css/jquery.gritter.css" rel="stylesheet">
    	  <link href="<?php echo $url; ?>css/bootstrap-responsive.css" rel="stylesheet">
    	  <link rel="stylesheet" href="<?php echo $url; ?>css/font-awesome.css">
    	  <link href="<?php echo $url; ?>css/tablecloth.css" rel="stylesheet">
    	  <link href="<?php echo $url; ?>css/styles.css" rel="stylesheet">
    	  <link href='<?php echo $url; ?>fonts.googleapis.com/css_f18968c9.css' rel='stylesheet' type='text/css'>
    	  <link href='<?php echo $url; ?>fontawesome/css/all.min.css' rel='stylesheet' type='text/css'>
    	  <link rel="shortcut icon" href="<?php echo $url; ?>ico/favicon.ico">
    	  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $url; ?>ico/apple-touch-icon-144-precomposed.png">
    	  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $url; ?>ico/apple-touch-icon-114-precomposed.png">
    	  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $url; ?>ico/apple-touch-icon-72-precomposed.png">
    	  <link rel="apple-touch-icon-precomposed" href="<?php echo $url; ?>ico/apple-touch-icon-57-precomposed.png">
    	  <script src="<?php echo $url; ?>js/jquery.js"></script>
    	  <script src="<?php echo $url; ?>js/jquery-ui-1.10.1.custom.min.js"></script>
    	  <script src="<?php echo $url; ?>js/bootstrap.js"></script>
    	  <script src="<?php echo $url; ?>js/jquery.sparkline.js"></script>
    	  <script src="<?php echo $url; ?>js/bootstrap-fileupload.js"></script>
    	  <script src="<?php echo $url; ?>js/jquery.metadata.js"></script>
    	  <script src="<?php echo $url; ?>js/jquery.tablesorter.min.js"></script>
    	  <script src="<?php echo $url; ?>js/jquery.tablecloth.js"></script>
    	  <script src="<?php echo $url; ?>js/jquery.flot.js"></script>
    	  <script src="<?php echo $url; ?>js/jquery.flot.selection.js"></script>
    	  <script src="<?php echo $url; ?>js/excanvas.js"></script>
    	  <script src="<?php echo $url; ?>js/jquery.flot.pie.js"></script>
    	  <script src="<?php echo $url; ?>js/jquery.flot.stack.js"></script>
    	  <script src="<?php echo $url; ?>js/jquery.flot.time.js"></script>
    	  <script src="<?php echo $url; ?>js/jquery.flot.tooltip.js"></script>
    	  <script src="<?php echo $url; ?>js/jquery.flot.resize.js"></script>
    	  <script src="<?php echo $url; ?>js/jquery.collapsible.js"></script>
    	  <script src="<?php echo $url; ?>js/accordion.nav.js"></script>
    	  <script src="<?php echo $url; ?>js/jquery.gritter.js"></script>
    	  <script src="<?php echo $url; ?>js/tiny_mce/jquery.tinymce.js"></script>
    	  <script src="<?php echo $url; ?>js/custom.js"></script>
    	  <script src="<?php echo $url; ?>js/respond.min.js"></script>
    	  <script src="<?php echo $url; ?>js/ios-orientationchange-fix.js"></script>

    	  <div class="loader"></div>
    	  <style>
    	    .loader {
    	      position: fixed;
    	      left: 0px;
    	      top: 0px;
    	      width: 100%;
    	      height: 100%;
    	      z-index: 9999;
    	      background: url('https://www.toolsvilla.com/assets/images/main/loader.gif') 50% 50% no-repeat rgb(249, 249, 249);
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
    	        script_url: '<?php echo $url; ?>js/tiny_mce/tiny_mce.js',
    	        theme: "simple"
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

    	    $(function() {

    	          $(function() {
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
    	          $(function() {
    	            $(".left-primary-nav a").hover(function() {
    	              $(this).stop().animate({
    	                fontSize: "30px"
    	              }, 200);
    	            }, function() {
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
    	    $(function() {
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
    	      }], {
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
    	            x: -100 //10
    	          },
    	          defaultTheme: false
    	        },
    	        xaxis: {
    	          mode: "time",
    	          timeformat: "%0m/%0d %0H:%0M"
    	        },
    	        yaxes: [{}, {
    	          position: "right" /* left or right */
    	        }]
    	      });
    	    });
    	  </script>
    	  <script type="text/javascript">
    	    $(function() {
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
    	            x: -100 //10
    	          },
    	          defaultTheme: false
    	        }
    	      };
    	      $.plot($("#pie-chart-donut #pie-donutContainer"), data, options);
    	    });
    	  </script>
    	</head>

    	<body style="background-color: #f5f5f5;">
    	  <div class="layout">
    	    <!-- Navbar
    ================================================== -->
    	    <div class="navbar navbar-inverse top-nav">
    	      <div class="navbar-inner" style="background: linear-gradient(90deg, #E31937 30%, #E31937 100%);">
    	        <div class="container">
    	          <font color="white">
    	            <a class="brand" href="#">
    	          </font>
    	          </a>
    	          <div class="nav-collapse">
    	            <ul class="nav">
    	              <li><a href="../home/"><b style="font-size: 15px;color: #ffffff;">SMART MEMBER PT.CBS </b> </a>


    	            </ul>

    	            <?php $username = decrypt($_COOKIE['jenenge']);

                  $hak_akses = baca_database('', 'hak_akses', "select * from data_admin where username='$username'");


                  ?>

    	            <div class="btn-toolbar pull-right notification-nav">
    	              <?php if ($hak_akses == "manager") { ?>
    	                <div class="btn-group">
    	                  <div class="dropdown">
    	                    <style>
    	                      .bell {
    	                        display: block;
    	                        width: 30px;
    	                        height: 30px;
    	                        font-size: 25px;
    	                        margin: -6px auto 0;
    	                        color: white;
    	                        -webkit-animation: ring 4s 0.7s ease-in-out infinite;
    	                        -webkit-transform-origin: 50% 4px;
    	                        -moz-animation: ring 4s 0.7s ease-in-out infinite;
    	                        -moz-transform-origin: 50% 4px;
    	                        animation: ring 4s 0.7s ease-in-out infinite;
    	                        transform-origin: 50% 4px;
    	                      }

    	                      @-webkit-keyframes ring {
    	                        0% {
    	                          -webkit-transform: rotateZ(0);
    	                        }

    	                        1% {
    	                          -webkit-transform: rotateZ(30deg);
    	                        }

    	                        3% {
    	                          -webkit-transform: rotateZ(-28deg);
    	                        }

    	                        5% {
    	                          -webkit-transform: rotateZ(34deg);
    	                        }

    	                        7% {
    	                          -webkit-transform: rotateZ(-32deg);
    	                        }

    	                        9% {
    	                          -webkit-transform: rotateZ(30deg);
    	                        }

    	                        11% {
    	                          -webkit-transform: rotateZ(-28deg);
    	                        }

    	                        13% {
    	                          -webkit-transform: rotateZ(26deg);
    	                        }

    	                        15% {
    	                          -webkit-transform: rotateZ(-24deg);
    	                        }

    	                        17% {
    	                          -webkit-transform: rotateZ(22deg);
    	                        }

    	                        19% {
    	                          -webkit-transform: rotateZ(-20deg);
    	                        }

    	                        21% {
    	                          -webkit-transform: rotateZ(18deg);
    	                        }

    	                        23% {
    	                          -webkit-transform: rotateZ(-16deg);
    	                        }

    	                        25% {
    	                          -webkit-transform: rotateZ(14deg);
    	                        }

    	                        27% {
    	                          -webkit-transform: rotateZ(-12deg);
    	                        }

    	                        29% {
    	                          -webkit-transform: rotateZ(10deg);
    	                        }

    	                        31% {
    	                          -webkit-transform: rotateZ(-8deg);
    	                        }

    	                        33% {
    	                          -webkit-transform: rotateZ(6deg);
    	                        }

    	                        35% {
    	                          -webkit-transform: rotateZ(-4deg);
    	                        }

    	                        37% {
    	                          -webkit-transform: rotateZ(2deg);
    	                        }

    	                        39% {
    	                          -webkit-transform: rotateZ(-1deg);
    	                        }

    	                        41% {
    	                          -webkit-transform: rotateZ(1deg);
    	                        }

    	                        43% {
    	                          -webkit-transform: rotateZ(0);
    	                        }

    	                        100% {
    	                          -webkit-transform: rotateZ(0);
    	                        }
    	                      }

    	                      @-moz-keyframes ring {
    	                        0% {
    	                          -moz-transform: rotate(0);
    	                        }

    	                        1% {
    	                          -moz-transform: rotate(30deg);
    	                        }

    	                        3% {
    	                          -moz-transform: rotate(-28deg);
    	                        }

    	                        5% {
    	                          -moz-transform: rotate(34deg);
    	                        }

    	                        7% {
    	                          -moz-transform: rotate(-32deg);
    	                        }

    	                        9% {
    	                          -moz-transform: rotate(30deg);
    	                        }

    	                        11% {
    	                          -moz-transform: rotate(-28deg);
    	                        }

    	                        13% {
    	                          -moz-transform: rotate(26deg);
    	                        }

    	                        15% {
    	                          -moz-transform: rotate(-24deg);
    	                        }

    	                        17% {
    	                          -moz-transform: rotate(22deg);
    	                        }

    	                        19% {
    	                          -moz-transform: rotate(-20deg);
    	                        }

    	                        21% {
    	                          -moz-transform: rotate(18deg);
    	                        }

    	                        23% {
    	                          -moz-transform: rotate(-16deg);
    	                        }

    	                        25% {
    	                          -moz-transform: rotate(14deg);
    	                        }

    	                        27% {
    	                          -moz-transform: rotate(-12deg);
    	                        }

    	                        29% {
    	                          -moz-transform: rotate(10deg);
    	                        }

    	                        31% {
    	                          -moz-transform: rotate(-8deg);
    	                        }

    	                        33% {
    	                          -moz-transform: rotate(6deg);
    	                        }

    	                        35% {
    	                          -moz-transform: rotate(-4deg);
    	                        }

    	                        37% {
    	                          -moz-transform: rotate(2deg);
    	                        }

    	                        39% {
    	                          -moz-transform: rotate(-1deg);
    	                        }

    	                        41% {
    	                          -moz-transform: rotate(1deg);
    	                        }

    	                        43% {
    	                          -moz-transform: rotate(0);
    	                        }

    	                        100% {
    	                          -moz-transform: rotate(0);
    	                        }
    	                      }

    	                      @keyframes ring {
    	                        0% {
    	                          transform: rotate(0);
    	                        }

    	                        1% {
    	                          transform: rotate(30deg);
    	                        }

    	                        3% {
    	                          transform: rotate(-28deg);
    	                        }

    	                        5% {
    	                          transform: rotate(34deg);
    	                        }

    	                        7% {
    	                          transform: rotate(-32deg);
    	                        }

    	                        9% {
    	                          transform: rotate(30deg);
    	                        }

    	                        11% {
    	                          transform: rotate(-28deg);
    	                        }

    	                        13% {
    	                          transform: rotate(26deg);
    	                        }

    	                        15% {
    	                          transform: rotate(-24deg);
    	                        }

    	                        17% {
    	                          transform: rotate(22deg);
    	                        }

    	                        19% {
    	                          transform: rotate(-20deg);
    	                        }

    	                        21% {
    	                          transform: rotate(18deg);
    	                        }

    	                        23% {
    	                          transform: rotate(-16deg);
    	                        }

    	                        25% {
    	                          transform: rotate(14deg);
    	                        }

    	                        27% {
    	                          transform: rotate(-12deg);
    	                        }

    	                        29% {
    	                          transform: rotate(10deg);
    	                        }

    	                        31% {
    	                          transform: rotate(-8deg);
    	                        }

    	                        33% {
    	                          transform: rotate(6deg);
    	                        }

    	                        35% {
    	                          transform: rotate(-4deg);
    	                        }

    	                        37% {
    	                          transform: rotate(2deg);
    	                        }

    	                        39% {
    	                          transform: rotate(-1deg);
    	                        }

    	                        41% {
    	                          transform: rotate(1deg);
    	                        }

    	                        43% {
    	                          transform: rotate(0);
    	                        }

    	                        100% {
    	                          transform: rotate(0);
    	                        }
    	                      }
    	                    </style>
    	                    <div class="row">
    	                      <div class="col-md-6">
    	                        <?php $id_adm = baca_database('', 'id_admin', "select * from data_admin where username ='$username'");
                              $nama_spbu1 = baca_database('', 'nama_spbu', "select * from data_admin where id_admin ='$id_adm'"); ?>

    	                        <a style="z-index:5;margin-right:40px;background-color: #cccccc;" data-toggle="dropdown" class="badge badge-warning"><?php echo $notip = baca_database('', 'ju', "select 
					count(*) as ju from data_persetujuan_point INNER JOIN data_admin ON data_persetujuan_point.id_admin = data_admin.id_admin
WHERE data_persetujuan_point.status='menunggu_persetujuan'");  ?> </a>



    	                      </div>
    	                      <div class="col-md-6">
    	                        <i data-toggle="dropdown" class="bell fa fa-bell"></i>
    	                        <div class="dropdown-menu pull-right ">
    	                          <span class="notify-h"> You have <?php

                                                                  echo $notip; ?> notifications</span>

    	                          <?php
                                date_default_timezone_set('Asia/Jakarta');


                                $querytabel = "SELECT * FROM data_persetujuan_point INNER JOIN data_admin ON data_persetujuan_point.id_admin = data_admin.id_admin
WHERE data_persetujuan_point.status='menunggu_persetujuan'";
                                $proses = mysql_query($querytabel);
                                while ($data = mysql_fetch_array($proses)) {

                                  $idm = ($data['id_member']);
                                  $sekarang = date('Y-m-d H:i:s');
                                  $tgl = ($data['tanggal_permintaan']);
                                  $ida = ($data['id_admin']);
                                  $namane = baca_database('', 'nama', "select * from data_member where id_member='$idm'");
                                  $namamin = baca_database('', 'username', "select * from data_admin where id_admin ='$ida'");


                                  $awal  = new DateTime($tgl);
                                  $akhir = new DateTime($sekarang); // Waktu sekarang
                                  $diff    = $akhir->diff($awal);
                                  $day = $diff->d;
                                  $hours = $diff->h;
                                  $menit = $diff->i;
                                  $detik = $diff->s;


                                  $day;
                                  $hours;
                                  $menit;
                                  $detik;


                                ?>
    	                            <a class="msg-container clearfix" href="../data_persetujuan_point/index.php?input=edit&proses=<?= encrypt($data['id_persetujuan_point']); ?>" style="width:100%"><span class="notification-intro">
    	                                <h6>
    	                                  <?php echo $namamin; ?> Meminta Persetujuan Update Point

    	                                </h6>

    	                                <A>Nama : <?php echo $namane; ?> </a> <Br>
    	                                <SPAN>Point Awal : <?php echo $data['point_awal'] ?> Point</SPAN> <br>
    	                                <SPAN>Update Point : <?php echo $data['update_point'] ?> Point</SPAN> <br>
    	                                <span class="notify-time"><?php

                                                                if ($day == 0) {
                                                                } else {
                                                                  echo $day . " Hari  ";
                                                                }
                                                                if ($hours == 0) {
                                                                } else {
                                                                  echo $hours . " Jam  ";
                                                                }
                                                                if ($menit == 0) {
                                                                } else {
                                                                  echo $menit . " Menit  ";
                                                                }
                                                                if ($detik == 0) {
                                                                } else {
                                                                  echo $detik . " Detik  ";
                                                                }; ?>Lalu</span>
    	                              </span></a>
    	                            <br>

    	                          <?php } ?>

    	                          <a href="../data_persetujuan_point/index.php" class="btn btn-primary btn-large btn-block"> View All</a>
    	                        </div>
    	                      </div>
    	                    </div>
    	                  </div>
    	                </div>

    	              <?php } ?>




    	              <div class="btn-group">



    	                <div class="dropdown" style="background-color: #fffcfc;border-radius: 10px;">
    	                  <a style="margin: -5px;" href="<?php logout(); ?>" class="btn btn-notification"><i class="icon-lock"></i></a>
    	                </div>
    	              </div>
    	            </div>

    	          </div>
    	        </div>
    	      </div>
    	      <div class="leftbar leftbar-close clearfix card-sidebar">



    	        <div class="left-secondary-nav tab-content">
    	          <!-- Example Tab Pane -->
    	          <div class="tab-pane active" id="main">
    	            <h4 class="side-head">Dashboard</h4>

    	            <ul class="metro-sidenav clearfix">
    	              <li><a href="../data_member/index.php?input=tambah" class="brown"><i class="icon-pencil"></i><span>Pendaftaran</span></a></li>
    	              <li><a href="../data_member/index.php" class="orange"><i class="icon-user"></i><span>Member</span></a></li>
    	              <li><a href="../data_transaksi/index.php" class="blue-violate"><i class="icon-book"></i><span>Transaksi</span></a></li>
    	              <li><a href="../data_redeem/index.php" class="magenta"><i class="icon-paste"></i><span>Redeem</span></a></li>
    	              <li><a href="../data_list_mitra/index.php" class="green"><i class="icon-file-alt"></i><span>Promo</span></a></li>
    	              <li><a href="../data_mitra/index.php" class="blue"><i class="fas fa-indent"></i><span>Mitra</span></a></li>
    	              <li><a href="../data_grafik/" class="bondi-blue"><i class="fas fa-chart-line"></i><span>Grafik</span></a></li>
    	              <li><a href="../backuprestore/index.php?p=backup" class="dark-yellow"><i class="fa fa-database"></i><span>Backup</span></a></li>
    	            </ul>
    	          </div>
    	        </div>

    	      </div>

    	      <style>
    	        /* Card-style sidebar */
    	        .card-sidebar {
    	          background-color: #ffffff;
    	          border-radius: 15px;
    	          /* sudut membulat */
    	          box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    	          /* shadow lembut */
    	          padding: 20px;
    	          margin: 15px;
    	          transition: all 0.3s ease;
    	        }

    	        /* Hover effect */
    	        .card-sidebar:hover {
    	          transform: translateY(-3px);
    	          box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
    	        }

    	        /* Optional: card content spacing */
    	        .left-secondary-nav {
    	          padding: 10px 0;
    	        }

    	        .metro-sidenav li a {
    	          border-radius: 8px;
    	          padding: 10px 15px;
    	          transition: background 0.3s;
    	        }

    	        .metro-sidenav li a:hover {
    	          background-color: rgba(2, 128, 144, 0.1);
    	        }

    	        /* Tab headers */
    	        .left-primary-nav ul#myTab li a {
    	          display: inline-block;
    	          margin: 5px 0;
    	          padding: 10px;
    	          border-radius: 8px;
    	          transition: background 0.3s;
    	        }

    	        .left-primary-nav ul#myTab li a:hover,
    	        .left-primary-nav ul#myTab li.active a {
    	          background-color: rgba(2, 128, 144, 0.15);
    	        }
    	      </style>


    	      <div class="main-wrapper">
    	        <div class="container-fluid">




    	          <div class="row-fluid">
    	            <div class="span12">



    	              <div class="widget-container card-modern">
    	                <?php
                      if ($maintenance == true) { ?>
    	                  <div class="alert alert-error card-alert">
    	                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    	                    <i class="icon-exclamation-sign"></i>
    	                    <strong>Warning!</strong> Website under maintenance.
    	                  </div>
    	                <?php } ?>
    	                <?php include 'halaman.php'; ?>
    	              </div>


    	              <style>
    	                /* Card Modern */
    	                .card-modern {
    	                  background-color: #fff;
    	                  border-radius: 15px;
    	                  /* radius sudut lebih besar */
    	                  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    	                  /* shadow halus */
    	                  padding: 30px;
    	                  margin: 0px auto;
    	                  margin-bottom: 36px;
    	                  max-width: 1200px;
    	                  /* agar center dan tidak terlalu lebar */
    	                  transition: transform 0.3s ease, box-shadow 0.3s ease;
    	                }


    	                /* Alert modern */
    	                .card-alert {
    	                  background-color: #fff3cd;
    	                  color: #856404;
    	                  border-left: 5px solid #ffc107;
    	                  padding: 15px 20px;
    	                  border-radius: 10px;
    	                  display: flex;
    	                  align-items: center;
    	                  margin-bottom: 20px;
    	                  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    	                }

    	                /* Close button modern */
    	                .card-alert .btn-close {
    	                  margin-left: auto;
    	                }

    	                /* Optional: light-gray section */
    	                .content-widgets.light-gray {
    	                  background-color: #f5f7fa;
    	                  padding: 15px;
    	                  border-radius: 12px;
    	                  margin-bottom: 20px;
    	                }
    	              </style>



    	            </div>
    	          </div>
    	        </div>
    	      </div>



    	      <div class="scroll-top">
    	        <a href="#" class="tip-top" title="Go Top"><i class="icon-double-angle-up"></i></a>
    	      </div>
    	    </div>

    	</html>