<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'keterangan',
        'image_path',
        'order_index',
        'is_active'
    ];

    /**
     * Scope untuk mengambil foto yang aktif dan urutan yang benar
     */
    public function scopeOrdered($query)
    {
        return $query->where('is_active', true)->orderBy('order_index', 'asc');
    }
}
