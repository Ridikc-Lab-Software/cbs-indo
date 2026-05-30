<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Download Voucher</title>
    <style>
        /* Reset dan base styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Page styling for centering the content */
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f3f6f9;
            padding: 10px;
        }

        /* Card container styling */
        .card {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 420px;
            margin: 5px auto;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            page-break-inside: avoid;
        }

        /* Voucher container dengan aspect ratio tetap */
        .voucher {
            position: relative;
            width: 100%;
            max-width: 390px;
            aspect-ratio: 390 / 600;
            background-image: url('back2.png?v=<?php echo date('Ymdhis');?>');
            background-size: cover;
            background-position: center;
            border: 3px solid #000;
            box-sizing: border-box;
        }

        /* Text overlay */
        .text-overlay {
            position: absolute;
            top: 20px;
            left: 15px;
            right: 15px;
            color: black;
            font-family: Arial, sans-serif;
        }

        /* Individual text elements */
        .amount {
            margin-top: 128px;
            font-size: 32px;
            font-weight: bold;
            text-align: center;
        }

        .qrcode-container {
            text-align: right;
            margin-top: 137px;
        }

        .no_voucher {
            font-size: 14px;
            margin-top: 20px;
            font-weight: bold;
            text-align: center;
        }

        .info {
            font-size: 13px;
            text-align: right;
            font-weight: bold;
            margin-top: 158px;
        }

        .spbu {
            font-size: 8px;
            text-align: center;
            font-weight: bold;
            margin-top: 64px;
            margin-left: 145px;
            margin-right: 30px;
            background-color: #0004B4;
            color: white;
        }

        /* Button container */
        .button-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 100%;
            max-width: 420px;
            padding: 0 10px;
            margin-top: 10px;
        }

        /* Download button styling */
        .download-btn {
            width: 100%;
            padding: 12px 20px;
            font-size: 16px;
            color: #fff;
            border: 2px solid #04c8c8;
            background-color: #04c8c8;
            cursor: pointer;
            border-radius: 0.475rem;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .download-btn:hover {
            color: #04c8c8;
            border-color: #04c8c8;
            background-color: #dcfdfd;
        }

        .download-btn:active {
            transform: scale(0.98);
        }

        /* QR Code Table Styling */
        .qrcode-container table {
            width: 100%;
        }

        .qrcode-container td {
            vertical-align: top;
        }

        .qrcode-container .amount-cell {
            font-size: 32px;
            font-weight: bold;
            text-align: start;
        }

        .qrcode-container .relasi-info {
            text-align: left;
            margin: 0;
            padding: 0;
        }

        /* Responsive adjustments untuk layar kecil */
        @media screen and (max-width: 480px) {
            body {
                padding: 5px;
            }

            .card {
                max-width: 100%;
                margin: 5px;
            }

            .voucher {
                max-width: 100%;
                border: 2px solid #000;
            }

            .button-container {
                max-width: 100%;
                padding: 0 5px;
            }

            .download-btn {
                padding: 14px 20px;
                font-size: 15px;
            }
        }

        /* Untuk layar sangat kecil */
        @media screen and (max-width: 360px) {
            .text-overlay {
                left: 10px;
                right: 10px;
            }

            .qrcode-container .amount-cell {
                font-size: 28px;
            }

            .no_voucher {
                font-size: 12px;
            }
        }

        /* Print styling */
        @media print {
            body {
                background-color: white;
            }

            .button-container {
                display: none;
            }

            .card {
                box-shadow: none;
                page-break-inside: avoid;
            }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php

error_reporting(E_ALL);
ini_set('display_errors', 0);

include '../../../include/all_include.php';

// Data yang akan disimpan
$id_download_voucher = "DWN" . date('Ymdhis');
$waktu = date('Y-m-d H:i:s');
$id_voucher = mysql_real_escape_string($_GET['kode']);
$kodeqr = mysql_real_escape_string($_GET['kodeqr']);
$ip_address = $_SERVER['REMOTE_ADDR'];
$user_agent = mysql_real_escape_string($_SERVER['HTTP_USER_AGENT']);

// Query untuk menyimpan data
$query = "INSERT INTO data_download_voucher (id_download_voucher, waktu, id_voucher, ip_address, user_agent)
        VALUES ('$id_download_voucher', '$waktu', '$id_voucher', '$ip_address', '$user_agent')";

mysql_query($query);

try {
    $stmt = $dbh->prepare("SELECT * FROM data_voucher WHERE id_voucher = ? AND qrcode = ?");
    $stmt->execute([$id_voucher, $kodeqr]);

    $data_voucher = $stmt->fetch();
} catch (Exception $e) {
    error_log($e->getMessage());
    echo '<div style="background: white; padding: 30px; border-radius: 10px; 
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); text-align: center; 
                max-width: 400px; margin: 50px auto; font-family: Arial, sans-serif;">
            <div style="font-size: 50px; color: #dc3545;">❌</div>
            <h3 style="color: #dc3545;">Terjadi Kesalahan!</h3>
            <p>Maaf, terjadi kesalahan saat mengambil data voucher ID'.$id_voucher.'.</p>
            <a href="https://cbs-indo.com/?p=Tentang%20Kami" style="display: inline-block; padding: 10px 15px; 
                background-color: #007bff; color: white; text-decoration: none; 
                border-radius: 5px; font-weight: bold;">Kontak Admin CBS-INDO</a>
          </div>';
    exit;
}

if (!$data_voucher) {
    echo '<div style="background: white; padding: 30px; border-radius: 10px; 
                box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); text-align: center; 
                max-width: 400px; margin: 50px auto; font-family: Arial, sans-serif;">
            <div style="font-size: 50px; color: #ffc107;">⚠️</div>
            <h3 style="color: #ffc107;">Voucher Tidak Ditemukan</h3>
            <p>Maaf, voucher tidak ditemukan atau kode QR <b>ID'.$id_voucher.'</b><br> tidak sesuai.</p>
            <a href="https://cbs-indo.com/?p=Tentang%20Kami" style="display: inline-block; padding: 10px 15px; 
                background-color: #007bff; color: white; text-decoration: none; 
                border-radius: 5px; font-weight: bold;">Kontak Admin CBS-INDO</a>
          </div>';
    exit;
}

$spbus = QB::table("data_penjualan_voucher_spbu")
    ->join("data_spbu", "data_penjualan_voucher_spbu.id_spbu", "=", "data_spbu.id_spbu")
    ->where("data_penjualan_voucher_spbu.id_penjualan_voucher", "=", $data_voucher['id_penjualan'])
    ->get();

$relasi = QB::table("data_relasi")
    ->where("id_relasi", "=", $data_voucher['id_relasi'])
    ->first();

$nama_spbu = "";
$nama_spbu_list = array_map(function ($spbu) {
    return $spbu->nama_spbu;
}, $spbus);
$nama_spbu = implode(", ", $nama_spbu_list);

/**
 * Ubah tanggal dari format 'Y-m-d' menjadi format 'd-m-Y'
 *
 * @param string $tgl tanggal dalam format 'Y-m-d H:i:s'
 * @return string tanggal dalam format 12 desember 2022
 */
function ubah_ke_format_indo($tgl)
{
    $tanggal = explode(' ', $tgl);
    $pecah = explode('-', $tanggal[0]);
    $bulan = array(
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
        '12' => 'Desember'
    );

    return $pecah[2] . ' ' . $bulan[$pecah[1]] . ' ' . $pecah[0];
}

$berlaku = ubah_ke_format_indo($data_voucher['tanggal_kadaluarsa']);
$nominal = $data_voucher['nominal'];
?>

<div class="card">
    <div class="voucher" id="voucher">
        <div class="text-overlay">
            <!-- QR code container -->
            <div class="qrcode-container">
                <div class="no_voucher">ID<?php echo $_GET['kode']; ?></div>
                <table>
                    <tr>
                        <td class="amount-cell">
                            <?php rupiah($nominal); ?>
                        </td>
                        <td rowspan="2">
                            <div id="qrcode"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="relasi-info">Relasi : <br><?= $relasi ? $relasi->nama : '' ?></p>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="info">
                <?= $berlaku ?>
                <br>
            </div>
            <!-- <div class="spbu"><?= $nama_spbu ?></div> -->
        </div>
    </div>
</div>

<div class="button-container">
    <button class="download-btn" onclick="confirmDownload()">Download Voucher</button>
    <button class="download-btn" onclick="shareVoucher()">Share Voucher</button>
</div>

<script>
    function shareVoucher() {
        let voucherLink = "https://e-voucher.cbs-indo.com/qrcode/<?php echo $_GET['kode'];?>/<?php echo $_GET['kodeqr'];?>";

        let input = document.createElement("input");
        input.value = voucherLink;
        document.body.appendChild(input);

        Swal.fire({
            title: "Bagikan Voucher",
            html: `
            <p>Copy link di bawah ini:</p>
            <input type="text" id="voucherLink" value="${voucherLink}" readonly style="width: 90%; padding: 8px; text-align: center; border: 1px solid #ccc; border-radius: 5px;">
            <br><br>
            <button onclick="copyToClipboard()" class="swal2-confirm swal2-styled">Copy</button>
        `,
            showCloseButton: true,
            showConfirmButton: false
        });

        document.body.removeChild(input);
    }

    function copyToClipboard() {
        let copyText = document.getElementById("voucherLink");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        document.execCommand("copy");

        Swal.fire({
            icon: "success",
            title: "Link Tersalin!",
            text: "Silahkan kirimkan link voucher yang sudah berhasil disalin",
            timer: 2000,
            showConfirmButton: true
        });
    }

    function generateQRCode(value) {
        QRCode.toDataURL(value, {
            width: 145,
            height: 145,
            margin: 1
        }, function(err, url) {
            if (err) throw err;
            document.getElementById('qrcode').innerHTML = `<img src="${url}" alt="QR Code" style="width: 145px; height: 145px; margin-top: 1px;margin-right: 18px;">`;
        });
    }

    function downloadVoucher() {
        const voucher = document.getElementById('voucher');
        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');

        canvas.width = 390;
        canvas.height = 600;

        const backgroundImage = new Image();
        backgroundImage.src = getComputedStyle(voucher).backgroundImage.slice(5, -2).replace(/"/g, '');

        backgroundImage.onload = function() {
            context.drawImage(backgroundImage, 0, 0, canvas.width, canvas.height);

            context.font = 'bold 32px Arial';
            context.fillStyle = 'black';
            context.textAlign = 'left';
            context.fillText('<?php rupiah($nominal); ?>', 20, 210);
            context.textAlign = 'center';
            context.font = 'bold 14px Arial';

            context.fillText('ID<?php echo $_GET['kode']; ?>', canvas.width / 2, 170);
            context.fillText('<?php echo $berlaku; ?>', 330, 505);
            context.font = ' 16px Arial';
            context.textAlign = 'left';
            context.fillText('Relasi : ', 20, 270);

            const relasiNama = '<?php echo $relasi ? $relasi->nama : ''; ?>';
            if (relasiNama.length > 20) {
                context.fillText(relasiNama.substring(0, 20), 20, 285);
                context.fillText(relasiNama.substring(20), 20, 300);
            } else {
                context.fillText(relasiNama, 20, 285);
            }

            context.font = 'bold 14px Arial';
            context.textAlign = 'center';

            const qrcodeImg = document.querySelector('#qrcode img');
            const qrcodeCanvas = document.createElement('canvas');
            const qrcodeContext = qrcodeCanvas.getContext('2d');

            qrcodeCanvas.width = qrcodeImg.width;
            qrcodeCanvas.height = qrcodeImg.height;

            qrcodeContext.drawImage(qrcodeImg, 0, 0);
            context.drawImage(qrcodeCanvas, (canvas.width - qrcodeImg.width) - 40, 180);

            const link = document.createElement('a');
            link.download = 'voucher.png';
            link.href = canvas.toDataURL('image/jpeg', 1);
            link.click();
        };

        generateQRCode('<?php echo $_GET['kodeqr']; ?>');
    }

    function confirmDownload() {
        Swal.fire({
            title: 'Download Voucher',
            text: 'Apakah anda ingin mendownload voucher?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, download!',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                downloadVoucher();
            }
        });
    }

    window.onload = function() {
        generateQRCode('<?php echo $_GET['kodeqr']; ?>');
    }
</script>

</body>
</html>