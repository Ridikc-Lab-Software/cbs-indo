<!DOCTYPE html>
<?php
include '../../../include/all_include.php';

// Data yang akan disimpan
$id_download_voucher = "DWN" . date('Ymdhis');
$waktu = date('Y-m-d H:i:s');
$id_voucher = mysql_real_escape_string($_GET['kode']);
$ip_address = $_SERVER['REMOTE_ADDR'];
$user_agent = mysql_real_escape_string($_SERVER['HTTP_USER_AGENT']);

// Query untuk menyimpan data
$query = "INSERT INTO data_download_voucher (id_download_voucher, waktu, id_voucher, ip_address, user_agent)
        VALUES ('$id_download_voucher', '$waktu', '$id_voucher', '$ip_address', '$user_agent')";

mysql_query($query);

try {
    $stmt = $dbh->prepare("SELECT * FROM data_voucher WHERE id_voucher = ?");
    $stmt->execute([$id_voucher]);

    $data_voucher = $stmt->fetch();
} catch (Exception $e) {
    error_log($e->getMessage());
    die("maaf, gagal mengambil data voucher.");
}

if (!$data_voucher) {
    die("maaf, voucher tidak ditemukan.");
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
<style>
    /* Page styling for centering the content */
    body {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        /* Full viewport height */
        margin: 0;
        /* Remove default margin */
        background-color: #f3f6f9;
        /* Background color */
    }

    /* Card container styling */
    .card {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 420px;
        /* Card width */
        height: 630px;
        /* Card height */
        margin: 5px;
        /* Space between cards */
        background-color: #ffffff;
        /* Card background color */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Card shadow for depth */
        border-radius: 8px;
        /* Rounded corners */
        overflow: hidden;
        /* Clip overflowing content */
        page-break-inside: avoid;
        /* Avoid page break inside the card when printing */
    }

    /* Voucher container with fixed size */
    .voucher {
        position: relative;
        width: 390px;
        /* Fixed width */
        height: 600px;
        /* Fixed height */
        background-image: url('back.jpeg');
        /* Background image */
        background-size: cover;
        /* Ensure the image covers the whole area */
        background-position: center;
        /* Center the background image */
        border: 3px solid #000;
        /* Optional border for visual clarity */
        box-sizing: border-box;
        /* Include padding and border in the element's total width and height */
    }

    /* Text overlay */
    .text-overlay {
        position: absolute;
        top: 20px;
        /* Position from the top */
        left: 20px;
        /* Position from the left */
        color: black;
        /* Text color */
        font-family: Arial, sans-serif;
        /* Font family */
        width: calc(100% - 40px);
        /* Adjust width for padding */
    }

    /* Individual text elements */
    .amount {
        margin-top: 128px;
        font-size: 32px;
        font-weight: bold;
        text-align: center;
    }

    .qrcode-container {
        text-align: center;
        margin-top: 27px;
    }

    .no_voucher {
        font-size: 14px;
        margin-top: 20px;
        font-weight: bold;
        text-align: center;
    }

    .info {
        font-size: 14px;
        text-align: center;
        font-weight: bold;
        margin-top: 18px;
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

    /* Download button styling */
    .download-btn {
        margin-top: 5px;
        padding: 10px 20px;
        font-size: 16px;
        color: #fff;
        border-color: #04c8c8;
        background-color: #04c8c8;
        cursor: pointer;
        border-radius: .475rem;
    }

    .download-btn:hover {
        color: #04c8c8;
        border-color: #dcfdfd;
        background-color: #dcfdfd
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="card">
    <div class="voucher" id="voucher">
        <div class="text-overlay">
            <div class="amount"><?php rupiah($nominal); ?></div>
            <!-- QR code container -->
            <div class="qrcode-container">
                <div id="qrcode"></div>
            </div>
            <div class="no_voucher">ID<?php echo $_GET['kode']; ?></div>
            <div class="info">
                <?= $berlaku ?>
                <br>
                <?= $relasi ? $relasi->nama : '' ?>
            </div>
            <div class="spbu"><?= $nama_spbu ?></div>
        </div>
    </div>
</div>

<div>
    <button class="download-btn" onclick="confirmDownload()">Download</button>
    <button class="download-btn" onclick="shareEmail()">Share</button>
</div>
<script>
    function generateQRCode(value) {
        QRCode.toDataURL(value, {
            width: 208,
            height: 208,
            margin: 1 // Set margin to 0 to ensure no extra space around the QR code
        }, function(err, url) {
            if (err) throw err;
            document.getElementById('qrcode').innerHTML = `<img src="${url}" alt="QR Code" style="width: 208px; height: 208px; margin-top: 0;">`;
        });
    }

    function downloadVoucher() {
        const voucher = document.getElementById('voucher');
        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');

        canvas.width = voucher.offsetWidth;
        canvas.height = voucher.offsetHeight;

        // Use a promise to ensure the image is loaded before drawing
        const backgroundImage = new Image();
        backgroundImage.src = getComputedStyle(voucher).backgroundImage.slice(5, -2).replace(/"/g, '');

        backgroundImage.onload = function() {
            // Draw background image
            context.drawImage(backgroundImage, 0, 0, canvas.width, canvas.height);

            // Draw text overlay
            context.font = 'bold 32px Arial';
            context.fillStyle = 'black';
            context.textAlign = 'center';
            context.fillText('<?php rupiah($nominal); ?>', canvas.width / 2, 180);

            context.font = 'bold 14px Arial';
            context.fillText('<?php echo $_GET['kode']; ?>', canvas.width / 2, 460);
            context.fillText('<?php echo $berlaku; ?>', canvas.width / 2, 498);
            context.fillText('<?php echo $relasi ? $relasi->nama : ''; ?>', canvas.width / 2, 515);
            context.fillStyle = "#0004B4";
            context.fillRect(180, 570, 155, 40);
            context.fillStyle = "white";
            context.font = 'bold 8px Arial';
            context.fillText('Hanya berlaku di:', 250, 580, 196);
            context.fillText('<?php echo $nama_spbu; ?>', 250, 590, 196);

            // Draw the QR code
            const qrcodeImg = document.querySelector('#qrcode img');
            const qrcodeCanvas = document.createElement('canvas');
            const qrcodeContext = qrcodeCanvas.getContext('2d');

            qrcodeCanvas.width = qrcodeImg.width;
            qrcodeCanvas.height = qrcodeImg.height;

            qrcodeContext.drawImage(qrcodeImg, 0, 0);
            context.drawImage(qrcodeCanvas, (canvas.width - qrcodeImg.width) / 2, 215);

            // Create a link to download the canvas as a PNG
            const link = document.createElement('a');
            link.download = 'voucher.png';
            link.href = canvas.toDataURL('image/jpeg', 1);
            link.click();
        };

        // Generate the QR code
        generateQRCode('<?php echo $_GET['kodeqr']; ?>');
    }


    function saveVoucherAsImage(callback) {
        const voucher = document.getElementById('voucher');
        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');

        canvas.width = voucher.offsetWidth;
        canvas.height = voucher.offsetHeight;

        const backgroundImage = new Image();
        backgroundImage.src = getComputedStyle(voucher).backgroundImage.slice(5, -2).replace(/"/g, '');

        backgroundImage.onload = function() {
            context.drawImage(backgroundImage, 0, 0, canvas.width, canvas.height);

            context.font = 'bold 32px Arial';
            context.fillStyle = 'black';
            context.textAlign = 'center';
            context.fillText('<?php rupiah($nominal); ?>', canvas.width / 2, 180);

            context.font = 'bold 14px Arial';
            context.fillText('<?php echo $_GET['kode']; ?>', canvas.width / 2, 460);
            context.fillText('<?php echo $berlaku; ?>', canvas.width / 2, 500);

            const qrcodeImg = document.querySelector('#qrcode img');
            const qrcodeCanvas = document.createElement('canvas');
            const qrcodeContext = qrcodeCanvas.getContext('2d');

            qrcodeCanvas.width = qrcodeImg.width;
            qrcodeCanvas.height = qrcodeImg.height;

            qrcodeContext.drawImage(qrcodeImg, 0, 0);
            context.drawImage(qrcodeCanvas, (canvas.width - qrcodeImg.width) / 2, 215);

            callback(canvas.toDataURL());
        };
    }

    function shareEmail() {
        saveVoucherAsImage(function(dataUrl) {
            fetch('send_email.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        image: dataUrl
                    })
                })
                .then(response => response.json())
                .then(data => {
                    Swal.fire({
                        title: 'Email Sent',
                        text: 'Voucher image has been sent to fajarudinsidik@gmail.com',
                        icon: 'success'
                    });
                })
                .catch((error) => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error',
                        text: 'Failed to send email.',
                        icon: 'error'
                    });
                });
        });
    }

    // Generate QR code on page load
    window.onload = function() {
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
</script>