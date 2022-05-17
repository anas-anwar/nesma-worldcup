<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Stadium extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'stadiums';
    
    public function Images(){ //Eloquent Polymorphic Relations
        return $this->morphMany(Image::class, 'model');
    }

    public function MatchRelation(){ // 1 - M relationship (One)
        return $this->hasMany(MatchModel::class);
    }
    public function Team(){ // 1 - 1 relationship
        return $this->hasOne(Team::class);
    }
}
