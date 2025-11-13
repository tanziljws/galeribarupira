# Update: Peningkatan Limit Berita di Halaman Beranda

## 📋 Ringkasan Perubahan

Limit jumlah berita yang ditampilkan di halaman beranda telah ditingkatkan dari **8 berita** menjadi **15 berita**.

## 🔄 Perubahan yang Dilakukan

### 1. GalleryController.php (Line 59)
**Sebelum:**
```php
->limit(8)
```

**Sesudah:**
```php
->limit(15)
```

**Penjelasan:**
- Sekarang halaman beranda akan mengambil maksimal 15 berita yang sudah dipublikasi
- Berita ditampilkan dalam urutan terbaru (berdasarkan tanggal publikasi atau tanggal dibuat)

### 2. beranda.blade.php (Lines 1099-1105)
**Tambahan Animation Delay:**
```css
.news-card:nth-child(9) { animation-delay: 0.9s; }
.news-card:nth-child(10) { animation-delay: 1.0s; }
.news-card:nth-child(11) { animation-delay: 1.1s; }
.news-card:nth-child(12) { animation-delay: 1.2s; }
.news-card:nth-child(13) { animation-delay: 1.3s; }
.news-card:nth-child(14) { animation-delay: 1.4s; }
.news-card:nth-child(15) { animation-delay: 1.5s; }
```

**Penjelasan:**
- Menambahkan animation delay untuk berita ke-9 sampai ke-15
- Setiap berita akan muncul dengan animasi slide-in yang bertahap
- Interval delay 0.1 detik untuk setiap berita

## 📊 Perbandingan

| Aspek | Sebelum | Sesudah |
|-------|---------|---------|
| **Limit Berita** | 8 berita | 15 berita |
| **Tampilan Carousel** | 6 kartu terlihat + 2 bisa di-scroll | 6 kartu terlihat + 9 bisa di-scroll |
| **Animation Delay** | Sampai ke-8 | Sampai ke-15 |

## 🎯 Cara Kerja

1. **Pengambilan Data:**
   - GalleryController mengambil berita dengan status 'published'
   - Diurutkan dari terbaru ke tertua
   - Maksimal 15 berita diambil

2. **Tampilan di Halaman Beranda:**
   - Berita ditampilkan dalam carousel horizontal
   - Hanya 6 kartu yang terlihat sekaligus di desktop
   - Pengguna bisa scroll ke kanan untuk melihat berita lainnya
   - Semua 15 berita bisa diakses dengan scroll

3. **Animasi:**
   - Setiap berita muncul dengan animasi slide-in dari kanan
   - Delay animasi bertahap: 0.1s, 0.2s, 0.3s, ... 1.5s

## ✅ Testing

Untuk memastikan perubahan bekerja dengan baik:

1. **Tambah Berita Baru:**
   - Buka admin berita: `http://127.0.0.1:8000/admin/berita`
   - Tambah berita baru dengan status "Published"
   - Pastikan ada minimal 9 berita yang sudah dipublikasi

2. **Buka Halaman Beranda:**
   - Akses `http://127.0.0.1:8000/beranda`
   - Tekan Ctrl+F5 untuk hard refresh
   - Lihat section "Informasi Sekolah"

3. **Scroll Carousel:**
   - Scroll ke kanan di carousel berita
   - Pastikan bisa melihat berita ke-7, 8, 9, dst
   - Pastikan animasi muncul dengan smooth

## 📌 Catatan Penting

- **Limit 15 berita** adalah jumlah maksimal yang akan diambil dari database
- Jika ada lebih dari 15 berita yang dipublikasi, hanya 15 terbaru yang ditampilkan
- Berita lama tetap tersimpan di database dan bisa diakses melalui halaman berita detail
- Jika ingin menampilkan lebih dari 15, bisa diubah di GalleryController line 59

## 🔧 Jika Ingin Mengubah Lagi

Untuk mengubah limit berita:

1. **Edit GalleryController.php:**
   - Buka file: `app/Http/Controllers/GalleryController.php`
   - Cari line 59: `->limit(15)`
   - Ubah angka 15 ke jumlah yang diinginkan

2. **Update Animation Delay di beranda.blade.php:**
   - Buka file: `resources/views/gallery/beranda.blade.php`
   - Cari section `.news-card:nth-child()`
   - Tambah atau kurangi sesuai jumlah berita baru

**Contoh:** Jika ingin 20 berita, tambahkan:
```css
.news-card:nth-child(16) { animation-delay: 1.6s; }
.news-card:nth-child(17) { animation-delay: 1.7s; }
.news-card:nth-child(18) { animation-delay: 1.8s; }
.news-card:nth-child(19) { animation-delay: 1.9s; }
.news-card:nth-child(20) { animation-delay: 2.0s; }
```

## 📁 File yang Dimodifikasi

- `app/Http/Controllers/GalleryController.php` (line 59)
- `resources/views/gallery/beranda.blade.php` (lines 1099-1105)

## ✨ Hasil

Sekarang halaman beranda bisa menampilkan hingga 15 berita dengan animasi yang smooth dan carousel yang responsif!
