<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfEvent extends Model
{
    use HasFactory;

    public function Event(){ // 1 - M relationship (One)
        return $this->hasMany(Events::class);
    }
}
