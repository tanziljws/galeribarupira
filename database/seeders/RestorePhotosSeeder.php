<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class RestorePhotosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default categories if not exist
        $kategoriCount = DB::table('kategori')->count();
        if ($kategoriCount == 0) {
            $kategoriId = DB::table('kategori')->insertGetId([
                'nama' => 'Galeri Umum',
                'deskripsi' => 'Kategori galeri umum',
                'slug' => 'galeri-umum',
                'icon' => 'fas fa-images',
                'color' => '#3B82F6',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $kategoriId = DB::table('kategori')->first()->id;
        }

        // Create default gallery if not exist
        $galeryCount = DB::table('galery')->count();
        if ($galeryCount == 0) {
            $galeryId = DB::table('galery')->insertGetId([
                'nama' => 'Galeri Utama',
                'deskripsi' => 'Galeri utama SMKN 4 Bogor',
                'cover_image' => null,
                'kategori_id' => $kategoriId,
                'user_id' => null,
                'status' => 'public',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $galeryId = DB::table('galery')->first()->id;
        }

        // Get all photo files from storage
        $photoPath = storage_path('app/public/photos');
        if (File::exists($photoPath)) {
            $files = File::files($photoPath);

            foreach ($files as $file) {
                $filename = $file->getFilename();
                $filepath = 'photos/' . $filename;
                
                // Check if photo already exists in database
                $exists = DB::table('foto')->where('file_path', $filepath)->exists();
                
                if (!$exists) {
                    // Extract title from filename (remove timestamp prefix)
                    $title = preg_replace('/^\d+_/', '', pathinfo($filename, PATHINFO_FILENAME));
                    $title = str_replace('_', ' ', $title);
                    
                    DB::table('foto')->insert([
                        'judul' => $title,
                        'deskripsi' => 'Foto dari galeri',
                        'file_path' => $filepath,
                        'file_name' => $filename,
                        'file_size' => $file->getSize(),
                        'file_type' => $file->getExtension(),
                        'thumbnail_path' => null,
                        'galery_id' => $galeryId,
                        'kategori_id' => $kategoriId,
                        'user_id' => null,
                        'views' => 0,
                        'likes' => 0,
                        'status' => 'active',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

        $this->command->info('Foto-foto berhasil dikembalikan ke database!');
    }
}
