<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $table = 'foto';
    
    // Set verbose names for admin panel
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable('foto');
    }
    
    public function getTable()
    {
        return 'foto';
    }
    
    public function getDisplayNameAttribute()
    {
        return 'Kelola Galeri';
    }

    protected $fillable = [
        'judul',
        'deskripsi',
        'file_path',
        'file_name',
        'file_size',
        'file_type',
        'thumbnail_path',
        'galery_id',
        'kategori_id',
        'user_id',
        'views',
        'likes',
        'status',
    ];

    public function galery()
    {
        return $this->belongsTo(Galery::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


































































































