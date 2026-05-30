<?php

$bulan = $request_bulan->getValue();
$tahun = $request_tahun->getValue();


if (isset($_GET['s_bulan'])) {

    if (($_GET['s_nominal']) == "semua_nominal") {
        $total_invoice = baca_database("", "total", "select count(id_penjualan) as total from data_penjualan_voucher where year(tanggal_penjualan)=$tahun and month(tanggal_penjualan)=$bulan order by tanggal_penjualan desc");
        $total_voucher = baca_database("", "total", "select sum(jumlah_voucher) as total from data_penjualan_voucher where year(tanggal_penjualan)=$tahun and month(tanggal_penjualan)=$bulan order by tanggal_penjualan desc");
        $total_relasi = baca_database("", "total", "SELECT COUNT(DISTINCT id_relasi) as total,id_relasi from data_penjualan_voucher where year(tanggal_penjualan)=$tahun and month(tanggal_penjualan)=$bulan group by id_relasi");
        $total_50rb = baca_database("", "total", "select count(id_penjualan) as total from data_penjualan_voucher where year(tanggal_penjualan)=$tahun and month(tanggal_penjualan)=$bulan and nominal='50000'");
        $total_100rb = baca_database("", "total", "select count(id_penjualan) as total from data_penjualan_voucher where year(tanggal_penjualan)=$tahun and month(tanggal_penjualan)=$bulan and nominal='100000'");
        $total_penjualan = baca_database("", "total", "select sum(total_bayar) as total from data_penjualan_voucher where year(tanggal_penjualan)=$tahun and month(tanggal_penjualan)=$bulan ");
    } else {
        $nominal = $_GET['s_nominal'];
        $total_invoice = baca_database("", "total", "select count(id_penjualan) as total from data_penjualan_voucher where year(tanggal_penjualan)=$tahun and month(tanggal_penjualan)=$bulan and nominal='$nominal' order by tanggal_penjualan desc");
        $total_voucher = baca_database("", "total", "select sum(jumlah_voucher) as total from data_penjualan_voucher where year(tanggal_penjualan)=$tahun and month(tanggal_penjualan)=$bulan  and nominal='$nominal'order by tanggal_penjualan desc");
        $total_relasi = baca_database("", "total", "SELECT COUNT(*) AS total 
FROM (
    SELECT DISTINCT id_relasi 
    FROM data_penjualan_voucher 
    WHERE YEAR(tanggal_penjualan) = $tahun 
    AND MONTH(tanggal_penjualan) = $bulan and nominal='$nominal'
) AS unique_relasi");




        if ($nominal == "50000") {
            $total_50rb = baca_database("", "total", "select count(id_penjualan) as total from data_penjualan_voucher where year(tanggal_penjualan)=$tahun and month(tanggal_penjualan)=$bulan and nominal='50000'");
            $total_100rb = 0;
        } else {
            $total_50rb = 0;
            $total_100rb = baca_database("", "total", "select count(id_penjualan) as total from data_penjualan_voucher where year(tanggal_penjualan)=$tahun and month(tanggal_penjualan)=$bulan and nominal='100000'");
        }

        $total_penjualan = baca_database("", "total", "select sum(total_bayar) as total from data_penjualan_voucher where year(tanggal_penjualan)=$tahun and month(tanggal_penjualan)=$bulan  and nominal='$nominal' ");
    }
} else {
    $total_invoice = baca_database("", "total", "select count(id_penjualan) as total from data_penjualan_voucher   order by tanggal_penjualan desc");
    $total_voucher = baca_database("", "total", "select sum(jumlah_voucher) as total from data_penjualan_voucher   order by tanggal_penjualan desc");
    $total_relasi = baca_database("", "total", "SELECT COUNT(DISTINCT id_relasi) AS total FROM data_penjualan_voucher;");
    $total_50rb = baca_database("", "total", "select count(id_penjualan) as total from data_penjualan_voucher where nominal='50000'");
    $total_100rb = baca_database("", "total", "select count(id_penjualan) as total from data_penjualan_voucher where nominal='100000'");
    $total_penjualan = baca_database("", "total", "select sum(total_bayar) as total from data_penjualan_voucher ");
}
?>



<div class="card card-custom gutter-b">
    <div class="card-body">
        <div class="d-flex">
            <!--begin: Pic-->
            <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                <div class="symbol symbol-50 symbol-lg-120">
                    <span class="symbol-label bg-light-warning">

                        <span class="symbol-label bg-light-info">

                            <span class="svg-icon svg-icon-2x svg-icon-info">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <title>Stockholm-icons / Files / Selected-file</title>
                                    <desc>Created with Sketch.</desc>
                                    <defs></defs>
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                        <path d="M4.85714286,1 L11.7364114,1 C12.0910962,1 12.4343066,1.12568431 12.7051108,1.35473959 L17.4686994,5.3839416 C17.8056532,5.66894833 18,6.08787823 18,6.52920201 L18,19.0833333 C18,20.8738751 17.9795521,21 16.1428571,21 L4.85714286,21 C3.02044787,21 3,20.8738751 3,19.0833333 L3,2.91666667 C3,1.12612489 3.02044787,1 4.85714286,1 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                        <path d="M6.85714286,3 L14.7364114,3 C15.0910962,3 15.4343066,3.12568431 15.7051108,3.35473959 L20.4686994,7.3839416 C20.8056532,7.66894833 21,8.08787823 21,8.52920201 L21,21.0833333 C21,22.8738751 20.9795521,23 19.1428571,23 L6.85714286,23 C5.02044787,23 5,22.8738751 5,21.0833333 L5,4.91666667 C5,3.12612489 5.02044787,3 6.85714286,3 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z" fill="#000000" fill-rule="nonzero"></path>
                                    </g>
                                </svg>
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
                            Penjualan E-Voucher
                        </a>
                        <!--end::Name-->

                        <!--begin::Contacts-->
                        <div class="d-flex flex-wrap my-2" style="padding-left: 10px;">

                            <a href="#" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1"><!--begin::Svg Icon | path:/metronic/theme/html/demo3/dist/assets/media/svg/icons/General/Lock.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <mask fill="white">
                                                <use xlink:href="#path-1"></use>
                                            </mask>
                                            <g></g>
                                            <path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" fill="#000000"></path>
                                        </g>
                                    </svg><!--end::Svg Icon--></span>

                                <?php if (isset($_GET['s_bulan'])) { ?>
                                    Waktu Penjualan : <?php echo bulan_indo($bulan) . " " . $tahun; ?>

                                <?php } else { ?>
                                    Waktu Penjualan : Semua
                                <?php } ?>
                            </a>

                            <a href="#" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2" style="padding-left: 10px;">
                                <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1"><!--begin::Svg Icon | path:/metronic/theme/html/demo3/dist/assets/media/svg/icons/General/Lock.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <mask fill="white">
                                                <use xlink:href="#path-1"></use>
                                            </mask>
                                            <g></g>
                                            <path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" fill="#000000"></path>
                                        </g>
                                    </svg><!--end::Svg Icon--></span>Nominal : <?= $request_nominal->isValid() ? $request_nominal->getValue()  : "Semua"; ?>
                            </a>
                        </div>
                        <!--end::Contacts-->



                    </div>
                    <div class="my-lg-0 my-1">
                        <a href="../report/index.php?input=cetak_penjualan" class="btn btn-sm btn-light-success font-weight-bolder text-uppercase mr-3">Print Reports</a>

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
                    <span class="font-weight-bolder font-size-sm">Invoice</span>
                    <span class="font-weight-bolder font-size-h5"><span class="text-dark-50 font-weight-bold"></span><?php echo $total_invoice; ?></span>
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
                    <span class="font-weight-bolder font-size-sm">Voucher</span>
                    <span class="font-weight-bolder font-size-h5"><span class="text-dark-50 font-weight-bold"></span><?php echo $total_voucher; ?></span>
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
                    <span class="text-dark-75 font-weight-bolder font-size-sm">Total Penjualan</span>
                    <span class="font-weight-bolder font-size-h5"><span class="text-dark-50 font-weight-bold"></span><?php echo rupiah($total_penjualan); ?></span>
                </div>
            </div>
            <!--end: Item-->


        </div>
        <!--begin: Items-->
    </div>
</div>

<br><br>




<div class="col-xxl-12">

    <div class="card card-xxl-stretch mb-5 mb-xl-12">



        <div class="card-body py-3">

            <div class="table-responsive">

                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">

                    <thead>
                        <tr class="fw-bolder text-muted">

                            <th class="min-w-150px">Nama Relasi</th>
                            <th class="min-w-140px">Voucher</th>
                            <th class="min-w-120px">Detail</th>
                            <th class="min-w-100px text-end">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        $no = 0;
                        $startRow = ($page - 1) * $dataPerPage;
                        $no = $startRow;


                        if (isset($_GET['s_bulan'])) {
                            if ($request_nominal->isValid()) {
                                $querytabel = "SELECT * FROM data_penjualan_voucher WHERE year(tanggal_penjualan)=$tahun AND month(tanggal_penjualan)=$bulan AND nominal='" . $request_nominal->getValue() . "' ORDER BY tanggal_penjualan DESC LIMIT $startRow, $dataPerPage";
                                $querypagination = "SELECT count(id_penjualan) as total FROM data_penjualan_voucher WHERE year(tanggal_penjualan)=$tahun AND month(tanggal_penjualan)=$bulan AND nominal='" . $request_nominal->getValue() . "'";
                            } else {
                                $querytabel = "SELECT * FROM data_penjualan_voucher WHERE year(tanggal_penjualan)=$tahun AND month(tanggal_penjualan)=$bulan ORDER BY tanggal_penjualan DESC LIMIT $startRow, $dataPerPage";
                                $querypagination = "SELECT count(id_penjualan) as total FROM data_penjualan_voucher WHERE year(tanggal_penjualan)=$tahun AND month(tanggal_penjualan)=$bulan";
                            }
                        } else {

                            $querytabel = "SELECT * FROM data_penjualan_voucher ORDER BY tanggal_penjualan DESC LIMIT $startRow, $dataPerPage";
                            $querypagination = "SELECT count(id_penjualan) as total FROM data_penjualan_voucher";
                        }

                        $proses = mysql_query($querytabel);
                        while ($data = mysql_fetch_array($proses)) {
                            $id_penjualan =  $data['id_penjualan'];
                            $id_relasi = $data['id_relasi'];

                        ?>

                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-45px me-5">
                                            <!--begin::Svg Icon | path: assets/media/icons/duotune/communication/com006.svg-->
                                            <span class="svg-icon svg-icon-primary svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="black" />
                                                    <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="black" />
                                                </svg></span>
                                            <!--end::Svg Icon-->
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a class="text-dark fw-bolder text-hover-primary fs-6"><?php echo baca_database("", "nama", "select * from data_relasi where id_relasi='$data[id_relasi]'")  ?></a>
                                            <span class="text-muted fw-bold text-muted d-block fs-7">Date : <?php echo format_indo_no_jam($data['tanggal_penjualan']); ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a class="text-dark fw-bolder text-hover-primary d-block fs-6">E-Voucher</a>
                                    <span class="text-muted fw-bold text-muted d-block fs-7">Jumlah : <?php echo $data['jumlah_voucher']; ?> Voucher</span>
                                </td>
                                <td>
                                    <a class="text-dark fw-bolder text-hover-primary d-block fs-6"> <?php echo rupiah($data['total_bayar']); ?></a>
                                    <span class="text-muted fw-bold text-muted d-block fs-7">Nominal : <?php echo rupiah($data['nominal']); ?></span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-end flex-shrink-0">


                                        <a href="index.php?input=list_detail_info&proses=<?php echo encrypt($id_penjualan); ?>" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">

                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black"></path>
                                                    <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black"></path>
                                                </svg>
                                            </span>

                                        </a>


                                        <a href="index.php?input=list_detail_voucher&proses=<?php echo encrypt($id_penjualan); ?>&preview=" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">

                                            <span class="svg-icon svg-icon-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black"></rect>
                                                    <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black"></path>
                                                </svg>
                                            </span>

                                        </a>
                                    </div>
                                </td>
                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

                <center>
                    <?php
                    $url_pagination = "?input=penjualan&s_tahun=" . $request_tahun->getvalue() . "&s_bulan=" . $request_bulan->getvalue() . "&s_nominal=" . $request_nominal->getvalue() . "&";
                    Pagination_custom_url($url_pagination, $page, $dataPerPage, $querypagination);
                    ?>
                </center>
            </div>

        </div>

    </div>