<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('concert_id')->nullable()->constrained('concerts')->nullOnDelete();
            $table->string('judul');
            $table->string('gambar');
            $table->text('deskripsi')->nullable();
            $table->string('kategori')->default('concert');
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
