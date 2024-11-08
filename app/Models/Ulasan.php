<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $fillable = ['user_id', 'makanan_id', 'ulasan', 'rating'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function makanan(){
        return $this->belongsTo(Makanan::class, 'makanan_id');
    }
    
}
