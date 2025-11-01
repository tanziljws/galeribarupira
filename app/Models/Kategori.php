<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $fillable = [
        'nama',
        'deskripsi',
        'slug',
        'icon',
        'color',
    ];

    public function fotos()
    {
        return $this->hasMany(Foto::class);
    }

    public function galery()
    {
        return $this->hasMany(Galery::class);
    }
}















































































































