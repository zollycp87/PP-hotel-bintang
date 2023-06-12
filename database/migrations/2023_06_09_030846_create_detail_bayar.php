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
        Schema::create('detail_bayar', function (Blueprint $table) {
            $table->string('invoice');
            $table->foreign('invoice')->references('invoice')->on('booking');
            $table->date('tanggal_bayar');
            $table->bigInteger('total_bayar')->default(0);
            $table->enum('status_bayar',['Full Payment', 'DP', 'Pelunasan']);
            $table->text('bukti_bayar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_bayar');
    }
};
