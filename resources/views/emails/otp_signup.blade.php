<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#e8ebef">
    @php
    $logo = get_setting('header_logo');
    @endphp
    <tr>
        <td align="center" valign="top" style="padding:50px 10px;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td align="center">
                        <table width="600" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td bgcolor="#ffffff" style="border-radius:12px; overflow:hidden; font-family:Arial,sans-serif;">

                                    <!-- Header -->
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td style="background-color:#2e57ae; padding:24px 30px;">
                                                @if($logo)
                                                    <img src="{{ uploaded_asset($logo) }}" height="28" alt="{{ env('APP_NAME') }}" style="display:block;" />
                                                @else
                                                    <span style="color:#ffffff; font-size:20px; font-weight:bold;">{{ env('APP_NAME') }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- END Header -->

                                    <!-- Body -->
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td style="padding:40px 30px 20px 30px; text-align:center;">
                                                <div style="font-size:22px; font-weight:bold; color:#1f2125; padding-bottom:12px;">
                                                    {{ translate('Verify your email address') }}
                                                </div>
                                                <div style="font-size:15px; line-height:22px; color:#5c6470; padding-bottom:28px;">
                                                    {{ translate('Enter this code to complete your registration on') }} {{ env('APP_NAME') }}.
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="padding-bottom:28px;">
                                                <table border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td style="background-color:#f2f4f8; border:1px solid #e2e6ec; border-radius:8px; padding:18px 36px;">
                                                            <span style="font-size:34px; font-weight:bold; letter-spacing:10px; color:#2e57ae; font-family:'Courier New', monospace;">
                                                                {{ $code }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding:0 30px 40px 30px; text-align:center;">
                                                <div style="font-size:13px; line-height:20px; color:#8a92a0;">
                                                    {{ translate('This code will expire in 10 minutes. If you did not request this, you can safely ignore this email.') }}
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- END Body -->

                                    <!-- Footer -->
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td style="border-top:1px solid #eceff3; padding:20px 30px; text-align:center;">
                                                <span style="font-size:12px; color:#a3aab5;">{{ env('APP_NAME') }} &middot; {{ env('APP_URL') }}</span>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- END Footer -->

                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
