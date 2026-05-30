<!DOCTYPE html>
<?php
$url = '../../../data/tmp/metronic87/file/';
include '../../../include/all_include.php';
include '../../../include/function/session.php';

function getCurrentUrl()
{
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $currentUrl = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    return $currentUrl;
}

function getLastFolderName($url)
{
    $parsedUrl = parse_url($url, PHP_URL_PATH);
    $trimmedPath = rtrim($parsedUrl, '/');
    $pathSegments = explode('/', $trimmedPath);
    if (strpos(end($pathSegments), '.') !== false) {
        array_pop($pathSegments);
    }
    return end($pathSegments);
}
$currentUrl = getCurrentUrl();
$lastFolderName = getLastFolderName($currentUrl);

function active_menu($menu1)
{
    global $lastFolderName;
    if (in_array($lastFolderName, $menu1)) {
        echo "active";
    } else {
        echo "";
    }
}

$kadaluarsa_voucher = SettingVoucher::get_number(SettingVoucher::$kadaluarsa);
function kadaluarsa($months)
{
    $date = new DateTime();
    $date->modify("+{$months} months");
    return $date->format('Y-m-d');
}

function monthName($month)
{
    $months = [
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
    ];
    return $months[$month];
}

// Daftar bulan
$months = [
    '01' => 'Januari',
    '02' => 'Februari',
    '03' => 'Maret',
    '04' => 'April',
    '05' => 'Mei',
    '06' => 'Juni',
    '07' => 'Juli',
    '08' => 'Agustus',
    '09' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember',
];

$request_start_date = new RequestPencarianTanggal('s_start_date');
$request_end_date = new RequestPencarianTanggal('s_end_date');
$request_nominal = new RequestPencarianNominal('s_nominal');
$request_status = new RequestPencarianStatus('s_status');
$request_bulan = new RequestPencarianBulan('s_bulan');
$request_tahun = new RequestPencarianTahun('s_tahun');
$request_jenis_bbm = new RequestString('s_jenis_bbm');
$request_kategori_member = new RequestString('s_kategori_member');

$currentYear = date('Y');
$startYear = 2021;

$menu1 = array("home", "data_voucher", "test", "data_log_activity");
$menu2 = array("data_spbu", "data_admin", "data_transaksi_voucher", "data_penjualan_voucher", "data_relasi", "data_member", "data_jenis_transaksi", "data_bank");
$menu3 = array("report","data_sisa_voucher");
$menu4 = array("grafik");
$menu5 = array("config","data_shift","data_nominal");
$ppn = SettingVoucher::get_number(SettingVoucher::$ppn);


?>
<html lang="en">

<head>
    <base href="">
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="<?php echo $url; ?>assets/media/logos/favicon.ico" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700" />
    <link href="<?php echo $url; ?>assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet"
        type="text/css" />
    <link href="<?php echo $url; ?>assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $url; ?>assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <style>
        .highlight {
            position: relative;
            background: #ffffff;
            border-radius: .475rem;
            padding: 1.75rem 1.5rem 1.75rem 1.5rem;
        }
    </style>
</head>

<body id="kt_body" style="background-image: url()"
    class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-disabled">
    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">
            <div id="kt_aside" class="aside aside-extended" data-kt-drawer="true" data-kt-drawer-name="aside"
                data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                data-kt-drawer-width="auto" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_toggle">
                <div class="aside-primary d-flex flex-column align-items-lg-center flex-row-auto">
                    <div class="aside-logo d-none d-lg-flex flex-column align-items-center flex-column-auto py-10"
                        id="kt_aside_logo">
                        <a href="#">
                            <img alt="Logo" src="<?php echo $logo; ?>" class="h-45px" />
                        </a>
                        </a>
                    </div>
                    <div class="aside-nav d-flex flex-column align-items-center flex-column-fluid w-100 pt-5 pt-lg-0"
                        id="kt_aside_nav">
                        <div class="hover-scroll-y mb-10" data-kt-scroll="true"
                            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
                            data-kt-scroll-wrappers="#kt_aside_nav"
                            data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-offset="0px">
                            <ul class="nav flex-column">
                                <li class="nav-item mb-2" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                    data-bs-placement="right" data-bs-dismiss="click" title="Relasi E-Voucher">
                                    <a onclick="window.location.href='../home/'" href="../home/" class="nav-link btn btn-icon btn-active-color-primary btn-color-gray-400 btn-active-light active"
                                        data-bs-toggle="tab" >

                                        <span class="svg-icon svg-icon-2x">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                                                <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2"
                                                    fill="black" />
                                                <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2"
                                                    fill="black" />
                                                <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2"
                                                    fill="black" />
                                            </svg>
                                        </span>
                                    </a>
                                </li>

                              

                            </ul>

                        </div>

                    </div>

                    <div class="aside-footer d-flex flex-column align-items-center flex-column-auto"
                        id="kt_aside_footer">
                        
                      

                  
                        <div class="d-flex align-items-center mb-10" id="kt_header_user_menu_toggle">
                            <div class="cursor-pointer symbol symbol-40px" data-kt-menu-trigger="click"
                                data-kt-menu-overflow="true" data-kt-menu-placement="top-start" data-bs-toggle="tooltip"
                                data-bs-placement="right" data-bs-dismiss="click" title="User profile">
                                <img src="<?php echo $url; ?>assets/media/avatars/avatar1.png" alt="image" />
                            </div>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
                                data-kt-menu="true">
                                <div class="menu-item px-3">
                                    <div class="menu-content d-flex align-items-center px-3">

                                        <div class="symbol symbol-50px me-5">
                                            <img alt="Logo" src="<?php echo $url; ?>assets/media/avatars/avatar1.png" />
                                        </div>
                                        <div class="d-flex flex-column">
                                            <div class="fw-bolder d-flex align-items-center fs-5"><?php echo decrypt($_COOKIE['jenenge']);?>
                                                
                                            </div>
                                           <span
                                                    class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">Relasi</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="separator my-2"></div>

                               

                                <div class="menu-item px-5">
                                    <a href="../../../login/logout.php" class="menu-link px-5">
                                        <span class="menu-text">Logout</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

             

                
            </div>





            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">

                <!-- navbar -->
                <div id="kt_header" class="header" data-kt-sticky="true" data-kt-sticky-name="header"
                    data-kt-sticky-offset="{default: '200px', lg: '300px'}">

                    <div class="container-xxl d-flex align-items-center justify-content-between"
                        id="kt_header_container">

                        <div class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-lg-2 pb-2 pb-lg-0"
                            data-kt-swapper="true" data-kt-swapper-mode="prepend"
                            data-kt-swapper-parent="{default: '#kt_content_container', lg: '#kt_header_container'}">

                            <h1 class="text-dark fw-bolder my-0 fs-2">Dashboard</h1>


                            <ul class="breadcrumb fw-bold fs-base my-1">
                                <li class="breadcrumb-item text-muted">
                                    <a href="#" class="text-muted">Page</a>
                                </li>
                                <li class="breadcrumb-item text-dark"><?php tabelnomin(); ?></li>
                                <?php
                                if (isset($_GET['input'])) {
                                ?>
                                    <li class="breadcrumb-item text-dark">
                                        <?php echo ucwords(str_replace("_", " ", $_GET['input'])); ?>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>

                        </div>


                        <div class="d-flex d-lg-none align-items-center ms-n2 me-2">

                            <div class="btn btn-icon btn-active-icon-primary" id="kt_aside_toggle">

                                <span class="svg-icon svg-icon-2x">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path
                                            d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                                            fill="black" />
                                        <path opacity="0.3"
                                            d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                                            fill="black" />
                                    </svg>
                                </span>

                            </div>


                            <a href="#" class="d-flex align-items-center">
                                <img alt="Logo" src="<?php echo $url; ?>assets/media/logos/logo-demo7.svg"
                                    class="h-30px" />
                            </a>

                        </div>


                        <div class="d-flex flex-shrink-0">
                            <?php if ($lastFolderName == "home") { ?>
                                
                                <?php } elseif ($lastFolderName == "data_voucher") {

                                if (isset($_GET['input'])) {
                                    if ($_GET['input'] == "list" || $_GET['input'] == "voucher_aktif" || $_GET['input'] == "voucher_digunakan" || $_GET['input'] == "voucher_kadaluarsa" || $_GET['input'] == "vouher_keseluruhan" || $lastFolderName == "data_log_activity") {
                                ?>

                                        <?php
                                        $query_total_voucher = "SELECT
                                    SUM(status = 'Unused' AND tanggal_kadaluarsa > NOW()) AS aktif,
                                    SUM(status = 'Unused' AND tanggal_kadaluarsa <= NOW()) AS kadaluarsa,
                                    SUM(status = 'Used') AS digunakan
                                FROM
                                    data_voucher;
                                ";
                                        $proses_query = mysql_query($query_total_voucher);
                                        $data = mysql_fetch_array($proses_query);
                                        $aktif = $data['aktif'];
                                        $kadaluarsa = $data['kadaluarsa'];
                                        $digunakan = $data['digunakan'];
                                        ?>
                                        <?php if ($_GET['input'] != "list") { ?>
                                            <div class="d-flex ms-3">
                                                <a class="btn btn-flex flex-center bg-body btn-color-primary-700 btn-active-color-primary w-40px w-md-auto h-40px px-0 px-md-6"
                                                    tooltip="Voucher Aktif" href="../data_voucher/?input=list">

                                                    <span
                                                        class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo2\dist/../src/media/svg/icons\Code\Left-circle.svg--><svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                            viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24" />
                                                                <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
                                                                <path
                                                                    d="M6.96323356,15.1775211 C6.62849853,15.5122561 6.08578582,15.5122561 5.75105079,15.1775211 C5.41631576,14.842786 5.41631576,14.3000733 5.75105079,13.9653383 L10.8939067,8.82248234 C11.2184029,8.49798619 11.7409054,8.4866328 12.0791905,8.79672747 L17.2220465,13.5110121 C17.5710056,13.8308912 17.5945795,14.3730917 17.2747004,14.7220508 C16.9548212,15.0710098 16.4126207,15.0945838 16.0636617,14.7747046 L11.5257773,10.6149773 L6.96323356,15.1775211 Z"
                                                                    fill="#000000" fill-rule="nonzero"
                                                                    transform="translate(11.500001, 12.000001) scale(-1, 1) rotate(-270.000000) translate(-11.500001, -12.000001) " />
                                                            </g>
                                                        </svg><!--end::Svg Icon--></span>
                                                    <span class="d-none d-md-inline"> Back</span>
                                                </a>
                                            </div>
                                        <?php } ?>


                                        <div class="d-flex ms-3">
                                            <a class="btn btn-flex flex-center bg-body btn-color-primary-700 btn-active-color-success w-40px w-md-auto h-40px px-0 px-md-6"
                                                tooltip="Voucher Aktif" href="../data_voucher/?input=voucher_aktif">
                                                <span
                                                    class="svg-icon svg-icon-success svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <title>Stockholm-icons / Shopping / Barcode-read</title>
                                                        <desc>Created with Sketch.</desc>
                                                        <defs />
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <rect fill="#000000" opacity="0.3" x="4" y="4" width="8" height="16" />
                                                            <path d="M6,18 L9,18 C9.66666667,18.1143819 10,18.4477153 10,19 C10,19.5522847 9.66666667,19.8856181 9,20 L4,20 L4,15 C4,14.3333333 4.33333333,14 5,14 C5.66666667,14 6,14.3333333 6,15 L6,18 Z M18,18 L18,15 C18.1143819,14.3333333 18.4477153,14 19,14 C19.5522847,14 19.8856181,14.3333333 20,15 L20,20 L15,20 C14.3333333,20 14,19.6666667 14,19 C14,18.3333333 14.3333333,18 15,18 L18,18 Z M18,6 L15,6 C14.3333333,5.88561808 14,5.55228475 14,5 C14,4.44771525 14.3333333,4.11438192 15,4 L20,4 L20,9 C20,9.66666667 19.6666667,10 19,10 C18.3333333,10 18,9.66666667 18,9 L18,6 Z M6,6 L6,9 C5.88561808,9.66666667 5.55228475,10 5,10 C4.44771525,10 4.11438192,9.66666667 4,9 L4,4 L9,4 C9.66666667,4 10,4.33333333 10,5 C10,5.66666667 9.66666667,6 9,6 L6,6 Z" fill="#000000" fill-rule="nonzero" />
                                                        </g>
                                                    </svg></span>

                                                <span class="d-none d-md-inline">(<?php echo $aktif; ?>) Aktif</span>
                                            </a>
                                        </div>



                                        <div class="d-flex ms-3">
                                            <a class="btn btn-flex flex-center bg-body btn-color-primary-700 btn-active-color-warning w-40px w-md-auto h-40px px-0 px-md-6"
                                                tooltip="Voucher Digunakan" href="../data_voucher/?input=voucher_digunakan">
                                                <span
                                                    class="svg-icon svg-icon-warning svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <title>Stockholm-icons / Shopping / Barcode-read</title>
                                                        <desc>Created with Sketch.</desc>
                                                        <defs />
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <rect fill="#000000" opacity="0.3" x="4" y="4" width="8" height="16" />
                                                            <path d="M6,18 L9,18 C9.66666667,18.1143819 10,18.4477153 10,19 C10,19.5522847 9.66666667,19.8856181 9,20 L4,20 L4,15 C4,14.3333333 4.33333333,14 5,14 C5.66666667,14 6,14.3333333 6,15 L6,18 Z M18,18 L18,15 C18.1143819,14.3333333 18.4477153,14 19,14 C19.5522847,14 19.8856181,14.3333333 20,15 L20,20 L15,20 C14.3333333,20 14,19.6666667 14,19 C14,18.3333333 14.3333333,18 15,18 L18,18 Z M18,6 L15,6 C14.3333333,5.88561808 14,5.55228475 14,5 C14,4.44771525 14.3333333,4.11438192 15,4 L20,4 L20,9 C20,9.66666667 19.6666667,10 19,10 C18.3333333,10 18,9.66666667 18,9 L18,6 Z M6,6 L6,9 C5.88561808,9.66666667 5.55228475,10 5,10 C4.44771525,10 4.11438192,9.66666667 4,9 L4,4 L9,4 C9.66666667,4 10,4.33333333 10,5 C10,5.66666667 9.66666667,6 9,6 L6,6 Z" fill="#000000" fill-rule="nonzero" />
                                                        </g>
                                                    </svg></span>
                                                <span class="d-none d-md-inline">(<?php echo $digunakan; ?>) Digunakan</span>
                                            </a>
                                        </div>

                                        <div class="d-flex ms-3">
                                            <a class="btn btn-flex flex-center bg-body btn-color-primary-700 btn-active-color-danger w-40px w-md-auto h-40px px-0 px-md-6"
                                                tooltip="Voucher Kadaluarsa"" href=" ../data_voucher/?input=voucher_kadaluarsa">

                                                <span
                                                    class="svg-icon svg-icon-danger svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <title>Stockholm-icons / Shopping / Barcode-read</title>
                                                        <desc>Created with Sketch.</desc>
                                                        <defs />
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <rect fill="#000000" opacity="0.3" x="4" y="4" width="8" height="16" />
                                                            <path d="M6,18 L9,18 C9.66666667,18.1143819 10,18.4477153 10,19 C10,19.5522847 9.66666667,19.8856181 9,20 L4,20 L4,15 C4,14.3333333 4.33333333,14 5,14 C5.66666667,14 6,14.3333333 6,15 L6,18 Z M18,18 L18,15 C18.1143819,14.3333333 18.4477153,14 19,14 C19.5522847,14 19.8856181,14.3333333 20,15 L20,20 L15,20 C14.3333333,20 14,19.6666667 14,19 C14,18.3333333 14.3333333,18 15,18 L18,18 Z M18,6 L15,6 C14.3333333,5.88561808 14,5.55228475 14,5 C14,4.44771525 14.3333333,4.11438192 15,4 L20,4 L20,9 C20,9.66666667 19.6666667,10 19,10 C18.3333333,10 18,9.66666667 18,9 L18,6 Z M6,6 L6,9 C5.88561808,9.66666667 5.55228475,10 5,10 C4.44771525,10 4.11438192,9.66666667 4,9 L4,4 L9,4 C9.66666667,4 10,4.33333333 10,5 C10,5.66666667 9.66666667,6 9,6 L6,6 Z" fill="#000000" fill-rule="nonzero" />
                                                        </g>
                                                    </svg></span>

                                                <span class="d-none d-md-inline">(<?php echo $kadaluarsa; ?>) Kadaluarsa</span>
                                            </a>
                                        </div>



                                        <?php if ($_GET['input'] == "list") { ?>
                                            <div class="d-flex ms-3">
                                                <a class="btn btn-flex flex-center bg-body btn-color-primary-700 btn-active-color-danger w-40px w-md-auto h-40px px-0 px-md-6"
                                                    tooltip="Voucher Keseluruhan"" href=" ../data_voucher/?input=vouher_keseluruhan">

                                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Shopping/Barcode-read.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <title>Stockholm-icons / Shopping / Barcode-read</title>
                                                            <desc>Created with Sketch.</desc>
                                                            <defs />
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24" />
                                                                <rect fill="#000000" opacity="0.3" x="4" y="4" width="8" height="16" />
                                                                <path d="M6,18 L9,18 C9.66666667,18.1143819 10,18.4477153 10,19 C10,19.5522847 9.66666667,19.8856181 9,20 L4,20 L4,15 C4,14.3333333 4.33333333,14 5,14 C5.66666667,14 6,14.3333333 6,15 L6,18 Z M18,18 L18,15 C18.1143819,14.3333333 18.4477153,14 19,14 C19.5522847,14 19.8856181,14.3333333 20,15 L20,20 L15,20 C14.3333333,20 14,19.6666667 14,19 C14,18.3333333 14.3333333,18 15,18 L18,18 Z M18,6 L15,6 C14.3333333,5.88561808 14,5.55228475 14,5 C14,4.44771525 14.3333333,4.11438192 15,4 L20,4 L20,9 C20,9.66666667 19.6666667,10 19,10 C18.3333333,10 18,9.66666667 18,9 L18,6 Z M6,6 L6,9 C5.88561808,9.66666667 5.55228475,10 5,10 C4.44771525,10 4.11438192,9.66666667 4,9 L4,4 L9,4 C9.66666667,4 10,4.33333333 10,5 C10,5.66666667 9.66666667,6 9,6 L6,6 Z" fill="#000000" fill-rule="nonzero" />
                                                            </g>
                                                        </svg><!--end::Svg Icon--></span>

                                                    <span class="d-none d-md-inline">Semua</span>
                                                </a>
                                            </div>
                                        <?php } ?>


                                <?php

                                    }
                                }
                                ?>

                            <?php } ?>

                            <div class="d-flex align-items-center ms-3">

                                <div class="btn btn-icon btn-primary w-40px h-40px pulse pulse-white"
                                    onclick="window.location.href='<?php logout(); ?>'">

                                    <span class="svg-icon svg-icon-2">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.3" width="12" height="2" rx="1"
                                                transform="matrix(-1 0 0 1 15.5 11)" fill="black" />
                                            <path
                                                d="M13.6313 11.6927L11.8756 10.2297C11.4054 9.83785 11.3732 9.12683 11.806 8.69401C12.1957 8.3043 12.8216 8.28591 13.2336 8.65206L16.1592 11.2526C16.6067 11.6504 16.6067 12.3496 16.1592 12.7474L13.2336 15.3479C12.8216 15.7141 12.1957 15.6957 11.806 15.306C11.3732 14.8732 11.4054 14.1621 11.8756 13.7703L13.6313 12.3073C13.8232 12.1474 13.8232 11.8526 13.6313 11.6927Z"
                                                fill="black" />
                                            <path
                                                d="M8 5V6C8 6.55228 8.44772 7 9 7C9.55228 7 10 6.55228 10 6C10 5.44772 10.4477 5 11 5H18C18.5523 5 19 5.44772 19 6V18C19 18.5523 18.5523 19 18 19H11C10.4477 19 10 18.5523 10 18C10 17.4477 9.55228 17 9 17C8.44772 17 8 17.4477 8 18V19C8 20.1046 8.89543 21 10 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3H10C8.89543 3 8 3.89543 8 5Z"
                                                fill="#C4C4C4" />
                                        </svg>

                                    </span>

                                    <span class="pulse-ring"></span>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>
                <!-- end navbar -->


                <!-- content  -->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

                    <div class="container-xxl" id="kt_content_container">

                        <?php
                        if ($lastFolderName == "home" || $lastFolderName == "data_voucher" || $lastFolderName == "grafik") {

                            include 'halaman.php';
                        } else {
                        ?>
                            <div class="row gy-5 g-xl-8">


                                <div class="col-xxl-12">

                                    <div class="card card-xxl-stretch mb-5 mb-xl-12">

                                        <div class="card-header border-0 pt-5">
                                            <h3 class="card-title align-items-start flex-column">
                                                <span
                                                    class="card-label fw-bolder fs-3 mb-1"><?php echo tabelnomin() ?></span>
                                                <span class="text-muted mt-1 fw-bold fs-7">Management
                                                    <?php echo tabelnomin() ?></span>
                                            </h3>

                                            <?php if (isset($_GET['input'])) {

                                                if ($_GET['input'] == "cetak") { ?>
                                                    <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-trigger="hover" title="Click to add a user">
                                                        <img src="<?php echo $url; ?>assets/media/illustrations/sigma-1/5.png"
                                                            style="width: 69px;">
                                                    </div>
                                                <?php } else {
                                                ?>
                                                    <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-trigger="hover" title="Click to add a user">
                                                        <img src="<?php echo $url; ?>assets/media/illustrations/sigma-1/4.png"
                                                            style="width: 69px;">
                                                    </div>
                                            <?php
                                                }
                                            } ?>
                                        </div>


                                        <div class="card-body py-3">

                                            <div class="table-responsive">

                                                <?php include 'halaman.php'; ?>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        <?php
                        }
                        ?>


                    </div>

                </div>
                <!-- end content -->

                <!-- footer -->
                <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">

                    <div class="container-xxl d-flex flex-column flex-md-row flex-stack">

                        <div class="text-dark order-2 order-md-1">

                            <a href="#" target="_blank"
                                class="text-muted text-hover-primary fw-bold me-2 fs-6"><?php echo $copyright; ?></a>
                        </div>


                        <ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
                            <li class="menu-item">
                                <a href="#" target="_blank" class="menu-link px-2">About</a>
                            </li>
                            <li class="menu-item">
                                <a href="#" target="_blank" class="menu-link px-2">Support</a>
                            </li>
                            <li class="menu-item">
                                <a href="#" target="_blank" class="menu-link px-2">Purchase</a>
                            </li>
                        </ul>

                    </div>
                </div>
                <!-- footer -->

            </div>





        </div>
    </div>


    <!-- <button id="kt_explore_toggle"
        class="explore-toggle btn btn-sm bg-body btn-color-gray-700 btn-active-primary shadow-sm position-fixed px-5 fw-bolder zindex-2 top-50 mt-10 end-0 transform-90 fs-6 rounded-top-0"
        title="Filter & Pencarian E-Voucher" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-trigger="hover">
        <span id="kt_explore_toggle_label">Filter & Pencarian</span>
    </button> -->

    <div id="kt_explore" class="bg-body" data-kt-drawer="true" data-kt-drawer-name="explore"
        data-kt-drawer-activate="true" data-kt-drawer-overlay="true"
        data-kt-drawer-width="{default:'350px', 'lg': '475px'}" data-kt-drawer-direction="end"
        data-kt-drawer-toggle="#kt_explore_toggle" data-kt-drawer-close="#kt_explore_close">

        <div class="card shadow-none rounded-0 w-100">

            <div class="card-header" id="kt_explore_header">
                <h3 class="card-title fw-bolder text-gray-700">Filter Pencarian</h3>
                <div class="card-toolbar">
                    <button type="button" class="btn btn-sm btn-icon btn-active-light-primary me-n5"
                        id="kt_explore_close">

                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                    transform="rotate(-45 6 17.3137)" fill="black" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                    fill="black" />
                            </svg>
                        </span>

                    </button>
                </div>
            </div>


            <div class="card-body" id="kt_explore_body">

                <div id="kt_explore_scroll" class="scroll-y me-n5 pe-5" data-kt-scroll="true"
                    data-kt-scroll-height="auto" data-kt-scroll-wrappers="#kt_explore_body"
                    data-kt-scroll-dependencies="#kt_explore_header" data-kt-scroll-offset="5px">

                    <div class="mb-0">
                        <?php if ($lastFolderName == "data_voucher") {

                            if ($_GET['input'] == "list") {
                        ?>
                                <div class="rounded border border-dashed border-gray-300 py-4 px-6 mb-2">
                                    <form>
                                        <div class="row mb-12">
                                            <div class="col-md-12 fv-row">
                                                <input type="hidden" name="input" value="list">
                                                <input type="hidden" name="filter" value="voucher">

                                                <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                    <span class="required">Nama Relasi</span>
                                                </label>


                                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


                                                <script
                                                    src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

                                                <select name="id_relasi" class="form-control" id="id_relasi">
                                                    <option value="semua_relasi">Semua Relasi</option>
                                                    <?php combo_database_v2("data_relasi", "id_relasi", "nama", ""); ?>
                                                </select>

                                                <script>
                                                    $(document).ready(function() {
                                                        $('#id_relasi').select2({
                                                            placeholder: 'Select a relation', // Optional placeholder
                                                            allowClear: true // Optional: allows clearing the selection
                                                        });
                                                    });
                                                </script>


                                            </div>
                                        </div>


                                        <button class="btn btn-primary mb-2 w-100">Filter</button>
                                    </form>
                                </div>

                            <?php
                            } elseif ($_GET['input'] == "list_detail") {
                            ?>
                                <div class="rounded border border-dashed border-gray-300 py-4 px-6 mb-2">
                                    <div class="row mb-12">
                                        <div class="col-md-12 fv-row">
                                            <form>
                                                <?=
                                                createHiddenFieldsFromGetExclude(['s_start_date', 's_end_date', 'page']);
                                                ?>
                                                <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                    <span class="required">Tanggal awal</span>
                                                </label>
                                                <input class="form-control mb-4" type="date" name="s_start_date"
                                                    value="<?= $request_start_date->isValid() ? $request_start_date->getValue() : '' ?>">

                                                <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                    <span class="required">Tanggal sampai</span>
                                                </label>
                                                <input class="form-control mb-4" type="date" name="s_end_date"
                                                    value="<?= $request_end_date->isValid() ? $request_end_date->getValue() : '' ?>">


                                                <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                    <span class="required">Nominal</span>
                                                </label>
                                                <select class="form-control mb-4" name="s_nominal">
                                                    <option value="semua_nominal">Semua Nominal</option>
                                                    <?php combo_database_v2("data_nominal", "id_nominal", "nominal", ""); ?>
                                                </select>

                                                <button class="btn btn-primary mb-2 w-100">Filter</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } elseif ($_GET['input'] == "list_detail_voucher") {
                            ?>
                                <div class="rounded border border-dashed border-gray-300 py-4 px-6 mb-2">
                                    <div class="row mb-12">
                                        <div class="col-md-12 fv-row">
                                            <form>
                                                <?php
                                                echo createHiddenFieldsFromGetExclude(['s_status', 'page']);
                                                ?>

                                                <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                    <span class="required">Status</span>
                                                </label>
                                                <select class="form-control mb-4" name="s_status">
                                                    <option value="semua">Semua</option>
                                                    <option <?= $request_status->isValid() && $request_status->getValue() == "Used" ? "selected" : "" ?>>Used</option>
                                                    <option <?= $request_status->isValid() && $request_status->getValue() == "Unused" ? "selected" : "" ?>>Unused
                                                    </option>
                                                </select>

                                                <button class="btn btn-primary mb-2 w-100">Filter</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } elseif ($_GET['input'] == "vouher_keseluruhan") {
                            ?>
                                <div class="rounded border border-dashed border-gray-300 py-4 px-6 mb-2">
                                    <div class="row mb-12">
                                        <div class="col-md-12 fv-row">
                                            <form>
                                                <?php echo createHiddenFieldsFromGetExclude(['s_status', 's_start_date', 's_end_date', 'page']); ?>
                                                <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                    <span class="required">Tanggal Kadaluarsa awal</span>
                                                </label>
                                                <input class="form-control mb-4" type="date" name="s_start_date"
                                                    value="<?= $request_start_date->isValid() ? $request_start_date->getValue() : '' ?>">

                                                <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                    <span class="required">Tanggal Kadaluarsa akhir</span>
                                                </label>
                                                <input class="form-control mb-4" type="date" name="s_end_date"
                                                    value="<?= $request_end_date->isValid() ? $request_end_date->getValue() : '' ?>">


                                                <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                    <span class="required">Nominal</span>
                                                </label>
                                                <select class="form-control mb-4" name="s_nominal">
                                                    <option value="semua_nominal">Semua Nominal</option>
                                                    <?php combo_database_v2("data_nominal", "id_nominal", "nominal", ""); ?>
                                                </select>

                                                <button class="btn btn-primary mb-2 w-100">Filter</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } elseif ($_GET['input'] == "penjualan") {
                            ?>
                                <div class="rounded border border-dashed border-gray-300 py-4 px-6 mb-2">
                                    <div class="row mb-12">
                                        <div class="col-md-12 fv-row">
                                            <form action="">
                                                <input name="input" value="penjualan" type="hidden">

                                                <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                    <span class="required">Bulan</span>
                                                </label>
                                                <select class="form-control mb-4" name="s_bulan">
                                                    <option value="">Pilih Bulan</option>
                                                    <?php foreach ($months as $key => $month): ?>
                                                        <option value="<?= $key ?>" <?= $request_bulan->getValue() == $key ? 'selected' : '' ?>><?= $month ?></option>
                                                    <?php endforeach; ?>
                                                </select>

                                                <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                    <span class="required">Tahun</span>
                                                </label>
                                                <select class="form-control mb-4" name="s_tahun">
                                                    <option value="">Pilih Tahun</option>
                                                    <?php for ($year = $currentYear; $year >= $startYear; $year--): ?>
                                                        <option value="<?= $year ?>" <?= $request_tahun->getValue() == $year ? 'selected' : '' ?>><?= $year ?></option>
                                                    <?php endfor; ?>
                                                </select>

                                                <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                    <span class="required">Nominal</span>
                                                </label>
                                                <select class="form-control mb-4" name="s_nominal">
                                                    <option value="semua_nominal">Semua Nominal</option>
                                                    <?php combo_database_v2("data_nominal", "id_nominal", "nominal", ""); ?>
                                                </select>

                                                <button class="btn btn-primary mb-2 w-100">Filter</button>

                                                <a href="../data_voucher/?input=penjualan" class="btn btn-secondary mb-2 w-50">Clear Pencarian</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } elseif ($_GET['input'] == "transaksi") {
                            ?>
                                <div class="rounded border border-dashed border-gray-300 py-4 px-6 mb-2">
                                    <div class="row mb-12">
                                        <div class="col-md-12 fv-row">
                                            <form>
                                                <?php echo createHiddenFieldsFromGetExclude(['s_status', 's_tahun', 's_bulan', 'page', 's_jenis_bbm', 's_kategori_member']); ?>

                                                <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                    <span class="required">Tanggal Awal</span>
                                                </label>

                                                <input class="form-control mb-4" type="date" name="s_start_date"
                                                    value="<?= $request_start_date->isValid() ? $request_start_date->getValue() : '' ?>">

                                                <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                    <span class="required">Tanggal Akhir</span>
                                                </label>

                                                <input class="form-control mb-4" type="date" name="s_end_date"
                                                    value="<?= $request_end_date->isValid() ? $request_end_date->getValue() : '' ?>">

                                                <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                    <span>Jenis BBM</span>
                                                </label>
                                                <select class="form-control mb-4" name="s_jenis_bbm">
                                                    <option value="">Semua </option>
                                                    <?php

                                                    $jenis_bbm = QB::table("data_jenis_transaksi")
                                                        ->setFetchMode(PDO::FETCH_ASSOC)
                                                        ->get();

                                                    foreach ($jenis_bbm as $jenis) {
                                                        $key = $jenis['id_jenis_transaksi'];
                                                        $value = $jenis['jenis_transaksi'];
                                                    ?>
                                                        <option value="<?= $key ?>" <?= $request_jenis_bbm->getValue() == $key ? 'selected' : '' ?>><?= $value ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>


                                                <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                    <span>Kategori Member</span>
                                                </label>

                                                <input value="member" name="s_kategori_member" type="hidden">




                                                <button class="btn btn-primary mb-2 w-100">Filter</button>
                                                <a href="../data_voucher/?input=transaksi" class="btn btn-secondary mb-2 w-50">Clear Pencarian</a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else if ($_GET['input'] == "grafik") {
                            ?>
                                <div class="rounded border border-dashed border-gray-300 py-4 px-6 mb-2">
                                    <div class="row mb-12">
                                        <div class="col-md-12 fv-row">
                                            <form>
                                                <?php echo createHiddenFieldsFromGetExclude(['s_status', 's_start_date', 's_end_date', 'page']); ?>
                                                <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                    <span class="required">Tanggal awal</span>
                                                </label>
                                                <input class="form-control mb-4" type="date" name="s_start_date"
                                                    value="<?= $request_start_date->isValid() ? $request_start_date->getValue() : '' ?>">

                                                <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                    <span class="required">Tanggal akhir</span>
                                                </label>
                                                <input class="form-control mb-4" type="date" name="s_end_date"
                                                    value="<?= $request_end_date->isValid() ? $request_end_date->getValue() : '' ?>">

                                                <button class="btn btn-primary mb-2 w-100">Filter</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="m-0">
                                    <div class="mx-5">
                                        <div class="mb-12">
                                            <div class="rounded border border-dashed border-gray-300 py-4 px-6 mb-5">
                                                <div class="d-flex flex-stack">
                                                    <div class="d-flex flex-column">
                                                        Fitur Filter & Pencarian tidak tersedia di menu ini
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                            }
                        } else if ($lastFolderName == "grafik") {
                            // if ($_GET['input'] == "grafik_penjualan") {
                                ?>
                                <div class="rounded border border-dashed border-gray-300 py-4 px-6 mb-2">
                                    <div class="row mb-12">
                                        <div class="col-md-12 fv-row">
                                            <form>
                                                <?php
                                                echo createHiddenFieldsFromGetExclude(['s_start_date', 's_end_date', 'page']);
                                                $currentDate = new DateTime();

                                                $dari = $request_start_date->isValid() ? $request_start_date->getValue() : $currentDate->modify('first day of this month')->format('Y-m-d');
                                                $sampai = $request_end_date->isValid() ? $request_end_date->getValue() : $currentDate->modify('last day of this month')->format('Y-m-d');

                                                ?>
                                                <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                    <span class="required">Tanggal awal</span>
                                                </label>
                                                <input class="form-control mb-4" type="date" name="s_start_date"
                                                    value="<?= $request_start_date->isValid() ? $request_start_date->getValue() : $dari ?>">

                                                <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                    <span class="required">Tanggal sampai</span>
                                                </label>
                                                <input class="form-control mb-4" type="date" name="s_end_date"
                                                    value="<?= $request_end_date->isValid() ? $request_end_date->getValue() : $sampai ?>">


                                                <button class="btn btn-primary mb-2 w-100">Filter</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            <?php
                            // }
                        } else {
                            ?>
                                <div class="m-0">

                                    <div class="mx-5">



                                        <div class="mb-12">
                                            <div class="rounded border border-dashed border-gray-300 py-4 px-6 mb-5">
                                                <div class="d-flex flex-stack">
                                                    <div class="d-flex flex-column">
                                                        Silahkan Pilih Data yang akan di filter <br>dibawah ini terlebih
                                                        dahulu
                                                        <br>

                                                    </div>

                                                </div>
                                            </div>



                                            <div class="d-flex align-items-center mb-7">

                                                <div class="symbol symbol-50px me-5">
                                                    <span class="symbol-label bg-light-success">

                                                        <span class="svg-icon svg-icon-2x svg-icon-success">
                                                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Shopping/Barcode-read.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <title>Stockholm-icons / Shopping / Barcode-read</title>
                                                                    <desc>Created with Sketch.</desc>
                                                                    <defs></defs>
                                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                                        <rect fill="#000000" opacity="0.3" x="4" y="4" width="8" height="16"></rect>
                                                                        <path d="M6,18 L9,18 C9.66666667,18.1143819 10,18.4477153 10,19 C10,19.5522847 9.66666667,19.8856181 9,20 L4,20 L4,15 C4,14.3333333 4.33333333,14 5,14 C5.66666667,14 6,14.3333333 6,15 L6,18 Z M18,18 L18,15 C18.1143819,14.3333333 18.4477153,14 19,14 C19.5522847,14 19.8856181,14.3333333 20,15 L20,20 L15,20 C14.3333333,20 14,19.6666667 14,19 C14,18.3333333 14.3333333,18 15,18 L18,18 Z M18,6 L15,6 C14.3333333,5.88561808 14,5.55228475 14,5 C14,4.44771525 14.3333333,4.11438192 15,4 L20,4 L20,9 C20,9.66666667 19.6666667,10 19,10 C18.3333333,10 18,9.66666667 18,9 L18,6 Z M6,6 L6,9 C5.88561808,9.66666667 5.55228475,10 5,10 C4.44771525,10 4.11438192,9.66666667 4,9 L4,4 L9,4 C9.66666667,4 10,4.33333333 10,5 C10,5.66666667 9.66666667,6 9,6 L6,6 Z" fill="#000000" fill-rule="nonzero"></path>
                                                                    </g>
                                                                </svg><!--end::Svg Icon--></span>
                                                        </span>

                                                    </span>
                                                </div>


                                                <div class="d-flex flex-column">
                                                    <a href="../data_voucher/?input=list"
                                                        class="text-gray-800 text-hover-primary fs-6 fw-bold">E-Voucher</a>
                                                    <span class="text-muted fw-bold">Informasi Voucher</span>
                                                </div>

                                            </div>


                                            <div class="d-flex align-items-center mb-7">

                                                <div class="symbol symbol-50px me-5">
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
                                                </div>


                                                <div class="d-flex flex-column">
                                                    <a href="../data_voucher/?input=relasi"
                                                        class="text-gray-800 text-hover-primary fs-6 fw-bold">Penjualan </a>
                                                    <span class="text-muted fw-bold">Penjualan E-Voucher</span>
                                                </div>

                                            </div>




                                            <div class="d-flex align-items-center mb-7">

                                                <div class="symbol symbol-50px me-5">
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
                                                </div>


                                                <div class="d-flex flex-column">
                                                    <a href="../data_voucher/?input=report"
                                                        class="text-gray-800 text-hover-primary fs-6 fw-bold">Transaksi</a>
                                                    <span class="text-muted fw-bold">Transaksi E-Voucher</span>
                                                </div>

                                            </div>


                                            <div class="d-flex align-items-center mb-7">

                                                <div class="symbol symbol-50px me-5">
                                                    <span class="symbol-label bg-light-danger">

                                                        <span class="symbol-label bg-light-success">

                                                            <span class="svg-icon svg-icon-2x svg-icon-primary">
                                                                <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Shopping/Chart-bar1.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                        <title>Stockholm-icons / Shopping / Chart-bar1</title>
                                                                        <desc>Created with Sketch.</desc>
                                                                        <defs></defs>
                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                            <rect x="0" y="0" width="24" height="24"></rect>
                                                                            <rect fill="#000000" opacity="0.3" x="12" y="4" width="3" height="13" rx="1.5"></rect>
                                                                            <rect fill="#000000" opacity="0.3" x="7" y="9" width="3" height="8" rx="1.5"></rect>
                                                                            <path d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z" fill="#000000" fill-rule="nonzero"></path>
                                                                            <rect fill="#000000" opacity="0.3" x="17" y="11" width="3" height="6" rx="1.5"></rect>
                                                                        </g>
                                                                    </svg><!--end::Svg Icon--></span>
                                                            </span>

                                                        </span>

                                                    </span>
                                                </div>


                                                <div class="d-flex flex-column">
                                                    <a href="../data_voucher/?input=grafik"
                                                        class="text-gray-800 text-hover-primary fs-6 fw-bold">Grafik
                                                        E-Voucher</a>
                                                    <span class="text-muted fw-bold">Penjualan &amp; Transaksi</span>
                                                </div>

                                            </div>






                                        </div>

                                    </div>

                                </div>
                            <?php
                        } ?>



                                </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="modal fade" id="kt_modal_invite_friends" tabindex="-1" aria-hidden="true">

            <div class="modal-dialog mw-650px">

                <div class="modal-content">

                    <div class="modal-header pb-0 border-0 justify-content-end">

                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal"
                            onclick="window.location.href=''">

                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                        transform="rotate(-45 6 17.3137)" fill="black" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                        transform="rotate(45 7.41422 6)" fill="black" />
                                </svg>
                            </span>

                        </div>

                    </div>


                    <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">

                        <div class="text-center mb-3">

                            <h1 class="mb-3">Scan QRCODE</h1>


                            <div class="text-muted fw-bold fs-5">Silahkan Input Manual Nomor Voucher atau Scan Qrcode
                                otomatis dengan kamera </div>

                        </div>


                        <!-- Tombol "Input Nomor Voucher" -->
                        <div class="btn btn-light-primary fw-bolder w-100 mb-8" id="inputVoucherBtn">
                            <span class="svg-icon svg-icon-2 svg-icon-primary me-0 me-md-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                        transform="rotate(-90 11.364 20.364)" fill="black"></rect>
                                    <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black"></rect>
                                </svg>
                            </span>Input Nomor Voucher Manual
                        </div>







                        <div class="separator d-flex flex-center mb-2">
                            <span class="text-uppercase bg-body fs-7 fw-bold text-muted px-3">or</span>
                        </div>



                        <center>


                            <video id="previewKamera" style="width: 300px;height: 300px;" autoplay="true" muted="true"
                                playsinline="true"></video>
                        </center>

                        <input type="hidden" id="hasilscan">


                        <div class="d-flex flex-stack">

                            <div class="me-5 fw-bold">
                                <label class="fs-6">Pilih dan klik select device untuk mengubah kamera</label>
                                <div class="fs-7 text-muted"><select id="pilihKamera" style="max-width:400px">
                                    </select></div>
                            </div>


                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <button id="play" class="btn btn-sm btn-light btn-active-primary">
                                    Select Device
                                </button>
                            </label>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- Modal untuk Input Nomor Voucher -->
        <div class="modal fade" id="modalInputVoucher" tabindex="-1" aria-labelledby="modalInputVoucherLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalInputVoucherLabel">Input Nomor Voucher</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" id="inputVoucher" placeholder="Masukkan nomor voucher">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" id="submitVoucher">Kirim</button>
                    </div>
                </div>
            </div>
        </div>



        <?php if ($lastFolderName == "home") { ?>
            <script>
                // Ketika tombol "Input Nomor Voucher Manual" diklik, tampilkan modal
                document.getElementById('inputVoucherBtn').addEventListener('click', function() {
                    var modal = new bootstrap.Modal(document.getElementById('modalInputVoucher'));
                    modal.show();
                });

                // Ketika tombol "Kirim" pada modal diklik, lakukan redirect
                document.getElementById('submitVoucher').addEventListener('click', function() {
                    var voucherCode = document.getElementById('inputVoucher').value;
                    if (voucherCode) {
                        // Redirect ke URL dengan nomor voucher
                        window.location.href = '../data_voucher/?input=manual&proses=' + encodeURIComponent(voucherCode);
                    } else {
                        alert('Anda harus memasukkan nomor voucher!');
                    }
                });
            </script>




            <script type="text/javascript" src="<?php echo $url; ?>zxing.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"
                integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

            <script>
                let selectedDeviceId = null;
                const codeReader = new ZXing.BrowserMultiFormatReader();
                const sourceSelect = $("#pilihKamera");

                $(document).on('change', '#pilihKamera', function() {
                    selectedDeviceId = $(this).val();
                    if (codeReader) {
                        codeReader.reset()
                    }
                })

                $('#play').on('click', function() {
                    initScanner();


                });

                $('#bukaKamera').on('click', function() {
                    initScanner();

                });

                function initScanner() {

                    // document.getElementById('cameraPlaceholder').style.display = 'none';
                    codeReader
                        .listVideoInputDevices()
                        .then(videoInputDevices => {
                            videoInputDevices.forEach(device =>
                                console.log(`${device.label}, ${device.deviceId}`)
                            );

                            if (videoInputDevices.length > 0) {

                                if (selectedDeviceId == null) {


                                    if (videoInputDevices.length > 1) {
                                        selectedDeviceId = videoInputDevices[0].deviceId
                                    } else {
                                        selectedDeviceId = videoInputDevices[0].deviceId
                                    }
                                }

                                if (videoInputDevices.length >= 1) {
                                    sourceSelect.html('');
                                    videoInputDevices.forEach((element) => {
                                        const sourceOption = document.createElement('option')
                                        sourceOption.text = element.label
                                        sourceOption.value = element.deviceId
                                        if (element.deviceId == selectedDeviceId) {
                                            sourceOption.selected = 'selected';

                                        }
                                        sourceSelect.append(sourceOption)

                                    })
                                }

                                codeReader
                                    .decodeOnceFromVideoDevice(selectedDeviceId, 'previewKamera')
                                    .then(result => {
                                        //hasil scan
                                        console.log(result.text)
                                        $("#hasilscan").val(result.text);

                                        // if (codeReader) {
                                        //     codeReader.reset()
                                        // }

                                        window.location.href = '../data_voucher/?input=manual&qrcode=' + result.text;
                                    })
                                    .catch(err => console.error(err));

                            } else {
                              //  alert("Camera not found!")
                            }
                        })
                        .catch(err => console.error(err));
                }

                if (!navigator.mediaDevices) {
                  //  alert('Cannot access camera.');
                }
            </script>
        <?php } ?>


        <div class="modal fade" id="buat_e_voucher" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-900px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Penjualan E-Voucher</h2>
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                        transform="rotate(-45 6 17.3137)" fill="black" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                        transform="rotate(45 7.41422 6)" fill="black" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="modal-body py-lg-10 px-lg-10">
                        <div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid"
                            id="buat_e_voucher_stepper">
                            <div
                                class="d-flex justify-content-center justify-content-xl-start flex-row-auto w-100 w-xl-300px">
                                <div class="stepper-nav ps-lg-10">
                                    <div class="stepper-item current" data-kt-stepper-element="nav">
                                        <div class="stepper-line w-40px"></div>
                                        <div class="stepper-icon w-40px h-40px">
                                            <i class="stepper-check fas fa-check"></i>
                                            <span class="stepper-number">1</span>
                                        </div>
                                        <div class="stepper-label">
                                            <h3 class="stepper-title">Relasi</h3>
                                            <div class="stepper-desc">Piih Nama Relasi</div>
                                        </div>
                                    </div>
                                    <div class="stepper-item" data-kt-stepper-element="nav">
                                        <div class="stepper-line w-40px"></div>
                                        <div class="stepper-icon w-40px h-40px">
                                            <i class="stepper-check fas fa-check"></i>
                                            <span class="stepper-number">2</span>
                                        </div>
                                        <div class="stepper-label">
                                            <h3 class="stepper-title">Form</h3>
                                            <div class="stepper-desc">Deskripsi E-Voucher</div>
                                        </div>
                                    </div>
                                    <div class="stepper-item" data-kt-stepper-element="nav">
                                        <div class="stepper-line w-40px"></div>
                                        <div class="stepper-icon w-40px h-40px">
                                            <i class="stepper-check fas fa-check"></i>
                                            <span class="stepper-number">3</span>
                                        </div>
                                        <div class="stepper-label">
                                            <h3 class="stepper-title">Invoice</h3>
                                            <div class="stepper-desc">Preview Invoice</div>
                                        </div>
                                    </div>

                                    <div class="stepper-item" data-kt-stepper-element="nav">
                                        <div class="stepper-line w-40px"></div>
                                        <div class="stepper-icon w-40px h-40px">
                                            <i class="stepper-check fas fa-check"></i>
                                            <span class="stepper-number">5</span>
                                        </div>
                                        <div class="stepper-label">
                                            <h3 class="stepper-title">Generate </h3>
                                            <div class="stepper-desc">Pembuatan E-Voucher & Invoice</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-row-fluid py-lg-0 px-lg-15">


                                <form class="form" method="GET" id="buat_e_voucher_form"
                                    action="../data_voucher/index.php">




                                    <div class="current" data-kt-stepper-element="content">
                                        <div class="w-100">
                                            <div class="fv-row mb-10">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                    <span>Pencarian:</span>
                                                </label>
                                                <input name="input" value="generate" type="hidden">
                                                <div class="input-group">
                                                    <input type="text" class="form-control form-control-lg form-control-solid" name="pencarian" id="pencarian" placeholder="" value="" />
                                                    <a href="../data_relasi/index.php?input=tambah" class="btn btn-primary" type="button" id="tambahRelasiBaru">Tambah Relasi Baru</a>
                                                </div>
                                                <input type="hidden" name="id_relasi" id="id_relasi_simpan" value="" />
                                            </div>


                                            <div class="fv-row">
                                                <label class="d-flex align-items-center fs-5 fw-bold mb-4">
                                                    <span class="">List Relasi </span>
                                                </label>
                                                <div class="fv-row">
                                                    <div id="relasi-list" class="mh-300px scroll-y me-n7 pe-7"
                                                        style="height:300px">
                                                        <!-- List items will be updated here via JavaScript -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                    <div data-kt-stepper-element="content">
                                        <div class="w-100">




                                            <div class="row mb-12">

                                                <div class="col-md-12 fv-row">

                                                    <label
                                                        class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                        <span class="required">Nama Relasi</span>
                                                        <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                            data-bs-toggle="tooltip"
                                                            title="Nama Relasi Diisi otomatis dari inputan sebelumnya"></i>
                                                    </label>

                                                    <input readonly type="text" class="form-control form-control-solid"
                                                        placeholder="" name="nama_relasi" id="nama_relasi" value="" />




                                                </div>




                                            </div>





                                            <div class="row mb-10">

                                                <div class="col-md-6 fv-row">
                                                    <label
                                                        class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                        <span class="required">Nominal </span>
                                                    </label>
                                                    <div class="position-relative">
                                                        <select name="nominal" id="nominal"
                                                            class="form-select form-select-solid" data-control="select2"
                                                            data-hide-search="true" data-placeholder="Nominal"
                                                            onchange="updateNominalView()">
                                                            <option></option>
                <?php
                $querytabel_nomonal = "SELECT * FROM data_nominal ";
                $proses_nomonal = mysql_query($querytabel_nomonal);
                while ($data_nomonal = mysql_fetch_array($proses_nomonal)) { ?>
            <option value="<?php echo $data_nomonal['nominal'];?>"><?php echo rupiah($data_nomonal['nominal']);?></option>
                <?php } ?>
                                                    
                                                        </select>
                                                    </div>

                                                </div>


                                                <div class="col-md-6 fv-row">

                                                    <label
                                                        class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                        <span class="required">Jumlah </span>

                                                    </label>


                                                    <div class="position-relative">

                                                        <input type="number" class="form-control form-control-solid"
                                                            min="1" value="1" max="1000" placeholder="jumlah"
                                                            name="jumlah_voucher" id="jumlah_voucher"
                                                            oninput="updateJumlahView()" />
                                                    </div>

                                                </div>

                                            </div>


                                            <div class="row mb-10">

                                                <div class="col-md-6 fv-row">

                                                    <label class="required fs-6 fw-bold form-label mb-2">Tanggal
                                                        Dibuka</label>
                                                    <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                        data-bs-toggle="tooltip"
                                                        title="secara default tanggal dibuka diisi tanggal transaksi hari ini"></i>


                                                    <div class="row fv-row">

                                                        <div class="col-12">
                                                            <input type="date" class="form-control form-control-solid"
                                                                name="tanggal_dibuka"
                                                                value="<?php echo date('Y-m-d'); ?>"
                                                                data-placeholder="Tanggal Dibuka">

                                                        </div>



                                                    </div>

                                                </div>


                                                <div class="col-md-6 fv-row">

                                                    <label class="required fs-6 fw-bold form-label mb-2">Tanggal
                                                        Kadaluarsa</label>
                                                    <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                        data-bs-toggle="tooltip"
                                                        title="secara default kadaluarsa <?php echo $kadaluarsa_voucher; ?> bulan dari saat transaksi hari ini"></i>


                                                    <div class="row fv-row">

                                                        <div class="col-12">
                                                            <input type="date" class="form-control form-control-solid"
                                                                name="tanggal_kadaluarsa"
                                                                value="<?php echo kadaluarsa($kadaluarsa_voucher); ?>"
                                                                data-placeholder="Tanggal kadaluarsa">

                                                        </div>



                                                    </div>

                                                </div>

                                            </div>


                                            <div class="row mb-10">

                                                <div class="col-md-6 fv-row">


                                                    <label
                                                        class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                        <span class="required">SPBU</span>

                                                    </label>


                                                    <div class="position-relative">

                                                        <select class="form-select form-select-solid" data-control="select2"
                                                            data-hide-search="true" data-placeholder="SPBU"
                                                            name="spbu[]">
                                                            <option></option>
                                                            <?php
                                                            $querytabel = "SELECT * FROM data_spbu ";
                                                            $proses = mysql_query($querytabel);
                                                            while ($data = mysql_fetch_array($proses)) {
                                                            ?>
                                                                <option value="<?php echo $data['id_spbu']; ?>">
                                                                    <?php echo $data['nama_spbu']; ?>
                                                                </option>
                                                            <?php } ?>

                                                        </select>

                                                    </div>





                                                </div>

                                                <style>
                                                    .position-relative {
                                                        position: relative;
                                                    }

                                                    .password-toggle {
                                                        position: absolute;
                                                        right: 10px;
                                                        top: 50%;
                                                        transform: translateY(-50%);
                                                        cursor: pointer;
                                                        color: #6c757d;
                                                        /* Optional: Set icon color */
                                                    }

                                                    .password-toggle:hover {
                                                        color: #495057;
                                                        /* Optional: Set icon hover color */
                                                    }
                                                </style>
                                                <div class="col-md-6 fv-row">
                                                    <label
                                                        class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                                        <span class="required">Password </span>
                                                        <i class="fas fa-exclamation-circle ms-2 fs-7"
                                                            data-bs-toggle="tooltip"
                                                            title="Secara default password diisi otomatis dari inputan data relasi saat pendaftaran"></i>
                                                    </label>

                                                    <div class="position-relative">
                                                        <input type="password" class="form-control form-control-solid"
                                                            placeholder="password_relasi" name="Password"
                                                            id="password_relasi" />
                                                        <span class="password-toggle"
                                                            onclick="togglePasswordVisibility()">
                                                            <i class="fas fa-eye" id="toggleIcon"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <script>
                                                    function togglePasswordVisibility() {
                                                        const passwordInput = document.getElementById('password_relasi');
                                                        const toggleIcon = document.getElementById('toggleIcon');

                                                        if (passwordInput.type === 'password') {
                                                            passwordInput.type = 'text';
                                                            toggleIcon.classList.remove('fa-eye');
                                                            toggleIcon.classList.add('fa-eye-slash');
                                                        } else {
                                                            passwordInput.type = 'password';
                                                            toggleIcon.classList.remove('fa-eye-slash');
                                                            toggleIcon.classList.add('fa-eye');
                                                        }
                                                    }
                                                </script>


                                            </div>

                                        </div>
                                    </div>

                                    <div data-kt-stepper-element="content">
                                        <div class="w-100">
                                            <div class="fv-row">



                                                <div
                                                    class="rounded border border-dashed border-gray-300 py-4 px-6 mb-5">
                                                    <div class="">
                                                        <div class="d-flex flex-column">

                                                            <div class="m-0">
                                                                <!--begin::Label-->
                                                                <div class="fw-bold fs-3 text-gray-800 mb-8">Invoice
                                                                    #<?php echo $no_invoice = date('Ymdhis'); ?>
                                                                    <input name="nomor_invoice" type="hidden"
                                                                        value="<?php echo $no_invoice; ?>">
                                                                </div>
                                                                <!--end::Label-->

                                                                <!--begin::Row-->
                                                                <div class="row g-5 mb-2">
                                                                    <!--end::Col-->
                                                                    <div class="col-sm-6">
                                                                        <!--end::Label-->
                                                                        <div
                                                                            class="fw-semibold fs-7 text-gray-600 mb-1">
                                                                            Nama Relasi:</div>
                                                                        <!--end::Label-->

                                                                        <!--end::Col-->
                                                                        <div class="fw-bold fs-6 text-gray-800">
                                                                            <p id="nama_relasi_view">~</p>
                                                                        </div>
                                                                        <!--end::Col-->
                                                                    </div>
                                                                    <!--end::Col-->

                                                                    <!--end::Col-->
                                                                    <div class="col-sm-6">
                                                                        <!--end::Label-->
                                                                        <div
                                                                            class="fw-semibold fs-7 text-gray-600 mb-1">
                                                                            Tanggal:</div>
                                                                        <!--end::Label-->

                                                                        <!--end::Info-->
                                                                        <div
                                                                            class="fw-bold fs-6 text-gray-800 d-flex align-items-center flex-wrap">
                                                                            <span
                                                                                class="pe-2"><?php echo format_indo(date('Y-m-d')); ?></span>


                                                                        </div>
                                                                        <!--end::Info-->
                                                                    </div>
                                                                    <!--end::Col-->
                                                                </div>
                                                                <!--end::Row-->



                                                                <!--begin::Content-->
                                                                <div class="flex-grow-1">
                                                                    <!--begin::Table-->
                                                                    <div class="table-responsive border-bottom mb-4">
                                                                        <table class="table mb-3">
                                                                            <thead>
                                                                                <tr
                                                                                    class="border-bottom fs-6 fw-bold text-muted">
                                                                                    <th class="min-w-70px pb-2">
                                                                                        Description</th>
                                                                                    <th
                                                                                        class="min-w-70px text-end pb-2">
                                                                                        Harga</th>
                                                                                    <th
                                                                                        class="min-w-70px text-end pb-2">
                                                                                        Jumlah</th>
                                                                                    <th
                                                                                        class="min-w-100px text-end pb-2">
                                                                                        Sub Total</th>
                                                                                </tr>
                                                                            </thead>

                                                                            <tbody>
                                                                                <tr
                                                                                    class="fw-bold text-gray-700 fs-5 text-end">
                                                                                    <td
                                                                                        class="d-flex align-items-center pt-6">
                                                                                        <i
                                                                                            class="fa fa-genderless text-danger fs-2 me-2"></i>

                                                                                        E-Voucher
                                                                                    </td>
                                                                                    <td class="pt-6">
                                                                                        <p id="nominal_view">~</p>
                                                                                    </td>
                                                                                    <td class="pt-6">
                                                                                        <p id="jumlah_view">1</p>
                                                                                    </td>

                                                                                    <td
                                                                                        class="pt-6 text-gray-900 fw-bolder">
                                                                                        <p id="sub_total_view">~</p>
                                                                                    </td>
                                                                                </tr>


                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <!--end::Table-->

                                                                    <!--begin::Container-->
                                                                    <div class="d-flex justify-content-end">
                                                                        <!--begin::Section-->
                                                                        <div class="mw-300px">
                                                                            <!--begin::Item-->
                                                                            <div class="d-flex flex-stack mb-3">
                                                                                <!--begin::Accountname-->
                                                                                <div
                                                                                    class="fw-semibold pe-10 text-gray-600 fs-7">
                                                                                    <p id="z">Sub Total</p>
                                                                                </div>
                                                                                <!--end::Accountname-->

                                                                                <!--begin::Label-->
                                                                                <div
                                                                                    class="text-end fw-bold fs-6 text-gray-800">
                                                                                    <p id="sub_total_view2">~</p>
                                                                                </div>
                                                                                <!--end::Label-->
                                                                            </div>
                                                                            <!--end::Item-->

                                                                            <!--begin::Item-->
                                                                            <div class="d-flex flex-stack mb-3" style="<?= $ppn > 0 ? 'display:block' : 'display:none !important'; ?>">
                                                                                <!--begin::Accountname-->
                                                                                <div
                                                                                    class="fw-semibold pe-10 text-gray-600 fs-7">
                                                                                    <p id="ppn_persen">~</p>
                                                                                </div>
                                                                                <!--end::Accountname-->

                                                                                <!--begin::Label-->
                                                                                <div
                                                                                    class="text-end fw-bold fs-6 text-gray-800">
                                                                                    <p id="ppn">~</p>
                                                                                </div>
                                                                                <!--end::Label-->
                                                                            </div>
                                                                            <!--end::Item-->

                                                                            <!--begin::Item-->
                                                                            <div class="d-flex flex-stack mb-3">
                                                                                <!--begin::Accountnumber-->
                                                                                <div
                                                                                    class="fw-semibold pe-10 text-gray-600 fs-7">
                                                                                    <p id="x">Total Bayar</p>
                                                                                </div>
                                                                                <!--end::Accountnumber-->

                                                                                <!--begin::Number-->
                                                                                <div
                                                                                    class="text-end fw-bold fs-6 text-gray-800">
                                                                                    <p id="total_view">~</p>
                                                                                </div>
                                                                                <!--end::Number-->
                                                                            </div>
                                                                            <!--end::Item-->


                                                                        </div>
                                                                        <!--end::Section-->
                                                                    </div>
                                                                    <!--end::Container-->
                                                                </div>
                                                                <!--end::Content-->
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>




                                            </div>

                                        </div>
                                    </div>

                                    <div data-kt-stepper-element="content">
                                        <div class="w-100 text-center">

                                            <h1 class="fw-bolder text-dark mb-3">Generate!</h1>


                                            <div class="text-muted fw-bold fs-3">Klik submit untuk proses pembuatan
                                                E-Voucher dan penerbitan invoice penjualan .</div>


                                            <div class="text-center px-1 py-2">
                                                <img src="<?php echo $url; ?>assets/media/illustrations/sigma-1/4.png"
                                                    alt="" class="w-50 mh-300px" />
                                            </div>

                                        </div>
                                    </div>

                                    <div class="d-flex flex-stack pt-10">

                                        <div class="me-2">
                                            <button type="button" class="btn btn-lg btn-light-primary me-3"
                                                data-kt-stepper-action="previous">

                                                <span class="svg-icon svg-icon-3 me-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1"
                                                            fill="black" />
                                                        <path
                                                            d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z"
                                                            fill="black" />
                                                    </svg>
                                                </span>
                                                Back</button>
                                        </div>


                                        <div>
                                            <button type="button" class="btn btn-lg btn-primary"
                                                data-kt-stepper-action="submit">
                                                <span class="indicator-label">Submit

                                                    <span class="svg-icon svg-icon-3 ms-2 me-0">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.5" x="18" y="13" width="13" height="2"
                                                                rx="1" transform="rotate(-180 18 13)" fill="black" />
                                                            <path
                                                                d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                                fill="black" />
                                                        </svg>
                                                    </span>
                                                </span>
                                                <span class="indicator-progress">Please wait...
                                                    <span
                                                        class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                            <button type="button" class="btn btn-lg btn-primary"
                                                data-kt-stepper-action="next">Continue

                                                <span class="svg-icon svg-icon-3 ms-1 me-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1"
                                                            transform="rotate(-180 18 13)" fill="black" />
                                                        <path
                                                            d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                            fill="black" />
                                                    </svg>
                                                </span>
                                            </button>
                                        </div>

                                    </div>




                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function updateNominalView() {
                const nominalSelect = document.getElementById('nominal');
                const nominalView = document.getElementById('nominal_view');
                const selectedOption = nominalSelect.options[nominalSelect.selectedIndex];

                nominalView.textContent = selectedOption.value ? selectedOption.text : '~';

                // Recalculate the subtotal whenever nominal changes
                calculateSubtotal();
            }

            function updateJumlahView() {
                const jumlahInput = document.getElementById('jumlah_voucher');
                const jumlahView = document.getElementById('jumlah_view');

                jumlahView.textContent = jumlahInput.value || '~';

                // Recalculate the subtotal whenever quantity changes
                calculateSubtotal();
            }

            function calculateSubtotal() {
                const ppn = <?php echo $ppn; ?>;
                const nama_relasi = document.getElementById('nama_relasi');
                const nama_relasi_view = document.getElementById('nama_relasi_view');
                const nominalSelect = document.getElementById('nominal');
                const jumlahInput = document.getElementById('jumlah_voucher');
                const subTotalView = document.getElementById('sub_total_view');
                const subTotalView2 = document.getElementById('sub_total_view2');
                const totalView = document.getElementById('total_view');
                const ppn_persen = document.getElementById('ppn_persen');
                const ppn_view = document.getElementById('ppn');

                // Get the current values
                const nominalValue = parseFloat(nominalSelect.value) || 0;
                const jumlahValue = parseInt(jumlahInput.value) || 0;

                // Calculate the subtotal
                const subTotal = nominalValue * jumlahValue;
                const ppnsubtotal = subTotal * ppn / 100;
                const total = subTotal + ppnsubtotal;


                nama_relasi_view.textContent = nama_relasi.value;
                ppn_persen.textContent = "PPN " + ppn + "%";
                ppn_view.textContent = ppnsubtotal > 0 ? `Rp${ppnsubtotal.toLocaleString()}` : '~';
                subTotalView.textContent = subTotal > 0 ? `Rp${subTotal.toLocaleString()}` : '~';
                subTotalView2.textContent = subTotal > 0 ? `Rp${subTotal.toLocaleString()}` : '~';
                totalView.textContent = total > 0 ? `Rp${total.toLocaleString()}` : '~';

            }
        </script>






        <script>
            // Function to fetch and update the list
            function fetchAndDisplayResults(query = '') {
                // Send an AJAX request to the server
                const xhr = new XMLHttpRequest();
                xhr.open('GET', '<?php echo $url; ?>search.php?query=' + encodeURIComponent(query), true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        const results = JSON.parse(xhr.responseText);
                        const relasiList = document.getElementById('relasi-list');
                        relasiList.innerHTML = ''; // Clear the current list

                        // Append new results
                        results.forEach(data => {
                            const listItem = document.createElement('div');
                            listItem.classList.add('relasi-item', 'd-flex', 'flex-stack', 'py-3', 'border-bottom', 'border-gray-300', 'border-bottom-dashed');

                            listItem.innerHTML = `
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-35px symbol-circle">
                               <span class="svg-icon svg-icon-primary svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="black"></path>
                            <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="black"></path>
                          </svg></span>
                            </div>
                            <div class="ms-8">
                                <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">${data.nama}</a>
                                <div class="fw-bold text-muted">${data.email}</div>
                            </div>
                        </div>
                        <div class="ms-2 w-40px">
                            <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                <span class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input relasi-radio" type="radio" name="relasi" data-id-relasi="${data.id_relasi}" data-nama-relasi="${data.nama}" data-password-relasi="${data.password}"  />
                                </span>
                            </a>
                        </div>
                    `;

                            relasiList.appendChild(listItem);
                        });



                        // Attach event listeners to each radio button
                        const radioButtons = document.querySelectorAll('.relasi-radio');
                        radioButtons.forEach(radio => {
                            radio.addEventListener('click', function() {

                                const idRelasiInput = document.getElementById('id_relasi_simpan');
                                const namaRelasiInput = document.getElementById('nama_relasi');
                                const passwordRelasiInput = document.getElementById('password_relasi');
                                idRelasiInput.value = this.dataset.idRelasi;
                                namaRelasiInput.value = this.dataset.namaRelasi;
                                passwordRelasiInput.value = this.dataset.passwordRelasi;


                                const nama_relasi_view = document.getElementById('nama_relasi_view');
                                nama_relasi_view.textContent = namaRelasiInput.value;
                            });
                        });


                    }
                };
                xhr.send();
            }

            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('pencarian');

                // Fetch the default list on page load
                fetchAndDisplayResults();

                searchInput.addEventListener('input', function() {
                    const searchTerm = searchInput.value;
                    fetchAndDisplayResults(searchTerm);
                });
            });
        </script>


        <div class="modal fade" id="kt_modal_upgrade_plan" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content rounded">
                    <div class="modal-header justify-content-end border-0 pb-0">
                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                        transform="rotate(-45 6 17.3137)" fill="black" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                        transform="rotate(45 7.41422 6)" fill="black" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="modal-body pt-0 pb-15 px-5 px-xl-20">
                        <div class="mb-13 text-center">
                            <h1 class="mb-3">Upgrade a Plan</h1>
                            <div class="text-muted fw-bold fs-5">If you need more info, please check
                                <a href="#" class="link-primary fw-bolder">Pricing Guidelines</a>.
                            </div>
                        </div>


                        <div class="d-flex flex-column">

                            <div class="nav-group nav-group-outline mx-auto" data-kt-buttons="true">
                                <a href="#"
                                    class="btn btn-color-gray-400 btn-active btn-active-secondary px-6 py-3 me-2 active"
                                    data-kt-plan="month">Monthly</a>
                                <a href="#" class="btn btn-color-gray-400 btn-active btn-active-secondary px-6 py-3"
                                    data-kt-plan="annual">Annual</a>
                            </div>


                            <div class="row mt-10">

                                <div class="col-lg-6 mb-10 mb-lg-0">

                                    <div class="nav flex-column">

                                        <div class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 active mb-6"
                                            data-bs-toggle="tab" data-bs-target="#kt_upgrade_plan_startup">

                                            <div class="d-flex align-items-center me-2">

                                                <div
                                                    class="form-check form-check-custom form-check-solid form-check-success me-6">
                                                    <input class="form-check-input" type="radio" name="plan"
                                                        checked="checked" value="startup" />
                                                </div>


                                                <div class="flex-grow-1">
                                                    <h2 class="d-flex align-items-center fs-2 fw-bolder flex-wrap">
                                                        Startup</h2>
                                                    <div class="fw-bold opacity-50">Best for startups</div>
                                                </div>

                                            </div>


                                            <div class="ms-5">
                                                <span class="mb-2">$</span>
                                                <span class="fs-3x fw-bolder" data-kt-plan-price-month="39"
                                                    data-kt-plan-price-annual="399">39</span>
                                                <span class="fs-7 opacity-50">/
                                                    <span data-kt-element="period">Mon</span></span>
                                            </div>

                                        </div>


                                        <div class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6"
                                            data-bs-toggle="tab" data-bs-target="#kt_upgrade_plan_advanced">

                                            <div class="d-flex align-items-center me-2">

                                                <div
                                                    class="form-check form-check-custom form-check-solid form-check-success me-6">
                                                    <input class="form-check-input" type="radio" name="plan"
                                                        value="advanced" />
                                                </div>


                                                <div class="flex-grow-1">
                                                    <h2 class="d-flex align-items-center fs-2 fw-bolder flex-wrap">
                                                        Advanced</h2>
                                                    <div class="fw-bold opacity-50">Best for 100+ team size</div>
                                                </div>

                                            </div>


                                            <div class="ms-5">
                                                <span class="mb-2">$</span>
                                                <span class="fs-3x fw-bolder" data-kt-plan-price-month="339"
                                                    data-kt-plan-price-annual="3399">339</span>
                                                <span class="fs-7 opacity-50">/
                                                    <span data-kt-element="period">Mon</span></span>
                                            </div>

                                        </div>


                                        <div class="nav-link btn btn-outline btn-outline-dashed btn-color-dark btn-active btn-active-primary d-flex flex-stack text-start p-6 mb-6"
                                            data-bs-toggle="tab" data-bs-target="#kt_upgrade_plan_enterprise">

                                            <div class="d-flex align-items-center me-2">

                                                <div
                                                    class="form-check form-check-custom form-check-solid form-check-success me-6">
                                                    <input class="form-check-input" type="radio" name="plan"
                                                        value="enterprise" />
                                                </div>


                                                <div class="flex-grow-1">
                                                    <h2 class="d-flex align-items-center fs-2 fw-bolder flex-wrap">
                                                        Enterprise
                                                        <span class="badge badge-light-success ms-2 fs-7">Most
                                                            popular</span>
                                                    </h2>
                                                    <div class="fw-bold opacity-50">Best value for 1000+ team</div>
                                                </div>

                                            </div>


                                            <div class="ms-5">
                                                <span class="mb-2">$</span>
                                                <span class="fs-3x fw-bolder" data-kt-plan-price-month="999"
                                                    data-kt-plan-price-annual="9999">999</span>
                                                <span class="fs-7 opacity-50">/
                                                    <span data-kt-element="period">Mon</span></span>
                                            </div>

                                        </div>


                                        <div
                                            class="nav-link btn btn-outline btn-outline-dashed btn-color-dark d-flex flex-stack text-start p-6">

                                            <div class="d-flex align-items-center me-2">

                                                <div
                                                    class="form-check form-check-custom form-check-solid form-check-success me-6">
                                                    <input class="form-check-input" type="radio" name="plan"
                                                        value="custom" />
                                                </div>


                                                <div class="flex-grow-1">
                                                    <h2 class="d-flex align-items-center fs-2 fw-bolder flex-wrap">
                                                        Custom</h2>
                                                    <div class="fw-bold opacity-50">Requet a custom license</div>
                                                </div>

                                            </div>


                                            <div class="ms-5">
                                                <a href="#" class="btn btn-sm btn-primary">Contact Us</a>
                                            </div>

                                        </div>

                                    </div>

                                </div>


                                <div class="col-lg-6">

                                    <div class="tab-content rounded h-100 bg-light p-10">

                                        <div class="tab-pane fade show active" id="kt_upgrade_plan_startup">

                                            <div class="pb-5">
                                                <h2 class="fw-bolder text-dark">What’s in Startup Plan?</h2>
                                                <div class="text-muted fw-bold">Optimal for 10+ team size and new
                                                    startup</div>
                                            </div>


                                            <div class="pt-1">

                                                <div class="d-flex align-items-center mb-7">
                                                    <span class="fw-bold fs-5 text-gray-700 flex-grow-1">Up to 10 Active
                                                        Users</span>

                                                    <span class="svg-icon svg-icon-1 svg-icon-success">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="black" />
                                                            <path
                                                                d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                fill="black" />
                                                        </svg>
                                                    </span>

                                                </div>


                                                <div class="d-flex align-items-center mb-7">
                                                    <span class="fw-bold fs-5 text-gray-700 flex-grow-1">Up to 30
                                                        Project Integrations</span>

                                                    <span class="svg-icon svg-icon-1 svg-icon-success">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="black" />
                                                            <path
                                                                d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                fill="black" />
                                                        </svg>
                                                    </span>

                                                </div>


                                                <div class="d-flex align-items-center mb-7">
                                                    <span class="fw-bold fs-5 text-gray-700 flex-grow-1">Analytics
                                                        Module</span>

                                                    <span class="svg-icon svg-icon-1 svg-icon-success">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="black" />
                                                            <path
                                                                d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                fill="black" />
                                                        </svg>
                                                    </span>
                                                </div>


                                                <div class="d-flex align-items-center mb-7">
                                                    <span class="fw-bold fs-5 text-muted flex-grow-1">Finance
                                                        Module</span>

                                                    <span class="svg-icon svg-icon-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="black" />
                                                            <rect x="7" y="15.3137" width="12" height="2" rx="1"
                                                                transform="rotate(-45 7 15.3137)" fill="black" />
                                                            <rect x="8.41422" y="7" width="12" height="2" rx="1"
                                                                transform="rotate(45 8.41422 7)" fill="black" />
                                                        </svg>
                                                    </span>

                                                </div>


                                                <div class="d-flex align-items-center mb-7">
                                                    <span class="fw-bold fs-5 text-muted flex-grow-1">Accounting
                                                        Module</span>

                                                    <span class="svg-icon svg-icon-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="black" />
                                                            <rect x="7" y="15.3137" width="12" height="2" rx="1"
                                                                transform="rotate(-45 7 15.3137)" fill="black" />
                                                            <rect x="8.41422" y="7" width="12" height="2" rx="1"
                                                                transform="rotate(45 8.41422 7)" fill="black" />
                                                        </svg>
                                                    </span>

                                                </div>


                                                <div class="d-flex align-items-center mb-7">
                                                    <span class="fw-bold fs-5 text-muted flex-grow-1">Network
                                                        Platform</span>

                                                    <span class="svg-icon svg-icon-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="black" />
                                                            <rect x="7" y="15.3137" width="12" height="2" rx="1"
                                                                transform="rotate(-45 7 15.3137)" fill="black" />
                                                            <rect x="8.41422" y="7" width="12" height="2" rx="1"
                                                                transform="rotate(45 8.41422 7)" fill="black" />
                                                        </svg>
                                                    </span>

                                                </div>


                                                <div class="d-flex align-items-center">
                                                    <span class="fw-bold fs-5 text-muted flex-grow-1">Unlimited Cloud
                                                        Space</span>

                                                    <span class="svg-icon svg-icon-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="black" />
                                                            <rect x="7" y="15.3137" width="12" height="2" rx="1"
                                                                transform="rotate(-45 7 15.3137)" fill="black" />
                                                            <rect x="8.41422" y="7" width="12" height="2" rx="1"
                                                                transform="rotate(45 8.41422 7)" fill="black" />
                                                        </svg>
                                                    </span>

                                                </div>

                                            </div>

                                        </div>


                                        <div class="tab-pane fade" id="kt_upgrade_plan_advanced">

                                            <div class="pb-5">
                                                <h2 class="fw-bolder text-dark">What’s in Startup Plan?</h2>
                                                <div class="text-muted fw-bold">Optimal for 100+ team size and grown
                                                    company</div>
                                            </div>


                                            <div class="pt-1">

                                                <div class="d-flex align-items-center mb-7">
                                                    <span class="fw-bold fs-5 text-gray-700 flex-grow-1">Up to 10 Active
                                                        Users</span>

                                                    <span class="svg-icon svg-icon-1 svg-icon-success">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="black" />
                                                            <path
                                                                d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                fill="black" />
                                                        </svg>
                                                    </span>

                                                </div>


                                                <div class="d-flex align-items-center mb-7">
                                                    <span class="fw-bold fs-5 text-gray-700 flex-grow-1">Up to 30
                                                        Project Integrations</span>

                                                    <span class="svg-icon svg-icon-1 svg-icon-success">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="black" />
                                                            <path
                                                                d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                fill="black" />
                                                        </svg>
                                                    </span>

                                                </div>


                                                <div class="d-flex align-items-center mb-7">
                                                    <span class="fw-bold fs-5 text-gray-700 flex-grow-1">Analytics
                                                        Module</span>

                                                    <span class="svg-icon svg-icon-1 svg-icon-success">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="black" />
                                                            <path
                                                                d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                fill="black" />
                                                        </svg>
                                                    </span>

                                                </div>


                                                <div class="d-flex align-items-center mb-7">
                                                    <span class="fw-bold fs-5 text-gray-700 flex-grow-1">Finance
                                                        Module</span>

                                                    <span class="svg-icon svg-icon-1 svg-icon-success">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="black" />
                                                            <path
                                                                d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                fill="black" />
                                                        </svg>
                                                    </span>

                                                </div>


                                                <div class="d-flex align-items-center mb-7">
                                                    <span class="fw-bold fs-5 text-gray-700 flex-grow-1">Accounting
                                                        Module</span>

                                                    <span class="svg-icon svg-icon-1 svg-icon-success">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="black" />
                                                            <path
                                                                d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                fill="black" />
                                                        </svg>
                                                    </span>

                                                </div>


                                                <div class="d-flex align-items-center mb-7">
                                                    <span class="fw-bold fs-5 text-muted flex-grow-1">Network
                                                        Platform</span>

                                                    <span class="svg-icon svg-icon-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="black" />
                                                            <rect x="7" y="15.3137" width="12" height="2" rx="1"
                                                                transform="rotate(-45 7 15.3137)" fill="black" />
                                                            <rect x="8.41422" y="7" width="12" height="2" rx="1"
                                                                transform="rotate(45 8.41422 7)" fill="black" />
                                                        </svg>
                                                    </span>

                                                </div>


                                                <div class="d-flex align-items-center">
                                                    <span class="fw-bold fs-5 text-muted flex-grow-1">Unlimited Cloud
                                                        Space</span>

                                                    <span class="svg-icon svg-icon-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="black" />
                                                            <rect x="7" y="15.3137" width="12" height="2" rx="1"
                                                                transform="rotate(-45 7 15.3137)" fill="black" />
                                                            <rect x="8.41422" y="7" width="12" height="2" rx="1"
                                                                transform="rotate(45 8.41422 7)" fill="black" />
                                                        </svg>
                                                    </span>

                                                </div>

                                            </div>

                                        </div>


                                        <div class="tab-pane fade" id="kt_upgrade_plan_enterprise">

                                            <div class="pb-5">
                                                <h2 class="fw-bolder text-dark">What’s in Startup Plan?</h2>
                                                <div class="text-muted fw-bold">Optimal for 1000+ team and enterpise
                                                </div>
                                            </div>


                                            <div class="pt-1">

                                                <div class="d-flex align-items-center mb-7">
                                                    <span class="fw-bold fs-5 text-gray-700 flex-grow-1">Up to 10 Active
                                                        Users</span>

                                                    <span class="svg-icon svg-icon-1 svg-icon-success">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="black" />
                                                            <path
                                                                d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                fill="black" />
                                                        </svg>
                                                    </span>

                                                </div>


                                                <div class="d-flex align-items-center mb-7">
                                                    <span class="fw-bold fs-5 text-gray-700 flex-grow-1">Up to 30
                                                        Project Integrations</span>

                                                    <span class="svg-icon svg-icon-1 svg-icon-success">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="black" />
                                                            <path
                                                                d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                fill="black" />
                                                        </svg>
                                                    </span>

                                                </div>


                                                <div class="d-flex align-items-center mb-7">
                                                    <span class="fw-bold fs-5 text-gray-700 flex-grow-1">Analytics
                                                        Module</span>

                                                    <span class="svg-icon svg-icon-1 svg-icon-success">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="black" />
                                                            <path
                                                                d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                fill="black" />
                                                        </svg>
                                                    </span>

                                                </div>


                                                <div class="d-flex align-items-center mb-7">
                                                    <span class="fw-bold fs-5 text-gray-700 flex-grow-1">Finance
                                                        Module</span>

                                                    <span class="svg-icon svg-icon-1 svg-icon-success">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="black" />
                                                            <path
                                                                d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                fill="black" />
                                                        </svg>
                                                    </span>

                                                </div>


                                                <div class="d-flex align-items-center mb-7">
                                                    <span class="fw-bold fs-5 text-gray-700 flex-grow-1">Accounting
                                                        Module</span>

                                                    <span class="svg-icon svg-icon-1 svg-icon-success">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="black" />
                                                            <path
                                                                d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                fill="black" />
                                                        </svg>
                                                    </span>

                                                </div>


                                                <div class="d-flex align-items-center mb-7">
                                                    <span class="fw-bold fs-5 text-gray-700 flex-grow-1">Network
                                                        Platform</span>

                                                    <span class="svg-icon svg-icon-1 svg-icon-success">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="black" />
                                                            <path
                                                                d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                fill="black" />
                                                        </svg>
                                                    </span>

                                                </div>


                                                <div class="d-flex align-items-center">
                                                    <span class="fw-bold fs-5 text-gray-700 flex-grow-1">Unlimited Cloud
                                                        Space</span>

                                                    <span class="svg-icon svg-icon-1 svg-icon-success">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="black" />
                                                            <path
                                                                d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                fill="black" />
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-center flex-row-fluid pt-12">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Upgrade Plan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
            <span class="svg-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)"
                        fill="black" />
                    <path
                        d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                        fill="black" />
                </svg>
            </span>
        </div>



        <script>
            var hostUrl = "assets/";
        </script>
        <script src="<?php echo $url; ?>assets/plugins/global/plugins.bundle.js"></script>
        <script src="<?php echo $url; ?>assets/js/scripts.bundle.js"></script>
        <script src="<?php echo $url; ?>assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
        <script src="<?php echo $url; ?>assets/js/custom/widgets.js"></script>
        <script src="<?php echo $url; ?>assets/js/custom/apps/chat/chat.js"></script>
        <script src="<?php echo $url; ?>assets/js/custom/modals/create-app.js"></script>
        <script src="<?php echo $url; ?>assets/js/custom/modals/upgrade-plan.js"></script>


</body>

</html>