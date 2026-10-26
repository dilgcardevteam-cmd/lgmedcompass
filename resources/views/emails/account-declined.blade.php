<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Request Declined</title>
</head>
<body style="margin:0;padding:24px 12px;background-color:#F5F7FA;font-family:Arial,Helvetica,sans-serif;color:#16324F;">
    @php
        $embeddedLogo = null;

        if (isset($message) && $logoPath && is_file($logoPath) && method_exists($message, 'embed')) {
            $embeddedLogo = $message->embed($logoPath);
        } elseif (! empty($logoUrl)) {
            $embeddedLogo = $logoUrl;
        }
    @endphp
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin:0;padding:0;background-color:#F5F7FA;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="max-width:680px;background-color:#FFFFFF;border-radius:14px;overflow:hidden;">
                    <tr>
                        <td align="center" style="padding:28px 24px;background-color:#061B33;">
                            @if ($embeddedLogo)
                                <img src="{{ $embeddedLogo }}" alt="LGMED Compass Logo" style="display:block;max-width:100px;height:auto;margin:0 auto;border:0;">
                            @else
                                <div style="font-size:24px;line-height:1.2;font-weight:700;letter-spacing:0.5px;color:#FFFFFF;">LGMED Compass</div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="height:4px;background-color:#F59E0B;font-size:0;line-height:0;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td align="center" style="padding:34px 32px 16px 32px;font-size:28px;line-height:1.2;font-weight:800;color:#061B33;text-transform:uppercase;">
                            Account Request Declined
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding:0 32px 14px 32px;font-size:16px;line-height:1.7;color:#4A5C70;">
                            Hello {{ $user->first_name }} {{ $user->last_name }},
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding:0 32px 16px 32px;font-size:16px;line-height:1.8;color:#4A5C70;">
                            We regret to inform you that your account registration request for
                            <span style="color:#F59E0B;font-weight:700;">LGMED Compass</span>
                            has been declined by the administrator.
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding:0 32px 28px 32px;font-size:15px;line-height:1.8;color:#6B7C8F;">
                            If you believe this is a mistake, please contact the administrator or register again with the correct information.
                        </td>
                    </tr>
                    <tr>
                        <td style="height:1px;background-color:#F59E0B;font-size:0;line-height:0;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="padding:20px 24px;background-color:#061B33;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="left" style="font-size:12px;line-height:1.7;color:#FFFFFF;">
                                        <strong>LGMED Compass</strong><br>
                                        Empowering Local Governments.
                                    </td>
                                    <td align="right" style="font-size:12px;line-height:1.7;color:#D8E2EE;">
                                        Regards,<br>
                                        LGMED Compass Team
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
