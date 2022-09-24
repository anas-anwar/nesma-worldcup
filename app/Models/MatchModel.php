<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;

class MatchModel extends Model
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $table = "matches";
    protected $dateFormat = 'Y-m-d H:i:s';
   protected $dates = ['date_time'];
  // protected $dateFormat = ['d-m-y'];
    protected $fillable=['date_time','stadium_id','round_id','visitorteam_id','localteam_id' ];
    //protected $appends = ['match_data'];
    // public function getMatchDataAttribute()
    // {
    //     $date_s = Carbon::createFromFormat('Y-m-d  H:i:s',$this->date . " " . $this->start);
    //     $date_e = Carbon::createFromFormat('Y-m-d  H:i:s',$this->date . " " . $this->end);
    //     $current_time = Carbon::now();
       
    //     return [
    //         'type' => ($date_s->lt($current_time) ? 0 : 
    //     ($date_e->gt($current_time) ? 2 : 1)),
    //         'goals_l' =>  1,
    //         'goals_v' => 1,
    //     ];
    // }
    
    public function lineUp(){ // 1 - M relationship (One)
        return $this->hasMany(LineUp::class, 'match_id');
    }
    public function event(){ // 1 - M relationship (One)
        return $this->hasMany(Event::class, 'match_id');
    }
    public function round(){ // 1 - M relationship (Many)
        return $this->belongsTo(Round::class, 'round_id');
    }
    public function stadium(){ // 1 - M relationship (Many)
        return $this->belongsTo(Stadium::class, 'stadium_id');
    }
    public function localTeam(){ // 1 - M relationship (Many)
        return $this->belongsTo(Team::class, 'localteam_id');
    }
    public function visitorTeam(){ // 1 - M relationship (Many)
        return $this->belongsTo(Team::class, 'visitorteam_id');
    }
    public function winnerTeam(){ // 1 - M relationship (Many)
        return $this->belongsTo(Team::class, 'winner_team_id');
    }
    public function accountOdds(){ // 1 - M relationship (One)
        return $this->hasMany(AccountOdds::class);
    }
    public function setDateAttribute( $value ) {
        $this->attributes['date_time'] = (new Carbon($value))->format('Y-m-d H:i:s');
      }
}
