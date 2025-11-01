@php
    $title = $data['name'];
@endphp

@include('partials.header', ['title' => $title])

<section class="hero-section" style="background: linear-gradient(135deg, #f8fafc 0%, #e0f2fe 50%, #dbeafe 100%); padding: 80px 0; position: relative; overflow: hidden;">
    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%231E40AF" fill-opacity="0.03"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E'); opacity: 0.5;"></div>
    <div class="container" style="position: relative; z-index: 1;">
        <div class="row align-items-center g-5">
            <div class="col-12 col-lg-6">
                <div class="mb-3">
                    <a href="{{ url('/jurusan') }}" class="btn btn-sm" style="background: linear-gradient(135deg, #1E40AF 0%, #3b82f6 100%); color: white; border: none; border-radius: 50px; padding: 10px 24px; font-weight: 600; box-shadow: 0 4px 15px rgba(30,64,175,0.3); transition: all 0.3s ease;">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
                <h1 class="fw-bold mb-4" style="color: #1E40AF; font-size: 3rem; line-height: 1.2; text-shadow: none;">{{ $data['name'] }}</h1>
                <p class="lead" style="color: #475569; font-size: 1.2rem; line-height: 1.8;">{{ $data['summary'] }}</p>
                <div class="mt-4 d-flex gap-3 flex-wrap">
                    <div class="d-flex align-items-center" style="background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%); padding: 12px 24px; border-radius: 50px; box-shadow: 0 4px 12px rgba(59,130,246,0.3);">
                        <i class="fas fa-clock me-2" style="color: #ffffff;"></i>
                        <span style="color: #ffffff; font-weight: 600;">{{ $data['duration'] ?? '3 Tahun' }}</span>
                    </div>
                    <div class="d-flex align-items-center" style="background: linear-gradient(135deg, #8b5cf6 0%, #a78bfa 100%); padding: 12px 24px; border-radius: 50px; box-shadow: 0 4px 12px rgba(139,92,246,0.3);">
                        <i class="fas fa-users me-2" style="color: #ffffff;"></i>
                        <span style="color: #ffffff; font-weight: 600;">{{ count($data['competencies'] ?? []) }} Kompetensi</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="position-relative" style="border-radius: 24px; overflow: hidden; box-shadow: 0 20px 60px rgba(30,64,175,0.2); border: 3px solid rgba(255,255,255,0.8); transform: perspective(1000px) rotateY(-5deg); transition: transform 0.3s ease;" onmouseover="this.style.transform='perspective(1000px) rotateY(0deg)'" onmouseout="this.style.transform='perspective(1000px) rotateY(-5deg)'">
                    <div class="ratio ratio-16x9">
                        <img src="{{ $data['hero'] }}" alt="{{ $data['name'] }}" class="w-100 h-100 object-fit-cover" style="filter: brightness(1.05);">
                    </div>
                    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(180deg, transparent 0%, rgba(30,64,175,0.2) 100%);"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" style="background: linear-gradient(135deg, #ffffff 0%, #f1f5f9 50%, #e2e8f0 100%);">
    <div class="container">
        <div class="row g-4">
            <div class="col-12 col-lg-8">
                <!-- Tujuan Pembelajaran -->
                <div class="card border-0" style="border-radius: 20px; box-shadow: 0 8px 30px rgba(30,64,175,0.12); overflow: hidden; margin-bottom: 24px; background: linear-gradient(135deg, #ffffff 0%, #fefefe 100%);">
                    <div style="background: linear-gradient(135deg, #1E40AF 0%, #3b82f6 100%); padding: 24px;">
                        <h4 class="fw-bold mb-0" style="color: #ffffff;"><i class="fas fa-bullseye me-2"></i>Tujuan Pembelajaran</h4>
                    </div>
                    <div class="card-body p-4" style="background: linear-gradient(to bottom, #fefefe 0%, #f8fafc 100%);">
                        <div class="row g-3">
                            @foreach(($data['objectives'] ?? []) as $index => $item)
                                <div class="col-12">
                                    <div class="d-flex align-items-start" style="padding: 18px; background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); border-radius: 12px; border-left: 4px solid #3b82f6; box-shadow: 0 2px 8px rgba(59,130,246,0.1); transition: all 0.3s ease;" onmouseover="this.style.transform='translateX(5px)'; this.style.boxShadow='0 4px 12px rgba(59,130,246,0.2)'" onmouseout="this.style.transform='translateX(0)'; this.style.boxShadow='0 2px 8px rgba(59,130,246,0.1)'">
                                        <div style="background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%); color: #ffffff; width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; flex-shrink: 0; margin-right: 16px; box-shadow: 0 4px 12px rgba(59,130,246,0.4);">{{ $index + 1 }}</div>
                                        <p class="mb-0" style="color: #334155; line-height: 1.7; font-size: 0.95rem; font-weight: 500;">{{ $item }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Kompetensi Utama -->
                <div class="card border-0" style="border-radius: 20px; box-shadow: 0 8px 30px rgba(139,92,246,0.12); overflow: hidden; margin-bottom: 24px; background: linear-gradient(135deg, #ffffff 0%, #fefefe 100%);">
                    <div style="background: linear-gradient(135deg, #8b5cf6 0%, #a78bfa 100%); padding: 24px;">
                        <h4 class="fw-bold mb-0" style="color: #ffffff;"><i class="fas fa-star me-2"></i>Kompetensi Utama</h4>
                    </div>
                    <div class="card-body p-4" style="background: linear-gradient(to bottom, #fefefe 0%, #faf5ff 100%);">
                        <div class="d-flex flex-wrap gap-3">
                            @foreach(($data['competencies'] ?? []) as $c)
                                <div style="background: linear-gradient(135deg, #8b5cf6 0%, #a78bfa 100%); color: #ffffff; padding: 12px 24px; border-radius: 50px; font-weight: 600; font-size: 0.9rem; box-shadow: 0 4px 15px rgba(139,92,246,0.3); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-4px) scale(1.05)'; this.style.boxShadow='0 8px 20px rgba(139,92,246,0.4)'" onmouseout="this.style.transform='translateY(0) scale(1)'; this.style.boxShadow='0 4px 15px rgba(139,92,246,0.3)'">
                                    <i class="fas fa-check-circle me-2"></i>{{ $c }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Kurikulum -->
                <div class="card border-0" style="border-radius: 20px; box-shadow: 0 8px 30px rgba(14,165,233,0.12); overflow: hidden; margin-bottom: 24px; background: linear-gradient(135deg, #ffffff 0%, #fefefe 100%);">
                    <div style="background: linear-gradient(135deg, #0ea5e9 0%, #38bdf8 100%); padding: 24px;">
                        <h4 class="fw-bold mb-0" style="color: #ffffff;"><i class="fas fa-book-open me-2"></i>Kurikulum</h4>
                    </div>
                    <div class="card-body p-4" style="background: linear-gradient(to bottom, #fefefe 0%, #f0f9ff 100%);">
                        <div class="row g-3">
                            @foreach($data['curriculum'] as $i => $item)
                                <div class="col-12 col-md-6">
                                    <div class="d-flex align-items-center" style="padding: 16px; background: linear-gradient(135deg, #ffffff 0%, #f0f9ff 100%); border-radius: 12px; border: 2px solid #e0f2fe; box-shadow: 0 2px 8px rgba(14,165,233,0.08); transition: all 0.3s ease;" onmouseover="this.style.borderColor='#38bdf8'; this.style.boxShadow='0 4px 15px rgba(14,165,233,0.2)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.borderColor='#e0f2fe'; this.style.boxShadow='0 2px 8px rgba(14,165,233,0.08)'; this.style.transform='translateY(0)'">
                                        <div style="background: linear-gradient(135deg, #0ea5e9 0%, #38bdf8 100%); color: #ffffff; width: 38px; height: 38px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-weight: 700; flex-shrink: 0; margin-right: 14px; box-shadow: 0 4px 12px rgba(14,165,233,0.4);">{{ $i+1 }}</div>
                                        <div class="fw-semibold" style="color: #334155; font-size: 0.9rem;">{{ $item }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Contoh Proyek -->
                <div class="card border-0" style="border-radius: 20px; box-shadow: 0 8px 30px rgba(245,158,11,0.12); overflow: hidden; background: linear-gradient(135deg, #ffffff 0%, #fefefe 100%);">
                    <div style="background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%); padding: 24px;">
                        <h4 class="fw-bold mb-0" style="color: #ffffff;"><i class="fas fa-project-diagram me-2"></i>Contoh Proyek</h4>
                    </div>
                    <div class="card-body p-4" style="background: linear-gradient(to bottom, #fefefe 0%, #fffbeb 100%);">
                        <div class="row g-3">
                            @foreach(($data['projects'] ?? []) as $p)
                                <div class="col-12 col-md-6">
                                    <div style="padding: 22px; background: linear-gradient(135deg, #ffffff 0%, #fef3c7 100%); border-radius: 14px; border: 2px solid #fde68a; box-shadow: 0 2px 8px rgba(245,158,11,0.1); transition: all 0.3s ease; height: 100%;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 20px rgba(245,158,11,0.25)'; this.style.borderColor='#fbbf24'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(245,158,11,0.1)'; this.style.borderColor='#fde68a'">
                                        <div style="background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%); width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 14px; box-shadow: 0 4px 12px rgba(245,158,11,0.3);">
                                            <i class="fas fa-lightbulb" style="color: #ffffff; font-size: 1.3rem;"></i>
                                        </div>
                                        <p class="mb-0" style="color: #334155; font-weight: 600; line-height: 1.6; font-size: 0.95rem;">{{ $p }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <!-- Mentor Card -->
                <div class="card border-0" style="border-radius: 20px; box-shadow: 0 8px 30px rgba(30,64,175,0.15); overflow: hidden; margin-bottom: 24px; position: sticky; top: 20px; background: linear-gradient(135deg, #ffffff 0%, #fefefe 100%);">
                    <div style="background: linear-gradient(135deg, #1E40AF 0%, #3b82f6 100%); padding: 28px; text-align: center; position: relative; overflow: hidden;">
                        <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: url('data:image/svg+xml,%3Csvg width=\"40\" height=\"40\" viewBox=\"0 0 40 40\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.05\"%3E%3Cpath d=\"M0 0h20v20H0V0zm10 17a7 7 0 1 0 0-14 7 7 0 0 0 0 14z\"/%3E%3C/g%3E%3C/svg%3E'); opacity: 0.3;"></div>
                        <div class="mx-auto" style="width: 110px; height: 110px; border-radius: 50%; overflow: hidden; border: 5px solid rgba(255,255,255,0.9); box-shadow: 0 8px 25px rgba(0,0,0,0.2); margin-bottom: 16px; position: relative; z-index: 1;">
                            @if(!empty($data['mentor']['avatar']))
                                <img src="{{ $data['mentor']['avatar'] }}" alt="{{ $data['mentor']['name'] }}" class="w-100 h-100 object-fit-cover">
                            @else
                                <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #e0f2fe 0%, #bfdbfe 100%); display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-user" style="font-size: 2.8rem; color: #3b82f6;"></i>
                                </div>
                            @endif
                        </div>
                        <h5 class="fw-bold mb-1" style="color: #ffffff; position: relative; z-index: 1;">{{ $data['mentor']['name'] }}</h5>
                        <p class="mb-0" style="color: rgba(255,255,255,0.95); font-size: 0.9rem; position: relative; z-index: 1;">{{ $data['mentor']['title'] }}</p>
                    </div>
                    <div class="card-body p-4" style="background: linear-gradient(to bottom, #fefefe 0%, #f8fafc 100%);">
                        <!-- Durasi -->
                        <div class="mb-4">
                            <div class="d-flex align-items-center mb-2" style="padding: 14px; background: linear-gradient(135deg, #dbeafe 0%, #e0f2fe 100%); border-radius: 12px; border: 2px solid #bfdbfe;">
                                <div style="background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%); width: 42px; height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 12px; box-shadow: 0 4px 12px rgba(59,130,246,0.3);">
                                    <i class="fas fa-clock" style="color: #ffffff; font-size: 1.1rem;"></i>
                                </div>
                                <div>
                                    <div class="text-muted small" style="font-weight: 600;">Durasi Program</div>
                                    <div class="fw-bold" style="color: #1E40AF; font-size: 1.05rem;">{{ $data['duration'] ?? '3 Tahun' }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Fasilitas -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3" style="color: #1E40AF;"><i class="fas fa-tools me-2" style="color: #3b82f6;"></i>Fasilitas</h6>
                            <div class="d-flex flex-column gap-2">
                                @foreach(($data['facilities'] ?? []) as $f)
                                    <div class="d-flex align-items-center" style="padding: 12px; background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%); border-radius: 10px; border: 1px solid #bfdbfe; transition: all 0.3s ease;" onmouseover="this.style.transform='translateX(5px)'; this.style.boxShadow='0 2px 8px rgba(59,130,246,0.15)'" onmouseout="this.style.transform='translateX(0)'; this.style.boxShadow='none'">
                                        <i class="fas fa-check-circle me-2" style="color: #10b981; font-size: 1.1rem;"></i>
                                        <span style="color: #334155; font-size: 0.9rem; font-weight: 500;">{{ $f }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Syarat -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3" style="color: #1E40AF;"><i class="fas fa-clipboard-list me-2" style="color: #3b82f6;"></i>Persyaratan</h6>
                            <div class="d-flex flex-column gap-2">
                                @foreach(($data['requirements'] ?? []) as $r)
                                    <div class="d-flex align-items-center" style="padding: 12px; background: linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%); border-radius: 10px; border: 1px solid #e9d5ff; transition: all 0.3s ease;" onmouseover="this.style.transform='translateX(5px)'; this.style.boxShadow='0 2px 8px rgba(139,92,246,0.15)'" onmouseout="this.style.transform='translateX(0)'; this.style.boxShadow='none'">
                                        <i class="fas fa-chevron-right me-2" style="color: #8b5cf6; font-size: 0.9rem;"></i>
                                        <span style="color: #334155; font-size: 0.9rem; font-weight: 500;">{{ $r }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- CTA Button -->
                        <a href="#" class="btn w-100" style="background: linear-gradient(135deg, #1E40AF 0%, #3b82f6 100%); border: none; color: #ffffff; padding: 16px; border-radius: 12px; font-weight: 700; font-size: 1rem; box-shadow: 0 8px 20px rgba(30,64,175,0.4); transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 12px 30px rgba(30,64,175,0.5)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 8px 20px rgba(30,64,175,0.4)'">
                            <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                        </a>
                    </div>
                </div>

                <!-- Peluang Karir -->
                <div class="card border-0" style="border-radius: 20px; box-shadow: 0 8px 30px rgba(236,72,153,0.12); overflow: hidden; background: linear-gradient(135deg, #ffffff 0%, #fefefe 100%);">
                    <div style="background: linear-gradient(135deg, #ec4899 0%, #f472b6 100%); padding: 22px;">
                        <h5 class="fw-bold mb-0" style="color: #ffffff;"><i class="fas fa-briefcase me-2"></i>Peluang Karir</h5>
                    </div>
                    <div class="card-body p-4" style="background: linear-gradient(to bottom, #fefefe 0%, #fdf2f8 100%);">
                        <div class="d-flex flex-column gap-3">
                            @foreach(($data['careers'] ?? []) as $index => $c)
                                <div style="padding: 16px; background: linear-gradient(135deg, #ffffff 0%, #fce7f3 100%); border-radius: 12px; border-left: 4px solid #f472b6; box-shadow: 0 2px 8px rgba(236,72,153,0.08); transition: all 0.3s ease;" onmouseover="this.style.transform='translateX(5px)'; this.style.boxShadow='0 4px 15px rgba(236,72,153,0.2)'" onmouseout="this.style.transform='translateX(0)'; this.style.boxShadow='0 2px 8px rgba(236,72,153,0.08)'">
                                    <div class="d-flex align-items-start">
                                        <div style="background: linear-gradient(135deg, #ec4899 0%, #f472b6 100%); color: #ffffff; width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.85rem; flex-shrink: 0; margin-right: 14px; box-shadow: 0 4px 12px rgba(236,72,153,0.3);">{{ $index + 1 }}</div>
                                        <span style="color: #334155; font-weight: 600; font-size: 0.9rem; line-height: 1.6;">{{ $c }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('partials.footer')


