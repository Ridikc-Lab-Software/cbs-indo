<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Login eVoucher</title>
</head>

<body style="margin:0;padding:0;background-color:#f8f9fa;font-family:Arial, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f8f9fa;padding:20px;">
<tr>
<td align="center">

<!-- CARD -->
<table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:8px;box-shadow:0 4px 8px rgba(0,0,0,0.1);">
    
    <!-- HEADER -->
    <tr>
        <td align="center" style="padding:20px;">
            <img src="{company_logo}" onerror="this.onerror=null;this.src='default.png';" onerror="this.onerror=null;this.src='default.png';" onerror="this.onerror=null;this.src='default.png';" onerror="this.onerror=null;this.src='default.png';" alt="Logo {company_name}" width="100" style="display:block;margin-bottom:10px;">
            <h3 style="margin:0;color:#333;">{company_name}</h3>
        </td>
    </tr>

    <!-- BODY -->
    <tr>
        <td style="padding:20px;color:#555;font-size:14px;line-height:1.6;">
            <p>Halo <b>{recipient_name}</b>,</p>

            <p>
                Silakan klik link di bawah ini untuk masuk ke akun E-Voucher Anda.<br>
            </p>

            <p style="font-size:16px;color:#000;">
                <b>Password : {password}</b>
            </p>

            <p>
                Link : 
                <a href="{link}" style="color:#007bff;word-break:break-all;">
                    {link}
                </a>
            </p>

            <p style="margin-top:20px;">
                Terima kasih telah menggunakan layanan kami!
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
