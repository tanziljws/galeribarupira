<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - SMKN 4 Bogor</title>
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
        }
        
        .sidebar-nav a:hover,
        .sidebar-nav a.active {
            background: var(--light-blue);
            color: var(--primary-blue);
            border-radius: 8px;
        }
        
        .sidebar-nav a i {
            width: 20px;
            margin-right: 0.75rem;
            font-size: 1.1rem;
        }
        
        .main-content {
            margin-left: 280px;
            padding: 2rem;
            min-height: 100vh;
        }
        
        .page-header {
            background: var(--white);
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid #e9ecef;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }
        
        .page-title {
            color: var(--dark-gray);
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .page-subtitle {
            color: var(--light-gray);
            font-size: 1.1rem;
        }
        
        .about-content {
            background: var(--white);
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid #e9ecef;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }
        
        .about-section {
            margin-bottom: 2rem;
        }
        
        .about-section:last-child {
            margin-bottom: 0;
        }
        
        .section-title {
            color: var(--primary-blue);
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }
        
        .section-title i {
            margin-right: 0.75rem;
            font-size: 1.3rem;
        }
        
        .section-content {
            color: var(--dark-gray);
            line-height: 1.6;
            font-size: 1rem;
        }
        
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }
        
        .feature-card {
            background: var(--light-bg);
            border-radius: 8px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        
        .feature-icon {
            width: 60px;
            height: 60px;
            background: var(--primary-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: var(--white);
            font-size: 1.5rem;
        }
        
        .feature-title {
            color: var(--dark-gray);
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }
        
        .feature-description {
            color: var(--light-gray);
            font-size: 0.9rem;
            line-height: 1.5;
        }
        
        .contact-info {
            background: var(--light-bg);
            border-radius: 8px;
            padding: 1.5rem;
            margin-top: 1rem;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            color: var(--dark-gray);
        }
        
        .contact-item:last-child {
            margin-bottom: 0;
        }
        
        .contact-item i {
            width: 20px;
            margin-right: 0.75rem;
            color: var(--primary-blue);
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
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
                padding: 1rem;
            }
            
            .page-title {
                font-size: 2rem;
            }
            
            .feature-grid {
                grid-template-columns: 1fr;
            }
            
            .sidebar-toggle {
                display: block !important;
            }
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
                <i class="fas fa-graduation-cap"></i>
            </div>
            <h4>SMKN 4 Bogor</h4>
        </div>
        
        
        
        <ul class="sidebar-nav">
            <li>
                <a href="{{ route('gallery.beranda') }}">
                    <i class="fas fa-home"></i>
                    Beranda
                </a>
            </li>
            <li>
                <a href="{{ route('gallery.galeri') }}">
                    <i class="fas fa-images"></i>
                    Galeri Foto
                </a>
            </li>
            <li>
                <a href="{{ route('gallery.kategori') }}">
                    <i class="fas fa-folder"></i>
                    Kategori
                </a>
            </li>
            <li>
                <a href="{{ route('gallery.tim') }}">
                    <i class="fas fa-users"></i>
                    Tim Kami
                </a>
            </li>
            <li>
                <a href="{{ route('gallery.tentang') }}" class="active">
                    <i class="fas fa-info-circle"></i>
                    Tentang
                </a>
            </li>
            <li>
                <a href="{{ route('gallery.kontak') }}">
                    <i class="fas fa-envelope"></i>
                    Kontak
                </a>
            </li>
            <li>
                <a href="{{ route('admin.login') }}">
                    <i class="fas fa-sign-out-alt"></i>
                    Keluar
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Tentang Kami</h1>
            <p class="page-subtitle">Mengenal lebih dekat dengan SMKN 4 Bogor</p>
        </div>

        <!-- About Content -->
        <div class="about-content">
            <!-- Sekolah Section -->
            <div class="about-section">
                <h2 class="section-title">
                    <i class="fas fa-school"></i>
                    Tentang SMKN 4 Bogor
                </h2>
                <div class="section-content">
                    <p>SMKN 4 Bogor adalah sekolah menengah kejuruan yang berkomitmen untuk menghasilkan lulusan yang berkualitas dan siap memasuki dunia kerja. Dengan berbagai program keahlian yang relevan dengan kebutuhan industri, kami mempersiapkan siswa untuk menjadi tenaga kerja yang kompeten dan profesional.</p>
                    
                    <p>Didirikan dengan visi menjadi sekolah kejuruan terdepan yang menghasilkan lulusan berkualitas tinggi, SMKN 4 Bogor terus berinovasi dalam metode pembelajaran dan pengembangan kurikulum yang sesuai dengan perkembangan teknologi dan kebutuhan pasar kerja.</p>
                </div>
            </div>

            <!-- Visi Misi Section -->
            <div class="about-section">
                <h2 class="section-title">
                    <i class="fas fa-bullseye"></i>
                    Visi & Misi
                </h2>
                <div class="section-content">
                    <h4 style="color: var(--primary-blue); margin-bottom: 1rem;">Visi</h4>
                    <p>Menjadi sekolah kejuruan terdepan yang menghasilkan lulusan berkualitas tinggi, berakhlak mulia, dan siap memasuki dunia kerja global.</p>
                    
                    <h4 style="color: var(--primary-blue); margin: 1.5rem 0 1rem 0;">Misi</h4>
                    <ul style="padding-left: 1.5rem;">
                        <li>Menyelenggarakan pendidikan kejuruan yang berkualitas dan relevan dengan kebutuhan industri</li>
                        <li>Mengembangkan karakter siswa yang berakhlak mulia dan memiliki jiwa kepemimpinan</li>
                        <li>Meningkatkan kompetensi tenaga pendidik dan kependidikan secara berkelanjutan</li>
                        <li>Membangun kerjasama dengan dunia industri dan dunia kerja</li>
                        <li>Mengembangkan sarana dan prasarana yang modern dan memadai</li>
                    </ul>
                </div>
            </div>

            <!-- Program Keahlian Section -->
            <div class="about-section">
                <h2 class="section-title">
                    <i class="fas fa-graduation-cap"></i>
                    Program Keahlian
                </h2>
                <div class="section-content">
                    <p>SMKN 4 Bogor menyelenggarakan berbagai program keahlian yang dirancang untuk memenuhi kebutuhan industri dan pasar kerja:</p>
                    
                    <div class="feature-grid">
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-laptop-code"></i>
                            </div>
                            <h4 class="feature-title">Rekayasa Perangkat Lunak</h4>
                            <p class="feature-description">Mengembangkan aplikasi dan sistem informasi yang inovatif</p>
                        </div>
                        
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-network-wired"></i>
                            </div>
                            <h4 class="feature-title">Teknik Komputer dan Jaringan</h4>
                            <p class="feature-description">Mengelola infrastruktur jaringan dan sistem komputer</p>
                        </div>
                        
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <h4 class="feature-title">Multimedia</h4>
                            <p class="feature-description">Menciptakan konten digital yang kreatif dan menarik</p>
                        </div>
                        
                        <div class="feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-cogs"></i>
                            </div>
                            <h4 class="feature-title">Teknik Mesin</h4>
                            <p class="feature-description">Menguasai teknologi mesin dan otomasi industri</p>
                            </div>
                        </div>
                    </div>
                </div>

            <!-- Kontak Section -->
            <div class="about-section">
                <h2 class="section-title">
                    <i class="fas fa-map-marker-alt"></i>
                    Informasi Kontak
                </h2>
                <div class="section-content">
                    <p>Untuk informasi lebih lanjut tentang SMKN 4 Bogor, silakan hubungi kami melalui:</p>
                    
                    <div class="contact-info">
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>Jl. Raya Tajur No. 69, Bogor, Jawa Barat</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <span>(0251) 8313083</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <span>info@smkn4bogor.sch.id</span>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-globe"></i>
                            <span>www.smkn4bogor.sch.id</span>
                        </div>
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

        // Mobile sidebar toggle
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
        }
    </script>
</body>
</html>
