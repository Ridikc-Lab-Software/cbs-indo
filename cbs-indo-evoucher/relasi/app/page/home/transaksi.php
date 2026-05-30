<?php
$tanggal_awal = $request_start_date->isValid() ? $request_start_date->getValue() : date('Y-m-01');
$tanggal_akhir = $request_end_date->isValid() ? $request_end_date->getValue() : date('Y-m-t');


if (isset($_GET['s_start_date'])) {


    if ($_GET['s_jenis_bbm'] == "") {
        $total_transaksi = baca_database("", "total", "select count(id_transaksi) as total from data_transaksi_voucher where tanggal_transaksi >= '$tanggal_awal' and tanggal_transaksi <= '$tanggal_akhir'");
        $total_member = baca_database("", "total", "SELECT COUNT(DISTINCT id_member) AS total FROM data_transaksi_voucher where tanggal_transaksi >= '$tanggal_awal' and tanggal_transaksi <= '$tanggal_akhir' ");
        $total_relasi = baca_database("", "total", "SELECT COUNT(DISTINCT id_relasi) AS total FROM data_transaksi_voucher JOIN data_voucher ON data_transaksi_voucher.id_voucher = data_voucher.id_voucher WHERE tanggal_transaksi >= '$tanggal_awal' and tanggal_transaksi <= '$tanggal_akhir'");
        $total_50rb = baca_database("", "total", "select count(id_transaksi) as total from data_transaksi_voucher where tanggal_transaksi >= '$tanggal_awal' and tanggal_transaksi <= '$tanggal_akhir' and nominal = '50000'");
        $total_100rb = baca_database("", "total", "select count(id_transaksi) as total from data_transaksi_voucher where tanggal_transaksi >= '$tanggal_awal' and tanggal_transaksi <= '$tanggal_akhir' and nominal = '100000'");
        $total_pembayaran = baca_database("", "total", "select sum(nominal) as total from data_transaksi_voucher where tanggal_transaksi >= '$tanggal_awal' and tanggal_transaksi <= '$tanggal_akhir' ");
    } else {
        $jenis_bbm = $_GET['s_jenis_bbm'];
        $total_transaksi = baca_database("", "total", "select count(id_transaksi) as total from data_transaksi_voucher where tanggal_transaksi >= '$tanggal_awal' and tanggal_transaksi <= '$tanggal_akhir' and jenis_bbm = '$jenis_bbm'");
        $total_member = baca_database("", "total", "SELECT COUNT(DISTINCT id_member) AS total FROM data_transaksi_voucher where tanggal_transaksi >= '$tanggal_awal' and tanggal_transaksi <= '$tanggal_akhir' ");
        $total_relasi = baca_database("", "total", "SELECT COUNT(DISTINCT id_relasi) AS total FROM data_transaksi_voucher JOIN data_voucher ON data_transaksi_voucher.id_voucher = data_voucher.id_voucher WHERE tanggal_transaksi >= '$tanggal_awal' and tanggal_transaksi <= '$tanggal_akhir'");
        $total_50rb = baca_database("", "total", "select count(id_transaksi) as total from data_transaksi_voucher where tanggal_transaksi >= '$tanggal_awal' and tanggal_transaksi <= '$tanggal_akhir' and nominal = '50000'");
        $total_100rb = baca_database("", "total", "select count(id_transaksi) as total from data_transaksi_voucher where tanggal_transaksi >= '$tanggal_awal' and tanggal_transaksi <= '$tanggal_akhir' and nominal = '100000'");
        $total_pembayaran = baca_database("", "total", "select sum(nominal) as total from data_transaksi_voucher where tanggal_transaksi >= '$tanggal_awal' and tanggal_transaksi <= '$tanggal_akhir' ");
    }
} else {

    $total_transaksi = baca_database("", "total", "select count(id_transaksi) as total from data_transaksi_voucher ");
    $total_member = baca_database("", "total", "SELECT COUNT(DISTINCT id_member) AS total FROM data_transaksi_voucher;");
    $total_relasi = baca_database("", "total", "SELECT COUNT(DISTINCT id_relasi) AS total FROM data_transaksi_voucher JOIN data_voucher ON data_transaksi_voucher.id_voucher = data_voucher.id_voucher ");
    $total_50rb = baca_database("", "total", "select count(id_transaksi) as total from data_transaksi_voucher where  nominal = '50000'");
    $total_100rb = baca_database("", "total", "select count(id_transaksi) as total from data_transaksi_voucher where  nominal = '100000'");
    $total_pembayaran = baca_database("", "total", "select sum(nominal) as total from data_transaksi_voucher ");
}

?>

<div class="card card-custom gutter-b">
    <div class="card-body">
        <div class="d-flex">
            <!--begin: Pic-->
            <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                <div class="symbol symbol-50 symbol-lg-120">
                    <span class="symbol-label bg-light-warning">

                        <span class="symbol-label bg-light-primary">

                            <span class="symbol-label bg-light-info">

                                <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Communication/Clipboard-list.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <title>Stockholm-icons / Communication / Clipboard-list</title>
                                        <desc>Created with Sketch.</desc>
                                        <defs></defs>
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"></path>
                                            <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"></path>
                                            <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2" rx="1"></rect>
                                            <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1"></rect>
                                            <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2" rx="1"></rect>
                                            <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2" rx="1"></rect>
                                            <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2" rx="1"></rect>
                                            <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2" rx="1"></rect>
                                        </g>
                                    </svg><!--end::Svg Icon--></span>

                            </span>

                        </span>

                    </span>
                </div>

            </div>
            <!--end: Pic-->

            <!--begin: Info-->
            <div class="flex-grow-1">
                <!--begin: Title-->
                <div class="d-flex align-items-left justify-content-between flex-wrap">
                    <div class="mr-3">
                        <!--begin::Name-->
                        <a href="#" class="d-flex align-items-left text-dark text-hover-primary font-size-h5 font-weight-bold mr-3" style="padding-left: 10px;">
                            Transaksi E-Voucher
                        </a>
                        <!--end::Name-->

                        <?php

                        function view_jenis_bbm($request_jenis_bbm)
                        {
                            $jenis_bbm = QB::table('data_jenis_transaksi')
                                ->where('id_jenis_transaksi', '=', $request_jenis_bbm)
                                ->first();
                            if ($jenis_bbm) {
                                return $jenis_bbm->jenis_transaksi;
                            }
                            return $request_jenis_bbm;
                        }

                        ?>

                        <!--begin::Contacts-->
                        <div class="d-flex flex-wrap my-2" style="padding-left: 10px;">

                            <a href="#" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">


                                <?php if (isset($_GET['s_start_date'])) { ?>
                                    Waktu Transaksi : <?php echo humanizeDateRange($tanggal_awal, $tanggal_akhir) ?>

                                <?php } else { ?>
                                    Waktu Transaksi : Semua
                                <?php } ?>


                            </a>

                            <a href="#" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2" style="padding-left: 10px;">
                                <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1"><!--begin::Svg Icon | path:/metronic/theme/html/demo3/dist/assets/media/svg/icons/General/Lock.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <mask fill="white">
                                                <use xlink:href="#path-1"></use>
                                            </mask>
                                            <g></g>
                                            <path d="M10,18c-3.86,0-7,-3-7,-7s3.14,-7,7,-7s7,3,7,7s-3.14,7,-7,7zM12,4c-2.21,0-4,1.79-4,4s1.79,4,4,4s4,-1.79,4,-4s-1.79,-4,-4,-4z" fill="#000000"></path>
                                        </g>
                                    </svg><!--end::Svg Icon--></span>Jenis BBM : <?= $request_jenis_bbm->isValid() ? view_jenis_bbm($request_jenis_bbm->getValue()) : "Semua"; ?>
                            </a>


                            <a href="#" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2" style="padding-left: 10px;">
                                <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1"><!--begin::Svg Icon | path:/metronic/theme/html/demo3/dist/assets/media/svg/icons/General/Lock.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <mask fill="white">
                                                <use xlink:href="#path-1"></use>
                                            </mask>
                                            <g></g>
                                            <path d="M6 2L18 2C19.1046 2 20 2.89543 20 4V6C20 7.10457 19.1046 8 18 8L6 8C4.89543 8 4 7.10457 4 6V4C4 2.89543 4.89543 2 6 2ZM10 16V10L14 10V16L17 19V20H7V19L10 16Z" fill="#000000"></path>
                                        </g>
                                    </svg><!--end::Svg Icon--></span>Member : <?= $request_kategori_member->isValid() ? ($request_kategori_member->getValue() == "non" ? "Non Member" : "Member")  : "Semua"; ?>
                            </a>
                        </div>
                        <!--end::Contacts-->
                    </div>
                    <div class="my-lg-0 my-1">
                        <a href="../report/index.php?input=cetak_transaksi" class="btn btn-sm btn-light-success font-weight-bolder text-uppercase mr-3">Print Reports</a>

                    </div>
                </div>
                <!--end: Title-->


            </div>
            <!--end: Info-->
        </div>

        <div class="separator separator-solid my-7"></div>

        <!--begin: Items-->
        <div class="d-flex align-items-left flex-wrap">
            <!--begin: Item-->
            <div class="d-flex align-items-left flex-lg-fill mr-5 my-1">
                <span class="m-3">

                    <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                            <path opacity="0.3" d="M8.9 21L7.19999 22.6999C6.79999 23.0999 6.2 23.0999 5.8 22.6999L4.1 21H8.9ZM4 16.0999L2.3 17.8C1.9 18.2 1.9 18.7999 2.3 19.1999L4 20.9V16.0999ZM19.3 9.1999L15.8 5.6999C15.4 5.2999 14.8 5.2999 14.4 5.6999L9 11.0999V21L19.3 10.6999C19.7 10.2999 19.7 9.5999 19.3 9.1999Z" fill="black" />
                            <path d="M21 15V20C21 20.6 20.6 21 20 21H11.8L18.8 14H20C20.6 14 21 14.4 21 15ZM10 21V4C10 3.4 9.6 3 9 3H4C3.4 3 3 3.4 3 4V21C3 21.6 3.4 22 4 22H9C9.6 22 10 21.6 10 21ZM7.5 18.5C7.5 19.1 7.1 19.5 6.5 19.5C5.9 19.5 5.5 19.1 5.5 18.5C5.5 17.9 5.9 17.5 6.5 17.5C7.1 17.5 7.5 17.9 7.5 18.5Z" fill="black" />
                        </svg></span>

                </span>
                <div class="d-flex flex-column text-dark-75">
                    <span class="font-weight-bolder font-size-sm">Transaksi</span>
                    <span class="font-weight-bolder font-size-h5"><span class="text-dark-50 font-weight-bold"></span><?php echo $total_transaksi; ?></span>
                </div>
            </div>
            <!--end: Item-->

            <!--begin: Item-->
            <div class="d-flex align-items-left flex-lg-fill mr-5 my-1">
                <span class="m-3">

                    <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M21 18.3V4H20H5C4.4 4 4 4.4 4 5V20C10.9 20 16.7 15.6 19 9.5V18.3C18.4 18.6 18 19.3 18 20C18 21.1 18.9 22 20 22C21.1 22 22 21.1 22 20C22 19.3 21.6 18.6 21 18.3Z" fill="black" />
                            <path d="M22 4C22 2.9 21.1 2 20 2C18.9 2 18 2.9 18 4C18 4.7 18.4 5.29995 18.9 5.69995C18.1 12.6 12.6 18.2 5.70001 18.9C5.30001 18.4 4.7 18 4 18C2.9 18 2 18.9 2 20C2 21.1 2.9 22 4 22C4.8 22 5.39999 21.6 5.79999 20.9C13.8 20.1 20.1 13.7 20.9 5.80005C21.6 5.40005 22 4.8 22 4Z" fill="black" />
                        </svg></span>

                </span>
                <div class="d-flex flex-column text-dark-75">
                    <span class="font-weight-bolder font-size-sm">Member</span>
                    <span class="font-weight-bolder font-size-h5"><span class="text-dark-50 font-weight-bold"></span><?php echo $total_member; ?></span>
                </div>
            </div>
            <!--end: Item-->

            <!--begin: Item-->
            <div class="d-flex align-items-left flex-lg-fill mr-5 my-1">
                <span class="m-3">

                    <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="black" />
                            <path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="black" />
                        </svg></span>

                </span>
                <div class="d-flex flex-column text-dark-75">
                    <span class="font-weight-bolder font-size-sm">Relasi</span>
                    <span class="font-weight-bolder font-size-h5"><span class="text-dark-50 font-weight-bold"></span><?php echo $total_relasi; ?></span>
                </div>
            </div>
            <!--end: Item-->

        

            <!--begin: Item-->
            <div class="d-flex align-items-left flex-lg-fill mr-5 my-1">
                <span class="m-3">

                    <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M2 11.7127L10 14.1127L22 11.7127L14 9.31274L2 11.7127Z" fill="black" />
                            <path opacity="0.3" d="M20.9 7.91274L2 11.7127V6.81275C2 6.11275 2.50001 5.61274 3.10001 5.51274L20.6 2.01274C21.3 1.91274 22 2.41273 22 3.11273V6.61273C22 7.21273 21.5 7.81274 20.9 7.91274ZM22 16.6127V11.7127L3.10001 15.5127C2.50001 15.6127 2 16.2127 2 16.8127V20.3127C2 21.0127 2.69999 21.6128 3.39999 21.4128L20.9 17.9128C21.5 17.8128 22 17.2127 22 16.6127Z" fill="black" />
                        </svg></span>

                </span>
                <div class="d-flex flex-column">
                    <span class="text-dark-75 font-weight-bolder font-size-sm">Total</span>
                    <span class="font-weight-bolder font-size-h5"><span class="text-dark-50 font-weight-bold"></span><?php echo rupiah($total_pembayaran); ?></span>
                </div>
            </div>
            <!--end: Item-->


        </div>
        <!--begin: Items-->


    </div>
</div>
<br>
<br>


<div class="col-xxl-12">

    <div class="card card-xxl-stretch mb-5 mb-xl-8">




        <div class="card-body py-3">

            <div class="table-responsive">

                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">

                    <thead>
                        <tr class="fw-bolder text-muted">

                            <th class="min-w-150px">Relasi</th>
                            <th class="min-w-140px">E-Voucher</th>
                            <th class="min-w-120px">Jenis BBM</th>
                            <!-- <th class="min-w-100px text-end">Actions</th> -->
                        </tr>
                    </thead>

                    <tbody>


                        <?php

                        $no = 0;
                        $startRow = ($page - 1) * $dataPerPage;
                        $no = $startRow;

                      $querytabel = "SELECT
                                data_transaksi_voucher.*,
                                COALESCE(data_member.nama, 'NON MEMBER') AS nama_member,data_member.*
                            FROM
                                data_transaksi_voucher
                            LEFT JOIN
                                data_member
                            ON
                                data_transaksi_voucher.id_member = data_member.id_member
                            WHERE
                                data_transaksi_voucher.tanggal_transaksi BETWEEN '$tanggal_awal 00:00' AND '$tanggal_akhir 23:59'
                            ";

                        $querypagination = "SELECT count(id_transaksi) as total FROM data_transaksi_voucher WHERE tanggal_transaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir' ";

                        if ($request_jenis_bbm->isValid()) {
                            $querytabel .= " AND data_transaksi_voucher.jenis_bbm = '" . $request_jenis_bbm->getValue() . "' ";
                            $querypagination .= " AND data_transaksi_voucher.jenis_bbm = '" . $request_jenis_bbm->getValue() . "' ";
                        }
                        if ($request_kategori_member->getValue() == "member") {
                            $querytabel .= " AND NOT ISNULL(data_member.nama) ";
                            $querypagination .= " AND NOT ISNULL(data_member.nama) ";
                        } elseif ($request_kategori_member->getValue() == "non") {
                            $querytabel .= " AND ISNULL(data_member.nama) ";
                            $querypagination .= " AND ISNULL(data_member.nama) ";
                        }

                        $querytabel .= " ORDER BY tanggal_transaksi DESC LIMIT $startRow, $dataPerPage";

                        $proses = mysql_query($querytabel);
                        while ($data = mysql_fetch_array($proses)) {
                          $id_transaksi_voucher = $data['id_transaksi'];
                            $id_relasi = baca_database("","id_relasi","select * from data_plat_kendaraan_transaksi_voucher where id_transaksi_voucher ='$id_transaksi_voucher'");
                            $nama_relasi = baca_database("","nama","select * from data_relasi where id_relasi ='$id_relasi'");
                            $id_supir = baca_database("","id_supir","select * from data_plat_kendaraan_transaksi_voucher where id_transaksi_voucher ='$id_transaksi_voucher'");
                            $nama_supir = baca_database("","nama_supir","select * from data_supir where id_supir ='$id_supir'");
                            $no_plat_kendaraan = baca_database("","no_plat_kendaraan","select * from data_plat_kendaraan_transaksi_voucher where id_transaksi_voucher ='$id_transaksi_voucher'");
                            $plat = baca_database("","plat","select * from data_plat where id_plat ='$no_plat_kendaraan'");
                            
                        ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-45px me-5">
                                            <!--begin::Svg Icon | path: assets/media/icons/duotune/communication/com013.svg-->
                                            <span class="svg-icon svg-icon-primary svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none">
                                                    <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="black" />
                                                    <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="black" />
                                                </svg></span>
                                            <!--end::Svg Icon-->
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a href="../data_transaksi_voucher/index.php?input=detail&proses=<?php echo encrypt($data['id_transaksi']); ?>" class="text-dark fw-bolder text-hover-primary fs-6"><?php echo strtoupper($nama_relasi); ?> </a>
                                            
                                            <span class="text-muted fw-bold text-muted d-block fs-7">Supir : <?php echo $nama_supir; ?>, Plat Kendaraan : <?php echo $plat; ?> </span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="#" class="text-dark fw-bolder text-hover-primary d-block fs-6">ID<?php echo $data['id_voucher']; ?></a>
                                    <span class="text-muted fw-bold text-muted d-block fs-7"><?php echo format_indo_jam($data['tanggal_transaksi']); ?></span>
                                </td>
                                <td class="text">


                                    <a href="#" class="text-dark fw-bolder text-hover-primary d-block fs-6">
                                        <?php
                                        $jenis_bbm = $data['jenis_bbm'];
                                        $jenis_transaksi = QB::table("data_jenis_transaksi")->where('id_jenis_transaksi', $jenis_bbm)->first();
                                        if ($jenis_transaksi) {
                                            echo $jenis_transaksi->jenis_transaksi;
                                        } else {
                                            echo $jenis_bbm;
                                        }

                                        ?>
                                    </a>
                                    <span class="text-muted fw-bold text-muted d-block fs-7"><?php echo rupiah($data['nominal']); ?></span>


                                </td>
                                <!-- <td>
                                    <div class="d-flex justify-content-end flex-shrink-0">


                                        <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">

                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black"></path>
                                                    <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black"></path>
                                                </svg>
                                            </span>

                                        </a>


                                        <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">

                                            <span class="svg-icon svg-icon-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black"></rect>
                                                    <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black"></path>
                                                </svg>
                                            </span>

                                        </a>
                                    </div>
                                </td> -->
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>

                <center>
                    <?php
                    $url_pagination = "?input=transaksi&s_tahun=" . $request_tahun->getvalue() .
                        "&s_bulan=" . $request_bulan->getvalue() .
                        "&s_jenis_bbm=" . $request_jenis_bbm->getvalue() .
                        "&s_kategori_member=" . $request_kategori_member->getvalue() .
                        "&";
                    Pagination_custom_url($url_pagination, $page, $dataPerPage, $querypagination);
                    ?>
                </center>

            </div>
        </div>
    </div>
</div>