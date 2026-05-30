<?php if(empty($p)) { header("Location: index.php?=home"); die(); } ?>

  <section class="featured-project-section-s2 featured-project-pg-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2">
                        <div class="section-title-s5">
                            <span>Explore</span>
                            <h2>Galery dan Fasilitas Kami</h2>
                       
                        </div>
                    </div>
                </div>
            </div>
			</section>

<?php galery("data_galery","id_galery","tanggal","judul","foto","isi");?>

