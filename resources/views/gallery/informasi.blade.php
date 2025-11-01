<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita & Pengumuman - SMKN 4 Bogor</title>
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
            --accent-orange: #ff6b35;
            --accent-green: #4caf50;
            --accent-purple: #9c27b0;
            --accent-red: #f44336;
            --accent-yellow: #ff9800;
            --accent-teal: #009688;
            --border-color: #e5e7eb;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: var(--dark-gray);
            min-height: 100vh;
            scroll-behavior: smooth;
        }
        
        .main-content {
            margin-top: 100px;
            padding: 2rem 0;
            min-height: calc(100vh - 100px);
        }
        
        .page-header {
            background: linear-gradient(135deg, #1f6fd6 0%, #0056b3 100%);
            border-radius: 20px;
            padding: 3rem 2rem;
            margin-bottom: 3rem;
            text-align: center;
            box-shadow: 0 8px 25px rgba(31, 111, 214, 0.2);
            position: relative;
            overflow: hidden;
            margin-left: auto;
            margin-right: auto;
            max-width: 1400px;
        }
        
        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #ffffff, #e3f2fd);
            border-radius: 20px 20px 0 0;
        }

        .page-title {
            font-size: 2.8rem;
            font-weight: 700;
            margin-bottom: 0.8rem;
            color: #ffffff;
            letter-spacing: -0.01em;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .page-subtitle {
            color: #e3f2fd;
            font-size: 1.1rem;
            margin-bottom: 0;
            font-weight: 400;
            line-height: 1.5;
            opacity: 0.9;
        }
        
        .news-section {
            margin-bottom: 3rem;
            max-width: 1400px;
            margin-left: auto;
            margin-right: auto;
            padding: 0 2rem;
        }
        
        .news-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin-bottom: 3rem;
        }
        
        .news-card {
            background: linear-gradient(180deg, #ffffff 0%, #f9fbff 100%);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 12px 35px rgba(0,0,0,0.12);
            transition: all 0.4s ease;
            border: 2px solid #e8f2ff;
            position: relative;
            cursor: pointer;
            min-height: 500px;
            display: flex;
            flex-direction: column;
        }
        
        .news-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #1f6fd6, #8b5cf6);
            border-radius: 24px 24px 0 0;
        }
        
        .news-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(31, 111, 214, 0.15);
        }
        
        .news-image {
            position: relative;
            width: 100%;
            height: 200px;
            overflow: hidden;
        }
        
        .news-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }
        
        .news-card:hover .news-image img {
            transform: scale(1.05);
        }
        
        .news-logo {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: #1f6fd6;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .news-content {
            padding: 1.8rem 1.8rem 1.8rem 1.8rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .news-title {
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #334155;
            line-height: 1.3;
        }
        
        .news-description {
            color: #64748b;
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            flex: 1;
        }
        
        .news-meta {
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
            padding: 1.5rem 1.8rem;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            margin-top: auto;
        }
        
        .news-tag {
            padding: 0.4rem 1rem;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            align-self: flex-start;
            background: linear-gradient(135deg, #1f6fd6, #0056b3);
            color: white;
        }
        
        .news-date {
            font-size: 0.9rem;
            color: #64748b;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .news-date::before {
            content: "📅";
            font-size: 1rem;
        }
        
        .read-more-btn {
            background: linear-gradient(135deg, #1f6fd6, #0056b3);
            border: none;
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1rem;
            align-self: flex-start;
        }
        
        .read-more-btn:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(31, 111, 214, 0.3);
        }
        
        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--dark-gray);
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-blue), var(--accent-purple));
            border-radius: 2px;
        }
        
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
            border: 1px solid var(--border-color);
            position: relative;
        }
        
        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-blue), var(--accent-purple));
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
            background: linear-gradient(135deg, var(--primary-blue), var(--accent-purple));
            color: var(--white);
            padding: 2rem;
            text-align: center;
        }
        
        .info-header h3 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
        }
        
        .info-body {
            padding: 2rem;
        }
        
        .info-body p {
            color: var(--light-gray);
            line-height: 1.6;
            margin-bottom: 1rem;
        }
        
        .info-body ul {
            color: var(--light-gray);
            line-height: 1.6;
            padding-left: 1.5rem;
        }
        
        .info-body li {
            margin-bottom: 0.5rem;
        }
        
        .stats-section {
            background: var(--white);
            border-radius: 20px;
            padding: 3rem 2rem;
            margin-bottom: 3rem;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            border: 1px solid var(--border-color);
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
        }
        
        .stat-item {
            text-align: center;
            padding: 1.5rem;
            background: var(--light-bg);
            border-radius: 15px;
            border: 1px solid var(--border-color);
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary-blue);
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: var(--light-gray);
            font-weight: 600;
            font-size: 1rem;
        }
        
        .contact-section {
            background: linear-gradient(135deg, var(--light-blue) 0%, #f0f9ff 100%);
            border-radius: 20px;
            padding: 3rem 2rem;
            margin-bottom: 3rem;
            border: 1px solid var(--border-color);
        }
        
        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            padding: 1.5rem;
            background: var(--white);
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            border: 1px solid var(--border-color);
        }
        
        .contact-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-blue), var(--accent-purple));
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1.5rem;
            color: var(--white);
            font-size: 1.5rem;
        }
        
        .contact-info h5 {
            margin: 0 0 0.5rem 0;
            color: var(--dark-gray);
            font-weight: 600;
        }
        
        .contact-info p {
            margin: 0;
            color: var(--light-gray);
        }
        
        .jurusan-section {
            background: var(--white);
            border-radius: 20px;
            padding: 3rem 2rem;
            margin-bottom: 3rem;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            border: 1px solid var(--border-color);
        }
        
        .jurusan-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }
        
        .jurusan-card {
            text-align: center;
            padding: 2rem 1.5rem;
            background: var(--light-bg);
            border-radius: 15px;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }
        
        .jurusan-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }
        
        .jurusan-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        
        .jurusan-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--dark-gray);
            margin-bottom: 1rem;
        }
        
        .jurusan-desc {
            color: var(--light-gray);
            line-height: 1.6;
        }

        /* Quote / Headmaster Section */
        .quote-section {
            background: var(--white);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            border: 1px solid var(--border-color);
            display: grid;
            grid-template-columns: 90px 1fr;
            gap: 1rem;
            align-items: center;
            margin-bottom: 3rem;
        }
        .quote-avatar {
            width: 90px; height: 90px; border-radius: 50%; background: linear-gradient(135deg, var(--primary-blue), var(--accent-purple)); color: #fff; display:flex; align-items:center; justify-content:center; font-size: 2rem;
        }
        .quote-content h5 { margin: 0 0 .5rem 0; color: var(--dark-gray); font-weight: 700; }
        .quote-content p { margin: 0; color: var(--light-gray); }

        /* Timeline */
        .timeline-section { background: var(--white); border-radius: 20px; padding: 2rem; border:1px solid var(--border-color); box-shadow:0 8px 30px rgba(0,0,0,.08); margin-bottom:3rem; }
        .timeline { position: relative; padding-left: 1.5rem; }
        .timeline::before { content: ''; position: absolute; left: 8px; top: 0; bottom: 0; width: 2px; background: linear-gradient(180deg, var(--primary-blue), var(--accent-purple)); border-radius: 2px; }
        .timeline-item { position: relative; padding-left: 1rem; margin-bottom: 1.25rem; }
        .timeline-item::before { content: ''; position: absolute; left: -2px; top: 4px; width: 12px; height: 12px; border-radius: 50%; background: var(--primary-blue); box-shadow: 0 0 0 4px rgba(31,111,214,.15); }
        .timeline-year { font-weight: 800; color: var(--primary-blue); margin-right: .5rem; }
        .timeline-text { color: var(--light-gray); }

        /* Partners */
        .partners-strip { display:grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap:1rem; align-items:center; margin-bottom:3rem; }
        .partner-card { background:#fff; border:1px solid var(--border-color); border-radius:14px; height:70px; display:flex; align-items:center; justify-content:center; box-shadow:0 6px 20px rgba(0,0,0,.06); }
        .partner-card img { max-height: 42px; object-fit: contain; filter: grayscale(15%); }

        /* FAQ */
        .faq-section { background: var(--white); border:1px solid var(--border-color); border-radius: 20px; padding: 2rem; box-shadow: 0 8px 30px rgba(0,0,0,.08); margin-bottom:3rem; }
        .accordion-button { font-weight:600; }
 
        /* Responsive design */
        @media (max-width: 1024px) {
            .news-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem;
                padding: 0 1rem;
            }
        }

        @media (max-width: 768px) {
            .page-title { 
                font-size: 2.2rem; 
            }
            
            .page-header {
                padding: 2.5rem 1.5rem;
                margin-bottom: 2.5rem;
            }
            
            .news-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
                padding: 0 1rem;
            }
            
            .news-card {
                min-height: 400px;
            }
            
            .news-content {
                padding: 1.5rem;
            }
            
            .news-meta {
                padding: 1.2rem 1.5rem;
            }
            
            .section-title { font-size: 2rem; }
            .info-grid { grid-template-columns: 1fr; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .contact-grid { grid-template-columns: 1fr; }
            .jurusan-grid { grid-template-columns: repeat(2, 1fr); }
        }
        
        @media (max-width: 480px) {
            .page-title {
                font-size: 1.8rem;
            }
            
            .page-header {
                padding: 2rem 1rem;
                margin-bottom: 2rem;
            }
            
            .news-grid {
                padding: 0 0.5rem;
            }
            
            .news-card {
                min-height: 350px;
            }
            
            .news-content {
                padding: 1.2rem;
            }
            
            .news-meta {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    @include('gallery.partials.navbar')

    <div class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">Berita & Pengumuman</h1>
            <p class="page-subtitle">Informasi terbaru dan pengumuman penting dari SMKN 4 Bogor</p>
        </div>

        <!-- Berita & Pengumuman Section -->
        <div class="news-section">
            <div class="news-grid">
                <!-- DIGI Goes to School -->
                <div class="news-card" onclick="openNewsDetail('digi-goes-to-school')">
                    <div class="news-image">
                        @php
                            $img = null;
                            foreach ([
                                'images/berita/digi-goes-to-school.jpg',
                                'images/berita/digi-goes-to-school.png',
                                'images/berita/digi-goes-to-school.webp'
                            ] as $candidate) { if (file_exists(public_path($candidate))) { $img = asset($candidate); break; } }
                        @endphp
                        <img src="{{ $img ?? 'https://images.unsplash.com/photo-1555421689-43cad7100751?w=1200&h=700&fit=crop' }}" alt="DIGI Goes to School">
                        <div class="news-logo"><i class="bi bi-phone"></i></div>
                    </div>
                    <div class="news-content">
                        <h3 class="news-title"><a href="{{ url('/berita/digi-goes-to-school') }}" class="stretched-link text-decoration-none text-reset">Program “DIGI Goes to School” dari bank bjb hadir di sekolah</a></h3>
                        <p class="news-description">Pada 5 September 2025, program edukasi digital DIGI Goes to School yang diinisiasi oleh bank bjb disambut antusias di SMKN 4 Bogor. Program ini mendukung era cashless society dan memperkuat literasi finansial digital siswa.</p>
                    </div>
                    <div class="news-meta">
                        <span class="news-tag">Berita</span>
                        <span class="news-date">5 September 2025</span>
                        <div class="d-flex gap-2 mt-2">
                            <a class="btn btn-sm btn-light border" href="https://facebook.com/sharer/sharer.php?u={{ urlencode(url('/berita/digi-goes-to-school')) }}" target="_blank"><i class="bi bi-facebook"></i></a>
                            <a class="btn btn-sm btn-light border" href="https://www.instagram.com/" target="_blank"><i class="bi bi-instagram"></i></a>
                            <a class="btn btn-sm btn-light border" href="https://twitter.com/intent/tweet?url={{ urlencode(url('/berita/digi-goes-to-school')) }}" target="_blank"><i class="bi bi-twitter"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Informasi PPDB 2025/2026 -->
                <div class="news-card" onclick="openNewsDetail('informasi-ppdb-2025')">
                    <div class="news-image">
                        @php
                            $img = null;
                            foreach ([
                                'images/berita/informasi-ppdb-2025.jpg',
                                'images/berita/informasi-ppdb-2025.png',
                                'images/berita/informasi-ppdb-2025.webp'
                            ] as $candidate) { if (file_exists(public_path($candidate))) { $img = asset($candidate); break; } }
                        @endphp
                        <img src="{{ $img ?? 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=1200&h=700&fit=crop' }}" alt="Informasi PPDB 2025/2026">
                        <div class="news-logo"><i class="bi bi-megaphone"></i></div>
                    </div>
                    <div class="news-content">
                        <h3 class="news-title"><a href="{{ url('/berita/informasi-ppdb-2025') }}" class="stretched-link text-decoration-none text-reset">Informasi PPDB untuk Tahun Ajaran 2025/2026</a></h3>
                        <p class="news-description">Informasi penerimaan siswa baru (PPDB) tahun 2025/2026 untuk SMKN 4 Bogor meningkat ke publik sekitar tanggal 27 Februari 2025. Pantau terus informasi resmi sekolah.</p>
                    </div>
                    <div class="news-meta">
                        <span class="news-tag">Pengumuman</span>
                        <span class="news-date">27 Februari 2025</span>
                        <div class="d-flex gap-2 mt-2">
                            <a class="btn btn-sm btn-light border" href="https://facebook.com/sharer/sharer.php?u={{ urlencode(url('/berita/informasi-ppdb-2025')) }}" target="_blank"><i class="bi bi-facebook"></i></a>
                            <a class="btn btn-sm btn-light border" href="https://www.instagram.com/" target="_blank"><i class="bi bi-instagram"></i></a>
                            <a class="btn btn-sm btn-light border" href="https://twitter.com/intent/tweet?url={{ urlencode(url('/berita/informasi-ppdb-2025')) }}" target="_blank"><i class="bi bi-twitter"></i></a>
                        </div>
                    </div>
                </div>

                <!-- BPJS Ketenagakerjaan PKL -->
                <div class="news-card" onclick="openNewsDetail('bpjs-ketenagakerjaan-pkl')">
                    <div class="news-image">
                        @php
                            $img = null;
                            foreach ([
                                'images/berita/bpjs-ketenagakerjaan-pkl.jpg',
                                'images/berita/bpjs-ketenagakerjaan-pkl.png',
                                'images/berita/bpjs-ketenagakerjaan-pkl.webp'
                            ] as $candidate) { if (file_exists(public_path($candidate))) { $img = asset($candidate); break; } }
                        @endphp
                        <img src="{{ $img ?? 'https://images.unsplash.com/photo-1554224155-1696413565d3?w=1200&h=700&fit=crop' }}" alt="BPJS Ketenagakerjaan PKL">
                        <div class="news-logo"><i class="bi bi-shield-check"></i></div>
                    </div>
                    <div class="news-content">
                        <h3 class="news-title"><a href="{{ url('/berita/bpjs-ketenagakerjaan-pkl') }}" class="stretched-link text-decoration-none text-reset">SMKN 4 Kota Bogor Lindungi Siswa PKLnya Melalui Program BPJS Ketenagakerjaan</a></h3>
                        <p class="news-description">SMKN 4 Bogor berkomitmen melindungi keselamatan dan kesejahteraan siswa yang menjalani PKL melalui program BPJS Ketenagakerjaan bersama mitra industri.</p>
                    </div>
                    <div class="news-meta">
                        <span class="news-tag">Berita</span>
                        <span class="news-date">15 Oktober 2025</span>
                        <div class="d-flex gap-2 mt-2">
                            <a class="btn btn-sm btn-light border" href="https://facebook.com/sharer/sharer.php?u={{ urlencode(url('/berita/bpjs-ketenagakerjaan-pkl')) }}" target="_blank"><i class="bi bi-facebook"></i></a>
                            <a class="btn btn-sm btn-light border" href="https://www.instagram.com/" target="_blank"><i class="bi bi-instagram"></i></a>
                            <a class="btn btn-sm btn-light border" href="https://twitter.com/intent/tweet?url={{ urlencode(url('/berita/bpjs-ketenagakerjaan-pkl')) }}" target="_blank"><i class="bi bi-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function openNewsDetail(newsId) {
            window.location.href = '/berita/' + newsId;
        }

        // Smooth scrolling untuk navbar
        document.addEventListener('DOMContentLoaded', function() {
            // Add smooth scrolling to all links
            const links = document.querySelectorAll('a[href^="#"]');
            
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const targetId = this.getAttribute('href');
                    const targetSection = document.querySelector(targetId);
                    
                    if (targetSection) {
                        targetSection.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Add scroll effect to navbar
            window.addEventListener('scroll', function() {
                const navbar = document.querySelector('.navbar');
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });
        });
    </script>
</body>
</html>
