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
        Schema::create('penggunaan_stock_produk_sisas', function (Blueprint $table) {
            $table->id();
            // produks_id
            $table->foreignId('produks_id')->constrained('produks')->cascadeOnDelete();
            // status
            $table->string('status');
            // kouta_terpakai
            $table->double('kouta_terpakai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggunaan_stock_produk_sisas');
    }
};
