<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Foto - Admin Dashboard</title>
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
        
        .file-upload-area {
            border: 2px dashed #667eea;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            background: rgba(102, 126, 234, 0.05);
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .file-upload-area:hover {
            background: rgba(102, 126, 234, 0.1);
            border-color: #764ba2;
        }
        
        .file-upload-area.dragover {
            background: rgba(102, 126, 234, 0.2);
            border-color: #764ba2;
            transform: scale(1.02);
        }
        
        .upload-progress {
            display: none;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
        <div class="main-content">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                            <h2 class="fw-bold mb-1">
                                <i class="fas fa-upload me-2"></i>Upload Foto Baru
                            </h2>
                            <p class="text-muted mb-0">Upload foto baru ke galeri Anda</p>
                    </div>
                    <a href="{{ route('admin.foto.index') }}" class="btn btn-secondary">
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
                                <i class="fas fa-camera me-2"></i>Informasi Foto
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('admin.foto.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="judul" class="form-label fw-bold">
                                                <i class="fas fa-tag me-1"></i>Judul Foto
                                            </label>
                                            <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                                                   id="judul" name="judul" value="{{ old('judul') }}" 
                                                   required placeholder="Masukkan judul foto">
                                            @error('judul')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="deskripsi" class="form-label fw-bold">
                                                <i class="fas fa-align-left me-1"></i>Deskripsi
                                            </label>
                                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                                      id="deskripsi" name="deskripsi" rows="4" 
                                                      placeholder="Jelaskan foto ini...">{{ old('deskripsi') }}</textarea>
                                            @error('deskripsi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                                         <div class="row">
                                            <div class="col-md-6">
                                     <div class="mb-3">
                                                    <label for="galery_id" class="form-label fw-bold">
                                                        <i class="fas fa-images me-1"></i>Galeri
                                         </label>
                                         <select class="form-select @error('galery_id') is-invalid @enderror" 
                                                            id="galery_id" name="galery_id" required>
                                                        <option value="">Pilih Galeri</option>
                                             @foreach($galeries as $galery)
                                                            <option value="{{ $galery->id }}" {{ old('galery_id') == $galery->id ? 'selected' : '' }}>
                                                     {{ $galery->nama }}
                                                 </option>
                                             @endforeach
                                         </select>
                                         @error('galery_id')
                                             <div class="invalid-feedback">{{ $message }}</div>
                                         @enderror
                                     </div>
                                 </div>
                                            
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="kategori_id" class="form-label fw-bold">
                                                        <i class="fas fa-folder me-1"></i>Kategori
                                                    </label>
                                                    <select class="form-select @error('kategori_id') is-invalid @enderror" 
                                                            id="kategori_id" name="kategori_id">
                                                        <option value="">Pilih Kategori (Opsional)</option>
                                                        @foreach($kategoris as $kategori)
                                                            <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                                                {{ $kategori->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('kategori_id')
                                             <div class="invalid-feedback">{{ $message }}</div>
                                         @enderror
                                     </div>
                                 </div>
                             </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="mb-3">
                                            <label for="foto" class="form-label fw-bold">
                                                <i class="fas fa-image me-1"></i>Upload Foto
                                </label>
                                            <div class="file-upload-area" onclick="document.getElementById('foto').click()">
                                                <i class="fas fa-cloud-upload-alt fa-2x mb-2" style="color: #667eea;"></i>
                                                <p class="mb-0">Klik untuk upload foto</p>
                                                <small class="text-muted">JPG, PNG, GIF, WebP (Max 10MB)</small>
                                            </div>
                                            <input type="file" id="foto" name="foto" class="d-none" accept="image/*" required>
                                            @error('foto')
                                                <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                     </div>
                                        
                                        <div id="imagePreview" class="d-none mb-3">
                                            <label class="form-label fw-bold">
                                                <i class="fas fa-eye me-1"></i>Preview
                                            </label>
                                            <img id="previewImg" class="img-fluid rounded" style="max-height: 200px;">
                                 </div>
                                        
                                        <div class="upload-progress" id="uploadProgress">
                                            <label class="form-label fw-bold">
                                                <i class="fas fa-spinner me-1"></i>Upload Progress
                                            </label>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 0%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                                <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('admin.foto.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                                    <button type="submit" class="btn btn-custom" id="submitBtn">
                                        <i class="fas fa-upload me-2"></i>Upload Foto
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
                 // File upload preview
        document.getElementById('foto').addEventListener('change', function(e) {
             const file = e.target.files[0];
             if (file) {
                 const reader = new FileReader();
                 reader.onload = function(e) {
                    document.getElementById('previewImg').src = e.target.result;
                    document.getElementById('imagePreview').classList.remove('d-none');
                 }
                 reader.readAsDataURL(file);
             }
         });

         // Drag and drop functionality
         const uploadArea = document.querySelector('.file-upload-area');
         
         uploadArea.addEventListener('dragover', function(e) {
             e.preventDefault();
            this.classList.add('dragover');
         });
         
         uploadArea.addEventListener('dragleave', function(e) {
             e.preventDefault();
            this.classList.remove('dragover');
         });
         
         uploadArea.addEventListener('drop', function(e) {
             e.preventDefault();
            this.classList.remove('dragover');
             const files = e.dataTransfer.files;
             if (files.length > 0) {
                const input = document.getElementById('foto');
                input.files = files;
                input.dispatchEvent(new Event('change'));
            }
        });
        
        // Form submission with progress
        document.getElementById('uploadForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            const progressBar = document.querySelector('.progress-bar');
            const uploadProgress = document.getElementById('uploadProgress');
            
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Uploading...';
            uploadProgress.style.display = 'block';
            
            // Simulate progress
            let progress = 0;
            const interval = setInterval(() => {
                progress += 10;
                progressBar.style.width = progress + '%';
                progressBar.textContent = progress + '%';
                
                if (progress >= 100) {
                    clearInterval(interval);
                }
            }, 200);
        });
    </script>
</body>
</html>
