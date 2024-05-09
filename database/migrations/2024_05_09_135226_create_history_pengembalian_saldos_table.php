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
        Schema::create('history_pengembalian_saldos', function (Blueprint $table) {
            $table->id();
            // user_id
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            // nama_bank
            $table->string('nama_bank');
            // nomor_rekening
            $table->string('nomor_rekening');
            // nama_pemilik
            $table->string('nama_pemilik');
            // jumlah_pengembalian
            $table->double('jumlah_pengembalian');
            // status
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_pengembalian_saldos');
    }
};
