<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - SMKN 4 Bogor</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.4) 0%, rgba(96, 165, 250, 0.4) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 20px;
            overflow: hidden;
            position: relative;
        }

        /* Decorative wave shapes on body background */
        body::before {
            content: '';
            position: fixed;
            top: -50%;
            left: -10%;
            width: 500px;
            height: 500px;
            background: rgba(96, 165, 250, 0.35);
            border-radius: 40% 60% 70% 30%;
            animation: wave 8s ease-in-out infinite;
            z-index: 0;
            filter: blur(40px);
        }

        body::after {
            content: '';
            position: fixed;
            bottom: -50%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: rgba(147, 197, 253, 0.35);
            border-radius: 60% 40% 30% 70%;
            animation: wave 10s ease-in-out infinite reverse;
            z-index: 0;
            filter: blur(40px);
        }

        @keyframes wave {
            0%, 100% {
                transform: rotate(0deg) scale(1);
            }
            50% {
                transform: rotate(10deg) scale(1.1);
            }
        }

        /* Animated background particles */
        .bg-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.4);
            border-radius: 50%;
            animation: float 15s infinite;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
        }

        .particle:nth-child(1) { width: 80px; height: 80px; left: 10%; animation-delay: 0s; animation-duration: 12s; }
        .particle:nth-child(2) { width: 60px; height: 60px; left: 70%; animation-delay: 2s; animation-duration: 15s; }
        .particle:nth-child(3) { width: 100px; height: 100px; left: 40%; animation-delay: 4s; animation-duration: 18s; }
        .particle:nth-child(4) { width: 50px; height: 50px; left: 80%; animation-delay: 1s; animation-duration: 14s; }
        .particle:nth-child(5) { width: 70px; height: 70px; left: 20%; animation-delay: 3s; animation-duration: 16s; }

        @keyframes float {
            0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10% { opacity: 0.3; }
            90% { opacity: 0.3; }
            100% { transform: translateY(-100vh) rotate(360deg); opacity: 0; }
        }

        .verify-container {
            position: relative;
            z-index: 1;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 480px;
            padding: 40px 45px 45px 45px;
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .logo-container {
            display: none;
        }

        .verify-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .verify-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #1E40AF 0%, #1e3a8a 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            animation: pulse 2s infinite;
        }

        .verify-icon i {
            font-size: 40px;
            color: white;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .verify-header h1 {
            font-size: 26px;
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
        }

        .verify-header p {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
        }

        .verify-header .email-info {
            color: #1E40AF;
            font-weight: 600;
            margin-top: 5px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .input-group {
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
            font-size: 16px;
            z-index: 1;
        }

        .form-control {
            width: 100%;
            padding: 20px 20px 20px 45px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            font-size: 28px;
            letter-spacing: 8px;
            text-align: center;
            transition: all 0.3s;
            outline: none;
            background: #f8f9fa;
            min-height: 70px;
            font-weight: 700;
        }

        .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
            background: white;
        }

        .error-message {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }

        .error-message.show {
            display: block;
        }

        .btn-verify {
            width: 100%;
            padding: 15px 45px;
            background: #1E40AF;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 20px;
        }

        .btn-verify:hover {
            background: #1e3a8a;
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
        }

        .btn-verify:active {
            transform: translateY(0);
        }

        .btn-resend {
            width: 100%;
            padding: 14px 45px;
            background: transparent;
            color: #1E40AF;
            border: 2px solid #1E40AF;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .btn-resend:hover {
            background: #1E40AF;
            color: white;
        }

        .btn-resend:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .timer-info {
            text-align: center;
            margin-top: 15px;
            color: #666;
            font-size: 13px;
        }

        .timer-info .countdown {
            font-weight: 700;
            color: #1E40AF;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-danger {
            background: #fee;
            color: #c33;
            border: 1px solid #fcc;
        }

        .alert-success {
            background: #efe;
            color: #3c3;
            border: 1px solid #cfc;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 5px;
            color: #666;
            font-size: 14px;
        }

        .back-link a {
            color: #1E40AF;
            text-decoration: none;
            font-weight: 600;
        }

        .back-link a:hover {
            text-decoration: underline;
        }

        /* Responsive Design for Mobile */
        @media (max-width: 768px) {
            body {
                padding: 10px;
                overflow-y: auto;
            }

            .verify-container {
                padding: 30px 20px;
                border-radius: 15px;
                max-width: 100%;
            }

            .verify-header h1 {
                font-size: 24px;
            }

            .verify-header p {
                font-size: 13px;
            }

            .form-group {
                margin-bottom: 15px;
            }

            .form-control {
                padding: 10px 12px;
                font-size: 16px;
            }

            .btn-verify {
                padding: 12px;
                font-size: 15px;
            }

            .btn-resend {
                padding: 10px;
                font-size: 13px;
            }

            .alert {
                padding: 10px 12px;
                font-size: 13px;
            }
        }

        @media (max-width: 480px) {
            .verify-container {
                padding: 25px 15px;
            }

            .verify-header h1 {
                font-size: 22px;
            }

            .form-control {
                font-size: 14px;
            }

            .btn-verify {
                padding: 11px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <!-- Background Animation -->
    <div class="bg-animation">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <!-- Verify Container -->
    <div class="verify-container">
        <div class="logo-container">
            @php
                $primaryLogo = file_exists(public_path('uploads/logo.png')) ? 'uploads/logo.png' : 'images/logo.png';
            @endphp
            <img src="{{ asset($primaryLogo) }}" alt="SMKN 4 Bogor">
            <div class="logo-text">
                <h2>SMKN 4 BOGOR</h2>
                <p>Galeri Foto Sekolah</p>
            </div>
        </div>
        
        <div class="verify-header">
            <div class="verify-icon">
                <i class="fas fa-envelope-open-text"></i>
            </div>
            <h1>Verifikasi Email</h1>
            <p>Kami telah mengirimkan kode OTP 6 digit ke email:</p>
            <p class="email-info">{{ session('pending_verification_user_email') }}</p>
            <p style="margin-top: 10px; font-size: 13px;">Silakan masukkan kode verifikasi di bawah ini.</p>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('verify.otp.post') }}" method="POST" id="verifyForm">
            @csrf
            
            <div class="form-group">
                <label for="otp">Kode OTP</label>
                <div class="input-group">
                    <i class="fas fa-key"></i>
                    <input type="text" name="otp" id="otp" class="form-control" placeholder="000000" maxlength="6" pattern="[0-9]{6}" required autofocus>
                </div>
                <span class="error-message" id="otpError"></span>
            </div>

            <button type="submit" class="btn-verify">
                <i class="fas fa-check-circle"></i> Verifikasi
            </button>
        </form>

        <form action="{{ route('verify.otp.resend') }}" method="POST" id="resendForm">
            @csrf
            <button type="submit" class="btn-resend" id="resendBtn">
                <i class="fas fa-redo"></i> Kirim Ulang Kode OTP
            </button>
        </form>

        <div class="timer-info">
            <p>Kode OTP berlaku selama <span class="countdown" id="countdown">10:00</span></p>
        </div>

        <div class="back-link">
            <a href="{{ route('login') }}"><i class="fas fa-arrow-left"></i> Kembali ke Login</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Auto-format OTP input (hanya angka)
        const otpInput = document.getElementById('otp');
        otpInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        // Form validation
        document.getElementById('verifyForm').addEventListener('submit', function(e) {
            const otp = document.getElementById('otp').value.trim();
            
            if (otp.length !== 6) {
                e.preventDefault();
                document.getElementById('otpError').textContent = 'Kode OTP harus 6 digit';
                document.getElementById('otpError').classList.add('show');
                
                Swal.fire({
                    icon: 'error',
                    title: 'Kode OTP Tidak Valid',
                    text: 'Mohon masukkan kode OTP 6 digit',
                    confirmButtonColor: '#1E40AF'
                });
            }
        });

        // Countdown timer (10 menit)
        let timeLeft = 600; // 10 menit dalam detik
        const countdownEl = document.getElementById('countdown');
        const resendBtn = document.getElementById('resendBtn');

        function updateCountdown() {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            countdownEl.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
            
            if (timeLeft <= 0) {
                countdownEl.textContent = 'Kadaluarsa';
                countdownEl.style.color = '#e74c3c';
                Swal.fire({
                    icon: 'warning',
                    title: 'Kode OTP Kadaluarsa',
                    text: 'Silakan kirim ulang kode OTP baru',
                    confirmButtonColor: '#1E40AF'
                });
            } else {
                timeLeft--;
                setTimeout(updateCountdown, 1000);
            }
        }

        updateCountdown();

        // Resend OTP handler
        document.getElementById('resendForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            Swal.fire({
                title: 'Kirim Ulang OTP?',
                text: 'Kode OTP baru akan dikirim ke email Anda',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#1E40AF',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Kirim',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Disable button sementara
                    resendBtn.disabled = true;
                    resendBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';
                    
                    // Submit form
                    this.submit();
                }
            });
        });

        // Show success message if exists
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#1E40AF'
        });
        @endif

        // Show error message if exists
        @if($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Verifikasi Gagal',
            html: '<ul style="text-align: left; padding-left: 20px;">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
            confirmButtonColor: '#1E40AF'
        });
        @endif
    </script>
</body>
</html>
