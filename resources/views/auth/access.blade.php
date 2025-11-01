<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Sistem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body{background:#f4eeee;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:24px;font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif}
        .card-access{background:#fff;border:none;border-radius:16px;box-shadow:0 16px 40px rgba(0,0,0,.08);padding:28px 24px;max-width:560px;width:100%}
        .title{font-weight:700;text-align:center;margin-bottom:18px}
        .brand{display:flex;flex-direction:column;align-items:center;margin-bottom:6px}
        .brand img{height:64px}
        .btn-access{display:flex;align-items:center;justify-content:space-between;gap:16px;border-radius:12px;padding:14px 18px;font-weight:600}
        .btn-access i{background:#1e64c7;color:#fff;border-radius:10px;padding:8px}
        .btn-primary{background:#1f6fd6;border-color:#1f6fd6}
        .btn-primary:hover{background:#185ab0;border-color:#185ab0}
    </style>
</head>
<body>
    <div class="card-access">
        @php
            $primaryLogo = file_exists(public_path('uploads/logo.png')) ? 'uploads/logo.png' : 'images/logo.png';
        @endphp
        <div class="brand">
            <img src="{{ asset($primaryLogo) }}" alt="Logo">
        </div>
        <h3 class="title">Akses Sistem</h3>

        <div class="d-grid gap-3">
            <a class="btn btn-primary btn-access" href="{{ route('admin.login') }}">
                <span><strong>Admin Login</strong><div class="small text-white-50"></div></span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
            <a class="btn btn-outline-primary btn-access" href="{{ route('user.login') }}">
                <span><strong>User Login</strong></span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>











































































































