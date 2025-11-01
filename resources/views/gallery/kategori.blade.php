<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi - SMKN 4 Bogor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/gallery-navbar.css') }}">
    <style>
        :root {
            --primary-blue: #1f6fd6;
            --secondary-blue: #0056b3;
            --light-blue: #e3f2fd;
            --dark-gray: #333333;
            --light-gray: #666666;
            --white: #ffffff;
            --light-bg: #f8f9fa;
            --accent-purple: #9c27b0;
            --accent-orange: #ff9800;
            --accent-green: #4caf50;
            --accent-pink: #e91e63;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: var(--dark-gray);
            min-height: 100vh;
        }
        
        .main-content {
            margin-top: 90px;
            padding: 2rem 0;
            min-height: calc(100vh - 90px);
        }
        
        .page-header {
            background: linear-gradient(135deg, var(--white) 0%, #f8f9fa 100%);
            border-radius: 20px;
            padding: 3rem 2rem;
            margin-bottom: 3rem;
            text-align: center;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            position: relative;
            overflow: hidden;
        }
        
        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--accent-purple), var(--accent-orange));
        }
        
        .page-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, var(--accent-purple), var(--accent-orange));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .page-subtitle {
            font-size: 1.2rem;
            color: var(--light-gray);
            font-weight: 500;
            line-height: 1.6;
        }
        
        .category-tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 3rem;
            background: var(--white);
            border-radius: 15px;
            padding: 0.5rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            flex-wrap: wrap;
        }
        
        .category-tab {
            padding: 1rem 1.5rem;
            border: none;
            background: transparent;
            color: var(--light-gray);
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.3s ease;
            cursor: pointer;
            flex: 1;
            min-width: 150px;
            margin: 0.25rem;
        }
        
        .category-tab.active {
            background: linear-gradient(135deg, var(--accent-purple), var(--accent-orange));
            color: var(--white);
            box-shadow: 0 4px 15px rgba(156, 39, 176, 0.3);
        }
        
        .category-tab:hover:not(.active) {
            background: var(--light-bg);
            color: var(--dark-gray);
        }
        
        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }
        
        .category-card {
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            transition: all 0.4s ease;
            border: none;
            position: relative;
            cursor: pointer;
        }
        
        .category-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: var(--accent-purple);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }
        
        .category-card:hover::before {
            transform: scaleX(1);
        }
        
        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
        }
        
        /* Info Grid & Cards */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }
        
        .info-card {
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            transition: all 0.4s ease;
            border: none;
            position: relative;
        }
        
        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--accent-purple), var(--accent-orange));
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }
        
        .info-card:hover::before {
            transform: scaleX(1);
        }
        
        .info-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
        }
        
        .info-header {
            background: linear-gradient(135deg, var(--accent-purple), var(--accent-orange));
            color: var(--white);
            padding: 2rem;
            text-align: center;
        }
        
        .info-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.9;
        }
        
        .info-header h4 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
        }
        
        .info-content {
            padding: 2rem;
        }
        
        .info-content p {
            margin-bottom: 0.75rem;
            color: var(--dark-gray);
            line-height: 1.6;
        }
        
        .info-content p:last-child {
            margin-bottom: 0;
        }
        
        .info-content strong {
            color: var(--primary-blue);
            font-weight: 600;
        }
        
        .category-header {
            padding: 2rem 2rem 1rem;
            text-align: center;
            position: relative;
        }
        
        .category-icon {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            display: block;
            transition: all 0.4s ease;
        }
        
        .category-card:hover .category-icon {
            transform: scale(1.1);
        }
        
        .category-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--dark-gray);
        }
        
        .category-description {
            color: var(--light-gray);
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1rem;
        }
        
        .category-stats {
            display: flex;
            align-items: center;
            justify-content: space-around;
            padding: 1.5rem 2rem;
            background: var(--light-bg);
            border-top: 1px solid #e9ecef;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-number {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--accent-purple);
            display: block;
            margin-bottom: 0.25rem;
        }
        
        .stat-label {
            font-size: 0.8rem;
            color: var(--light-gray);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .category-actions {
            padding: 1.5rem 2rem;
            text-align: center;
        }
        
        .btn-view-photos {
            background: linear-gradient(135deg, var(--accent-purple), var(--accent-orange));
            border: none;
            color: var(--white);
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-view-photos:hover {
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(156, 39, 176, 0.3);
        }
        
        .btn-back {
            background: var(--light-gray);
            border: none;
            color: var(--white);
            padding: 1rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-back:hover {
            background: var(--dark-gray);
            color: var(--white);
            transform: translateY(-2px);
        }
        
        /* Color variations for different category types */
        .category-card.ekstrakurikuler .category-icon { color: var(--accent-purple); }
        .category-card.prestasi .category-icon { color: var(--accent-orange); }
        .category-card.penghargaan .category-icon { color: var(--accent-green); }
        
        /* Tab content */
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
        
        /* Responsive design */
        @media (max-width: 768px) {
            .page-title {
                font-size: 2.5rem;
            }
            
            .category-tabs {
                flex-direction: column;
                max-width: 100%;
                margin: 0 1rem 2rem 1rem;
            }
            
            .category-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
                margin: 0 1rem 2rem 1rem;
            }
            
            .main-content {
                padding: 1rem 0;
            }
        }
        
        /* Animation for cards */
        .category-card {
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0;
            transform: translateY(30px);
        }
        
        .category-card:nth-child(1) { animation-delay: 0.1s; }
        .category-card:nth-child(2) { animation-delay: 0.2s; }
        .category-card:nth-child(3) { animation-delay: 0.3s; }
        .category-card:nth-child(4) { animation-delay: 0.4s; }
        .category-card:nth-child(5) { animation-delay: 0.5s; }
        .category-card:nth-child(6) { animation-delay: 0.6s; }
        
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    @include('gallery.partials.navbar')

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title">Informasi SMKN 4 Bogor</h1>
                <p class="page-subtitle">Informasi lengkap tentang sekolah, ekstrakurikuler, prestasi, dan berbagai kegiatan menarik</p>
            </div>
            
            <!-- Information Tabs -->
            <div class="category-tabs">
                <button class="category-tab active" onclick="showTab('ekstrakurikuler')">
                    <i class="fas fa-people me-2"></i>Ekstrakurikuler
                </button>
                <button class="category-tab" onclick="showTab('prestasi')">
                    <i class="fas fa-trophy me-2"></i>Prestasi & Penghargaan
                </button>
                <button class="category-tab" onclick="showTab('sekolah')">
                    <i class="fas fa-building me-2"></i>Profil Sekolah
                </button>
                <button class="category-tab" onclick="showTab('kontak')">
                    <i class="fas fa-phone me-2"></i>Lokasi & Kontak
                </button>
            </div>
            
            <!-- Ekstrakurikuler Tab -->
            <div id="ekstrakurikuler" class="tab-content active">
                <div class="category-grid">
                    <!-- Rohis -->
                    <div class="category-card ekstrakurikuler" onclick="viewCategoryPhotos('rohis')">
                        <div class="category-header">
                            <i class="fas fa-mosque category-icon"></i>
                            <h4 class="category-title">Rohis</h4>
                            <p class="category-description">
                                Rohani Islam yang mengembangkan spiritualitas dan keagamaan siswa melalui berbagai kegiatan keislaman.
                            </p>
                        </div>
                        <div class="category-stats">
                            <div class="stat-item">
                                <span class="stat-number">15</span>
                                <span class="stat-label">Foto</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">3</span>
                                <span class="stat-label">Album</span>
                            </div>
                        </div>
                        <div class="category-actions">
                            <a href="#" class="btn-view-photos">
                                <i class="fas fa-images"></i>
                                Lihat Foto
                            </a>
                        </div>
                    </div>
                    
                    <!-- PMR -->
                    <div class="category-card ekstrakurikuler" onclick="viewCategoryPhotos('pmr')">
                        <div class="category-header">
                            <i class="fas fa-heart category-icon"></i>
                            <h4 class="category-title">PMR</h4>
                            <p class="category-description">
                                Palang Merah Remaja yang melatih siswa dalam bidang kesehatan, pertolongan pertama, dan kemanusiaan.
                            </p>
                        </div>
                        <div class="category-stats">
                            <div class="stat-item">
                                <span class="stat-number">22</span>
                                <span class="stat-label">Foto</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">4</span>
                                <span class="stat-label">Album</span>
                            </div>
                        </div>
                        <div class="category-actions">
                            <a href="#" class="btn-view-photos">
                                <i class="fas fa-images"></i>
                                Lihat Foto
                            </a>
                        </div>
                    </div>
                    
                    <!-- Pramuka -->
                    <div class="category-card ekstrakurikuler" onclick="viewCategoryPhotos('pramuka')">
                        <div class="category-header">
                            <i class="fas fa-campground category-icon"></i>
                            <h4 class="category-title">Pramuka</h4>
                            <p class="category-description">
                                Praja Muda Karana yang membentuk karakter kepemimpinan, kedisiplinan, dan kemandirian siswa.
                            </p>
                        </div>
                        <div class="category-stats">
                            <div class="stat-item">
                                <span class="stat-number">18</span>
                                <span class="stat-label">Foto</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">5</span>
                                <span class="stat-label">Album</span>
                            </div>
                        </div>
                        <div class="category-actions">
                            <a href="#" class="btn-view-photos">
                                <i class="fas fa-images"></i>
                                Lihat Foto
                            </a>
                        </div>
                    </div>
                    
                    <!-- English Club -->
                    <div class="category-card ekstrakurikuler" onclick="viewCategoryPhotos('english-club')">
                        <div class="category-header">
                            <i class="fas fa-language category-icon"></i>
                            <h4 class="category-title">English Club</h4>
                            <p class="category-description">
                                Klub bahasa Inggris yang meningkatkan kemampuan berbahasa Inggris siswa melalui berbagai aktivitas.
                            </p>
                        </div>
                        <div class="category-stats">
                            <div class="stat-item">
                                <span class="stat-number">12</span>
                                <span class="stat-label">Foto</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">2</span>
                                <span class="stat-label">Album</span>
                            </div>
                        </div>
                        <div class="category-actions">
                            <a href="#" class="btn-view-photos">
                                <i class="fas fa-images"></i>
                                Lihat Foto
                            </a>
                        </div>
                    </div>
                    
                    <!-- Basket -->
                    <div class="category-card ekstrakurikuler" onclick="viewCategoryPhotos('basket')">
                        <div class="category-header">
                            <i class="fas fa-basketball-ball category-icon"></i>
                            <h4 class="category-title">Basket</h4>
                            <p class="category-description">
                                Tim basket sekolah yang mengembangkan bakat olahraga dan semangat sportivitas siswa.
                            </p>
                        </div>
                        <div class="category-stats">
                            <div class="stat-item">
                                <span class="stat-number">25</span>
                                <span class="stat-label">Foto</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">6</span>
                                <span class="stat-label">Album</span>
                            </div>
                        </div>
                        <div class="category-actions">
                            <a href="#" class="btn-view-photos">
                                <i class="fas fa-images"></i>
                                Lihat Foto
                            </a>
                        </div>
                    </div>
                    
                    <!-- Futsal -->
                    <div class="category-card ekstrakurikuler" onclick="viewCategoryPhotos('futsal')">
                        <div class="category-header">
                            <i class="fas fa-futbol category-icon"></i>
                            <h4 class="category-title">Futsal</h4>
                            <p class="category-description">
                                Tim futsal yang melatih keterampilan sepak bola dalam ruangan dan kerja tim yang solid.
                            </p>
                        </div>
                        <div class="category-stats">
                            <div class="stat-item">
                                <span class="stat-number">20</span>
                                <span class="stat-label">Foto</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">4</span>
                                <span class="stat-label">Album</span>
                            </div>
                        </div>
                        <div class="category-actions">
                            <a href="#" class="btn-view-photos">
                                <i class="fas fa-images"></i>
                                Lihat Foto
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Prestasi & Penghargaan Tab -->
            <div id="prestasi" class="tab-content">
                <div class="category-grid">
                    <!-- Lomba Akademik -->
                    <div class="category-card prestasi" onclick="viewCategoryPhotos('lomba-akademik')">
                        <div class="category-header">
                            <i class="fas fa-graduation-cap category-icon"></i>
                            <h4 class="category-title">Lomba Akademik</h4>
                            <p class="category-description">
                                Prestasi siswa dalam berbagai kompetisi akademik tingkat kota, provinsi, dan nasional.
                            </p>
                        </div>
                        <div class="category-stats">
                            <div class="stat-item">
                                <span class="stat-number">30</span>
                                <span class="stat-label">Foto</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">8</span>
                                <span class="stat-label">Album</span>
                            </div>
                        </div>
                        <div class="category-actions">
                            <a href="#" class="btn-view-photos">
                                <i class="fas fa-images"></i>
                                Lihat Foto
                            </a>
                        </div>
                    </div>
                    
                    <!-- Lomba Olahraga -->
                    <div class="category-card prestasi" onclick="viewCategoryPhotos('lomba-olahraga')">
                        <div class="category-header">
                            <i class="fas fa-medal category-icon"></i>
                            <h4 class="category-title">Lomba Olahraga</h4>
                            <p class="category-description">
                                Prestasi siswa dalam berbagai kompetisi olahraga dan turnamen tingkat regional dan nasional.
                            </p>
                        </div>
                        <div class="category-stats">
                            <div class="stat-item">
                                <span class="stat-number">28</span>
                                <span class="stat-label">Foto</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">7</span>
                                <span class="stat-label">Album</span>
                            </div>
                        </div>
                        <div class="category-actions">
                            <a href="#" class="btn-view-photos">
                                <i class="fas fa-images"></i>
                                Lihat Foto
                            </a>
                        </div>
                    </div>
                    
                    <!-- Lomba Seni -->
                    <div class="category-card prestasi" onclick="viewCategoryPhotos('lomba-seni')">
                        <div class="category-header">
                            <i class="fas fa-palette category-icon"></i>
                            <h4 class="category-title">Lomba Seni</h4>
                            <p class="category-description">
                                Prestasi siswa dalam berbagai kompetisi seni, musik, tari, dan kreativitas lainnya.
                            </p>
                        </div>
                        <div class="category-stats">
                            <div class="stat-item">
                                <span class="stat-number">24</span>
                                <span class="stat-label">Foto</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">5</span>
                                <span class="stat-label">Album</span>
                            </div>
                        </div>
                        <div class="category-actions">
                            <a href="#" class="btn-view-photos">
                                <i class="fas fa-images"></i>
                                Lihat Foto
                            </a>
                        </div>
                    </div>
                    
                    <!-- Penghargaan Khusus -->
                    <div class="category-card penghargaan" onclick="viewCategoryPhotos('penghargaan-khusus')">
                        <div class="category-header">
                            <i class="fas fa-award category-icon"></i>
                            <h4 class="category-title">Penghargaan Khusus</h4>
                            <p class="category-description">
                                Penghargaan dan sertifikat khusus yang diberikan kepada siswa berprestasi dan berdedikasi.
                            </p>
                        </div>
                        <div class="category-stats">
                            <div class="stat-item">
                                <span class="stat-number">16</span>
                                <span class="stat-label">Foto</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">3</span>
                                <span class="stat-label">Album</span>
                            </div>
                        </div>
                        <div class="category-actions">
                            <a href="#" class="btn-view-photos">
                                <i class="fas fa-images"></i>
                                Lihat Foto
                            </a>
                        </div>
                    </div>
                    
                    <!-- Prestasi Tim -->
                    <div class="category-card prestasi" onclick="viewCategoryPhotos('prestasi-tim')">
                        <div class="category-header">
                            <i class="fas fa-users category-icon"></i>
                            <h4 class="category-title">Prestasi Tim</h4>
                            <p class="category-description">
                                Prestasi tim sekolah dalam berbagai kompetisi tim dan kerja kelompok yang sukses.
                            </p>
                        </div>
                        <div class="category-stats">
                            <div class="stat-item">
                                <span class="stat-number">19</span>
                                <span class="stat-label">Foto</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">4</span>
                                <span class="stat-label">Album</span>
                            </div>
                        </div>
                        <div class="category-actions">
                            <a href="#" class="btn-view-photos">
                                <i class="fas fa-images"></i>
                                Lihat Foto
                            </a>
                        </div>
                    </div>
                    
                    <!-- Sertifikasi -->
                    <div class="category-card penghargaan" onclick="viewCategoryPhotos('sertifikasi')">
                        <div class="category-header">
                            <i class="fas fa-certificate category-icon"></i>
                            <h4 class="category-title">Sertifikasi</h4>
                            <p class="category-description">
                                Sertifikat keahlian dan kompetensi yang diperoleh siswa melalui program pelatihan dan uji kompetensi.
                            </p>
                        </div>
                        <div class="category-stats">
                            <div class="stat-item">
                                <span class="stat-number">14</span>
                                <span class="stat-label">Foto</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">2</span>
                                <span class="stat-label">Album</span>
                            </div>
                        </div>
                        <div class="category-actions">
                            <a href="#" class="btn-view-photos">
                                <i class="fas fa-images"></i>
                                Lihat Foto
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Profil Sekolah Tab -->
            <div id="sekolah" class="tab-content">
                <div class="info-grid">
                    <div class="info-card">
                        <div class="info-header">
                            <i class="fas fa-graduation-cap info-icon"></i>
                            <h4>Identitas Sekolah</h4>
                        </div>
                        <div class="info-content">
                            <p><strong>Nama:</strong> SMK Negeri 4 Kota Bogor (SMKN 4 Bogor)</p>
                            <p><strong>Didirikan:</strong> 15 Juni 2009</p>
                            <p><strong>SK Pendirian:</strong> No.421-45-177 Tahun 2009</p>
                            <p><strong>Status:</strong> Sekolah Negeri, Jenjang SMK</p>
                            <p><strong>Operasional:</strong> Pagi, 6 hari seminggu</p>
                        </div>
                    </div>
                    
                    <div class="info-card">
                        <div class="info-header">
                            <i class="fas fa-users info-icon"></i>
                            <h4>Data Siswa & Guru</h4>
                        </div>
                        <div class="info-content">
                            <p><strong>Total Siswa:</strong> 1,066 siswa</p>
                            <p><strong>Laki-laki:</strong> 746 siswa</p>
                            <p><strong>Perempuan:</strong> 320 siswa</p>
                            <p><strong>Guru & Staff:</strong> 45 orang</p>
                            <p><strong>Program Spesifik:</strong> 162 peserta didik</p>
                        </div>
                    </div>
                    
                    <div class="info-card">
                        <div class="info-header">
                            <i class="fas fa-award info-icon"></i>
                            <h4>Akreditasi & Prestasi</h4>
                        </div>
                        <div class="info-content">
                            <p><strong>Status Akreditasi:</strong> Terakreditasi A</p>
                            <p><strong>SK Akreditasi:</strong> No.1347/BAN-SM/SK/2021</p>
                            <p><strong>Tanggal:</strong> 8 Desember 2021</p>
                            <p><strong>Berlaku:</strong> Hingga 2026</p>
                        </div>
                    </div>
                    
                    <div class="info-card">
                        <div class="info-header">
                            <i class="fas fa-tools info-icon"></i>
                            <h4>Kompetensi Keahlian</h4>
                        </div>
                        <div class="info-content">
                            <p><strong>TKJ:</strong> Teknik Komputer dan Jaringan</p>
                            <p><strong>TKR:</strong> Teknik Kendaraan Ringan Otomotif</p>
                            <p><strong>RPL:</strong> Rekayasa Perangkat Lunak</p>
                            <p><strong>TFL:</strong> Teknik Fabrikasi Logam/Pengelasan</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Lokasi & Kontak Tab -->
            <div id="kontak" class="tab-content">
                <div class="info-grid">
                    <div class="info-card">
                        <div class="info-header">
                            <i class="fas fa-map-marker-alt info-icon"></i>
                            <h4>Lokasi & Alamat</h4>
                        </div>
                        <div class="info-content">
                            <p><strong>Alamat:</strong> Jalan Raya Tajur, Kampung Buntar, Kelurahan Muarasari, Kecamatan Bogor Selatan, Kota Bogor, Jawa Barat</p>
                            <p><strong>Kode Pos:</strong> 16137</p>
                            <p><strong>Koordinat:</strong> Bogor Selatan, Jawa Barat</p>
                        </div>
                    </div>
                    
                    <div class="info-card">
                        <div class="info-header">
                            <i class="fas fa-phone info-icon"></i>
                            <h4>Informasi Kontak</h4>
                        </div>
                        <div class="info-content">
                            <p><strong>Telepon:</strong> 0251-7547381</p>
                            <p><strong>Mobile:</strong> +62 822-6016-8886</p>
                            <p><strong>Email:</strong> smkn4@smkn4bogor.sch.id</p>
                            <p><strong>Website:</strong> smkn4bogor.sch.id</p>
                            <p><strong>Facebook:</strong> SMKN 4 Bogor Official</p>
                        </div>
                    </div>
                    
                    <div class="info-card">
                        <div class="info-header">
                            <i class="fas fa-building info-icon"></i>
                            <h4>Sarana & Prasarana</h4>
                        </div>
                        <div class="info-content">
                            <p><strong>Ruang Kelas:</strong> 30 ruang kelas modern</p>
                            <p><strong>Perpustakaan:</strong> 1 unit dengan koleksi lengkap</p>
                            <p><strong>Laboratorium:</strong> Kimia (1), Fisika (2), Bahasa (2), Komputer (1)</p>
                            <p><strong>Sanitasi:</strong> 2 ruangan untuk guru dan 2 ruangan untuk siswa</p>
                        </div>
                    </div>
                    
                    <div class="info-card">
                        <div class="info-header">
                            <i class="fas fa-handshake info-icon"></i>
                            <h4>Kerjasama Industri</h4>
                        </div>
                        <div class="info-content">
                            <p><strong>Honda:</strong> Program TKR dengan pelatihan teknisi</p>
                            <p><strong>Komatsu:</strong> Penguatan praktik keahlian</p>
                            <p><strong>Samsung:</strong> Program TKJ dengan pelatihan teknisi</p>
                            <p><strong>Axio Class Plus:</strong> Program khusus RPL</p>
                            <p><strong>Telkom Indonesia:</strong> Dalam proses penjajakan</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Back Button -->
            <div class="text-center">
                <a href="{{ route('gallery.beranda') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showTab(tabName) {
            // Hide all tab contents
            const tabContents = document.querySelectorAll('.tab-content');
            tabContents.forEach(content => {
                content.classList.remove('active');
            });
            
            // Remove active class from all tabs
            const tabs = document.querySelectorAll('.category-tab');
            tabs.forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Show selected tab content
            document.getElementById(tabName).classList.add('active');
            
            // Add active class to clicked tab
            event.target.classList.add('active');
            
            // Scroll to top of content
            window.scrollTo({
                top: document.querySelector('.main-content').offsetTop + 100,
                behavior: 'smooth'
            });
        }
        
        function viewCategoryPhotos(categoryType) {
            // Function to handle viewing photos by category type
            // This will be implemented when photos are added
            alert(`Melihat foto untuk informasi: ${categoryType}\n\nFitur ini akan tersedia setelah foto ditambahkan ke sistem.`);
            
            // Future implementation:
            // window.location.href = `/informasi/${categoryType}/photos`;
        }
        
        // Add click event listeners to all category cards
        document.addEventListener('DOMContentLoaded', function() {
            const categoryCards = document.querySelectorAll('.category-card');
            
            categoryCards.forEach(card => {
                card.addEventListener('click', function() {
                    // Add ripple effect
                    const ripple = document.createElement('div');
                    ripple.style.position = 'absolute';
                    ripple.style.borderRadius = '50%';
                    ripple.style.background = 'rgba(255, 255, 255, 0.6)';
                    ripple.style.transform = 'scale(0)';
                    ripple.style.animation = 'ripple 0.6s linear';
                    ripple.style.left = '50%';
                    ripple.style.top = '50%';
                    ripple.style.width = '100px';
                    ripple.style.height = '100px';
                    ripple.style.marginLeft = '-50px';
                    ripple.style.marginTop = '-50px';
                    
                    card.style.position = 'relative';
                    card.appendChild(ripple);
                    
                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });
        });
        
        // Add ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
