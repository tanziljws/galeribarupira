<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak - Pira Gallery</title>
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
        }

        body {
            background: var(--light-bg);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 280px;
            background: var(--white);
            box-shadow: 4px 0 25px rgba(0,0,0,0.1);
            z-index: 1000;
            transition: transform 0.3s ease;
            overflow-y: auto;
        }
        
        .sidebar-brand {
            padding: 2rem 1.5rem;
            text-align: center;
            border-bottom: 1px solid #e9ecef;
            margin-bottom: 1rem;
        }
        
        .sidebar-brand h4 {
            color: var(--primary-blue);
            margin: 0;
            font-weight: 700;
            font-size: 1.4rem;
        }
        
        .sidebar-brand .brand-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            color: var(--primary-blue);
        }
        
        .user-profile {
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid #e9ecef;
            margin-bottom: 1rem;
        }
        
        .user-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--primary-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
            color: var(--white);
            box-shadow: 0 4px 15px rgba(31, 111, 214, 0.3);
        }
        
        .user-info h6 {
            color: var(--dark-gray);
            margin: 0;
            font-weight: 600;
            font-size: 0.95rem;
        }
        
        .user-info p {
            color: var(--light-gray);
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
            color: var(--dark-gray);
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 0;
            margin: 0.25rem 1rem;
            font-weight: 500;
        }
        
        .sidebar-nav a:hover,
        .sidebar-nav a.active {
            background: var(--light-blue);
            color: var(--primary-blue);
            border-radius: 8px;
        }
        
        .sidebar-nav a i {
            width: 20px;
            margin-right: 12px;
            font-size: 1.1rem;
        }
        
        .sidebar-nav .nav-divider {
            height: 1px;
            background: rgba(255,255,255,0.1);
            margin: 1rem 1.5rem;
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
            background: var(--primary-blue);
            border: none;
            border-radius: 8px;
            padding: 0.75rem;
            color: white;
            box-shadow: 0 4px 15px rgba(31, 111, 214, 0.3);
            transition: all 0.3s ease;
        }
        
        .sidebar-toggle:hover {
            background: var(--secondary-blue);
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(31, 111, 214, 0.4);
        }
        
        @media (max-width: 768px) {
            .sidebar-toggle {
                display: block !important;
            }
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
        
        .section-title {
            color: var(--dark-gray);
            text-align: center;
            margin: 3rem 0 2rem 0;
            font-weight: 600;
            font-size: 2.5rem;
        }
        
        .btn-custom {
            background: var(--primary-blue);
            border: none;
            border-radius: 8px;
            padding: 12px 30px;
            color: white;
            transition: all 0.3s ease;
            font-weight: 600;
        }
        
        .btn-custom:hover {
            background: var(--secondary-blue);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(31, 111, 214, 0.3);
            color: white;
        }
    </style>
</head>
<body>
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
        
        <div class="user-profile">
            <div class="user-avatar">
                <i class="fas fa-user"></i>
            </div>
            <div class="user-info">
                <h6>Pengunjung Gallery</h6>
                <p>Selamat datang di galeri kami</p>
            </div>
        </div>
        
        <ul class="sidebar-nav">
            <li>
                <a href="{{ route('gallery.beranda') }}">
                    <i class="fas fa-home"></i>
                    <span>Beranda</span>
                </a>
            </li>
            <li>
                <a href="{{ route('gallery.galeri') }}">
                    <i class="fas fa-images"></i>
                    <span>Galeri Foto</span>
                </a>
            </li>
            <li>
                <a href="{{ route('gallery.kategori') }}">
                    <i class="fas fa-folder"></i>
                    <span>Kategori</span>
                </a>
            </li>
            <li>
                <a href="{{ route('gallery.tim') }}">
                    <i class="fas fa-users"></i>
                    <span>Tim Kami</span>
                </a>
            </li>
            <li>
                <a href="{{ route('gallery.tentang') }}">
                    <i class="fas fa-info-circle"></i>
                    <span>Tentang</span>
                </a>
            </li>
            <li>
                <a href="{{ route('gallery.kontak') }}" class="active">
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
            <!-- Contact Section -->
            <section>
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
            <footer class="text-center text-dark mt-5 py-4">
                <p>&copy; 2024 Pira Gallery. Semua hak cipta dilindungi.</p>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sidebar toggle functionality
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
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

        // Logout function
        function logout() {
            if (confirm('Apakah Anda yakin ingin keluar?')) {
                window.location.href = '/';
            }
        }
    </script>
</body>
</html>
