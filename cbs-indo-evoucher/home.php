<?php
ob_start();
if (empty($p)) {
    header("Location: index.php?p=home");
    die();
}
if (isset($_GET['code'])) {
    header("Location: index.php?p=login&code=" . $_GET['code']);
    die();
}



$ip        = $_SERVER['REMOTE_ADDR'];
$useragent = $_SERVER['HTTP_USER_AGENT'];
$token     = sha1($ip . $useragent . $key);
$token     = crypt($token, $key);
$ip        = $_SERVER['REMOTE_ADDR'];
$useragent = $_SERVER['HTTP_USER_AGENT'];
$token     = sha1($ip . $useragent . $key);
$token     = crypt($token, $key);

$request_status = new RequestPencarianStatus("status");
$nomor_invoice  = decrypt($_COOKIE[ConfigHome::$LOGIN_KEY_NAME]);

$proses = decrypt($_COOKIE[ConfigHome::$LOGIN_KEY_NAME]);
$sql    = mysql_query("SELECT * FROM data_penjualan_voucher where id_penjualan = '$proses'");
$data   = mysql_fetch_array($sql);

$id_relasi          = $data['id_relasi'];
$nama_relasi        = baca_database("", "nama", "SELECT * FROM data_relasi where id_relasi='$id_relasi'");
$nominal            = $data['nominal'];
$jumlah_voucher     = $data['jumlah_voucher'];
$tanggal_dibuka     = $data['tanggal_dibuka'];
$tanggal_kadaluarsa = $data['tanggal_kadaluarsa'];
$id_spbu            = $data['id_spbu'];
$password           = $data['password_voucher'];
$nomor_invoice      = $data['id_penjualan'];

$spbus = QB::table("data_penjualan_voucher_spbu")
    ->join("data_spbu", "data_penjualan_voucher_spbu.id_spbu", "=", "data_spbu.id_spbu")
    ->where("data_penjualan_voucher_spbu.id_penjualan_voucher", $proses)
    ->get();

$email             = baca_database("", "email", "SELECT * FROM data_relasi where id_relasi='$id_relasi'");
$nama_spbu         = baca_database("", "nama_spbu", "SELECT * FROM data_spbu where id_spbu='$id_spbu'");
$sub_total         = $data['sub_total'];
$persentase_ppn    = $data['persentase_ppn'];
$ppn               = $data['ppn'];
$total_bayar       = $data['total_bayar'];
$tanggal_penjualan = $data['tanggal_penjualan'];
$cek               = cek_database("data_penjualan_voucher", "id_penjualan", $nomor_invoice, "");

if ($_COOKIE[ConfigHome::$LOGIN_KEY_USER] == $token) {
    // tetap di halaman ini
} else {
?>
    <script>
        location.href = "index.php?p=login";
    </script>
<?php
    die();
}

if (empty($_COOKIE[ConfigHome::$LOGIN_KEY_NAME])) {
?>
    <script>
        location.href = "index.php?p=login";
    </script>
<?php
    die();
} else {
    // tetap di halaman ini
}


// response_pdf($data);

?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

<div style="display: none;">

    <div id="content" class="container" style="padding: 50px">

        <div class="row">
            <div class="col-md-12">
                <div class="mb-3">
                    <strong>Tanggal Kadaluarsa:</strong>
                    <span class="ms-2"><?php echo format_indo_no_jam($tanggal_kadaluarsa); ?></span>
                </div>
                <div class="mb-3">
                    <strong>Nama PT:</strong>
                    <span class="ms-2"><?php echo $nama_relasi; ?></span>
                </div>
                <div class="mb-3">
                    <strong>Email:</strong>
                    <span class="ms-2"><?php echo $email; ?></span>
                </div>
                <br>
                <table class="table table-bordered">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800">
                            <th scope="col">Nomor</th>
                            <!-- <th scope="col">Tanggal</th> -->
                            <th scope="col">Kode Voucher</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $querytabel = "SELECT * FROM data_voucher
                                WHERE id_penjualan = '$nomor_invoice'
                                ORDER BY status='Unused' DESC,
                                        tanggal_kadaluarsa <= NOW() DESC,
                                        status='Used' DESC";
                        $i = 0;
                        $proses = mysql_query($querytabel);
                        while ($data = mysql_fetch_array($proses)) {
                            $kode_voucher = $data['id_voucher'];
                            $kode_qrcode  = $data['qrcode'];
                            $qrcode       = $kode_qrcode;
                            $id_penjualan = $nomor_invoice;
                            $status       = $data['status'];
                            $file_voucher = $kode_qrcode;
                            $i            = $i + 1;
                        ?>

                            <tr>
                                <td><?php echo $i ?></td>
                                <!-- <td><?php echo format_indo_no_jam($tanggal_kadaluarsa); ?></td> -->
                                <td>ID<?php echo $kode_voucher; ?></td>
                                <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    <?php
                                    if ($status == "Unused") {
                                        if ($tanggal_kadaluarsa <= date('Y-m-d')) {
                                            echo '<span style="color:red;"> Telah Kadaluarsa</span>';
                                        } else {
                                            echo '<span style="color:blue;"> Belum digunakan</span>';
                                        }
                                    } else {
                                        ?>
                                        <span style="cursor:pointer;" onclick="window.location.href='../data_transaksi_voucher/index.php?input=detail&id_voucher=<?php echo $kode_voucher;?>'" class="badge badge-light fw-bolder my-2">Telah digunakan</span>
                                        <span style="cursor:pointer;" onclick="window.location.href='../data_transaksi_voucher/index.php?input=detail&id_voucher=<?php echo $kode_voucher;?>'"  class="badge badge-light fw-bolder my-2"><?php echo (baca_database("","nama","select * from data_transaksi_voucher,data_member where data_transaksi_voucher.id_member=data_member.id_member and id_voucher='$kode_voucher'"));?></span>
                                        <?php
                                    } ?>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>


<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">List
                    Voucher </h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="index.php?p=home" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">List Voucher</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <!--begin::Actions-->
            <form>
                <?=
                createHiddenFieldsFromGetExclude(['status', 'page', 'perPage']);
                ?>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::Filter menu-->
                    <div class="m-0">
                        <!--begin::Menu toggle-->
                        <a href="#" class="btn btn-sm btn-flex btn-secondary fw-bold" data-kt-menu-trigger="click"
                            data-kt-menu-placement="bottom-end">
                            <i class="ki-outline ki-filter fs-6 text-muted me-1"></i>Filter</a>
                        <!--end::Menu toggle-->
                        <!--begin::Menu 1-->
                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                            id="kt_menu_64b77635bbd30">
                            <!--begin::Header-->
                            <div class="px-7 py-5">
                                <div class="fs-5 text-dark fw-bold">Filter Options</div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Menu separator-->
                            <div class="separator border-gray-200"></div>
                            <!--end::Menu separator-->
                            <!--begin::Form-->
                            <div class="px-7 py-5">
                                <!--begin::Input group-->
                                <div class="mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fw-semibold">Status:</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <div>
                                        <select class="form-select form-select-solid"
                                            data-kt-select2="true" data-close-on-select="false"
                                            data-placeholder="Select option" data-dropdown-parent="#kt_menu_64b77635bbd30"
                                            data-allow-clear="true" name="status">
                                            <option <?= $request_status->isValid() ? '' : 'selected' ?>>Semua</option>
                                            <option>Used</option>
                                            <option>Unused</option>
                                        </select>
                                    </div>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <?php /*
                            <div class="mb-10">
                                <!--begin::Label-->
                                <label class="form-label fw-semibold">Member Type:</label>
                                <!--end::Label-->
                                <!--begin::Options-->
                                <div class="d-flex">
                                    <!--begin::Options-->
                                    <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                        <span class="form-check-label">Author</span>
                                    </label>
                                    <!--end::Options-->
                                    <!--begin::Options-->
                                    <label class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="2" checked="checked" />
                                        <span class="form-check-label">Customer</span>
                                    </label>
                                    <!--end::Options-->
                                </div>
                                <!--end::Options-->
                        </div>
                                */ ?>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <?php /*
                            <div class="mb-10">
                                <!--begin::Label-->
                                <label class="form-label fw-semibold">Notifications:</label>
                                <!--end::Label-->
                                <!--begin::Switch-->
                                <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="" name="notifications"
                                        checked="checked" />
                                    <label class="form-check-label">Enabled</label>
                                </div>
                                <!--end::Switch-->
                            </div>
                                */ ?>
                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="d-flex justify-content-end">
                                    <a href="index.php?p=home" class="btn btn-sm btn-light btn-active-light-primary me-2"
                                        data-kt-menu-dismiss="true">Reset</a>
                                    <button type="submit" class="btn btn-sm btn-primary"
                                        data-kt-menu-dismiss="true">Apply</button>
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Form-->
                        </div>
                        <!--end::Menu 1-->
                    </div>
                    <!--end::Filter menu-->
                    <!--begin::Secondary button-->
                    <!--end::Secondary button-->
                    <!--begin::Primary button-->
                    <a href="index.php?p=home" class="btn btn-sm fw-bold btn-primary">
                        <i class="fas fa-undo fs-5 me-2"></i>
                        Reset
                    </a>
                    <button id="download" type="button" class="btn btn-sm fw-bold btn-primary">
                        <i class="fas fa-print fs-5 me-2"></i>
                        Cetak
                    </button>
                    <!--end::Primary button-->
                </div>
            </form>
            <!--end::Actions-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Row-->
            <div class="d-flex flex-column flex-xl-row ">

                <div class="flex-column flex-lg-row-auto w-100 w-xl-300px mb-10">

                    <div class="card mb-5 mb-xl-8">

                        <div class="card-body">



                            <div class="d-flex flex-center flex-column py-5">
                                <div class=" ">
                                    <center>
                                        <img src="https://media.lordicon.com/icons/wired/outline/1335-qr-code.gif" style="width: 50%;">
                                    </center>
                                    <br>
                                </div>
                                <a href="#" class="fs-3 text-gray-800 text-hover-warning fw-bolder mb-3"><?php echo $nama_relasi; ?></a>
                                <div class="mb-9">
                                    <div class="badge badge-lg badge-light-info d-inline">Jumlah : <?php echo $jumlah_voucher; ?> E-Voucher</div>
                                </div>
                            </div>

                            <div class="d-flex flex-stack fs-4 py-3">
                                <div class="fw-bolder rotate collapsible collapsed" data-bs-toggle="collapse" href="#kt_user_view_details" role="button" aria-expanded="false" aria-controls="kt_user_view_details">Detail
                                    <span class="ms-2 rotate-180">

                                        <span class="svg-icon svg-icon-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black"></path>
                                            </svg>
                                        </span>

                                    </span>
                                </div>
                                <style>
                                    /* Styles for buttons inside SweetAlert */
                                    #printInvoiceButton,
                                    #printReceiptButton {
                                        background-color: #008CBA;
                                        /* Blue */
                                        border: none;
                                        color: white;
                                        padding: 10px 20px;
                                        text-align: center;
                                        text-decoration: none;
                                        display: inline-block;
                                        font-size: 14px;
                                        margin: 4px 2px;
                                        cursor: pointer;
                                        border-radius: 4px;
                                        transition: background-color 0.3s;
                                    }

                                    #printInvoiceButton:hover,
                                    #printReceiptButton:hover {
                                        background-color: #007bb5;
                                    }
                                </style>


                                <!--<span data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="Print Invoice Transaksi Penjualan">-->
                                <!--    <a target="_blank" id="showPrintOptions" class="btn btn-sm btn-light-primary">Print Invoice</a>-->
                                <!--</span>-->


                                <script>
                                    document.getElementById('showPrintOptions').addEventListener('click', function() {
                                        Swal.fire({
                                            title: 'Print Options',
                                            html: `
                    <button id="printInvoiceButton">Print Invoice</button>
                    <button id="printReceiptButton">Print Kwitansi</button>
                `,
                                            showConfirmButton: false,
                                            didOpen: () => {
                                                // Handle Print Invoice
                                                const printInvoiceButton = document.getElementById('printInvoiceButton');
                                                printInvoiceButton.addEventListener('click', function() {
                                                    window.open('admin/app/page/data_voucher/invoice.php?kode=<?php echo encrypt($nomor_invoice); ?>');
                                                });

                                                // Handle Print Receipt
                                                const printReceiptButton = document.getElementById('printReceiptButton');
                                                printReceiptButton.addEventListener('click', function() {
                                                    window.open('admin/app/page/data_voucher/kwitansi.php?kode=<?php echo encrypt($nomor_invoice); ?>');
                                                });
                                            }
                                        });
                                    });

                                    function fetchDocument(url) {
                                        fetch(url)
                                            .then(response => response.text())
                                            .then(content => {
                                                printDocument(content);
                                            })
                                            .catch(error => {
                                                console.error('Error fetching document:', error);
                                                Swal.fire('Error', 'Could not load document for printing.', 'error');
                                            });
                                    }

                                    function printDocument(content) {
                                        const printWindow = window.open('', '_blank', 'width=800,height=600');
                                        printWindow.document.write('<html><head><title>Print</title></head><body>');
                                        printWindow.document.write(content);
                                        printWindow.document.write('</body></html>');
                                        printWindow.document.close();
                                        printWindow.focus();
                                        printWindow.print();
                                        printWindow.close();
                                    }
                                </script>
                            </div>

                            <div class="separator"></div>

                            <div id="kt_user_view_details" class="collapse">
                                <div class="pb-5 fs-6">

                                    <div class="fw-bolder mt-5">No Invoice</div>
                                    <div class="text-gray-600">#<?php echo $nomor_invoice; ?></div>


                                    <div class="fw-bolder mt-5">Nama Relasi</div>
                                    <div class="text-gray-600">
                                        <a href="#" class="text-gray-600 text-hover-primary"><?php echo $nama_relasi; ?></a>
                                    </div>

                                    <div class="fw-bolder mt-5">Email</div>
                                    <div class="text-gray-600">
                                        <a href="#" class="text-gray-600 text-hover-primary"><?php echo $email; ?></a>
                                    </div>



                                    <div class="fw-bolder mt-5">Tanggal Dibuka</div>
                                    <div class="text-gray-600"><?php echo format_indo_no_jam($tanggal_dibuka); ?></div>


                                    <div class="fw-bolder mt-5">Kadaluarsa</div>
                                    <div class="text-gray-600"><?php echo format_indo_no_jam($tanggal_kadaluarsa); ?></div>


                                    <div class="fw-bolder mt-5">SPBU</div>
                                    <div class="text-gray-600">
                                        <?php
                                        foreach ($spbus as $spbu) {
                                            echo $spbu->nama_spbu . '<br>';
                                        }
                                        if (sizeof($spbus) == 0) {
                                            echo '-';
                                        }
                                        ?>
                                    </div>

                                    <div class="fw-bolder mt-5">Password</div>
                                    <div class="position-relative">
                                        <div class="text-gray-600">
                                            <span id="password-text"><?php echo str_repeat('*', strlen($password)); ?></span>
                                            <a class="btn btn-sm btn-icon btn-light-primary position-absolute translate-middle-y top-50 end-0 me-n3" data-bs-toggle="tooltip" data-bs-placement="top" title="Show/Hide" onclick="$('#password-text').text() === '<?php echo str_repeat('*', strlen($password)); ?>' ? $('#password-text').text('<?php echo $password; ?>') : $('#password-text').text('<?php echo str_repeat('*', strlen($password)); ?>')">
                                                <i id="password-icon" class="bi bi-eye-slash fs-2"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="fw-bolder mt-5">Nominal</div>
                                    <div class="text-gray-600"><?php echo rupiah($nominal); ?></div>


                                    <div class="fw-bolder mt-5">Jumlah</div>
                                    <div class="text-gray-600"><?php echo $jumlah_voucher; ?> E-Vocuher</div>

                                    <div class="fw-bolder mt-5">Subtotal </div>
                                    <div class="text-gray-600"><?php echo rupiah($sub_total); ?></div>

                                    <?php if ($persentase_ppn > 0) { ?>
                                        <div class="fw-bolder mt-5">PPN <?php echo $persentase_ppn; ?>% </div>
                                        <div class="text-gray-600"><?php echo rupiah($ppn); ?></div>
                                    <?php } ?>

                                    <div class="fw-bolder mt-5">Total Bayar </div>
                                    <div class="text-gray-600"><?php echo rupiah($total_bayar); ?></div>

                                </div>
                            </div>

                        </div>

                    </div>


                    <div class="card mb-5 mb-xl-8">

                        <div class="card-header border-0">
                            <div class="card-title">
                                <h3 class="fw-bolder m-0">Share Akun Voucher</h3>
                            </div>
                        </div>


                        <div class="card-body pt-2">

                            <div class="notice d-flex bg-light-info rounded border-info border border-dashed mb-9 p-6">


                                <span class="svg-icon svg-icon-2tx svg-icon-info me-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M22 19V17C22 16.4 21.6 16 21 16H8V3C8 2.4 7.6 2 7 2H5C4.4 2 4 2.4 4 3V19C4 19.6 4.4 20 5 20H21C21.6 20 22 19.6 22 19Z" fill="black"></path>
                                        <path d="M20 5V21C20 21.6 19.6 22 19 22H17C16.4 22 16 21.6 16 21V8H8V4H19C19.6 4 20 4.4 20 5ZM3 8H4V4H3C2.4 4 2 4.4 2 5V7C2 7.6 2.4 8 3 8Z" fill="black"></path>
                                    </svg>
                                </span>



                                <div class="d-flex flex-stack flex-grow-1">

                                    <div class="fw-bold">
                                        <div class="fs-6 text-gray-700">Bagikan Voucher secara keseluruhan kepada relasi dengan akses password.
                                        </div>
                                    </div>

                                </div>

                            </div>


                            <div class="d-flex flex-stack fs-4 py-3">
                                <div class="fw-bolder rotate collapsible collapsed" data-bs-toggle="collapse" href="#kt_user_view_details" role="button" aria-expanded="false" aria-controls="kt_user_view_details">

                                </div>
                                <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="" data-bs-original-title="Klik untuk mendapatkan link Voucher">
                                    <a class="btn btn-sm btn-light-primary" id="showAlert">Share Voucher</a>
                                </span>
                            </div>
                        </div>

                    </div>


                    <!-- <div class="card mb-5 mb-xl-8"> -->
                    <!---->
                    <!--     <div class="card-header border-0"> -->
                    <!--         <div class="card-title"> -->
                    <!--             <h3 class="fw-bolder m-0">Selesai </h3> -->
                    <!--         </div> -->
                    <!--     </div> -->
                    <!---->
                    <!---->
                    <!--     <div class="card-body pt-2"> -->
                    <!--         <p class="text-muted mb-0">Klik Selesai jika telah selesai melakukan penjualan & kembali ke dashboard home utama</p> -->
                    <!--         <br> -->
                    <!--         <div class="flex-column-auto pt-1 px-5" id="kt_aside_secondary_footer"> -->
                    <!--             <a href="../home/" class="btn btn-bg-light btn-color-gray-600 btn-flex btn-active-color-primary flex-center w-100" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-trigger="hover" data-bs-offset="0,5" data-bs-dismiss-="click" title="" data-bs-original-title="Selesai & kembali ke dashboard utama"> -->
                    <!--                 <span class="btn-label">Selesai </span> -->
                    <!--             </a> -->
                    <!--         </div> -->
                    <!--     </div> -->
                    <!---->
                    <!-- </div> -->

                </div>
                <style>
                    /* Styles for buttons inside SweetAlert */
                    #copyLinkButton,
                    #sendEmailButton {
                        background-color: #4CAF50;
                        /* Green */
                        border: none;
                        color: white;
                        padding: 10px 20px;
                        text-align: center;
                        text-decoration: none;
                        display: inline-block;
                        font-size: 14px;
                        margin: 4px 2px;
                        cursor: pointer;
                        border-radius: 4px;
                        transition: background-color 0.3s;
                    }

                    #copyLinkButton:hover,
                    #sendEmailButton:hover {
                        background-color: #45a049;
                    }
                </style>

                <script>
                    document.getElementById('showAlert').addEventListener('click', function() {
                        const link = 'https://e-voucher.cbs-indo.com/login/<?php echo encrypt($nomor_invoice); ?>';

                        Swal.fire({
                            title: 'E-Voucher link',
                            html: `
                    <p class="badge badge-light-success" id="linkText">${link}</p><br>
                    <button id="copyLinkButton">Copy Link</button>
                    <!-- <button id="sendEmailButton">Send Link via Email</button> -->
                `,
                            showConfirmButton: false,
                            didOpen: () => {
                                // Handle Copy Link
                                const copyLinkButton = document.getElementById('copyLinkButton');
                                copyLinkButton.addEventListener('click', function() {
                                    copyToClipboard(link);
                                    Swal.fire('Copied!', 'The link has been copied to your clipboard.', 'success');
                                });

                                // Handle Send Email
                                const sendEmailButton = document.getElementById('sendEmailButton');
                                sendEmailButton.addEventListener('click', function() {
                                    sendEmail(link);
                                });
                            }
                        });
                    });

                    function copyToClipboard(text) {
                        const textarea = document.createElement('textarea');
                        textarea.value = text;
                        document.body.appendChild(textarea);
                        textarea.select();
                        document.execCommand('copy');
                        document.body.removeChild(textarea);
                    }

                    function sendEmail(link) {
                        const email = 'fajarudinsidik@gmail.com';
                        window.location.href = `mailto:${email}?subject=Check%20out%20this%20link&body=Here%20is%20the%20link%20you%20requested:%20${encodeURIComponent(link)}`;
                    }
                </script>


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

                            if ($request_status->isValid()) {
                                $querytabel = "SELECT * FROM data_voucher WHERE id_penjualan = '$nomor_invoice' AND status = '" . $request_status->getValue() . "' ORDER BY id_voucher DESC LIMIT $startRow, $dataPerPage";
                                $querypagination = "SELECT count(id_voucher) as total FROM data_voucher WHERE id_penjualan = '$nomor_invoice' AND status = '" . $request_status->getValue() . "'";
                            } else {
                                $querytabel = "SELECT * FROM data_voucher WHERE id_penjualan = '$nomor_invoice' ORDER BY id_voucher DESC LIMIT $startRow, $dataPerPage";
                                $querypagination = "SELECT count(id_voucher) as total FROM data_voucher WHERE id_penjualan = '$nomor_invoice'";
                            }

                            $proses = mysql_query($querytabel);
                            while ($data = mysql_fetch_array($proses)) {
                                $kode_voucher = $data['id_voucher'];
                                $kode_qrcode  = $data['qrcode'];
                                $qrcode       = $kode_qrcode;
                                $id_penjualan = $nomor_invoice;
                                $status       = $data['status'];
                                $file_voucher = $kode_qrcode;
                                $i            = $i + 1;

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
                                                <span class="badge badge-light-info fs-8 fw-bolder"><?php echo rupiah($nominal); ?></span>
                                                <h3 class="lead pt-3">E-Voucher BBM </h3>
                                                <p class="text-muted mb-0"><?php echo $nama_relasi; ?></p>
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
                                                            echo ' <span class="badge badge-light    fw-bolder my-2">Telah Kadaluarsa</span>';
                                                        } else { ?>
                                                            <a href="admin/app/page/data_voucher/voucher.php?kode=<?php echo $kode_voucher; ?>&kodeqr=<?php echo $kode_qrcode; ?>" target="_blank" class="btn btn-sm btn-light-primary">
                                                                Download
                                                            </a>
                                                        <?php }
                                                    } else {
                                                        ?>

                                                        <span  class="badge badge-light fw-bolder my-2">Telah digunakan</span><br>
                                        <span   class="badge badge-light fw-bolder my-2"><?php echo (baca_database("","nama","select * from data_transaksi_voucher,data_member where data_transaksi_voucher.id_member=data_member.id_member and id_voucher='$kode_voucher'"));?></span>
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


                            <div class="col-sm-12">
                                <div class="coupon bg-white rounded mb-3 ">
                                    <center>
                                        <?php
                                        $url_pagination = "?p=home&status=" . $request_status->getvalue() . "&proses=" . (isset($_GET['proses']) ? $_GET['proses'] : '') . "&";
                                        Pagination_custom_url($url_pagination, $page, $dataPerPage, $querypagination);
                                        ?>
                                    </center>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
            <!--end::Row-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>

<script>
    document.getElementById('download').addEventListener('click', () => {
        const element = document.getElementById('content');
        html2pdf().set({
            pagebreak: {
                mode: ['avoid-all', 'css', 'legacy'],
                padding: '1.5cm'
            }
        }).from(element).save('document.pdf');
    });
</script>