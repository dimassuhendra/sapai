<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    protected $fillable = ['user_id', 'material_id', 'isi_catatan', 'feedback_guru'];
}
