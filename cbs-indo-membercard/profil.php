<?php if(empty($p)) { header("Location: index.php?p=home"); die(); }

	/*	if (isset($_COOKIE["kodene"]))
		{
			$ids= decrypt($_COOKIE['kodene']);
		}
		else
		{
		?>
		<script>
			alert("MAAF ANDA BELUM LOGIN,SILAHKAN LOGIN TERLEBIH DAHULU");
			location.href = "index.php?p=login"; </script>
		<?php
		}*/
		?>
<br>

<head>
<style>



.card {
  border-radius: 8px;
  background-color: white;
  margin: 1% auto;
  overflow: hidden;
  width: 400px;
}

.wall-container {
  height: 200px;
  overflow: hidden;
}

.wall-pic {
  border-radius: 8px 8px 0 0;
  width: 100%;
}

.profile {
  border-width: 1px 0 0 0;
  border-style: solid;
  border-color: #454545;
  height: 100px;
  padding: 20px;
}

.profile h2 {
  color: #776B5F;
  font: 28px/30px Helvetica, sans-serif;
  font-weight: bold;
  margin: 5px 0 10px 0;
  padding: 0;
  text-transform: capitalize;
}

.profile p {
  color: #776B5F;
  font: 14px/16px Helvetica, sans-serif;
  margin: 0;
  padding: 0;
  width: 100%;
}

.profile-pic-border{
    border: 1px solid #B7AEA4;
    border-radius: 50%;
    float: left;
    height: 75px;
    margin: 0 20px 0 0;
    width: 75px;
}

.profile-pic {
   border: 5px solid #fff;
   border-radius: 50%;
   height: 75px;
   width: 75px;
}

.scc-container {
  height: 50px;
}

.scc {
  box-sizing: border-box;
  background-color: #f6f1ed;
  float: left;
  height: 50px;
  padding: 0 0 0 0px;
  width: 33%;
}

.scc-icon {
  color: #b1a599;
  float: left;
  font-family: 'RaphaelIcons';
  font-size: 30px;
  font-weight: 300;
  line-height: 18px;
  margin: 0 8px 0 0;
}

.scc p {
  color: #b1a599;
  font: 18px/18px Helvetica, sans-serif;
  font-weight: bold;
}

.middle {
  margin: 0 2px 0 2px;
}

@media screen and (max-width:480px){
  .card{
    width:350px;
  }

  #points{
    font-size: 1.2rem;
  }
}
</style>
</head>
<body>
<center>
    <h2>
        PROFIL
    </h2>
</center>
<br>

<?php
					$sql=mysql_query("SELECT * FROM data_member");
					$data=mysql_fetch_array($sql);
					$ids= decrypt($_COOKIE['kodene']);
					$id_member = $data['id_member'];
				

$nama = baca_database("","nama","select * from data_member where id_member='$ids'");
$username = baca_database("","username","select * from data_member where id_member='$ids'");
$no_telepon = baca_database("","no_telepon","select * from data_member where id_member='$ids'");
$id_kategori_member = baca_database("","id_kategori_member","select * from data_member where id_member='$ids'");

					?>

<!-- <div id="gurney_hallek_profile_card" class="card">
  <div class="wall-container">
    <img class="wall-pic" style="position: relative;	z-index: 1;"  src="home/data/image/background/about.png" /><center>
	<br>
	
	<p style="position: absolute;
		top: 20px;
		padding-left:35%;
		padding-right:35%;
		padding-top:15%;
		z-index: 2;
		color: #fff; font-size:30px"><?php  baca_database("","kategori_member","select * from data_kategori_member where id_kategori_member='$id_kategori_member'");?></p></center>
  </div>
  <div class="profile" >
   <div class="profile-pic-border"style="border:0px" >
    <img class="profile-pic" src="home/data/image/background/profil.jpg"/>
    </div><Br>
    <h5> <?php 
	$nama = baca_database("","nama","select * from data_member where id_member='$ids'");?><!--<a href="?p=edit"><i class="fa fa-edit" href="?p=edit"></a></i>-->

 <!-- <tr>
				<td class="clleft"><?php echo $nama; ?></td>	
			   </tr>
			   </h5><br>
			   
			   
			   <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" />
			   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />

    <br>
	<p style="padding-left:20px"><i class="fa fa-location-arrow"></i>&nbsp;&nbsp;<?php echo baca_database("","alamat","select * from data_member where id_member='$ids'");?></p><Br>
	<p style="padding-left:20px"><i class="fa fa-phone"></i>&nbsp;&nbsp;<?php echo baca_database("","no_telepon","select * from data_member where id_member='$ids'");?></p>
	
  </div>
  <br>
  <br>
  <br>
  <br>
  <br>
  
  <div class="scc-container">
    <div class=" scc seen"style="max-width:30%"> <center><p><br><span class="scc-icon"></span><?php $jk= baca_database("","jenis_kelamin","select * from data_member where id_member='$ids'");
	
	if (($jk)=="laki-laki")
	
	{
		echo"Pria";
	}
	else
	{
		echo"Wanita";
	}
	
	
	?></center></p> </div>
  
    <div class=" scc liked" style="width:67%; margin:0 0px 0px 2px"><center> <p><br><span class="scc-icon"></span><?php echo baca_database('','point',"SELECT * FROM data_member WHERE id_member='$ids'");?> POINT</p> </center></div>
  </div>
</div> 
<br>
<br>
<Br> -->
</body>
<script>
// $('.scc').mouseenter( function() {
//   $( this ).animate({
//     'margin-top': '-10px'
//   }, 100,  function () {
//    $( this ).animate({
//     'margin-top': '0px'
//     });
//   });
// });

// $('.profile-pic').mouseenter ( function() {
//   $(this).animate ( {
//       'margin' : '8px',
//       'width': '60px',
//       'height': '60px' 
//   }, 300, function () {
//     $(this).animate ( {
//       'margin' : '0px',
//       'width': '75px',
//       'height': '75px' 
//     });
//   });
// });
</script>
<!-- PROFIL -->


<?php
//library phpqrcode
include "admin/data/phpqrcode/qrlib.php";

//direktory tempat menyimpan hasil generate qrcode jika folder belum dibuat maka secara otomatis akan membuat terlebih dahulu
$tempdir = "temp/"; 
if (!file_exists($tempdir))
    mkdir($tempdir);

?>

<div class="container" style='background-color:#00008B;color:#ffff;padding:5px'>
  <h3 style='text-align:center;margin:0px'> Smart Membercard CBS</h3>
</div>
<div class="container mt-3">
<div class="table-reponsive">
  <table style='width:100%'>
    <thead>
      <tr>
        <td>Nama Member</td>
        <td width='2%'>:</td>
        <td><?= $nama ?></td>
      </tr>
      <tr>
        <td>ID Member</td>
        <td width='2%'>:</td>
        <td><?= $ids ?></td>
      </tr>
    </thead>
  </table>
</div>
</div>
<?php
    //isi QRCode saat discan
    $code = encrypt($ids);
    $isi_teks = "http://membercard.cbs-indo.com/index.php?p=login&code=".$code;
    //direktori dan nama logo
    $logopath = 'admin/data/image/logo/logo.png';
    //namafile setelah jadi qrcode
    $namafile = encrypt($ids).".png";
    //kualitas dan ukuran qrcode
    $quality = 'H'; 
    $ukuran = 8; 
    $padding = 0;

    QRCode::png($isi_teks,$tempdir.$namafile,QR_ECLEVEL_H,$ukuran,$padding);
    $filepath = $tempdir.$namafile;
    $QR = imagecreatefrompng($filepath);

    $logo = imagecreatefromstring(file_get_contents($logopath));
    $QR_width = imagesx($QR);
    $QR_height = imagesy($QR);

    $logo_width = imagesx($logo);
    $logo_height = imagesy($logo);

    //besar logo
    $logo_qr_width = $QR_width/3;
    $scale = $logo_width/$logo_qr_width;
    $logo_qr_height = $logo_height/$scale;

    //posisi logo
    imagecopyresampled($QR, $logo, $QR_width/3.3, $QR_height/2.5, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);

    imagepng($QR,$filepath);
  ?>
 

<div class="d-flex justify-content-center">
  <section id="details" class="details">
    <div class="container">


        <div class="row content">
          <div class="col-md-4 aos-init aos-animate" data-aos="fade-right">
            <img src="temp/<?php echo $namafile; ?>" class="img-fluid" alt="">
            <p class="text-center mt-3">Tanggal Terdaftar : <?= format_indo(baca_database("","tanggal_terdaftar","select * from data_member where id_member='$ids'")) ?></p>
            <div class="row mt-5">
              <a onclick="downloadCard()" href="#" class="btn btn-success col-12">DOWNLOAD QRCODE</a>
            </div>
             
          </div>
          <div class="col-md-8 pt-4 aos-init aos-animate" data-aos="fade-up">
            <h3 id='points'>JUMLAH POIN ANDA : <?= baca_database("","point","select * from data_member where id_member='$ids'") ?> POIN</h3>
            <p class="font-italic">
              Qrcode Smart Member PT.CBS dapat digunakan untuk Transaksi

            </p>
            <ul>
              <li><i class="icofont-check"></i> Scan menggunakan kamera handphone anda untuk akses login</li>
              <li><i class="icofont-check"></i> Tunjukan Ke Operator & Scan menggunakan EDC SPBU untuk transaksi.</li>
              <li><i class="icofont-check"></i> Tunjukan Ke Operator & Scan menggunakan EDC SPBU untuk Redeem Point.</li>
             
            </ul>
            <p> Satu Qrcode untuk akses berbagai fitur Smart Member PT.CBS  </p>
            <p> Digunakan Sebagai <b>Pengganti Kartu fisik</b> Membership, Download QRCODE Sekarang  </p>
            <!-- <a target="blank" href="temp/<?php echo $namafile; ?>" class="btn btn-success" download>DOWNLOAD QRCODE</a> -->
          </div>
        </div>

       
    </section>
</div>

<!-- CARD KHUSUS UNTUK DOWNLOAD (Tidak terlihat user, tapi html2canvas bisa capture dengan baik) -->
<!-- CARD KHUSUS UNTUK DOWNLOAD (KITA BUAT TERLIHAT DULU UNTUK TEST) -->
<div id="membercard-download" style="
position: fixed;             /* Keluar dari flow normal */
  bottom: -1000px;             /* Dorong jauh ke bawah halaman (tidak terlihat user) */
  left: 50%;                   
  transform: translateX(-50%); /* Tengah horizontal */
  width: 600px;
  z-index: -10;                /* Di belakang semua elemen */
  pointer-events: none;        /* Tidak bisa diklik */
">
  <div style="background:#ffffff; padding:30px; width:600px; margin:0 auto; border-radius:20px; box-shadow:0 8px 30px rgba(0,0,0,0.15); text-align:center; font-family:Arial, sans-serif;">

    <div style="background:#00008B; color:white; padding:20px; border-radius:20px 20px 0 0; margin:-30px -30px 30px -30px;">
      <h3 style="margin:0; font-size:26px; font-weight:bold;">Smart Membercard CBS</h3>
    </div>

    <table style="width:100%; margin:20px 0; font-size:19px;">
      <tr><td style="text-align:left; font-weight:bold;">Nama Member</td><td>:</td><td style="text-align:left;"><?= $nama ?></td></tr>
      <tr><td style="text-align:left; font-weight:bold;">ID Member</td><td>:</td><td style="text-align:left;"><?= $ids ?></td></tr>
    </table>

    <img src="temp/<?php echo $namafile; ?>" style="width:300px; height:300px; border-radius:15px; box-shadow:0 6px 20px rgba(0,0,0,0.2);" crossorigin="anonymous">

    <p style="margin-top:25px; font-size:18px;">
      <strong>Tanggal Terdaftar:</strong><br>
      <?= format_indo(baca_database("","tanggal_terdaftar","select * from data_member where id_member='$ids'")) ?>
    </p>

    

  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
function downloadCard() {
  const element = document.querySelector("#membercard-download .card-inner"); // nanti kita tambah class
  html2canvas(document.querySelector("#membercard-download"), {
    scale: 2,
    useCORS: true,
    backgroundColor: null,  // biar shadow tetap ada
    logging: true           // sementara nyalakan logging buat debug
  }).then(canvas => {
    // Tampilkan preview dulu (opsional, buat test)
    // document.body.appendChild(canvas); // uncomment kalau mau lihat canvas di halaman

    let link = document.createElement('a');
    link.download = 'MemberCard_CBS_<?= $ids ?>.png';
    link.href = canvas.toDataURL('image/png');
    link.click();
  }).catch(err => {
    console.error("Error:", err);
    alert("Error: " + err.message);
  });
}
</script>





