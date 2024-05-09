<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianBahanBaku extends Model
{
    use HasFactory;

    protected $table = 'pembelian_bahan_bakus';

    protected $guarded = ['id'];
}
