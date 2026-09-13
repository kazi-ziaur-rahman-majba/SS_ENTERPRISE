
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Request</title>
</head>
<body style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <center>
        <table cellpadding="0" cellspacing="0" border="0" width="100%" style="background-color: #f4f4f4;">
            <tr>
                <td align="center" valign="top">
                    <table cellpadding="0" cellspacing="0" border="0" width="600" style="margin: 40px auto; background-color: #ffffff; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                        <!-- Header -->
                        <tr>
                            <td style="background-color: #4CAF50; border-top-left-radius: 10px; border-top-right-radius: 10px; padding: 20px; text-align: center;">
                                <h1 style="color: #ffffff; margin: 0;">Contact Request</h1>
                            </td>
                        </tr>
                        <!-- Body -->
                        <tr>
                            <td style="padding: 30px;">
                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tr>
                                        <td style="padding: 10px 0; font-weight: bold;">Name:</td>
                                        <td style="padding: 10px 0;">{{ $details['name'] }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px 0; font-weight: bold;">Email:</td>
                                        <td style="padding: 10px 0;">{{ $details['email'] }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px 0; font-weight: bold;">Phone:</td>
                                        <td style="padding: 10px 0;">{{ $details['phone'] }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px 0; font-weight: bold;">Subject:</td>
                                        <td style="padding: 10px 0;">{{ $details['subject'] }}</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px 0; font-weight: bold;">Message:</td>
                                        <td style="padding: 10px 0;">{{ $details['message'] }}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <!-- Footer -->
                        <tr>
                            <td style="background-color: #333333; padding: 20px; text-align: center; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                                <p style="color: #ffffff; margin: 0; font-size: 12px;">This email was sent automatically. Please do not reply to this email.</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </center>
</body>
</html>

