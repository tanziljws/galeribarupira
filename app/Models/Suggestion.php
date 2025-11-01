<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap',
        'email',
        'pesan',
        'balasan',
        'status',
        'dibalas_pada'
    ];

    protected $casts = [
        'dibalas_pada' => 'datetime',
    ];

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'belum_dibaca' => 'Belum Dibaca',
            'dibaca' => 'Dibaca',
            'dibalas' => 'Dibalas',
            default => 'Tidak Diketahui'
        };
    }

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'belum_dibaca' => 'danger',
            'dibaca' => 'warning',
            'dibalas' => 'success',
            default => 'secondary'
        };
    }
}