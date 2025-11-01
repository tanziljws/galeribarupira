<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Galeri Baru - Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #1f6fd6;
            --secondary-blue: #0b61c2;
            --light-blue: #e9f2ff;
            --dark-gray: #1f2937;
            --light-gray: #6b7280;
            --white: #ffffff;
            --light-bg: #f6f9ff;
            --success-color: #16a34a;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
        }

        body {
            background: var(--light-bg);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar {
            background: var(--white) !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-bottom: 1px solid #e9ecef;
        }
        
        .navbar-brand {
            color: var(--primary-blue) !important;
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .navbar-nav .nav-link {
            color: var(--dark-gray) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            margin: 0 0.5rem;
            border-radius: 6px;
            padding: 0.5rem 1rem;
        }
        
        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: var(--primary-blue) !important;
            background: var(--light-blue);
        }
        
        .btn-logout {
            background: var(--primary-blue);
            border: none;
            color: var(--white);
            padding: 0.5rem 1.5rem;
            border-radius: 6px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            margin-left: 1rem;
        }
        
        .btn-logout:hover {
            background: var(--secondary-blue);
            color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(31, 111, 214, 0.3);
        }
        
        .main-content {
            background: var(--white);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            border: 1px solid #e9ecef;
            margin-top: 2rem;
        }
        
        .page-header {
            background: linear-gradient(135deg, #1f6fd6 0%, #0b61c2 100%);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: none;
            text-align: center;
            box-shadow: 0 10px 30px rgba(31, 111, 214, 0.25);
            color: #fff;
        }
        
        .page-title {
            color: #fff;
            font-size: 2.1rem;
            font-weight: 800;
            margin-bottom: 0.3rem;
            letter-spacing: .2px;
        }
        
        .page-subtitle {
            color: #e3f2fd;
            font-size: 1.05rem;
        }
        
        .form-container {
            background: var(--white);
            border-radius: 14px;
            padding: 2rem;
            box-shadow: 0 8px 26px rgba(2, 6, 23, 0.07);
            border: 1px solid #e6edf7;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--dark-gray);
            margin-bottom: 0.75rem;
            display: block;
        }
        
        .form-control {
            border: 2px solid #e6edf7;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.2rem rgba(31, 111, 214, 0.25);
        }
        
        .form-select {
            border: 2px solid #e6edf7;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-select:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.2rem rgba(31, 111, 214, 0.25);
        }
        
        .file-upload-area {
            border: 2px dashed #cfe3ff;
            border-radius: 14px;
            padding: 3rem 2rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            background: #f3f7ff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 200px;
        }
        
        .file-upload-area:hover {
            border-color: var(--primary-blue);
            background: #e9f2ff;
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(31, 111, 214, 0.15);
        }
        
        .file-upload-area.dragover {
            border-color: var(--success-color);
            background: #f0fdf4;
        }
        
        .file-upload-icon {
            font-size: 3rem;
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }
        
        .file-upload-text {
            color: var(--primary-blue);
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            text-align: center;
        }
        
        .file-upload-hint {
            color: var(--light-gray);
            font-size: 0.9rem;
        }
        
        .btn-submit {
            background: var(--success-color);
            border: none;
            color: var(--white);
            padding: 1rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 1rem;
        }
        
        .btn-submit {
            background: linear-gradient(135deg, #16a34a, #22c55e);
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(16, 185, 129, 0.25);
            filter: brightness(1.03);
        }
        
        .btn-cancel {
            background: var(--light-gray);
            border: none;
            color: var(--white);
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-cancel:hover {
            background: #4b5563;
            color: var(--white);
            transform: translateY(-2px);
        }
        
        .preview-image {
            max-width: 100%;
            max-height: 300px;
            border-radius: 8px;
            margin-top: 1rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .alert {
            border-radius: 8px;
            border: none;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" style="position:fixed;left:0;top:0;width:280px;height:100vh;background:linear-gradient(180deg,#1f6fd6 0%, #0056b3 100%);color:#fff;box-shadow:4px 0 20px rgba(0,0,0,.1);">
        <div class="sidebar-header" style="background:rgba(255,255,255,.1);padding:2rem 1.5rem;text-align:center;border-bottom:1px solid rgba(255,255,255,.1)">
            <div class="sidebar-logo" style="width:80px;height:80px;background:linear-gradient(135deg,#1f6fd6,#2aa1ff);border-radius:20px;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;font-size:2rem;color:#fff;box-shadow:0 8px 25px rgba(31,111,214,.35)"><i class="fas fa-graduation-cap"></i></div>
            <div class="sidebar-title" style="font-weight:700">SMKN 4 BOGOR</div>
            <div class="sidebar-subtitle" style="opacity:.85">Admin Panel</div>
        </div>
        <nav class="sidebar-nav" style="padding:2rem 0">
            <div class="nav-item" style="margin:.5rem 1rem"><a href="{{ route('admin.dashboard') }}" class="nav-link" style="display:flex;align-items:center;padding:1rem 1.5rem;color:rgba(255,255,255,.9);text-decoration:none;border-radius:12px;"><i class="fas fa-tachometer-alt me-3"></i>Dashboard Admin</a></div>
            <div class="nav-item" style="margin:.5rem 1rem"><a href="{{ route('admin.photos.index') }}" class="nav-link active" style="display:flex;align-items:center;padding:1rem 1.5rem;background:rgba(255,255,255,.2);color:#fff;text-decoration:none;border-radius:12px;"><i class="fas fa-camera me-3"></i>Kelola Foto</a></div>
            <div class="nav-item" style="margin:.5rem 1rem"><a href="{{ route('admin.categories.index') }}" class="nav-link" style="display:flex;align-items:center;padding:1rem 1.5rem;color:rgba(255,255,255,.9);text-decoration:none;border-radius:12px;"><i class="fas fa-folder-open me-3"></i>Kelola Kategori</a></div>
            <div class="nav-item" style="margin:.5rem 1rem"><a href="{{ route('admin.agenda.index') }}" class="nav-link" style="display:flex;align-items:center;padding:1rem 1.5rem;color:rgba(255,255,255,.9);text-decoration:none;border-radius:12px;"><i class="fas fa-calendar-alt me-3"></i>Kelola Agenda</a></div>
            <div class="nav-item" style="margin:.5rem 1rem"><a href="{{ route('admin.petugas') }}" class="nav-link" style="display:flex;align-items:center;padding:1rem 1.5rem;color:rgba(255,255,255,.9);text-decoration:none;border-radius:12px;"><i class="fas fa-users me-3"></i>Manajemen Admin</a></div>
        </nav>
        
    </div>

    <div class="main-content" style="margin-left:280px;padding:2rem;">
        <div class="container-fluid px-0">
            <!-- Page Header -->
            <div class="page-header">
                <h1 class="page-title">
                                            <i class="fas fa-plus-circle me-2"></i>Tambah Galeri Baru
                </h1>
                <p class="page-subtitle">Upload dan tambahkan foto baru ke galeri</p>
            </div>

            <!-- Form Container -->
            <div class="main-content">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.photos.store') }}" method="POST" enctype="multipart/form-data" id="photoForm">
                    @csrf
                    <div class="form-group">
                        <label for="judul" class="form-label"><i class="fas fa-heading me-2"></i>Judul Foto</label>
                        <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}" placeholder="Masukkan judul foto" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi" class="form-label"><i class="fas fa-align-left me-2"></i>Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" placeholder="Masukkan deskripsi foto (opsional)">{{ old('deskripsi') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="kategori_id" class="form-label"><i class="fas fa-tag me-2"></i>Kategori</label>
                        <select class="form-select" id="kategori_id" name="kategori_id" required>
                            <option value="">Pilih kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('kategori_id') == $category->id ? 'selected' : '' }}>{{ $category->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-image me-2"></i>Upload Foto</label>
                        <div class="file-upload-area" id="fileUploadArea">
                            <div class="file-upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                            <div class="file-upload-text">Upload Foto</div>
                            <div class="file-upload-hint">Format: JPG, PNG, GIF, WEBP (Max: 10MB)</div>
                            <input type="file" id="file" name="file" accept="image/*" style="display:none" required>
                        </div>
                        <div id="imagePreview" style="display:none"><img id="previewImg" class="preview-image" src="" alt="Preview"></div>
                    </div>
                    <button type="submit" class="btn-submit"><i class="fas fa-save me-2"></i>Simpan Foto</button>
                </form>

                <div class="text-center mt-4">
                    <a href="{{ route('admin.photos.index') }}" class="btn-cancel"><i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Foto</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const fileUploadArea = document.getElementById('fileUploadArea');
        const fileInput = document.getElementById('file');
        const imagePreview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        fileUploadArea.addEventListener('click', () => fileInput.click());
        fileUploadArea.addEventListener('dragover', (e) => { e.preventDefault(); fileUploadArea.classList.add('dragover'); });
        fileUploadArea.addEventListener('dragleave', () => fileUploadArea.classList.remove('dragover'));
        fileUploadArea.addEventListener('drop', (e) => { e.preventDefault(); fileUploadArea.classList.remove('dragover'); const files=e.dataTransfer.files; if(files.length>0){ fileInput.files=files; handleFileSelect(files[0]); }});
        fileInput.addEventListener('change', (e)=>{ if(e.target.files.length>0){ handleFileSelect(e.target.files[0]); }});
        function handleFileSelect(file){ if(!file.type.startsWith('image/')){ alert('Pilih file gambar yang valid!'); return;} if(file.size>10*1024*1024){ alert('Ukuran file terlalu besar! Maksimal 10MB.'); return;} const reader=new FileReader(); reader.onload=function(e){ previewImg.src=e.target.result; imagePreview.style.display='block'; fileUploadArea.style.display='none'; }; reader.readAsDataURL(file);}        
        document.getElementById('photoForm').addEventListener('submit', function(e){ const judul=document.getElementById('judul').value.trim(); const kategori=document.getElementById('kategori_id').value; const file=document.getElementById('file').files[0]; if(!judul){ e.preventDefault(); alert('Judul foto harus diisi!'); return;} if(!kategori){ e.preventDefault(); alert('Kategori harus dipilih!'); return;} if(!file){ e.preventDefault(); alert('Foto harus diupload!'); return;} });
    </script>
</body>
</html>
