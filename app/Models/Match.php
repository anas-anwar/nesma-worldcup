<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MatchModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "matches";

    public function LineUp(){ // 1 - M relationship (One)
        return $this->hasMany(LineUp::class);
    }
    public function Event(){ // 1 - M relationship (One)
        return $this->hasMany(Event::class);
    }
    public function Rounds(){ // 1 - M relationship (Many)
        return $this->belongsTo(Round::class, 'round_id');
    }
    public function Stadiums(){ // 1 - M relationship (Many)
        return $this->belongsTo(Stadium::class, 'stadium_id');
    }
    public function LocalTeams(){ // 1 - M relationship (Many)
        return $this->belongsTo(Team::class, 'localteam_id');
    }
    public function VisitorTeam(){ // 1 - M relationship (Many)
        return $this->belongsTo(Team::class, 'visitorteam_id');
    }
    public function AccountOdds(){ // 1 - M relationship (One)
        return $this->hasMany(AccountOdds::class);
    }
}
