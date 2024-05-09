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
        Schema::create('detail_hampers', function (Blueprint $table) {
            $table->id();
            // hampers_id
            $table->foreignId('hampers_id')->constrained('hampers')->cascadeOnDelete();
            // produk_id
            $table->foreignId('produk_id')->constrained('produks')->cascadeOnDelete();
            // jumlah
            $table->double('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_hampers');
    }
};
