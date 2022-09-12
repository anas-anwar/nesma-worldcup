<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Event extends Model
{
    public $timestamps = false;

    use HasFactory;

    protected $fillable=['minute','player1_id','player2_id','type_of_events_id','team_id',"match_id"];
    public function Matches(){ // 1 - M relationship (Many)
        return $this->belongsTo(MatchModel::class, 'match_id');
    }


    public function Teams(){ // 1 - M relationship (Many)
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function Players(){ // 1 - M relationship (Many)
        return $this->belongsTo(Player::class, 'player1_id');
    }
    public function Playerassesst(){ // 1 - M relationship (Many)
        return $this->belongsTo(Player::class, 'player2_id');
    }
    public function TypeOfEvents(){ // 1 - M relationship (Many)
        return $this->belongsTo(TypeOfEvent::class, 'type_of_events_id');
    }


}
