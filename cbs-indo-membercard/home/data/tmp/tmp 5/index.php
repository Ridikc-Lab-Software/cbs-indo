<?php
$url = "home/data/tmp/tmp 5/Bootslander/";
$komponen = "home/data/tmp/tmp 5/";
include 'home/include/all_include.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo $url; ?>assets/img/favicon.png" rel="icon">
  <link href="<?php echo $url; ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo $url; ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo $url; ?>assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="<?php echo $url; ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php echo $url; ?>assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="<?php echo $url; ?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?php echo $url; ?>assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?php echo $url; ?>assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php echo $url; ?>assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Bootslander - v2.3.0
  * Template URL: https://bootstrapmade.com/bootslander-free-bootstrap-landing-page-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  <style>

  </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">

        <h1 class="text-light"><a href="<?php echo $url; ?>index.html"> <img width="40px;" height="60px" src="admin/data/image/logo/logo2.png" style="background-color:white; border-radius:50%;  border-width: 5px; border-style:inset;" alt="" class="img-fluid"></img> </a>
          <span>PT. Cahaya Bungo Sarkopalma</span><br>
          </a>
        </h1>

        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="<?php echo $url; ?>index.html"><img src="<?php echo $url; ?>assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>

          <!-- MENU -->
          <?php
          $m = new SimpleXMLElement('home/include/settings/menu.xml', null, true);
          foreach ($m as $i) {
            if ($i->t == 's') {
          ?>
              <!-- SINGLE -->
              <?php $apa = $i->n;
              if ($apa == "Masuk") {
                if ((isset($_COOKIE["kodene"])) && (isset($_COOKIE["token_user"]))) {
                  $kodene = decrypt($_COOKIE["kodene"]);
                  $ip = $_SERVER['REMOTE_ADDR'];
                  $useragent = $_SERVER['HTTP_USER_AGENT'];
                  $token = sha1($ip . $useragent . $key);
                  $token = crypt($token, $key);
                  if ($_COOKIE['token_user'] == $token) {
                    $token = "ada";
                  } else {
                    $token = "";
                  }
                } else {
                  $token = "";
                  $kode = "";
                }
                if ($token == "ada") {
              ?>
                  <li class="nav-item"> <a class="nav-link" href="index.php?p=login&action=logout">Logout</a> </li>
                <?php
                } else {
                ?>
                  <li class="nav-item"> <a class="nav-link" href="index.php?p=login&action=logout"><?php echo $i->n; ?></a> </li>
                <?php
                }
              } else if ($apa == "Daftar") {
                if ((isset($_COOKIE["kodene"])) && (isset($_COOKIE["token_user"]))) {
                  $kodene = decrypt($_COOKIE["kodene"]);
                  $ip = $_SERVER['REMOTE_ADDR'];
                  $useragent = $_SERVER['HTTP_USER_AGENT'];
                  $token = sha1($ip . $useragent . $key);
                  $token = crypt($token, $key);
                  if ($_COOKIE['token_user'] == $token) {
                    $token = "ada";
                  } else {
                    $token = "";
                  }
                } else {
                  $token = "";
                  $kode = "";
                }
                if ($token == "ada") {
                ?>

                <?php
                } else {
                ?>
                  <li class="nav-item"> <a class="nav-link" href="<?php echo $i->l; ?>"><?php echo $i->n; ?></a> </li>
                <?php
                }
              } else if ($apa == "Beranda") {
                if ((isset($_COOKIE["kodene"])) && (isset($_COOKIE["token_user"]))) {
                  $kodene = decrypt($_COOKIE["kodene"]);
                  $ip = $_SERVER['REMOTE_ADDR'];
                  $useragent = $_SERVER['HTTP_USER_AGENT'];
                  $token = sha1($ip . $useragent . $key);
                  $token = crypt($token, $key);
                  if ($_COOKIE['token_user'] == $token) {
                    $token = "ada";
                  } else {
                    $token = "";
                  }
                } else {
                  $token = "";
                  $kode = "";
                }
                if ($token == "ada") {
                ?>

                <?php
                } else {
                ?>
                  <li class="nav-item"> <a class="nav-link" href="<?php echo $i->l; ?>"><?php echo $i->n; ?></a> </li>
                <?php
                }
              } else if ($apa == "Info Promo") {
                if ((isset($_COOKIE["kodene"])) && (isset($_COOKIE["token_user"]))) {
                  $kodene = decrypt($_COOKIE["kodene"]);
                  $ip = $_SERVER['REMOTE_ADDR'];
                  $useragent = $_SERVER['HTTP_USER_AGENT'];
                  $token = sha1($ip . $useragent . $key);
                  $token = crypt($token, $key);
                  if ($_COOKIE['token_user'] == $token) {
                    $token = "ada";
                  } else {
                    $token = "";
                  }
                } else {
                  $token = "";
                  $kode = "";
                }
                if ($token == "ada") {
                ?>

                <?php
                } else {
                ?>
                  <li class="nav-item"> <a class="nav-link" href="<?php echo $i->l; ?>"><?php echo $i->n; ?></a> </li>
                <?php
                }
              } else if ($apa == "Poin Saya" || $apa == "Riwayat") {
                if ((isset($_COOKIE["kodene"])) && (isset($_COOKIE["token_user"]))) {
                  $kodene = decrypt($_COOKIE["kodene"]);
                  $ip = $_SERVER['REMOTE_ADDR'];
                  $useragent = $_SERVER['HTTP_USER_AGENT'];
                  $token = sha1($ip . $useragent . $key);
                  $token = crypt($token, $key);
                  if ($_COOKIE['token_user'] == $token) {
                    $token = "ada";
                  } else {
                    $token = "";
                  }
                } else {
                  $token = "";
                  $kode = "";
                }
                if ($token == "ada") {
                ?>
                  <li class="nav-item"> <a class="nav-link" href="<?php echo $i->l; ?>"><?php echo $i->n; ?></a> </li>

                <?php
                } else {
                ?>
                <?php
                }
              } else {
                ?>
                <li class="nav-item"> <a class="nav-link" href="<?php echo $i->l; ?>"><?php echo $i->n; ?></a> </li>
              <?php } ?>
              <!-- /SINGLE -->
            <?php
            } else if ($i->t == 'm') {
              $idmenu = $i->id;
            ?>
              <!-- MULTI -->
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $i->n; ?><b class="caret hidden"></b></a>
                <ul class="dropdown-menu agile_short_dropdown">
                  <?php
                  $m1 = new SimpleXMLElement('home/include/settings/menu.xml', null, true);
                  foreach ($m1 as $i1) {
                    if ($i1->s == "$idmenu" and $i1->t == "sm") {
                  ?>
                      <li>
                      <li>
                        <a class="item" onclick="window.location = '<?php echo $i1->l; ?>'">
                          <?php echo $i1->n; ?></a>
                      </li>
              </li>
          <?php }
                  } ?>
        </ul>
        </li>
        <!-- /MULTI -->
    <?php }
          } ?>
    <!-- /MENU -->

    </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->
  <?php if (isset($_GET['p']) && ($_GET['p'] == "Home" or $_GET['p'] == "home")) { ?>
    <!-- ======= Hero Section ======= -->
    <section id="hero">

      <div class="container">
        <div class="row">
          <div class="col-lg-7 pt-5 pt-lg-0 order-2 order-lg-1 d-flex align-items-center">
            <div data-aos="zoom-out">
              <h1>Ayo Mari Bergabung di <span>Smart Member PT.CBS
                </span></h1>
              <h2>Banyak hadiah dan keuntungan yang akan anda dapatkan jika menjadi
                member kami.</h2>
              <div class="text-center text-lg-left">
                <a target="_blank" href="index.php?p=daftar" class="btn-get-started scrollto">Daftar Member</a>
              </div>
            </div>
          </div>
          <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="300">
            <img src="<?php echo $url; ?>assets/img/hero-img.png" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>
      <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
        <defs>
          <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
        </defs>
        <g class="wave1">
          <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
        </g>
        <g class="wave2">
          <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
        </g>
        <g class="wave3">
          <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
        </g>
      </svg>


    </section><!-- End Hero -->

    <main id="main">

      <!-- ======= About Section ======= -->
      <section id="about" class="about">
        <div class="container-fluid">

          <div class="row">
            <div class="col-xl-5 col-lg-6 video-box d-flex justify-content-center align-items-stretch" style="margin-left:111px; background:url(home/data/image/background/about.png), width:100%;  border-radius: 10px 10px 10px 10px;" data-aos="fade-right">

            </div>

            <div class="col-xl-6 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5" data-aos="fade-left">
              <h3>Banyak Keuntungan Menjadi Member</h3>
              <p>Tukarkan poin yang telah terkumpul dengan diskon
                pembelian bahan bakar</p>

              <div class="icon-box" data-aos="zoom-in" data-aos-delay="100">
                <div class="icon" style="color:red"><i class="bx bx-fingerprint"></i></div>
                <h4 class="title"><a href="<?php echo $url; ?>"> Redeem Point</a></h4>
                <p class="description">Tidak butuh waktu lama kamu untuk melakukan
                  redeem point dan daftar menjadi member.</p>
              </div>

              <div class="icon-box" data-aos="zoom-in" data-aos-delay="200">
                <div class="icon"><i class="bx bx-gift"></i></div>
                <h4 class="title"><a href="<?php echo $url; ?>">Hadiah Menarik</a></h4>
                <p class="description">Banyak sekali hadiah menarik yang biasa anda
                  dapatkan
                </p>
              </div>

              <div class="icon-box" data-aos="zoom-in" data-aos-delay="300">
                <div class="icon"><i class="bx bx-atom"></i></div>
                <h4 class="title"><a href="<?php echo $url; ?>">Smart Member PT.CBS</a></h4>
                <p class="description">Mari bergabung dikomunitas kami, selain hadiah
                  menarik yang akan anda dapatkan anda juga akan
                  mendapatkan wawasan serta ilmu dan tips-tips
                  dari kami</p>
              </div>

            </div>
          </div>

        </div>
      </section><!-- End About Section -->

      <!-- ======= Features Section ======= -->
      <section id="features" class="features">
        <div class="container">

          <div class="section-title" data-aos="fade-up">
            <h2>Layanan Kami
            </h2>
            <p>Keuntungan dan fasilitas untuk anda</p>
          </div>

          <div class="row" data-aos="fade-left">
            <div class="col-lg-3 col-md-4">
              <div class="icon-box" data-aos="zoom-in" data-aos-delay="50">
                <i class="ri-store-line" style="color: #ffbb2c;"></i>
                <h3><a href="<?php echo $url; ?>">• Banyak Mitra</a></h3>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
              <div class="icon-box" data-aos="zoom-in" data-aos-delay="100">
                <i class="ri-bar-chart-box-line" style="color: #5578ff;"></i>
                <h3><a href="<?php echo $url; ?>">• Banyak Hadiah</a></h3>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
              <div class="icon-box" data-aos="zoom-in" data-aos-delay="150">
                <i class="ri-calendar-todo-line" style="color: #e80368;"></i>
                <h3><a href="<?php echo $url; ?>">• Banyak Promo</a></h3>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 mt-4 mt-lg-0">
              <div class="icon-box" data-aos="zoom-in" data-aos-delay="200">
                <i class="ri-paint-brush-line" style="color: #e361ff;"></i>
                <h3><a href="<?php echo $url; ?>">• Pelayanan Terbaik</a></h3>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 mt-4">
              <div class="icon-box" data-aos="zoom-in" data-aos-delay="250">
                <i class="ri-database-2-line" style="color: #47aeff;"></i>
                <h3><a href="<?php echo $url; ?>">• Lokasi Strategis
                  </a></h3>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 mt-4">
              <div class="icon-box" data-aos="zoom-in" data-aos-delay="300">
                <i class="ri-gradienter-line" style="color: #ffa76e;"></i>
                <h3><a href="<?php echo $url; ?>">• Komunitas</a></h3>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 mt-4">
              <div class="icon-box" data-aos="zoom-in" data-aos-delay="350">
                <i class="ri-file-list-3-line" style="color: #11dbcf;"></i>
                <h3><a href="<?php echo $url; ?>">• Terpercaya</a></h3>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 mt-4">
              <div class="icon-box" data-aos="zoom-in" data-aos-delay="400">
                <i class="ri-price-tag-2-line" style="color: #4233ff;"></i>
                <h3><a href="<?php echo $url; ?>">• Banyak Diskon</a></h3>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 mt-4">
              <div class="icon-box" data-aos="zoom-in" data-aos-delay="450">
                <i class="ri-anchor-line" style="color: #b2904f;"></i>
                <h3><a href="<?php echo $url; ?>">• Fasilitas Lengkap</a></h3>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 mt-4">
              <div class="icon-box" data-aos="zoom-in" data-aos-delay="500">
                <i class="ri-disc-line" style="color: #b20969;"></i>
                <h3><a href="<?php echo $url; ?>">• Kenyamanan</a></h3>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 mt-4">
              <div class="icon-box" data-aos="zoom-in" data-aos-delay="550">
                <i class="ri-base-station-line" style="color: #ff5828;"></i>
                <h3><a href="<?php echo $url; ?>">• Pelayanan</a></h3>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 mt-4">
              <div class="icon-box" data-aos="zoom-in" data-aos-delay="600">
                <i class="ri-fingerprint-line" style="color: #29cc61;"></i>
                <h3><a href="<?php echo $url; ?>">• Keamanan data</a></h3>
              </div>
            </div>
          </div>

        </div>
      </section><!-- End Features Section -->

      <!-- ======= Counts Section ======= -->
      <section id="counts" class="counts">
        <div class="container">

          <div class="row" data-aos="fade-up">

            <div class="col-lg-3 col-md-6">
              <div class="count-box">
                <i class="icofont-document-folder "></i>
                <span data-toggle="counter-up">5</span>
                <p>Fasilitas</p>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
              <div class="count-box">
                <i class="icofont-users-alt-5"></i>
                <span data-toggle="counter-up">28</span>
                <p>Team Work</p>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
              <div class="count-box">
                <i class="icofont-live-support"></i>
                <span data-toggle="counter-up">24</span>
                <p>Jam Support Anda</p>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
              <div class="count-box">
                <i class="icofont-simple-smile"></i>
                <div class="row" style="padding-left:40%">
                  <span data-toggle="counter-up">90</span><span>%</span>
                </div>
                <p>Kepuasan Pelanggan</p>
              </div>
            </div>

          </div>

        </div>
      </section><!-- End Counts Section -->

      <!-- ======= Details Section ======= -->
      <section id="details" class="details">
        <div class="container">

          <div class="row content">
            <div class="col-md-4" data-aos="fade-right">
              <img src="<?php echo $url; ?>assets/img/details-1.png" class="img-fluid" alt="">
            </div>
            <div class="col-md-8 pt-4" data-aos="fade-up">
              <h3>Ayo bergabung di Smart Member PT.CBS</h3>
              <p class="font-italic">
                Isi formulir pendaftaran dan dapatkan kartu keanggotaan

              </p>
              <ul>
                <li><i class="icofont-check"></i> Langkah awal, kunjungi outlet kami terlebih dahulu</li>
                <li><i class="icofont-check"></i> Kemudian silahkan isi form pendaftaran di Office Kami.</li>
                <li><i class="icofont-check"></i> Silahkan pilih jenis kartu member yang tersedia.</li>
                <li><i class="icofont-check"></i> Setelah data anda selesai di input team kami, kami segera berikan kartu keanggotaan hari itu juga.</li>
              </ul>
              <p> Kamu tidak butuh waktu lama untuk mendapatkan kartu keanggotaan </p>
            </div>
          </div>

          <div class="row content">
            <div class="col-md-4 order-1 order-md-2" data-aos="fade-left">
              <img src="<?php echo $url; ?>assets/img/details-2.png" class="img-fluid" alt="">
            </div>
            <div class="col-md-8 pt-5 order-2 order-md-1" data-aos="fade-up">
              <h3>Tentang Smart Member PT.CBS</h3>
              <p class="font-italic">
                Kartu keanggotaan Smart Member PT.CBS ini merupakan bagian dari program Perusahaan yakni dengan maksud memberikan pelayanan dan keuntungan untuk konsumen.
              </p>
              <p>
                Melalui kepemilikan kartu keanggotaan konsumen yaitu
                dari kalangan pengendara roda dua, roda empat dan
                pelanggan setia akan mendapatkan poin dari setiap
                pembelanjaan bahan bakar dan Oli serta kami akan
                berikan kupon dan hadiah menarik lainnya.
              </p>

            </div>
          </div>

          <div class="row content">
            <div class="col-md-4" data-aos="fade-right">
              <img src="<?php echo $url; ?>assets/img/details-3.png" class="img-fluid" alt="">
            </div>
            <div class="col-md-8 pt-5" data-aos="fade-up">
              <h3>Cara mudah menggunakan kartu keanggotaan Smart Member PT.CBS</h3>
              <p>Anda bisa mengumpulkan poin setelah kartu Anda diaktivasi. Data Anda akan
                diinput ke dalam sistem kami. Penukaran poin bisa Anda lakukan saat data
                Anda sudah tercatat dalam sistem kami.</p>
              <ul>
                <li><i class="icofont-check"></i> Saat anda melakukan pengisian bahan bakar kamu akan mendapatkan point
                  dengan syarat telah menjadi member kami</li>
                <li><i class="icofont-check"></i> Kamu bisa cek Point kamu secara berkala dengan login pada website ini</li>
                <li><i class="icofont-check"></i> Kamu bisa tukarkan kupon dengan point dengan mudah di situs ini dengan
                  login terlebih dahulu
                </li>
                <li><i class="icofont-check"></i> Dapatkan informasi program dan hadiah yang di undi setiap bulannya

                <li><i class="icofont-check"></i>
                  Pemenang hadiah akan kami hubungi dan ambil hadiah
                  secara resmi di Outlet SPBU kami</li>
              </ul>

              <p>
                Dapatkan bahan bakar gratis dengan cara menukarkan point kamu.
              </p>
            </div>
          </div>

          <!--  <div class="row content">
          <div class="col-md-4 order-1 order-md-2" data-aos="fade-left">
            <img src="<?php echo $url; ?>assets/img/details-4.png" class="img-fluid" alt="">
          </div>
          <div class="col-md-8 pt-5 order-2 order-md-1" data-aos="fade-up">
            <h3>Quas et necessitatibus eaque impedit ipsum animi consequatur incidunt in</h3>
            <p class="font-italic">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
              magna aliqua.
            </p>
            <p>
              Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
              velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
              culpa qui officia deserunt mollit anim id est laborum
            </p>
            <ul>
              <li><i class="icofont-check"></i> Et praesentium laboriosam architecto nam .</li>
              <li><i class="icofont-check"></i> Eius et voluptate. Enim earum tempore aliquid. Nobis et sunt consequatur. Aut repellat in numquam velit quo dignissimos et.</li>
              <li><i class="icofont-check"></i> Facilis ut et voluptatem aperiam. Autem soluta ad fugiat.</li>
            </ul>
          </div>
        </div>-->

        </div>
      </section><!-- End Details Section -->




      <!-- ======= Dokumentasi Section ======= -->
      <section id="team" class="team">
        <div class="container">

          <div class="section-title" data-aos="fade-up">
            <h2>Dokumentasi</h2>
            <p>Galeri dan Fasilitas Kami</p>
          </div>

          <div class="row" data-aos="fade-left">
            <?php
            $querytabel1 = "SELECT * FROM data_galery LIMIT 0,8";
            $proses1 = mysql_query($querytabel1);
            while ($data1 = mysql_fetch_array($proses1)) {
            ?>

              <div class="col-lg-3 col-md-6">
                <div class="member" data-aos="zoom-in" data-aos-delay="100"
                  onclick="showModal(
              '<?php echo addslashes($data1['judul']); ?>',
              'admin/upload/<?php echo $data1['foto']; ?>',
              '<?php echo addslashes($data1['isi']); ?>'
            )"
                  style="cursor:pointer;">

                  <div class="pic">
                    <img style="width:100%; height:300px; object-fit:cover; object-position:center;"
                      src="admin/upload/<?php echo ($data1['foto']); ?>" class="img-fluid" alt="">
                  </div>

                  <div class="member-info">
                    <h4><?php echo ($data1['judul']); ?></h4>
                    <span><?php echo ($data1['tanggal']); ?></span>
                  </div>

                </div>
              </div>

            <?php } ?>
          </div>

        </div>
      </section>
      <!-- End Dokumentasi Section -->



      <!-- ======= Team Section ======= -->
      <section id="team" class="team">
        <div class="container">

          <div class="section-title" data-aos="fade-up">
            <h2>Team</h2>
            <p>Our Team</p>
          </div>

          <div class="row" data-aos="fade-left">
            <?php
            $querytabel1 = "SELECT * FROM data_team LIMIT 0,8";
            $proses1 = mysql_query($querytabel1);
            while ($data1 = mysql_fetch_array($proses1)) {
            ?>

              <div class="col-lg-3 col-md-6">
                <div class="member" data-aos="zoom-in" data-aos-delay="100"
                  onclick="showModal(
              '<?php echo addslashes($data1['nama_team']); ?>',
              'admin/upload/<?php echo $data1['foto']; ?>',
              '<?php echo addslashes($data1['bagian']); ?>'
            )"
                  style="cursor:pointer;">

                  <div class="pic">
                    <img style="width:100%; height:300px; object-fit:cover; object-position:center;"
                      src="admin/upload/<?php echo ($data1['foto']); ?>" class="img-fluid" alt="">
                  </div>

                  <div class="member-info">
                    <h4><?php echo ($data1['nama_team']); ?></h4>
                    <span><?php echo ($data1['bagian']); ?></span>
                  </div>

                </div>
              </div>

            <?php } ?>
          </div>

        </div>
      </section>
      <!-- End Team Section -->


      <!-- ========================================================= -->
      <!-- ===============   MODAL + FUNCTION JS   ================= -->
      <!-- ========================================================= -->
      <div class="modal fade" id="modalPreview" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
          <div class="modal-content">

            <div class="modal-header">
              <h5 class="modal-title" id="modalTitle">Detail</h5>
              <span onclick="closeModal()"
                style="font-size:28px; cursor:pointer; line-height:20px;">
                &times;
              </span>
            </div>

            <div class="modal-body text-center">
              <img id="modalImage" src="" style="width:100%; max-height:400px; object-fit:cover;">
              <p id="modalDesc" class="mt-3"></p>
            </div>

          </div>
        </div>
      </div>

      <script>
        function showModal(title, img, desc) {
          document.getElementById("modalTitle").innerHTML = title;
          document.getElementById("modalImage").src = img;
          document.getElementById("modalDesc").innerHTML = desc;

          $('#modalPreview').modal('show');
        }

        function closeModal() {
          $('#modalPreview').modal('hide');
        }
      </script>



      <!-- ======= Pricing Section ======= -->

      <section id="pricing" class="pricing">
        <div class="container">

          <div class="section-title aos-init aos-animate" data-aos="fade-up">
            <h2>Smart Member PT.CBS</h2>
            <p>Keuntungan Pengguna</p>
          </div>

          <div class="row aos-init aos-animate" data-aos="fade-left">

            <div class="col-lg-4 col-md-6 mt-4 mt-md-0">
              <div class="box featured aos-init aos-animate" data-aos="zoom-in" data-aos-delay="200">
                <h3>Point</h3>

                <p>Dengan memiliki kartu member anda dapat mengumpulkan point setiap dari pada transaksi</p>
                <div class="btn-wrap">
                  <a href="index.php?p=daftar" class="btn-buy">Daftar Member</a>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6">
              <div class="box aos-init aos-animate" data-aos="zoom-in" data-aos-delay="100">
                <h3>Hadiah</h3>

                <p>Beragam hadiah yang akan anda dapatkan jika memiliki kartu member</p>
                <div class="btn-wrap">
                  <a href="index.php?p=daftar" class="btn-buy">Daftar Member</a>
                </div>
              </div>
            </div>



            <div class="col-lg-4 col-md-6 mt-4 mt-lg-0">
              <div class="box aos-init aos-animate" data-aos="zoom-in" data-aos-delay="300">
                <span class="advanced"> </span>
                <h3>Hemat</h3>

                <p>Dengan memiliki kartu member anda dapat menghemat biaya kebutuhan anda</p>
                <div class="btn-wrap">
                  <a target="blank" href="mailto:<?php echo baca_database('data_profil', 'email', "select * From data_profil"); ?>?subject=Pendaftaran%20Member%20Card" class="btn-buy">Daftar Member</a>
                </div>
              </div>
            </div>



          </div>

        </div>
      </section>


      <!-- ======= F.A.Q Section ======= -->
      <section id="faq" class="faq section-bg">
        <div class="container">

          <div class="section-title" data-aos="fade-up">
            <h2>F.A.Q</h2>
            <p>Hal yang sering ditanyakan</p>
          </div>

          <div class="faq-list">
            <ul>
              <?php


              $querytabel1 = "SELECT * FROM data_faq LIMIT 0,8";
              $proses1 = mysql_query($querytabel1);
              while ($data1 = mysql_fetch_array($proses1)) {
                $id = $data1['id_faq'];
              ?>
                <li data-aos="fade-up" data-aos-delay="400">
                  <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#faq-list-<?php echo $id; ?>" class="collapsed"><?php echo $data1['tanya']; ?><i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="faq-list-<?php echo $id; ?>" class="collapse" data-parent=".faq-list">
                    <p>
                      <?php echo $data1['jawab']; ?>
                    </p>
                  </div>
                </li>

              <?php } ?>
            </ul>
          </div>

        </div>
      </section><!-- End F.A.Q Section -->

      <!-- ======= Contact Section ======= -->
      <section id="contact" class="contact">
        <div class="container">

          <div class="section-title" data-aos="fade-up">
            <h2>Kontak</h2>
            <p>Hubungi Kami</p>
          </div>

          <div class="row">

            <div class="col-lg-4" data-aos="fade-right" data-aos-delay="100">
              <div class="info">
                <div class="address">
                  <i class="icofont-google-map"></i>
                  <h4>Alamat:</h4>
                  <p><?php echo $alamat; ?></p>
                </div>

                <div class="email">
                  <i class="icofont-envelope"></i>
                  <h4>Email:</h4>
                  <p><?php echo $email; ?></p>
                </div>

                <div class="phone">
                  <i class="icofont-phone"></i>
                  <h4>Telepon:</h4>
                  <p>+62811-7451-743</p>
                </div>

              </div>

            </div>

            <div class="col-lg-8 mt-5 mt-lg-0" data-aos="fade-left" data-aos-delay="200">

              <style>
                .contact-card {
                  background: #ffffff;
                  padding: 30px;
                  border-radius: 12px;
                  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
                }

                .contact-card .form-control {
                  border-radius: 10px;
                  border: 1px solid #ddd;
                  padding: 12px;
                  font-size: 15px;
                }

                .contact-card .form-control:focus {
                  border-color: #007bff;
                  box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
                }

                .contact-card button {
                  width: 100%;
                  padding: 12px;
                  border-radius: 10px;
                  background: #007bff;
                  border: none;
                  color: #fff;
                  font-weight: 600;
                  letter-spacing: 0.5px;
                  transition: 0.3s;
                }

                .contact-card button:hover {
                  background: #0056d2;
                }
              </style>


              <div class="contact-card">
                <form id="contactForm">
                  <div class="form-row">
                    <div class="col-md-6 form-group">
                      <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                    </div>

                    <div class="col-md-6 form-group">
                      <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <input type="text" name="subject" class="form-control" placeholder="Subject" required>
                  </div>

                  <div class="form-group">
                    <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                  </div>

                  <button type="button" onclick="sendWhatsapp()">Send Message</button>
                </form>
              </div>


              <script>
                function sendWhatsapp() {
                  let name = document.querySelector('[name="name"]').value;
                  let email = document.querySelector('[name="email"]').value;
                  let subject = document.querySelector('[name="subject"]').value;
                  let message = document.querySelector('[name="message"]').value;

                  if (!name || !email || !subject || !message) {
                    alert("Please fill all fields.");
                    return;
                  }

                  let nomor = "628117451743"; // nomor WA tujuan (tanpa +)

                  let text =
                    "*Pesan Baru Dari Website*\n\n" +
                    "*Nama:* " + name + "\n" +
                    "*Email:* " + email + "\n" +
                    "*Subjek:* " + subject + "\n" +
                    "*Pesan:* " + message + "\n\n" +
                    "Dikirim dari website Anda.";

                  let url = "https://wa.me/" + nomor + "?text=" + encodeURIComponent(text);

                  window.open(url, "_blank");
                }
              </script>


            </div>

          </div>

        </div>
      </section><!-- End Contact Section -->

    </main><!-- End #main -->


  <?php } else { ?>

    <style>
      #hero {
        width: 100%;
        background: url(../img/hero-bg.jpg);
        position: relative;
        padding: 15px 0 0 0;
      }
    </style>


    <section id="hero">



      <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
        <defs>
          <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
          </path>
        </defs>
        <g class="wave1">
          <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
          </use>
        </g>
        <g class="wave2">
          <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
          </use>
        </g>
        <g class="wave3">
          <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
          </use>
        </g>
      </svg>

    </section>

  <?php } ?>

  <?php include 'halaman.php'; ?>
  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-6">
            <div class="footer-info">
              <h3>SPBU 24.37327/32</h3>
              <img src="admin/data/image/logo/logo2.png" width="200px" style="background-color:white; border-radius:50%">
            </div>
          </div>


          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Tentang</h4>
            <p style=" line-height: 2;">PT. CBS Merupakan Perusahaan Penyalur BBM, Badan Usaha Niaga Migas untuk kegiatan usaha Niga umum BBM dibawah naungan PT. PERTAMINA PERSERO.

            </p>


            <p><STRONG>Outlet Kami</STRONG></p>
            <p>SPBU 24.373.27
              <BR> SPBU 24.373.32

          </div>
          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Link Terkait</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="?p=home">Beranda</a></li>
              <!-- <li><i class="bx bx-chevron-right"></i> <a href= "?p=tambah">Tambah Point</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href= "?p=tukar">Tukar Point</a></li> -->
              <li><i class="bx bx-chevron-right"></i> <a href="?p=login">Masuk</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="?p=profil">Poin Saya</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Layanan Kami</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="http://cbs-indo.com">Penyuplai BBM</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="http://cbs-indo.com">Pelumas dan Gas LPG</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="http://cbs-indo.com">Resto & Cafe</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="http://cbs-indo.com">Layanan SPBU 24 Jam</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="http://cbs-indo.com">Layanan Smart Member PT.CBS</a></li>
            </ul>
          </div>


        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        <?php echo $copyright; ?>
      </div>

    </div>
  </footer><!-- End Footer -->


  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="<?php echo $url; ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo $url; ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo $url; ?>assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="<?php echo $url; ?>assets/vendor/php-email-form/validate.js"></script>
  <script src="<?php echo $url; ?>assets/vendor/venobox/venobox.min.js"></script>
  <script src="<?php echo $url; ?>assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="<?php echo $url; ?>assets/vendor/counterup/counterup.min.js"></script>
  <script src="<?php echo $url; ?>assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="<?php echo $url; ?>assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo $url; ?>assets/js/main.js"></script>

</body>

</html>