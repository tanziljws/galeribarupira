<?php
/**
 * Test Script untuk Debugging OTP Email
 * Akses: http://127.0.0.1:8000/test-otp-mail.php
 */

// Load Laravel
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\SendOtpMail;

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test OTP Mail</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }
        .section {
            margin: 20px 0;
            padding: 15px;
            background: #f9f9f9;
            border-left: 4px solid #007bff;
            border-radius: 4px;
        }
        .section h2 {
            margin-top: 0;
            color: #007bff;
            font-size: 16px;
        }
        .config-item {
            margin: 8px 0;
            padding: 8px;
            background: white;
            border-radius: 4px;
            font-family: monospace;
        }
        .config-item strong {
            color: #333;
            min-width: 200px;
            display: inline-block;
        }
        .config-value {
            color: #666;
        }
        .success {
            color: #28a745;
            font-weight: bold;
        }
        .error {
            color: #dc3545;
            font-weight: bold;
        }
        .warning {
            color: #ffc107;
            font-weight: bold;
        }
        .form-group {
            margin: 15px 0;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: Arial, sans-serif;
            box-sizing: border-box;
        }
        button {
            background: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }
        button:hover {
            background: #0056b3;
        }
        .log-output {
            background: #1e1e1e;
            color: #00ff00;
            padding: 15px;
            border-radius: 4px;
            font-family: monospace;
            font-size: 12px;
            max-height: 400px;
            overflow-y: auto;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔧 Test OTP Email Configuration</h1>
        
        <div class="section">
            <h2>📋 Konfigurasi Mail Saat Ini</h2>
            <div class="config-item">
                <strong>MAIL_MAILER:</strong>
                <span class="config-value"><?php echo config('mail.default'); ?></span>
            </div>
            <div class="config-item">
                <strong>MAIL_HOST:</strong>
                <span class="config-value"><?php echo config('mail.mailers.smtp.host'); ?></span>
            </div>
            <div class="config-item">
                <strong>MAIL_PORT:</strong>
                <span class="config-value"><?php echo config('mail.mailers.smtp.port'); ?></span>
            </div>
            <div class="config-item">
                <strong>MAIL_ENCRYPTION:</strong>
                <span class="config-value"><?php echo config('mail.mailers.smtp.encryption'); ?></span>
            </div>
            <div class="config-item">
                <strong>MAIL_USERNAME:</strong>
                <span class="config-value"><?php echo config('mail.mailers.smtp.username'); ?></span>
            </div>
            <div class="config-item">
                <strong>MAIL_FROM_ADDRESS:</strong>
                <span class="config-value"><?php echo config('mail.from.address'); ?></span>
            </div>
            <div class="config-item">
                <strong>MAIL_FROM_NAME:</strong>
                <span class="config-value"><?php echo config('mail.from.name'); ?></span>
            </div>
        </div>

        <div class="section">
            <h2>✉️ Test Pengiriman Email OTP</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="email">Email Tujuan:</label>
                    <input type="email" id="email" name="email" placeholder="contoh@gmail.com" required>
                </div>
                <div class="form-group">
                    <label for="name">Nama Pengguna:</label>
                    <input type="text" id="name" name="name" placeholder="Nama Anda" value="Test User" required>
                </div>
                <button type="submit" name="action" value="send_test">🚀 Kirim Email Test OTP</button>
            </form>

            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
                $email = $_POST['email'] ?? '';
                $name = $_POST['name'] ?? '';
                
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo '<div class="section" style="border-left-color: #dc3545;"><h2 style="color: #dc3545;">❌ Email tidak valid</h2></div>';
                } else {
                    echo '<div class="section"><h2>📤 Hasil Test Pengiriman</h2>';
                    
                    try {
                        // Generate OTP test
                        $testOtp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
                        
                        echo '<p><strong>Email Tujuan:</strong> ' . htmlspecialchars($email) . '</p>';
                        echo '<p><strong>Nama:</strong> ' . htmlspecialchars($name) . '</p>';
                        echo '<p><strong>OTP Test:</strong> <span class="success">' . $testOtp . '</span></p>';
                        echo '<p><strong>Status:</strong> Mengirim...</p>';
                        
                        // Kirim email
                        Mail::to($email)->send(new SendOtpMail($testOtp, $name));
                        
                        echo '<p><span class="success">✅ Email berhasil dikirim!</span></p>';
                        echo '<p style="color: #666; font-size: 12px;">Periksa folder Inbox atau Spam di email Anda. Jika tidak ada dalam 2 menit, cek konfigurasi SMTP.</p>';
                        
                    } catch (\Exception $e) {
                        echo '<p><span class="error">❌ Gagal mengirim email</span></p>';
                        echo '<p><strong>Error Message:</strong></p>';
                        echo '<div class="log-output">' . htmlspecialchars($e->getMessage()) . '</div>';
                        echo '<p><strong>Stack Trace:</strong></p>';
                        echo '<div class="log-output">' . htmlspecialchars($e->getTraceAsString()) . '</div>';
                    }
                    
                    echo '</div>';
                }
            }
            ?>
        </div>

        <div class="section">
            <h2>📝 Checklist Konfigurasi</h2>
            <ul style="line-height: 1.8;">
                <li>✓ MAIL_MAILER harus <code>smtp</code></li>
                <li>✓ MAIL_HOST harus <code>smtp.gmail.com</code> (bukan googlemail)</li>
                <li>✓ MAIL_PORT harus <code>587</code></li>
                <li>✓ MAIL_ENCRYPTION harus <code>tls</code></li>
                <li>✓ MAIL_USERNAME harus email Gmail Anda</li>
                <li>✓ MAIL_PASSWORD harus App Password (bukan password akun)</li>
                <li>✓ MAIL_FROM_ADDRESS harus sesuai dengan MAIL_USERNAME</li>
                <li>✓ Akun Google harus punya 2FA aktif</li>
                <li>✓ Sudah jalankan <code>php artisan config:clear</code></li>
            </ul>
        </div>

        <div class="section">
            <h2>📖 Panduan Setup Gmail App Password</h2>
            <ol style="line-height: 1.8;">
                <li>Buka https://myaccount.google.com/security</li>
                <li>Pastikan 2-Step Verification sudah aktif</li>
                <li>Cari "App passwords" di halaman security</li>
                <li>Pilih "Mail" dan "Windows Computer"</li>
                <li>Copy password yang diberikan</li>
                <li>Paste ke <code>MAIL_PASSWORD</code> di .env</li>
                <li>Jalankan <code>php artisan config:clear</code></li>
            </ol>
        </div>

        <div class="section" style="border-left-color: #ffc107;">
            <h2 style="color: #ffc107;">⚠️ Catatan Penting</h2>
            <p>Jangan lupa untuk:</p>
            <ul style="line-height: 1.8;">
                <li>Hapus file ini setelah selesai testing (untuk keamanan)</li>
                <li>Jangan commit file ini ke repository</li>
                <li>Gunakan environment variable yang aman di production</li>
            </ul>
        </div>
    </div>
</body>
</html>
