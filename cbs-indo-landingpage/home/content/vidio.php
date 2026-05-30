<?php function vidio($tabel,$id,$tanggal,$judul,$vidio,$keterangan)
{

	if (!(isset($_GET['Go'])))
	{
?>
<section id="gallery">
			   <style>
* {
  box-sizing: border-box;
}

video {
  width: 100%;
  height: auto;
}

.row:after {
  content: "";
  clear: both;
  display: table;
}


@media only screen and (min-width: 600px) {
  .col-s-1 {width: 8.33%;}
  .col-s-2 {width: 16.66%;}
  .col-s-3 {width: 25%;}
  .col-s-4 {width: 33.33%;}
  .col-s-5 {width: 41.66%;}
  .col-s-6 {width: 50%;}
  .col-s-7 {width: 58.33%;}
  .col-s-8 {width: 66.66%;}
  .col-s-9 {width: 75%;}
  .col-s-10 {width: 83.33%;}
  .col-s-11 {width: 91.66%;}
  .col-s-12 {width: 100%;}
}

@media only screen and (min-width: 768px) {
  .col-1 {width: 8.33%;}
  .col-2 {width: 16.66%;}
  .col-3 {width: 25%;}
  .col-4 {width: 33.33%;}
  .col-5 {width: 41.66%;}
  .col-6 {width: 50%;}
  .col-7 {width: 58.33%;}
  .col-8 {width: 66.66%;}
  .col-9 {width: 75%;}
  .col-10 {width: 83.33%;}
  .col-11 {width: 91.66%;}
  .col-12 {width: 100%;}
}

html {
  font-family: "Lucida Sans", sans-serif;
}

.header {
  background-color: #9933cc;
  color: #ffffff;
  padding: 15px;
}

.menu ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

.menu li {
  padding: 8px;
  margin-bottom: 7px;
  background-color: #33b5e5;
  color: #ffffff;
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}

.menu li:hover {
  background-color: #0099cc;
}

.aside {
  background-color: #33b5e5;
  padding: 15px;
  color: #ffffff;
  text-align: center;
  font-size: 14px;
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}

.footer {
  background-color: #0099cc;
  color: #ffffff;
  text-align: center;
  font-size: 12px;
  padding: 15px;
}
</style>


<?php
				if (isset($_GET['page']) && !empty($_GET['page'])){ $page = (int)$_GET['page']; }
				else { $page = 1; }
				if (isset($_GET['perPage']) && !empty($_GET['perPage'])){ $dataPerPage = (int)$_GET['perPage']; }
				else { $dataPerPage = 12; }
				
				
				$no = 0;
				$startRow=($page-1)*$dataPerPage;
				$no = $startRow;
				
				if (isset($_GET['Berdasarkan']) && !empty($_GET['Berdasarkan']) && isset($_GET['isi']) && !empty($_GET['isi']))
				{
				$berdasarkan = $_GET['Berdasarkan'];
				$isi = $_GET['isi'];
				$querytabel="SELECT * FROM $tabel where $berdasarkan like '%$isi%'  LIMIT $startRow ,$dataPerPage";
				$querypagination="SELECT COUNT(*) AS total FROM $tabel where $berdasarkan like '%$isi%'";
				}
				else
				{
				$querytabel="SELECT * FROM $tabel  LIMIT $startRow ,$dataPerPage";
				$querypagination="SELECT COUNT(*) AS total FROM $tabel";
				}
				$proses = mysql_query($querytabel);
				while ($data = mysql_fetch_array($proses))
				  { 
			?>
      <div class="container">
   <div class="col-xs-9" id="images-container" style="position: relative; overflow: hidden; height: 230px; transition: height 400ms ease-out 0s;">

<Br>
<Br>
	<?php
	$querytabel="SELECT * FROM data_vidio";
	$proses = mysql_query($querytabel);
	while ($data = mysql_fetch_array($proses))
	{ ?>
   <div class="col-xs-9 col-sm-4 col-md- shuffle-item filtered" style="">

 <video width="100%" controls>
      <source src="admin/upload/<?php echo $data['vidio']; ?>" type="video/mp4">
      Your browser does not support HTML5 video.
    </video>
	<div class="agent-box-card grey top-agent" style="padding-left : 0px; padding-right: 0px;">
									
									<div class="info-agent">
										<span class="name"><?php echo $data['judul']; ?></span>
										<div class="text" style="padding : 0px 0px 0px 0px">
											</i><?php echo $data['isi']; ?></i>
										</div>
																			</div>
								</div>
	</div>
	<?php } ?>
  </div >
  
  <div class="col-md-3">
						<div class="section-title line-style">
							<h3 class="title">Update Pengumuman</h3>
						</div>
						<div class="logs">
												<?php 
							
				
				$querytabel3="SELECT * FROM data_vidio order by tanggal desc limit 0,10";
				$proses3 = mysql_query($querytabel3);
				while ($data3 = mysql_fetch_array($proses3))
				  {
 $id_pengumuman= $data3['id_pengumuman'];
			  ?>	
			<div class="log"><br>
										
										<span class=""><strong><?php echo $data3['judul']; ?></span></strong><br><br>
										<span class="data"><?php echo $data3['tanggal']; ?></span>
										
									</div><!-- /.log -->
							
				  <?php } ?>
						</div>
						
					</div>
  </div>
</div>
</div>
</div>
</div>
</section>
    
		  



    <?php
				} ?>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <br>
            <center>
                <?php Pagination_font_end($page,$dataPerPage,$querypagination); ?>
            </center>
            <br>
            <br>
        </div>
    </div>
</div>
<?php }
else {
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="index.php?p=vidio" class="btn btn-primary">Kembali</a>
            <br>
            <br>
            <?php 
				$sql=mysql_query("SELECT * FROM $tabel where $judul = '".mysql_real_escape_string($_GET['Go'])."'");
				$data=mysql_fetch_array($sql);
				?>
						<img 
						width="800" 
						src="admin/upload/<?= $data[$foto];?>"
						onerror="this.src='home/data/image/error/error.png'" 
						/>
            <h3><?= $data[$judul];?></h3>
            <hr>
            <p>
                <?= $data[$keterangan];?>
            </p>
            <br>
            <br>
        </div>
    </div>
</div>
<?php }

}?>