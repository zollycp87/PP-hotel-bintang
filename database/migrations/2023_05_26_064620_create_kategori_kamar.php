<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kategori_kamar', function (Blueprint $table) {
            $table->string('id_kategori')->primary()->length(3);
            $table->string('nama_kategori')->unique();
            $table->unsignedInteger('harga_kategori')->default('0');
            $table->integer('kapasitas');
            $table->text('deskripsi')->nullable();
            $table->text('img')->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_kamar');
    }
};
