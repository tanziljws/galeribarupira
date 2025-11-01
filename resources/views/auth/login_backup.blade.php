<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SMKN 4 Bogor Gallery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            overflow: hidden;
            background: #0f0f1e;
        }

        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            width: 100%;
            max-width: 400px;
            margin: 20px;
        }

        .login-header {
            background: var(--gradient-primary);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .login-header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .login-header p {
            opacity: 0.9;
            font-size: 0.9rem;
        }

        .login-body {
            padding: 2rem;
        }

        .login-tabs {
            display: flex;
            margin-bottom: 2rem;
            background: #f8fafc;
            border-radius: 12px;
            padding: 4px;
        }

        .login-tab {
            flex: 1;
            padding: 0.75rem 1rem;
            text-align: center;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 0.9rem;
            color: var(--light-gray);
        }

        .login-tab.active {
            background: white;
            color: var(--primary-color);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .login-form {
            display: none;
        }

        .login-form.active {
            display: block;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid var(--border-color);
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .btn-login {
            width: 100%;
            background: var(--gradient-primary);
            color: white;
            border: none;
            padding: 0.875rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .btn-login:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .demo-credentials {
            background: #f8fafc;
            border-radius: 12px;
            padding: 1rem;
            margin-top: 1rem;
        }

        .demo-credentials h6 {
            color: var(--dark-color);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .demo-credentials p {
            color: var(--light-gray);
            font-size: 0.85rem;
            margin-bottom: 0.25rem;
        }

        .alert {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .alert-danger {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .alert-success {
            background: #f0fdf4;
            color: #16a34a;
            border: 1px solid #bbf7d0;
        }

        .back-link {
            text-align: center;
            margin-top: 1rem;
        }

        .back-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .back-link a:hover {
            color: var(--primary-dark);
        }

        @media (max-width: 480px) {
            .login-container {
                margin: 10px;
                border-radius: 16px;
            }
            
            .login-header {
                padding: 1.5rem;
            }
            
            .login-body {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1><i class="fas fa-images me-2"></i>SMKN 4 Bogor</h1>
            <p>Galeri Foto & Admin Panel</p>
        </div>
        
        <div class="login-body">
            <!-- Error/Success Messages -->
            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Login Tabs -->
            <div class="login-tabs">
                <div class="login-tab active" data-tab="user">
                    <i class="fas fa-user me-1"></i> User
                </div>
                <div class="login-tab" data-tab="admin">
                    <i class="fas fa-shield-alt me-1"></i> Admin
                </div>
            </div>

            <!-- User Login Form -->
            <form id="userLoginForm" class="login-form active" method="POST" action="{{ route('login.user') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                </div>
                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>Login sebagai User
                </button>
            </form>

            <!-- Admin Login Form -->
            <form id="adminLoginForm" class="login-form" method="POST" action="{{ route('login.admin') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                </div>
                <button type="submit" class="btn-login">
                    <i class="fas fa-shield-alt me-2"></i>Login sebagai Admin
                </button>
            </form>

            <!-- Demo Credentials -->
            <div class="demo-credentials">
                <h6><i class="fas fa-info-circle me-1"></i>Demo Credentials</h6>
                <p><strong>User:</strong> user@example.com / password</p>
                <p><strong>Admin:</strong> admin / admin123</p>
            </div>

            <!-- Back to Gallery -->
            <div class="back-link">
                <a href="{{ route('gallery.galeri') }}">
                    <i class="fas fa-arrow-left me-1"></i>Kembali ke Galeri
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Tab switching
        document.querySelectorAll('.login-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                const tabType = this.dataset.tab;
                
                // Update active tab
                document.querySelectorAll('.login-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                
                // Update active form
                document.querySelectorAll('.login-form').forEach(f => f.classList.remove('active'));
                document.getElementById(tabType + 'LoginForm').classList.add('active');
            });
        });

        // Form submission with loading state
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('.btn-login');
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
            });
        });
    </script>
</body>
</html>
