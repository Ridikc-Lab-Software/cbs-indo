<div style="display: flex; flex-wrap: wrap;"> <!-- Updated: Add flex-wrap: wrap; -->
<?php
    $no = 0;
    $startRow=($page-1)*$dataPerPage;
    $no = $startRow;

    if (isset($_GET['Berdasarkan']) && !empty($_GET['Berdasarkan']) && isset($_GET['isi']) && !empty($_GET['isi']))
    {
        $berdasarkan =  mysql_real_escape_string($_GET['Berdasarkan']);
        $isi =  mysql_real_escape_string($_GET['isi']);
        $querytabel="SELECT * FROM data_karir where $berdasarkan like '%$isi%'  LIMIT $startRow ,$dataPerPage";
        $querypagination="SELECT COUNT(*) AS total FROM data_karir where $berdasarkan like '%$isi%'";
    }
    else
    {
        $querytabel="SELECT * FROM data_karir  LIMIT $startRow ,$dataPerPage";
        $querypagination="SELECT COUNT(*) AS total FROM data_karir";
    }
    $proses = mysql_query($querytabel);
    while ($data = mysql_fetch_array($proses))
    {
?>
    <div class="product-card">
        <div class="badge">Lowongan</div>
        <div class="product-tumb">
            <img src="membercard/admin/upload/<?php echo $data['foto'] ?>" alt="">
        </div>
        <div class="product-details">
            <span class="product-catagory">PT. Cahya Bungo Sarkopalma</span>
            <h4><a href=""><?php echo $data['nama_karir'] ?></a></h4>
            <p>Batas Waktu Lamaran: <?php echo format_indo($data['batas_lamar']) ?></p>
            <div class="product-bottom-details">
                <div class="product-price"><small>
                    <?php
                    $status = $data['status'];
                    if ($status == "Lowongan Sudah Ditutup") {
                        ?>
                        <?php echo $data['status']; } else { ?> </small><?php echo $data['status']; ?> <?php } ?>
                </div>
                <div class="product-links">
                    <a href="javascript:void(0);" class="show-detail" data-toggle="modal" data-target="#exampleModal<?php echo $data['id_karir']; ?>">
                        <i class="fa fa-heart">Detail Lowongan</i>
                    </a>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal<?php echo $data['id_karir']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Lowongan Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="margin-left:40px">
                        <!-- Add your lowongan details here, for example: -->
                        Kualifikasi: <p><?php echo $data['kualifikasi_karir'] ?></p>
                        Deskripsi: <p><?php echo $data['deskripsi_karir'] ?></p>
                        <p><?php echo $data['cara_lamar'] ?></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
		<!-- Bootstrap Modal -->
   
</div>
	<style>
 @import url('https://fonts.googleapis.com/css?family=Roboto:400,500,700');
    * {
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

body
{
    font-family: 'Roboto', sans-serif;
}
a
{
    text-decoration: none;
}
.product-card {
    width: 300px;
    position: relative;
    box-shadow: 0 2px 7px #dfdfdf;
    margin: 50px auto;
    background: #fafafa;
    
}

.badge {
    position: absolute;
    left: 0;
    top: 20px;
    text-transform: uppercase;
    font-size: 13px;
    font-weight: 700;
    background: red;
    color: #fff;
    padding: 3px 10px;
}

.product-tumb {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 300px;
    padding: 50px;
    background: #f0f0f0;
}

.product-tumb img {
    max-width: 100%;
    max-height: 100%;
}

.product-details {
    padding: 30px;
}

.product-catagory {
    display: block;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    color: #ccc;
    margin-bottom: 18px;
}

.product-details h4 a {
    font-weight: 500;
    display: block;
    margin-bottom: 18px;
    text-transform: uppercase;
    color: #363636;
    text-decoration: none;
    transition: 0.3s;
}

.product-details h4 a:hover {
    color: #fbb72c;
}

.product-details p {
    font-size: 15px;
    line-height: 22px;
    margin-bottom: 18px;
    color: #999;
}

.product-bottom-details {
    overflow: hidden;
    border-top: 1px solid #eee;
    padding-top: 20px;
}

.product-bottom-details div {
    float: left;
    width: 50%;
}

.product-price {
    font-size: 18px;
    color: #fbb72c;
    font-weight: 600;
}

.product-price small {
    font-size: 80%;
    font-weight: 400;
    text-decoration: line-through;
    display: inline-block;
    margin-right: 5px;
}

.product-links {
    text-align: right;
}

.product-links a {
    display: inline-block;
    margin-left: 5px;
    color: #e1e1e1;
    transition: 0.3s;
    font-size: 17px;
}

.product-links a:hover {
    color: #fbb72c;
}
	</style>