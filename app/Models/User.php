<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'no_telp',
        'password',
        'role',
        'nama_lengkap',
        'foto_profil'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // --- RELASI TAMBAHAN ---

    // Relasi: Satu guru punya banyak materi
    public function materials()
    {
        return $this->hasMany(Material::class, 'guru_id');
    }

    // Relasi Many-to-Many: Siswa mengambil banyak program
    public function programs()
    {
        return $this->belongsToMany(Program::class, 'enrollments');
    }

    // Relasi: Siswa punya banyak catatan
    public function notes()
    {
        return $this->hasMany(Notes::class);
    }

    // Relasi: Siswa punya banyak data progres belajar
    public function progresses()
    {
        return $this->hasMany(Progress::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}