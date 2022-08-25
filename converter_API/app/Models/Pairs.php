<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pairs extends Model
{
    use HasFactory;

    public function converts(){
        return $this->hasOne(Converts::class);
    }
    public function pairs(){
        return $this->belongsToOne(Currency::class);
    }
}
