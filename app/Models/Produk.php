<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks';

    protected $guarded = ['id'];

    public function detail_pemesanan()
    {
        return $this->hasMany(DetailPemesanan::class);
    }

    public function detail_hampers()
    {
        return $this->hasMany(DetailHampers::class);
    }

    public function stock_produk_sisa()
    {
        return $this->hasMany(StockProdukSisa::class);
    }

    public function penggunaan_stock_produk_sisa()
    {
        return $this->hasMany(PenggunaanStockProdukSisa::class);
    }

    public function resep()
    {
        return $this->hasMany(Resep::class);
    }
}
