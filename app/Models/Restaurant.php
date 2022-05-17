<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    use HasFactory, SoftDeletes;

    public function Services(){ // Eloquent Polymorphic Relations
        return $this->morphMany(Service::class, 'model');
    }
    
    public function Images(){ // 1 - M relationship (Many) with Eloquent Polymorphic Relations
        return $this->morphMany(Image::class, 'model');
    }
}
