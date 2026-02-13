<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <h2 style="color: #0a2540;">New contact message</h2>

    <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <td style="padding: 10px; font-weight: bold; border-bottom: 1px solid #eee;">Name:</td>
            <td style="padding: 10px; border-bottom: 1px solid #eee;">{{ $data['nombre'] }}</td>
        </tr>
        <tr>
            <td style="padding: 10px; font-weight: bold; border-bottom: 1px solid #eee;">Email:</td>
            <td style="padding: 10px; border-bottom: 1px solid #eee;">{{ $data['email'] }}</td>
        </tr>
        <tr>
            <td style="padding: 10px; font-weight: bold; border-bottom: 1px solid #eee;">Phone:</td>
            <td style="padding: 10px; border-bottom: 1px solid #eee;">{{ $data['telefono'] ?? '-' }}</td>
        </tr>
    </table>

    <div style="margin-top: 20px; padding: 15px; background: #f8f9fa; border-radius: 5px;">
        <strong>Message:</strong>
        <p>{{ $data['mensaje'] }}</p>
    </div>

    <p style="margin-top: 30px; font-size: 12px; color: #999;">
        Sent from the Implantex Academy website
    </p>
</body>
</html>