<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Galeri - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #1f6fd6;
            --secondary-blue: #0056b3;
            --accent-green: #10b981;
            --accent-orange: #f59e0b;
            --accent-red: #ef4444;
            --light-blue: #e3f2fd;
            --dark-gray: #1f2937;
            --light-gray: #6b7280;
            --white: #ffffff;
            --light-bg: #f8fafc;
            --border-color: #e5e7eb;
        }

        body {
            background: var(--light-bg);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar {
            background: var(--white) !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-bottom: 1px solid #e9ecef;
        }
        
        .navbar-brand {
            color: var(--primary-blue) !important;
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .navbar-nav .nav-link {
            color: var(--dark-gray) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            margin: 0 0.5rem;
            border-radius: 6px;
            padding: 0.5rem 1rem;
        }
        
        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: var(--primary-blue) !important;
            background: var(--light-blue);
        }
        
        .btn-logout {
            background: var(--primary-blue);
            border: none;
            color: var(--white);
            padding: 0.5rem 1.5rem;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            margin-left: 1rem;
        }
        
        .btn-logout:hover {
            background: var(--secondary-blue);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(31, 111, 214, 0.3);
        }

        .page-header {
            background: linear-gradient(135deg, var(--accent-orange) 0%, var(--primary-blue) 100%);
            border-radius: 20px;
            padding: 3rem 2rem;
            margin-bottom: 3rem;
            text-align: center;
            box-shadow: 0 20px 40px rgba(245, 158, 11, 0.3);
            position: relative;
            overflow: hidden;
            color: var(--white);
            animation: float 6s ease-in-out infinite;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 8s linear infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .page-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1rem;
            color: var(--white);
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
            position: relative;
            z-index: 2;
        }
        
        .page-subtitle {
            font-size: 1.2rem;
            color: rgba(255,255,255,0.9);
            font-weight: 500;
            line-height: 1.6;
            position: relative;
            z-index: 2;
        }

        .btn-add-gallery {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: var(--white);
            padding: 0.8rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            backdrop-filter: blur(10px);
            position: relative;
            z-index: 2;
        }

        .btn-add-gallery:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
            color: var(--white);
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        
        .main-content {
            background: var(--white);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            border: 1px solid var(--border-color);
            margin-bottom: 2rem;
        }

        .gallery-card {
            background: var(--white);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            transition: all 0.4s ease;
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
            animation: slideInUp 0.6s ease forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        .gallery-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-orange), var(--primary-blue));
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .gallery-card:hover::before {
            transform: scaleX(1);
        }

        .gallery-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
        }

        .gallery-card:nth-child(1) { animation-delay: 0.1s; }
        .gallery-card:nth-child(2) { animation-delay: 0.2s; }
        .gallery-card:nth-child(3) { animation-delay: 0.3s; }
        .gallery-card:nth-child(4) { animation-delay: 0.4s; }

        @keyframes slideInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .gallery-icon {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            background: linear-gradient(135deg, var(--accent-orange), var(--primary-blue));
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: var(--white);
            font-size: 2rem;
            box-shadow: 0 8px 25px rgba(245, 158, 11, 0.3);
            transition: all 0.3s ease;
        }

        .gallery-card:hover .gallery-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .gallery-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark-gray);
            margin-bottom: 1rem;
            text-align: center;
        }

        .gallery-description {
            color: var(--light-gray);
            line-height: 1.6;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .gallery-stats {
            display: flex;
            justify-content: space-around;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: var(--light-bg);
            border-radius: 15px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--accent-orange);
            display: block;
        }

        .stat-label {
            font-size: 0.8rem;
            color: var(--light-gray);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .gallery-actions {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
        }

        .btn-edit {
            background: var(--accent-green);
            color: var(--white);
            border: none;
            border-radius: 10px;
            padding: 0.6rem 1.2rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .btn-edit:hover {
            background: #059669;
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
        }

        .btn-delete {
            background: var(--accent-red);
            color: var(--white);
            border: none;
            border-radius: 10px;
            padding: 0.6rem 1.2rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn-delete:hover {
            background: #dc2626;
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(239, 68, 68, 0.3);
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--light-gray);
        }

        .empty-state i {
            font-size: 5rem;
            margin-bottom: 1.5rem;
            opacity: 0.5;
            color: var(--accent-orange);
        }

        .alert {
            border-radius: 15px;
            border: none;
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border-left: 4px solid var(--accent-green);
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
            border-left: 4px solid var(--accent-red);
        }

        @media (max-width: 768px) {
            .page-title {
                font-size: 2rem;
            }
            
            .main-content {
                padding: 1rem;
            }
            
            .gallery-card {
                margin-bottom: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-graduation-cap me-2"></i>SMKN 4 Bogor
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.galery.index') }}">
                            <i class="fas fa-images me-1"></i>Galeri
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.kategori.index') }}">
                            <i class="fas fa-folder me-1"></i>Kategori
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.foto.index') }}">
                            <i class="fas fa-camera me-1"></i>Foto
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.petugas') }}">
                            <i class="fas fa-users me-1"></i>Petugas
                        </a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-images me-3"></i>Kelola Galeri
            </h1>
            <p class="page-subtitle">Mengelola album galeri foto dengan mudah dan terorganisir</p>
            <a href="#" class="btn-add-gallery" data-bs-toggle="modal" data-bs-target="#addGalleryModal">
                <i class="fas fa-plus me-2"></i>Tambah Galeri Baru
            </a>
        </div>

        <!-- Galleries List -->
        <div class="main-content">
            @if($galeries->count() > 0)
                <div class="row g-4">
                    @foreach($galeries as $galeri)
                        <div class="col-lg-4 col-md-6">
                            <div class="gallery-card">
                                <div class="gallery-icon">
                                    <i class="fas fa-images"></i>
                                </div>
                                <h4 class="gallery-name">{{ $galeri->nama ?? 'Galeri' }}</h4>
                                <p class="gallery-description">{{ $galeri->deskripsi ?? 'Deskripsi album galeri foto' }}</p>
                                
                                <div class="gallery-stats">
                                    <div class="stat-item">
                                        <span class="stat-number">{{ $galeri->fotos_count ?? 0 }}</span>
                                        <span class="stat-label">Foto</span>
                                    </div>
                                    <div class="stat-item">
                                        <span class="stat-number">{{ $galeri->kategoris_count ?? 0 }}</span>
                                        <span class="stat-label">Kategori</span>
                                    </div>
                                </div>
                                
                                <div class="gallery-actions">
                                    <a href="#" class="btn btn-edit" onclick="editGallery({{ $galeri->id }})">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>
                                    <form action="{{ route('admin.galery.destroy', $galeri->id) }}" 
                                          method="POST" 
                                          style="display: inline;"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus galeri ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete">
                                            <i class="fas fa-trash me-1"></i>Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-images"></i>
                    <h4>Belum ada galeri</h4>
                    <p>Mulai dengan menambahkan galeri pertama untuk mengorganisir foto</p>
                    <a href="#" class="btn-add-gallery" data-bs-toggle="modal" data-bs-target="#addGalleryModal">
                        <i class="fas fa-plus me-2"></i>Tambah Galeri Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Add Gallery Modal -->
    <div class="modal fade" id="addGalleryModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-images me-2"></i>Tambah Galeri Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.galery.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Galeri</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-add-gallery">
                            <i class="fas fa-save me-2"></i>Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function editGallery(id) {
            // Implementasi untuk edit galeri
            alert('Fitur edit galeri akan segera hadir!');
        }
    </script>
</body>
</html>
