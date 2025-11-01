<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryActivity extends Model
{
    protected $fillable = [
        'foto_id',
        'user_id',
        'activity_type',
        'content',
        'ip_address',
        'user_agent'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationship with foto
    public function foto()
    {
        return $this->belongsTo(\App\Models\Foto::class, 'foto_id');
    }

    // Relationship with user
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
