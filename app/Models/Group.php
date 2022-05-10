<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Group extends Model
{
    use HasFactory;

    public function Team(){ // 1 - M relationship (One)
        return $this->hasMany(Team::class);
    }
}
