<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = ['user_id', 'program_id', 'status_bayar', 'tgl_daftar','created_at', 'updated_at'];

    // Opsional: Jika ingin mengakses data user/program dari objek enrollment
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
