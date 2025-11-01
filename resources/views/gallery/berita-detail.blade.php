<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Berita - SMKN 4 Bogor</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/gallery-navbar.css') }}">
    <style>
        :root {
            --primary-blue: #1e40af;
            --secondary-blue: #1e3a8a;
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

        /* Navbar styling - sama seperti agenda */
        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(20px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 1rem 0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            height: 80px;
            border-bottom: 1px solid rgba(30, 64, 175, 0.1);
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.98) !important;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 0;
        }

        .navbar .container-fluid {
            max-width: 1400px;
            margin: 0 auto;
            padding-left: 3rem;
            padding-right: 3rem;
        }

        .navbar-brand {
            color: #1E40AF !important;
            font-weight: 700;
            font-size: 1.5rem;
            transition: all 0.3s ease;
            text-decoration: none;
            margin-right: 4rem;
        }

        .navbar-brand:hover {
            color: #1e3a8a !important;
            transform: scale(1.05);
        }

        .navbar-brand span {
            color: #1E40AF !important;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .navbar-brand img {
            height: 34px;
            width: 34px;
        }

        .navbar-nav {
            margin-left: auto !important;
            margin-right: 0 !important;
        }

        .navbar-nav .nav-link {
            color: #374151 !important;
            font-weight: 400;
            padding: 0.5rem 0.75rem;
            margin: 0 0.25rem;
            border-radius: 6px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            font-size: 0.95rem;
        }

        .navbar-nav .nav-link:hover {
            color: #1E40AF !important;
            background: transparent;
        }

        .navbar-nav .nav-link.active {
            color: #1E40AF !important;
            background: transparent;
            font-weight: 500;
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
            margin-top: 80px;
            padding: 2rem 0;
            min-height: calc(100vh - 80px);
        }
        
        .breadcrumb-section {
            max-width: 1200px;
            margin: 0 auto 2rem auto;
            padding: 0 2rem;
        }
        
        .breadcrumb {
            background: var(--white);
            border-radius: 12px;
            padding: 1rem 1.5rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            border: 1px solid var(--border-color);
        }
        
        .breadcrumb-item a {
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 500;
        }
        
        .breadcrumb-item a:hover {
            color: var(--secondary-blue);
        }
        
        .article-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        
        .article-card {
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 12px 35px rgba(0,0,0,0.12);
            border: 2px solid #e8f2ff;
            margin-bottom: 2rem;
        }
        
        .article-header {
            position: relative;
            height: 400px;
            overflow: hidden;
        }
        
        .article-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: opacity 0.3s ease;
        }
        
        .article-image.loading {
            opacity: 0.5;
        }
        
        .article-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0,0,0,0.7));
            padding: 2rem;
            color: white;
        }
        
        .article-category {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: var(--primary-blue);
            color: white;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        
        .article-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            line-height: 1.2;
        }
        
        .article-meta {
            display: flex;
            align-items: center;
            gap: 2rem;
            flex-wrap: wrap;
        }
        
        .article-author {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1rem;
            font-weight: 500;
        }
        
        .article-date {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1rem;
            color: #64748b;
        }
        
        .article-content {
            padding: 3rem;
            max-width: 100%;
            overflow-wrap: break-word;
            word-wrap: break-word;
        }
        
        .article-body {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--dark-gray);
            margin-bottom: 2rem;
            text-align: justify;
            text-justify: inter-word;
        }
        
        .article-body p {
            margin-bottom: 1.5rem;
            text-align: justify;
            text-indent: 0;
        }
        
        .article-body br {
            display: block;
            margin-bottom: 0.75rem;
            content: "";
        }
        
        .article-body h2 {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin: 2rem 0 1rem 0;
            text-align: left;
        }
        
        .article-body h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark-gray);
            margin: 1.5rem 0 1rem 0;
            text-align: left;
        }
        
        .article-body ul, .article-body ol {
            margin: 1rem 0 1.5rem 2rem;
            text-align: justify;
        }
        
        .article-body li {
            margin-bottom: 0.5rem;
            text-align: justify;
        }
        
        .article-body strong, .article-body b {
            font-weight: 600;
            color: var(--dark-gray);
        }
        
        .article-body em, .article-body i {
            font-style: italic;
        }
        
        .article-tags {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }
        
        .tag {
            padding: 0.4rem 1rem;
            background: var(--light-bg);
            color: var(--primary-blue);
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
            border: 1px solid var(--border-color);
        }
        
        .article-social {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .social-share {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .social-share:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            color: white;
        }
        
        .social-facebook { background: #1877f2; }
        .social-twitter { background: #1da1f2; }
        .social-instagram { background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); }
        .social-youtube { background: #ff0000; }
        
        .back-button {
            background: linear-gradient(135deg, #1e40af, #1e3a8a);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            margin-bottom: 2rem;
            box-shadow: 0 4px 15px rgba(30, 64, 175, 0.2);
        }
        
        .back-button:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(30, 64, 175, 0.4);
            background: linear-gradient(135deg, #1e3a8a, #1e40af);
        }
        
        .related-articles {
            background: var(--white);
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            border: 1px solid var(--border-color);
        }
        
        .related-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dark-gray);
            margin-bottom: 1.5rem;
            text-align: center;
        }
        
        .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1rem;
            justify-content: center;
        }
        
        .related-card {
            background: var(--white);
            border-radius: 15px;
            overflow: hidden;
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        
        .related-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(31, 111, 214, 0.15);
            border-color: var(--primary-blue);
        }
        
        .related-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        
        .related-content {
            padding: 1rem;
        }
        
        .related-category {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: var(--primary-blue);
            color: white;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }
        
        .related-title-card {
            font-size: 1rem;
            font-weight: 600;
            color: var(--dark-gray);
            margin-bottom: 0.5rem;
            line-height: 1.3;
            transition: color 0.3s ease;
        }
        
        .related-card:hover .related-title-card {
            color: var(--primary-blue);
        }
        
        .related-excerpt {
            font-size: 0.85rem;
            color: var(--light-gray);
            line-height: 1.4;
            margin-bottom: 0.75rem;
        }
        
        .related-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .related-date {
            font-size: 0.85rem;
            color: var(--light-gray);
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }
        
        .read-more-indicator {
            color: var(--primary-blue);
            font-size: 1rem;
            transition: transform 0.3s ease;
        }
        
        .related-card:hover .read-more-indicator {
            transform: translateX(5px);
        }
        
        /* Responsive Design */
        @media (max-width: 991px) {
            .navbar .container-fluid {
                padding-left: 1rem;
                padding-right: 1rem;
            }
            
            .breadcrumb-section {
                padding: 0 1rem;
            }
            
            .article-container {
                padding: 0 1rem;
            }
        }
        
        @media (max-width: 768px) {
            .article-title {
                font-size: 1.75rem;
                line-height: 1.3;
            }
            
            .article-content {
                padding: 1.5rem;
            }
            
            .article-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }
            
            .article-header {
                height: 250px;
            }
            
            .article-overlay {
                padding: 1.25rem;
            }
            
            .article-category {
                font-size: 0.8rem;
                padding: 0.4rem 0.8rem;
            }
            
            .article-author,
            .article-date {
                font-size: 0.9rem;
            }
            
            .article-body {
                font-size: 1rem;
                line-height: 1.7;
            }
            
            .article-body h2 {
                font-size: 1.5rem;
            }
            
            .article-body h3 {
                font-size: 1.3rem;
            }
            
            .article-body ul,
            .article-body ol {
                margin-left: 1.5rem;
            }
            
            .article-social {
                justify-content: center;
                flex-wrap: wrap;
            }
            
            .social-share {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }
            
            .back-button {
                padding: 0.75rem 1.5rem;
                font-size: 0.95rem;
                width: 100%;
                justify-content: center;
            }
            
            .related-title {
                font-size: 1.5rem;
            }
            
            .related-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
            
            .breadcrumb {
                padding: 0.75rem 1rem;
                font-size: 0.9rem;
            }
        }
        
        @media (max-width: 480px) {
            .main-content {
                padding: 1rem 0;
            }
            
            .breadcrumb-section {
                margin-bottom: 1rem;
            }
            
            .article-title {
                font-size: 1.5rem;
            }
            
            .article-content {
                padding: 1rem;
            }
            
            .article-header {
                height: 200px;
            }
            
            .article-overlay {
                padding: 1rem;
            }
            
            .article-body {
                font-size: 0.95rem;
                line-height: 1.6;
            }
            
            .article-body h2 {
                font-size: 1.3rem;
                margin: 1.5rem 0 0.75rem 0;
            }
            
            .article-body h3 {
                font-size: 1.1rem;
                margin: 1rem 0 0.5rem 0;
            }
            
            .article-body p {
                margin-bottom: 1rem;
            }
            
            .article-body ul,
            .article-body ol {
                margin-left: 1rem;
            }
            
            .article-tags {
                gap: 0.4rem;
            }
            
            .tag {
                font-size: 0.8rem;
                padding: 0.3rem 0.75rem;
            }
            
            .social-share {
                width: 38px;
                height: 38px;
                font-size: 0.9rem;
            }
            
            .back-button {
                padding: 0.65rem 1.25rem;
                font-size: 0.9rem;
                margin-bottom: 1rem;
            }
            
            .related-articles {
                padding: 1rem;
            }
            
            .related-title {
                font-size: 1.3rem;
                margin-bottom: 1rem;
            }
            
            .related-image {
                height: 180px;
            }
            
            .related-content {
                padding: 0.75rem;
            }
            
            .related-title-card {
                font-size: 0.95rem;
            }
            
            .related-excerpt {
                font-size: 0.8rem;
            }
            
            .breadcrumb {
                padding: 0.5rem 0.75rem;
                font-size: 0.85rem;
            }
            
            .breadcrumb-item {
                font-size: 0.85rem;
            }
        }
        
        /* Fix untuk text overflow di mobile */
        @media (max-width: 768px) {
            .article-body img {
                max-width: 100%;
                height: auto;
            }
            
            .article-body table {
                display: block;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            
            .article-card {
                border-radius: 15px;
            }
            
            .related-articles {
                border-radius: 15px;
            }
        }
    </style>
</head>
<body>
    @include('gallery.partials.navbar')

    <div class="main-content">
        <!-- Breadcrumb -->
        <div class="breadcrumb-section">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/"><i class="bi bi-house-door me-1"></i>Beranda</a></li>
                    <li class="breadcrumb-item"><a href="/beranda#news"><i class="bi bi-newspaper me-1"></i>Informasi</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><i class="bi bi-file-text me-1"></i>Detail Berita</li>
                </ol>
            </nav>
        </div>

        <div class="article-container">
            <a href="/beranda#news" class="back-button">
                <i class="bi bi-arrow-left"></i>
                Kembali ke Informasi
            </a>

            <div class="article-card">
                <div class="article-header">
                    @if($news->image_path)
                        <img src="{{ asset('storage/'.$news->image_path) }}" alt="{{ $news->title }}" class="article-image">
                    @else
                        <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=1000&h=600&fit=crop" alt="{{ $news->title }}" class="article-image">
                    @endif
                    <div class="article-overlay">
                        <span class="article-category">{{ ucfirst($news->jenis ?? 'Berita') }}</span>
                        <h1 class="article-title">{{ $news->title }}</h1>
                        <div class="article-meta">
                            <div class="article-author">
                                <i class="bi bi-person-circle"></i>
                                <span>{{ $news->author ?? 'Tim Humas SMKN 4 Bogor' }}</span>
                            </div>
                            <div class="article-date">
                                <i class="bi bi-calendar3"></i>
                                <span>{{ \Carbon\Carbon::parse($news->published_at ?? $news->created_at)->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="article-content">
                    @if($news->categories)
                    <div class="article-tags">
                            @php
                                $tags = array_filter(array_map('trim', explode(',', $news->categories)));
                            @endphp
                            @foreach($tags as $tag)
                                <span class="tag">{{ strtoupper($tag) }}</span>
                            @endforeach
                    </div>
                    @endif

                    <div class="article-social">
                        <a href="https://www.facebook.com/p/SMK-NEGERI-4-KOTA-BOGOR-100054636630766/?locale=id_ID" target="_blank" class="social-share social-facebook" title="Facebook SMKN 4 Bogor">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://x.com/smkn4bogor" target="_blank" class="social-share social-twitter" title="Twitter SMKN 4 Bogor">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.instagram.com/smkn4kotabogor/" target="_blank" class="social-share social-instagram" title="Instagram SMKN 4 Bogor">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://www.youtube.com/@smknegeri4bogor905" target="_blank" class="social-share social-youtube" title="YouTube SMKN 4 Bogor">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>

                    <div class="article-body">
                        @if(strip_tags($news->content) === $news->content)
                            @php
                                $formattedContent = e($news->content);
                                $formattedContent = preg_replace('/\n\s*\n/', '</p><p>', $formattedContent);
                                $formattedContent = '<p>' . $formattedContent . '</p>';
                                $formattedContent = str_replace('<p></p>', '', $formattedContent);
                            @endphp
                            {!! $formattedContent !!}
                        @else
                            {!! $news->content !!}
                        @endif
                    </div>
                </div>
            </div>

            <!-- Related Articles -->
            @if($relatedNews->count() > 0)
            <div class="related-articles">
                <h3 class="related-title">Artikel Terkait</h3>
                <div class="related-grid">
                    @foreach($relatedNews as $related)
                    <div class="related-card" onclick="openNewsDetail('{{ $related->slug }}')" title="Baca: {{ $related->title }}">
                        @if($related->image_path)
                            <img src="{{ asset('storage/'.$related->image_path) }}" alt="{{ $related->title }}" class="related-image">
                        @else
                            <img src="https://images.unsplash.com/photo-1515187029135-18ee286d815b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="{{ $related->title }}" class="related-image">
                        @endif
                        <div class="related-content">
                            <span class="related-category">{{ ucfirst($related->jenis ?? 'berita') }}</span>
                            <h4 class="related-title-card">{{ $related->title }}</h4>
                            @if($related->excerpt)
                                <p class="related-excerpt">{{ \Illuminate\Support\Str::limit($related->excerpt, 100) }}</p>
                            @endif
                            <div class="related-meta">
                                <span class="related-date">
                                    <i class="bi bi-calendar3"></i>
                                    {{ \Carbon\Carbon::parse($related->published_at ?? $related->created_at)->format('d M Y') }}
                                </span>
                                <span class="read-more-indicator">
                                    <i class="bi bi-arrow-right"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function openNewsDetail(slug) {
            // Add loading effect
            event.currentTarget.style.opacity = '0.7';
            event.currentTarget.style.transform = 'scale(0.98)';
            
            // Navigate to the article
            window.location.href = '/berita/' + slug;
        }
        
        // Add keyboard navigation support
        document.addEventListener('DOMContentLoaded', function() {
            const relatedCards = document.querySelectorAll('.related-card');
            relatedCards.forEach(card => {
                // Make cards focusable
                card.setAttribute('tabindex', '0');
                
                // Add keyboard support
                card.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        this.click();
                    }
                });
                
                // Add focus styles
                card.addEventListener('focus', function() {
                    this.style.outline = '2px solid var(--primary-blue)';
                    this.style.outlineOffset = '2px';
                });
                
                card.addEventListener('blur', function() {
                    this.style.outline = 'none';
                });
            });
        });
    </script>
</body>
</html>




















