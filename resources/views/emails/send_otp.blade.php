<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kode Verifikasi Email</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7fa;
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background: linear-gradient(135deg, #1E40AF 0%, #1e3a8a 100%);
            padding: 40px 30px;
            text-align: center;
            color: white;
        }
        .email-header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }
        .email-header p {
            margin: 10px 0 0;
            font-size: 14px;
            opacity: 0.9;
        }
        .email-body {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
        }
        .message {
            font-size: 15px;
            color: #666;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .otp-container {
            background: linear-gradient(135deg, #f0f4ff 0%, #e0e9ff 100%);
            border: 2px dashed #1E40AF;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            margin: 30px 0;
        }
        .otp-label {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }
        .otp-code {
            font-size: 42px;
            font-weight: 800;
            color: #1E40AF;
            letter-spacing: 8px;
            margin: 10px 0;
            font-family: 'Courier New', monospace;
        }
        .otp-info {
            font-size: 13px;
            color: #999;
            margin-top: 15px;
        }
        .warning-box {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px 20px;
            margin: 25px 0;
            border-radius: 4px;
        }
        .warning-box p {
            margin: 0;
            font-size: 14px;
            color: #856404;
        }
        .warning-box strong {
            display: block;
            margin-bottom: 5px;
            font-size: 15px;
        }
        .footer {
            background: #f8f9fa;
            padding: 25px 30px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        .footer p {
            margin: 5px 0;
            font-size: 13px;
            color: #6c757d;
        }
        .footer a {
            color: #1E40AF;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
        .logo-section {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo-section img {
            width: 80px;
            height: 80px;
            object-fit: contain;
        }
        .school-name {
            font-size: 16px;
            font-weight: 700;
            color: #1E40AF;
            margin-top: 10px;
        }
        @media only screen and (max-width: 600px) {
            .email-container {
                margin: 20px 10px;
            }
            .email-header {
                padding: 30px 20px;
            }
            .email-header h1 {
                font-size: 24px;
            }
            .email-body {
                padding: 30px 20px;
            }
            .otp-code {
                font-size: 36px;
                letter-spacing: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <h1>Verifikasi Email Anda</h1>
            <p>SMKN 4 Bogor - Galeri Foto Sekolah</p>
        </div>

        <!-- Body -->
        <div class="email-body">
            <div class="greeting">
                Halo{{ $userName ? ', ' . $userName : '' }}!
            </div>

            <div class="message">
                <p>Terima kasih telah mendaftar di <strong>Galeri Foto SMKN 4 Bogor</strong>.</p>
                <p>Untuk melanjutkan proses registrasi, silakan verifikasi alamat email Anda dengan memasukkan kode OTP berikut:</p>
            </div>

            <!-- OTP Code -->
            <div class="otp-container">
                <div class="otp-label">Kode Verifikasi OTP</div>
                <div class="otp-code">{{ $otp }}</div>
                <div class="otp-info">
                    <i>Kode ini berlaku selama <strong>10 menit</strong></i>
                </div>
            </div>

            <!-- Warning -->
            <div class="warning-box">
                <strong>⚠️ Perhatian Keamanan</strong>
                <p>Jangan bagikan kode OTP ini kepada siapapun, termasuk pihak yang mengaku sebagai admin. Kami tidak akan pernah meminta kode OTP Anda melalui email, telepon, atau pesan.</p>
            </div>

            <div class="message">
                <p>Jika Anda tidak merasa melakukan registrasi, abaikan email ini atau hubungi kami segera.</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>SMKN 4 Bogor</strong></p>
            <p>Galeri Foto Sekolah</p>
            <p style="margin-top: 15px; font-size: 12px;">
                Email ini dikirim secara otomatis. Mohon tidak membalas email ini.
            </p>
            <p style="margin-top: 10px;">
                <a href="{{ url('/') }}">Kunjungi Website</a> | 
                <a href="{{ url('/kontak') }}">Hubungi Kami</a>
            </p>
        </div>
    </div>
</body>
</html>
