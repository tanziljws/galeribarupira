<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Profile - {{ $user->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Navbar styling - sama seperti galeri */
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
            border-bottom: 1px solid rgba(37, 99, 235, 0.1);
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

        .navbar-nav .nav-link i {
            color: #374151 !important;
            font-size: 0.95rem;
            margin-right: 0.4rem;
        }

        .navbar-nav .nav-link:hover i {
            color: #1E40AF !important;
        }

        .navbar-nav .nav-link.active i {
            color: #1E40AF !important;
        }

        .main-content {
            margin-top: 80px;
            padding: 2rem 0;
            min-height: calc(100vh - 80px);
        }

        .profile-header {
            background: linear-gradient(135deg, #1E40AF 0%, #2563eb 100%);
            border-radius: 20px;
            padding: 2.5rem 2rem;
            color: white;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(30, 64, 175, 0.2);
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            opacity: 0.3;
        }

        .profile-avatar-container {
            position: relative;
            width: 120px;
            height: 120px;
            margin: 0 auto 1rem;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid white;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: #1E40AF;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .profile-avatar:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.25);
        }

        .profile-info {
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .profile-name {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .profile-email {
            font-size: 0.95rem;
            opacity: 0.9;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .profile-email i {
            font-size: 1rem;
        }

        .profile-bio {
            font-size: 0.95rem;
            opacity: 0.9;
            max-width: 600px;
            margin: 0 auto 1rem;
            line-height: 1.6;
            padding: 1rem 1.5rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            backdrop-filter: blur(10px);
        }

        .profile-stats {
            display: flex;
            justify-content: center;
            gap: 3rem;
            margin-top: 1.25rem;
            padding: 1rem 0;
        }

        .stat-item {
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-2px);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            display: block;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
            font-weight: 500;
        }

        .edit-profile-btn {
            background: white;
            color: #1E40AF;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .edit-profile-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            color: #1E40AF;
            background: #f8f9fa;
        }

        .tabs-container {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e5e7eb;
        }

        .nav-tabs {
            border-bottom: 2px solid #e5e7eb;
            padding: 0 2rem;
            background: #fafbfc;
        }

        .nav-tabs .nav-link {
            border: none;
            color: #6b7280;
            font-weight: 600;
            padding: 1.25rem 2rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-tabs .nav-link:hover {
            color: #1E40AF;
            border-color: transparent;
            background: rgba(30, 64, 175, 0.05);
        }

        .nav-tabs .nav-link.active {
            color: #1E40AF;
            background: white;
            border-bottom: 3px solid #1E40AF;
        }

        .nav-tabs .nav-link i {
            font-size: 1.1rem;
        }

        .tab-content {
            padding: 2.5rem;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }

        .gallery-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
            cursor: pointer;
        }

        .gallery-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
            border-color: #1E40AF;
        }

        .gallery-image {
            width: 100%;
            height: 240px;
            object-fit: cover;
            transition: all 0.3s ease;
        }

        .gallery-card:hover .gallery-image {
            transform: scale(1.05);
        }

        .gallery-info {
            padding: 1.25rem;
        }

        .gallery-title {
            font-size: 1.05rem;
            font-weight: 600;
            color: #1a202c;
            margin-bottom: 0.75rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.4;
        }

        .gallery-meta {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            font-size: 0.9rem;
            color: #6b7280;
        }

        .gallery-meta span {
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .gallery-meta i {
            font-size: 1rem;
        }

        .empty-state {
            text-align: center;
            padding: 5rem 2rem;
            color: #6b7280;
        }

        .empty-state i {
            font-size: 5rem;
            color: #d1d5db;
            margin-bottom: 1.5rem;
            opacity: 0.5;
        }

        .empty-state h3 {
            font-size: 1.75rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            color: #374151;
        }

        .empty-state p {
            font-size: 1.05rem;
            margin-bottom: 2rem;
            color: #6b7280;
        }

        .btn-explore {
            background: linear-gradient(135deg, #1E40AF 0%, #2563eb 100%);
            color: white;
            border: none;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
        }

        .btn-explore:hover {
            background: linear-gradient(135deg, #1e3a8a 0%, #1d4ed8 100%);
            transform: translateY(-2px);
            color: white;
            box-shadow: 0 8px 24px rgba(30, 64, 175, 0.4);
        }

        @media (max-width: 768px) {
            .navbar .container-fluid {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .profile-header {
                padding: 2rem 1.5rem;
            }

            .profile-avatar-container {
                width: 100px;
                height: 100px;
            }

            .profile-avatar {
                width: 100px;
                height: 100px;
                font-size: 2.5rem;
            }

            .profile-name {
                font-size: 1.5rem;
            }

            .profile-stats {
                gap: 2rem;
            }

            .stat-number {
                font-size: 1.5rem;
            }

            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 1.25rem;
            }

            .tab-content {
                padding: 1.5rem;
            }

            .nav-tabs {
                padding: 0 1rem;
            }

            .nav-tabs .nav-link {
                padding: 1rem 1.25rem;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    @include('gallery.partials.navbar')

    <div class="main-content">
        <div class="container">
            <!-- Profile Header -->
            <div class="profile-header">
                <div class="profile-avatar-container">
                    @if(isset($user->profile_photo) && !empty($user->profile_photo))
                        <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}" class="profile-avatar">
                    @else
                        <div class="profile-avatar">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <div class="profile-info">
                    <h1 class="profile-name">{{ $user->name }}</h1>
                    <p class="profile-email">
                        <i class="bi bi-envelope-fill"></i>
                        {{ $user->email }}
                    </p>
                    @if(isset($user->bio) && !empty($user->bio))
                        <p class="profile-bio">
                            <i class="bi bi-quote"></i>
                            {{ $user->bio }}
                        </p>
                    @endif
                    
                    <div class="profile-stats">
                        <div class="stat-item">
                            <span class="stat-number">{{ $likesCount }}</span>
                            <span class="stat-label">Likes</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">{{ $bookmarksCount }}</span>
                            <span class="stat-label">Bookmarks</span>
                        </div>
                    </div>

                    @if(session('user_id') == $user->id)
                        <div class="mt-3">
                            <a href="{{ route('user.profile.edit') }}" class="edit-profile-btn">
                                <i class="bi bi-pencil-square me-1"></i>Edit Profile
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Tabs -->
            <div class="tabs-container">
                <ul class="nav nav-tabs" id="profileTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="likes-tab" data-bs-toggle="tab" data-bs-target="#likes" type="button" role="tab">
                            <i class="bi bi-heart-fill me-2"></i>Liked Photos
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="bookmarks-tab" data-bs-toggle="tab" data-bs-target="#bookmarks" type="button" role="tab">
                            <i class="bi bi-bookmark-fill me-2"></i>Bookmarks
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="profileTabsContent">
                    <!-- Likes Tab -->
                    <div class="tab-pane fade show active" id="likes" role="tabpanel">
                        @if($likedPhotos->count() > 0)
                            <div class="gallery-grid">
                                @foreach($likedPhotos as $foto)
                                    <div class="gallery-card">
                                        <img src="{{ asset($foto->file_path) }}" alt="{{ $foto->judul }}" class="gallery-image">
                                        <div class="gallery-info">
                                            <h3 class="gallery-title">{{ $foto->judul }}</h3>
                                            <div class="gallery-meta">
                                                <span><i class="bi bi-heart-fill text-danger"></i> {{ $foto->total_likes ?? 0 }}</span>
                                                <span><i class="bi bi-calendar3"></i> {{ \Carbon\Carbon::parse($foto->created_at)->format('d M Y') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="bi bi-heart"></i>
                                <h3>No Liked Photos Yet</h3>
                                <p>Start exploring and like photos you love!</p>
                                <a href="{{ route('gallery.galeri') }}" class="btn-explore">Explore Gallery</a>
                            </div>
                        @endif
                    </div>

                    <!-- Bookmarks Tab -->
                    <div class="tab-pane fade" id="bookmarks" role="tabpanel">
                        @if($bookmarkedPhotos->count() > 0)
                            <div class="gallery-grid">
                                @foreach($bookmarkedPhotos as $foto)
                                    <div class="gallery-card">
                                        <img src="{{ asset($foto->file_path) }}" alt="{{ $foto->judul }}" class="gallery-image">
                                        <div class="gallery-info">
                                            <h3 class="gallery-title">{{ $foto->judul }}</h3>
                                            <div class="gallery-meta">
                                                <span><i class="bi bi-heart-fill text-danger"></i> {{ $foto->total_likes ?? 0 }}</span>
                                                <span><i class="bi bi-calendar3"></i> {{ \Carbon\Carbon::parse($foto->created_at)->format('d M Y') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="bi bi-bookmark"></i>
                                <h3>No Bookmarks Yet</h3>
                                <p>Save photos to view them later!</p>
                                <a href="{{ route('gallery.galeri') }}" class="btn-explore">Explore Gallery</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
