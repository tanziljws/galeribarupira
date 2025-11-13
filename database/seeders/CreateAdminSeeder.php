<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default admin account in petugas table if not exists
        if (!DB::table('petugas')->where('username', 'admin')->exists()) {
            DB::table('petugas')->insert([
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'nama' => 'Administrator',
                'email' => 'admin@piragallery.com',
                'jabatan' => 'Admin',
                'telepon' => '08123456789',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            $this->command->info('Admin account berhasil dibuat!');
            $this->command->info('Username: admin');
            $this->command->info('Password: admin123');
        } else {
            $this->command->info('Admin account sudah ada!');
        }
    }
}
