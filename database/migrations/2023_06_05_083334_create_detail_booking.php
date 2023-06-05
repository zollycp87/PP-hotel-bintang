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
        Schema::create('detail_booking', function (Blueprint $table) {
            $table->string('invoice');
            $table->foreign('invoice')->references('invoice')->on('booking');
            $table->string('id_kategori')->length(3);
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori_kamar');
            $table->string('no_kamar')->length(3);
            $table->foreign('no_kamar')->references('no_kamar')->on('kamar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_booking');
    }
};
