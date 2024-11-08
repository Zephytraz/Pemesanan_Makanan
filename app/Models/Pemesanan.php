<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $fillable = ['user_id', 'makanan_id', 'status_pemesanan', 'jumlah_pesanan', 'total_pembayaran'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function makanan()
    {
        return $this->belongsTo(Makanan::class, 'makanan_id');
    }
    public function detailTranskasi()
    {
    return $this->hasOne(DetailTranskasi::class, 'pemesanan_id');
    }

}
