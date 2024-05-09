<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;

    protected $table = 'reseps';

    protected $guarded = ['id'];

    public function bahan_baku()
    {
        return $this->belongsTo(BahanBaku::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
