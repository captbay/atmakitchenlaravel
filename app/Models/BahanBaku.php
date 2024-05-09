<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model
{
    use HasFactory;

    protected $table = 'bahan_bakus';

    protected $guarded = ['id'];

    public function pembelian_bahan_baku()
    {
        return $this->hasMany(PembelianBahanBaku::class);
    }

    public function resep()
    {
        return $this->hasMany(Resep::class);
    }
}
