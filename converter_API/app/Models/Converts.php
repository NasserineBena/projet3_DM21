<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Converts extends Model
{
    use HasFactory;

    public function pairs(){
        return $this->belongsToOne(Pairs::class);
    }
}
