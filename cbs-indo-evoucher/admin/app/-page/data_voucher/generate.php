<?php function debug_get()
{ ?>
    <div class="container">
        <h1>GET Parameters</h1>
        <p>Below are all the GET parameters received from the URL:</p>
        <pre><?php
                // Check if there are any GET parameters
                if (!empty($_GET)) {
                    // Display the GET parameters
                    print_r($_GET);
                } else {
                    echo 'No GET parameters received.';
                }
                ?></pre>
    </div>
<?php } ?>

<?php

// error_reporting(E_ALL);

// debug_get();
$id_relasi = $_GET['id_relasi'];
$nama_relasi = $_GET['nama_relasi'];
$nominal = $_GET['nominal'];
$jumlah_voucher = $_GET['jumlah_voucher'];
$tanggal_dibuka = $_GET['tanggal_dibuka'];
$tanggal_kadaluarsa = $_GET['tanggal_kadaluarsa'];
$id_spbu = $_GET['spbu'];
if (is_array($id_spbu) && count($id_spbu) > 0) {
    $ids_spbu = $id_spbu;
    $id_spbu = $id_spbu[0];
} else {
    exit('SPBU tidak boleh kosong, silahkan pilih SPBU terlebih dahulu.');
}
$password = $_GET['Password'];
$nomor_invoice = $_GET['nomor_invoice'];
$email = baca_database("", "email", "SELECT * FROM data_relasi where id_relasi='$id_relasi'");
$nama_spbu = baca_database("", "nama_spbu", "SELECT * FROM data_spbu where id_spbu='$id_spbu'");
$sub_total = $jumlah_voucher * $nominal;
$persentase_ppn = SettingVoucher::get_number(SettingVoucher::$ppn);
$ppn = $persentase_ppn / 100 * $sub_total;
$total_bayar = $sub_total + $ppn;
$tanggal_penjualan = date('Y-m-d H:i:s');
$id_admin = decrypt($_COOKIE['kodene']);
$cek = cek_database("data_penjualan_voucher", "id_penjualan", $nomor_invoice, "");
if ($cek == "nggak") {
    $query = mysql_query("INSERT INTO data_penjualan_voucher VALUES (
        '$nomor_invoice'
        ,'$id_relasi'
        ,'$tanggal_penjualan'
        ,'$jumlah_voucher'
        ,'$nominal'
        ,'$password'
        ,'$tanggal_dibuka'
        ,'$tanggal_kadaluarsa'
        ,'$id_spbu'
        ,'$sub_total'
        ,'$persentase_ppn'
        ,'$ppn'
        ,'$total_bayar'
        ,'$id_admin'
    )");




    try {

        QB::pdo()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        QB::pdo()->beginTransaction();
        foreach ($ids_spbu as $value) {
            $id_penjualan_voucher_spbu = id_otomatis("data_penjualan_voucher_spbu", "id_penjualan_voucher_spbu", "50");
            QB::table("data_penjualan_voucher_spbu")
                ->insert([
                    'id_penjualan_voucher'      => $nomor_invoice,
                    'id_spbu'                   => $value,
                    'id_penjualan_voucher_spbu' => $id_penjualan_voucher_spbu
                ]);
        }
        QB::pdo()->commit();
    } catch (Exception $e) {
        QB::pdo()->rollBack();
        error_log(date('d-m-Y H:i:s') . " - " . basename(__FILE__) . ":" . __LINE__ . " - Error: " . $e->getMessage() . "\n", 3, "error.log");
        // echo "Error: " . $e->getMessage();
        // die();
    }
}
?>

<div class="container-xxl" id="kt_content_container">

    <div class="d-flex flex-column flex-xl-row ">

        <div class="flex-column flex-lg-row-auto w-100 w-xl-300px mb-10">

            <div class="card mb-5 mb-xl-8">

                <div class="card-body">



                    <div class="d-flex flex-center flex-column py-5">
                        <div class=" ">
                            <img src="https://i.pinimg.com/originals/54/19/db/5419db8fc2b9d8858d3cb46ca42600da.gif" style="width: 100%;">
                        </div>
                        <a href="#" class="fs-3 text-gray-800 text-hover-warning fw-bolder mb-3">Transaksi Berhasil</a>
                        <div class="mb-9">
                            <div class="badge badge-lg badge-light-info d-inline"><?php echo $jumlah_voucher; ?> E-Voucher Berhasil dibuat</div>
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

<span data-bs-toggle="tooltip" data-bs-trigger="hover" title=""
                            data-bs-original-title="Print & Share Invoice Transaksi Penjualan">
                            <a target="_blank" id="showPrintOptions" class="btn btn-sm btn-light-primary">Print & Share
                                Invoice</a>
                        </span>


                        <script>
    document.getElementById('showPrintOptions').addEventListener('click', function() {
        Swal.fire({
            title: 'Print & Share Options',
            html: `
                <button id="printInvoiceButton" class="swal-button">Print Invoice</button>
                <button id="printReceiptButton" class="swal-button">Print Kwitansi</button>
                <button id="sendEmailInvoiceButton" class="btn btn-primary">Send Invoice via Email</button>
            `,
            showConfirmButton: false,
            didOpen: () => {
                // Handle Print Invoice
                const printInvoiceButton = document.getElementById('printInvoiceButton');
                printInvoiceButton.addEventListener('click', function() {
                    window.open('invoice.php?kode=<?php echo encrypt($nomor_invoice); ?>');
                });

                // Handle Print Receipt
                const printReceiptButton = document.getElementById('printReceiptButton');
                printReceiptButton.addEventListener('click', function() {
                    window.open('kwitansi.php?kode=<?php echo encrypt($nomor_invoice); ?>');
                });

                // Handle Send Invoice via Email
                const sendEmailInvoiceButton = document.getElementById('sendEmailInvoiceButton');
                sendEmailInvoiceButton.addEventListener('click', function() {
                    // Bisa langsung buka halaman PHP yang memproses pengiriman email
                    window.location.href = '../share_invoice/send_mail.php?kode=<?php echo encrypt($nomor_invoice); ?>';
                });
            }
        });
    });

    // Fungsi fetchDocument dan printDocument tetap ada jika masih dibutuhkan di tempat lain
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

                            <div class="fw-bolder mt-5">No Invouce</div>
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
                            <div class="text-gray-600"><?php echo $nama_spbu; ?></div>

                            <div class="fw-bolder mt-5">Password</div>
                            <div class="text-gray-600"><?php echo $password; ?></div>

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


            <div class="card mb-5 mb-xl-8">

                <div class="card-header border-0">
                    <div class="card-title">
                        <h3 class="fw-bolder m-0">Selesai </h3>
                    </div>
                </div>


                <div class="card-body pt-2">
                    <p class="text-muted mb-0">Klik Selesai jika telah selesai melakukan penjualan & kembali ke dashboard home utama</p>
                    <br>
                    <div class="flex-column-auto pt-1 px-5" id="kt_aside_secondary_footer">
                        <a href="../home/" class="btn btn-bg-light btn-color-gray-600 btn-flex btn-active-color-primary flex-center w-100" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-trigger="hover" data-bs-offset="0,5" data-bs-dismiss-="click" title="" data-bs-original-title="Selesai & kembali ke dashboard utama">
                            <span class="btn-label">Selesai </span>
                        </a>
                    </div>
                </div>

            </div>

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
                const link = '<?php echo pengaturan("url_evoucher"); ?>index.php?p=home&code=<?php echo encrypt($nomor_invoice); ?>';

                Swal.fire({
                    title: 'E-Voucher link',
                    html: `
                    <p class="badge badge-light-success" id="linkText">${link}</p><br>
                    <button id="copyLinkButton">Copy Link</button>
                    <button id="sendEmailButton">Send Link via Email</button>
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
                fetch("share_link.php?tipe=email&proses=<?= encrypt($nomor_invoice); ?>")
                    .then(response => response.text()).then(data => {
                        Swal.fire('Email Sent!', data, 'success');
                    }).catch(error => {
                        Swal.fire('Error', 'Failed to send email.', 'error');
                    });
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
                    <?php for ($i = 0; $i < $jumlah_voucher; $i++) {
                        $kode_voucher = $nomor_invoice . ($i + 1);
                        $kode_qrcode = encrypt($nominal . $kode_voucher);



                        $qrcode = $kode_qrcode;
                        $id_penjualan = $nomor_invoice;
                        $status = "Unused";
                        $file_voucher = $kode_qrcode;

                        $cek = cek_database("data_voucher", "qrcode", $kode_qrcode, "");
                        if ($cek == "nggak") {
                            mysql_query("INSERT INTO data_voucher VALUES (
                                '$kode_voucher'
                                ,'$qrcode'
                                ,'$id_relasi'
                                ,'$nominal'
                                ,'$tanggal_kadaluarsa'
                                ,'$id_spbu'
                                ,'$id_penjualan'
                                ,'$status'
                                ,'$file_voucher'
                                ,'$tanggal_dibuka'

                                )");
                        }
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
                                            <a href="voucher.php?kode=<?php echo $kode_voucher; ?>&kodeqr=<?php echo $kode_qrcode; ?>" target="_blank" class="btn btn-sm btn-light-primary">
                                                Download
                                            </a>



                                            
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

    </div>

</div>