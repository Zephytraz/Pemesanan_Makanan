<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class detail_login extends Model
{
    protected $fillable = ['user_id', 'login_time', 'ip_address'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
