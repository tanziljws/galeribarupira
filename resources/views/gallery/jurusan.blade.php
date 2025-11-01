@php
    $title = 'Jurusan';
@endphp

@include('partials.header', ['title' => $title])

<div class="container py-5" style="background:#0ea5e9;min-height:100vh;">
    <div class="row mb-4">
        <div class="col-12 col-lg-8 mx-auto">
            <div class="input-group input-group-lg shadow-sm" style="border-radius:14px; overflow:hidden;">
                <span class="input-group-text bg-white border-0"><i class="bi bi-search"></i></span>
                <input type="text" id="searchJurusan" class="form-control border-0" placeholder="Cari jurusan..."/>
                <a href="{{ route('gallery.beranda') }}" class="btn btn-outline-secondary">Beranda</a>
            </div>
        </div>
    </div>
    <div class="row gy-4" id="jurusanGrid">
        @foreach($jurusan as $item)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card shadow border-0 h-100" style="border-radius:18px;">
                    <div class="p-3 d-flex justify-content-between align-items-center">
                        <div class="small text-muted">{{ $item['kategori'] }}</div>
                        <span class="badge" style="background:#F5C518;color:#000;font-weight:700;">{{ $item['label'] }}</span>
                    </div>
                    <div class="ratio ratio-16x9">
                        <img src="{{ $item['thumbnail'] }}" alt="{{ $item['title'] }}" class="w-100 h-100 object-fit-cover" style="border-top-left-radius:18px;border-top-right-radius:18px;">
                    </div>
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">{{ $item['title'] }}</h5>
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-muted small">Mentor</div>
                                <div class="fw-semibold">{{ $item['mentor'] }}</div>
                                <div class="text-muted small">{{ $item['mentor_title'] }}</div>
                            </div>
                            <div class="rounded-circle d-flex align-items-center justify-content-center" style="width:64px;height:64px;background:{{ $item['color'] }};color:#fff;font-weight:800;">
                                {{ $item['badge'] }}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pb-4">
                        <a href="{{ route('gallery.jurusan.show', $item['slug']) }}" class="btn btn-primary w-100" style="background:#1e1b4b;border-radius:12px;">
                            Lihat Detail Kelas
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@include('partials.footer')

<script>
    (function(){
        const input = document.getElementById('searchJurusan');
        const grid = document.getElementById('jurusanGrid');
        if(!input || !grid) return;
        input.addEventListener('input', function(){
            const q = this.value.toLowerCase();
            grid.querySelectorAll('.col-12').forEach(col => {
                const text = col.innerText.toLowerCase();
                col.style.display = text.includes(q) ? '' : 'none';
            });
        });
    })();
</script>


