<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = ['guru_id', 'program_id', 'judul', 'konten', 'file_path', 'order_index', 'is_public'];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    // Relasi ke progress belajar
    public function progresses()
    {
        return $this->hasMany(Progress::class);
    }
}
