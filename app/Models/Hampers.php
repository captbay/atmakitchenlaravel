<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hampers extends Model
{
    use HasFactory;

    protected $table = 'hampers';

    protected $guarded = ['id'];

    public function detail_pemesanan()
    {
        return $this->hasMany(DetailPemesanan::class);
    }

    public function detail_hampers()
    {
        return $this->hasMany(DetailHampers::class);
    }
}
