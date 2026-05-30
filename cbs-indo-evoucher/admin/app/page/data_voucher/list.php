<?php

if (isset($_GET['filter'])) { ?>
    <div class="row">
        <div class="d-flex" style="margin-bottom: 20px;">
            <a href="../data_voucher/?input=list" class="btn btn-flex flex-center bg-body btn-color-gray-700 btn-active-color-primary w-40px w-md-auto h-40px px-0 px-md-6">
                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                <span class="svg-icon svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
                    </svg>
                </span>
                <!--end::Svg Icon-->
                <span class="d-none d-md-inline">Clear Filter</span>
            </a>
        </div>
    </div>
<?php } ?>
<div class="row">

    <?php

    if (isset($_GET['id_relasi']) && $_GET['id_relasi'] !== "semua_relasi") {
        $id_relasi = $_GET['id_relasi'];
        $querytabel = "SELECT
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
        WHERE
            r.id_relasi = '$id_relasi'
        GROUP BY
            r.id_relasi
        ORDER BY
            used_voucher_count DESC;

        ";
    } else {
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
        used_voucher_count DESC;
    ";
    }

    $proses = mysql_query($querytabel);
    while ($data = mysql_fetch_array($proses)) {

        $id_relasi = $data['id_relasi'];
        $digunakan = $data['used_voucher_count'];
        $tersedia = $data['unused_and_not_expired_count'];
        $kadaluarsa = $data['expired_but_unused_count'];

    ?>
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 mb-10">
            <!--begin::Card-->
            <div class="card card-custom gutter-b card-stretch">
                <!--begin::Body-->
                <div class="card-body pt-4">

                    <!--begin::User-->
                    <div class="d-flex align-items-center mb-7 pt-5">
                        <!--begin::Pic-->
                        <div class="flex-shrink-0 mr-3">
                            <div class="symbol symbol-circle symbol-lg-75" style="margin-right: 10px;">
                                <span class="svg-icon svg-icon-primary svg-icon-3hx"><svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="black"></path>
                                        <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="black"></path>
                                    </svg></span>
                            </div>
                        </div>
                        <!--end::Pic-->
                        <!--begin::Title-->
                        <div class="d-flex flex-column">
                            <a href="#" class="text-dark font-weight-bold text-hover-primary font-size-h4 mb-0"><?php echo $data['nama']; ?></a>
                            <span class="text-muted font-weight-bold"><?php echo $data['email']; ?></span>
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::User-->
                    <!--begin::Desc-->
                    <p class="mb-3">
                        Detail Informasi E-Voucher
                    </p>
                    <!--end::Desc-->
                    <!--begin::Info-->
                    <div class="mb-7">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-dark-75 font-weight-bolder mr-2">Aktif</span>
                            <a href="#" class="text-muted text-hover-primary"><span class="badge badge-light-info fs-8 fw-bolder"><?php echo $tersedia; ?> </span></a>
                        </div>
                        <div class="d-flex justify-content-between align-items-center my-1">
                            <span class="text-dark-75 font-weight-bolder mr-2">Digunakan</span>
                            <a href="#" class="text-muted text-hover-primary"><span class="badge badge-light-warning fs-8 fw-bolder"><?php echo  $digunakan; ?> </span></a>
                        </div>
                        <div class="d-flex justify-content-between align-items-center my-1">
                            <span class="text-dark-75 font-weight-bolder mr-2">Kadaluarsa</span>
                            <a class="text-muted font-weight-bold"><span class="badge badge-light-danger fs-8 fw-bolder"><?php echo $kadaluarsa; ?> </span></a>
                        </div>

                        <div class="d-flex justify-content-between align-items-center my-1">
                            <span class="text-dark-75 font-weight-bolder mr-2">Total</span>
                            <a class="text-muted font-weight-bold"><span class="badge badge-light-success fs-8 fw-bolder"><?php echo $jml = $data['total_voucher_count']; ?></span></a>
                        </div>

                        <div class="d-flex flex-column w-100 me-2 pt-5">
                            <div class="d-flex flex-stack mb-2">
                                <span class="text-muted me-2 fs-7 fw-bold">

                                    <?php


                                    $persen = $digunakan / $jml * 100;
                                    $persen = round($persen, 2);

                                    if ($jml > 0) {
                                        echo "$digunakan/$jml ($persen%)";
                                    } else {
                                        echo "Tidak Memiliki E-Voucher";
                                    }
                                    ?>
                                </span>
                            </div>
                            <div class="progress h-6px w-100">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $persen; ?>%" aria-valuenow="<?php echo $persen; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <!--end::Info-->
                    <a href="../data_voucher/?input=list_detail&id=<?php echo encrypt($id_relasi); ?>" class="btn btn-block btn-sm btn-light-success font-weight-bolder text-uppercase py-4">Detail Relasi & E-voucher</a>
                </div>
                <!--end::Body-->
            </div>
            <!--end:: Card-->
        </div>
    <?php }
    if (mysql_num_rows($proses) == 0) {
    ?>
        <div class="col-lg-12 col-xxl-12">
            <div class="alert alert-primary d-flex align-items-center p-5 mb-10" bis_skin_checked="1">
                <i class="ki-duotone ki-shield-tick fs-2hx text-primary me-4"><span class="path1"></span><span class="path2"></span></i>
                <div class="d-flex flex-column" bis_skin_checked="1">
                    <h4 class="mb-1 text-primary">Informasi</h4>
                    <span>Tidak Ada Data E-Voucher</span>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>
