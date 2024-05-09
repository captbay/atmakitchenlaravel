<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoPoin extends Model
{
    use HasFactory;

    protected $table = 'promo_poin';

    protected $guarded = ['id'];
}
