<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galleries', function (Blueprint $col) {
            $col->id();
            $col->string('judul');
            $col->text('keterangan')->nullable();
            $col->string('image_path');
            $col->integer('order_index')->default(0);
            $col->boolean('is_active')->default(true);
            $col->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
