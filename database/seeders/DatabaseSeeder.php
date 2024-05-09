<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Alamat;
use App\Models\BahanBaku;
use App\Models\BonusGaji;
use App\Models\DetailCustomer;
use App\Models\DetailHampers;
use App\Models\DetailPemesanan;
use App\Models\Hampers;
use App\Models\HistoryPengembalianSaldo;
use App\Models\HistoryPoin;
use App\Models\HistorySaldo;
use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\PembelianBahanBaku;
use App\Models\Pemesanan;
use App\Models\PengeluaranLainnya;
use App\Models\PenggunaanStockProdukSisa;
use App\Models\Penitip;
use App\Models\Presensi;
use App\Models\Produk;
use App\Models\ProdukTitipan;
use App\Models\PromoPoin;
use App\Models\Resep;
use App\Models\StockProdukSisa;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(100)->create();
        PromoPoin::factory(100)->create();
        Produk::factory(100)->create();
        BahanBaku::factory(100)->create();
        Hampers::factory(100)->create();
        Jabatan::factory(100)->create();
        Karyawan::factory(100)->create();
        Penitip::factory(100)->create();
        PembelianBahanBaku::factory(100)->create();
        PengeluaranLainnya::factory(100)->create();
        Presensi::factory(100)->create();
        Alamat::factory(100)->create();
        Pemesanan::factory(100)->create();
        BonusGaji::factory(100)->create();
        DetailCustomer::factory(100)->create();
        HistoryPengembalianSaldo::factory(100)->create();
        HistoryPoin::factory(100)->create();
        HistorySaldo::factory(100)->create();
        ProdukTitipan::factory(100)->create();
        DetailHampers::factory(100)->create();
        StockProdukSisa::factory(100)->create();
        PenggunaanStockProdukSisa::factory(100)->create();
        Resep::factory(100)->create();
        DetailPemesanan::factory(100)->create();
    }
}
