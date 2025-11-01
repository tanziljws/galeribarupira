<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'agenda';
    
    protected $fillable = [
        'judul',
        'tanggal',
        'waktu',
        'lokasi',
        'keterangan',
        'kelas',
        'status',
        'tipe'
    ];
    
    protected $casts = [
        'tanggal' => 'date',
        'waktu' => 'datetime:H:i',
    ];
    
    // Scope untuk agenda aktif
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
    
    // Scope untuk agenda berdasarkan tipe
    public function scopeByTipe($query, $tipe)
    {
        return $query->where('tipe', $tipe);
    }
    
    // Scope untuk agenda yang akan datang
    public function scopeUpcoming($query)
    {
        return $query->where('tanggal', '>=', now()->toDateString());
    }
    
    // Scope untuk agenda yang sudah berlalu
    public function scopePast($query)
    {
        return $query->where('tanggal', '<', now()->toDateString());
    }
}
