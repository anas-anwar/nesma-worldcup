<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use HasFactory, SoftDeletes;
    

    public function rooms()
    { // 1 - M relationship (One)
        return $this->hasMany(Room::class);
    }

    public function images()
    { // Eloquent Polymorphic Relations
        return $this->morphMany(Image::class, 'model');
    }

    public function services()
    { // Eloquent Polymorphic Relations
        return $this->morphMany(EntityService::class, 'model');
    }

    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }
}
