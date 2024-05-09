<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penitip extends Model
{
    use HasFactory;

    protected $table = 'penitips';

    protected $guarded = ['id'];

    public function produk_titipan()
    {
        return $this->hasMany(ProdukTitipan::class);
    }
}
