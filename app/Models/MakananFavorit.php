<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MakananFavorit extends Model
{
    protected $fillable = ['user_id', 'makanan_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Makanan
    public function makanan()
    {
        return $this->belongsTo(Makanan::class, 'makanan_id');
    }   
}
