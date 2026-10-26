<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name', 'LGMED Compass') }}</title>
    <style>
        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; }
        
        body {
            background-color: #fefce8;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0 !important;
            width: 100% !important;
        }

        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05);
            border: 1px solid #fcd34d;
        }

        .email-header {
            background: linear-gradient(135deg, #fcd34d, #e7c85c);
            padding: 30px;
            text-align: center;
        }

        .email-body {
            padding: 35px;
            color: #78350f;
            line-height: 1.6;
            font-size: 16px;
        }

        /* Overriding Laravel's default button to match your theme */
        .button {
            background-color: #f59e0b !important;
            border: none !important;
            border-radius: 8px !important;
            color: #ffffff !important;
            display: inline-block;
            font-weight: 600;
            padding: 12px 24px !important;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(245,158,11,0.3);
        }

        .email-footer {
            background-color: #fffbeb;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #7c5e3a;
            border-top: 1px solid #fcd34d;
        }

        .subcopy {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #fef3c7;
            font-size: 12px;
            color: #92400e;
            word-break: break-all;
        }

        @media only screen and (max-width: 600px) {
            .email-container { margin: 10px; width: auto !important; }
            .email-body { padding: 20px; }
        }
    </style>
</head>
<body>
    <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <div class="email-container">
                    <div class="email-header">
                        @component('mail::header', ['url' => config('app.url')])
                            {{ config('app.name') }}
                        @endcomponent
                    </div>

                    <div class="email-body">
                        {{ $slot }}

                        @isset($subcopy)
                            <div class="subcopy">
                                {{ $subcopy }}
                            </div>
                        @endisset
                    </div>

                    <div class="email-footer">
                        &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                    </div>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>