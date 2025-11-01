<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pira Gallery - Galeri Foto Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 280px;
            background: linear-gradient(180deg, #4f46e5 0%, #7c3aed 50%, #9333ea 100%);
            box-shadow: 4px 0 25px rgba(0,0,0,0.15);
            z-index: 1000;
            transition: transform 0.3s ease;
            overflow-y: auto;
        }
        
        .sidebar-brand {
            padding: 2rem 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 1rem;
        }
        
        .sidebar-brand h4 {
            color: white;
            margin: 0;
            font-weight: 700;
            font-size: 1.4rem;
        }
        
        .sidebar-brand .brand-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            color: #fbbf24;
        }
        
        .user-profile {
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 1rem;
        }
        
        .user-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(45deg, #fbbf24, #f59e0b);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
            color: white;
            box-shadow: 0 4px 15px rgba(251, 191, 36, 0.3);
        }
        
        .user-info h6 {
            color: white;
            margin: 0;
            font-weight: 600;
            font-size: 0.95rem;
        }
        
        .user-info p {
            color: rgba(255,255,255,0.7);
            margin: 0;
            font-size: 0.85rem;
        }
        
        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .sidebar-nav li {
            margin: 0;
        }
        
        .sidebar-nav a {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
            font-weight: 500;
        }
        
        .sidebar-nav a:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            border-left-color: #fbbf24;
            transform: translateX(5px);
        }
        
        .sidebar-nav a.active {
            background: rgba(255,255,255,0.15);
            color: white;
            border-left-color: #fbbf24;
            box-shadow: inset 0 0 20px rgba(255,255,255,0.05);
        }
        
        .sidebar-nav a i {
            width: 20px;
            margin-right: 12px;
            font-size: 1.1rem;
        }
        

        
        .main-content {
            margin-left: 280px;
            min-height: 100vh;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .sidebar-toggle {
                display: block !important;
            }
        }
        
        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 1001;
            background: linear-gradient(45deg, #4f46e5, #7c3aed);
            border: none;
            border-radius: 10px;
            padding: 0.75rem;
            color: white;
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
            transition: all 0.3s ease;
        }
        
        .sidebar-toggle:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4);
        }
        
        .hero-section {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 3rem;
            margin: 2rem 0;
            text-align: center;
            color: white;
        }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }
        
        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 15px;
            height: 250px;
        }
        
        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .gallery-item:hover img {
            transform: scale(1.1);
        }
        
        .gallery-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0,0,0,0.8));
            color: white;
            padding: 20px;
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }
        
        .gallery-item:hover .gallery-overlay {
            transform: translateY(0);
        }
        
        .stats-card {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .stats-number {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        
        .section-title {
            color: white;
            text-align: center;
            margin: 3rem 0 2rem 0;
            font-weight: 300;
            font-size: 2.5rem;
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
        
        .gallery-actions {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            gap: 5px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .gallery-item:hover .gallery-actions {
            opacity: 1;
        }
        
        .action-btn {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        
        .action-btn.view {
            background: rgba(34, 197, 94, 0.8);
        }
        
        .action-btn.edit {
            background: rgba(59, 130, 246, 0.8);
        }
        
        .action-btn.delete {
            background: rgba(239, 68, 68, 0.8);
        }
        
        .action-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }
        
        .photo-modal .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }
        
        .photo-modal .modal-header {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            border-radius: 15px 15px 0 0;
        }
        
        .photo-modal .modal-body {
            padding: 0;
        }
        
        .photo-modal .modal-body img {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
        }
        
        .photo-info {
            padding: 1.5rem;
            background: #f8f9fa;
        }
        
        .edit-form {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <!-- Photo Data Script -->
    <script id="photoData" type="application/json">
        {
            @foreach($fotos as $foto)
                "{{ $foto->id }}": {
                    "id": {{ $foto->id }},
                    "judul": "{{ $foto->judul ?? 'Foto' }}",
                    "deskripsi": "{{ $foto->deskripsi ?? 'Deskripsi foto' }}",
                    "url": "{{ $foto->url ?? 'https://via.placeholder.com/400x300?text=Photo' }}",
                    "kategori_id": "{{ $foto->kategori_id ?? '' }}",
                    "galery_id": "{{ $foto->galery_id ?? '' }}",
                    "tanggal": "{{ $foto->created_at ?? '2024-01-01' }}"
                }@if(!$loop->last),@endif
            @endforeach
        }
    </script>

    <!-- Sidebar Toggle Button -->
    <button class="sidebar-toggle" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">
                <i class="fas fa-camera-retro"></i>
            </div>
            <h4>Pira Gallery</h4>
        </div>
        
        
        
        <ul class="sidebar-nav">
            <li>
                <a href="#home" class="active">
                    <i class="fas fa-home"></i>
                    <span>Beranda</span>
                </a>
            </li>
            <li>
                <a href="#gallery">
                    <i class="fas fa-images"></i>
                    <span>Galeri Foto</span>
                </a>
            </li>
            <li>
                <a href="#categories">
                    <i class="fas fa-folder"></i>
                    <span>Kategori</span>
                </a>
            </li>
            <li>
                <a href="#team">
                    <i class="fas fa-users"></i>
                    <span>Tim Kami</span>
                </a>
            </li>
            <li>
                <a href="#about">
                    <i class="fas fa-info-circle"></i>
                    <span>Tentang</span>
                </a>
            </li>
            <li>
                <a href="#contact">
                    <i class="fas fa-envelope"></i>
                    <span>Kontak</span>
                </a>
            </li>
            
            <li>
                <a href="#" onclick="logout()">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Keluar</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid">
        <!-- Hero Section -->
        <div class="hero-section" id="home">
            <h1 class="display-4 fw-bold mb-4">Selamat Datang di Pira Gallery</h1>
            <p class="lead mb-4">Jelajahi koleksi foto dan galeri digital kami yang menakjubkan</p>
            <a href="#gallery" class="btn btn-custom btn-lg">
                <i class="fas fa-images me-2"></i>Lihat Galeri
            </a>
        </div>

        <!-- Statistics Section -->
        <div class="row mb-5">
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number">{{ $fotos->count() }}</div>
                    <div>Total Foto</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number">{{ $galeries->count() }}</div>
                    <div>Album Galeri</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number">{{ $kategoris->count() }}</div>
                    <div>Kategori</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number">{{ $petugas->count() }}</div>
                    <div>Petugas</div>
                </div>
            </div>
        </div>

        <!-- Gallery Section -->
        <section id="gallery">
            <h2 class="section-title">Galeri Foto</h2>
            
            @if($fotos->count() > 0)
                <div class="row g-4">
                    @foreach($fotos as $foto)
                        <div class="col-md-4 col-lg-3">
                            <div class="card">
                                <div class="gallery-item">
                                    <img src="{{ $foto->url ?? 'https://via.placeholder.com/400x300?text=Photo' }}" 
                                         alt="{{ $foto->judul ?? 'Foto' }}">
                                    
                                    <!-- Action Buttons -->
                                    <div class="gallery-actions">
                                        <button class="action-btn view" data-photo-id="{{ $foto->id }}" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="action-btn edit" data-photo-id="{{ $foto->id }}" title="Edit Foto">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="action-btn delete" data-photo-id="{{ $foto->id }}" title="Hapus Foto">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    
                                    <div class="gallery-overlay">
                                        <h6>{{ $foto->judul ?? 'Foto' }}</h6>
                                        <p class="mb-0">{{ $foto->deskripsi ?? 'Deskripsi foto' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center text-white">
                    <i class="fas fa-images fa-3x mb-3"></i>
                    <h4>Belum ada foto tersedia</h4>
                    <p>Foto akan ditampilkan di sini</p>
                </div>
            @endif
        </section>

        <!-- Categories Section -->
        <section class="mt-5" id="categories">
            <h2 class="section-title">Kategori</h2>
            <div class="row g-4">
                @foreach($kategoris as $kategori)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-folder fa-3x text-primary mb-3"></i>
                                <h5 class="card-title">{{ $kategori->nama ?? 'Kategori' }}</h5>
                                <p class="card-text">{{ $kategori->deskripsi ?? 'Deskripsi kategori' }}</p>
                                <a href="#" class="btn btn-custom">Lihat Kategori</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Posts Section -->
        <section class="mt-5">
            <h2 class="section-title">Artikel Terbaru</h2>
            <div class="row g-4">
                @foreach($posts->take(3) as $post)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->judul ?? 'Judul Artikel' }}</h5>
                                <p class="card-text">{{ Str::limit($post->konten ?? 'Konten artikel', 100) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">{{ $post->tanggal ?? 'Tanggal' }}</small>
                                    <a href="#" class="btn btn-custom btn-sm">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Staff Section -->
        <section class="mt-5" id="team">
            <h2 class="section-title">Tim Kami</h2>
            <div class="row g-4">
                @foreach($petugas as $staff)
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="rounded-circle bg-primary d-inline-flex align-items-center justify-content-center mb-3" 
                                     style="width: 80px; height: 80px;">
                                    <i class="fas fa-user fa-2x text-white"></i>
                                </div>
                                <h6 class="card-title">{{ $staff->nama ?? 'Nama Petugas' }}</h6>
                                <p class="card-text">{{ $staff->jabatan ?? 'Jabatan' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- About Section -->
        <section class="mt-5" id="about">
            <h2 class="section-title">Tentang Kami</h2>
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-body text-center">
                            @if($profiles->count() > 0)
                                @foreach($profiles as $profile)
                                    <h4>{{ $profile->nama ?? 'Pira Gallery' }}</h4>
                                    <p class="lead">{{ $profile->deskripsi ?? 'Deskripsi tentang galeri kami' }}</p>
                                    <p>{{ $profile->visi ?? 'Visi dan misi galeri' }}</p>
                                @endforeach
                            @else
                                <h4>Pira Gallery</h4>
                                <p class="lead">Galeri foto digital terbaik dengan koleksi yang beragam dan berkualitas tinggi.</p>
                                <p>Kami berkomitmen untuk menyajikan karya fotografi terbaik dari berbagai kategori dan tema.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="mt-5" id="contact">
            <h2 class="section-title">Hubungi Kami</h2>
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="pesan" class="form-label">Pesan</label>
                                    <textarea class="form-control" id="pesan" rows="4" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-custom w-100">
                                    <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="text-center text-white mt-5 py-4">
            <p>&copy; 2024 Pira Gallery. Semua hak cipta dilindungi.</p>
        </footer>
        </div>
    </div>

    <!-- View Photo Modal -->
    <div class="modal fade photo-modal" id="viewPhotoModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewPhotoTitle">Detail Foto</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <img id="viewPhotoImage" src="" alt="Foto" class="img-fluid">
                    <div class="photo-info">
                        <h6 id="viewPhotoJudul"></h6>
                        <p id="viewPhotoDeskripsi" class="mb-2"></p>
                        <small class="text-muted">
                            <i class="fas fa-calendar me-1"></i>
                            <span id="viewPhotoTanggal"></span>
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" onclick="editCurrentPhoto()">Edit Foto</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Photo Modal -->
    <div class="modal fade" id="editPhotoModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Foto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="edit-form">
                        <form id="editPhotoForm">
                            <input type="hidden" id="editPhotoId">
                            <div class="mb-3">
                                <label for="editPhotoJudul" class="form-label">Judul Foto</label>
                                <input type="text" class="form-control" id="editPhotoJudul" required>
                            </div>
                            <div class="mb-3">
                                <label for="editPhotoDeskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="editPhotoDeskripsi" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="editPhotoUrl" class="form-label">URL Foto</label>
                                <input type="url" class="form-control" id="editPhotoUrl" required>
                            </div>
                            <div class="mb-3">
                                <label for="editPhotoKategori" class="form-label">Kategori</label>
                                <select class="form-control" id="editPhotoKategori">
                                    <option value="">Pilih Kategori</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="editPhotoGaleri" class="form-label">Galeri</label>
                                <select class="form-control" id="editPhotoGaleri">
                                    <option value="">Pilih Galeri</option>
                                    @foreach($galeries as $galeri)
                                        <option value="{{ $galeri->id }}">{{ $galeri->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary flex-fill">
                                    <i class="fas fa-save me-2"></i>Simpan Perubahan
                                </button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar toggle functionality
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
        });

        // Event listeners untuk action buttons
        document.addEventListener('DOMContentLoaded', function() {
            // View photo buttons
            document.querySelectorAll('.action-btn.view').forEach(btn => {
                btn.addEventListener('click', function() {
                    const photoId = this.dataset.photoId;
                    viewPhoto(photoId);
                });
            });

            // Edit photo buttons
            document.querySelectorAll('.action-btn.edit').forEach(btn => {
                btn.addEventListener('click', function() {
                    const photoId = this.dataset.photoId;
                    editPhoto(photoId);
                });
            });

            // Delete photo buttons
            document.querySelectorAll('.action-btn.delete').forEach(btn => {
                btn.addEventListener('click', function() {
                    const photoId = this.dataset.photoId;
                    deletePhoto(photoId);
                });
            });
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(e) {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.getElementById('sidebarToggle');
            
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(e.target) && !toggle.contains(e.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });

        // Smooth scrolling untuk navigasi
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                    
                    // Update active state in sidebar
                    document.querySelectorAll('.sidebar-nav a').forEach(link => {
                        link.classList.remove('active');
                    });
                    this.classList.add('active');
                    
                    // Close sidebar on mobile after navigation
                    if (window.innerWidth <= 768) {
                        document.getElementById('sidebar').classList.remove('show');
                    }
                }
            });
        });

        // Set active state based on scroll position
        window.addEventListener('scroll', function() {
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.sidebar-nav a[href^="#"]');
            
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                if (pageYOffset >= sectionTop - 200) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('active');
                }
            });
        });

        // Logout function - redirect ke halaman utama
        function logout() {
            window.location.href = '/';
        }

        // Photo data dari server
        const photoData = JSON.parse(document.getElementById('photoData').textContent || '{}');

        // View photo function
        function viewPhoto(photoId) {
            const photo = photoData[photoId];
            if (photo) {
                document.getElementById('viewPhotoTitle').textContent = photo.judul;
                document.getElementById('viewPhotoImage').src = photo.url;
                document.getElementById('viewPhotoJudul').textContent = photo.judul;
                document.getElementById('viewPhotoDeskripsi').textContent = photo.deskripsi;
                document.getElementById('viewPhotoTanggal').textContent = new Date(photo.tanggal).toLocaleDateString('id-ID');
                
                // Store current photo ID for edit
                window.currentPhotoId = photoId;
                
                const modal = new bootstrap.Modal(document.getElementById('viewPhotoModal'));
                modal.show();
            }
        }

        // Edit photo function
        function editPhoto(photoId) {
            const photo = photoData[photoId];
            if (photo) {
                document.getElementById('editPhotoId').value = photo.id;
                document.getElementById('editPhotoJudul').value = photo.judul;
                document.getElementById('editPhotoDeskripsi').value = photo.deskripsi;
                document.getElementById('editPhotoUrl').value = photo.url;
                document.getElementById('editPhotoKategori').value = photo.kategori_id;
                document.getElementById('editPhotoGaleri').value = photo.galery_id;
                
                const modal = new bootstrap.Modal(document.getElementById('editPhotoModal'));
                modal.show();
            }
        }

        // Edit current photo from view modal
        function editCurrentPhoto() {
            if (window.currentPhotoId) {
                const viewModal = bootstrap.Modal.getInstance(document.getElementById('viewPhotoModal'));
                viewModal.hide();
                
                setTimeout(() => {
                    editPhoto(window.currentPhotoId);
                }, 300);
            }
        }

        // Delete photo function
        function deletePhoto(photoId) {
            if (confirm('Apakah Anda yakin ingin menghapus foto ini?')) {
                // Simulasi delete - dalam implementasi nyata akan ada AJAX call ke server
                const photoCard = document.querySelector(`[onclick="viewPhoto(${photoId})"]`).closest('.col-md-4');
                if (photoCard) {
                    photoCard.style.animation = 'fadeOut 0.5s ease';
                    setTimeout(() => {
                        photoCard.remove();
                        showNotification('Foto berhasil dihapus!', 'success');
                    }, 500);
                }
            }
        }

        // Handle edit form submission
        document.getElementById('editPhotoForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                id: document.getElementById('editPhotoId').value,
                judul: document.getElementById('editPhotoJudul').value,
                deskripsi: document.getElementById('editPhotoDeskripsi').value,
                url: document.getElementById('editPhotoUrl').value,
                kategori_id: document.getElementById('editPhotoKategori').value,
                galery_id: document.getElementById('editPhotoGaleri').value
            };

            // Simulasi update - dalam implementasi nyata akan ada AJAX call ke server
            if (photoData[formData.id]) {
                photoData[formData.id] = { ...photoData[formData.id], ...formData };
                
                // Update UI
                const photoCard = document.querySelector(`[onclick="viewPhoto(${formData.id})"]`).closest('.col-md-4');
                const overlay = photoCard.querySelector('.gallery-overlay');
                overlay.querySelector('h6').textContent = formData.judul;
                overlay.querySelector('p').textContent = formData.deskripsi;
                
                const img = photoCard.querySelector('img');
                img.src = formData.url;
                img.alt = formData.judul;
                
                const modal = bootstrap.Modal.getInstance(document.getElementById('editPhotoModal'));
                modal.hide();
                
                showNotification('Foto berhasil diperbarui!', 'success');
            }
        });

        // Show notification function
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
            notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
            notification.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        // Add fadeOut animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeOut {
                from { opacity: 1; transform: scale(1); }
                to { opacity: 0; transform: scale(0.8); }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
