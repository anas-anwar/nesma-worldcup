<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    public $timestamps = false;
    use HasFactory;

    public function Teams(){ // 1 - M relationship (Many)
        return $this->belongsTo(Team::class, 'team_id');
    }
    public function LineUp(){ // 1 - M relationship (One)
        return $this->hasMany(LineUp::class);
    }

    public function Event(){ // 1 - M relationship (One)
        return $this->hasMany(Event::class);
    }
}
