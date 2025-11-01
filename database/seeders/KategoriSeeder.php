<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            [
                'nama' => 'Landscape',
                'deskripsi' => 'Foto pemandangan alam yang indah',
                'slug' => Str::slug('Landscape'),
                'icon' => 'fas fa-mountain',
                'color' => '#10b981',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Portrait',
                'deskripsi' => 'Foto potret manusia yang menawan',
                'slug' => Str::slug('Portrait'),
                'icon' => 'fas fa-user',
                'color' => '#3b82f6',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Street',
                'deskripsi' => 'Foto jalanan dan kehidupan urban',
                'slug' => Str::slug('Street'),
                'icon' => 'fas fa-city',
                'color' => '#f59e0b',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Nature',
                'deskripsi' => 'Foto alam dan keindahan lingkungan',
                'slug' => Str::slug('Nature'),
                'icon' => 'fas fa-tree',
                'color' => '#059669',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Architecture',
                'deskripsi' => 'Foto arsitektur dan bangunan',
                'slug' => Str::slug('Architecture'),
                'icon' => 'fas fa-building',
                'color' => '#7c3aed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Travel',
                'deskripsi' => 'Foto perjalanan dan destinasi wisata',
                'slug' => Str::slug('Travel'),
                'icon' => 'fas fa-plane',
                'color' => '#ef4444',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($kategoris as $kategori) {
            DB::table('kategori')->insert($kategori);
        }
    }
}
