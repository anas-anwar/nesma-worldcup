<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    public function Hotel(){ // 1 - M relationship (One)
        return $this->hasMany(Hotel::class);
    }

    public function Restursnt(){ // 1 - M relationship (One)
        return $this->hasMany(Restursnt::class);
    }
}
