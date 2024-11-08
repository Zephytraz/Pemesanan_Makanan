<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTranskasi extends Model
{
    protected $fillable = ['pemesanan_id','user_id',  'total_pembayaran', 'uang_user', 'jumlah_kembalian'];

    public function pemesanan(){
        return $this->belongsTo(Pemesanan::class, 'pemesanan_id');
    }

    public function user(){
        return $this->belongsTo(Pemesanan::class);
    }
}
