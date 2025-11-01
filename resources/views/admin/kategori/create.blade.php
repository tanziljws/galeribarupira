<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .main-content {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            margin-top: 2rem;
        }
        
        .btn-custom {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            border-radius: 15px;
            padding: 12px 30px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            color: white;
        }
        
        .form-control, .form-select {
            border-radius: 12px;
            border: 2px solid rgba(0,0,0,0.1);
            padding: 12px 16px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .card {
            border-radius: 20px;
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .card-header {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border-radius: 20px 20px 0 0 !important;
            border: none;
            padding: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="main-content">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h2 class="fw-bold mb-1">
                                <i class="fas fa-plus me-2"></i>Tambah Kategori Baru
                            </h2>
                            <p class="text-muted mb-0">Buat kategori baru untuk mengorganisir foto-foto Anda</p>
                        </div>
                        <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-folder me-2"></i>Informasi Kategori
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('admin.kategori.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="nama" class="form-label fw-bold">
                                                <i class="fas fa-tag me-1"></i>Nama Kategori
                                            </label>
                                            <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                                   id="nama" name="nama" value="{{ old('nama') }}" 
                                                   required placeholder="Contoh: Landscape, Portrait, Street">
                                            @error('nama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="deskripsi" class="form-label fw-bold">
                                                <i class="fas fa-align-left me-1"></i>Deskripsi
                                            </label>
                                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                                      id="deskripsi" name="deskripsi" rows="4" 
                                                      placeholder="Jelaskan kategori ini...">{{ old('deskripsi') }}</textarea>
                                            @error('deskripsi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="icon" class="form-label fw-bold">
                                                <i class="fas fa-icons me-1"></i>Icon
                                            </label>
                                            <select class="form-select @error('icon') is-invalid @enderror" 
                                                    id="icon" name="icon">
                                                <option value="fas fa-folder" {{ old('icon') == 'fas fa-folder' ? 'selected' : '' }}>📁 Folder</option>
                                                <option value="fas fa-camera" {{ old('icon') == 'fas fa-camera' ? 'selected' : '' }}>📷 Camera</option>
                                                <option value="fas fa-image" {{ old('icon') == 'fas fa-image' ? 'selected' : '' }}>🖼️ Image</option>
                                                <option value="fas fa-palette" {{ old('icon') == 'fas fa-palette' ? 'selected' : '' }}>🎨 Palette</option>
                                                <option value="fas fa-star" {{ old('icon') == 'fas fa-star' ? 'selected' : '' }}>⭐ Star</option>
                                                <option value="fas fa-heart" {{ old('icon') == 'fas fa-heart' ? 'selected' : '' }}>❤️ Heart</option>
                                                <option value="fas fa-mountain" {{ old('icon') == 'fas fa-mountain' ? 'selected' : '' }}>🏔️ Mountain</option>
                                                <option value="fas fa-tree" {{ old('icon') == 'fas fa-tree' ? 'selected' : '' }}>🌳 Tree</option>
                                                <option value="fas fa-water" {{ old('icon') == 'fas fa-water' ? 'selected' : '' }}>💧 Water</option>
                                                <option value="fas fa-city" {{ old('icon') == 'fas fa-city' ? 'selected' : '' }}>🏙️ City</option>
                                                <option value="fas fa-car" {{ old('icon') == 'fas fa-car' ? 'selected' : '' }}>🚗 Car</option>
                                                <option value="fas fa-plane" {{ old('icon') == 'fas fa-plane' ? 'selected' : '' }}>✈️ Plane</option>
                                            </select>
                                            @error('icon')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="color" class="form-label fw-bold">
                                                <i class="fas fa-palette me-1"></i>Warna
                                            </label>
                                            <input type="color" class="form-control form-control-color @error('color') is-invalid @enderror" 
                                                   id="color" name="color" value="{{ old('color', '#667eea') }}" 
                                                   style="height: 50px; width: 100%;">
                                            @error('color')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">
                                                <i class="fas fa-eye me-1"></i>Preview
                                            </label>
                                            <div class="border rounded p-3 text-center" id="preview">
                                                <i class="fas fa-folder fa-2x mb-2" id="previewIcon"></i>
                                                <div class="fw-bold" id="previewName">Nama Kategori</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-end gap-2 mt-4">
                                    <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times me-2"></i>Batal
                                    </a>
                                    <button type="submit" class="btn btn-custom">
                                        <i class="fas fa-save me-2"></i>Simpan Kategori
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Preview functionality
        document.getElementById('nama').addEventListener('input', function() {
            document.getElementById('previewName').textContent = this.value || 'Nama Kategori';
        });
        
        document.getElementById('icon').addEventListener('change', function() {
            document.getElementById('previewIcon').className = this.value + ' fa-2x mb-2';
        });
        
        document.getElementById('color').addEventListener('change', function() {
            document.getElementById('previewIcon').style.color = this.value;
        });
        
        // Initialize preview
        document.addEventListener('DOMContentLoaded', function() {
            const icon = document.getElementById('icon').value;
            const color = document.getElementById('color').value;
            const name = document.getElementById('nama').value;
            
            document.getElementById('previewIcon').className = icon + ' fa-2x mb-2';
            document.getElementById('previewIcon').style.color = color;
            document.getElementById('previewName').textContent = name || 'Nama Kategori';
        });
    </script>
</body>
</html>
