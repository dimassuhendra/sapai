<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable = ['setting_key', 'setting_value'];

    /**
     * Helper untuk mengambil nilai setting dengan mudah
     * Contoh penggunaan: Setting::getValue('wa_number');
     */
    public static function getValue($key)
    {
        $setting = self::where('setting_key', $key)->first();
        return $setting ? $setting->setting_value : null;
    }
}