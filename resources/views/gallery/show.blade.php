<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Foto - SMKN 4 Bogor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }
        .photo-container {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
            max-width: 800px;
            margin: 0 auto;
        }
        .photo-image {
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            border-radius: 15px;
            margin-bottom: 1.5rem;
        }
        .photo-title {
            font-size: 2rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 1rem;
        }
        .photo-description {
            color: #666;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }
        .photo-meta {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
        }
        .btn-back {
            background: linear-gradient(135deg, #6c757d, #495057);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }
        .btn-back:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="photo-container">
            @if($foto)
                @if($foto->thumbnail_path)
                    <img src="{{ asset($foto->thumbnail_path) }}" 
                         alt="{{ $foto->judul ?? 'Foto' }}" 
                         class="photo-image">
                @else
                    <div class="photo-image d-flex align-items-center justify-content-center bg-light">
                        <i class="fas fa-image fa-5x text-muted"></i>
                    </div>
                @endif
                
                <h1 class="photo-title">{{ $foto->judul ?? 'Foto Tanpa Judul' }}</h1>
                
                @if($foto->deskripsi)
                    <p class="photo-description">{{ $foto->deskripsi }}</p>
                @endif
                
                <div class="photo-meta">
                    <p><strong>Ukuran File:</strong> {{ $foto->file_size ?? 'N/A' }} bytes</p>
                    <p><strong>Tipe File:</strong> {{ $foto->file_type ?? 'N/A' }}</p>
                    <p><strong>Tanggal Upload:</strong> {{ $foto->created_at ?? 'N/A' }}</p>
                </div>
                
                <a href="{{ route('admin.photos.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left me-2"></i>
                    Kembali ke Daftar Foto
                </a>
            @else
                <div class="text-center">
                    <h2>Foto Tidak Ditemukan</h2>
                    <p>Foto yang Anda cari tidak ditemukan atau telah dihapus.</p>
                    <a href="{{ route('admin.photos.index') }}" class="btn-back">
                        <i class="fas fa-arrow-left me-2"></i>
                        Kembali ke Daftar Foto
                    </a>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
