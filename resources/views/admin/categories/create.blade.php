<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #1f6fd6;
            --secondary-blue: #0056b3;
            --light-blue: #e3f2fd;
            --dark-gray: #333333;
            --light-gray: #666666;
            --white: #ffffff;
            --light-bg: #f8f9fa;
            --accent-green: #10b981;
            --accent-yellow: #f59e0b;
            --accent-red: #ef4444;
            --accent-purple: #8b5cf6;
            --accent-teal: #009688;
        }

        body {
            background: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        /* Sidebar Styling */
        .sidebar {
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            width: 280px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            padding: 2rem 0;
            overflow-y: auto;
        }

        .sidebar-header {
            text-align: center;
            padding: 0 1.5rem 2rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 2rem;
        }

        .sidebar-brand {
            color: var(--white);
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .sidebar-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }

        .sidebar-nav {
            padding: 0 1.5rem;
        }

        .nav-item {
            margin-bottom: 0.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: var(--white);
        }

        .nav-link i {
            margin-right: 1rem;
            width: 20px;
        }

        .sidebar-footer {
            position: absolute;
            bottom: 2rem;
            left: 0;
            right: 0;
            padding: 0 1.5rem;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 2rem;
        }

        .page-header {
            background: var(--white);
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        .page-title {
            color: var(--dark-gray);
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
        }

        .btn-custom {
            background: var(--primary-blue);
            border: none;
            color: var(--white);
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-custom:hover {
            background: var(--secondary-blue);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(31, 111, 214, 0.3);
        }

        /* Form Styling */
        .form-container {
            background: var(--white);
            border-radius: 12px;
            padding: 2rem;
            border: 1px solid #e9ecef;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        .form-label {
            color: var(--dark-gray);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.2rem rgba(31, 111, 214, 0.15);
        }

        .btn-save {
            background: var(--accent-green);
            border: none;
            color: var(--white);
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-save:hover {
            background: #059669;
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <img src="{{ asset('images/logo-sekolah.png') }}" alt="Logo Sekolah" style="width:50px;height:50px;object-fit:contain;">
            </div>
            <div>
                <div class="sidebar-brand">SMKN 4 BOGOR</div>
                <div class="sidebar-subtitle">Admin Panel</div>
            </div>
        </div>
        <nav class="sidebar-nav">
            <div class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="fas fa-tachometer-alt"></i>Dashboard Admin
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.photos.index') }}" class="nav-link">
                    <i class="fas fa-images"></i>Kelola Galeri
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.categories.index') }}" class="nav-link active">
                    <i class="fas fa-folder-open"></i>Kelola Kategori
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.agenda.index') }}" class="nav-link">
                    <i class="fas fa-calendar-alt"></i>Kelola Agenda
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.petugas') }}" class="nav-link">
                    <i class="fas fa-users"></i>Manajemen Admin
                </a>
            </div>
        </nav>
        
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="page-header">
            <h3 class="page-title">
                <i class="fas fa-folder-plus me-2 text-primary"></i>Tambah Kategori
            </h3>
            <a href="{{ route('admin.categories.index') }}" class="btn-custom">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>

        <div class="form-container">
            <form action="{{ route('admin.categories.store') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-6">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3"></textarea>
                </div>
                <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn-save">
                        <i class="fas fa-save me-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>








