<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Informasi Transaksi E-Voucher</title>
</head>

<body style="margin:0;padding:0;background-color:#f8f9fa;font-family:Arial, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f8f9fa;padding:20px;">
<tr>
<td align="center">

<!-- CARD -->
<table width="600" cellpadding="0" cellspacing="0"
       style="background:#ffffff;border-radius:8px;box-shadow:0 4px 8px rgba(0,0,0,0.1);">

    <!-- HEADER -->
    <tr>
        <td align="center" style="padding:20px;">
            <img src="{company_logo}"
                 onerror="this.onerror=null;this.src='default.png';"
                 alt="Logo {company_name}"
                 width="100"
                 style="display:block;margin-bottom:10px;">
            <h3 style="margin:0;color:#333;">{company_name}</h3>
            <p style="margin:5px 0 0;color:#777;font-size:13px;">
                Informasi Transaksi E-Voucher
            </p>
        </td>
    </tr>

    <!-- BODY -->
    <tr>
        <td style="padding:20px;color:#555;font-size:14px;">

            <p>Halo <b>{recipient_name}</b>,</p>

            <p>Berikut adalah detail transaksi E-Voucher:</p>

            <!-- INFO KENDARAAN -->
            <table width="100%" cellpadding="0" cellspacing="0"
                   style="border-collapse:collapse;margin-top:10px;margin-bottom:15px;">

                        <tr>
        <td style="padding:8px;">Kode Voucher</td>
        <td style="padding:8px;" align="right">
            <b style="color:#000;">{voucher_code}</b>
        </td>
    </tr>
    <tr>
        <td style="padding:8px;">Waktu Transaksi</td>
        <td style="padding:8px;" align="right">
            <b>{transaction_time}</b>
        </td>
    </tr>
<tr>
    <td style="padding:8px;">Nomor SPBU</td>
    <td style="padding:8px;" align="right">
        <b>{spbu_number}</b>
    </td>
</tr>

                <tr>
                    <td style="padding:8px;">Plat Kendaraan</td>
                    <td style="padding:8px;" align="right">
                        <b>{vehicle_plate}</b>
                    </td>
                </tr>
                <tr>
                    <td style="padding:8px;">Nama Supir</td>
                    <td style="padding:8px;" align="right">
                        <b>{driver_name}</b>
                    </td>
                </tr>
       
              
                <tr>
                    <td style="padding:8px;">Nominal Voucher</td>
                    <td style="padding:8px;" align="right">
                        <b>{voucher_nominal}</b>
                    </td>
                </tr>
                <tr>
                    <td style="padding:8px;">Nominal Transaksi</td>
                    <td style="padding:8px;" align="right">
                        <b>{transaction_nominal}</b>
                    </td>
                </tr>
                <tr>
                    <td style="padding:8px;">Sisa Voucher</td>
                    <td style="padding:8px;" align="right">
                        <b>{remaining_nominal}</b>
                    </td>
                </tr>
            </table>
            <hr>
            <p style="margin-top:20px;">
                Terima kasih telah menggunakan layanan kami.
            </p>

            <p style="color:#888;font-size:12px;">
                Email ini dikirim secara otomatis, mohon tidak membalas email ini.
            </p>

        </td>
    </tr>

</table>
<!-- END CARD -->

</td>
</tr>
</table>

</body>
</html>