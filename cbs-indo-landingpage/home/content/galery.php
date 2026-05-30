<?php function galery($tabel,$id, $tanggal,$judul,$foto,$keterangan)
{

	if (!(isset($_GET['Go'])))
	{
?>
  <section class="featured-project-section-s2 featured-project-pg-section section-padding">
          
            <div class="content-area">
                <div class="project-grids featured-project-slider clearfix">
                  
                    
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


			 <div class="grid">
                        <div class="img-holder">
                            <img src="membercard/admin/upload/<?php echo $data['foto']; ?>" height="250px" alt>
                        </div>
                        <div class="overlay">
                          
                            <h3><?php echo $data['judul']; ?></h3>
                            <p><?php echo $data['keterangan']; ?></p>
                          
                        </div>
                    </div>
                    
					
					
	<?php } ?>
  
		  </div>
        </section>
    
		  



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
            <a href="index.php?p=Galery" class="btn btn-primary">Kembali</a>
            <br>
            <br>
            <?php 
				$sql=mysql_query("SELECT * FROM $tabel where $judul = '".mysql_real_escape_string($_GET['Go'])."'");
				$data=mysql_fetch_array($sql);
				?>
						<img 
						width="800" 
						src="membercard/admin/upload/<?= $data[$foto];?>"
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