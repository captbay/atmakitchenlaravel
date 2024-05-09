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
        Schema::create('bonus_gajis', function (Blueprint $table) {
            $table->id();
            // jabatan_id
            $table->foreignId('jabatan_id')->constrained('jabatans')->cascadeOnDelete();
            // gaji
            $table->double('gaji');
            // bonus
            $table->double('bonus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bonus_gajis');
    }
};
