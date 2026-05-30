<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>{kode_email}</title>
</head>

<body style="margin:0;padding:0;background-color:#f8f9fa;font-family:Arial, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f8f9fa;padding:20px;">
<tr>
<td align="center">

<!-- CARD -->
<table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:8px;box-shadow:0 4px 8px rgba(0,0,0,0.1);">
    
<tr>
<td  style="padding:20px;">

    <div>
        <center>  <img src="https://membercard.cbs-indo.com/admin/data/image/logo/logo.png" onerror="this.onerror=null;this.src='default.png';" onerror="this.onerror=null;this.src='default.png';" onerror="this.onerror=null;this.src='default.png';" onerror="this.onerror=null;this.src='default.png';" alt="Logo {company_name}" width="100" style="display:block;margin-bottom:10px;">
            <h3 style="margin:0;color:#333;">PT.Cahaya Bungo Sarkopalma</h3>
        </center>
        <br>
        <br>
        <p style="margin: 0 0 15px 0;">Yth. Bapak/Ibu 
            <br><strong>{nama_relasi}</strong></p>

        <p style="margin: 0 0 15px 0;">Dengan hormat,</p>

        <p style="margin: 0 0 15px 0;">
            Bersama email ini kami lampirkan <strong>Invoice Kode INV{invoice}</strong> 
            dari <strong><br>PT. Cahaya Bungo Sarkopalma</strong> atas pembayaran E-Voucher sebesar 
            <br><strong>{total_bayar}</strong> ({terbilang}).
        </p>

        <p style="margin: 0 0 15px 0;">Mohon pembayaran dapat ditransfer ke salah satu rekening berikut:</p>
        
        {info_rekening}
            <br>

        <p style="margin: 0 0 15px 0;">
            Invoice dalam format PDF telah kami lampirkan, sekian informasi yang dapat kami sampaikan.
        </p>

        <p style="margin: 0 0 15px 0;">Kami ucapkan terima kasih atas kerjasama dan kepercayaannya.</p>

        <p style="margin: 0;">Hormat kami,</p>

        <p style="margin: 10px 0 0 0; font-weight: bold;">
            {admin}<br>
            {jabatan}<br>
            PT. Cahaya Bungo Sarkopalma<br>
        </p>

        <p style="margin: 20px 0 0 0; font-size: 12px; color: #777777;">
            Sarolangun, {tanggal} 
        </p>
    </div>
    </td>
    </tr>

</table>
<!-- END CARD -->

</td>
</tr>
</table>

</body>
</html>






