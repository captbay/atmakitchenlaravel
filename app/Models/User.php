<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function pengeluaran_lainnya()
    {
        return $this->hasMany(PengeluaranLainnya::class);
    }

    public function detail_customer()
    {
        return $this->hasOne(DetailCustomer::class);
    }

    public function history_pengembalian_saldo()
    {
        return $this->hasMany(HistoryPengembalianSaldo::class);
    }

    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class);
    }

    public function history_poin()
    {
        return $this->hasMany(HistoryPoin::class);
    }

    public function history_saldo()
    {
        return $this->hasMany(HistorySaldo::class);
    }
}
