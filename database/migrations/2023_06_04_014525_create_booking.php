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
        Schema::create('booking', function (Blueprint $table) {
            $table->string('invoice')->primary();
            $table->date('tanggal_pesan');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('id_customer')->length(20);
            $table->foreign('id_customer')->references('id_customer')->on('customer');
            $table->string('id_user')->length(20);
            $table->foreign('id_user')->references('id_user')->on('users');
            $table->enum('status_booking',['New', 'Booking', 'Check In', 'Check Out', 'Cancel']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking');
    }
};
