<div class="flex-lg-row-fluid">
    <style>
        .coupon .kanan {
            border-left: 1px dashed #ddd;
            width: 40% !important;
            position: relative;
        }

        .coupon .kanan .info::after,
        .coupon .kanan .info::before {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background: #f3f6fa;
            border-radius: 100%;
        }

        .coupon .kanan .info::before {
            top: -10px;
            left: -10px;
        }

        .coupon .kanan .info::after {
            bottom: -10px;
            left: -10px;
        }

        .coupon .time {
            font-size: 1.6rem;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>

    <div class="container">
        <div class="row">
            <?php
            
         

            $no = 0;
            $startRow = ($page - 1) * $dataPerPage;
            $no = $startRow;

            $querytabel = "SELECT * FROM data_voucher,data_relasi WHERE data_voucher.id_relasi = data_relasi.id_relasi and status = 'Used'  LIMIT $startRow ,$dataPerPage";
            $querypagination = "SELECT count(*) as total FROM data_voucher,data_relasi WHERE data_voucher.id_relasi = data_relasi.id_relasi and status = 'Used'";
            $proses = mysql_query($querytabel);
            while ($data = mysql_fetch_array($proses)) {
                $kode_voucher = $data['id_voucher'];
                $kode_qrcode = $data['qrcode'];
                $qrcode = $kode_qrcode;
                $id_penjualan = $nomor_invoice;
                $status = $data['status'];
                $file_voucher = $kode_qrcode;
                $i = $i + 1;
                $nama_relasi = $data['nama'];
                $nominal = $data['nominal'];
                $tanggal_kadaluarsa = $data['tanggal_kadaluarsa'];

            ?>
                <div class="col-sm-12">
                    <div class="coupon bg-white rounded mb-3 d-flex justify-content-between">
                        <div class="kiri p-3">
                            <div class="icon-container ">
                                <div class="icon-container_box">
                                    <!-- QR Code will be generated here -->
                                    <div id="qrcode-<?php echo $i; ?>" style="width:85px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tengah py-3 d-flex w-100 justify-content-start">
                            <div class="pt-1">
                                <span class="badge badge-light-success fs-8 fw-bolder">ID<?php echo $kode_voucher; ?></span>
                                <span class="badge badge-light-success fs-8 fw-bolder"><?php echo format_indo_no_jam($data['tanggal_dibuka']); ?></span>
                                <span class="badge badge-light-info fs-8 fw-bolder"><?php echo rupiah($nominal); ?></span>
                                <span class="badge badge-light-info fs-8 fw-bolder"></span>
                                <h3 class="lead pt-3">E-Voucher BBM </h3>
                                <p class="text-muted mb-0"><b><?php echo $nama_relasi; ?></b> | <?php echo $data['email']; ?></p>
                            </div>
                        </div>
                        <div class="kanan">
                            <div class="info m-3 d-flex align-items-center">
                                <div class="w-100">
                                    <div class="block mb-4 pt-1">
                                        <span class="badge badge-light-danger fs-8 fw-bolder"><?php echo format_indo_no_jam($tanggal_kadaluarsa); ?></span>
                                    </div>

                                    <?php
                                    if ($status == "Unused") {
                                        if ($tanggal_kadaluarsa <= date('Y-m-d')) {
                                            echo ' <span class="badge badge-light fw-bolder my-2">Telah Kadaluarsa</span>';
                                        } else { ?>
                                            <a href="voucher.php?kode=<?php echo $kode_voucher; ?>&kodeqr=<?php echo $kode_qrcode; ?>" target="_blank" class="btn btn-sm btn-light-primary">
                                                Download
                                            </a>
                                        <?php }
                                    } else {
                                        ?>

                                        <span style="cursor:pointer;" onclick="window.location.href='../data_transaksi_voucher/index.php?input=detail&id_voucher=<?php echo $kode_voucher;?>'" class="badge badge-light fw-bolder my-2">Telah digunakan</span>
                                        
                                        <span style="cursor:pointer;" onclick="window.location.href='../data_transaksi_voucher/index.php?input=detail&id_voucher=<?php echo $kode_voucher;?>'"  class="badge badge-light fw-bolder my-2"><?php echo potongTeks(baca_database("","nama","select * from data_transaksi_voucher,data_member where data_transaksi_voucher.id_member=data_member.id_member and id_voucher='$kode_voucher'"));?></span>
                                        
                                    <?php
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <script>
                    QRCode.toDataURL('<?php echo $kode_qrcode; ?>', {
                        margin: 1, // Margin sekitar QR code
                        scale: 3, // Skala QR code untuk menyesuaikan padding
                    }, function(error, url) {
                        if (error) {
                            console.error(error);
                        } else {
                            console.log(url); // Tampilkan URL base64 di konsol

                            // Membuat elemen gambar dan mengaturnya dengan URL base64
                            var img = document.createElement('img');
                            img.src = url;

                            // Menambahkan gambar ke elemen dengan id "qrcode-container"
                            document.getElementById('qrcode-<?php echo $i; ?>').appendChild(img);
                        }
                    });
                </script>
            <?php } ?>

        </div>
    </div>

</div>
<br>
<Center>




    <?php Pagination_custom_url("?input=voucher_digunakan&", $page, $dataPerPage, $querypagination); ?>
</Center>