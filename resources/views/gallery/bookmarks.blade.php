<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Koleksi Bookmark Saya - SMKN 4 Bogor</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            min-height: 100vh;
            padding: 20px;
        }

        .container-custom {
            max-width: 1400px;
            margin: 0 auto;
        }

        .header {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
            border-radius: 16px;
            padding: 2.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(37, 99, 235, 0.15);
            color: white;
        }

        .header h1 {
            color: white;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .header p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1rem;
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stats-card {
            background: white;
            border-radius: 10px;
            padding: 1rem 1.25rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            border-left: 3px solid #2563eb;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .stats-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.12);
        }

        .stats-card .stats-icon {
            width: 45px;
            height: 45px;
            min-width: 45px;
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
        }

        .stats-info {
            flex: 1;
        }

        .stats-card h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0;
            line-height: 1.2;
        }

        .stats-card p {
            font-size: 0.8rem;
            color: #64748b;
            font-weight: 500;
            margin: 0;
            margin-top: 0.15rem;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.5rem;
        }

        .photo-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            position: relative;
            border: 1px solid #e2e8f0;
        }

        .photo-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(37, 99, 235, 0.15);
            border-color: #2563eb;
        }

        .photo-image-wrapper {
            position: relative;
            overflow: hidden;
            height: 240px;
            background: linear-gradient(135deg, #e0e7ff 0%, #dbeafe 100%);
        }

        .photo-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .photo-card:hover .photo-image {
            transform: scale(1.05);
        }

        .photo-content {
            padding: 1.25rem;
        }

        .photo-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.75rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .photo-category {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            color: #2563eb;
            padding: 0.35rem 0.85rem;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            border: 1px solid #bfdbfe;
        }
        
        .photo-category::before {
            content: '📁';
            font-size: 0.9rem;
        }

        .photo-date {
            color: #64748b;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.75rem;
            padding-top: 0.75rem;
            border-top: 1px solid #e2e8f0;
        }

        .photo-actions {
            display: flex;
            gap: 0.75rem;
            margin-top: 1rem;
        }

        .btn-action {
            flex: 1;
            padding: 0.65rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-view {
            background: #2563eb;
            color: white;
        }

        .btn-view:hover {
            background: #1e40af;
            transform: translateY(-1px);
        }

        .btn-remove {
            background: #ef4444;
            color: white;
        }

        .btn-remove:hover {
            background: #dc2626;
            transform: translateY(-1px);
        }

        .empty-state {
            background: white;
            border-radius: 16px;
            padding: 4rem 2rem;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .empty-state i {
            font-size: 4rem;
            color: #cbd5e1;
            margin-bottom: 1.5rem;
        }

        .empty-state h3 {
            color: #1e293b;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .empty-state p {
            color: #64748b;
            margin-bottom: 2rem;
            font-size: 1rem;
        }

        .btn-back {
            background: white;
            color: #2563eb;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            border: 2px solid #2563eb;
        }

        .btn-back:hover {
            background: #2563eb;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .btn-primary {
            background: #2563eb;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            border: 2px solid #2563eb;
        }

        .btn-primary:hover {
            background: #1e40af;
            border-color: #1e40af;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .bookmarked-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(255, 255, 255, 0.95);
            color: #2563eb;
            padding: 0.5rem;
            border-radius: 8px;
            font-size: 1.1rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            z-index: 10;
            backdrop-filter: blur(8px);
        }

        /* Loading Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .photo-card {
            animation: fadeInUp 0.5s ease-out;
        }

        .photo-card:nth-child(1) { animation-delay: 0.1s; }
        .photo-card:nth-child(2) { animation-delay: 0.2s; }
        .photo-card:nth-child(3) { animation-delay: 0.3s; }
        .photo-card:nth-child(4) { animation-delay: 0.4s; }
        .photo-card:nth-child(5) { animation-delay: 0.5s; }
        .photo-card:nth-child(6) { animation-delay: 0.6s; }

        /* Image Loading State */
        .photo-image {
            background: linear-gradient(90deg, #f1f5f9 25%, #e2e8f0 50%, #f1f5f9 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        .photo-image[src] {
            animation: none;
            background: none;
        }

        @media (max-width: 768px) {
            .header {
                padding: 1.5rem;
            }

            .header h1 {
                font-size: 1.5rem;
            }

            .gallery-grid {
                grid-template-columns: 1fr;
            }

            .stats-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container-custom">
        <!-- Header -->
        <div class="header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1><i class="bi bi-bookmark-heart-fill"></i>Koleksi Bookmark Saya</h1>
                    <p>Foto-foto favorit yang telah Anda simpan</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('gallery.galeri') }}" class="btn-back">
                        <i class="bi bi-arrow-left"></i>Kembali ke Galeri
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="stats-row">
            <div class="stats-card">
                <div class="stats-icon">
                    <i class="bi bi-bookmark-fill"></i>
                </div>
                <div class="stats-info">
                    <h3>{{ count($bookmarkedPhotos) }}</h3>
                    <p>Total Bookmark</p>
                </div>
            </div>
            <div class="stats-card">
                <div class="stats-icon">
                    <i class="bi bi-person-fill"></i>
                </div>
                <div class="stats-info">
                    <h3>{{ $userName }}</h3>
                    <p>Pengguna Aktif</p>
                </div>
            </div>
            <div class="stats-card">
                <div class="stats-icon">
                    <i class="bi bi-calendar-check-fill"></i>
                </div>
                <div class="stats-info">
                    <h3>{{ date('d M Y') }}</h3>
                    <p>Tanggal Hari Ini</p>
                </div>
            </div>
        </div>

        <!-- Gallery Grid -->
        @if(count($bookmarkedPhotos) > 0)
        <div class="gallery-grid">
            @foreach($bookmarkedPhotos as $foto)
            <div class="photo-card" data-foto-id="{{ $foto->id }}">
                <div class="photo-image-wrapper">
                    <div class="bookmarked-badge">
                        <i class="bi bi-bookmark-fill"></i>
                    </div>
                    <img src="{{ asset($foto->file_path) }}" alt="{{ $foto->judul }}" class="photo-image" onerror="this.src='https://via.placeholder.com/400x300?text=No+Image'">
                </div>
                <div class="photo-content">
                    <div class="photo-category">{{ $foto->kategori_nama ?? 'Umum' }}</div>
                    <h3 class="photo-title">{{ $foto->judul }}</h3>
                    <p class="photo-date">
                        <i class="bi bi-clock"></i>
                        <span>{{ \Carbon\Carbon::parse($foto->bookmarked_at)->format('d M Y, H:i') }}</span>
                    </p>
                    <div class="photo-actions">
                        <button class="btn-action btn-view" onclick="viewPhoto({{ $foto->id }})">
                            <i class="bi bi-eye"></i>Lihat
                        </button>
                        <button class="btn-action btn-remove" onclick="removeBookmark({{ $foto->id }})">
                            <i class="bi bi-trash"></i>Hapus
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-state">
            <i class="bi bi-bookmark-x"></i>
            <h3>Belum Ada Bookmark</h3>
            <p>Anda belum menyimpan foto apapun. Mulai jelajahi galeri dan simpan foto favorit Anda!</p>
            <a href="{{ route('gallery.galeri') }}" class="btn-primary">
                <i class="bi bi-images"></i>Jelajahi Galeri
            </a>
        </div>
        @endif
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // View Photo
        function viewPhoto(fotoId) {
            window.location.href = '{{ route("gallery.galeri") }}?foto=' + fotoId;
        }

        // Remove Bookmark
        function removeBookmark(fotoId) {
            Swal.fire({
                title: 'Hapus Bookmark?',
                text: 'Foto ini akan dihapus dari koleksi bookmark Anda',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b',
                confirmButtonText: '<i class="bi bi-trash me-2"></i>Ya, Hapus',
                cancelButtonText: 'Batal',
                customClass: {
                    popup: 'rounded-3',
                    confirmButton: 'rounded-2',
                    cancelButton: 'rounded-2'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Remove from UI with animation
                    const card = document.querySelector(`[data-foto-id="${fotoId}"]`);
                    if (card) {
                        card.style.transition = 'all 0.3s ease';
                        card.style.opacity = '0';
                        card.style.transform = 'scale(0.9)';
                        setTimeout(() => {
                            card.remove();
                            
                            // Check if empty
                            const remaining = document.querySelectorAll('.photo-card').length;
                            if (remaining === 0) {
                                location.reload();
                            } else {
                                // Update count
                                const countElement = document.querySelector('.stats-card h3');
                                if (countElement) {
                                    countElement.textContent = remaining;
                                }
                            }
                        }, 300);
                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Bookmark telah dihapus dari koleksi Anda',
                        timer: 2000,
                        showConfirmButton: false,
                        customClass: {
                            popup: 'rounded-3'
                        }
                    });

                    // TODO: Send request to backend to remove bookmark
                    // fetch('/api/remove-bookmark', { ... })
                }
            });
        }
    </script>
</body>
</html>
