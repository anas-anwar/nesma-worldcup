<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TouristicPlace extends Model
{
    use HasFactory;

    public function images()
    { // Eloquent Polymorphic Relations
        return $this->morphMany(Image::class, 'model');
    }
}
