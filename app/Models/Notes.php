<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    // Karena nama tabel Anda di SQL adalah 'notes', definisikan secara eksplisit
    protected $table = 'notes';

    protected $fillable = ['user_id', 'material_id', 'isi_catatan', 'feedback_guru'];

    /**
     * Relasi ke tabel materials
     * Diperlukan agar guru bisa memfilter catatan berdasarkan materi miliknya
     */
    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }

    /**
     * Relasi ke tabel users
     * Diperlukan untuk menampilkan nama siswa yang membuat catatan
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
