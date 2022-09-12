<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable=['name','nationality','birthdate','height','weight','team_id'];
    public function team(){ // 1 - M relationship (Many)
        return $this->belongsTo(Team::class, 'team_id');
    }
    public function LineUp(){ // 1 - M relationship (One)
        return $this->hasMany(LineUp::class);
    }

    public function Event(){ // 1 - M relationship (One)
        return $this->hasMany(Event::class);
    }
}
