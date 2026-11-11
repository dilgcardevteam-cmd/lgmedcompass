<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $updateTitle }}</title>
</head>
<body style="margin:0;padding:24px 12px;background-color:#F3F6FA;font-family:Arial,Helvetica,sans-serif;color:#24364B;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#F3F6FA;">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="max-width:640px;background-color:#FFFFFF;border:1px solid #E1E7EF;border-radius:12px;overflow:hidden;">
                    <tr>
                        <td style="padding:24px 32px;background-color:#102A43;color:#FFFFFF;">
                            <div style="font-size:20px;line-height:1.3;font-weight:700;letter-spacing:0.3px;">LGMED Compass</div>
                            <div style="padding-top:5px;font-size:12px;line-height:1.5;color:#D9E2EC;letter-spacing:1px;">SERVICE REQUEST UPDATE</div>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:4px;background-color:#D69E2E;font-size:0;line-height:0;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="padding:32px 32px 12px;font-size:22px;line-height:1.35;font-weight:700;color:#102A43;">
                            {{ $updateTitle }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0 32px 24px;font-size:15px;line-height:1.7;color:#526477;">
                            Hello {{ $requesterName ?: 'Requester' }},<br><br>
                            {{ $updateMessage }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0 32px 24px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="border:1px solid #E1E7EF;border-radius:8px;">
                                <tr>
                                    <td colspan="2" style="padding:14px 16px;background-color:#F7F9FC;font-size:13px;font-weight:700;color:#102A43;">Request details</td>
                                </tr>
                                <tr>
                                    <td width="38%" style="padding:11px 16px;border-top:1px solid #E1E7EF;font-size:13px;color:#66788A;">Reference</td>
                                    <td style="padding:11px 16px;border-top:1px solid #E1E7EF;font-size:13px;font-weight:700;color:#24364B;">{{ $requestReference }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:11px 16px;border-top:1px solid #E1E7EF;font-size:13px;color:#66788A;">Subject</td>
                                    <td style="padding:11px 16px;border-top:1px solid #E1E7EF;font-size:13px;color:#24364B;">{{ $requestSubject }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:11px 16px;border-top:1px solid #E1E7EF;font-size:13px;color:#66788A;">Service</td>
                                    <td style="padding:11px 16px;border-top:1px solid #E1E7EF;font-size:13px;color:#24364B;">
                                        {{ $serviceType }}@if ($otherServiceType) — {{ $otherServiceType }}@endif
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:11px 16px;border-top:1px solid #E1E7EF;font-size:13px;color:#66788A;">Status</td>
                                    <td style="padding:11px 16px;border-top:1px solid #E1E7EF;font-size:13px;font-weight:700;color:#24364B;">{{ $status }}</td>
                                </tr>
                                @if ($dateNeeded)
                                    <tr>
                                        <td style="padding:11px 16px;border-top:1px solid #E1E7EF;font-size:13px;color:#66788A;">Date needed</td>
                                        <td style="padding:11px 16px;border-top:1px solid #E1E7EF;font-size:13px;color:#24364B;">{{ $dateNeeded }}</td>
                                    </tr>
                                @endif
                            </table>
                        </td>
                    </tr>
                    @if ($latestComment)
                        <tr>
                            <td style="padding:0 32px 24px;">
                                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#F7F9FC;border-left:3px solid #D69E2E;">
                                    <tr>
                                        <td style="padding:15px 18px;font-size:14px;line-height:1.7;color:#526477;">
                                            <strong style="color:#102A43;">Latest comment</strong><br>
                                            {{ $latestComment }}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    @endif
                    @if ($deliverableLink || $hasDeliverableFiles)
                        <tr>
                            <td style="padding:0 32px 24px;font-size:14px;line-height:1.7;color:#526477;">
                                <strong style="color:#102A43;">Completion materials</strong><br>
                                @if ($deliverableLink)
                                    <a href="{{ $deliverableLink }}" style="color:#245B86;word-break:break-word;">Open the shared deliverable</a>
                                @endif
                                @if ($hasDeliverableFiles)
                                    @if ($deliverableLink)<br>@endif
                                    Completed files are available on the private request tracking page.
                                @endif
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td align="center" style="padding:0 32px 32px;">
                            <a href="{{ $trackingUrl }}" style="display:inline-block;padding:13px 22px;border-radius:6px;background-color:#102A43;color:#FFFFFF;text-decoration:none;font-size:14px;font-weight:700;">
                                View request
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:18px 32px;background-color:#F7F9FC;border-top:1px solid #E1E7EF;font-size:12px;line-height:1.7;color:#66788A;">
                            This is an automated update from LGMED Compass. Use the private tracking link above to view your request and any available files.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
