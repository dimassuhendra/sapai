<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonials extends Model
{
    protected $fillable = ['user_id', 'isi_testimoni', 'status_tampil'];

    // Relasi ke User: Mengetahui siapa yang memberikan testimoni
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}