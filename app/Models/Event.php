<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    public function Matches(){ // 1 - M relationship (Many)
        return $this->belongsTo(MatchModel::class, 'match_id');
    }

    public function Teams(){ // 1 - M relationship (Many)
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function Players(){ // 1 - M relationship (Many)
        return $this->belongsTo(Player::class, 'player_id');
    }
    public function TypeOfEvents(){ // 1 - M relationship (Many)
        return $this->belongsTo(TypeOfEvent::class, 'type_of_events_id');
    }


}
