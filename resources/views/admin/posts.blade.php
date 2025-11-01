<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Artikel - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        }
        
        .sidebar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 2rem;
            height: fit-content;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .sidebar .nav-link {
            color: #333;
            border-radius: 10px;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            transform: translateX(5px);
        }
        
        .page-header {
            background: linear-gradient(135deg, var(--accent-green) 0%, var(--primary-blue) 100%);
            border-radius: 20px;
            padding: 3rem 2rem;
            margin-bottom: 3rem;
            text-align: center;
            box-shadow: 0 20px 40px rgba(16, 185, 129, 0.3);
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

        .btn-add-post {
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

        .btn-add-post:hover {
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

        .post-card {
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

        .post-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-green), var(--primary-blue));
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .post-card:hover::before {
            transform: scaleX(1);
        }

        .post-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
        }

        .post-card:nth-child(1) { animation-delay: 0.1s; }
        .post-card:nth-child(2) { animation-delay: 0.2s; }
        .post-card:nth-child(3) { animation-delay: 0.3s; }
        .post-card:nth-child(4) { animation-delay: 0.4s; }

        @keyframes slideInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .post-icon {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            background: linear-gradient(135deg, var(--accent-green), var(--primary-blue));
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: var(--white);
            font-size: 2rem;
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
            transition: all 0.3s ease;
        }

        .post-card:hover .post-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .post-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark-gray);
            margin-bottom: 1rem;
            text-align: center;
        }

        .post-content {
            color: var(--light-gray);
            line-height: 1.6;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .post-meta {
            display: flex;
            justify-content: space-around;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: var(--light-bg);
            border-radius: 15px;
        }

        .meta-item {
            text-align: center;
        }

        .meta-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--accent-green);
            display: block;
        }

        .meta-label {
            font-size: 0.8rem;
            color: var(--light-gray);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .post-actions {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
        }

        .btn-edit {
            background: var(--accent-orange);
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
            background: #d97706;
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(245, 158, 11, 0.3);
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
        
        .btn-custom {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border: none;
            border-radius: 25px;
            padding: 10px 25px;
            color: white;
            transition: all 0.3s ease;
        }
        
        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            color: white;
        }
        
        .post-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .table {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .table th {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 1rem;
        }
        
        .table td {
            padding: 1rem;
            vertical-align: middle;
        }
        
        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .status-published {
            background: #d4edda;
            color: #155724;
        }
        
        .status-draft {
            background: #fff3cd;
            color: #856404;
        }
        
        .status-pending {
            background: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-cog me-2"></i>Admin Dashboard
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('home') }}" target="_blank">
                    <i class="fas fa-external-link-alt me-1"></i>Lihat Website
                </a>
            </div>
        </div>
    </nav>

    <div class="container-fluid" style="padding-top: 100px;">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="sidebar">
                    <h5 class="mb-4 text-center">
                        <i class="fas fa-tachometer-alt me-2"></i>Menu Admin
                    </h5>
                    <nav class="nav flex-column">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-home me-2"></i>Dashboard
                        </a>
                        <a class="nav-link" href="{{ route('admin.galery.index') }}">
                            <i class="fas fa-images me-2"></i>Galeri
                        </a>
                        <a class="nav-link" href="{{ route('admin.foto.index') }}">
                            <i class="fas fa-camera me-2"></i>Foto
                        </a>
                        <a class="nav-link" href="{{ route('admin.kategori.index') }}">
                            <i class="fas fa-folder me-2"></i>Kategori
                        </a>
                        <a class="nav-link" href="{{ route('admin.petugas') }}">
                            <i class="fas fa-users me-2"></i>Petugas
                        </a>
                        <a class="nav-link active" href="{{ route('admin.posts') }}">
                            <i class="fas fa-newspaper me-2"></i>Artikel
                        </a>
                        <a class="nav-link" href="{{ route('admin.profiles') }}">
                            <i class="fas fa-user-circle me-2"></i>Profil
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9">
                <div class="main-content">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2>
                            <i class="fas fa-newspaper me-2"></i>Kelola Artikel
                        </h2>
                        <button class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#addPostModal">
                            <i class="fas fa-plus me-2"></i>Tulis Artikel
                        </button>
                    </div>

                    @if($posts->count() > 0)
                        <!-- Posts Cards View -->
                        <div class="row g-4 mb-5">
                            @foreach($posts as $post)
                                <div class="col-md-6 col-lg-4">
                                    <div class="post-card">
                                        <img src="https://via.placeholder.com/400x200?text=Article" 
                                             class="post-image" 
                                             alt="{{ $post->judul ?? 'Artikel' }}">
                                        <div class="p-3">
                                            <h5 class="mb-2">{{ $post->judul ?? 'Judul Artikel' }}</h5>
                                            <p class="text-muted small mb-3">{{ Str::limit($post->konten ?? 'Konten artikel', 100) }}</p>
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <small class="text-muted">{{ $post->tanggal ?? 'Tanggal' }}</small>
                                                <span class="status-badge status-published">Dipublikasi</span>
                                            </div>
                                            <div class="d-flex justify-content-center gap-2">
                                                <button class="btn btn-sm btn-outline-primary" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-success" title="Lihat">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Table View -->
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Judul</th>
                                        <th>Konten</th>
                                        <th>Tanggal</th>
                                        <th>Penulis</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($posts as $post)
                                        <tr>
                                            <td>{{ $post->id ?? 'N/A' }}</td>
                                            <td>
                                                <strong>{{ $post->judul ?? 'Judul Artikel' }}</strong>
                                            </td>
                                            <td>{{ Str::limit($post->konten ?? 'Konten artikel', 80) }}</td>
                                            <td>{{ $post->tanggal ?? 'Tanggal' }}</td>
                                            <td>{{ $post->penulis ?? 'Penulis' }}</td>
                                            <td>
                                                <span class="status-badge status-published">Dipublikasi</span>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button class="btn btn-sm btn-outline-primary" title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-success" title="Lihat">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">Belum ada artikel</h4>
                            <p class="text-muted">Mulai dengan menulis artikel pertama Anda</p>
                            <button class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#addPostModal">
                                <i class="fas fa-plus me-2"></i>Tulis Artikel Pertama
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Add Post Modal -->
    <div class="modal fade" id="addPostModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-plus me-2"></i>Tulis Artikel Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Artikel</label>
                            <input type="text" class="form-control" id="judul" required>
                        </div>
                        <div class="mb-3">
                            <label for="konten" class="form-label">Konten Artikel</label>
                            <textarea class="form-control" id="konten" rows="8" placeholder="Tulis konten artikel Anda di sini..."></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal Publikasi</label>
                                    <input type="date" class="form-control" id="tanggal">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="penulis" class="form-label">Penulis</label>
                                    <input type="text" class="form-control" id="penulis">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-control" id="kategori">
                                <option value="">Pilih Kategori</option>
                                <option value="berita">Berita</option>
                                <option value="tutorial">Tutorial</option>
                                <option value="review">Review</option>
                                <option value="tips">Tips & Trik</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tags" class="form-label">Tags</label>
                            <input type="text" class="form-control" id="tags" placeholder="tag1, tag2, tag3">
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="status">
                                <option value="published">Dipublikasi</option>
                                <option value="draft">Draft</option>
                                <option value="pending">Menunggu Review</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-custom">
                            <i class="fas fa-save me-2"></i>Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
