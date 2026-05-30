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
            <div class="col-sm-12 mb-6">
                <?php

                class QueryBuilder
                {
                    private $startRow;
                    private $dataPerPage;
                    private $rawQuery;
                    private $id_relasi;
                    private $status_voucher;
                    private $tanggal_awal;
                    private $tanggal_akhir;

                    public function __construct($startRow, $dataPerPage)
                    {
                        $this->startRow = $startRow;
                        $this->dataPerPage = $dataPerPage;

                        // Cek apakah ada parameter 'id' di URL (GET)
                        if (isset($_GET['id']) && !empty($_GET['id'])) {
                            $id_voucher = $_GET['id'];
                          $id_voucher = preg_replace('/^ID/i', '', $id_voucher);
                            $id_voucher = mysql_real_escape_string($id_voucher);
                            $this->rawQuery = "SELECT * FROM data_voucher, data_relasi WHERE (data_voucher.id_voucher like '%$id_voucher%' or data_relasi.nama like '%$id_voucher%') AND data_voucher.id_relasi = data_relasi.id_relasi";
                        } else {
                            $this->rawQuery = "SELECT * FROM data_voucher, data_relasi WHERE data_voucher.id_relasi = data_relasi.id_relasi";
                        }
                    }


                    public function setIdRelasi($id_relasi)
                    {
                        $this->id_relasi = $id_relasi;

                        return $this;
                    }

                    public function setStatusVoucher($status_voucher)
                    {
                        $this->status_voucher = $status_voucher;

                        return $this;
                    }

                    public function setTanggalKadaluarsa($tanggal_kadaluarsa)
                    {
                        $this->tanggal_kadaluarsa = $tanggal_kadaluarsa;

                        return $this;
                    }


                    public function whereTanggalAwal($tanggal_awal)
                    {
                        $this->tanggal_awal = $tanggal_awal;
                        return $this;
                    }

                    public function whereTanggalAkhir($tanggal_akhir)
                    {
                        $this->tanggal_akhir = $tanggal_akhir;
                        return $this;
                    }

                    public function getRawQuery()
                    {
                        $whereQuery = "";

                        if (!empty($this->id_relasi)) {
                            //$whereQuery .= empty($whereQuery) ? "" : " AND ";
                            // $whereQuery .= " AND data_voucher.id_relasi = '$this->id_relasi'";
                        }

                        if (!empty($this->status_voucher)) {
                            //$whereQuery .= empty($whereQuery) ? "" : " AND ";
                            $whereQuery .= " AND data_voucher.status = '$this->status_voucher'";
                        }

                        if (!empty($this->tanggal_awal) && !empty($this->tanggal_akhir)) {
                            //$whereQuery .= empty($whereQuery) ? "" : " AND ";
                            $whereQuery .= " AND data_voucher.tanggal_kadaluarsa BETWEEN '$this->tanggal_awal' AND '$this->tanggal_akhir'";
                        }


                        //if (!empty($whereQuery)) {
                        //$this->rawQuery .= " WHERE " . $whereQuery;
                        //}

                        // $this->rawQuery .= $whereQuery . " LIMIT $this->startRow, $this->dataPerPage";

                        return $this->rawQuery;
                    }

                    public function getRawQueryPagination()
                    {
                        $queryPagination = 'SELECT count(*) as total FROM data_voucher,data_relasi WHERE data_voucher.id_relasi = data_relasi.id_relasi ';

                        if (!empty($this->id_relasi)) {
                            $queryPagination .= " AND data_voucher.id_relasi = '$this->id_relasi'";
                        }

                        if (!empty($this->status_voucher)) {
                            $queryPagination .= " AND data_voucher.status = '$this->status_voucher'";
                        }

                        if (!empty($this->tanggal_awal) && !empty($this->tanggal_akhir)) {
                            $queryPagination .= " AND data_voucher.tanggal_kadaluarsa BETWEEN '$this->tanggal_awal' AND '$this->tanggal_akhir'";
                        }

                        return $queryPagination;
                    }
                }


                $no = 0;
                $startRow = ($page - 1) * $dataPerPage;
                $no = $startRow;

                $id_relasi = decrypt($_GET['id']);

                $bQuery = new QueryBuilder($startRow, $dataPerPage);

                $bQuery->setIdRelasi($id_relasi);

                if ($request_status->isValid()) {
                    $bQuery->setStatusVoucher($request_status->getValue());
                }

                if ($request_start_date->isValid()) {
                    $bQuery->whereTanggalAwal($request_start_date->getValue());
                }

                if ($request_end_date->isValid()) {
                    $bQuery->whereTanggalAkhir($request_end_date->getValue());
                }

                 $querytabel = $bQuery->getRawQuery();

                $querypagination = $bQuery->getRawQueryPagination();

                $proses = mysql_query($querytabel);
                $jml = 0;
                $aktif = 0;
                $digunakan = 0;
                $kadaluarsa = 0;
                if (isset($_GET['filter'])) {
                    $filter_tampil = $_GET['filter'];
                } else {
                    $filter_tampil = "semua";
                }

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
                    $jml = $jml + 1;

                    $tampil = 0;

                    if ($status == "Unused") {

                        if ($tanggal_kadaluarsa <= date('Y-m-d')) {
                            if ($filter_tampil == "kadaluarsa") {
                                $tampil = 1;
                            } else if ($filter_tampil == "semua") {
                                $tampil = 1;
                            } else {
                                $tampil = 0;
                            }
                        } else {
                            if ($filter_tampil == "aktif") {
                                $tampil = 1;
                            } else if ($filter_tampil == "semua") {
                                $tampil = 1;
                            } else {
                                $tampil = 0;
                            }
                        }
                    } else {
                        if ($filter_tampil == "digunakan") {
                            $tampil = 1;
                        } else if ($filter_tampil == "semua") {
                            $tampil = 1;
                        } else {
                            $tampil = 0;
                        }
                    }

                    if ($tampil == 1) {
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
                                                    $kadaluarsa = $kadaluarsa + 1;
                                                    echo ' <span class="badge badge-light-info fw-bolder my-2">Telah Kadaluarsa</span>';
                                                } else {
                                                    $aktif = $aktif + 1;
                                            ?>
                                                    <a href="voucher.php?kode=<?php echo $kode_voucher; ?>&kodeqr=<?php echo $kode_qrcode; ?>" target="_blank" class="btn btn-sm btn-light-primary">
                                                        Download
                                                    </a>
                                                <?php }
                                            } else {
                                                $digunakan = $digunakan + 1;
                                                ?>

                                                <span class="badge badge-light fw-bolder my-2">Telah digunakan</span>
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
                <?php } ?>



                <?php if ($jml == 0) {
                ?>

                    <center>
                        <br>
                        <br>
                        <br>
                        <br>
                        <img src="https://cdn-icons-png.flaticon.com/512/7466/7466140.png" width="30%">
                        <br>
                        <br>
                        <h1> VOUCHER (<?php echo  $_GET['id']; ?>) TIDAK DITEMUKAN</h1>
                    </center>
                <?php

                } else {

                    if (isset($_GET['filter'])) {
                       
                    } else {
                       
                ?>
                    <br>
                    <br>
                    <h1>Informasi Voucher :</h1>
                    <hr>
                    <span class="badge badge-info fs-8 fw-bolder">
                        <h2 style="color:white">Total Voucher (<?php echo $jml; ?>)</h2>
                    </span>
                    &nbsp;
                    &nbsp;
                    <span class="badge badge-success fs-8 fw-bolder">
                        <h2 style="color:white">Aktif (<?php echo $aktif; ?>)</h2>
                    </span>
                    &nbsp;
                    &nbsp;
                    <span class="badge badge-primary fs-8 fw-bolder">
                        <h2 style="color:white">Digunakan (<?php echo $digunakan; ?>)</h2>
                    </span>
                    &nbsp;
                    &nbsp;
                    <span class="badge badge-danger fs-8 fw-bolder">
                        <h2 style="color:white">Kadaluarsa (<?php echo $kadaluarsa; ?>)</h2>
                    </span>
                    <hr>
                <?php } ?>
                <?php } ?>
            </div>
        </div>

    </div>
    <br>
    <Center>
        <?php Pagination_custom_url("?input=vouher_keseluruhan&id=" . $_GET['id'] . "&", $page, $dataPerPage, $querypagination); ?>
    </Center>