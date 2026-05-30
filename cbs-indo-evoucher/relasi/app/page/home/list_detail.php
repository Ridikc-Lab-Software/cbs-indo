<?php

function column_transaksi_get($id_penjualan, $jumlah_voucher)
{
    global $dbh;

    try {
        $stmt = $dbh->prepare("SELECT COUNT(id_voucher) FROM data_voucher WHERE status = 'Used' AND id_penjualan = ? LIMIT 1");
        $stmt->execute([$id_penjualan]);
        $used = $stmt->fetchColumn();
    } catch (Exception $th) {
        $used = 0;

        error_log($th->getMessage());
    }
    $used = $used ? $used : 0;

    return [
        'used_voucher_count' => $used,
        'jumlah_voucher' => $jumlah_voucher,
        'persen' => number_format($used / $jumlah_voucher * 100, 2)
    ];
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_relasi = decrypt($_GET['id']);
    
}
else
{
    $id_relasi = decrypt($_COOKIE['kodene']);
}

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
                    AND YEAR(v.tanggal_kadaluarsa) = $tahun
                    WHERE
                    r.id_relasi = '$id_relasi'
                    GROUP BY
                    r.id_relasi
                    ORDER BY
                    used_voucher_count DESC;

                        ";

$proses = mysql_query($querytabel);
$data = mysql_fetch_array($proses);

$nama = $data['nama'];
$id_relasi = $data['id_relasi'];
$digunakan = $data['used_voucher_count'];
$tersedia = $data['unused_and_not_expired_count'];
$kadaluarsa = $data['expired_but_unused_count'];
$jml = $data['total_voucher_count'];
$persen = $digunakan / $jml * 100;
$persen = round($persen, 2);

if ($jml > 0) {
    $info_persen = "$digunakan dari $jml Digunakan ($persen%)";
} else {
    $info_persen = "Tidak Memiliki E-Voucher";
}
$year = substr($id_relasi, 3, 4);    // Characters 3-6 (2024)
$month = substr($id_relasi, 7, 2);   // Characters 7-8 (08)
$day = substr($id_relasi, 9, 2);     // Characters 9-10 (01)


$tanggal_bergabung = sprintf("%s-%s-%s", $year, $month, $day);
$total_penjualan = baca_database("", "total", "select sum(total_bayar) as total from data_penjualan_voucher where id_relasi='$id_relasi'");

?>
<div class="card mb-5 mb-xl-10">
    <div class="card-body pt-9 pb-0">
        <!--begin::Details-->
        <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
            <!--begin: Pic-->
            <div class="me-7 mb-4">
                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                    <img src="https://t3.ftcdn.net/jpg/01/75/45/72/360_F_175457216_HsANfhbGCfBAvxUtiOoz55hzVaGi2Sk9.jpg"
                        alt="image">
                    <div
                        class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-white h-20px w-20px">
                    </div>
                </div>
            </div>
            <!--end::Pic-->
            <!--begin::Info-->
            <div class="flex-grow-1">
                <!--begin::Title-->
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                    <!--begin::User-->
                    <div class="d-flex flex-column">
                        <!--begin::Name-->
                        <div class="d-flex align-items-center mb-2">
                            <a href="#"
                                class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1"><?php echo $data['nama']; ?></a>
                            <a href="#">

                                <span class="svg-icon svg-icon-1 svg-icon-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z"
                                            fill="#00A3FF"></path>
                                        <path class="permanent"
                                            d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z"
                                            fill="white"></path>
                                    </svg>
                                </span>

                            </a>
                            <a target="_blank" href="https://wa.me/6285369237896"
                                class="btn btn-sm btn-light-success fw-bolder ms-2 fs-8 py-1 px-3">Kontak Relasi</a>
                        </div>

                        <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                            <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                <span class="svg-icon svg-icon-4 me-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path opacity="0.3"
                                            d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z"
                                            fill="black"></path>
                                        <path
                                            d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z"
                                            fill="black"></path>
                                    </svg>
                                </span>
                                Relasi</a>
                            <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                                <span class="svg-icon svg-icon-4 me-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path opacity="0.3"
                                            d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z"
                                            fill="black"></path>
                                        <path
                                            d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z"
                                            fill="black"></path>
                                    </svg>
                                </span>
                                <?php echo $data['alamat']; ?></a>
                            <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                <span class="svg-icon svg-icon-4 me-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path opacity="0.3"
                                            d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z"
                                            fill="black"></path>
                                        <path
                                            d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z"
                                            fill="black"></path>
                                    </svg>
                                </span>
                                <?php echo $data['email']; ?></a>
                        </div>

                    </div>

                    <div class="d-flex my-4">
                        <div class="me-0">
                           
                        </div>
                    </div>
                </div>







                <div class="d-flex flex-wrap flex-stack">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column flex-grow-1 pe-8">
                        <!--begin::Stats-->
                        <div class="d-flex flex-wrap">
                            <!--begin::Stat-->

                            <a href="../home/?input=vouher_keseluruhan&id=<?php echo $nama; ?>&filter=aktif">
                                <div
                                    class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        <span class="svg-icon svg-icon-3 svg-icon-info me-2">
                                            <span class="svg-icon btn-icon svg-icon-4 ms-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3"
                                                        d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM15 17C15 16.4 14.6 16 14 16H8C7.4 16 7 16.4 7 17C7 17.6 7.4 18 8 18H14C14.6 18 15 17.6 15 17ZM17 12C17 11.4 16.6 11 16 11H8C7.4 11 7 11.4 7 12C7 12.6 7.4 13 8 13H16C16.6 13 17 12.6 17 12ZM17 7C17 6.4 16.6 6 16 6H8C7.4 6 7 6.4 7 7C7 7.6 7.4 8 8 8H16C16.6 8 17 7.6 17 7Z"
                                                        fill="black"></path>
                                                    <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black"></path>
                                                </svg>
                                            </span>
                                        </span>
                                        <div class="fs-2 fw-bolder counted" data-kt-countup="true"
                                            data-kt-countup-value="4500" data-kt-countup-prefix="$"
                                            style="color: black;"><?php echo $tersedia; ?>
                                        </div>
                                    </div>
                                    <div class="fw-bold fs-6 text-gray-400">Aktif</div>
                                </div>
                            </a>



                            <a
                                href="../home/?input=vouher_keseluruhan&id=<?php echo $nama; ?>&filter=digunakan">
                                <div
                                    class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
                                        <span class="svg-icon svg-icon-3 svg-icon-warning me-2">
                                            <span class="svg-icon btn-icon svg-icon-4 ms-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3"
                                                        d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM15 17C15 16.4 14.6 16 14 16H8C7.4 16 7 16.4 7 17C7 17.6 7.4 18 8 18H14C14.6 18 15 17.6 15 17ZM17 12C17 11.4 16.6 11 16 11H8C7.4 11 7 11.4 7 12C7 12.6 7.4 13 8 13H16C16.6 13 17 12.6 17 12ZM17 7C17 6.4 16.6 6 16 6H8C7.4 6 7 6.4 7 7C7 7.6 7.4 8 8 8H16C16.6 8 17 7.6 17 7Z"
                                                        fill="black"></path>
                                                    <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black"></path>
                                                </svg>
                                            </span>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <div class="fs-2 fw-bolder counted" data-kt-countup="true"
                                            data-kt-countup-value="75" style="color: black;"><?php echo $digunakan; ?>
                                        </div>
                                    </div>
                                    <!--end::Number-->
                                    <!--begin::Label-->
                                    <div class="fw-bold fs-6 text-gray-400">Digunakan</div>
                                    <!--end::Label-->
                                </div>
                            </a>



                            <a
                                href="../home/?input=vouher_keseluruhan&id=<?php echo $nama; ?>&filter=kadaluarsa">
                                <div
                                    class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
                                        <span class="svg-icon svg-icon-3 svg-icon-danger me-2">
                                            <span class="svg-icon btn-icon svg-icon-4 ms-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3"
                                                        d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM15 17C15 16.4 14.6 16 14 16H8C7.4 16 7 16.4 7 17C7 17.6 7.4 18 8 18H14C14.6 18 15 17.6 15 17ZM17 12C17 11.4 16.6 11 16 11H8C7.4 11 7 11.4 7 12C7 12.6 7.4 13 8 13H16C16.6 13 17 12.6 17 12ZM17 7C17 6.4 16.6 6 16 6H8C7.4 6 7 6.4 7 7C7 7.6 7.4 8 8 8H16C16.6 8 17 7.6 17 7Z"
                                                        fill="black"></path>
                                                    <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black"></path>
                                                </svg>
                                            </span>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <div class="fs-2 fw-bolder counted" data-kt-countup="true"
                                            data-kt-countup-value="75" style="color: black;"><?php echo $kadaluarsa; ?>
                                        </div>
                                    </div>
                                    <!--end::Number-->
                                    <!--begin::Label-->
                                    <div class="fw-bold fs-6 text-gray-400">Kadaluarsa</div>
                                    <!--end::Label-->
                                </div>
                            </a>


                            <a href="../home/?input=vouher_keseluruhan&id=<?php echo $nama; ?>&filter=semua">
                                <div
                                    class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
                                        <span class="svg-icon svg-icon-3 svg-icon-primary me-2">
                                            <span class="svg-icon btn-icon svg-icon-4 ms-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3"
                                                        d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM15 17C15 16.4 14.6 16 14 16H8C7.4 16 7 16.4 7 17C7 17.6 7.4 18 8 18H14C14.6 18 15 17.6 15 17ZM17 12C17 11.4 16.6 11 16 11H8C7.4 11 7 11.4 7 12C7 12.6 7.4 13 8 13H16C16.6 13 17 12.6 17 12ZM17 7C17 6.4 16.6 6 16 6H8C7.4 6 7 6.4 7 7C7 7.6 7.4 8 8 8H16C16.6 8 17 7.6 17 7Z"
                                                        fill="black"></path>
                                                    <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black"></path>
                                                </svg>
                                            </span>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <div class="fs-2 fw-bolder counted" data-kt-countup="true"
                                            data-kt-countup-value="75" style="color: black;"><?php echo $jml; ?></div>
                                    </div>
                                    <!--end::Number-->
                                    <!--begin::Label-->
                                    <div class="fw-bold fs-6 text-gray-400">Total</div>
                                    <!--end::Label-->
                                </div>
                            </a>



                        </div>
                        <!--end::Stats-->
                    </div>
                    <!--end::Wrapper-->

                </div>

            </div>

        </div>

        <div class="d-flex overflow-auto h-55px">
            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap"
                role="tablist">

                <li class="nav-item" role="presentation">
                    <a class="nav-link text-active-primary me-6 active" data-bs-toggle="tab" href="#tab_overview"
                        role="tab">
                        <i class="fas fa-chart-pie me-2"></i>Overview
                    </a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link text-active-primary me-6" data-bs-toggle="tab" href="#tab_supir" role="tab">
                        <i class="fas fa-user-tie me-2"></i>Supir
                    </a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link text-active-primary me-6" data-bs-toggle="tab" href="#tab_plat" role="tab">
                        <i class="fas fa-car me-2"></i>Plat Kendaraan
                    </a>
                </li>


            </ul>
        </div>

        <!--begin::Navs-->
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<style>
    .tab-pane {
        display: none;
    }

    .tab-pane.active {
        display: block;
    }
</style>

<div class="tab-pane fade show active" id="tab_overview" role="tabpanel">

    <div class="card mb-5 mb-xl-10">
        <div class="card-body">

            <?php if ($kadaluarsa > 0) { ?>
                <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-12 p-6">
                    <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"></rect>
                            <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="black">
                            </rect>
                            <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="black">
                            </rect>
                        </svg>
                    </span>

                    <div class="d-flex flex-stack flex-grow-1">
                        <div class="fw-bold">
                            <h4 class="text-gray-900 fw-bolder">Perhatian !</h4>
                            <div class="fs-6 text-gray-700">
                                Relasi <?php echo $nama; ?> memiliki <?php echo $kadaluarsa; ?> Voucher kadaluarsa.
                                <a
                                    href="../home/?input=vouher_keseluruhan&id=<?php echo $nama; ?>&filter=kadaluarsa">
                                    Lihat E-Voucher
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <div class="row">
                <div class="col-lg-7">
                    <h3 class="mb-2"><?php echo format_indo($tanggal_bergabung); ?></h3>
                    <p class="fs-6 text-gray-600 fw-bold mb-6">Tanggal Relasi terdaftar</p>

                    <div class="fs-5 mb-2">
                        <span class="text-gray-800 fw-bolder me-1">
                            <?php echo rupiah($total_penjualan); ?>
                        </span>
                    </div>
                    <div class="fs-6 text-gray-600 fw-bold">
                        Total Pembelian E-Voucher
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="d-flex text-muted fw-bolder fs-5 mb-3">
                        <span class="flex-grow-1 text-gray-800">E-Voucher</span>
                        <span class="text-gray-800"><?php echo $info_persen; ?></span>
                    </div>

                    <div class="progress h-8px bg-light-primary mb-2">
                        <div class="progress-bar bg-primary" style="width: <?php echo $persen; ?>%">
                        </div>
                    </div>

                    <div class="fs-6 text-gray-600 fw-bold">
                        Persentase Transaksi Voucher
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>


<div class="tab-pane fade" id="tab_supir" role="tabpanel">

    <div class="card mb-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Data Supir</h3>
            <button class="btn btn-sm btn-primary" onclick="addSupir()">Tambah Supir</button>
        </div>

        <div class="card-body">
            <table class="table table-row-bordered table-hover align-middle" id="tblSupir">
                <thead class="fw-bolder">
                    <tr>
                        <th width="50">No</th>
                        <th>Nama Supir</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- MODAL SUPIR -->
    <div class="modal fade" id="modalSupir">
        <div class="modal-dialog">
            <form id="formSupir" class="modal-content">
                <input type="hidden" name="aksi" id="aksiSupir">
                <input type="hidden" name="id_supir">
                <input type="hidden" name="id_relasi" value="<?= $id_relasi ?>">

                <div class="modal-header">
                    <h5 class="modal-title">Supir</h5>
                </div>

                <div class="modal-body">
                    <input class="form-control" name="nama_supir" placeholder="Nama Supir" required>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

</div>



<script>
    const id_relasi = "<?= $id_relasi ?>";
    const modalSupir = new bootstrap.Modal(document.getElementById('modalSupir'));

    function loadSupir() {
        fetch('apisupir.php?aksi=list&id_relasi=' + id_relasi)
            .then(r => r.json())
            .then(d => {
                let h = '', no = 1;
                d.forEach(s => {
                    h += `
            <tr>
                <td>${no++}</td>
                <td>${s.nama_supir}</td>
                <td>
                    <button class="btn btn-sm btn-warning"
                        onclick="editSupir('${s.id_supir}','${s.nama_supir}')">Edit</button>
                    <button class="btn btn-sm btn-danger"
                        onclick="hapusSupir('${s.id_supir}')">Hapus</button>
                </td>
            </tr>`;
                });
                document.querySelector('#tblSupir tbody').innerHTML = h;
            });
    }

    function addSupir() {
        formSupir.reset();
        aksiSupir.value = 'add';
        modalSupir.show();
    }

    function editSupir(id, nama) {
        aksiSupir.value = 'edit';
        formSupir.id_supir.value = id;
        formSupir.nama_supir.value = nama;
        modalSupir.show();
    }

    formSupir.onsubmit = e => {
        e.preventDefault();
        fetch('apisupir.php', { method: 'POST', body: new FormData(formSupir) })
            .then(() => { modalSupir.hide(); loadSupir(); });
    }

    function hapusSupir(id) {
        if (confirm('Hapus supir?')) {
            fetch('apisupir.php', {
                method: 'POST',
                body: new URLSearchParams({ aksi: 'delete', id: id })
            }).then(() => loadSupir());
        }
    }

    loadSupir();
</script>




<div class="tab-pane fade" id="tab_plat" role="tabpanel">

    <div class="card mb-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Data Kendaraan</h3>
            <button class="btn btn-sm btn-primary" onclick="addPlat()">Tambah Plat</button>
        </div>

        <div class="card-body">
            <table id="tblPlat" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Plat</th>
                        <th>Kategori </th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

        </div>
    </div>

    <!-- MODAL PLAT -->
    <div class="modal fade" id="modalPlat">
        <div class="modal-dialog">
            <form id="formPlat" class="modal-content">
                <input type="hidden" name="aksi" id="aksiPlat">
                <input type="hidden" name="id_plat">
                <input type="hidden" name="id_relasi" value="<?= $id_relasi ?>">

                <div class="modal-header">
                    <h5 class="modal-title">Plat Kendaraan</h5>
                </div>

                <div class="modal-body">
                    <input class="form-control mb-2" name="plat" placeholder="Plat Kendaraan" required>

                    <select class="form-control" name="id_kategori_member" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php
                        $q = mysql_query("SELECT * FROM data_kategori_member where jenis='kendaraan' ORDER BY kategori_member");
                        while ($r = mysql_fetch_assoc($q)) {
                            echo "<option value='$r[id_kategori_member]'>$r[kategori_member]</option>";
                        }
                        ?>
                    </select>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

</div>
<script>
    const modalPlat = new bootstrap.Modal(document.getElementById('modalPlat'));

    function loadPlat() {
        fetch('apiplat.php?aksi=list&id_relasi=' + id_relasi)
            .then(r => r.json())
            .then(d => {
                let h = '', no = 1;
                d.forEach(p => {
                    h += `
            <tr>
                <td>${no++}</td>
                <td>${p.plat}</td>
                <td>${p.kategori_member ?? '-'}</td>
                <td>
                    <button class="btn btn-sm btn-warning"
                        onclick="editPlat('${p.id_plat}','${p.plat}','${p.id_kategori_member}')">Edit</button>
                    <button class="btn btn-sm btn-danger"
                        onclick="hapusPlat('${p.id_plat}')">Hapus</button>
                </td>
            </tr>`;
                });
                document.querySelector('#tblPlat tbody').innerHTML = h;
            });
    }

    function addPlat() {
        formPlat.reset();
        aksiPlat.value = 'add';
        modalPlat.show();
    }


    function editPlat(id, plat, kategori) {
        aksiPlat.value = 'edit';
        formPlat.id_plat.value = id;
        formPlat.plat.value = plat;
        formPlat.id_kategori_member.value = kategori;
        modalPlat.show();
    }


    formPlat.onsubmit = e => {
        e.preventDefault();
        fetch('apiplat.php', { method: 'POST', body: new FormData(formPlat) })
            .then(() => { modalPlat.hide(); loadPlat(); });
    }

    function hapusPlat(id) {
        if (confirm('Hapus plat?')) {
            fetch('apiplat.php', {
                method: 'POST',
                body: new URLSearchParams({ aksi: 'delete', id: id })
            }).then(() => loadPlat());
        }
    }

    loadPlat();
</script>

<?php

$tanggal_awal = $request_start_date->isValid() ? $request_start_date->getValue() : date('Y-m-01');
$tanggal_akhir = $request_end_date->isValid() ? $request_end_date->getValue() : date('Y-m-t');

?>
<div class="col-xxl-12">

    <div class="card card-xxl-stretch mb-5 mb-xl-12">

        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">Pembelian E-Voucher</span>

            </h3>

            <!-- TODO: perbaikian design nya -->
            <?php

            if (($request_start_date->isValid() && $request_end_date->isValid()) || $request_nominal->isValid()) {

                ?>
                <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover">
                    <form>
                        <?=
                            createHiddenFieldsFromGetExclude($excludeKeys = ['s_start_date', 's_end_date', 's_nominal']);
                        ?>
                        <button type="submit" class="btn btn-sm btn-primary btn-active-light d-flex align-items-center">
                            <?php
                            if ($request_start_date->isValid() && $request_end_date->isValid()) {
                                ?>
                                Filter Tanggal : <br>
                                <?php echo $request_start_date->toShortenedString() . " - " . $request_end_date->toShortenedString(); ?></b>
                                &nbsp; &nbsp;
                                <?php
                            }
                            ?>

                            <?php
                            if ($request_nominal->isValid()) {
                                ?>
                                <br> Filter Nominal : <br> <?php echo $request_nominal->toShortenedString(); ?></b> &nbsp;
                                &nbsp;
                                <?php
                            }
                            ?>

                            <i class="fas fa-times ml-4" style="font-size: 1.5em;"></i>

                        </button>
                    </form>
                </div>
                <?php
            }

            ?>

            <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover"
                >
                <a href="../home/?input=vouher_keseluruhan&id=<?php echo ($nama); ?>"
                    class="btn btn-sm btn-light btn-active-primary">
                    Lihat Keseluruhan E-Voucher</a>
&nbsp;
&nbsp;

                    <a href="../report/index.php?input=cetak_pembelian"
                    class="btn btn-sm btn-primary btn-active-primary">
                    Laporan Pembelian E-Voucher</a>
            </div>


        </div>


        <div class="card-body py-3">

            <div class="table-responsive">

                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">

                    <thead>
                        <tr class="fw-bolder text-muted">

                            <th class="min-w-150px">Kode</th>
                            <th class="min-w-140px">Voucher</th>
                            <th class="min-w-120px">Detail</th>
                            <th class="min-w-120px">Transaksi</th>
                            <th class="min-w-100px text-end">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php

                        $no = 0;
                        $startRow = ($page - 1) * $dataPerPage;
                        $no = $startRow;

                        $q_builder = QB::table('data_penjualan_voucher')
                            ->setFetchMode(PDO::FETCH_ASSOC)
                            ->where('id_relasi', $id_relasi)
                            ->offset($startRow)
                            ->limit($dataPerPage)
                            ->orderBy('tanggal_penjualan', 'DESC');

                        if ($request_start_date->isValid() && $request_end_date->isValid()) {
                            $q_builder = $q_builder
                                ->where('tanggal_penjualan', 'BETWEEN', [$request_start_date->getValue(), $request_end_date->getValue()]);
                        }

                        if ($request_nominal->isValid()) {
                            $q_builder = $q_builder
                                ->where('nominal', $request_nominal->getValue());
                        }

                        foreach ($q_builder->get() as $data) {
                            $id_penjualan = $data['id_penjualan'];
                            $id_relasi = $data['id_relasi'];

                            ?>

                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-45px me-5">
                                            <!--begin::Svg Icon | path: assets/media/icons/duotune/communication/com006.svg-->
                                            <span class="svg-icon svg-icon-primary svg-icon-2hx"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3"
                                                        d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z"
                                                        fill="black" />
                                                    <path
                                                        d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z"
                                                        fill="black" />
                                                </svg></span>
                                            <!--end::Svg Icon-->
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <a
                                                class="text-dark fw-bolder text-hover-primary fs-6">ID<?php echo $data['id_penjualan']; ?></a>
                                            <span class="text-muted fw-bold text-muted d-block fs-7">Date :
                                                <?php echo format_indo_no_jam($data['tanggal_penjualan']); ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a class="text-dark fw-bolder text-hover-primary d-block fs-6">E-Voucher</a>
                                    <span class="text-muted fw-bold text-muted d-block fs-7">Jumlah :
                                        <?php echo $data['jumlah_voucher']; ?> Voucher</span>
                                </td>
                                <td>
                                    <a class="text-dark fw-bolder text-hover-primary d-block fs-6">
                                        <?php echo rupiah($data['total_bayar']); ?></a>
                                    <span class="text-muted fw-bold text-muted d-block fs-7">Nominal :
                                        <?php echo rupiah($data['nominal']); ?></span>
                                </td>

                                <td class="text-end">
                                    <div class="d-flex flex-column w-100 me-2">
                                        <div class="d-flex flex-stack mb-2">
                                            <span class="text-muted me-2 fs-7 fw-bold">
                                                <?php
                                                $column_transaksi = column_transaksi_get($data['id_penjualan'], $data['jumlah_voucher']);
                                                if ($column_transaksi['jumlah_voucher'] > 0) {
                                                    echo "$column_transaksi[used_voucher_count]/$column_transaksi[jumlah_voucher] ($column_transaksi[persen]%)";
                                                } else {
                                                    echo "Kosong";
                                                }
                                                ?>
                                            </span>
                                        </div>
                                        <div class="progress h-6px w-100">
                                            <div class="progress-bar bg-primary" role="progressbar"
                                                style="width: <?php echo $column_transaksi['persen']; ?>%"
                                                aria-valuenow="<?php echo $persen; ?>" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-end flex-shrink-0">


                                        <a href="index.php?input=list_detail_info&proses=<?php echo encrypt($id_penjualan); ?>"
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">

                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z"
                                                        fill="black"></path>
                                                    <path opacity="0.3"
                                                        d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z"
                                                        fill="black"></path>
                                                </svg>
                                            </span>

                                        </a>


                                        <a href="index.php?input=list_detail_voucher&proses=<?php echo encrypt($id_penjualan); ?>&preview="
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">

                                            <span class="svg-icon svg-icon-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1"
                                                        transform="rotate(-180 18 13)" fill="black"></rect>
                                                    <path
                                                        d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                        fill="black"></path>
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
                    $url_pagination = "?input=list_detail&id=" . $_GET['id'] . "&s_nominal=" . $request_nominal->getvalue() . "&s_start_date=" . $request_start_date->getvalue() . "&s_end_date=" . $request_end_date->getvalue() . "&";
                    PPagination_custom_url($url_pagination, $page, $dataPerPage, $q_builder);
                    ?>
                </center>
            </div>

        </div>

    </div>
</div>


<div class="col-xxl-12">
    <div class="card card-xxl-stretch mb-5 mb-xl-8">

        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bolder fs-3 mb-1">Transaksi E-Voucher</span>
            </h3>

            <div class="card-toolbar">
                <a href="../report/index.php?input=cetak_sisa_voucher"
                   class="btn btn-sm btn-light btn-active-primary">
                    Laporan Sisa Transaksi
                </a>
                &nbsp;&nbsp;
                <a href="../report/index.php?input=cetak_transaksi"
                   class="btn btn-sm btn-primary btn-active-primary">
                    Laporan Transaksi E-Voucher
                </a>
            </div>
        </div>

        <div class="card-body py-3">
            <div class="table-responsive">
                <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                    <thead>
                        <tr class="fw-bolder text-muted">
                            <th>Kode</th>
                            <th>Voucher</th>
                            <th>Detail</th>
                            <th>Transaksi</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
<?php
$startRow = ($page - 1) * $dataPerPage;

/* ================= QUERY UTAMA ================= */
$querytabel = "
SELECT
    dtv.*,
    COALESCE(dm.nama,'NON MEMBER') AS nama_member,
    ds.nama_supir,
    dp.plat
FROM data_transaksi_voucher dtv
LEFT JOIN data_member dm 
    ON dtv.id_member = dm.id_member
LEFT JOIN data_plat_kendaraan_transaksi_voucher dpk
    ON dpk.id_transaksi_voucher = dtv.id_transaksi
LEFT JOIN data_supir ds 
    ON dpk.id_supir = ds.id_supir
LEFT JOIN data_plat dp 
    ON dpk.no_plat_kendaraan = dp.id_plat
WHERE dtv.tanggal_transaksi BETWEEN '$tanggal_awal 00:00' AND '$tanggal_akhir 23:59'
AND dpk.id_relasi = '$id_relasi'
";

/* ===== FILTER OPSIONAL ===== */
if ($request_jenis_bbm->isValid()) {
    $jenis = $request_jenis_bbm->getValue();
    $querytabel .= " AND dtv.jenis_bbm = '$jenis' ";
}

if ($request_kategori_member->getValue() == "member") {
    $querytabel .= " AND dm.nama IS NOT NULL ";
} elseif ($request_kategori_member->getValue() == "non") {
    $querytabel .= " AND dm.nama IS NULL ";
}

$querytabel .= " ORDER BY dtv.tanggal_transaksi DESC LIMIT $startRow, $dataPerPage";

/* ================= PAGINATION ================= */
$querypagination = "
SELECT COUNT(dtv.id_transaksi) AS total
FROM data_transaksi_voucher dtv
LEFT JOIN data_member dm ON dtv.id_member = dm.id_member
LEFT JOIN data_plat_kendaraan_transaksi_voucher dpk
    ON dpk.id_transaksi_voucher = dtv.id_transaksi
WHERE dtv.tanggal_transaksi BETWEEN '$tanggal_awal 00:00' AND '$tanggal_akhir 23:59'
AND dpk.id_relasi = '$id_relasi'
";

$proses = mysql_query($querytabel);
while ($data = mysql_fetch_array($proses)) {
?>
<tr>
    <td>
        <a href="../data_transaksi_voucher/index.php?input=detail&proses=<?php echo encrypt($data['id_transaksi']); ?>"
           class="fw-bolder text-dark">
            <?php echo strtoupper($data['id_transaksi']); ?>
        </a>
        <div class="text-muted fs-7">
            <?php echo format_indo_jam($data['tanggal_transaksi']); ?>
        </div>
    </td>

    <td>
        <span class="fw-bolder">E-Voucher</span>
        <div class="text-muted fs-7">ID <?php echo $data['id_voucher']; ?></div>
    </td>

    <td>
        <div class="fw-bolder">Supir: <?php echo $data['nama_supir']; ?></div>
        <div class="text-muted fs-7">Plat: <?php echo $data['plat']; ?></div>
    </td>

    <td>
        <div class="fw-bolder">
            <?php
            $jenis = QB::table("data_jenis_transaksi")
                ->where('id_jenis_transaksi', $data['jenis_bbm'])
                ->first();
            echo $jenis ? $jenis->jenis_transaksi : $data['jenis_bbm'];
            ?>
        </div>

        <div class="text-muted fs-7">
            <?php
            $nominal = baca_database("", "nominal_voucher",
                "select * from data_sisa_voucher where id_voucher ='{$data['id_voucher']}'");
            if ($nominal == "") $nominal = $data['nominal'];
            echo rupiah($nominal);
            ?>
        </div>
    </td>

    <td class="text-end">
        <a href="../data_transaksi_voucher/index.php?input=detail&proses=<?php echo encrypt($data['id_transaksi']); ?>"
           class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
            ➜
        </a>
    </td>
</tr>
<?php } ?>
                    </tbody>
                </table>

                  <center>
                    <?php
                    $url_pagination = "?input=list_detail&id=" . $_GET['id'] . "&s_nominal=" . $request_nominal->getvalue() . "&s_start_date=" . $request_start_date->getvalue() . "&s_end_date=" . $request_end_date->getvalue() . "&";
                    PPagination_custom_url($url_pagination, $page, $dataPerPage, $q_builder);
                    ?>
                </center>
            </div>
        </div>
    </div>
</div>
