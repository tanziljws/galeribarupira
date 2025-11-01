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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f5f5f5;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            color: #333;
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

        .navbar-brand span {
            color: #1E40AF !important;
            font-size: 1.5rem;
            font-weight: 700;
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
            font-size: 0.95rem;
        }

        .navbar-nav .nav-link:hover {
            color: #1E40AF !important;
        }

        /* Main Content */
        .main-content {
            margin-top: 80px;
            min-height: calc(100vh - 80px);
        }

        /* Header with Gradient */
        .profile-header-gradient {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 25%, #2563eb 50%, #3b82f6 75%, #60a5fa 100%);
            height: 200px;
            position: relative;
            overflow: hidden;
        }

        .profile-header-gradient::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite;
        }

        .profile-header-gradient::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -5%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 10s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        /* Profile Container */
        .profile-container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            position: relative;
            margin-top: -100px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08), 0 0 0 1px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        /* Profile Header Section */
        .profile-header-section {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            padding: 2rem 2.5rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .profile-info-main {
            display: flex;
            align-items: flex-start;
            gap: 2rem;
            flex: 1;
        }

        .profile-avatar-container {
            position: relative;
        }

        .profile-avatar-large {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid white;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12), 0 0 0 1px rgba(0, 0, 0, 0.05);
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: #1E40AF;
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .profile-avatar-large:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15), 0 0 0 1px rgba(0, 0, 0, 0.05);
        }

        .profile-details {
            flex: 1;
            padding-top: 0.5rem;
        }

        .profile-name {
            font-size: 2rem;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
        }

        .profile-email {
            font-size: 0.95rem;
            color: #666;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .profile-bio {
            font-size: 0.95rem;
            color: #374151;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            max-width: 600px;
        }

        .profile-stats {
            display: flex;
            gap: 2.5rem;
        }

        .stat-item {
            display: flex;
            flex-direction: column;
        }

        .stat-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1a1a1a;
        }

        .stat-label {
            font-size: 0.85rem;
            color: #666;
            font-weight: 500;
        }

        .profile-actions {
            padding-top: 0.5rem;
        }

        .edit-profile-btn {
            padding: 0.625rem 1.5rem;
            background: linear-gradient(135deg, #1e40af 0%, #2563eb 50%, #3b82f6 100%);
            border: none;
            border-radius: 50px;
            color: white;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .edit-profile-btn:hover {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 50%, #2563eb 100%);
            color: white;
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.4);
            transform: translateY(-2px);
        }

        /* Tabs Navigation */
        .profile-tabs {
            display: flex;
            gap: 0;
            padding: 0 2.5rem;
            border-bottom: 1px solid #e5e7eb;
            background: #fafafa;
        }

        .profile-tab-link {
            padding: 1rem 1.5rem;
            color: #666;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            border-bottom: 3px solid transparent;
            white-space: nowrap;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            position: relative;
        }

        .profile-tab-link:hover {
            color: #1a1a1a;
            background: rgba(102, 126, 234, 0.05);
        }

        .profile-tab-link.active {
            color: #1a1a1a;
            border-bottom-color: #667eea;
            background: white;
            font-weight: 600;
        }

        .profile-tab-link.active::before {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, #1e40af 0%, #2563eb 50%, #3b82f6 100%);
            border-radius: 3px 3px 0 0;
        }

        /* Tab Content */
        .profile-tab-content {
            padding: 2.5rem;
        }

        .tab-pane {
            display: none;
        }

        .tab-pane.active {
            display: block;
        }

        /* Gallery Grid */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .gallery-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
            cursor: pointer;
            position: relative;
        }

        .gallery-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 28px rgba(102, 126, 234, 0.15);
            border-color: #667eea;
        }

        .gallery-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
            transition: all 0.3s ease;
        }

        .gallery-card:hover .gallery-image {
            transform: scale(1.05);
        }

        .gallery-info {
            padding: 1rem;
        }

        .remove-bookmark-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(255, 255, 255, 0.95);
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            z-index: 10;
            opacity: 0;
        }

        .gallery-card:hover .remove-bookmark-btn {
            opacity: 1;
        }

        .remove-bookmark-btn:hover {
            background: #ef4444;
            transform: scale(1.1);
        }

        .remove-bookmark-btn i {
            color: #ef4444;
            font-size: 1.1rem;
        }

        .remove-bookmark-btn:hover i {
            color: white;
        }

        .gallery-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.4;
        }

        .gallery-meta {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 0.85rem;
            color: #6b7280;
        }

        .gallery-meta span {
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #6b7280;
        }

        .empty-state i {
            font-size: 4rem;
            color: #d1d5db;
            margin-bottom: 1.5rem;
            opacity: 0.5;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #374151;
        }

        .empty-state p {
            font-size: 1rem;
            margin-bottom: 1.5rem;
            color: #6b7280;
        }

        .btn-explore {
            padding: 0.75rem 2rem;
            background: linear-gradient(135deg, #1e40af 0%, #2563eb 50%, #3b82f6 100%);
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .btn-explore:hover {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 50%, #2563eb 100%);
            color: white;
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.4);
            transform: translateY(-2px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar .container-fluid {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .profile-container {
                margin-top: -60px;
                border-radius: 0;
            }

            .profile-header-section {
                flex-direction: column;
                padding: 1.5rem;
            }

            .profile-info-main {
                flex-direction: column;
                align-items: center;
                text-align: center;
                width: 100%;
            }

            .profile-avatar-large {
                width: 100px;
                height: 100px;
                font-size: 2.5rem;
            }

            .profile-details {
                width: 100%;
            }

            .profile-stats {
                justify-content: center;
            }

            .profile-tabs {
                padding: 0 1rem;
                overflow-x: auto;
            }

            .profile-tab-content {
                padding: 1.5rem;
            }

            .gallery-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    @include('gallery.partials.navbar')

    <div class="main-content">
        <!-- Gradient Header -->
        <div class="profile-header-gradient"></div>

        <!-- Profile Container -->
        <div class="profile-container">
            <!-- Profile Header Section -->
            <div class="profile-header-section">
                <div class="profile-info-main">
                    <div class="profile-avatar-container">
                        @if(isset($user->profile_photo) && !empty($user->profile_photo))
                            <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}" class="profile-avatar-large">
                        @else
                            <div class="profile-avatar-large">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <div class="profile-details">
                        <h1 class="profile-name">{{ $user->name }}</h1>
                        <p class="profile-email">
                            <i class="bi bi-envelope"></i>
                            {{ $user->email }}
                        </p>
                        @if(isset($user->bio) && !empty($user->bio))
                            <p class="profile-bio">{{ $user->bio }}</p>
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
                    </div>
                </div>
                @if(session('user_id') == $user->id)
                    <div class="profile-actions">
                        <a href="{{ route('user.profile.edit') }}" class="edit-profile-btn">
                            <i class="bi bi-pencil me-1"></i>Edit Profile
                        </a>
                    </div>
                @endif
            </div>

            <!-- Tabs Navigation -->
            <div class="profile-tabs">
                <a href="#" class="profile-tab-link active" data-tab="likes">
                    <i class="bi bi-heart-fill"></i>
                    Liked Photos
                </a>
                <a href="#" class="profile-tab-link" data-tab="bookmarks">
                    <i class="bi bi-bookmark-fill"></i>
                    Bookmarks
                </a>
            </div>

            <!-- Tab Content -->
            <div class="profile-tab-content">
                <!-- Likes Tab -->
                <div class="tab-pane active" id="likes">
                    @if($likedPhotos->count() > 0)
                        <div class="gallery-grid">
                            @foreach($likedPhotos as $foto)
                                <div class="gallery-card" data-foto-id="{{ $foto->id }}">
                                    @if(file_exists(public_path($foto->file_path)))
                                        <img src="{{ asset($foto->file_path) }}" alt="{{ $foto->judul }}" class="gallery-image" onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
                                    @else
                                        <img src="{{ asset('storage/' . $foto->file_path) }}" alt="{{ $foto->judul }}" class="gallery-image" onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
                                    @endif
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
                <div class="tab-pane" id="bookmarks">
                    @if($bookmarkedPhotos->count() > 0)
                        <div class="gallery-grid">
                            @foreach($bookmarkedPhotos as $foto)
                                <div class="gallery-card" data-foto-id="{{ $foto->id }}">
                                    @if(file_exists(public_path($foto->file_path)))
                                        <img src="{{ asset($foto->file_path) }}" alt="{{ $foto->judul }}" class="gallery-image" onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
                                    @else
                                        <img src="{{ asset('storage/' . $foto->file_path) }}" alt="{{ $foto->judul }}" class="gallery-image" onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
                                    @endif
                                    <button class="remove-bookmark-btn" onclick="removeBookmark({{ $foto->id }}, event)" title="Hapus Bookmark">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Function to switch tabs
        function switchTab(tabId) {
            // Remove active class from all tabs and panes
            document.querySelectorAll('.profile-tab-link').forEach(t => t.classList.remove('active'));
            document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));
            
            // Add active class to selected tab
            const tabLink = document.querySelector(`.profile-tab-link[data-tab="${tabId}"]`);
            if (tabLink) {
                tabLink.classList.add('active');
            }
            
            // Show corresponding pane
            const tabPane = document.getElementById(tabId);
            if (tabPane) {
                tabPane.classList.add('active');
            }
        }
        
        // Tab Switching on click
        document.querySelectorAll('.profile-tab-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const tabId = this.getAttribute('data-tab');
                switchTab(tabId);
                // Update URL hash
                window.location.hash = tabId;
            });
        });
        
        // Check for hash on page load
        window.addEventListener('DOMContentLoaded', function() {
            const hash = window.location.hash.substring(1); // Remove #
            if (hash && (hash === 'likes' || hash === 'bookmarks')) {
                switchTab(hash);
            }
        });

        // Function to remove bookmark
        function removeBookmark(fotoId, event) {
            event.stopPropagation();
            
            Swal.fire({
                title: 'Hapus Bookmark?',
                text: 'Foto akan dihapus dari koleksi bookmark Anda',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Remove bookmark via API
                    fetch('/api/track-activity', {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            foto_id: fotoId,
                            activity_type: 'bookmark'
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Remove card from DOM
                        const card = document.querySelector(`.gallery-card[data-foto-id="${fotoId}"]`);
                        if (card) {
                            card.style.transition = 'all 0.3s ease';
                            card.style.opacity = '0';
                            card.style.transform = 'scale(0.8)';
                            
                            setTimeout(() => {
                                card.remove();
                                
                                // Update bookmark count
                                const bookmarkCount = document.querySelector('.stat-item:nth-child(2) .stat-number');
                                if (bookmarkCount) {
                                    const currentCount = parseInt(bookmarkCount.textContent);
                                    bookmarkCount.textContent = currentCount - 1;
                                }
                                
                                // Check if no more bookmarks
                                const remainingCards = document.querySelectorAll('#bookmarks .gallery-card');
                                if (remainingCards.length === 0) {
                                    location.reload();
                                }
                            }, 300);
                        }
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'Bookmark Dihapus!',
                            text: 'Foto berhasil dihapus dari bookmark',
                            timer: 2000,
                            showConfirmButton: false,
                            toast: true,
                            position: 'top-end'
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat menghapus bookmark',
                            confirmButtonColor: '#ef4444'
                        });
                    });
                }
            });
        }
    </script>
</body>
</html>
