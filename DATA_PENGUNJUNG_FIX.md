# Perbaikan Bagian "Data Pengunjung" di Halaman Reports Admin

## 📋 Ringkasan Perubahan

Bagian "9. Data Pengunjung" di halaman reports admin (`http://127.0.0.1:8000/admin/reports`) telah diperbaiki untuk menampilkan data pengunjung yang akurat dan sesuai dengan permintaan.

## 🎯 Tujuan

Menampilkan statistik pengunjung halaman beranda dengan 3 kategori:
1. **Total Kunjungan Halaman Beranda** - Total berapa kali halaman dibuka (bisa dari orang yang sama berkali-kali)
2. **Pengunjung Terdaftar** - Jumlah user unik yang sudah login dan mengunjungi beranda
3. **Pengunjung Tamu (Guest)** - Jumlah kunjungan dari user yang tidak login

## 📝 File yang Dimodifikasi

### 1. `app/Http/Controllers/GalleryController.php` (Lines 30-44)
**Perubahan**: Tambah kode untuk mencatat setiap kunjungan ke halaman beranda

```php
// Catat view activity untuk setiap kunjungan ke halaman beranda
try {
    DB::table('gallery_activities')->insert([
        'activity_type' => 'view',
        'user_id' => session('user_id') ?? null,  // null jika guest
        'foto_id' => null,
        'content' => 'Kunjungan ke halaman beranda',
        'created_at' => now(),
        'updated_at' => now()
    ]);
} catch (\Exception $e) {
    \Log::warning('Failed to record view activity: ' . $e->getMessage());
}
```

**Penjelasan**:
- Setiap kali user (login atau guest) mengakses `/beranda`, akan tercatat 1 record di tabel `gallery_activities`
- Jika user login, `user_id` akan berisi ID user
- Jika user tidak login (guest), `user_id` akan `NULL`
- Ini memungkinkan admin untuk membedakan pengunjung terdaftar vs guest

### 2. `app/Http/Controllers/AdminController.php` (Lines 1496-1516)
**Perubahan**: Update query untuk menghitung pengunjung dengan benar

```php
// Total Kunjungan Halaman Beranda = total view activities
// Sudah ada di $totalViews (line 1327)

// Pengunjung Terdaftar = unique users yang sudah login
$registeredVisitors = DB::table('gallery_activities')
    ->where('activity_type', 'view')
    ->whereNotNull('user_id')
    ->when($startDate && $endDate, function($q) use ($startDate, $endDate) {
        return $q->whereBetween('created_at', [$startDate, $endDate]);
    })
    ->distinct('user_id')
    ->count('user_id');

// Pengunjung Tamu (Guest) = view activities tanpa user_id
$guestVisitors = DB::table('gallery_activities')
    ->where('activity_type', 'view')
    ->whereNull('user_id')
    ->when($startDate && $endDate, function($q) use ($startDate, $endDate) {
        return $q->whereBetween('created_at', [$startDate, $endDate]);
    })
    ->count();
```

**Penjelasan**:
- **Total Kunjungan**: Menggunakan `$totalViews` yang sudah ada (line 1327)
  - Menghitung semua record dengan `activity_type = 'view'`
  - Tidak peduli siapa yang mengunjungi, hanya hitung total kunjungan

- **Pengunjung Terdaftar**: Menghitung unique users yang login
  - Filter: `activity_type = 'view'` AND `user_id` NOT NULL
  - Menggunakan `distinct('user_id')` untuk menghitung user unik
  - Jadi jika 1 user mengunjungi 5 kali, hanya dihitung 1

- **Pengunjung Tamu**: Menghitung kunjungan dari guest
  - Filter: `activity_type = 'view'` AND `user_id` IS NULL
  - Setiap kunjungan guest dihitung (tidak di-distinct)

### 3. `resources/views/admin/reports/index.blade.php` (Lines 819-863)
**Status**: Tidak ada perubahan di view, hanya menggunakan data yang sudah diperbaiki

```blade
<!-- 9. Data Pengunjung -->
<div class="table-section mb-4">
    <h3 class="section-title">9. Data Pengunjung</h3>
    <p style="color: #64748b; margin-bottom: 1rem; font-size: 0.9rem;">
        Statistik pengunjung halaman beranda dalam periode yang dipilih
    </p>
    <table class="table table-hover table-compact">
        <tbody>
            <tr>
                <td>Total Kunjungan Halaman Beranda</td>
                <td>{{ number_format($totalViews) }}</td>
            </tr>
            <tr>
                <td>Pengunjung Terdaftar</td>
                <td>{{ number_format($registeredVisitors ?? 0) }}</td>
            </tr>
            <tr>
                <td>Pengunjung Tamu (Guest)</td>
                <td>{{ number_format($guestVisitors ?? 0) }}</td>
            </tr>
        </tbody>
    </table>
</div>
```

## 🔄 Cara Kerja

### Skenario 1: User Login Mengunjungi Beranda
1. User login dengan akun mereka
2. User mengakses `/beranda`
3. GalleryController mencatat:
   - `activity_type` = 'view'
   - `user_id` = ID user yang login
   - `content` = 'Kunjungan ke halaman beranda'

### Skenario 2: Guest Mengunjungi Beranda
1. User tidak login (guest)
2. User mengakses `/beranda`
3. GalleryController mencatat:
   - `activity_type` = 'view'
   - `user_id` = NULL (karena tidak login)
   - `content` = 'Kunjungan ke halaman beranda'

### Skenario 3: User Login Mengunjungi 3 Kali
1. User login dengan akun mereka
2. User mengakses `/beranda` 3 kali
3. Hasil di Reports:
   - **Total Kunjungan**: 3 (semua kunjungan dihitung)
   - **Pengunjung Terdaftar**: 1 (hanya 1 user unik)
   - **Pengunjung Tamu**: 0 (tidak ada guest)

## ✅ Fitur yang Sudah Bekerja

- ✅ Total Kunjungan Halaman Beranda menampilkan angka yang benar
- ✅ Pengunjung Terdaftar menampilkan jumlah user unik yang login
- ✅ Pengunjung Tamu menampilkan jumlah kunjungan dari guest
- ✅ Filter periode (Hari Ini, Minggu Ini, Bulan Ini, Custom) bekerja untuk semua 3 statistik
- ✅ Tidak mengubah tampilan halaman reports
- ✅ Tidak mengubah fitur lainnya

## 📊 Contoh Data

Jika dalam 1 hari ada:
- User A login dan mengunjungi 2 kali
- User B login dan mengunjungi 1 kali
- Guest mengunjungi 3 kali

Maka di Reports akan menampilkan:
- **Total Kunjungan Halaman Beranda**: 6 (2+1+3)
- **Pengunjung Terdaftar**: 2 (User A dan User B)
- **Pengunjung Tamu (Guest)**: 3 (3 kunjungan dari guest)

## 🔧 Troubleshooting

### Data masih menampilkan 0
**Penyebab**: Belum ada kunjungan setelah perubahan ini

**Solusi**:
1. Buka halaman beranda di browser: `http://127.0.0.1:8000/beranda`
2. Refresh beberapa kali
3. Buka halaman reports: `http://127.0.0.1:8000/admin/reports`
4. Filter periode ke "Hari Ini"
5. Lihat bagian "9. Data Pengunjung"

### Hanya Total Kunjungan yang bertambah, tapi Pengunjung Terdaftar 0
**Penyebab**: Semua kunjungan adalah dari guest (tidak login)

**Solusi**:
1. Login dengan akun user
2. Buka halaman beranda
3. Lihat data di Reports akan bertambah di "Pengunjung Terdaftar"

## 📌 Catatan Penting

- Setiap kunjungan ke halaman beranda akan tercatat, bahkan jika user mengunjungi berkali-kali
- Data akan tersimpan di tabel `gallery_activities` dengan `activity_type = 'view'`
- Filter periode di Reports akan mempengaruhi semua 3 statistik
- Tidak ada perubahan pada tampilan atau fitur halaman reports
- Tidak ada perubahan pada halaman beranda atau halaman lainnya

## 🚀 Testing

Untuk memastikan semuanya berfungsi dengan baik:

1. **Test sebagai Guest**:
   - Buka incognito/private browser
   - Akses `http://127.0.0.1:8000/beranda`
   - Refresh 2-3 kali
   - Buka Reports, lihat "Pengunjung Tamu" bertambah

2. **Test sebagai User Login**:
   - Login dengan akun user
   - Akses `http://127.0.0.1:8000/beranda`
   - Refresh 2-3 kali
   - Buka Reports, lihat "Pengunjung Terdaftar" bertambah

3. **Test Filter Periode**:
   - Ubah filter ke "Hari Ini", "Minggu Ini", "Bulan Ini"
   - Lihat data berubah sesuai periode

## 📞 Dukungan

Jika ada pertanyaan atau masalah, silakan hubungi developer atau cek file log di `storage/logs/laravel.log`
