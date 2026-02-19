<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin: 0; padding: 0; background-color: #f4f7f9; font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif; -webkit-font-smoothing: antialiased;">

    <!-- Wrapper -->
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color: #f4f7f9; padding: 40px 20px;">
        <tr>
            <td align="center">

                <!-- Email container -->
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="max-width: 600px; width: 100%; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.06);">

                    <!-- Header -->
                    <tr>
                        <td style="background-color: #042734; padding: 30px 40px; text-align: center;">
                            <img src="{{ asset('images/logo-implantex-blanco.png') }}" alt="Implantex Academy" style="height: 40px; width: auto;">
                        </td>
                    </tr>

                    <!-- Banner -->
                    <tr>
                        <td style="background-color: #5497AF; padding: 24px 40px; text-align: center;">
                            <p style="margin: 0; font-size: 22px; font-weight: 700; color: #ffffff; letter-spacing: 0.5px;">
                                Reset Your Password
                            </p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 40px;">

                            <p style="margin: 0 0 20px; font-size: 16px; color: #042734; line-height: 1.6;">
                                Hello <strong>{{ $user->full_name }}</strong>,
                            </p>

                            <p style="margin: 0 0 28px; font-size: 15px; color: #333; line-height: 1.6;">
                                You are receiving this email because we received a password reset request for your account. Click the button below to set a new password.
                            </p>

                            <!-- CTA -->
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin-bottom: 28px;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ $resetUrl }}" style="display: inline-block; background-color: #5497AF; color: #ffffff; text-decoration: none; font-size: 14px; font-weight: 700; padding: 14px 36px; border-radius: 50px; letter-spacing: 0.3px;">
                                            Reset Password
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <!-- Expiry notice -->
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color: #E4F2F7; border-radius: 10px; margin-bottom: 28px;">
                                <tr>
                                    <td style="padding: 20px 28px;">
                                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="padding: 0 0 10px; font-size: 13px; color: #042734; line-height: 1.6;">
                                                    ⏱ This password reset link will expire in <strong>{{ $expirationMinutes }} minutes</strong>.
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 12px; color: #042734; line-height: 1.6;">
                                                    <strong style="color: #5497AF;">Having trouble with the button?</strong><br>
                                                    Copy and paste this URL into your browser:<br>
                                                    <a href="{{ $resetUrl }}" style="color: #5497AF; text-decoration: none; word-break: break-all;">{{ $resetUrl }}</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin: 0 0 20px; font-size: 14px; color: #666; line-height: 1.6;">
                                If you did not request a password reset, no further action is required. Your password will remain unchanged.
                            </p>

                            <p style="margin: 0; font-size: 14px; color: #666; line-height: 1.6;">
                                If you have any questions, contact us at
                                <a href="mailto:info@cursodeimplantologia.com" style="color: #5497AF; text-decoration: none; font-weight: 600;">info@cursodeimplantologia.com</a>
                                or call us at <strong>786 328 78 05</strong>.
                            </p>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #042734; padding: 24px 40px; text-align: center;">
                            <p style="margin: 0 0 4px; font-size: 13px; color: #99C9E1;">
                                Implantex Academy
                            </p>
                            <p style="margin: 0; font-size: 12px; color: #5497AF;">
                                &copy; {{ date('Y') }} Implantex. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>