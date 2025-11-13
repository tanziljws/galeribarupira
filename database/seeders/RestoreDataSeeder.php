<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestoreDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default categories if not exist
        $categories = [
            ['nama' => 'Dokumentasi', 'deskripsi' => 'Dokumentasi kegiatan sekolah', 'slug' => 'dokumentasi', 'icon' => 'fas fa-camera', 'color' => '#3B82F6'],
            ['nama' => 'Prestasi', 'deskripsi' => 'Prestasi siswa dan sekolah', 'slug' => 'prestasi', 'icon' => 'fas fa-trophy', 'color' => '#10b981'],
            ['nama' => 'Kegiatan', 'deskripsi' => 'Kegiatan sekolah', 'slug' => 'kegiatan', 'icon' => 'fas fa-calendar', 'color' => '#f59e0b'],
            ['nama' => 'Ekstrakurikuler', 'deskripsi' => 'Kegiatan ekstrakurikuler', 'slug' => 'ekstrakurikuler', 'icon' => 'fas fa-users', 'color' => '#8b5cf6'],
        ];

        foreach ($categories as $category) {
            if (!DB::table('kategori')->where('slug', $category['slug'])->exists()) {
                DB::table('kategori')->insert([
                    'nama' => $category['nama'],
                    'deskripsi' => $category['deskripsi'],
                    'slug' => $category['slug'],
                    'icon' => $category['icon'],
                    'color' => $category['color'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Create default agendas if not exist
        $agendas = [
            [
                'judul' => 'Upacara Bendera Hari Senin',
                'deskripsi' => 'Upacara bendera rutin setiap hari Senin pukul 07.00 WIB',
                'keterangan' => 'Diikuti oleh seluruh siswa dan guru',
                'tanggal' => now()->addDays(1)->toDateString(),
                'waktu_mulai' => '07:00',
                'waktu_selesai' => '08:00',
                'lokasi' => 'Lapangan Sekolah',
                'status' => 'aktif',
            ],
            [
                'judul' => 'Rapat Guru',
                'deskripsi' => 'Rapat koordinasi guru setiap akhir bulan',
                'keterangan' => 'Membahas perkembangan siswa dan program sekolah',
                'tanggal' => now()->addDays(5)->toDateString(),
                'waktu_mulai' => '14:00',
                'waktu_selesai' => '16:00',
                'lokasi' => 'Ruang Guru',
                'status' => 'aktif',
            ],
            [
                'judul' => 'Tes Kompetensi Keahlian',
                'deskripsi' => 'Ujian kompetensi untuk kelas XII',
                'keterangan' => 'Mengukur kompetensi siswa di bidang keahlian masing-masing',
                'tanggal' => now()->addDays(10)->toDateString(),
                'waktu_mulai' => '08:00',
                'waktu_selesai' => '12:00',
                'lokasi' => 'Ruang Kelas',
                'status' => 'aktif',
            ],
        ];

        foreach ($agendas as $agenda) {
            if (!DB::table('agenda')->where('judul', $agenda['judul'])->exists()) {
                DB::table('agenda')->insert([
                    'judul' => $agenda['judul'],
                    'deskripsi' => $agenda['deskripsi'],
                    'keterangan' => $agenda['keterangan'],
                    'tanggal' => $agenda['tanggal'],
                    'waktu_mulai' => $agenda['waktu_mulai'],
                    'waktu_selesai' => $agenda['waktu_selesai'],
                    'lokasi' => $agenda['lokasi'],
                    'status' => $agenda['status'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Create default news if not exist
        $newsList = [
            [
                'title' => 'SMKN 4 Bogor Raih Penghargaan Sekolah Adiwiyata',
                'slug' => 'smkn-4-bogor-raih-penghargaan-sekolah-adiwiyata',
                'excerpt' => 'SMKN 4 Bogor telah meraih penghargaan Sekolah Adiwiyata tingkat nasional',
                'content' => 'SMKN 4 Bogor telah meraih penghargaan Sekolah Adiwiyata tingkat nasional atas komitmen dalam menjaga lingkungan dan keberlanjutan.',
                'status' => 'published',
            ],
            [
                'title' => 'Peluncuran Program Magang Industri 2025',
                'slug' => 'peluncuran-program-magang-industri-2025',
                'excerpt' => 'Program magang industri tahun 2025 telah diluncurkan',
                'content' => 'Program magang industri tahun 2025 telah diluncurkan dengan kerjasama bersama berbagai perusahaan terkemuka di Indonesia.',
                'status' => 'published',
            ],
            [
                'title' => 'Pengumuman Penerimaan Siswa Baru Tahun Ajaran 2025/2026',
                'slug' => 'pengumuman-penerimaan-siswa-baru-2025-2026',
                'excerpt' => 'Pendaftaran siswa baru untuk tahun ajaran 2025/2026 telah dibuka',
                'content' => 'Pendaftaran siswa baru untuk tahun ajaran 2025/2026 telah dibuka. Calon siswa dapat mendaftar melalui portal online sekolah.',
                'status' => 'published',
            ],
        ];

        foreach ($newsList as $news) {
            if (!DB::table('news')->where('slug', $news['slug'])->exists()) {
                DB::table('news')->insert([
                    'title' => $news['title'],
                    'slug' => $news['slug'],
                    'excerpt' => $news['excerpt'],
                    'content' => $news['content'],
                    'image_path' => null,
                    'status' => $news['status'],
                    'published_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->command->info('Data kategori, agenda, dan berita berhasil dikembalikan!');
    }
}
