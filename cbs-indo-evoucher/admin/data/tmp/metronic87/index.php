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
    class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-enabled">
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
                                    data-bs-placement="right" data-bs-dismiss="click" title="E-Voucher">
                                    <a class="nav-link btn btn-icon btn-active-color-primary btn-color-gray-400 btn-active-light <?php active_menu($menu1); ?>"
                                        data-bs-toggle="tab" href="#kt_aside_nav_tab_projects">

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

                                <li class="nav-item mb-2" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                    data-bs-placement="right" data-bs-dismiss="click" title="Master Data">
                                    <a class="nav-link btn btn-icon btn-active-color-primary btn-color-gray-400 btn-active-light <?php active_menu($menu2); ?>"
                                        data-bs-toggle="tab" href="#kt_aside_nav_tab_menu">
                                        <span class="svg-icon svg-icon-2x">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"
                                                    d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z"
                                                    fill="black" />
                                                <path
                                                    d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z"
                                                    fill="black" />
                                            </svg>
                                        </span>

                                    </a>

                                </li>


                                <li class="nav-item mb-2" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                    data-bs-placement="right" data-bs-dismiss="click" title="Report">

                                    <a class="nav-link btn btn-icon btn-active-color-primary btn-color-gray-400 btn-active-light <?php active_menu($menu3); ?>"
                                        data-bs-toggle="tab" href="#kt_aside_nav_tab_subscription">

                                        <span class="svg-icon svg-icon-2x">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <rect x="8" y="9" width="3" height="10" rx="1.5" fill="black" />
                                                <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5"
                                                    fill="black" />
                                                <rect x="18" y="11" width="3" height="8" rx="1.5" fill="black" />
                                                <rect x="3" y="13" width="3" height="6" rx="1.5" fill="black" />
                                            </svg>
                                        </span>

                                    </a>

                                </li>



                                <li class="nav-item mb-2" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                    data-bs-placement="right" data-bs-dismiss="click" title="Grafik">

                                    <a class="nav-link btn btn-icon btn-active-color-primary btn-color-gray-400 btn-active-light <?php active_menu($menu4); ?>"
                                        data-bs-toggle="tab" href="#kt_aside_nav_tab_notifications">

                                        <span class="svg-icon svg-icon-2x">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"
                                                    d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z"
                                                    fill="black" />
                                                <path
                                                    d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z"
                                                    fill="black" />
                                            </svg>
                                        </span>

                                    </a>

                                </li>


                                <li class="nav-item mb-2" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                    data-bs-placement="right" data-bs-dismiss="click" title="Config">

                                    <a class="nav-link btn btn-icon btn-active-color-primary btn-color-gray-400 btn-active-light <?php active_menu($menu5); ?>"
                                        data-bs-toggle="tab" href="#kt_aside_nav_tab_authors">

                                        <span class="svg-icon svg-icon-2x">
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

                                </li>

                            </ul>

                        </div>

                    </div>

                    <div class="aside-footer d-flex flex-column align-items-center flex-column-auto"
                        id="kt_aside_footer">
                        
                         <div class="d-flex align-items-center mb-3">
                            <div class="btn btn-icon btn-active-color-primary btn-color-gray-400 btn-active-light"
                                data-kt-menu-trigger="click" data-kt-menu-overflow="true"
                                onclick="window.location.href='https://e-voucher.cbs-indo.com/panduan.php'"
                                data-kt-menu-placement="top-start" data-bs-toggle="tooltip" data-bs-placement="right"
                                data-bs-dismiss="click" title="Video Panduan E-Voucher" id="kt_activities_toggle">
                                <span class="svg-icon svg-icon-2 svg-icon-lg-1">
                                   <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo2\dist/../src/media/svg/icons\Devices\Video-camera.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <rect fill="#000000" x="2" y="6" width="13" height="12" rx="2"/>
        <path d="M22,8.4142119 L22,15.5857848 C22,16.1380695 21.5522847,16.5857848 21,16.5857848 C20.7347833,16.5857848 20.4804293,16.4804278 20.2928929,16.2928912 L16.7071064,12.7071013 C16.3165823,12.3165768 16.3165826,11.6834118 16.7071071,11.2928877 L20.2928936,7.70710477 C20.683418,7.31658067 21.316583,7.31658098 21.7071071,7.70710546 C21.8946433,7.89464181 22,8.14899558 22,8.4142119 Z" fill="#000000" opacity="0.3"/>
    </g>
</svg><!--end::Svg Icon--></span>
                                </span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-2">

                            <div class="btn btn-icon btn-active-color-primary btn-color-gray-400 btn-active-light"
                                data-kt-menu-trigger="click" data-kt-menu-overflow="true"
                                data-kt-menu-placement="top-start" data-bs-toggle="tooltip" data-bs-placement="right"
                                data-bs-dismiss="click" title="CBS-INDO APPS">

                                <span class="svg-icon svg-icon-2 svg-icon-lg-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path
                                            d="M11.2929 2.70711C11.6834 2.31658 12.3166 2.31658 12.7071 2.70711L15.2929 5.29289C15.6834 5.68342 15.6834 6.31658 15.2929 6.70711L12.7071 9.29289C12.3166 9.68342 11.6834 9.68342 11.2929 9.29289L8.70711 6.70711C8.31658 6.31658 8.31658 5.68342 8.70711 5.29289L11.2929 2.70711Z"
                                            fill="black" />
                                        <path
                                            d="M11.2929 14.7071C11.6834 14.3166 12.3166 14.3166 12.7071 14.7071L15.2929 17.2929C15.6834 17.6834 15.6834 18.3166 15.2929 18.7071L12.7071 21.2929C12.3166 21.6834 11.6834 21.6834 11.2929 21.2929L8.70711 18.7071C8.31658 18.3166 8.31658 17.6834 8.70711 17.2929L11.2929 14.7071Z"
                                            fill="black" />
                                        <path opacity="0.3"
                                            d="M5.29289 8.70711C5.68342 8.31658 6.31658 8.31658 6.70711 8.70711L9.29289 11.2929C9.68342 11.6834 9.68342 12.3166 9.29289 12.7071L6.70711 15.2929C6.31658 15.6834 5.68342 15.6834 5.29289 15.2929L2.70711 12.7071C2.31658 12.3166 2.31658 11.6834 2.70711 11.2929L5.29289 8.70711Z"
                                            fill="black" />
                                        <path opacity="0.3"
                                            d="M17.2929 8.70711C17.6834 8.31658 18.3166 8.31658 18.7071 8.70711L21.2929 11.2929C21.6834 11.6834 21.6834 12.3166 21.2929 12.7071L18.7071 15.2929C18.3166 15.6834 17.6834 15.6834 17.2929 15.2929L14.7071 12.7071C14.3166 12.3166 14.3166 11.6834 14.7071 11.2929L17.2929 8.70711Z"
                                            fill="black" />
                                    </svg>
                                </span>

                            </div>

                            <div class="menu menu-sub menu-sub-dropdown menu-column w-250px w-lg-325px"
                                data-kt-menu="true">




                                <div class="row g-0">

                                    <div class="col-12">
                                        <a href="https://cbs-indo.com" target="_blank"
                                            class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-end border-bottom">

                                            <span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
                                                <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Home/Earth.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <title>Stockholm-icons / Home / Earth</title>
                                                        <desc>Created with Sketch.</desc>
                                                        <defs />
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="9" />
                                                            <path d="M11.7357634,20.9961946 C6.88740052,20.8563914 3,16.8821712 3,12 C3,11.9168367 3.00112797,11.8339369 3.00336944,11.751315 C3.66233009,11.8143341 4.85636818,11.9573854 4.91262842,12.4204038 C4.9904938,13.0609191 4.91262842,13.8615942 5.45804656,14.101772 C6.00346469,14.3419498 6.15931561,13.1409372 6.6267482,13.4612567 C7.09418079,13.7815761 8.34086797,14.0899175 8.34086797,14.6562185 C8.34086797,15.222396 8.10715168,16.1034596 8.34086797,16.2636193 C8.57458427,16.423779 9.5089688,17.54465 9.50920913,17.7048097 C9.50956962,17.8649694 9.83857487,18.6793513 9.74040201,18.9906563 C9.65905192,19.2487394 9.24857641,20.0501554 8.85059781,20.4145589 C9.75315358,20.7620621 10.7235846,20.9657742 11.7357634,20.9960544 L11.7357634,20.9961946 Z M8.28272988,3.80112099 C9.4158415,3.28656421 10.6744554,3 12,3 C15.5114513,3 18.5532143,5.01097452 20.0364482,7.94408274 C20.069657,8.72412177 20.0638332,9.39135321 20.2361262,9.6327358 C21.1131932,10.8600506 18.0995147,11.7043158 18.5573343,13.5605384 C18.7589671,14.3794892 16.5527814,14.1196773 16.0139722,14.886394 C15.4748026,15.6527403 14.1574598,15.137809 13.8520064,14.9904917 C13.546553,14.8431744 12.3766497,15.3341497 12.4789081,14.4995164 C12.5805657,13.664636 13.2922889,13.6156126 14.0555619,13.2719546 C14.8184743,12.928667 15.9189236,11.7871741 15.3781918,11.6380045 C12.8323064,10.9362407 11.963771,8.47852395 11.963771,8.47852395 C11.8110443,8.44901109 11.8493762,6.74109366 11.1883616,6.69207022 C10.5267462,6.64279981 10.170464,6.88841096 9.20435656,6.69207022 C8.23764828,6.49572949 8.44144409,5.85743687 8.2887174,4.48255778 C8.25453994,4.17415686 8.25619136,3.95717082 8.28272988,3.80112099 Z M20.9991771,11.8770357 C20.9997251,11.9179585 21,11.9589471 21,12 C21,16.9406923 17.0188468,20.9515364 12.0895088,20.9995641 C16.970233,20.9503326 20.9337111,16.888438 20.9991771,11.8770357 Z" fill="#000000" opacity="0.3" />
                                                        </g>
                                                    </svg><!--end::Svg Icon--></span>
                                            </span>

                                            <span class="fs-5 fw-bold text-gray-800 mb-0">Landing Page</span>
                                            <span class="fs-7 text-gray-400">
                                                <center>https://cbs-indo.com</center>
                                            </span>
                                        </a>
                                    </div>


                                    <div class="col-12">
                                        <a href="https://membercard.cbs-indo.com" target="_blank"
                                            class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-bottom">

                                            <span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
                                                <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Shopping/Credit-card.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <title>Stockholm-icons / Shopping / Credit-card</title>
                                                        <desc>Created with Sketch.</desc>
                                                        <defs />
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <rect fill="#000000" x="2" y="8" width="20" height="3" />
                                                            <rect fill="#000000" opacity="0.3" x="16" y="14" width="4" height="2" rx="1" />
                                                        </g>
                                                    </svg><!--end::Svg Icon--></span>
                                            </span>

                                            <span class="fs-5 fw-bold text-gray-800 mb-0">Membercard</span>
                                            <span class="fs-7 text-gray-400">https://membercard.cbs-indo.com</span>
                                        </a>
                                    </div>


                                    <div class="col-12">
                                        <a href="https://e-voucher.cbs-indo.com" target="_blank"
                                            class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-end">

                                            <span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        d="M18 21.6C16.6 20.4 9.1 20.3 6.3 21.2C5.7 21.4 5.1 21.2 4.7 20.8L2 18C4.2 15.8 10.8 15.1 15.8 15.8C16.2 18.3 17 20.5 18 21.6ZM18.8 2.8C18.4 2.4 17.8 2.20001 17.2 2.40001C14.4 3.30001 6.9 3.2 5.5 2C6.8 3.3 7.4 5.5 7.7 7.7C9 7.9 10.3 8 11.7 8C15.8 8 19.8 7.2 21.5 5.5L18.8 2.8Z"
                                                        fill="black" />
                                                    <path opacity="0.3"
                                                        d="M21.2 17.3C21.4 17.9 21.2 18.5 20.8 18.9L18 21.6C15.8 19.4 15.1 12.8 15.8 7.8C18.3 7.4 20.4 6.70001 21.5 5.60001C20.4 7.00001 20.2 14.5 21.2 17.3ZM8 11.7C8 9 7.7 4.2 5.5 2L2.8 4.8C2.4 5.2 2.2 5.80001 2.4 6.40001C2.7 7.40001 3.00001 9.2 3.10001 11.7C3.10001 15.5 2.40001 17.6 2.10001 18C3.20001 16.9 5.3 16.2 7.8 15.8C8 14.2 8 12.7 8 11.7Z"
                                                        fill="black" />
                                                </svg>
                                            </span>

                                            <span class="fs-5 fw-bold text-gray-800 mb-0">E-Voucher</span>
                                            <span class="fs-7 text-gray-400">https://e-voucher.cbs-indo.com</span>
                                        </a>
                                    </div>


                                    <div class="col-6">

                                    </div>

                                </div>



                            </div>
                        </div>
                        
                        
                        <div class="d-flex align-items-center mb-3">
                            <div class="btn btn-icon btn-active-color-primary btn-color-gray-400 btn-active-light"
                                data-kt-menu-trigger="click" data-kt-menu-overflow="true"
                                onclick="window.location.href='../data_log_activity/'"
                                data-kt-menu-placement="top-start" data-bs-toggle="tooltip" data-bs-placement="right"
                                data-bs-dismiss="click" title="Log Activity" id="kt_activities_toggle">
                                <span class="svg-icon svg-icon-2 svg-icon-lg-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <rect x="8" y="9" width="3" height="10" rx="1.5" fill="black" />
                                        <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="black" />
                                        <rect x="18" y="11" width="3" height="8" rx="1.5" fill="black" />
                                        <rect x="3" y="13" width="3" height="6" rx="1.5" fill="black" />
                                    </svg>
                                </span>
                            </div>
                        </div>
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
                                            <div class="fw-bolder d-flex align-items-center fs-5"><?php decrypt("jenenge");?>
                                                <span
                                                    class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">Administrator</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="separator my-2"></div>

                                <div class="menu-item px-5">
                                    <a href="../data_admin/index.php?input=detail&proses=<?php echo $_COOKIE['kodene']; ?>" class="menu-link px-5">My Profile</a>
                                </div>

                                <div class="menu-item px-5">
                                    <a href="../data_admin/index.php?input=edit&proses=<?php echo $_COOKIE['kodene']; ?>" class="menu-link px-5">
                                        <span class="menu-text">Change Password</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="aside-secondary d-flex flex-row-fluid">
                    <div class="aside-workspace my-5 p-5" id="kt_aside_wordspace">
                        <div class="d-flex h-100 flex-column">
                            <div class="flex-column-fluid hover-scroll-y" data-kt-scroll="true"
                                data-kt-scroll-activate="true" data-kt-scroll-height="auto"
                                data-kt-scroll-wrappers="#kt_aside_wordspace"
                                data-kt-scroll-dependencies="#kt_aside_secondary_footer" data-kt-scroll-offset="0px">
                                <div class="tab-content">



                                    <div class="tab-pane fade <?php active_menu($menu1); ?> show"
                                        id="kt_aside_nav_tab_projects" role="tabpanel">
                                        <div class="m-0">


                                            <div class="d-flex mb-10">
                                                <div id="kt_header_search" class="d-flex align-items-center w-lg-400px"
                                                    data-kt-search-keypress="true" data-kt-search-min-length="2"
                                                    data-kt-search-enter="enter" data-kt-search-layout="menu"
                                                    data-kt-menu-trigger="auto" data-kt-menu-permanent="true"
                                                    data-kt-menu-placement="bottom-start">




                                                    <form data-kt-search-element="form" action="../data_voucher/"
                                                        class="w-100 position-relative mb-5 mb-lg-0" autocomplete="off">

                                                        <input type="hidden" name="input" value="vouher_keseluruhan" />



                                                        <span
                                                            class="svg-icon svg-icon-2 svg-icon-lg-1 svg-icon-gray-500 position-absolute top-50 translate-middle-y ms-5">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none">
                                                                <rect opacity="0.5" x="17.0365" y="15.1223"
                                                                    width="8.15546" height="2" rx="1"
                                                                    transform="rotate(45 17.0365 15.1223)"
                                                                    fill="black" />
                                                                <path
                                                                    d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                                    fill="black" />
                                                            </svg>
                                                        </span>



                                                        <input type="text" class="form-control form-control-solid ps-15"
                                                            name="id" value="" placeholder="Search E-Voucher..."
                                                            data-kt-search-element="input" />


                                                        <span
                                                            class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-5"
                                                            data-kt-search-element="spinner">
                                                            <span
                                                                class="spinner-border h-15px w-15px align-middle text-gray-400"></span>
                                                        </span>


                                                        <span
                                                            class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-4"
                                                            data-kt-search-element="clear">

                                                            <span class="svg-icon svg-icon-2 svg-icon-lg-1 me-0">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <rect opacity="0.5" x="6" y="17.3137" width="16"
                                                                        height="2" rx="1"
                                                                        transform="rotate(-45 6 17.3137)"
                                                                        fill="black" />
                                                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                                                        transform="rotate(45 7.41422 6)" fill="black" />
                                                                </svg>
                                                            </span>

                                                        </span>

                                                    </form>




                                                    <div data-kt-search-element="content"
                                                        class="menu menu-sub menu-sub-dropdown w-300px w-md-350px py-7 px-7 overflow-hidden">
                                                        <div data-kt-search-element="wrapper">

                                                            <div data-kt-search-element="results" class="d-none">

                                                                <div class="scroll-y mh-200px mh-lg-350px">

                                                                    <h3 class="fs-5 text-muted m-0 pb-5"
                                                                        data-kt-search-element="category-title">Users
                                                                    </h3>


                                                                    <a href="#"
                                                                        class="d-flex text-dark text-hover-primary align-items-center mb-5">

                                                                        <div class="symbol symbol-40px me-4">
                                                                            <img src="<?php echo $url; ?>assets/media/avatars/150-1.jpg"
                                                                                alt="" />
                                                                        </div>


                                                                        <div
                                                                            class="d-flex flex-column justify-content-start fw-bold">
                                                                            <span class="fs-6 fw-bold">Karina
                                                                                Clark</span>
                                                                            <span
                                                                                class="fs-7 fw-bold text-muted">Marketing
                                                                                Manager</span>
                                                                        </div>

                                                                    </a>


                                                                    <a href="#"
                                                                        class="d-flex text-dark text-hover-primary align-items-center mb-5">

                                                                        <div class="symbol symbol-40px me-4">
                                                                            <img src="<?php echo $url; ?>assets/media/avatars/150-3.jpg"
                                                                                alt="" />
                                                                        </div>


                                                                        <div
                                                                            class="d-flex flex-column justify-content-start fw-bold">
                                                                            <span class="fs-6 fw-bold">Olivia
                                                                                Bold</span>
                                                                            <span
                                                                                class="fs-7 fw-bold text-muted">Software
                                                                                Engineer</span>
                                                                        </div>

                                                                    </a>


                                                                    <a href="#"
                                                                        class="d-flex text-dark text-hover-primary align-items-center mb-5">

                                                                        <div class="symbol symbol-40px me-4">
                                                                            <img src="<?php echo $url; ?>assets/media/avatars/150-8.jpg"
                                                                                alt="" />
                                                                        </div>


                                                                        <div
                                                                            class="d-flex flex-column justify-content-start fw-bold">
                                                                            <span class="fs-6 fw-bold">Ana Clark</span>
                                                                            <span class="fs-7 fw-bold text-muted">UI/UX
                                                                                Designer</span>
                                                                        </div>

                                                                    </a>


                                                                    <a href="#"
                                                                        class="d-flex text-dark text-hover-primary align-items-center mb-5">

                                                                        <div class="symbol symbol-40px me-4">
                                                                            <img src="<?php echo $url; ?>assets/media/avatars/150-11.jpg"
                                                                                alt="" />
                                                                        </div>


                                                                        <div
                                                                            class="d-flex flex-column justify-content-start fw-bold">
                                                                            <span class="fs-6 fw-bold">Nick
                                                                                Pitola</span>
                                                                            <span class="fs-7 fw-bold text-muted">Art
                                                                                Director</span>
                                                                        </div>

                                                                    </a>


                                                                    <a href="#"
                                                                        class="d-flex text-dark text-hover-primary align-items-center mb-5">

                                                                        <div class="symbol symbol-40px me-4">
                                                                            <img src="<?php echo $url; ?>assets/media/avatars/150-12.jpg"
                                                                                alt="" />
                                                                        </div>


                                                                        <div
                                                                            class="d-flex flex-column justify-content-start fw-bold">
                                                                            <span class="fs-6 fw-bold">Edward
                                                                                Kulnic</span>
                                                                            <span class="fs-7 fw-bold text-muted">System
                                                                                Administrator</span>
                                                                        </div>

                                                                    </a>


                                                                    <h3 class="fs-5 text-muted m-0 pt-5 pb-5"
                                                                        data-kt-search-element="category-title">
                                                                        Customers</h3>


                                                                    <a href="#"
                                                                        class="d-flex text-dark text-hover-primary align-items-center mb-5">

                                                                        <div class="symbol symbol-40px me-4">
                                                                            <span class="symbol-label bg-light">
                                                                                <img class="w-20px h-20px"
                                                                                    src="<?php echo $url; ?>assets/media/svg/brand-logos/volicity-9.svg"
                                                                                    alt="" />
                                                                            </span>
                                                                        </div>


                                                                        <div
                                                                            class="d-flex flex-column justify-content-start fw-bold">
                                                                            <span class="fs-6 fw-bold">Company
                                                                                Rbranding</span>
                                                                            <span class="fs-7 fw-bold text-muted">UI
                                                                                Design</span>
                                                                        </div>

                                                                    </a>


                                                                    <a href="#"
                                                                        class="d-flex text-dark text-hover-primary align-items-center mb-5">

                                                                        <div class="symbol symbol-40px me-4">
                                                                            <span class="symbol-label bg-light">
                                                                                <img class="w-20px h-20px"
                                                                                    src="<?php echo $url; ?>assets/media/svg/brand-logos/tvit.svg"
                                                                                    alt="" />
                                                                            </span>
                                                                        </div>


                                                                        <div
                                                                            class="d-flex flex-column justify-content-start fw-bold">
                                                                            <span class="fs-6 fw-bold">Company
                                                                                Re-branding</span>
                                                                            <span class="fs-7 fw-bold text-muted">Web
                                                                                Development</span>
                                                                        </div>

                                                                    </a>


                                                                    <a href="#"
                                                                        class="d-flex text-dark text-hover-primary align-items-center mb-5">

                                                                        <div class="symbol symbol-40px me-4">
                                                                            <span class="symbol-label bg-light">
                                                                                <img class="w-20px h-20px"
                                                                                    src="<?php echo $url; ?>assets/media/svg/misc/infography.svg"
                                                                                    alt="" />
                                                                            </span>
                                                                        </div>


                                                                        <div
                                                                            class="d-flex flex-column justify-content-start fw-bold">
                                                                            <span class="fs-6 fw-bold">Business
                                                                                Analytics App</span>
                                                                            <span
                                                                                class="fs-7 fw-bold text-muted">Administration</span>
                                                                        </div>

                                                                    </a>


                                                                    <a href="#"
                                                                        class="d-flex text-dark text-hover-primary align-items-center mb-5">

                                                                        <div class="symbol symbol-40px me-4">
                                                                            <span class="symbol-label bg-light">
                                                                                <img class="w-20px h-20px"
                                                                                    src="<?php echo $url; ?>assets/media/svg/brand-logos/leaf.svg"
                                                                                    alt="" />
                                                                            </span>
                                                                        </div>


                                                                        <div
                                                                            class="d-flex flex-column justify-content-start fw-bold">
                                                                            <span class="fs-6 fw-bold">EcoLeaf App
                                                                                Launch</span>
                                                                            <span
                                                                                class="fs-7 fw-bold text-muted">Marketing</span>
                                                                        </div>

                                                                    </a>


                                                                    <a href="#"
                                                                        class="d-flex text-dark text-hover-primary align-items-center mb-5">

                                                                        <div class="symbol symbol-40px me-4">
                                                                            <span class="symbol-label bg-light">
                                                                                <img class="w-20px h-20px"
                                                                                    src="<?php echo $url; ?>assets/media/svg/brand-logos/tower.svg"
                                                                                    alt="" />
                                                                            </span>
                                                                        </div>


                                                                        <div
                                                                            class="d-flex flex-column justify-content-start fw-bold">
                                                                            <span class="fs-6 fw-bold">Tower Group
                                                                                Website</span>
                                                                            <span class="fs-7 fw-bold text-muted">Google
                                                                                Adwords</span>
                                                                        </div>

                                                                    </a>


                                                                    <h3 class="fs-5 text-muted m-0 pt-5 pb-5"
                                                                        data-kt-search-element="category-title">Projects
                                                                    </h3>


                                                                    <a href="#"
                                                                        class="d-flex text-dark text-hover-primary align-items-center mb-5">

                                                                        <div class="symbol symbol-40px me-4">
                                                                            <span class="symbol-label bg-light">

                                                                                <span
                                                                                    class="svg-icon svg-icon-2 svg-icon-primary">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                        width="24" height="24"
                                                                                        viewBox="0 0 24 24" fill="none">
                                                                                        <path opacity="0.3"
                                                                                            d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM15 17C15 16.4 14.6 16 14 16H8C7.4 16 7 16.4 7 17C7 17.6 7.4 18 8 18H14C14.6 18 15 17.6 15 17ZM17 12C17 11.4 16.6 11 16 11H8C7.4 11 7 11.4 7 12C7 12.6 7.4 13 8 13H16C16.6 13 17 12.6 17 12ZM17 7C17 6.4 16.6 6 16 6H8C7.4 6 7 6.4 7 7C7 7.6 7.4 8 8 8H16C16.6 8 17 7.6 17 7Z"
                                                                                            fill="black" />
                                                                                        <path
                                                                                            d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z"
                                                                                            fill="black" />
                                                                                    </svg>
                                                                                </span>

                                                                            </span>
                                                                        </div>


                                                                        <div class="d-flex flex-column">
                                                                            <span class="fs-6 fw-bold">Si-Fi Project by
                                                                                AU Themes</span>
                                                                            <span
                                                                                class="fs-7 fw-bold text-muted">#45670</span>
                                                                        </div>

                                                                    </a>


                                                                    <a href="#"
                                                                        class="d-flex text-dark text-hover-primary align-items-center mb-5">

                                                                        <div class="symbol symbol-40px me-4">
                                                                            <span class="symbol-label bg-light">

                                                                                <span
                                                                                    class="svg-icon svg-icon-2 svg-icon-primary">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                        width="24" height="24"
                                                                                        viewBox="0 0 24 24" fill="none">
                                                                                        <rect x="8" y="9" width="3"
                                                                                            height="10" rx="1.5"
                                                                                            fill="black" />
                                                                                        <rect opacity="0.5" x="13" y="5"
                                                                                            width="3" height="14"
                                                                                            rx="1.5" fill="black" />
                                                                                        <rect x="18" y="11" width="3"
                                                                                            height="8" rx="1.5"
                                                                                            fill="black" />
                                                                                        <rect x="3" y="13" width="3"
                                                                                            height="6" rx="1.5"
                                                                                            fill="black" />
                                                                                    </svg>
                                                                                </span>

                                                                            </span>
                                                                        </div>


                                                                        <div class="d-flex flex-column">
                                                                            <span class="fs-6 fw-bold">Shopix Mobile App
                                                                                Planning</span>
                                                                            <span
                                                                                class="fs-7 fw-bold text-muted">#45690</span>
                                                                        </div>

                                                                    </a>


                                                                    <a href="#"
                                                                        class="d-flex text-dark text-hover-primary align-items-center mb-5">

                                                                        <div class="symbol symbol-40px me-4">
                                                                            <span class="symbol-label bg-light">

                                                                                <span
                                                                                    class="svg-icon svg-icon-2 svg-icon-primary">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                        width="24" height="24"
                                                                                        viewBox="0 0 24 24" fill="none">
                                                                                        <path opacity="0.3"
                                                                                            d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z"
                                                                                            fill="black" />
                                                                                        <rect x="6" y="12" width="7"
                                                                                            height="2" rx="1"
                                                                                            fill="black" />
                                                                                        <rect x="6" y="7" width="12"
                                                                                            height="2" rx="1"
                                                                                            fill="black" />
                                                                                    </svg>
                                                                                </span>

                                                                            </span>
                                                                        </div>


                                                                        <div class="d-flex flex-column">
                                                                            <span class="fs-6 fw-bold">Finance
                                                                                Monitoring SAAS Discussion</span>
                                                                            <span
                                                                                class="fs-7 fw-bold text-muted">#21090</span>
                                                                        </div>

                                                                    </a>


                                                                    <a href="#"
                                                                        class="d-flex text-dark text-hover-primary align-items-center mb-5">

                                                                        <div class="symbol symbol-40px me-4">
                                                                            <span class="symbol-label bg-light">

                                                                                <span
                                                                                    class="svg-icon svg-icon-2 svg-icon-primary">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                        width="24" height="24"
                                                                                        viewBox="0 0 24 24" fill="none">
                                                                                        <path opacity="0.3"
                                                                                            d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z"
                                                                                            fill="black" />
                                                                                        <path
                                                                                            d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z"
                                                                                            fill="black" />
                                                                                    </svg>
                                                                                </span>

                                                                            </span>
                                                                        </div>


                                                                        <div class="d-flex flex-column">
                                                                            <span class="fs-6 fw-bold">Dashboard
                                                                                Analitics Launch</span>
                                                                            <span
                                                                                class="fs-7 fw-bold text-muted">#34560</span>
                                                                        </div>

                                                                    </a>

                                                                </div>

                                                            </div>


                                                            <div class="mb-4" data-kt-search-element="main">

                                                                <div class="d-flex flex-stack fw-bold mb-5">
                                                                    <span class="text-muted fs-6 me-2">Recently
                                                                        Searched</span>
                                                                    <div class="d-flex"
                                                                        data-kt-search-element="toolbar">
                                                                    </div>

                                                                </div>


                                                                <div class="scroll-y mh-200px mh-lg-325px">

                                                                    <div class="d-flex align-items-center mb-5">

                                                                        <div class="symbol symbol-40px me-4">
                                                                            <span class="symbol-label bg-light">

                                                                                <span
                                                                                    class="svg-icon svg-icon-2 svg-icon-primary">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                        width="24" height="24"
                                                                                        viewBox="0 0 24 24" fill="none">
                                                                                        <path
                                                                                            d="M2 16C2 16.6 2.4 17 3 17H21C21.6 17 22 16.6 22 16V15H2V16Z"
                                                                                            fill="black" />
                                                                                        <path opacity="0.3"
                                                                                            d="M21 3H3C2.4 3 2 3.4 2 4V15H22V4C22 3.4 21.6 3 21 3Z"
                                                                                            fill="black" />
                                                                                        <path opacity="0.3"
                                                                                            d="M15 17H9V20H15V17Z"
                                                                                            fill="black" />
                                                                                    </svg>
                                                                                </span>

                                                                            </span>
                                                                        </div>


                                                                        <div class="d-flex flex-column">
                                                                            <a href="#"
                                                                                class="fs-6 text-gray-800 text-hover-primary fw-bold">Riwayat
                                                                                Pencarian</a>
                                                                            <span class="fs-7 text-muted fw-bold">2
                                                                                Januari 2024</span>
                                                                        </div>

                                                                    </div>


                                                                </div>

                                                            </div>


                                                            <div data-kt-search-element="empty"
                                                                class="text-center d-none">

                                                                <div class="pt-10 pb-10">

                                                                    <span class="svg-icon svg-icon-4x opacity-50">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24" viewBox="0 0 24 24"
                                                                            fill="none">
                                                                            <path opacity="0.3"
                                                                                d="M14 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L14 2Z"
                                                                                fill="black" />
                                                                            <path
                                                                                d="M20 8L14 2V6C14 7.10457 14.8954 8 16 8H20Z"
                                                                                fill="black" />
                                                                            <rect x="13.6993" y="13.6656"
                                                                                width="4.42828" height="1.73089"
                                                                                rx="0.865447"
                                                                                transform="rotate(45 13.6993 13.6656)"
                                                                                fill="black" />
                                                                            <path
                                                                                d="M15 12C15 14.2 13.2 16 11 16C8.8 16 7 14.2 7 12C7 9.8 8.8 8 11 8C13.2 8 15 9.8 15 12ZM11 9.6C9.68 9.6 8.6 10.68 8.6 12C8.6 13.32 9.68 14.4 11 14.4C12.32 14.4 13.4 13.32 13.4 12C13.4 10.68 12.32 9.6 11 9.6Z"
                                                                                fill="black" />
                                                                        </svg>
                                                                    </span>

                                                                </div>


                                                                <div class="pb-15 fw-bold">
                                                                    <h3 class="text-gray-600 fs-5 mb-2">No result found
                                                                    </h3>
                                                                    <div class="text-muted fs-7">Please try again with a
                                                                        different query</div>
                                                                </div>

                                                            </div>

                                                        </div>


                                                        <form data-kt-search-element="advanced-options-form"
                                                            class="pt-1 d-none">

                                                            <h3 class="fw-bold text-dark mb-7">Advanced Search</h3>


                                                            <div class="mb-5">
                                                                <input type="text"
                                                                    class="form-control form-control-sm form-control-solid"
                                                                    placeholder="Contains the word" name="query" />
                                                            </div>


                                                            <div class="mb-5">

                                                                <div class="nav-group nav-group-fluid">

                                                                    <label>
                                                                        <input type="radio" class="btn-check"
                                                                            name="type" value="has" checked="checked" />
                                                                        <span
                                                                            class="btn btn-sm btn-color-muted btn-active btn-active-primary">All</span>
                                                                    </label>


                                                                    <label>
                                                                        <input type="radio" class="btn-check"
                                                                            name="type" value="users" />
                                                                        <span
                                                                            class="btn btn-sm btn-color-muted btn-active btn-active-primary px-4">Users</span>
                                                                    </label>


                                                                    <label>
                                                                        <input type="radio" class="btn-check"
                                                                            name="type" value="orders" />
                                                                        <span
                                                                            class="btn btn-sm btn-color-muted btn-active btn-active-primary px-4">Orders</span>
                                                                    </label>


                                                                    <label>
                                                                        <input type="radio" class="btn-check"
                                                                            name="type" value="projects" />
                                                                        <span
                                                                            class="btn btn-sm btn-color-muted btn-active btn-active-primary px-4">Projects</span>
                                                                    </label>

                                                                </div>

                                                            </div>


                                                            <div class="mb-5">
                                                                <input type="text" name="assignedto"
                                                                    class="form-control form-control-sm form-control-solid"
                                                                    placeholder="Assigned to" value="" />
                                                            </div>


                                                            <div class="mb-5">
                                                                <input type="text" name="collaborators"
                                                                    class="form-control form-control-sm form-control-solid"
                                                                    placeholder="Collaborators" value="" />
                                                            </div>


                                                            <div class="mb-5">

                                                                <div class="nav-group nav-group-fluid">

                                                                    <label>
                                                                        <input type="radio" class="btn-check"
                                                                            name="attachment" value="has"
                                                                            checked="checked" />
                                                                        <span
                                                                            class="btn btn-sm btn-color-muted btn-active btn-active-primary">Has
                                                                            attachment</span>
                                                                    </label>


                                                                    <label>
                                                                        <input type="radio" class="btn-check"
                                                                            name="attachment" value="any" />
                                                                        <span
                                                                            class="btn btn-sm btn-color-muted btn-active btn-active-primary px-4">Any</span>
                                                                    </label>

                                                                </div>

                                                            </div>


                                                            <div class="mb-5">
                                                                <select name="timezone" aria-label="Select a Timezone"
                                                                    data-control="select2"
                                                                    data-placeholder="date_period"
                                                                    class="form-select form-select-sm form-select-solid">
                                                                    <option value="next">Within the next</option>
                                                                    <option value="last">Within the last</option>
                                                                    <option value="between">Between</option>
                                                                    <option value="on">On</option>
                                                                </select>
                                                            </div>


                                                            <div class="row mb-8">

                                                                <div class="col-6">
                                                                    <input type="number" name="date_number"
                                                                        class="form-control form-control-sm form-control-solid"
                                                                        placeholder="Lenght" value="" />
                                                                </div>


                                                                <div class="col-6">
                                                                    <select name="date_typer"
                                                                        aria-label="Select a Timezone"
                                                                        data-control="select2" data-placeholder="Period"
                                                                        class="form-select form-select-sm form-select-solid">
                                                                        <option value="days">Days</option>
                                                                        <option value="weeks">Weeks</option>
                                                                        <option value="months">Months</option>
                                                                        <option value="years">Years</option>
                                                                    </select>
                                                                </div>

                                                            </div>


                                                            <div class="d-flex justify-content-end">
                                                                <button type="reset"
                                                                    class="btn btn-sm btn-light fw-bolder btn-active-light-primary me-2"
                                                                    data-kt-search-element="advanced-options-form-cancel">Cancel</button>
                                                                <a href="<?php echo $url; ?>../../demo7/dist/pages/search/horizontal.html"
                                                                    class="btn btn-sm fw-bolder btn-primary"
                                                                    data-kt-search-element="advanced-options-form-search">Search</a>
                                                            </div>

                                                        </form>


                                                        <form data-kt-search-element="preferences" class="pt-1 d-none">

                                                            <h3 class="fw-bold text-dark mb-7">Search Preferences</h3>


                                                            <div class="pb-4 border-bottom">
                                                                <label
                                                                    class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack">
                                                                    <span
                                                                        class="form-check-label text-gray-700 fs-6 fw-bold ms-0 me-2">Projects</span>
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="1" checked="checked" />
                                                                </label>
                                                            </div>


                                                            <div class="py-4 border-bottom">
                                                                <label
                                                                    class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack">
                                                                    <span
                                                                        class="form-check-label text-gray-700 fs-6 fw-bold ms-0 me-2">Targets</span>
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="1" checked="checked" />
                                                                </label>
                                                            </div>


                                                            <div class="py-4 border-bottom">
                                                                <label
                                                                    class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack">
                                                                    <span
                                                                        class="form-check-label text-gray-700 fs-6 fw-bold ms-0 me-2">Affiliate
                                                                        Programs</span>
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="1" />
                                                                </label>
                                                            </div>


                                                            <div class="py-4 border-bottom">
                                                                <label
                                                                    class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack">
                                                                    <span
                                                                        class="form-check-label text-gray-700 fs-6 fw-bold ms-0 me-2">Referrals</span>
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="1" checked="checked" />
                                                                </label>
                                                            </div>


                                                            <div class="py-4 border-bottom">
                                                                <label
                                                                    class="form-check form-switch form-switch-sm form-check-custom form-check-solid flex-stack">
                                                                    <span
                                                                        class="form-check-label text-gray-700 fs-6 fw-bold ms-0 me-2">Users</span>
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="1" />
                                                                </label>
                                                            </div>


                                                            <div class="d-flex justify-content-end pt-7">
                                                                <button type="reset"
                                                                    class="btn btn-sm btn-light fw-bolder btn-active-light-primary me-2"
                                                                    data-kt-search-element="preferences-dismiss">Cancel</button>
                                                                <button type="submit"
                                                                    class="btn btn-sm fw-bolder btn-primary">Save
                                                                    Changes</button>
                                                            </div>

                                                        </form>

                                                    </div>

                                                </div>


                                                <div class="flex-shrink-0 ms-2">

                                                    <button type="button"
                                                        class="btn btn-icon btn-bg-light btn-active-icon-primary btn-color-gray-400"
                                                        data-kt-menu-trigger="click"
                                                        data-kt-menu-placement="bottom-end">

                                                        <span class="svg-icon svg-icon-2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none">
                                                                <path
                                                                    d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z"
                                                                    fill="black" />
                                                            </svg>
                                                        </span>

                                                    </button>



                                                    <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px"
                                                        data-kt-menu="true" id="kt_menu_6148576bb7efe">

                                                        <div class="px-7 py-5">
                                                            <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                                                        </div>


                                                        <div class="separator border-gray-200"></div>


                                                        <div class="px-7 py-5">

                                                            <div class="mb-10">
                                                                <label class="form-label fw-bold">Status:</label>
                                                                <div>
                                                                    <select id="statusSelect" class="form-select form-select-solid" data-kt-select2="true"
                                                                        data-placeholder="Select option" data-dropdown-parent="#kt_menu_6148576bb7efe"
                                                                        data-allow-clear="true">
                                                                        <option></option>
                                                                        <option value="vouher_keseluruhan">Semua</option>
                                                                        <option value="voucher_aktif">Belum digunakan</option>
                                                                        <option value="voucher_digunakan">Sudah digunakan</option>
                                                                        <option value="voucher_kadaluarsa">Kadaluarsa</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="d-flex justify-content-end">
                                                                <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
                                                                <button type="submit" class="btn btn-sm btn-primary" onclick="applyFilter()">Apply</button>
                                                            </div>

                                                            <script>
                                                                function applyFilter() {
                                                                    let selectedValue = document.getElementById("statusSelect").value;
                                                                    if (selectedValue) {
                                                                        window.location.href = `../data_voucher/?input=${selectedValue}`;
                                                                    } else {
                                                                        alert("Pilih status terlebih dahulu!");
                                                                    }
                                                                }
                                                            </script>

                                                        </div>

                                                    </div>


                                                </div>

                                            </div>


                                            <div class="m-0">

                                                <div class="mx-5">

                                                    <h3 class="fw-bolder text-dark mb-10 mx-0">E-Voucher</h3>


                                                    <div class="mb-12">


                                                        <div class="d-flex align-items-center mb-7">

                                                            <div class="symbol symbol-50px me-5">
                                                                <span class="symbol-label bg-light-danger">

                                                                    <span class="svg-icon svg-icon-2x svg-icon-danger">
                                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                                            width="24" height="24" viewBox="0 0 24 24"
                                                                            fill="none">
                                                                            <path
                                                                                d="M13 10.9128V3.01281C13 2.41281 13.5 1.91281 14.1 2.01281C16.1 2.21281 17.9 3.11284 19.3 4.61284C20.7 6.01284 21.6 7.91285 21.9 9.81285C22 10.4129 21.5 10.9128 20.9 10.9128H13Z"
                                                                                fill="black" />
                                                                            <path opacity="0.3"
                                                                                d="M13 12.9128V20.8129C13 21.4129 13.5 21.9129 14.1 21.8129C16.1 21.6129 17.9 20.7128 19.3 19.2128C20.7 17.8128 21.6 15.9128 21.9 14.0128C22 13.4128 21.5 12.9128 20.9 12.9128H13Z"
                                                                                fill="black" />
                                                                            <path opacity="0.3"
                                                                                d="M11 19.8129C11 20.4129 10.5 20.9129 9.89999 20.8129C5.49999 20.2129 2 16.5128 2 11.9128C2 7.31283 5.39999 3.51281 9.89999 3.01281C10.5 2.91281 11 3.41281 11 4.01281V19.8129Z"
                                                                                fill="black" />
                                                                        </svg>
                                                                    </span>

                                                                </span>
                                                            </div>


                                                            <div class="d-flex flex-column">
                                                                <a href="../home/"
                                                                    class="text-gray-800 text-hover-primary fs-6 fw-bold">Dashboard</a>
                                                                <span class="text-muted fw-bold">Home Overview </span>
                                                            </div>

                                                        </div>


                                                        <div class="d-flex align-items-center mb-7">

                                                            <div class="symbol symbol-50px me-5">
                                                                <span class="symbol-label bg-light-success">

                                                                    <span class="svg-icon svg-icon-2x svg-icon-success">
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
                                                                    </span>

                                                                </span>
                                                            </div>


                                                            <div class="d-flex flex-column">
                                                                <a href="../data_voucher/?input=list"
                                                                    class="text-gray-800 text-hover-primary fs-6 fw-bold">
                                                                    E-Voucher</a>
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
                                                                            <defs />
                                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                <polygon points="0 0 24 0 24 24 0 24" />
                                                                                <path d="M4.85714286,1 L11.7364114,1 C12.0910962,1 12.4343066,1.12568431 12.7051108,1.35473959 L17.4686994,5.3839416 C17.8056532,5.66894833 18,6.08787823 18,6.52920201 L18,19.0833333 C18,20.8738751 17.9795521,21 16.1428571,21 L4.85714286,21 C3.02044787,21 3,20.8738751 3,19.0833333 L3,2.91666667 C3,1.12612489 3.02044787,1 4.85714286,1 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                                                <path d="M6.85714286,3 L14.7364114,3 C15.0910962,3 15.4343066,3.12568431 15.7051108,3.35473959 L20.4686994,7.3839416 C20.8056532,7.66894833 21,8.08787823 21,8.52920201 L21,21.0833333 C21,22.8738751 20.9795521,23 19.1428571,23 L6.85714286,23 C5.02044787,23 5,22.8738751 5,21.0833333 L5,4.91666667 C5,3.12612489 5.02044787,3 6.85714286,3 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z" fill="#000000" fill-rule="nonzero" />
                                                                            </g>
                                                                        </svg>
                                                                    </span>

                                                                </span>
                                                            </div>


                                                            <div class="d-flex flex-column">
                                                                <a href="../data_voucher/?input=penjualan"
                                                                    class="text-gray-800 text-hover-primary fs-6 fw-bold">Penjualan
                                                                </a>
                                                                <span class="text-muted fw-bold">Riwayat Penjualan</span>
                                                            </div>

                                                        </div>




                                                        <div class="d-flex align-items-center mb-7">

                                                            <div class="symbol symbol-50px me-5">
                                                                <span class="symbol-label bg-light-info">

                                                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Communication/Clipboard-list.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                            <title>Stockholm-icons / Communication / Clipboard-list</title>
                                                                            <desc>Created with Sketch.</desc>
                                                                            <defs />
                                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                <rect x="0" y="0" width="24" height="24" />
                                                                                <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3" />
                                                                                <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000" />
                                                                                <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2" rx="1" />
                                                                                <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1" />
                                                                                <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2" rx="1" />
                                                                                <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2" rx="1" />
                                                                                <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2" rx="1" />
                                                                                <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2" rx="1" />
                                                                            </g>
                                                                        </svg><!--end::Svg Icon--></span>

                                                                </span>
                                                            </div>


                                                            <div class="d-flex flex-column">
                                                                <a href="../data_voucher/?input=transaksi"
                                                                    class="text-gray-800 text-hover-primary fs-6 fw-bold">Transaksi</a>
                                                                <span class="text-muted fw-bold">Riwayat Transaksi
                                                                </span>
                                                            </div>

                                                        </div>


                                                        <div class="d-flex align-items-center mb-7">

                                                            <div class="symbol symbol-50px me-5">
                                                                <span class="symbol-label bg-light-success">

                                                                    <span class="svg-icon svg-icon-2x svg-icon-primary">
                                                                        <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Shopping/Chart-bar1.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                                <title>Stockholm-icons / Shopping / Chart-bar1</title>
                                                                                <desc>Created with Sketch.</desc>
                                                                                <defs />
                                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                    <rect x="0" y="0" width="24" height="24" />
                                                                                    <rect fill="#000000" opacity="0.3" x="12" y="4" width="3" height="13" rx="1.5" />
                                                                                    <rect fill="#000000" opacity="0.3" x="7" y="9" width="3" height="8" rx="1.5" />
                                                                                    <path d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z" fill="#000000" fill-rule="nonzero" />
                                                                                    <rect fill="#000000" opacity="0.3" x="17" y="11" width="3" height="6" rx="1.5" />
                                                                                </g>
                                                                            </svg><!--end::Svg Icon--></span>
                                                                    </span>

                                                                </span>
                                                            </div>


                                                            <div class="d-flex flex-column">
                                                                <a href="../data_voucher/?input=grafik"
                                                                    class="text-gray-800 text-hover-primary fs-6 fw-bold">Grafik</a>
                                                                <span class="text-muted fw-bold">Penjualan &
                                                                    Transaksi</span>
                                                            </div>

                                                        </div>






                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="tab-pane fade <?php active_menu($menu2); ?> show"
                                        id="kt_aside_nav_tab_menu" role="tabpanel">

                                        <div class="menu menu-column menu-fit menu-rounded menu-title-gray-600 menu-icon-gray-400 menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold fs-5 px-6 my-5 my-lg-0"
                                            id="kt_aside_menu" data-kt-menu="true">
                                            <div id="kt_aside_menu_wrapper" class="menu-fit">

                                                <div class="mx-5">



                                                    <div class="text-center px-4">
                                                        <img src="<?php echo $url; ?>assets/media/illustrations/sigma-1/17-dark.png"
                                                            alt="" class="mw-100 mh-300px" />
                                                    </div>

                                                </div>


                                                <div class="menu-item">
                                                    <div class="menu-content pb-2">
                                                        <span
                                                            class="menu-section text-muted text-uppercase fs-8 ls-1">Config</span>
                                                    </div>
                                                </div>
                                                <div class="menu-item">
                                                    <a class="menu-link active" href="../data_spbu/">
                                                        <span class="menu-icon">

                                                            <span class="svg-icon svg-icon-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <rect x="2" y="2" width="9" height="9" rx="2"
                                                                        fill="black" />
                                                                    <rect opacity="0.3" x="13" y="2" width="9"
                                                                        height="9" rx="2" fill="black" />
                                                                    <rect opacity="0.3" x="13" y="13" width="9"
                                                                        height="9" rx="2" fill="black" />
                                                                    <rect opacity="0.3" x="2" y="13" width="9"
                                                                        height="9" rx="2" fill="black" />
                                                                </svg>
                                                            </span>

                                                        </span>
                                                        <span class="menu-title">SPBU</span>
                                                    </a>
                                                </div>

                                                <div class="menu-item">
                                                    <div class="menu-content pt-8 pb-2">
                                                        <span
                                                            class="menu-section text-muted text-uppercase fs-8 ls-1">Account</span>
                                                    </div>
                                                </div>

                                                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                                    <span class="menu-link">
                                                        <span class="menu-icon">

                                                            <span class="svg-icon svg-icon-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path
                                                                        d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
                                                                        fill="black" />
                                                                    <rect opacity="0.3" x="8" y="3" width="8" height="8"
                                                                        rx="4" fill="black" />
                                                                </svg>
                                                            </span>

                                                        </span>
                                                        <span class="menu-title">Admin</span>
                                                        <span class="menu-arrow"></span>
                                                    </span>
                                                    <div class="menu-sub menu-sub-accordion menu-active-bg">


                                                        <div class="menu-item">
                                                            <a class="menu-link" href="../data_admin/">
                                                                <span class="menu-bullet">
                                                                    <span class="bullet bullet-dot"></span>
                                                                </span>
                                                                <span class="menu-title">Lihat Data Admin</span>
                                                            </a>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                                    <span class="menu-link">
                                                        <span class="menu-icon">
 <span class="svg-icon svg-icon-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path
                                                                        d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
                                                                        fill="black" />
                                                                    <rect opacity="0.3" x="8" y="3" width="8" height="8"
                                                                        rx="4" fill="black" />
                                                                </svg>
                                                            </span>

                                                        </span>
                                                        <span class="menu-title">Relasi</span>
                                                        <span class="menu-arrow"></span>
                                                    </span>
                                                    <div class="menu-sub menu-sub-accordion menu-active-bg">

                                                        <div class="menu-item">
                                                            <a class="menu-link"
                                                                href="../data_relasi/index.php?input=tambah">
                                                                <span class="menu-bullet">
                                                                    <span class="bullet bullet-dot"></span>
                                                                </span>
                                                                <span class="menu-title">Tambah Relasi</span>
                                                            </a>
                                                        </div>
                                                        <div class="menu-item">
                                                            <a class="menu-link" href="../data_relasi/">
                                                                <span class="menu-bullet">
                                                                    <span class="bullet bullet-dot"></span>
                                                                </span>
                                                                <span class="menu-title">Kelola Relasi</span>
                                                            </a>
                                                        </div>

                                                    </div>
                                                    
                                                    
                                                   
                                                </div>
                                                
                                                
                                                
                                                <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                                                    <span class="menu-link">
                                                        <span class="menu-icon">

                                                            <span class="svg-icon svg-icon-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path
                                                                        d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
                                                                        fill="black" />
                                                                    <rect opacity="0.3" x="8" y="3" width="8" height="8"
                                                                        rx="4" fill="black" />
                                                                </svg>
                                                            </span>

                                                        </span>
                                                        <span class="menu-title">Member</span>
                                                        <span class="menu-arrow"></span>
                                                    </span>
                                                    <div class="menu-sub menu-sub-accordion menu-active-bg">

                                                      
                                                        <div class="menu-item">
                                                            <a class="menu-link" href="../data_member/">
                                                                <span class="menu-bullet">
                                                                    <span class="bullet bullet-dot"></span>
                                                                </span>
                                                                <span class="menu-title">Lihat Member</span>
                                                            </a>
                                                        </div>

                                                    </div>
                                                    
                                                    
                                                   
                                                </div>

                                                <div class="menu-item">
                                                    <div class="menu-content pt-8 pb-2">
                                                        <span
                                                            class="menu-section text-muted text-uppercase fs-8 ls-1">Master
                                                            Data</span>
                                                    </div>
                                                </div>

                                                <div class="menu-item">
                                                    <a class="menu-link" href="../data_penjualan_voucher/">
                                                        <span class="menu-icon">

                                                            <span class="svg-icon svg-icon-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3"
                                                                        d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z"
                                                                        fill="black" />
                                                                    <path
                                                                        d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z"
                                                                        fill="black" />
                                                                    <path
                                                                        d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z"
                                                                        fill="black" />
                                                                </svg>
                                                            </span>

                                                        </span>
                                                        <span class="menu-title">Penjualan</span>
                                                    </a>
                                                </div>

                                                <div class="menu-item">
                                                    <a class="menu-link" href="../data_transaksi_voucher/">
                                                        <span class="menu-icon">

                                                            <span class="svg-icon svg-icon-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3"
                                                                        d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z"
                                                                        fill="black" />
                                                                    <path
                                                                        d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z"
                                                                        fill="black" />
                                                                    <path
                                                                        d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z"
                                                                        fill="black" />
                                                                </svg>
                                                            </span>

                                                        </span>
                                                        <span class="menu-title">Transaksi </span>
                                                    </a>
                                                </div>

                                                <div class="menu-item">
                                                    <a class="menu-link" href="../data_bank/">
                                                        <span class="menu-icon">

                                                            <span class="svg-icon svg-icon-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path opacity="0.3"
                                                                        d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z"
                                                                        fill="black" />
                                                                    <path
                                                                        d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z"
                                                                        fill="black" />
                                                                    <path
                                                                        d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z"
                                                                        fill="black" />
                                                                </svg>
                                                            </span>

                                                        </span>
                                                        <span class="menu-title">Data Bank </span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="tab-pane fade <?php active_menu($menu3); ?> show"
                                        id="kt_aside_nav_tab_subscription" role="tabpanel">

                                        <div class="mx-5">

                                            <h3 class="fw-bolder text-dark mb-10 mx-0">Report </h3>


                                            <div class="mb-12">

                                                <div
                                                    class="d-flex align-items-center bg-light-warning rounded p-5 mb-7">

                                                    <span class="svg-icon svg-icon-warning me-5">

                                                        <span class="svg-icon svg-icon-1 svg-icon-warning">
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


                                                    <div class="flex-grow-1 me-2">
                                                        <a href="../report/index.php?input=cetak_penjualan"
                                                            class="fw-bolder text-gray-800 text-hover-primary fs-6">Penjualan</a>
                                                        <span class="text-muted fw-bold d-block">Laporan Penjualan
                                                        </span>
                                                    </div>

                                                </div>




                                                <div
                                                    class="d-flex align-items-center bg-light-success rounded p-5 mb-7">

                                                    <span class="svg-icon svg-icon-success me-5">

                                                        <span class="svg-icon svg-icon-1 svg-icon-success">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
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
                                                            </svg>
                                                        </span>

                                                    </span>


                                                    <div class="flex-grow-1 me-2">
                                                        <a href="../report/index.php?input=cetak_transaksi"
                                                            class="fw-bolder text-gray-800 text-hover-primary fs-6">Transaksi</a>
                                                        <span class="text-muted fw-bold d-block">E-Voucher Sudah digunakan</span>
                                                    </div>




                                                </div>




                                                <div class="d-flex align-items-center bg-light-info rounded p-5 mb-7">

                                                    <span class="svg-icon svg-icon-info me-5">

                                                        <span class="svg-icon svg-icon-1 svg-icon-info">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none">
                                                                <path opacity="0.3"
                                                                    d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z"
                                                                    fill="black" />
                                                                <path
                                                                    d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z"
                                                                    fill="black" />
                                                            </svg>
                                                        </span>

                                                    </span>


                                                    <div class="flex-grow-1 me-2">
                                                        <a href="../report/index.php?input=cetak_belum_transaksi"
                                                            class="fw-bolder text-gray-800 text-hover-primary fs-6">Belum
                                                            Transaksi</a>
                                                        <span class="text-muted fw-bold d-block">E-Voucher Belum
                                                            digunakan</span>
                                                    </div>


                                                </div>





                                                <div
                                                    class="d-flex align-items-center bg-light-danger rounded p-5 mb-7">

                                                    <span class="svg-icon svg-icon-danger me-5">

                                                        <span class="svg-icon svg-icon-1 svg-icon-danger">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="23"
                                                                height="24" viewBox="0 0 23 24" fill="none">
                                                                <path
                                                                    d="M21 13V13.5C21 16 19 18 16.5 18H5.6V16H16.5C17.9 16 19 14.9 19 13.5V13C19 12.4 19.4 12 20 12C20.6 12 21 12.4 21 13ZM18.4 6H7.5C5 6 3 8 3 10.5V11C3 11.6 3.4 12 4 12C4.6 12 5 11.6 5 11V10.5C5 9.1 6.1 8 7.5 8H18.4V6Z"
                                                                    fill="black" />
                                                                <path opacity="0.3"
                                                                    d="M21.7 6.29999C22.1 6.69999 22.1 7.30001 21.7 7.70001L18.4 11V3L21.7 6.29999ZM2.3 16.3C1.9 16.7 1.9 17.3 2.3 17.7L5.6 21V13L2.3 16.3Z"
                                                                    fill="black" />
                                                            </svg>
                                                        </span>

                                                    </span>


                                                    <div class="flex-grow-1 me-2">
                                                        <a href="../report/index.php?input=cetak_masa_aktif"
                                                            class="fw-bolder text-gray-800 text-hover-primary fs-6">Kadaluarsa</a>
                                                        <span class="text-muted fw-bold d-block">E-Voucher Kadaluarsa</span>
                                                    </div>


                                                </div>


                                                 <div class="d-flex align-items-center bg-light-dark rounded p-5 mb-7">

                                                    <span class="svg-icon svg-icon-dark me-5">

                                                        <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo2\dist/../src/media/svg/icons\Shopping\Money.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z" fill="#000000" opacity="0.3" transform="translate(11.500000, 12.000000) rotate(-345.000000) translate(-11.500000, -12.000000) "/>
        <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z M11.5,14 C12.6045695,14 13.5,13.1045695 13.5,12 C13.5,10.8954305 12.6045695,10 11.5,10 C10.3954305,10 9.5,10.8954305 9.5,12 C9.5,13.1045695 10.3954305,14 11.5,14 Z" fill="#000000"/>
    </g>
</svg><!--end::Svg Icon--></span>

                                                    </span>


                                                    <div class="flex-grow-1 me-2">
                                                        <a href="../report/index.php?input=cetak_sisa_voucher"
                                                            class="fw-bolder text-gray-800 text-hover-danger fs-6">Sisa Transaksi</a>
                                                        <span class="text-muted fw-bold d-block">Sisa Transaksi E-Voucher</span>
                                                    </div>
                                                    




                                                </div>


                                                <div class="d-flex align-items-center bg-light-primary rounded p-5 mb-7">

                                                    <span class="svg-icon svg-icon-primary me-5">

                                                        <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Communication/Add-user.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <title>Stockholm-icons / Communication / Add-user</title>
                                                                <desc>Created with Sketch.</desc>
                                                                <defs />
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <polygon points="0 0 24 0 24 24 0 24" />
                                                                    <path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                                    <path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                                                                </g>
                                                            </svg><!--end::Svg Icon--></span>

                                                    </span>


                                                    <div class="flex-grow-1 me-2">
                                                        <a href="../report/index.php?input=cetak_relasi"
                                                            class="fw-bolder text-gray-800 text-hover-primary fs-6">Relasi</a>
                                                        <span class="text-muted fw-bold d-block">Laporan Relasi</span>
                                                    </div>
                                                    




                                                </div>


                                                <div
                                                    class="d-flex align-items-center bg-light-primary rounded p-5 mb-7">

                                                    <span class="svg-icon svg-icon-primary me-5">

                                                        <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="black" />
                                                                <path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="black" />
                                                            </svg>
                                                        </span>

                                                    </span>


                                                    <div class="flex-grow-1 me-2">
                                                        <a href="../report/index.php?input=cetak_penjualan_pemakaian"
                                                            class="fw-bolder text-gray-800 text-hover-primary fs-6">Penjualan & Pemakaian</a>
                                                        <span class="text-muted fw-bold d-block">Laporan Penjualan & Pemakaian
                                                        </span>
                                                    </div>

                                                </div>


                                                    
                                            </div>

                                        </div>

                                    </div>

                                    <div class="tab-pane fade <?php active_menu($menu4); ?> show"
                                        id="kt_aside_nav_tab_notifications" role="tabpanel">

                                        <div class="mx-0">

                                            <h3 class="fw-bolder text-dark mx-5 mb-10">Grafik </h3>

                                            <div class="mb-10">

                                                <a href="../grafik/index.php?input=grafik_penjualan"
                                                    class="custom-list d-flex align-items-center px-5 py-4">

                                                    <div class="symbol symbol-40px me-5">
                                                        <span class="symbol-label">
                                                            <span class="svg-icon svg-icon-2x svg-icon-danger">
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
                                                        </span>
                                                    </div>


                                                    <div class="d-flex flex-column flex-grow-1">

                                                        <h5 class="custom-list-title fw-bold text-gray-800 mb-1">
                                                            Penjualan</h5>


                                                        <span class="text-gray-400 fw-bold">Grafik Penjualan</span>

                                                    </div>

                                                </a>


                                                <a href="../grafik/index.php?input=grafik_transaksi"
                                                    class="custom-list d-flex align-items-center px-5 py-4">

                                                    <div class="symbol symbol-40px me-5">
                                                        <span class="symbol-label">
                                                            <span class="svg-icon svg-icon-2x svg-icon-danger">
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


                                                    <div class="d-flex flex-column flex-grow-1">

                                                        <h5 class="custom-list-title fw-bold text-gray-800 mb-1">
                                                            Transaksi
                                                        </h5>


                                                        <span class="text-gray-400 fw-bold">Grafik Transaksi </span>

                                                    </div>

                                                </a>


                                                <a href="../grafik/index.php?input=grafik_relasi"
                                                    class="custom-list d-flex align-items-center px-5 py-4">

                                                    <div class="symbol symbol-40px me-5">
                                                        <span class="symbol-label">
                                                            <span class="svg-icon svg-icon-2x svg-icon-danger">


                                                                <span class="svg-icon svg-icon-primary ">

                                                                    <span class="svg-icon svg-icon-primary ">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="black"></path>
                                                                            <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="black"></rect>
                                                                        </svg>

                                                                    </span>

                                                                </span>

                                                            </span>
                                                        </span>
                                                    </div>


                                                    <div class="d-flex flex-column flex-grow-1">

                                                        <h5 class="custom-list-title fw-bold text-gray-800 mb-1">Relasi
                                                        </h5>


                                                        <span class="text-gray-400 fw-bold">Grafik Relasi
                                                            Terdaftar</span>

                                                    </div>

                                                </a>


                                                <a href="../grafik/index.php?input=grafik_pernominal"
                                                    class="custom-list d-flex align-items-center px-5 py-4">

                                                    <div class="symbol symbol-40px me-5">
                                                        <span class="symbol-label">
                                                            <span class="svg-icon svg-icon-2x svg-icon-danger">
                                                                <span class="svg-icon svg-icon-primary svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <path opacity="0.3" d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z" fill="black"></path>
                                                                        <path d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z" fill="black"></path>
                                                                        <path d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z" fill="black"></path>
                                                                    </svg></span>
                                                            </span>
                                                        </span>
                                                    </div>


                                                    <div class="d-flex flex-column flex-grow-1">

                                                        <h5 class="custom-list-title fw-bold text-gray-800 mb-1">Nominal
                                                        </h5>


                                                        <span class="text-gray-400 fw-bold">Grafik Per Nominal</span>

                                                    </div>

                                                </a>


                                                <a href="../grafik/index.php?input=jenis_bbm"
                                                    class="custom-list d-flex align-items-center px-5 py-4">

                                                    <div class="symbol symbol-40px me-5">
                                                        <span class="symbol-label">
                                                            <span class="svg-icon svg-icon-2x svg-icon-danger">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path
                                                                        d="M13 10.9128V3.01281C13 2.41281 13.5 1.91281 14.1 2.01281C16.1 2.21281 17.9 3.11284 19.3 4.61284C20.7 6.01284 21.6 7.91285 21.9 9.81285C22 10.4129 21.5 10.9128 20.9 10.9128H13Z"
                                                                        fill="black"></path>
                                                                    <path opacity="0.3"
                                                                        d="M13 12.9128V20.8129C13 21.4129 13.5 21.9129 14.1 21.8129C16.1 21.6129 17.9 20.7128 19.3 19.2128C20.7 17.8128 21.6 15.9128 21.9 14.0128C22 13.4128 21.5 12.9128 20.9 12.9128H13Z"
                                                                        fill="black"></path>
                                                                    <path opacity="0.3"
                                                                        d="M11 19.8129C11 20.4129 10.5 20.9129 9.89999 20.8129C5.49999 20.2129 2 16.5128 2 11.9128C2 7.31283 5.39999 3.51281 9.89999 3.01281C10.5 2.91281 11 3.41281 11 4.01281V19.8129Z"
                                                                        fill="black"></path>
                                                                </svg>
                                                            </span>
                                                        </span>
                                                    </div>


                                                    <div class="d-flex flex-column flex-grow-1">

                                                        <h5 class="custom-list-title fw-bold text-gray-800 mb-1">Jenis
                                                            BBM</h5>


                                                        <span class="text-gray-400 fw-bold">Grafik Per Jenis BBM</span>

                                                    </div>

                                                </a>


                                            </div>

                                        </div>

                                    </div>

                                    <div class="tab-pane fade <?php active_menu($menu5); ?> show"
                                        id="kt_aside_nav_tab_authors" role="tabpanel">
                                        <div class="mx-5">
                                            <h3 class="fw-bolder text-dark mx-0 mb-10">Configuration</h3>
                                            <div class="mb-12">

                                            <div class="d-flex align-items-center mb-8">
                                                    <span class="bullet bullet-vertical h-40px bg-success"></span>
                                                    <div class="form-check form-check-custom form-check-solid mx-5">
                                                        <input class="form-check-input" type="checkbox" value="">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <a href="../data_nominal/index.php"
                                                            class="text-gray-800 text-hover-primary fw-bolder fs-6">Nominal E-Voucher</a>
                                                        <span class="text-muted fw-bold d-block"> Pengaturan Nominal E-Voucher</span>
                                                    </div>
                                                </div>

                                             <div class="d-flex align-items-center mb-8">
                                                    <span class="bullet bullet-vertical h-40px bg-success"></span>
                                                    <div class="form-check form-check-custom form-check-solid mx-5">
                                                        <input class="form-check-input" type="checkbox" value="">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <a href="../data_shift/index.php"
                                                            class="text-gray-800 text-hover-primary fw-bolder fs-6">Shift</a>
                                                        <span class="text-muted fw-bold d-block"> Pengaturan Shift</span>
                                                    </div>
                                                </div>


                                                <div class="d-flex align-items-center mb-8">
                                                    <span class="bullet bullet-vertical h-40px bg-success"></span>
                                                    <div class="form-check form-check-custom form-check-solid mx-5">
                                                        <input class="form-check-input" type="checkbox" value="">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <a href="../config/index.php?input=edit&proses=gqeBk5aVaZadY2iWY2tsbGRqZJgxxx3D"
                                                            class="text-gray-800 text-hover-primary fw-bolder fs-6">PPN</a>
                                                        <span class="text-muted fw-bold d-block"> PPN Penjualan E-Voucher</span>
                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-center mb-8">
                                                    <span class="bullet bullet-vertical h-40px bg-success"></span>
                                                    <div class="form-check form-check-custom form-check-solid mx-5">
                                                        <input class="form-check-input" type="checkbox" value="">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <a href="../config/index.php?input=edit&proses=gqeBk5aVaZadY2iWZGhpamNuYpwxxx3D"
                                                            class="text-gray-800 text-hover-primary fw-bolder fs-6">Jatuh Tempo</a>
                                                        <span class="text-muted fw-bold d-block"> Default Jatuh Tempo E-Voucher</span>
                                                    </div>
                                                </div>


                                                <div class="d-flex align-items-center mb-8">
                                                    <span class="bullet bullet-vertical h-40px bg-success"></span>
                                                    <div class="form-check form-check-custom form-check-solid mx-5">
                                                        <input class="form-check-input" type="checkbox" value="">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <a href="../config/index.php?input=edit&proses=gqeBk5aVaZadY2iWZGpqaGVrZJgxxx3D"
                                                            class="text-gray-800 text-hover-primary fw-bolder fs-6">Kadaluarsa</a>
                                                        <span class="text-muted fw-bold d-block"> Default Kadaluarsa E-Voucher</span>
                                                    </div>
                                                </div>


                                                <div class="d-flex align-items-center mb-8">
                                                    <span class="bullet bullet-vertical h-40px bg-success"></span>
                                                    <div class="form-check form-check-custom form-check-solid mx-5">
                                                        <input class="form-check-input" type="checkbox" value="">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <a href="../config/index.php?input=edit&proses=gqeBk5aVaZadY2iWZGpqaGVrZJkxxx3D"
                                                            class="text-gray-800 text-hover-primary fw-bolder fs-6">Email Default</a>
                                                        <span class="text-muted fw-bold d-block"> Email Transaksi Manual</span>
                                                    </div>
                                                </div>
                                             


                                                <div class="d-flex align-items-center mb-8">
                                                    <span class="bullet bullet-vertical h-40px bg-success"></span>
                                                    <div class="form-check form-check-custom form-check-solid mx-5">
                                                        <input class="form-check-input" type="checkbox" value="">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <a href="../home/editor.php"
                                                            class="text-gray-800 text-hover-primary fw-bolder fs-6">Desain Email Link</a>
                                                        <span class="text-muted fw-bold d-block"> Email Link E-Voucher</span>
                                                    </div>
                                                </div>

                                                  <div class="d-flex align-items-center mb-8">
                                                    <span class="bullet bullet-vertical h-40px bg-success"></span>
                                                    <div class="form-check form-check-custom form-check-solid mx-5">
                                                        <input class="form-check-input" type="checkbox" value="">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <a href="../home/editor-pesan-invoice.php"
                                                            class="text-gray-800 text-hover-primary fw-bolder fs-6">Desain Email Invoice</a>
                                                        <span class="text-muted fw-bold d-block"> Email Invoice E-Voucher</span>
                                                    </div>
                                                </div>


                                                <div class="d-flex align-items-center mb-8">
                                                    <span class="bullet bullet-vertical h-40px bg-success"></span>
                                                    <div class="form-check form-check-custom form-check-solid mx-5">
                                                        <input class="form-check-input" type="checkbox" value="">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <a href="../home/editor-pesan-evoucher.php"
                                                            class="text-gray-800 text-hover-primary fw-bolder fs-6">Desain Email Transaksi</a>
                                                        <span class="text-muted fw-bold d-block"> Email Transaksi E-Voucher</span>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="d-flex align-items-center mb-8">
                                                    <span class="bullet bullet-vertical h-40px bg-success"></span>
                                                    <div class="form-check form-check-custom form-check-solid mx-5">
                                                        <input class="form-check-input" type="checkbox" value="">
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <a href="../data_voucher/upload_background.php"
                                                            class="text-gray-800 text-hover-primary fw-bolder fs-6">Background E-Voucher</a>
                                                        <span class="text-muted fw-bold d-block"> Ganti Background E-Voucher</span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="flex-column-auto pt-10 px-5" id="kt_aside_secondary_footer">
                                <a href="https://membercard.cbs-indo.com/admin/login/index.php" target="_blank"
                                    class="btn btn-bg-light btn-color-gray-600 btn-flex btn-active-color-primary flex-center w-100"
                                    data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-trigger="hover"
                                    data-bs-offset="0,5" data-bs-dismiss-="click" title="Login Membercard CBS-INDO">
                                    <span class="btn-label">Smart Membercard </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>


                <button
                    class="btn btn-sm btn-icon bg-body btn-color-gray-700 btn-active-primary position-absolute translate-middle start-100 end-0 bottom-0 shadow-sm d-none d-lg-flex"
                    data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
                    data-kt-toggle-name="aside-minimize" style="margin-bottom: 1.35rem">
                    <span class="svg-icon svg-icon-2 rotate-180">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="black" />
                            <path
                                d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z"
                                fill="black" />
                        </svg>
                    </span>
                </button>
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
                                <div class="d-flex ms-3">
                                    <a class="btn btn-flex flex-center bg-body btn-color-gray-700 btn-active-color-primary w-40px w-md-auto h-40px px-0 px-md-6"
                                        tooltip="New Voucher" href="#" data-bs-toggle="modal"
                                        data-bs-target="#buat_e_voucher">

                                        <span class="svg-icon svg-icon-2 svg-icon-primary me-0 me-md-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                                    transform="rotate(-90 11.364 20.364)" fill="black" />
                                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                                            </svg>
                                        </span>

                                        <span class="d-none d-md-inline">Penjualan E-Voucher</span>
                                    </a>
                                </div>


                                <div class="d-flex ms-3">
                                    <a href="#"
                                        class="btn btn-flex flex-center bg-body btn-color-gray-700 btn-active-color-primary w-40px w-md-auto h-40px px-0 px-md-6"
                                        tooltip="New App" data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends"
                                        id="bukaKamera">

                                        <span class="svg-icon svg-icon-2 svg-icon-primary me-0 me-md-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                                    transform="rotate(-90 11.364 20.364)" fill="black" />
                                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                                            </svg>
                                        </span>

                                        <span class="d-none d-md-inline">Manual Transaksi</span>
                                    </a>
                                </div>
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


    <button id="kt_explore_toggle"
        class="explore-toggle btn btn-sm bg-body btn-color-gray-700 btn-active-primary shadow-sm position-fixed px-5 fw-bolder zindex-2 top-50 mt-10 end-0 transform-90 fs-6 rounded-top-0"
        title="Filter & Pencarian E-Voucher" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-trigger="hover">
        <span id="kt_explore_toggle_label">Filter & Pencarian</span>
    </button>

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
                                alert("Camera not found!")
                            }
                        })
                        .catch(err => console.error(err));
                }

                if (!navigator.mediaDevices) {
                    alert('Cannot access camera.');
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
                const relasiList = document.getElementById('relasi-list');
                const cleanQuery = query.trim();

                if (cleanQuery === '') {
                    // Default info message to search for a relation
                    relasiList.innerHTML = `
                        <div class="d-flex flex-column flex-center p-10 h-100 text-center">
                            <span class="svg-icon svg-icon-3x svg-icon-muted mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M21.7 20.3L18 16.6C19.3 15 20 13 20 11C20 6 16 2 11 2C6 2 2 6 2 11C2 16 6 20 11 20C13 20 15 19.3 16.6 18L20.3 21.7C20.5 21.9 20.8 22 21 22C21.2 22 21.5 21.9 21.7 21.7C22.1 21.3 22.1 20.7 21.7 20.3ZM11 18C7.1 18 4 14.9 4 11C4 7.1 7.1 4 11 4C14.9 4 18 7.1 18 11C18 14.9 14.9 18 11 18Z" fill="black"/>
                                </svg>
                            </span>
                            <div class="fw-semibold fs-6 text-gray-500">Silakan masukkan nama relasi pada kolom pencarian di atas untuk mencari relasi.</div>
                        </div>
                    `;
                    return;
                }

                // Send an AJAX request to the server
                const xhr = new XMLHttpRequest();
                xhr.open('GET', '<?php echo $url; ?>search.php?query=' + encodeURIComponent(cleanQuery), true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        const results = JSON.parse(xhr.responseText);
                        relasiList.innerHTML = ''; // Clear the current list

                        if (results.length === 0) {
                            // No results found message with link to register a new relation
                            relasiList.innerHTML = `
                                <div class="d-flex flex-column flex-center p-10 h-100 text-center">
                                    <span class="svg-icon svg-icon-3x svg-icon-warning mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"/>
                                            <rect x="11" y="14" width="2" height="2" rx="1" fill="black"/>
                                            <rect x="11" y="6" width="2" height="6" rx="1" fill="black"/>
                                        </svg>
                                    </span>
                                    <div class="fw-semibold fs-6 text-gray-600 mb-3">Relasi belum terdaftar.</div>
                                    <a href="../data_relasi/index.php?input=tambah" class="btn btn-sm btn-light-primary fw-bold">Daftar Relasi Baru</a>
                                </div>
                            `;
                            return;
                        }

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