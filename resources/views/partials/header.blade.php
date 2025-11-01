<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'SMKN 4 Bogor' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body style="background:#f1f5f9;">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('gallery.beranda') }}">
                <i class="bi bi-mortarboard-fill me-2 text-primary" style="font-size: 1.6rem;"></i>
                <span class="fw-bold text-primary">SMKN 4 Bogor</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('gallery.beranda') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('gallery.jurusan') }}">Jurusan</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('gallery.galeri') }}">Galeri</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('gallery.agenda') }}">Agenda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/beranda#news') }}">Informasi</a></li>
                    <li class="nav-item"><a class="btn btn-primary ms-2" href="{{ route('admin.login') }}">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main>

