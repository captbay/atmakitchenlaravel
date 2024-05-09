<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailHampers extends Model
{
    use HasFactory;

    protected $table = 'detail_hampers';

    protected $guarded = ['id'];

    public function hampers()
    {
        return $this->belongsTo(Hampers::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
