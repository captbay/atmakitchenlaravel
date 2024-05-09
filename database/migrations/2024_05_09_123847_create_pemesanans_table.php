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
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            // user_id
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            // kurir_id
            $table->foreignId('kurir_id')->constrained('karyawans')->cascadeOnDelete();
            // status
            $table->string('status');
            // bukti_pembayaran
            $table->string('bukti_pembayaran');
            // no_pemesanan
            $table->string('no_pemesanan');
            // jarak
            $table->double('jarak');
            // subtotal_awal
            $table->double('subtotal_awal');
            // ongkos_kirim
            $table->double('ongkos_kirim');
            // potongan_poin
            $table->double('potongan_poin');
            // subtotal_akhir
            $table->double('subtotal_akhir');
            // total_tip
            $table->double('total_tip');
            // tanggal_pesan
            $table->dateTime('tanggal_pesan');
            // tanggal_lunas
            $table->dateTime('tanggal_lunas');
            // tanggal_ambil
            $table->dateTime('tanggal_ambil');
            // total_poin
            $table->double('total_poin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};
