<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = ['nama_program', 'deskripsi', 'harga', 'durasi', 'thumbnail'];

    // Relasi: Satu program punya banyak materi
    public function materials()
    {
        return $this->hasMany(Material::class)->orderBy('order_index');
    }

    // Relasi: Satu program punya banyak siswa
    public function students()
    {
        return $this->belongsToMany(User::class, 'enrollments');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}
