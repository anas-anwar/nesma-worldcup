<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Group extends Model
{
    public $timestamps = false;
    use HasFactory;

    public function Teams(){ // 1 - M relationship (One)
        return $this->hasMany(Team::class);
    }
}
