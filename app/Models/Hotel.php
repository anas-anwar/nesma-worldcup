<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use HasFactory, SoftDeletes;

    public function Room(){ // 1 - M relationship (One)
        return $this->hasMany(Room::class);
    }

    public function Images(){ // Eloquent Polymorphic Relations
        return $this->morphMany(Image::class, 'model');
    }
}
