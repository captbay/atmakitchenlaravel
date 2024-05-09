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
        Schema::create('detail_pemesanans', function (Blueprint $table) {
            $table->id();
            // pemesanan_id
            $table->foreignId('pemesanan_id')->constrained('pemesanans')->cascadeOnDelete();
            // produk_id
            $table->foreignId('produk_id')->constrained('produks')->cascadeOnDelete();
            // hampers_id
            $table->foreignId('hampers_id')->constrained('hampers')->cascadeOnDelete();
            // produk_titipan_id
            $table->foreignId('produk_titipan_id')->constrained('produks')->cascadeOnDelete();
            // jumlah
            $table->double('jumlah');
            $table->double('total_harga');
            // is_sisaan
            $table->boolean('is_sisaan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pemesanans');
    }
};
