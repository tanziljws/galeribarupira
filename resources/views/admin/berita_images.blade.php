<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Gambar Berita - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background:#f6f9ff; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .card { border:1px solid #e6edf7; box-shadow:0 8px 24px rgba(2,6,23,.06); border-radius:14px; }
        .page-header { background:linear-gradient(135deg,#1f6fd6,#0b61c2); color:#fff; border-radius:16px; padding:1.5rem; box-shadow:0 10px 30px rgba(31,111,214,.25); }
        .form-control { border:2px solid #e6edf7; border-radius:10px; }
        .btn-primary { background:linear-gradient(135deg,#1f6fd6,#0b61c2); border:none; }
    </style>
</head>
<body>
<div class="container py-4">
    <div class="page-header mb-4">
        <h3 class="mb-0"><i class="fas fa-images me-2"></i>Upload Gambar Berita (Informasi)</h3>
        <small>File akan disimpan di <code>public/images/berita</code> dengan nama tetap.</small>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card p-3">
        <form action="{{ route('admin.berita.images.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">DIGI Goes to School</label>
                    <input type="file" name="digi" accept="image/*" class="form-control">
                    <small class="text-muted">Nama file: <code>digi-goes-to-school.[ext]</code></small>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Informasi PPDB 2025/2026</label>
                    <input type="file" name="ppdb" accept="image/*" class="form-control">
                    <small class="text-muted">Nama file: <code>informasi-ppdb-2025.[ext]</code></small>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">BPJS Ketenagakerjaan PKL</label>
                    <input type="file" name="bpjs" accept="image/*" class="form-control">
                    <small class="text-muted">Nama file: <code>bpjs-ketenagakerjaan-pkl.[ext]</code></small>
                </div>
            </div>
            <div class="mt-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="fas fa-cloud-upload-alt me-2"></i>Upload</button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>



























































