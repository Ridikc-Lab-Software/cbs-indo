<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$bulan = date('m');

if (isset($_GET['overview'])) {
    $tahun_saat_ini = $_GET['overview'];
    $tahun = $tahun_saat_ini;
} else {
    $tahun_saat_ini = date('Y');
    $tahun = date('Y');
}



?>

<div class="row gy-5 g-xl-8">
    <div class="col-xxl-4">
        <div class="card card-xl-stretch mb-xl-8">

            <div class="card-header border-0 bg-primary py-5">
                <h3 class="card-title fw-bolder text-white"> Overview Tahun <?php echo $tahun_saat_ini; ?></h3>
                <div class="card-toolbar">

                    <button type="button" class="btn btn-sm btn-icon btn-color-white btn-active-white btn-active-color- border-0 me-n3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">

                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
                                    <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                    <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                    <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                        </span>

                    </button>

                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3" data-kt-menu="true">

                        <div class="menu-item px-3">
                            <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Filter Overview</div>
                        </div>



                        <?php if ($tahun_saat_ini !== date('Y')) { ?>
                            <div class="menu-item px-3">
                                <a href="../home/index.php?overview=<?php echo date('Y'); ?>" class="menu-link px-3">Penjualan <?php echo date('Y'); ?></a>
                            </div>
                        <?php } ?>


                        <?php
                        for ($year = $tahun_saat_ini; $year >= $tahun_saat_ini - 3; $year--) {
                        ?>
                            <div class="menu-item px-3">
                                <a href="../home/index.php?overview=<?php echo $year; ?>" class="menu-link px-3">Penjualan <?php echo $year; ?></a>
                            </div>
                        <?php
                        }
                        ?>


                    </div>


                </div>
            </div>


            <div class="card-body p-0">
                <div class="grafik_overview card-rounded-bottom bg-primary" style="height: 250px"></div>





                <div class="card-rounded bg-body mt-n10 position-relative card-px py-15">

                    <div class="row g-0 mb-7">

                        <div class="col mx-5">
                            <div class="fs-6 text-gray-400">Penjualan</div>
                            <div class="fs-2 fw-bolder text-gray-800"><?php echo baca_database("", "total", "select count(*) as total from data_penjualan_voucher where tanggal_penjualan like '%$tahun_saat_ini%' "); ?></div>
                        </div>


                        <div class="col mx-5">
                            <div class="fs-6 text-gray-400">Transaksi</div>
                            <div class="fs-2 fw-bolder text-gray-800"><?php echo baca_database("", "total", "select count(*) as total from data_transaksi_voucher where tanggal_transaksi like '%$tahun_saat_ini%'"); ?></div>
                        </div>
                    </div>

                    <div class="row g-0">
                        <div class="col mx-5">
                            <div class="fs-6 text-gray-400">Relasi</div>
                            <div class="fs-2 fw-bolder text-gray-800"><?php echo baca_database("", "total", "select count(*) as total from data_relasi where tanggal_daftar like '%$tahun_saat_ini%' "); ?></div>
                        </div>

                        <div class="col mx-5">
                            <div class="fs-6 text-gray-400">Voucher</div>
                            <div class="fs-2 fw-bolder text-gray-800"><?php echo baca_database("", "total", "SELECT COUNT(*) AS total FROM data_voucher where tanggal_dibuka like '%$tahun_saat_ini%'"); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-xxl-8">

        <div class="card card-xxl-stretch mb-5 mb-xl-8">

            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">Relasi E-Voucher</span>
                    <span class="text-muted mt-1 fw-bold fs-7">Relasi Dengan Transaksi Tertinggi <?php echo $tahun; ?></span>
                </h3>
                <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Klik untuk melihat selengkapnya">
                    <a href="../data_relasi/" class="btn btn-sm btn-light btn-active-primary">
                        Lihat Keseluruhan</a>
                </div>
            </div>


            <div class="card-body py-3">

                <div class="table-responsive">

                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">

                        <thead>
                            <tr class="fw-bolder text-muted">

                                <th class="min-w-150px">Relasi</th>
                                <th class="min-w-140px">E-Voucher</th>
                                <th class="min-w-120px">Transaksi</th>
                                <th class="min-w-100px text-end">Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            $querytabel = "	SELECT
                                r.id_relasi,
                                r.nama,
                                r.nomor_telepon,
                                r.email,
                                r.alamat,
                                r.nama_spbu,
                                COUNT(v.id_voucher) AS total_voucher_count,
                                COUNT(CASE WHEN v.status = 'Used' THEN v.id_voucher ELSE NULL END) AS used_voucher_count,
                                COUNT(CASE WHEN v.status = 'Unused' AND v.tanggal_kadaluarsa < NOW() THEN v.id_voucher ELSE NULL END) AS expired_but_unused_count,
                                COUNT(CASE WHEN v.status = 'Unused' AND v.tanggal_kadaluarsa >= NOW() THEN v.id_voucher ELSE NULL END) AS unused_and_not_expired_count
                            FROM
                                data_relasi r
                            LEFT JOIN
                                data_voucher v ON r.id_relasi = v.id_relasi
                            GROUP BY
                                r.id_relasi
                            ORDER BY
                                used_voucher_count DESC
                            LIMIT 5;
                            ";

                            $proses = mysql_query($querytabel);
                            while ($data = mysql_fetch_array($proses)) {
                                $id_relasi = $data['id_relasi'];

                                $digunakan = $data['used_voucher_count'];
                                $jml = $data['total_voucher_count'];

                                $persen = $digunakan / $jml * 100;
                                $persen = round($persen, 2);

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
                                                <a href="../data_voucher/?input=list_detail&id=<?php echo encrypt($id_relasi); ?>" class="text-dark fw-bolder text-hover-primary fs-6"><?php echo $data['nama']; ?></a>
                                                <span class="text-muted fw-bold text-muted d-block fs-7"><?php echo $data['email']; ?></span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a class="text-dark fw-bolder text-hover-primary d-block fs-6">E-Voucher</a>
                                        <span class="text-muted fw-bold text-muted d-block fs-7">Aktif : <?php echo $jml - $digunakan; ?></span>
                                    </td>
                                    <td class="text-end">
                                        <div class="d-flex flex-column w-100 me-2">
                                            <div class="d-flex flex-stack mb-2">
                                                <span class="text-muted me-2 fs-7 fw-bold">

                                                    <?php


                                                    if ($jml > 0) {
                                                        echo "$digunakan/$jml ($persen%)";
                                                    } else {
                                                        echo "Kosong";
                                                    }
                                                    ?>

                                                </span>
                                            </div>
                                            <div class="progress h-6px w-100">
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $persen; ?>%" aria-valuenow="<?php echo $persen; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-end flex-shrink-0">


                                            <a href="../data_relasi/index.php?input=edit&proses=<?php echo encrypt($id_relasi); ?>" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">

                                                <span class="svg-icon svg-icon-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black"></path>
                                                        <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black"></path>
                                                    </svg>
                                                </span>

                                            </a>


                                            <a href="../data_voucher/?input=list_detail&id=<?php echo encrypt($id_relasi); ?>" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">

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

                </div>

            </div>

        </div>

    </div>

</div>


<div class="row gy-5 g-xl-8">



    <div class="col-xxl-6">

        <div class="card card-xxl-stretch mb-xl-8">

            <div class="card-header align-items-center border-0 mt-3">
                <h3 class="card-title align-items-start flex-column">
                    <span class="fw-bolder text-dark fs-3">Penjualan</span>
                    <span class="text-gray-400 mt-2 fw-bold fs-6"><?php echo bulan_indo($bulan) . " " . $tahun; ?></span>
                </h3>
                <div class="card-toolbar">

                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-primary btn-active-light-primary me-n3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">

                        <span class="svg-icon svg-icon-3 svg-icon-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
                                    <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                    <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                    <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                        </span>

                    </button>

                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px" data-kt-menu="true">

                        <div class="menu-item px-3">
                            <div class="menu-content fs-6 text-dark fw-bolder px-3 py-4">Actions</div>
                        </div>


                        <div class="separator mb-3 opacity-75"></div>


                        <div class="menu-item px-3">
                            <a href="../data_voucher/?input=penjualan" class="menu-link px-3">Detail Penjualan</a>
                        </div>
                        <div class="menu-item px-3 my-1">
                            <a href="../" class="menu-link px-3">Reload</a>
                        </div>


                    </div>


                </div>
            </div>


            <div class="card-body pt-5">

                <?php
                $jml = 0;
                $querytabel = "SELECT dpv.*, dr.nama AS nama_relasi
                    FROM data_penjualan_voucher dpv
                    JOIN data_relasi dr ON dpv.id_relasi = dr.id_relasi
                    WHERE MONTH(dpv.tanggal_penjualan) = $bulan
                    AND YEAR(dpv.tanggal_penjualan) = $tahun order by id_penjualan desc limit 0,5";

                $proses = mysql_query($querytabel);
                while ($data = mysql_fetch_array($proses)) {
                    $jml = $jml + 1;

                ?>
                    <div class="d-flex align-items-sm-center mb-7">

                        <div class="symbol symbol-50px me-5">
                            <span class="symbol-label">
                                <!--begin::Svg Icon | path: assets/media/icons/duotune/ecommerce/ecm005.svg-->
                                <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M20 22H4C3.4 22 3 21.6 3 21V2H21V21C21 21.6 20.6 22 20 22Z" fill="black" />
                                        <path d="M12 14C9.2 14 7 11.8 7 9V5C7 4.4 7.4 4 8 4C8.6 4 9 4.4 9 5V9C9 10.7 10.3 12 12 12C13.7 12 15 10.7 15 9V5C15 4.4 15.4 4 16 4C16.6 4 17 4.4 17 5V9C17 11.8 14.8 14 12 14Z" fill="black" />
                                    </svg></span>
                                <!--end::Svg Icon-->
                            </span>
                        </div>


                        <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                            <div class="flex-grow-1 me-2">
                                <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bolder"><?php echo $data['nama_relasi']; ?></a> ( <?php echo $data['jumlah_voucher']; ?> Voucher )
                                <span class="text-muted fw-bold d-block fs-7">Tanggal : <?php echo $data['tanggal_penjualan']; ?></span>
                            </div>

                        </div>

                    </div>
                <?php } ?>
                <?php if ($jml < 1) { ?>
                    <center>
                        <br>
                        <br>
                        <img style="width:100%;align:center" src="<?php echo $url; ?>/assets/media/illustrations/sigma-1/18.png">
                        <br>
                        <br>
                        <h3>Tidak ada penjualan</h3>
                    </center>
                <?php } ?>
            </div>

        </div>

    </div>


    <div class="col-xxl-6">

        <div class="card card-xxl-stretch mb-5 mb-xl-8">

            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="fw-bolder text-dark fs-3">Transaksi</span>
                    <span class="text-gray-400 mt-2 fw-bold fs-6"><?php echo bulan_indo($bulan) . " " . $tahun; ?></span>
                </h3>
                <div class="card-toolbar">

                    <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">

                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
                                    <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                    <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                    <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                        </span>

                    </button>

                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3" data-kt-menu="true">

                        <div class="menu-item px-3">
                            <div class="menu-content fs-6 text-dark fw-bolder px-3 py-4">Actions</div>
                        </div>


                        <div class="separator mb-3 opacity-75"></div>


                        <div class="menu-item px-3">
                            <a href="../data_voucher/?input=transaksi" class="menu-link px-3">Detail Transaksi</a>
                        </div>
                        <div class="menu-item px-3 my-1">
                            <a href="../" class="menu-link px-3">Reload</a>
                        </div>


                    </div>


                </div>
            </div>


            <div class="card-body pt-5">

                <?php

                $jml = 0;
                $querytabel = "SELECT dpv.*, (SELECT nama FROM data_member dm WHERE dm.id_member = dpv.id_member LIMIT 1) as nama_member
                    FROM data_transaksi_voucher dpv
                    WHERE MONTH(dpv.tanggal_transaksi) = $bulan
                    AND YEAR(dpv.tanggal_transaksi) = $tahun order by id_transaksi desc limit 0,5";
                $proses = mysql_query($querytabel);
                while ($data = mysql_fetch_array($proses)) {
                    $jml = $jml + 1;
                ?>
                    <div class="d-flex align-items-sm-center mb-7">

                        <div class="symbol symbol-50px me-5">
                            <span class="symbol-label">
                                <!--begin::Svg Icon | path: assets/media/icons/duotune/ecommerce/ecm008.svg-->
                                <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z" fill="black" />
                                        <path d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z" fill="black" />
                                        <path d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z" fill="black" />
                                    </svg></span>
                                <!--end::Svg Icon-->
                            </span>
                        </div>


                        <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                            <div class="flex-grow-1 me-2">
                                <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bolder"> <?php
                                                                                                        echo $data['nama_member'] ? $data['nama_member'] : 'Non-Member';
                                                                                                        ?>

                                </a>(<?php echo rupiah($data['nominal']); ?>)
                                <span class="text-muted fw-bold d-block fs-7">
                                    Tanggal : <?php echo ($data['tanggal_transaksi']); ?>
                                </span>
                            </div>

                        </div>

                    </div>
                <?php } ?>


                <?php if ($jml < 1) { ?>
                    <center>
                        <br>
                        <br>
                        <img style="width:100%;align:center" src="<?php echo $url; ?>/assets/media/illustrations/sigma-1/18.png">
                        <br>
                        <br>
                        <h3>Tidak ada transaksi</h3>
                    </center>
                <?php } ?>


            </div>
        </div>

    </div>

</div>


<div class="row gy-5 g-xl-8">

    <div class="col-xxl-4">

        <div class="card card-xxl-stretch mb-xl-3">

            <div class="card-header border-0">
                <h3 class="card-title fw-bolder text-dark">Kategori Member</h3>
                <div class="card-toolbar">

                    <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">

                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
                                    <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                    <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                    <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                        </span>

                    </button>

                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3" data-kt-menu="true">

                        <div class="menu-item px-3">
                            <div class="menu-content fs-6 text-dark fw-bolder px-3 py-4">Actions</div>
                        </div>


                        <div class="separator mb-3 opacity-75"></div>


                        <div class="menu-item px-3">
                            <a href="../data_member/" class="menu-link px-3">Detail Member</a>
                        </div>
                        <div class="menu-item px-3 my-1">
                            <a href="../" class="menu-link px-3">Reload</a>
                        </div>

                    </div>


                </div>
            </div>


            <div class="card-body pt-2">

                <?php
                $jml = 0;
                $query = "SELECT
                        dkm.kategori_member,
                        COUNT(dtv.id_transaksi) AS jumlah_transaksi
                    FROM
                        data_kategori_member dkm
                    LEFT JOIN
                        data_member dm ON dkm.id_kategori_member = dm.id_kategori_member
                    LEFT JOIN
                        data_transaksi_voucher dtv ON dtv.id_member = dm.id_member
                        AND MONTH(dtv.tanggal_transaksi) = $bulan
                        AND YEAR(dtv.tanggal_transaksi) = $tahun
                    GROUP BY
                        dkm.kategori_member

                    UNION ALL

                    SELECT
                        'Non-Member' AS kategori_member,
                        (
                            SELECT COUNT(*)
                            FROM data_transaksi_voucher
                            WHERE (id_member IS NULL OR id_member = '' OR id_member = 'non member')
                            AND MONTH(tanggal_transaksi) = $bulan
                            AND YEAR(tanggal_transaksi) = $tahun
                        ) AS jumlah_transaksi
                    ORDER BY
                        jumlah_transaksi DESC;
                    ";

                $proses = mysql_query($query);
                while ($data = mysql_fetch_array($proses)) {
                    $jml = $jml + 1;
                ?>
                    <div class="d-flex align-items-center mb-8">
                        <span class="bullet bullet-vertical h-40px bg-success"></span>
                        <div class="form-check form-check-custom form-check-solid mx-5">
                            <input readonly class="form-check-input" />
                        </div>

                        <div class="flex-grow-1">
                            <a href="#" class="text-gray-800 text-hover-primary fw-bolder fs-6"><?php echo $data['kategori_member']; ?></a>
                            <span class="text-muted fw-bold d-block"><?php echo bulan_indo($bulan) . " " . $tahun; ?></span>
                        </div>

                        <span class="badge badge-light-success fs-8 fw-bolder"><?php echo $data['jumlah_transaksi']; ?></span>
                    </div>
                <?php } ?>

                <?php if ($jml < 1) { ?>
                    <center>
                        <br>
                        <br>
                        <img style="width:100%;align:center" src="<?php echo $url; ?>/assets/media/illustrations/sigma-1/18.png">
                        <br>
                        <br>
                        <h3>Tidak ada penjualan</h3>
                    </center>
                <?php } ?>

            </div>

        </div>

    </div>

    <div class="col-xxl-4">

        <div class="card card-xxl-stretch mb-xl-3">

            <div class="card-header border-0">
                <h3 class="card-title fw-bolder text-dark">Jenis Transaksi</h3>
                <div class="card-toolbar">

                    <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">

                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
                                    <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                    <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                    <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                        </span>

                    </button>

                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3" data-kt-menu="true">
                        <div class="menu-item px-3">
                            <div class="menu-content fs-6 text-dark fw-bolder px-3 py-4">Actions</div>
                        </div>


                        <div class="separator mb-3 opacity-75"></div>


                        <div class="menu-item px-3">
                            <a href="../data_jenis_transaksi/" class="menu-link px-3">Jenis Transaksi</a>
                        </div>
                        <div class="menu-item px-3 my-1">
                            <a href="../" class="menu-link px-3">Reload</a>
                        </div>

                    </div>


                </div>
            </div>


            <div class="card-body pt-2">

                <?php
                $jml = 0;
                $query = "SELECT
                    djt.jenis_transaksi,
                    (SELECT COUNT(id_transaksi)
                    FROM data_transaksi_voucher
                    WHERE (data_transaksi_voucher.jenis_bbm = djt.id_jenis_transaksi OR data_transaksi_voucher.jenis_bbm = djt.jenis_transaksi)
                    AND MONTH(data_transaksi_voucher.tanggal_transaksi) = $bulan
                    AND YEAR(data_transaksi_voucher.tanggal_transaksi) = $tahun) AS jumlah_transaksi
                FROM
                    data_jenis_transaksi djt
                ";
                $proses = mysql_query($query);
                while ($data = mysql_fetch_array($proses)) {
                    $jml = $jml + 1;
                ?>

                    <div class="d-flex align-items-center mb-8">

                        <span class="bullet bullet-vertical h-40px bg-success"></span>


                        <div class="form-check form-check-custom form-check-solid mx-5">
                            <input readonly class="form-check-input" />
                        </div>


                        <div class="flex-grow-1">
                            <a href="#" class="text-gray-800 text-hover-primary fw-bolder fs-6"><?php echo $data['jenis_transaksi']; ?></a>
                            <span class="text-muted fw-bold d-block"><?php echo bulan_indo($bulan) . " " . $tahun; ?></span>
                        </div>

                        <span class="badge badge-light-success fs-8 fw-bolder"><?php echo $data['jumlah_transaksi']; ?></span>
                    </div>
                <?php } ?>


                <?php if ($jml < 1) { ?>
                    <center>
                        <br>
                        <br>
                        <img style="width:100%;align:center" src="<?php echo $url; ?>/assets/media/illustrations/sigma-1/18.png">
                        <br>
                        <br>
                        <h3>Tidak ada penjualan</h3>
                    </center>
                <?php } ?>
            </div>

        </div>

    </div>


    <div class="col-xxl-4">

        <div class="card card-xxl-stretch mb-xl-3">

            <div class="card-header border-0">
                <h3 class="card-title fw-bolder text-dark">Nominal</h3>
                <div class="card-toolbar">

                    <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">

                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
                                    <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                    <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                    <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                        </span>

                    </button>

                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3" data-kt-menu="true">

                        <div class="menu-item px-3">
                            <div class="menu-content fs-6 text-dark fw-bolder px-3 py-4">Actions</div>
                        </div>


                        <div class="separator mb-3 opacity-75"></div>


                        <div class="menu-item px-3">
                            <a href="../data_transaksi_voucher/" class="menu-link px-3">Transaksi Voucher</a>
                        </div>
                        <div class="menu-item px-3 my-1">
                            <a href="../" class="menu-link px-3">Reload</a>
                        </div>
                    </div>


                </div>
            </div>


            <div class="card-body pt-2">


                <?php
                $jml = 0;
                $query = "SELECT
    dtv.nominal,
    COUNT(dtv.id_transaksi) AS jumlah_transaksi
    FROM
        data_transaksi_voucher dtv
    WHERE
        MONTH(dtv.tanggal_transaksi) = $bulan
        AND YEAR(dtv.tanggal_transaksi) = $tahun
    GROUP BY
        dtv.nominal

    ORDER BY
        jumlah_transaksi DESC;";
                $proses = mysql_query($query);
                while ($data = mysql_fetch_array($proses)) {
                    $jml = $jml + 1;
                ?>

                    <div class="d-flex align-items-center mb-8">

                        <span class="bullet bullet-vertical h-40px bg-success"></span>


                        <div class="form-check form-check-custom form-check-solid mx-5">
                            <input readonly class="form-check-input" />
                        </div>


                        <div class="flex-grow-1">
                            <a href="#" class="text-gray-800 text-hover-primary fw-bolder fs-6"><?php echo rupiah($data['nominal']); ?></a>
                            <span class="text-muted fw-bold d-block"><?php echo bulan_indo($bulan) . " " . $tahun; ?></span>
                        </div>

                        <span class="badge badge-light-success fs-8 fw-bolder"><?php echo ($data['jumlah_transaksi']); ?></span>
                    </div>

                <?php } ?>


                <?php if ($jml < 1) { ?>
                    <center>
                        <br>
                        <br>
                        <img style="width:100%;align:center" src="<?php echo $url; ?>/assets/media/illustrations/sigma-1/18.png">
                        <br>
                        <br>
                        <h3>Tidak ada penjualan</h3>
                    </center>
                <?php } ?>

            </div>

        </div>

    </div>

  
</div>


<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


<?php
// Fetch total sales per month for 2024
$sql = "SELECT MONTH(tanggal_penjualan) AS month, count(id_penjualan) AS total
        FROM data_penjualan_voucher
        WHERE YEAR(tanggal_penjualan) = $tahun
        GROUP BY MONTH(tanggal_penjualan)
        ORDER BY MONTH(tanggal_penjualan)";

$result = mysql_query($sql);

$sales = array_fill(1, 12, 0);

if (mysql_num_rows($result) > 0) {
    while ($row = mysql_fetch_assoc($result)) {
        $sales[$row['month']] = $row['total'];
    }
}
?>




<script>
    function renderChart() {
        var chartElements = document.querySelectorAll(".grafik_overview");

        chartElements.forEach(function(chartElement) {
            var chartHeight = parseInt(getComputedStyle(chartElement).height);

            new ApexCharts(chartElement, {
                series: [{
                        name: "Jumlah",
                        data: <?php echo json_encode(array_values($sales)); ?>,
                    },
                    {
                        name: "Jumlah",
                        data: <?php echo json_encode(array_values($sales)); ?>,
                    },
                ],
                chart: {
                    type: "bar",
                    height: chartHeight,
                    toolbar: {
                        show: false,
                    },
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: "30%",
                        borderRadius: 2,
                    },
                },
                legend: {
                    show: false,
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    show: true,
                    width: 1,
                    colors: ["transparent"],
                },
                xaxis: {
                    categories: ["Januari", "Februari", "Maret", "April", "mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
                    axisBorder: {
                        show: false,
                    },
                    labels: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    }
                },
                yaxis: {
                    show: false,
                },
                fill: {
                    opacity: [0.25, 1],
                },
                colors: ["#ffffff", "#ffffff"],
                grid: {
                    show: false,
                },
            }).render();
        });
    }

    renderChart();
</script>


<script>
    function renderChart() {
        var chartElements = document.querySelectorAll(".grafik_penjualan");

        chartElements.forEach(function(chartElement) {
            var chartHeight = parseInt(getComputedStyle(chartElement).height);
            var chartColor = chartElement.getAttribute("data-kt-chart-color") || "primary";
            var lineColor = getComputedStyle(document.documentElement).getPropertyValue("--bs-" + chartColor);

            new ApexCharts(chartElement, {
                series: [{
                    name: "Jumlah",
                    data: [35, 65, 75, 55, 45, 60, 55, 75, 55, 45, 60, 55],
                }],
                chart: {
                    type: "area",
                    height: chartHeight,
                    toolbar: {
                        show: false,
                    },
                    zoom: {
                        enabled: false,
                    },
                    sparkline: {
                        enabled: true,
                    },
                },
                stroke: {
                    curve: "smooth",
                    width: 3,
                    colors: [lineColor],
                },
                fill: {
                    type: "solid",
                    opacity: 0.3,
                },
                xaxis: {
                    categories: ["Januari", "Februari", "Maret", "April", "mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                    labels: {
                        show: false, // Hide x-axis labels
                    },
                },
                yaxis: {
                    min: 0,
                    labels: {
                        show: false, // Hide y-axis labels
                    },
                },
                grid: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 0,
                        bottom: 0
                    },
                },
                tooltip: {
                    y: {
                        formatter: function(value) {
                            return "Rp " + value + " ";
                        },
                    },
                },
                colors: [lineColor],
                markers: {
                    colors: [lineColor],
                },
            }).render();
        });
    }

    renderChart();
</script>


<script>
    function renderChart() {
        var chartElements = document.querySelectorAll(".grafik_transaksi");

        chartElements.forEach(function(chartElement) {
            var chartHeight = parseInt(getComputedStyle(chartElement).height);
            var chartColor = chartElement.getAttribute("data-kt-chart-color") || "primary";
            var lineColor = getComputedStyle(document.documentElement).getPropertyValue("--bs-" + chartColor);

            new ApexCharts(chartElement, {
                series: [{
                    name: "Jumlah",
                    data: [35, 65, 75, 55, 45, 60, 55, 75, 55, 45, 60, 55],
                }],
                chart: {
                    type: "area",
                    height: chartHeight,
                    toolbar: {
                        show: false,
                    },
                    zoom: {
                        enabled: false,
                    },
                    sparkline: {
                        enabled: true,
                    },
                },
                stroke: {
                    curve: "smooth",
                    width: 3,
                    colors: [lineColor],
                },
                fill: {
                    type: "solid",
                    opacity: 0.3,
                },
                xaxis: {
                    categories: ["Januari", "Februari", "Maret", "April", "mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                    labels: {
                        show: false, // Hide x-axis labels
                    },
                },
                yaxis: {
                    min: 0,
                    labels: {
                        show: false, // Hide y-axis labels
                    },
                },
                grid: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 0,
                        bottom: 0
                    },
                },
                tooltip: {
                    y: {
                        formatter: function(value) {
                            return "Rp " + value + " ";
                        },
                    },
                },
                colors: [lineColor],
                markers: {
                    colors: [lineColor],
                },
            }).render();
        });
    }

    renderChart();
</script>