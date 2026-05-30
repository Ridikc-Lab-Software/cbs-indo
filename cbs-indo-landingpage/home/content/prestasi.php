<?php 
function prestasi($tabel,$id,$tanggal,$judul,$foto,$keterangan)
{
	if (!(isset($_GET['Go'])))
	{
	?>

    <!-- BERITA -->

    <!--    <form name="formcari" id="formcari" action="" method="get">
            <fieldset>
                <table>
                    <tbody>
                        <input name="p" value="prestasi" id="page" type="hidden">
                        <input
                            value="<?php echo $judul;?>"
                            type="hidden"
                            name="Berdasarkan"
                            id="Berdasarkan">

                        <tr>
                            <td>Pencarian</td>
                            <td>:</td>
                            <td>
                                <input type="text" name="keterangan" value="">
                                <?php
										if (isset($_GET['Berdasarkan']))
										{
											btn_cari('Cari');
											?>
                                <a class="btn btn-primary" href="index.php?p=prestasi">
                                    Reset
                                </a>
                            <?php
										}
										else
										{
											?>

                                <?php
											btn_cari('Cari');
											
										}
								?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
        </form>
		
	-->	
		
<section class="blog-pg-section section-padding">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
					
					
					
    <?php
				if (isset($_GET['page']) && !empty($_GET['page'])){ $page = (int)$_GET['page']; }
				else { $page = 1; }
				if (isset($_GET['perPage']) && !empty($_GET['perPage'])){ $dataPerPage = (int)$_GET['perPage']; }
				else { $dataPerPage = 5; }
				
				
				$no = 0;
				$startRow=($page-1)*$dataPerPage;
				$no = $startRow;
				
				if (isset($_GET['Berdasarkan']) && !empty($_GET['Berdasarkan']) && isset($_GET['keterangan']) && !empty($_GET['keterangan']))
				{
				$berdasarkan = $_GET['Berdasarkan'];
				$keterangan = $_GET['keterangan'];
				$querytabel="SELECT * FROM $tabel where $berdasarkan like '%$keterangan%'  LIMIT $startRow ,$dataPerPage";
				$querypagination="SELECT COUNT(*) AS total FROM $tabel where $berdasarkan like '%$keterangan%'";
				}
				else if (isset($_GET['kategori_prestasi']) && !empty($_GET['kategori_prestasi']))
				{
				$kategori_prestasi = $_GET['kategori_prestasi'];
				$keterangan = $_GET['keterangan'];
				$querytabel="SELECT * FROM $tabel where id_kategori_prestasi = '$kategori_prestasi'  LIMIT $startRow ,$dataPerPage";
				$querypagination="SELECT COUNT(*) AS total FROM $tabel where id_kategori_prestasi = '$kategori_prestasi' ";
				}
				else
				{
				$querytabel="SELECT * FROM $tabel  LIMIT $startRow ,$dataPerPage";
				$querypagination="SELECT COUNT(*) AS total FROM $tabel";
				}
				$proses = mysql_query($querytabel);
				while ($data = mysql_fetch_array($proses))
				{ ?>
			
 <div class="post format-standard-image">
                                <div class="entry-media">
                                    <img src="membercard/admin/upload/<?php echo $data['foto']; ?>" alt>
                                </div>
                                <ul class="entry-meta">
                                    <li><a href="#"><i class="ti-time"></i><?php echo format_indo($data['tanggal']); ?></a></li>
                                    <li><a href="#"><i class="ti-user"></i> Admin</a></li>
                                   
                                </ul>
                                <h3><a href="index.php?p=prestasi&a&Go=<?php echo $data[$judul];?>"><?php echo $data['judul']; ?></a></h3>
                                <p><?php echo substr($data['keterangan'],0,400); ?>...</p>
                                <a href="index.php?p=prestasi&a&Go=<?php echo $data[$judul];?>" class="theme-btn">Read More</a>
                            </div>
							
							<br>
							<br>
							<br>
							<br>

	<?php } ?>
		
    </div>
   
    <!-- BERITA -->
	
							
							
    <!-- TERBARU -->
    	<div class="col-md-4">
		<div class="blog-sidebar">
						<div class="widget search-widget">
							<h3 class="title">Search Post</h3>
						

						<form name="formcari" id="formcari" action="" method="get">
						
						 <input name="p" value="prestasi" id="page" type="hidden">
                        <input
                            value="<?php echo $judul;?>"
                            type="hidden"
                            name="Berdasarkan"
                            id="Berdasarkan">



						 <input type="text" class="form-control" placeholder="Search Post.." name="keterangan" value="">
                                <?php
										if (isset($_GET['Berdasarkan']))
										{
											btn_cari('');
											?>
                              <!--  <a class="btn btn-primary" href="index.php?p=prestasi">
                                   Reset 
                                </a> -->
                            <?php
										}
										else
										{
											?>

                                <?php
											btn_cari('');
											
										}
								?>
							
							</form>
						</div>
						
						<div class="widget recent-post-widget">
                                <h3>Recent Award</h3>
                                <div class="posts">
								 <?php
				$querytabel="SELECT * FROM $tabel ORDER BY $tanggal DESC LIMIT 0 ,25";
				$proses = mysql_query($querytabel);
				while ($data = mysql_fetch_array($proses))
				{ ?>
                                    <div class="post">
                                        <div class="img-holder">
                                            <img src="membercard/admin/upload/<?php echo $data["$foto"]; ?>" width="100%" height="65" alt="">
                                        </div>
                                        <div class="details">
                                            <h4><a href="index.php?p=penghargaan&a&Go=<?php echo $data[$judul];?>"><?php echo $data["$judul"]; ?></a></h4>
                                            <span class="date"><i class="ti-timer"></i><?php echo format_indo($data["tanggal"]); ?></span>
                                        </div>
                                    </div>
                                 
				<?php } ?>
				
				</div>
                            </div>
						
						
					
       </div>
       </div>
       </div>
    <!-- TERBARU -->
</div>
			
			<div class="col-md-12">
    <div class="col-md-1 sidebar"></div>
    <div class="col-md-8 sidebar">
       <center> <?php Pagination_font_end($page,$dataPerPage,$querypagination); ?> </center>
        <br>
        <br><br><br>
    </div>
</div>
		</section>
		


<?php 
} 

else {


$sql=mysql_query("SELECT * FROM $tabel where $judul = '".mysql_real_escape_string($_GET['Go'])."'");
$data=mysql_fetch_array($sql);
?>

<section class="blog-single-section blog-single-left-sidebar-section section-padding">

			<div class="container">
				<div class="row">
<div class="col-sm-8 col-md-8">
    <!-- DETAIL BERITA -->
  

															
					
        <script>
            function goBack() {
                window
                    .history
                    .go(-1);
            }
        </script>
        <br>
        <br>
        <br>

        <div class="blog-content">
                            <div class="post format-standard-image">
                                <div class="entry-media">
                                    <img src="membercard/admin/upload/<?php echo $data['foto']; ?>" width='100%' height="500" alt="">
                                </div>
                                <ul class="entry-meta">
                                    <li><a href="#"><i class="ti-time"></i> <?php echo format_indo($data["tanggal"]); ?></a></li>
                                    <li><a href="#"><i class="ti-user"></i> Admin</a></li>
                                </ul>
                                <h2><?php echo ($data["judul"]); ?></h2>
                                <p><?php echo ($data["keterangan"]); ?></p>
                               
                            </div>

                          </div>

</div><!-- /.blog-list -->        


		<!-- DETAIL BERITA -->

    <!-- TERBARU -->
  	<div class="col-md-4">
		<div class="blog-sidebar">
						<div class="widget search-widget">
							<h3 class="title">Search Post</h3>
						

						<form name="formcari" id="formcari" action="" method="get">
						
						 <input name="p" value="prestasi" id="page" type="hidden">
                        <input
                            value="<?php echo $judul;?>"
                            type="hidden"
                            name="Berdasarkan"
                            id="Berdasarkan">



						 <input type="text" class="form-control" placeholder="Search Post.." name="keterangan" value="">
                                <?php
										if (isset($_GET['Berdasarkan']))
										{
											btn_cari('');
											?>
                              <!--  <a class="btn btn-primary" href="index.php?p=prestasi">
                                   Reset 
                                </a> -->
                            <?php
										}
										else
										{
											?>

                                <?php
											btn_cari('');
											
										}
								?>
							
							</form>
						</div>
						
						<div class="widget recent-post-widget">
                                <h3>Recent News</h3>
                                <div class="posts">
								 <?php
				$querytabel="SELECT * FROM $tabel ORDER BY $tanggal DESC LIMIT 0 ,25";
				$proses = mysql_query($querytabel);
				while ($data = mysql_fetch_array($proses))
				{ ?>
                                    <div class="post">
                                        <div class="img-holder">
                                            <img src="membercard/admin/upload/<?php echo $data["$foto"]; ?>" width="100%" height="65" alt="">
                                        </div>
                                        <div class="details">
                                            <h4><a href="index.php?p=penghargaan&a&Go=<?php echo $data[$judul];?>"><?php echo $data["$judul"]; ?></a></h4>
                                            <span class="date"><i class="ti-timer"></i><?php echo format_indo($data["tanggal"]); ?></span>
                                        </div>
                                    </div>
                                 
				<?php } ?>
				
				</div>
                            </div>
						
						
					
       </div>
       </div>
      
  
  </div>
</div>
</section>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<?php
}
}
?>