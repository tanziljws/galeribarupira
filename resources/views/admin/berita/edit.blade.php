<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-4">
    <h5 class="mb-3">Edit Berita</h5>
    <form action="{{ route('admin.berita.update', $berita) }}" method="POST" enctype="multipart/form-data" class="card p-3">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $berita->title) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Ringkasan</label>
            <input type="text" name="excerpt" class="form-control" maxlength="300" value="{{ old('excerpt', $berita->excerpt) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Isi</label>
            <textarea name="content" rows="6" class="form-control">{{ old('content', $berita->content) }}</textarea>
        </div>
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="draft" {{ $berita->status==='draft'?'selected':'' }}>Draft</option>
                    <option value="published" {{ $berita->status==='published'?'selected':'' }}>Published</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Tanggal Terbit</label>
                <input type="datetime-local" name="published_at" class="form-control" value="{{ old('published_at', optional($berita->published_at)->format('Y-m-d\TH:i')) }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Gambar</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                @if($berita->image_path)
                    <img src="{{ asset('storage/'.$berita->image_path) }}" alt="thumb" class="mt-2" style="width:120px;height:80px;object-fit:cover;border-radius:6px;">
                @endif
            </div>
        </div>
        <div class="mt-3 d-flex gap-2">
            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
</body>
</html>





































