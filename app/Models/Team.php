<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Team extends Model
{
    use HasFactory, SoftDeletes;

    public function MatchRelation(){ // 1 - M relationship (One)
        return $this->hasMany(MatchModel::class);
    }
    public function LineUp(){ // 1 - M relationship (One)
        return $this->hasMany(LineUp::class);
    }
    public function Event(){ // 1 - M relationship (One)
        return $this->hasMany(Event::class);
    }
    public function Player(){ // 1 - M relationship (One)
        return $this->hasMany(Player::class);
    }
    public function Stadium(){ // 1 - 1 relationship (with forigen key)
        return $this->belongsTo(Stadium::class, 'stadium_id');
    }
    public function Groups(){ // 1 - M relationship (Many)
        return $this->belongsTo(Group::class, 'group_id');
    }

}
